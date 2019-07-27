<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('name')->nullable();
            $table->float('purchase_rate')->nullable();
            $table->float('selling_rate')->nullable()->default("0");
            $table->string('unit')->nullable();
            $table->unsignedBigInteger('supplier_id');
            $table->timestamps();

    
            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
