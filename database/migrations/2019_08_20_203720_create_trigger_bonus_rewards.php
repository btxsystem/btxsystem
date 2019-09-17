<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerBonusRewards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_bonus_reward AFTER INSERT ON `pv_rewards` 
            FOR EACH ROW BEGIN
                set @rank = (SELECT rank_id FROM `employeers` WHERE employeers.id = new.id_member);
                set @result = (SELECT count(*) FROM `got_rewards` WHERE got_rewards.member_id = new.id_member);
                set time_zone = "+07:00";
                IF new.pv_left >= 1000000 and new.pv_midle >= 1000000 and new.pv_right >= 1000000 and @rank = 8 and MOD(@result, 8) = 7 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 8, now(), now());
                    UPDATE pv_rewards SET updated_at = now(), pv_rewards.pv_left = pv_rewards.pv_left - 1000000, pv_rewards.pv_midle = pv_rewards.pv_midle - 1000000 , pv_rewards.pv_right = pv_rewards.pv_right - 1000000  WHERE pv_rewards.id_member = new.id_member;
                IF new.pv_left >= 330000 and new.pv_midle >= 330000 and new.pv_right >= 330000 and @rank >= 7 and MOD(@result, 8) = 6  THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 7, now(), now());
                IF new.pv_left >= 110000 and new.pv_midle >= 110000 and new.pv_right >= 110000 and @rank >= 6 and MOD(@result, 8) = 5 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 6, now(), now());
                IF new.pv_left >= 35000 and new.pv_midle >= 35000 and new.pv_right >= 35000 and @rank >= 5 and MOD(@result, 8) = 4 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 5, now(), now());
                IF new.pv_left >= 12000 and new.pv_midle >= 12000 and new.pv_right >= 12000 and @rank >= 4 and MOD(@result, 8) = 3 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 4, now(), now());
                IF new.pv_left >= 4000 and new.pv_midle >= 4000 and new.pv_right >= 4000 and @rank >= 3 and MOD(@result, 8) = 2 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 3, now(), now());
                IF new.pv_left >= 1200 and new.pv_midle >= 1200 and new.pv_right >= 1200 and @rank >= 2 and MOD(@result, 8) = 1 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 2, now(), now());
                IF new.pv_left >= 400 and new.pv_midle >= 400 and new.pv_right >= 400 and @rank >= 1 and MOD(@result, 8) = 0 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 1, now(), now());
                END IF;
            END
        ');

        DB::unprepared('
        CREATE TRIGGER tr_bonus_reward2 AFTER UPDATE ON `pv_rewards` 
            FOR EACH ROW BEGIN
                set @rank = (SELECT rank_id FROM `employeers` WHERE employeers.id = new.id_member);
                set @result = (SELECT count(*) FROM `got_rewards` WHERE got_rewards.member_id = new.id_member);
                IF new.pv_left >= 1000000 and new.pv_midle >= 1000000 and new.pv_right >= 1000000 and @rank = 8 and MOD(@result, 8) = 7 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 8, now(), now());
                    UPDATE pv_rewards SET updated_at = now(), pv_rewards.pv_left = pv_rewards.pv_left - 1000000, pv_rewards.pv_midle = pv_rewards.pv_midle - 1000000 , pv_rewards.pv_right = pv_rewards.pv_right - 1000000  WHERE pv_rewards.id_member = new.id_member;
                ELSEIF new.pv_left >= 330000 and new.pv_midle >= 330000 and new.pv_right >= 330000 and @rank >= 7 and MOD(@result, 8) = 6  THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 7, now(), now());
                ELSEIF new.pv_left >= 110000 and new.pv_midle >= 110000 and new.pv_right >= 110000 and @rank >= 6 and MOD(@result, 8) = 5 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 6, now(), now());
                ELSEIF new.pv_left >= 35000 and new.pv_midle >= 35000 and new.pv_right >= 35000 and @rank >= 5 and MOD(@result, 8) = 4 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 5, now(), now());
                ELSEIF new.pv_left >= 12000 and new.pv_midle >= 12000 and new.pv_right >= 12000 and @rank >= 4 and MOD(@result, 8) = 3 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 4, now(), now());
                ELSEIF new.pv_left >= 4000 and new.pv_midle >= 4000 and new.pv_right >= 4000 and @rank >= 3 and MOD(@result, 8) = 2 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 3, now(), now());
                ELSEIF new.pv_left >= 1200 and new.pv_midle >= 1200 and new.pv_right >= 1200 and @rank >= 2 and MOD(@result, 8) = 1 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 2, now(), now());
                ELSEIF new.pv_left >= 400 and new.pv_midle >= 400 and new.pv_right >= 400 and @rank >= 1 and MOD(@result, 8) = 0 THEN
                    INSERT INTO got_rewards (`member_id`, `reward_id`,  `created_at`, `updated_at`) VALUES (new.id_member, 1, now(), now());
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
        DB::unprepared('DROP TRIGGER `tr_bonus_reward`');
        DB::unprepared('DROP TRIGGER `tr_bonus_reward2`');
    }
}
