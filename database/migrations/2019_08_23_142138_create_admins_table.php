<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->enum('access_type', array('viewer', 'editor'))->default('viewer');
            $table->string('invitation_token')->nullable();
            $table->dateTime('wef')->nullable();
            $table->dateTime('wet')->nullable();
            $table->string('avatar')->default('avatar.png');
            $table->boolean('phone_verified')->unique()->nullable();
            $table->dateTime('phone_verified_at')->unique()->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('email_verified')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
