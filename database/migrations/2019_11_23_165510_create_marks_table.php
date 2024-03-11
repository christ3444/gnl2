<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('action_id');
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('action_id')->on('actions')->references('id')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('marks', function (Blueprint $table) {
            $table->dropForeign(['user_id', 'action_id']);
        });

        Schema::dropIfExists('marks');
    }
}
