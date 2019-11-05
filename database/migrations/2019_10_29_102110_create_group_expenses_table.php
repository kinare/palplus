<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_expenses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('activity_id');
            $table->unsignedInteger('supplier_id')->nullable();
            $table->dateTime('date');
            $table->string('description')->nullable();
            $table->string('location')->nullable();
            $table->decimal('amount', 8, 2);
            $table->string('document_no')->nullable();
            $table->decimal('total', 8, 2);
            $table->binary('photo')->nullable();
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
        Schema::dropIfExists('group_expenses');
    }
}
