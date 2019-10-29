<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('activity_type_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('itinerary')->nullable();
            $table->string('contacts')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->dateTime('cut_off_date')->nullable();
            $table->unsignedInteger('slots')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('booking_fee')->nullable();
            $table->boolean('installments')->nullable();
            $table->unsignedInteger('no_of_installments')->nullable();
            $table->decimal('booking_fee_amount', 8, 2)->nullable();
            $table->decimal('instalment_amount', 8, 2)->nullable();
            $table->decimal('total_cost', 8, 2)->nullable();
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
        Schema::dropIfExists('group_activities');
    }
}
