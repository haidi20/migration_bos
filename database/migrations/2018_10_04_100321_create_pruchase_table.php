<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePruchaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('purchase', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('pr_id');
            $table->string('order_number');
            $table->string('supplier_id');
            $table->float('discount', 20, 2);
            $table->float('tax', 20, 2);
            $table->text('notes');
            $table->string('author');
            $table->tinyInteger('approval_status')->default(0);
            $table->tinyInteger('isCompleted')->default(0);
            $table->tinyInteger('isDelete')->default(0);
            $table->timestamps();
        });
                
        Schema::create('purchase_detail', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('po_id');
            $table->string('item_id');
            $table->string('unit_id');
            $table->float('price', 20, 2);
            $table->float('quantity', 20, 2);
            $table->text('reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase');
    }
}
