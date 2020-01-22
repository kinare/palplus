<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('avatar')->nullable();
            $table->enum('access_level', ['public', 'private'])->default('public');
            $table->string('country');
            $table->decimal('target_amount', 8, 2)->nullable();
            $table->unsignedInteger('currency_id');
            $table->unsignedInteger('type_id');
            $table->unsignedInteger('setting_id')->nullable();
            $table->unsignedInteger('loan_setting_id')->nullable();
            $table->unsignedInteger('withdrawal_setting_id')->nullable();
            $table->unsignedInteger('wallet_id')->nullable();
            $table->boolean('active')->default(true);
            $table->string('reasons')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended', 'closed'])->default('active');
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
        Schema::dropIfExists('groups');
    }
}
