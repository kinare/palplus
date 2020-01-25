<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGatewaySetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateway_setups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', ['withdrawal', 'deposit']);
            $table->string('gateway');
            $table->decimal('rate', 8, 0)->default(0);
            $table->decimal('min_amount', 8, 0)->default(0);
            $table->decimal('max_amount', 8, 0)->default(0);
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('gateway_setups');
    }
}
