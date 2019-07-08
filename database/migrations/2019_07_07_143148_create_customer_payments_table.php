<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('received')->nullable()->default("0");
            $table->integer('receivable')->nullable()->default("0");
            $table->unsignedBigInteger('project_id')->nullable();
            $table->timestamps();

              $table
                ->foreign('project_id')
                ->references('id')
                ->on('projects');
        });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_payments');
    }
}
