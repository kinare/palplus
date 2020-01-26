<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_code')->nullable();
            $table->unsignedInteger('wallet_id');
            $table->enum('entry', array('debit', 'credit'));
            $table->string('transaction_from')->nullable();
            $table->string('transaction_to')->nullable();
            $table->enum('transaction_type', ['internal', 'external']);
            $table->string('account_no')->nullable();
            $table->string('type')->nullable();
            $table->string('description')->nullable();
            $table->string('model')->nullable();
            $table->unsignedInteger('model_id')->nullable();
            $table->decimal('amount',8, 2);
            $table->string('from_currency')->nullable();
            $table->string('to_currency')->nullable();
            $table->string('conversion_rate')->nullable();
            $table->dateTime('conversion_time')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
