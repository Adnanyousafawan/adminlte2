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
                $table->string('quantity')->nullable();
                $table->string('status')->default('pending');

                $table->foreign('item_id')
                    ->references('id')
                    ->on('items');

                     $table->foreign('project_id')
                    ->references('id')
                    ->on('projects');



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
