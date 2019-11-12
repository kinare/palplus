<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contribution_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('contribution_periods_id');
            $table->unsignedInteger('contribution_categories_id');
            $table->unsignedInteger('activity_id')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('amount', 8, 2);
            $table->decimal('target_amount', 8, 2);
            $table->decimal('balance', 8, 2)->nullable();
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
        Schema::dropIfExists('contribution_types');
    }
}
