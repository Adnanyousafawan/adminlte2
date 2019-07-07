<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void s
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
             $table->bigIncrements('id');
                $table->unsignedBigInteger('item_id');
                $table->unsignedBigInteger('project_id');
                $table->unsignedBigInteger('supplier_id');
                $table->string('quantity')->nullable();
                $table->string('received_quantity')->nullable()->default("0");
                $table->string('status')->default('pending');
                $table->string('set_rate')->default('0')->nullable();
                $table->string('invoice_number')->default('100000');

                $table->foreign('item_id')
                    ->references('id')
                    ->on('items');

                     $table->foreign('project_id')
                    ->references('id')
                    ->on('projects');

                    $table->foreign('supplier_id')
                    ->references('id')
                    ->on('suppliers');



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
        Schema::dropIfExists('order_details');
    }
}
