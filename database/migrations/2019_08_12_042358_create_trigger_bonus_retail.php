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
                    set @verif = (SELECT verification FROM `employeers` WHERE employeers.id = new.member_id);
                    set @pajak = 0.0;
                    IF @verif = 0 THEN
                        set @pajak = 0.03;
                    ELSE
                        set @pajak = 0.025;
                    END IF;
                    set @ppn = @pajak * NEW.income;
                    INSERT INTO history_pajak(`id_member`,`id_bonus`,`persentase`,`nominal`,`created_at`,`updated_at`)VALUES (NEW.member_id, 1, @pajak, @ppn, now(), now());
                    INSERT INTO history_bitrex_cash (`id_member`, `nominal`, `created_at`, `updated_at` , `description`, `info`) VALUES (NEW.member_id, NEW.income - @ppn, now(), now(), "Bonus Retail", 1);
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
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bonus_retail`');
    }
}
