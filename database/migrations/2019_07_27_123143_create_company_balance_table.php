<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyBalanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_balance', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->float('balance',25,0)->nullable()->default("0");
            $table->float('projects_balance',25,0)->nullable()->default("0");
            $table->float('profit',25,0)->nullable()->default("0");
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
        Schema::dropIfExists('company_balance');
    }
}