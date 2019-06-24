<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMiscellaneousExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
         Schema::create('miscellaneous_expenses', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name')->nullable();
                $table->string('description')->nullable();
                $table->string('expense')->nullable(); 
                $table->unsignedBigInteger('project_id')->nullable();

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
         Schema::dropIfExists('miscellaneous_expenses');
    }
}
