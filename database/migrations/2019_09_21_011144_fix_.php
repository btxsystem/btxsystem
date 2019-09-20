<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Fix extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*DB::unprepared('DROP TRIGGER IF EXISTS `tr_bonus_sponsor_from_member`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bonus_sponsor_from_non_member`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bonus_retail`');*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /*DB::unprepared('
        CREATE TRIGGER tr_bonus_sponsor_from_member AFTER UPDATE ON `transaction_member` 
            FOR EACH ROW BEGIN
                DECLARE bonus_bv decimal(15, 0);
                DECLARE bonus_pv, sponsor, pv_now integer;
                set time_zone = "+07:00";
                SET bonus_bv = (SELECT bv FROM `ebooks` WHERE id = NEW.ebook_id);
                SET bonus_pv = (SELECT pv FROM `ebooks` WHERE id = NEW.ebook_id);
                SET sponsor = (SELECT sponsor_id FROM `employeers` WHERE id = NEW.member_id);
                set @verif = (SELECT verification FROM `employeers` WHERE employeers.id = new.member_id);
                set @username = (SELECT username FROM `employeers` WHERE employeers.id = new.member_id);
                set @pajak = 0.0;
                set @condition1 = (SELECT count(id) FROM `transaction_member` WHERE member_id = new.member_id and status = 1);
                set @condition2 = (SELECT count(id) FROM `transaction_non_members` WHERE member_id = new.member_id and status = 1);
                IF @verif = 0 THEN
                set @pajak = 0.03;
                ELSE
                set @pajak = 0.025;
                END IF;
                set @ppn = @pajak * (bonus_bv * 0.2);
                IF sponsor is NULL THEN 
                    SET sponsor = NEW.member_id;
                END IF;
                SET pv_now = (SELECT pv FROM `employeers` WHERE id = NEW.member_id);
                IF new.status = 1 THEN
                    INSERT INTO history_pajak(`id_member`,`id_bonus`,`persentase`,`nominal`,`created_at`,`updated_at`)VALUES (NEW.member_id, 2, @pajak, @ppn, now(), now());
                    INSERT INTO history_bitrex_cash (`id_member`, `nominal`, `created_at`, `updated_at` , `description`, `info`, `type`) VALUES (sponsor, bonus_bv * 0.2 - @ppn, now(), now(), CONCAT("Bonus Sponsor from ", @username), 1, 0);
                    UPDATE employeers SET updated_at = now(), pv = pv + bonus_pv WHERE id = NEW.member_id;
                    UPDATE employeers SET updated_at = now(), bitrex_cash = bitrex_cash + (bonus_bv * 0.2 - @ppn) WHERE id = sponsor;
                    INSERT INTO history_pv (`pv`, `pv_today`, `id_member`, `created_at`, `updated_at`) VALUES (pv_now + bonus_pv, bonus_pv, NEW.member_id, now(), now());
                    if @condition1 > 1 or @condition2 > 1 THEN
                        set @inter = (select pv from ebooks where id = new.ebook_id);
                        set @inter = @inter/25; 
                        UPDATE employeers SET expired_at = expired_at + INTERVAL @inter YEAR WHERE id = NEW.member_id;
                    END IF;
                END IF;
            END
        ');
        DB::unprepared('
        CREATE TRIGGER tr_bonus_sponsor_from_non_member AFTER UPDATE ON `transaction_non_members` 
            FOR EACH ROW BEGIN
                set time_zone = "+07:00";
                SET @bonus_bv = (SELECT bv FROM `ebooks` WHERE id = NEW.ebook_id);
                SET @bonus_pv = (SELECT pv FROM `ebooks` WHERE id = NEW.ebook_id);
                SET @sponsor = (SELECT sponsor_id FROM `employeers` WHERE id = NEW.member_id);
                set @verif = (SELECT verification FROM `employeers` WHERE employeers.id = new.member_id);
                set @username = (SELECT username FROM `non_members` WHERE non_members.id = new.non_member_id);
                set @condition1 = (SELECT count(id) FROM `transaction_member` WHERE member_id = new.member_id and status = 1);
                set @condition2 = (SELECT count(id) FROM `transaction_non_members` WHERE member_id = new.member_id and status = 1);
                set @pajak = 0.0;
                IF @verif = 0 THEN
                    set @pajak = 0.03;
                ELSE
                    set @pajak = 0.025;
                END IF;
                set @ppn = @pajak * (@bonus_bv * 0.2);
                IF @sponsor is NULL THEN 
                    SET @sponsor = NEW.member_id;
                END IF;
                IF new.status = 1 THEN
                    SET @pv_now = (SELECT pv FROM `employeers` WHERE id = NEW.member_id);
                    INSERT INTO history_pajak(`id_member`,`id_bonus`,`persentase`,`nominal`,`created_at`,`updated_at`)VALUES (NEW.member_id, 2, @pajak, @ppn, now(), now());
                    INSERT INTO history_bitrex_cash (`id_member`, `nominal`, `created_at`, `updated_at` , `description`, `info`, `type`) VALUES (@sponsor, @bonus_bv * 0.2 - @ppn, now(), now(), CONCAT("Bonus Sponsor from ", @username), 1, 0);
                    UPDATE employeers SET updated_at = now(), pv = pv + @bonus_pv WHERE id = NEW.member_id;
                    UPDATE employeers SET updated_at = now(), bitrex_cash = bitrex_cash + (@bonus_bv * 0.2 - @ppn) WHERE id = @sponsor;
                    INSERT INTO history_pv (`pv`, `pv_today`, `id_member`, `created_at`, `updated_at`) VALUES (@pv_now + @bonus_pv, @bonus_pv, NEW.member_id, now(), now());
                    if @condition1 > 1 or @condition2 > 1 THEN
                        set @inter = (select pv from ebooks where id = new.ebook_id); 
                        set @inter = @inter/25;
                        UPDATE employeers SET expired_at = expired_at + INTERVAL @inter YEAR WHERE id = NEW.member_id;
                    END IF;
            END IF;
            END
        ');
        DB::unprepared('
            CREATE TRIGGER tr_bonus_retail AFTER UPDATE ON `transaction_non_members` 
                FOR EACH ROW BEGIN
                    set time_zone = "+07:00";
                    set @verif = (SELECT verification FROM `employeers` WHERE employeers.id = new.member_id);
                    set @username = (SELECT username FROM `non_members` WHERE non_members.id = new.non_member_id);
                    set @pajak = 0.0;
                    IF @verif = 0 THEN
                        set @pajak = 0.03;
                    ELSE
                        set @pajak = 0.025;
                    END IF;
                    set @ppn = @pajak * NEW.income;
                    IF new.status = 1 THEN
                        INSERT INTO history_pajak(`id_member`,`id_bonus`,`persentase`,`nominal`,`created_at`,`updated_at`)VALUES (NEW.member_id, 1, @pajak, @ppn, now(), now());
                        INSERT INTO history_bitrex_cash (`id_member`, `nominal`, `created_at`, `updated_at` , `description`, `info`, `type`) VALUES (NEW.member_id, NEW.income - @ppn, now(), now(), CONCAT("Bonus Sales Profit from ", @username), 1, 3);
                        UPDATE employeers SET bitrex_cash = bitrex_cash + (NEW.income + @ppn), updated_at = now() WHERE id = NEW.member_id;
                    END IF;
                END
        ');*/
    }
}
