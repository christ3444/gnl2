<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelCrossingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('level_crossings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('level_id');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('level_id')->on('levels')->references('id')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('level_crossings', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'level_id']);
        });
        
        Schema::dropIfExists('level_crossings');
    }
}
