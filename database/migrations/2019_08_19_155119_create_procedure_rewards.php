<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureRewards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(' 
            CREATE PROCEDURE add_pv_reward(idm INT, pv INT)
            BEGIN
                DECLARE parent, cek int;
                SET max_sp_recursion_depth=255;
                set parent = (select parent_id from `employeers` where id = idm);
                set cek = (select sum(id_member) from pv_rewards where id_member = parent);
                IF parent is not null THEN
                    IF cek is null THEN
                        IF (select position from `employeers` where id = idm) = 0 THEN
                            INSERT INTO pv_rewards (`pv_left`, `pv_midle`, `pv_right`, `id_member`, `created_at` , `updated_at`) VALUES (pv,0,0,parent, now(), now());
                        ELSEIF (select position from `employeers` where id = idm) = 1 THEN
                            INSERT INTO pv_rewards (`pv_left`, `pv_midle`, `pv_right`, `id_member`, `created_at` , `updated_at`) VALUES (0,pv,0,parent, now(), now());
                        ELSEIF (select position from `employeers` where id = idm) = 2 THEN
                            INSERT INTO pv_rewards (`pv_left`, `pv_midle`, `pv_right`, `id_member`, `created_at` , `updated_at`) VALUES (0,0,pv,parent, now(), now());
                        END IF;
                    ELSE
                        IF (select position from `employeers` where id = idm) = 0 THEN
                            UPDATE pv_rewards SET updated_at = now(), pv_left = pv_left + pv WHERE id_member = parent;
                        ELSEIF (select position from `employeers` where id = idm) = 1 THEN
                            UPDATE pv_rewards SET updated_at = now(), pv_midle = pv_midle + pv WHERE id_member = parent;
                        ELSEIF (select position from `employeers` where id = idm) = 2 THEN
                            UPDATE pv_rewards SET updated_at = now(), pv_right = pv_right + pv WHERE id_member = parent;
                        END IF;
                    END IF;
                    call add_pv_reward(parent, pv);  
                END IF;
            END
        ');

        DB::unprepared('
        CREATE TRIGGER tr_add_pv_reward AFTER INSERT ON `history_pv` 
            FOR EACH ROW BEGIN
                call add_pv_reward(NEW.id_member, NEW.pv_today);
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
        DB::unprepared('DROP PROCEDURE add_pv_reward');
        DB::unprepared('DROP TRIGGER `tr_add_pv_reward`');
    }
}
