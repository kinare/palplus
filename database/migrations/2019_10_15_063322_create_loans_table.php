<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->unsignedInteger('member_id');
            $table->unsignedInteger('group_id');
            $table->enum('status', ['pending', 'processing', 'approved', 'declined', 'cleared'])->default('pending');
            $table->unsignedInteger('approvals')->default(0);
            $table->decimal('payment_period', 8,2);
            $table->decimal('loan_amount',8, 2);
            $table->decimal('paid_amount',8, 2)->default(0);
            $table->decimal('balance_amount',8, 2)->default(0);
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('overdue')->default(false);
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
        Schema::dropIfExists('loans');
    }
}
