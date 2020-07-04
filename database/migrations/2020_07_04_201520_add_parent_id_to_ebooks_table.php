<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentIdToEbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ebooks', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('parent_id')->default("0")->after("id");
            $table->string('type', 50)->nullable()->after("price_markup");
            $table->dateTime('started_at')->nullable()->after("type");
            $table->dateTime('ended_at')->nullable()->after("started_at");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ebooks', function (Blueprint $table) {
            //
            $table->dropColumn('parent_id');
            $table->dropColumn('type');
            $table->dropColumn('started_at');
            $table->dropColumn('ended_at');
        });
    }
}
