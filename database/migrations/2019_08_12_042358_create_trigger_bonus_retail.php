<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerBonusRetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER tr_bonus_retail AFTER INSERT ON `transaction_non_members` 
                FOR EACH ROW BEGIN
                    INSERT INTO history_bitrex_cash (`id_member`, `nominal`, `created_at`, `updated_at` , `description`, `info`) VALUES (NEW.member_id, NEW.income, now(), now(), "Bonus Retail", 1);
                    UPDATE employeers SET bitrex_cash = bitrex_cash + NEW.income, updated_at = now() WHERE id = NEW.member_id;
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
        DB::unprepared('DROP TRIGGER `tr_bonus_retail`');
    }
}
