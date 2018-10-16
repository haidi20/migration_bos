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
        Schema::create('accounts', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('parent_id');
            $table->string('code');
            $table->string('name');
            $table->text('description');
            $table->tinyInteger('checklist')->default(0);
            $table->tinyInteger('isDelete')->default(0);
        });

        Schema::create('authorities', function(Blueprint $table){
            $table->string('id')->primary();
            $table->integer('purchase_type');
            $table->integer('flow');
            $table->string('group_id');
            $table->float('range', 20 ,2);
        });

        Schema::create('authorities_log', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('po_id');
            $table->integer('purchase_type');
            $table->integer('flow');
            $table->string('group_id');
            $table->float('range', 20 ,2);
        });
        
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

        Schema::create('group_projects', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('group_id');
            $table->string('project_id');
        });

        Schema::create('items', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('name');
            $table->string('code');
            $table->text('description');
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

        Schema::create('notifications', function(Blueprint $table){
            $table->string('id')->primary();
            $table->integer('ref_type');
            $table->integer('ref_id');
            $table->integer('flow');
            $table->string('subject');
            $table->string('action_code');
            $table->string('action_from');
            $table->string('status_email')->default('pending');
            $table->string('status_android')->default('pending');
            $table->tinyInteger('type');
            $table->tinyInteger('approval_status');
            $table->varchar('user_id');
            $table->text('description');
            $table->text('reason');
            $table->integer('read')->default(0);
            $table->tinyInteger('isDelete')->default(0);
            $table->timestamps();
        });

        Schema::create('ownership', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('alias');
            $table->text('address');
            $table->text('description');
            $table->tinyInteger('isDelete')->default(0);
        });

        Schema::create('projects', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('name');
            $table->string('alias');
            $table->string('code');
            $table->text('location');
            $table->tinyInteger('isDelete')->default(0);
        });

        Schema::create('project_type', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('name');
            $table->tinyInteger('isDelete')->default(0);
        });

        Schema::create('purchase', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('pr_id');
            $table->string('po_number');
            $table->string('supplier_id');
            $table->float('discount', 20, 2);
            $table->float('tax', 20, 2);
            $table->text('notes');
            $table->string('author');
            $table->tinyInteger('approval_status')->default(0);
            $table->tinyInteger('no_edit_table')->default(0);
            $table->tinyInteger('isCompleted')->default(0);
            $table->tinyInteger('isDelete')->default(0);
            $table->timestamps();
        });
                
        Schema::create('purchase_detail', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('po_id');
            $table->string('pr_detail_id');
            $table->string('account_id');
            $table->string('item_id');
            $table->string('unit_id');
            $table->float('price', 20, 2);
            $table->float('quantity', 20, 2);
            $table->text('reason');
        });

        Schema::create('purchase_requisition', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('pr_number');
            $table->string('barcode_type', 20);
            $table->string('barcode_dns', 10);
            $table->string('account_id');
            $table->string('destination');
            $table->string('division');
            $table->string('ownership_id');
            $table->tinyInteger('purchase_type');
            $table->string('project_id');
            $table->string('project_type_id');
            $table->text('purpose');
            $table->tinyInteger('pr_status')->default(0);
            $table->tinyInteger('approval_status')->default(0);
            $table->text('description');
            $table->string('author');
            $table->tinyInteger('read_account')->default(0);
            $table->tinyInteger('read_pm')->default(0);
            $table->tinyInteger('read_po')->default(0);
            $table->tinyInteger('no_edit_table')->default(0);
            $table->tinyInteger('isCompleted')->default(0);
            $table->tinyInteger('isDelete')->default(0);
            $table->timestamps();
        });

        Schema::create('purchase_requisition_detail', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('pr_id');
            $table->string('item_id');
            $table->string('unit_id');
            $table->float('quantity', 20, 2);
            $table->float('price_estimate', 20, 2);
            $table->float('price', 20, 2);
            $table->string('user');
            $table->text('reason');
            $table->timestamps();
        });

        Schema::create('settings', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('key');
            $table->text('value');
        });

        Schema::create('suppliers', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('name');
            $table->string('email');
            $table->text('address');
            $table->string('phone');
            $table->string('city');
            $table->tinyInteger('isDelete')->default(0);
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
        Schema::dropIfExists('accounts');
        Schema::dropIfExists('authorities');
        Schema::dropIfExists('authorities_log');
        Schema::dropIfExists('files');
        Schema::dropIfExists('group_access');
        Schema::dropIfExists('group_members');
        Schema::dropIfExists('group_projects');
        Schema::dropIfExists('items');
        Schema::dropIfExists('logs');
        Schema::dropIfExists('notifications');
        Schema::dropIfExists('ownership');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('projects_type');
        Schema::dropIfExists('purchase_requisition');
        Schema::dropIfExists('purchase_requisition_detail');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('suppliers');
        Schema::dropIfExists('units');
        Schema::dropIfExists('user_groups');
    }
}
