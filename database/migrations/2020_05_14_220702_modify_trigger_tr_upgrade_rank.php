<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTriggerTrUpgradeRank extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('DROP TRIGGER `tr_upgrade_rank`');
        DB::unprepared("
        CREATE TRIGGER tr_upgrade_rank AFTER UPDATE ON `pv_rank` 
            FOR EACH ROW BEGIN
            DECLARE sponsor int;
            set time_zone = '+07:00';
            set sponsor = (SELECT count(id) FROM `employeers` WHERE employeers.sponsor_id = new.id_member);
            set @condition1 = (SELECT count(id) FROM `transaction_member` WHERE member_id = new.id_member);
            set @condition2 = (select count(id) from transaction_member where member_id IN(select id from employeers where sponsor_id = new.id_member));
            IF new.pv_left >= 1000000 and new.pv_midle >= 1000000 and new.pv_right >= 1000000 and sponsor >= 21 and @condition1 > 0 and @condition2 > 0  THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 8 WHERE new.id_member = employeers.id;
               	SET @rank = (SELECT count(id) FROM notification WHERE member_id = 1 and `desc` LIKE '%Chairman II%');
                IF @rank < 1 THEN
               		INSERT INTO `notification` (`id`, `title`, `desc`, `isRead`, `member_id`, `type`, `created_at`, `updated_at`, `send_email`) VALUES (NULL, 'Archive Rank', 'Telah Archive Rank Chairman II', '0', new.id_member, '1', now(), now(), '0'); 
                END IF;
            ELSEIF new.pv_left >= 330000 and new.pv_midle >= 330000 and new.pv_right >= 330000 and sponsor >= 18 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 7 WHERE new.id_member = employeers.id;
            	SET @rank = (SELECT count(id) FROM notification WHERE member_id = 1 and `desc` LIKE '%Chairman I%');
               	IF @rank < 1 THEN
               		INSERT INTO `notification` (`id`, `title`, `desc`, `isRead`, `member_id`, `type`, `created_at`, `updated_at`, `send_email`) VALUES (NULL, 'Archive Rank', 'Telah Archive Rank Chairman I', '0', new.id_member, '1', now(), now(), '0'); 
               	END IF;
            ELSEIF new.pv_left >= 110000 and new.pv_midle >= 110000 and new.pv_right >= 110000 and sponsor >= 15 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 6 WHERE new.id_member = employeers.id;
            	SET @rank = (SELECT count(id) FROM notification WHERE member_id = 1 and `desc` LIKE '%Director III%');
               	IF @rank < 1 THEN
               		INSERT INTO `notification` (`id`, `title`, `desc`, `isRead`, `member_id`, `type`, `created_at`, `updated_at`, `send_email`) VALUES (NULL, 'Archive Rank', 'Telah Archive Rank Director III', '0', new.id_member, '1', now(), now(), '0'); 
               	END IF;
            ELSEIF new.pv_left >= 35000 and new.pv_midle >= 35000 and new.pv_right >= 35000 and sponsor >= 12 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 5 WHERE new.id_member = employeers.id;
            	SET @rank = (SELECT count(id) FROM notification WHERE member_id = 1 and `desc` LIKE '%Director II%');
               	IF @rank < 1 THEN
               		INSERT INTO `notification` (`id`, `title`, `desc`, `isRead`, `member_id`, `type`, `created_at`, `updated_at`, `send_email`) VALUES (NULL, 'Archive Rank', 'Telah Archive Rank Director II', '0', new.id_member, '1', now(), now(), '0'); 
               	END IF;
            ELSEIF new.pv_left >= 12000 and new.pv_midle >= 12000 and new.pv_right >= 12000 and sponsor >= 9 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 4 WHERE new.id_member = employeers.id;
            	SET @rank = (SELECT count(id) FROM notification WHERE member_id = 1 and `desc` LIKE '%Director I%');
               	IF @rank < 1 THEN
               		INSERT INTO `notification` (`id`, `title`, `desc`, `isRead`, `member_id`, `type`, `created_at`, `updated_at`, `send_email`) VALUES (NULL, 'Archive Rank', 'Telah Archive Rank Director I', '0', new.id_member, '1', now(), now(), '0'); 
               	END IF;
            ELSEIF new.pv_left >= 4000 and new.pv_midle >= 4000 and new.pv_right >= 4000 and sponsor >= 6 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 3 WHERE new.id_member =  employeers.id;
            	SET @rank = (SELECT count(id) FROM notification WHERE member_id = 1 and `desc` LIKE '%Platinum III%');
               	IF @rank < 1 THEN
               		INSERT INTO `notification` (`id`, `title`, `desc`, `isRead`, `member_id`, `type`, `created_at`, `updated_at`, `send_email`) VALUES (NULL, 'Archive Rank', 'Telah Archive Rank Platinum III', '0', new.id_member, '1', now(), now(), '0'); 
               	END IF;
            ELSEIF new.pv_left >= 1200 and new.pv_midle >= 1200 and new.pv_right >= 1200 and sponsor >= 3 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 2 WHERE new.id_member = employeers.id;
            	SET @rank = (SELECT count(id) FROM notification WHERE member_id = 1 and `desc` LIKE '%Platinum II%');
                IF @rank < 1 THEN
               		INSERT INTO `notification` (`id`, `title`, `desc`, `isRead`, `member_id`, `type`, `created_at`, `updated_at`, `send_email`) VALUES (NULL, 'Archive Rank', 'Telah Archive Rank Platinum II', '0', new.id_member, '1', now(), now(), '0'); 
               	END IF;
            ELSEIF new.pv_left >= 400 and new.pv_midle >= 400 and new.pv_right >= 400 and sponsor >= 1 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 1 WHERE new.id_member = employeers.id;
               	SET @rank = (SELECT count(id) FROM notification WHERE member_id = 1 and `desc` LIKE '%Platinum I%');
               	IF @rank < 1 THEN
               		INSERT INTO `notification` (`id`, `title`, `desc`, `isRead`, `member_id`, `type`, `created_at`, `updated_at`, `send_email`) VALUES (NULL, 'Archive Rank', 'Telah Archive Rank Platinum I', '0', new.id_member, '1', now(), now(), '0'); 
               	END IF;
            END IF;
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        DB::unprepared('DROP TRIGGER `tr_upgrade_rank`');
        DB::unprepared('
        CREATE TRIGGER tr_upgrade_rank AFTER UPDATE ON `pv_rank` 
            FOR EACH ROW BEGIN
            DECLARE sponsor int;
            set time_zone = "+07:00";
            set sponsor = (SELECT count(id) FROM `employeers` WHERE employeers.sponsor_id = new.id_member);
            set @condition1 = (SELECT count(id) FROM `transaction_member` WHERE member_id = new.id_member);
            set @condition2 = (select count(id) from transaction_member where member_id IN(select id from employeers where sponsor_id = new.id_member));
            IF new.pv_left >= 1000000 and new.pv_midle >= 1000000 and new.pv_right >= 1000000 and sponsor >= 21 and @condition1 > 0 and @condition2 > 0  THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 8 WHERE new.id_member = employeers.id;
            ELSEIF new.pv_left >= 330000 and new.pv_midle >= 330000 and new.pv_right >= 330000 and sponsor >= 18 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 7 WHERE new.id_member = employeers.id;
            ELSEIF new.pv_left >= 110000 and new.pv_midle >= 110000 and new.pv_right >= 110000 and sponsor >= 15 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 6 WHERE new.id_member = employeers.id;
            ELSEIF new.pv_left >= 35000 and new.pv_midle >= 35000 and new.pv_right >= 35000 and sponsor >= 12 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 5 WHERE new.id_member = employeers.id;
            ELSEIF new.pv_left >= 12000 and new.pv_midle >= 12000 and new.pv_right >= 12000 and sponsor >= 9 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 4 WHERE new.id_member = employeers.id;
            ELSEIF new.pv_left >= 4000 and new.pv_midle >= 4000 and new.pv_right >= 4000 and sponsor >= 6 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 3 WHERE new.id_member =  employeers.id;
            ELSEIF new.pv_left >= 1200 and new.pv_midle >= 1200 and new.pv_right >= 1200 and sponsor >= 3 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 2 WHERE new.id_member = employeers.id;
            ELSEIF new.pv_left >= 400 and new.pv_midle >= 400 and new.pv_right >= 400 and sponsor >= 1 and @condition1 > 0 and @condition2 > 0 THEN
                UPDATE employeers SET updated_at = now(), employeers.rank_id = 1 WHERE new.id_member = employeers.id;
            END IF;
            END
        ');
    }
}
