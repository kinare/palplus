<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanApprovalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_approval_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('loan_id');
            $table->unsignedInteger('approver_id');
            $table->enum('status', ['pending', 'processing', 'approved', 'rejected', 'cleared'])->default('pending');
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
        Schema::dropIfExists('loan_approval_entries');
    }
}
