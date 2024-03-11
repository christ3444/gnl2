<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('beneficiary_id');
            $table->unsignedBigInteger('level_id');
            $table->unsignedBigInteger('godson_id')->nullable();
            $table->unsignedInteger('amount');
            $table->timestamps();

            $table->foreign('beneficiary_id')->on('users')->references('id')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('level_id')->on('levels')->references('id')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('godson_id')->on('users')->references('id')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropForeign(['beneficiary_id', 'level_id', 'godson_id']);
        });
        
        Schema::dropIfExists('bonuses');
    }
}
