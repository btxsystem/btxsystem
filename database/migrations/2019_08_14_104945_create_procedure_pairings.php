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
        DB::unprepared(' 
            CREATE PROCEDURE add_pv_pairing(idm INT, pv INT)
            BEGIN
                DECLARE parent, position, cek INT;
                SET max_sp_recursion_depth=255;
                set parent = (select parent_id from `employeers` where id = idm);
                set position = (select position from `employeers` where id = idm);
                IF parent is not null THEN
                    IF position = 0 THEN
                        INSERT INTO pairings (`pv_left`, `pv_midle`, `pv_right`, `id_member`, `created_at` , `updated_at`) VALUES (pv,0,0,parent, now(), now());
                    ELSEIF position = 1 THEN
                        INSERT INTO pairings (`pv_left`, `pv_midle`, `pv_right`, `id_member`, `created_at` , `updated_at`) VALUES (0,pv,0,parent, now(), now());
                    ELSEIF position = 2 THEN
                        INSERT INTO pairings (`pv_left`, `pv_midle`, `pv_right`, `id_member`, `created_at` , `updated_at`) VALUES (0,0,parent,pv, now(), now());
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
