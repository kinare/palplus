<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['Group', 'User']);
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedInteger('currency_id');
            $table->decimal('total_balance', 8, 2)->default(0);
            $table->decimal('total_deposits', 8, 2)->default(0);;
            $table->decimal('total_withdrawals', 8, 2)->default(0);;
            $table->unsignedInteger('created_by')->nullable();
            $table->unsignedInteger('modified_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallets');
    }
}
