<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->unsignedInteger('account_type_id');
            $table->string('number');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('currency')->nullable();
            $table->string('country')->nullable();
            $table->string('cvv')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('accountbank')->nullable();
            $table->string('passcode')->nullable();
            $table->string('bvn')->nullable();
            $table->string('expirymonth')->nullable();
            $table->string('expiryyear')->nullable();
            $table->string('billingzip')->nullable();
            $table->string('billingcity')->nullable();
            $table->string('billingaddress')->nullable();
            $table->string('billingstate')->nullable();
            $table->string('billingcountry')->nullable();
            $table->string('beneficiary')->nullable();
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
        Schema::dropIfExists('accounts');
    }
}
