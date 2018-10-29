<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePurchaseRequisitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
            $table->tinyInteger('qs_status')->default(0);
            $table->tinyInteger('pm_status')->default(0);
            $table->text('description');
            $table->string('author');
            $table->tinyInteger('read_qs')->default(0);
            $table->tinyInteger('read_pm')->default(0);
            $table->tinyInteger('read_po')->default(0);
            $table->tinyInteger('isCompleted')->default(0);
            $table->tinyInteger('noEditable')->default(0);
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
        Schema::table('purchase_requisition', function (Blueprint $table) {
            //
        });
    }
}
