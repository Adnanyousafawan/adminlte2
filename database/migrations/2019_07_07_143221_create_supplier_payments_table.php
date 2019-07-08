<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('paid')->nullable()->default("0");
            $table->integer('payable')->nullable()->default("0");
            $table->unsignedBigInteger('supplier_id')->nullable()->default(1);
            $table->timestamps();
              $table
                ->foreign('supplier_id')
                ->references('id')
                ->on('suppliers');
        });
 
//            $table->timestamps();
          
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_payments');
    }
}
