<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditTriggerBonusAddLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bonus_sponsor_from_member_tf_langsung`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bonus_sponsor_from_member`');

        DB::unprepared('
        CREATE TRIGGER tr_bonus_sponsor_from_member_tf_langsung AFTER INSERT ON `transaction_member` 
            FOR EACH ROW BEGIN
                DECLARE bonus_bv decimal(15, 0);
                DECLARE bonus_pv, sponsor, pv_now, is_promo, discount, price_ebook integer;
                set is_promo = (SELECT count(id) FROM `transaction_members_promotion` WHERE `member_id` = NEW.member_id AND `ebook_id` = NEW.ebook_id AND type = "member");
                SET sponsor = (SELECT sponsor_id FROM `employeers` WHERE id = NEW.member_id);
                SET bonus_bv = (SELECT bv FROM `ebooks` WHERE id = NEW.ebook_id);
                SET bonus_pv = (SELECT pv FROM `ebooks` WHERE id = NEW.ebook_id);
                set @verif = (SELECT verification FROM `employeers` WHERE employeers.id = sponsor);
                set @username = (SELECT username FROM `employeers` WHERE employeers.id = new.member_id);
                set @pajak = 0.0;
                SET @ebookmember = (SELECT count(id) FROM `transaction_member` WHERE member_id = new.member_id and status = 1);
                SET @ebooknonmember = (SELECT count(id) FROM `transaction_non_members` WHERE member_id = new.member_id and status = 1);
                SET price_ebook = (SELECT price FROM `ebooks` WHERE id = NEW.ebook_id);
                IF is_promo > 0 THEN
                    SET discount = (SELECT price_discount
            FROM `ebooks` WHERE id = NEW.ebook_id);
                    SET bonus_bv = bonus_bv * (discount / 100);
                    SET bonus_pv = bonus_pv * (discount / 100);
                ELSE
                    SET bonus_bv = (SELECT bv FROM `ebooks` WHERE id = NEW.ebook_id);
                    SET bonus_pv = (SELECT pv FROM `ebooks` WHERE id = NEW.ebook_id);
                END IF;
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
                    INSERT INTO history_pv (`pv`, `pv_today`, `id_member`, `created_at`, `updated_at`) VALUES (pv_now , bonus_pv, NEW.member_id, now(), now());

                    IF is_promo > 0 THEN
                        INSERT INTO `transaction_member_histories` (`transaction_id`, `pv`, `bv`, `discount`, `price_discount`, `price`, `created_at`, `updated_at`) VALUES(
                            NEW.id, bonus_pv, (bonus_bv * 0.2 - @ppn), discount, ((price_ebook * discount) / 100), price_ebook, now(), now()
                        );
                        DELETE FROM `transaction_members_promotion` WHERE `member_id` = NEW.member_id AND `ebook_id` = NEW.ebook_id AND type = "member";
                    ELSE
                        INSERT INTO `transaction_member_histories` (`transaction_id`, `pv`, `bv`, `discount`, `price_discount`, `price`, `created_at`, `updated_at`) VALUES(
                            NEW.id, bonus_pv, (bonus_bv * 0.2 - @ppn), 0, 0, price_ebook, now(), now()
                        );
                    END IF;

                    IF (SELECT count(id) FROM `transaction_member` WHERE member_id = new.member_id and status = 1) > 1 OR (SELECT count(id) FROM `transaction_non_members` WHERE member_id = new.member_id and status = 1) > 1 THEN
                        set @inter = bonus_pv/25; 
                        UPDATE employeers SET expired_at = expired_at + INTERVAL @inter YEAR WHERE id = NEW.member_id;
                    END IF;
                END IF;
            END
        ');

        DB::unprepared('
        CREATE TRIGGER tr_bonus_sponsor_from_member AFTER UPDATE ON `transaction_member` 
            FOR EACH ROW BEGIN
                DECLARE bonus_bv decimal(15, 0);
                DECLARE bonus_pv, sponsor, pv_now, is_promo, discount, price_ebook integer;
                set is_promo = (SELECT count(id) FROM `transaction_members_promotion` WHERE `member_id` = NEW.member_id AND `ebook_id` = NEW.ebook_id AND type = "member");
                SET sponsor = (SELECT sponsor_id FROM `employeers` WHERE id = NEW.member_id);
                SET bonus_bv = (SELECT bv FROM `ebooks` WHERE id = NEW.ebook_id);
                SET bonus_pv = (SELECT pv FROM `ebooks` WHERE id = NEW.ebook_id);
                set @verif = (SELECT verification FROM `employeers` WHERE employeers.id = sponsor);
                set @username = (SELECT username FROM `employeers` WHERE employeers.id = new.member_id);
                set @pajak = 0.0;
                SET @ebookmember = (SELECT count(id) FROM `transaction_member` WHERE member_id = new.member_id and status = 1);
                SET @ebooknonmember = (SELECT count(id) FROM `transaction_non_members` WHERE member_id = new.member_id and status = 1);
                SET price_ebook = (SELECT price FROM `ebooks` WHERE id = NEW.ebook_id);
                IF is_promo > 0 THEN
                    SET discount = (SELECT price_discount
            FROM `ebooks` WHERE id = NEW.ebook_id);
                    SET bonus_bv = bonus_bv * (discount / 100);
                    SET bonus_pv = bonus_pv * (discount / 100);
                ELSE
                    SET bonus_bv = (SELECT bv FROM `ebooks` WHERE id = NEW.ebook_id);
                    SET bonus_pv = (SELECT pv FROM `ebooks` WHERE id = NEW.ebook_id);
                END IF;
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
                    INSERT INTO history_pv (`pv`, `pv_today`, `id_member`, `created_at`, `updated_at`) VALUES (pv_now , bonus_pv, NEW.member_id, now(), now());

                    IF is_promo > 0 THEN
                        INSERT INTO `transaction_member_histories` (`transaction_id`, `pv`, `bv`, `discount`, `price_discount`, `price`, `created_at`, `updated_at`) VALUES(
                            NEW.id, bonus_pv, (bonus_bv * 0.2 - @ppn), discount, ((price_ebook * discount) / 100), price_ebook, now(), now()
                        );
                        DELETE FROM `transaction_members_promotion` WHERE `member_id` = NEW.member_id AND `ebook_id` = NEW.ebook_id AND type = "member";
                    ELSE
                        INSERT INTO `transaction_member_histories` (`transaction_id`, `pv`, `bv`, `discount`, `price_discount`, `price`, `created_at`, `updated_at`) VALUES(
                            NEW.id, bonus_pv, (bonus_bv * 0.2 - @ppn), 0, 0, price_ebook, now(), now()
                        );
                    END IF;

                    IF (SELECT count(id) FROM `transaction_member` WHERE member_id = new.member_id and status = 1) > 1 OR (SELECT count(id) FROM `transaction_non_members` WHERE member_id = new.member_id and status = 1) > 1 THEN
                        set @inter = bonus_pv/25; 
                        UPDATE employeers SET expired_at = expired_at + INTERVAL @inter YEAR WHERE id = NEW.member_id;
                    END IF;
                END IF;
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
        //
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bonus_sponsor_from_member_tf_langsung`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bonus_sponsor_from_member`');
    }
}
