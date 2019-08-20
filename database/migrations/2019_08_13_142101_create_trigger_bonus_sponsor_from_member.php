<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerBonusSponsorFromMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_bonus_sponsor_from_member AFTER INSERT ON `transaction_member` 
            FOR EACH ROW BEGIN
                DECLARE bonus_bv decimal(15, 0);
                DECLARE bonus_pv, parent, pv_now integer;
                SET bonus_bv = (SELECT bv FROM `ebooks` WHERE id = NEW.ebook_id);
                SET bonus_pv = (SELECT pv FROM `ebooks` WHERE id = NEW.ebook_id);
                SET parent = (SELECT parent_id FROM `employeers` WHERE id = NEW.member_id);
                IF parent is NULL THEN 
                    SET parent = NEW.member_id;
                END IF;
                SET pv_now = (SELECT pv FROM `employeers` WHERE id = NEW.member_id);
                INSERT INTO history_bitrex_cash (`id_member`, `nominal`, `created_at`, `updated_at` , `description`, `info`) VALUES (parent, bonus_bv * 0.2, now(), now(), "Bonus Sponsor", 1);
                UPDATE employeers SET updated_at = now(), pv = pv + bonus_pv WHERE id = NEW.member_id;
                UPDATE employeers SET updated_at = now(), bitrex_cash = bitrex_cash + (bonus_bv * 0.2) WHERE id = parent;
                INSERT INTO history_pv (`pv`, `pv_today`, `id_member`, `created_at`, `updated_at`) VALUES (pv_now + bonus_pv, bonus_pv, NEW.member_id, now(), now());
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
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bonus_sponsor_from_member`');
    }
}
