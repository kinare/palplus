<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('activity_id');
            $table->string('name');
            $table->string('location')->nullable();
            $table->string('description')->nullable();
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('amount_paid', 8, 2);
            $table->decimal('amount_pending', 8, 2);
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
        Schema::dropIfExists('suppliers');
    }
}
