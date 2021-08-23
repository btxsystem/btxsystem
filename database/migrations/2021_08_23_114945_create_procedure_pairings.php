<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedurePairings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS `add_pv_pairing`');
        DB::unprepared('DROP TRIGGER IF EXISTS `tr_bonus_pairing`');
        DB::unprepared('
            CREATE PROCEDURE add_pv_pairing(idm INT, pv INT)
            BEGIN
                DECLARE parent, cek, cek_rank, max_pv, total_pv int;
                SET max_sp_recursion_depth=10000;
                set parent = (select parent_id from `employeers` where id = idm);
                set cek = (select sum(id_member) from pairings where id_member = parent);
                set cek_rank = (select count(ebook.pv) from ebook INNER JOIN transaction_member ON ebook.id = transaction_member.ebook_id where transaction_member.id_member = parent);
                set time_zone = "+07:00";
                set max_pv = 0;
                set total_pv = 0;
                IF (select position from `employeers` where id = idm) = 0 THEN
                    set total_pv = (select sum(`left`) from history_pv_pairing where id_member = parent AND DATE(created_at) >= CURDATE());
                ELSEIF (select position from `employeers` where id = idm) = 1 THEN
                    set total_pv = (select sum(`midle`) from history_pv_pairing where id_member = parent AND DATE(created_at) >= CURDATE());
                ELSEIF (select position from `employeers` where id = idm) = 2 THEN
                    set total_pv = (select sum(`right`) from history_pv_pairing where id_member = parent AND DATE(created_at) >= CURDATE());
                END IF;
                IF cek_rank < 100 and total_pv < 50 THEN
                    set max_pv = total_pv + 50;
                    IF max_pv > 50 THEN set pv = 50;
                    END IF;
                ELSEIF cek_rank < 200 and total_pv < 100 THEN
                    set max_pv = total_pv + 100;
                    IF max_pv > 100 THEN set pv = 100;
                    END IF;
                ELSEIF cek_rank >= 200 and total_pv < 200 THEN
                    set max_pv = total_pv + 200;
                    IF max_pv > 200 THEN set pv = 200;
                    END IF;
                END IF;
                IF parent is not null THEN
                    IF cek is null THEN
                        IF (select position from `employeers` where id = idm) = 0 THEN
                            INSERT INTO pairings (`pv_left`, `pv_midle`, `pv_right`, `id_member`, `created_at` , `updated_at`) VALUES (pv,0,0,parent, now(), now());
                        ELSEIF (select position from `employeers` where id = idm) = 1 THEN
                            INSERT INTO pairings (`pv_left`, `pv_midle`, `pv_right`, `id_member`, `created_at` , `updated_at`) VALUES (0,pv,0,parent, now(), now());
                        ELSEIF (select position from `employeers` where id = idm) = 2 THEN
                            INSERT INTO pairings (`pv_left`, `pv_midle`, `pv_right`, `id_member`, `created_at` , `updated_at`) VALUES (0,0,pv,parent, now(), now());
                        END IF;
                    ELSE
                        IF (select position from `employeers` where id = idm) = 0 THEN
                            UPDATE pairings SET updated_at = now(), pv_left = pv_left + pv WHERE id_member = parent;
                        ELSEIF (select position from `employeers` where id = idm) = 1 THEN
                            UPDATE pairings SET updated_at = now(), pv_midle = pv_midle + pv WHERE id_member = parent;
                        ELSEIF (select position from `employeers` where id = idm) = 2 THEN
                            UPDATE pairings SET updated_at = now(), pv_right = pv_right + pv WHERE id_member = parent;
                        END IF;
                    END IF;
                    call add_pv_pairing(parent, pv);
                END IF;
            END
        ');

        DB::unprepared('
        CREATE TRIGGER tr_bonus_pairing AFTER INSERT ON `history_pv`
            FOR EACH ROW BEGIN
                call add_pv_pairing(NEW.id_member, NEW.pv_today);
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
        DB::unprepared('DROP PROCEDURE add_pv_pairing');
        DB::unprepared('DROP TRIGGER `tr_bonus_pairing`');
    }
}
