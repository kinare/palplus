<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('group_id');
            $table->decimal('qualification_period', 8, 2);
            $table->decimal('repayment_period', 8, 2);
            $table->boolean('fixed_rate')->default(false);
            $table->decimal('limit_rate', 8,2)->nullable();
            $table->decimal('limit_amount', 8,2)->nullable();
            $table->decimal('interest_rate', 8,2)->default(0);
            $table->boolean('fixed_late_payment')->default(false);
            $table->decimal('late_payment_rate', 8,2)->nullable();
            $table->decimal('late_payment_amount', 8,2)->nullable();
            $table->boolean('show_loans');
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
        Schema::dropIfExists('loan_settings');
    }
}
