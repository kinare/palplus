<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_setups', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedInteger('user_id');
			$table->decimal('total_withdrawal', 15, 0)->default(10);
			$table->decimal('balance_to_withdrawal', 15, 0)->default(10);
			$table->decimal('maximum_withdrawal_amount', 15, 0)->default(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_setups');
    }
}
