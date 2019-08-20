<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerUpgradeRank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_upgrade_rank AFTER UPDATE ON `pv_rank` 
            FOR EACH ROW BEGIN
            DECLARE sponsor int;
            set sponsor = (SELECT count(*) FROM `employeers` WHERE employeers.sponsor_id = new.id_member);
            IF new.pv_left >= 1000000 and new.pv_midle >= 1000000 and new.pv_right >= 1000000 and sponsor >= 21 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 8 WHERE new.id_member = employeers.id;
            ELSEIF new.pv_left >= 330000 and new.pv_midle >= 330000 and new.pv_right >= 330000 and sponsor >= 18 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 7 WHERE new.id_member = employeers.id;
            ELSEIF new.pv_left >= 110000 and new.pv_midle >= 110000 and new.pv_right >= 110000 and sponsor >= 15 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 6 WHERE new.id_member = employeers.id;
            ELSEIF new.pv_left >= 35000 and new.pv_midle >= 35000 and new.pv_right >= 35000 and sponsor >= 12 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 5 WHERE new.id_member = employeers.id;
            ELSEIF new.pv_left >= 12000 and new.pv_midle >= 12000 and new.pv_right >= 12000 and sponsor >= 9 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 4 WHERE new.id_member = employeers.id;
            ELSEIF new.pv_left >= 4000 and new.pv_midle >= 4000 and new.pv_right >= 4000 and sponsor >= 6 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 3 WHERE new.id_member = employeers.id;
            ELSEIF new.pv_left >= 1200 and new.pv_midle >= 1200 and new.pv_right >= 1200 and sponsor >= 3 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 2 WHERE new.id_member = employeers.id;
            ELSEIF new.pv_left >= 400 and new.pv_midle >= 400 and new.pv_right >= 400 and sponsor >= 1 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 1 WHERE new.id_member = employeers.id;
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
        DB::unprepared('DROP TRIGGER `tr_upgrade_rank`');
    }
}
