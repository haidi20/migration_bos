<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function(Blueprint $table){
            $table->string('id')->primary();
            $table->text('ref_type');
            $table->string('ref_id');
            $table->integer('flow');
            $table->string('subject');
            $table->string('action_code');
            $table->string('action_from');
            $table->string('status_email')->default('pending');
            $table->string('status_android')->default('pending');
            $table->tinyInteger('type');
            $table->tinyInteger('approval_status');
            $table->string('user_id');
            $table->text('description');
            $table->tinyInteger('read')->default(0);
            $table->tinyInteger('isDelete')->default(0);
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
        Schema::dropIfExists('notification');
    }
}
