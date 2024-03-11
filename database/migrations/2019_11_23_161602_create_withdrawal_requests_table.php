<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('claimant_id');
            $table->unsignedBigInteger('leading_group_id');
            $table->unsignedBigInteger('amount');
            $table->boolean('processed')->default(false);
            $table->dateTime('processed_at')->nullable();
            $table->timestamps();

            $table->foreign('claimant_id')->on('users')->references('id')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('leading_group_id')->on('leading_groups')->references('id')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('withdrawal_requests', function (Blueprint $table) {
            $table->dropForeign(['claimant_id', 'leading_group_id']);
        });
        
        Schema::dropIfExists('withdrawal_requests');
    }
}
