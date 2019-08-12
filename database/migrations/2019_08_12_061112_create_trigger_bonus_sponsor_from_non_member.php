<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerBonusSponsorFromNonMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_bonus_sponsor_from_non_member AFTER INSERT ON `transaction_non_members` 
            FOR EACH ROW BEGIN
                DECLARE bonus_bv decimal(15, 0);
                DECLARE bonus_pv integer;
                SET bonus_bv = (SELECT bv FROM `ebooks` WHERE id = NEW.ebook_id);
                SET bonus_pv = (SELECT pv FROM `ebooks` WHERE id = NEW.ebook_id);
                INSERT INTO history_bitrex_cash (`id_member`, `nominal`, `created_at`, `updated_at` , `description`, `info`) VALUES (NEW.member_id, bonus_bv * 0.2, now(), now(), "Bonus sponsor", 1);
                UPDATE employeers SET bitrex_cash = bitrex_cash + (bonus_bv * 0.2), updated_at = now(), pv = pv + bonus_pv WHERE id = NEW.member_id;
        END
    ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_bonus_sponsor_from_non_member`');
    }
}
