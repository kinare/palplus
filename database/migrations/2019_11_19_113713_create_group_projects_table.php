<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('group_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('estimated_cost', 8,2)->nullable();;
            $table->decimal('actual_cost', 8, 2)->nullable();;
            $table->date('start_date')->nullable();;
            $table->date('end_date')->nullable();;
            $table->string('location')->nullable();;
            $table->boolean('allow_contributions')->default(false);
            $table->decimal('contribution_amount', 8, 2)->nullable();;
            $table->unsignedInteger('contribution_frequency')->nullable();;
            $table->boolean('enable_reminders')->default(false);
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
        Schema::dropIfExists('group_projects');
    }
}
