<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaborAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labor_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('labor_id');
            $table->boolean('status')->default(1); //0 for absent, 1 for present
            $table->boolean('paid')->default(1); //0 for wage not paid, 1 for wage paid
            $table->String('date');
            $table->timestamps();

            $table->foreign('labor_id')
                ->references('id')
                ->on('labors');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('labor_attendances');
    }
}
