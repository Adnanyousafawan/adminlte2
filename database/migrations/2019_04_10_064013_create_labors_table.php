<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaborsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('cnic');
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('rate');
            $table->unsignedBigInteger('project_id');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('labors');
    }
}
