<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function( Blueprint $table ){
            $table->string('id')->primary();
            $table->string('name');
            $table->string('type', 50);
            $table->string('path');
            $table->string('ref_type');
            $table->string('ref_id');
            $table->string('field');
            $table->text('attribute');
            $table->timestamps();
        });

        Schema::create('group_access', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('group_id');
            $table->string('module');
            $table->text('hierarchy');
            $table->text('actions');
        });

        Schema::create('group_members', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('group_id');
            $table->string('user_id');
        });

        Schema::create('items', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('name');
            $table->string('code');
            $table->integer('price_estimate');
            $table->text('description');
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('isDelete')->default(0);
        });

        Schema::create('logs', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('in_url');
            $table->string('action');
            $table->tinyInteger('step');
            $table->tinyInteger('progress');
            $table->string('open_from');
            $table->text('description');
            $table->text('input');
            $table->text('reason');
            $table->string('ref_type');
            $table->string('ref_id');
            $table->string('ref_sub_id');
            $table->tinyInteger('isFile');
            $table->string('user_id');
            $table->string('ip_address');
            $table->timestamps();
        });

        Schema::create('ownership', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->text('description');
            $table->tinyInteger('isDelete')->default(0);
        });

        Schema::create('projects', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('name');
            $table->string('code');
            $table->text('location');
            $table->tinyInteger('isDelete')->default(0);
        });

        Schema::create('purchase_requisition', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('pr_number');
            $table->string('ownership_id');
            $table->string('project_id');
            $table->string('project_type_id');
            $table->date('date');
            $table->text('purpose');
            $table->text('description');
            $table->string('author');
            $table->tinyInteger('isDelete')->default(0);
            $table->timestamps();
        });

        Schema::create('purchase_requisition_detail', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('pr_id');
            $table->string('item_id');
            $table->string('unit_id');
            $table->float('quantity', 10, 2);
            $table->string('user_id');
            $table->text('reason');
            $table->timestamps();
        });

        Schema::create('settings', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('key');
            $table->text('value');
        });

        Schema::create('units', function($table){
            $table->string('id')->primary();
            $table->string('name');
            $table->tinyInteger('isDelete')->default(0);
        });

        Schema::create('user_groups', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('name');
            $table->tinyInteger('img_type');
            $table->string('img_group', 20);
            $table->tinyInteger('isDelete')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
        Schema::dropIfExists('group_access');
        Schema::dropIfExists('group_members');
        Schema::dropIfExists('items');
        Schema::dropIfExists('logs');
        Schema::dropIfExists('ownership');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('purchase_requisition');
        Schema::dropIfExists('purchase_requisition_detail');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('units');
        Schema::dropIfExists('user_groups');
    }
}
