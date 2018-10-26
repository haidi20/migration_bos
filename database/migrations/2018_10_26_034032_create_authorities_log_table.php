<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthoritiesLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authorities_log', function(Blueprint $table){
            $table->string('id')->primary();
            $table->string('ref_id');
            $table->integer('purchase_type');
            $table->integer('flow');
            $table->string('group_id');
            $table->float('range', 20 ,2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authorities_log');
    }
}
