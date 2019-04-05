<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('proj_title');
            $table->string('proj_location');
            $table->string('proj_dimension');
            $table->string('proj_city');
            $table->string('cust_name');
            $table->string('cust_CNIC');
            $table->string('cust_contact');
            $table->string('proj_contractor');
            $table->string('proj_completion_time');
            $table->string('zipcode');
            $table->string('proj_cost');
            $table->string('proj_description');
            //$table->string('upload_contract');
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
        Schema::dropIfExists('projects');
    }
}
