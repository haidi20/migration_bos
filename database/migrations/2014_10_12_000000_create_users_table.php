<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('fullname');
            $table->string('id_card');
            $table->string('phone');
            $table->text('address');
            $table->string('type');
            $table->string('level');
            $table->string('password');
            $table->rememberToken();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('isDelete')->default(0);
            $table->datetime('last_login');
            $table->datetime('last_logout')->nullable();
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
        Schema::dropIfExists('users');
    }
}
