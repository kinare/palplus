<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalApprovalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawal_approval_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('withdrawal_id');
            $table->unsignedInteger('approver_id');
            $table->enum('status', ['pending', 'processing', 'approved', 'declined'])->default('pending');
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
        Schema::dropIfExists('withdrawal_approval_entries');
    }
}
