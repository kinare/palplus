<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('group_id');
            $table->boolean('membership_fee')->default(false);
            $table->decimal('membership_fee_amount', 8, 2)->default(0);
            $table->boolean('contributions')->default(false);
            $table->unsignedInteger('contribution_periods_id')->nullable();
            $table->decimal('contribution_amount', 8, 2)->nullable();
            $table->boolean('send_reminders')->default(false);
            $table->boolean('fixed_late_penalty')->default(false);
            $table->decimal('late_penalty_rate', 8, 2)->default(0);
            $table->decimal('late_penalty_amount', 8, 2)->default(0);
            $table->decimal('leaving_group_fee', 8, 2)->default(0);
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
        Schema::dropIfExists('group_settings');
    }
}
