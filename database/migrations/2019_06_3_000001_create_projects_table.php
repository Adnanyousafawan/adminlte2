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
            $table->string('title')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('plot_size')->nullable();
              //customer details
            $table->unsignedBigInteger('customer_id')->nullable();

            $table->string('estimated_completion_time')->nullable();
            $table->string('estimated_budget')->nullable();
            $table->string('floor')->nullable();
            $table->string('description', "1000")->nullable();
            $table->string('contract_image')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->unsignedBigInteger('assigned_by')->nullable();
            $table->unsignedBigInteger('status_id')->nullable()->default(0);
            $table->unsignedBigInteger('phase_id')->nullable()->default(0);
            $table->timestamps();


            //adding foreign key constraint on assigned_to which tells about to whom this project is assigned
            $table->foreign('assigned_to')
                ->references('id')
                ->on('users');

            $table->foreign('assigned_by')
                ->references('id')
                ->on('users');

                $table->foreign('customer_id')
                ->references('id')
                ->on('customers');

            $table->foreign('phase_id')
                ->references('id')
                ->on('project_phase');

            $table->foreign('status_id')
                ->references('id')
                ->on('project_status');

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