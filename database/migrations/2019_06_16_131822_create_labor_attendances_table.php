<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD:database/migrations/2019_06_16_131822_create_labor_attendances_table.php
class CreateLaborAttendancesTable extends Migration
=======
class CreateOrderStatusesTable extends Migration
>>>>>>> 58b8a40facc7caec51d3528b32bbd462b0d9e0d4:database/migrations/2019_06_25_152910_create_order_statuses_table.php
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD:database/migrations/2019_06_16_131822_create_labor_attendances_table.php
        Schema::create('labor_attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('labor_id');
            $table->boolean('status')->default(0);
            $table->String('date');
            $table->timestamps();

            $table->foreign('labor_id')
                ->references('id')
                ->on('labors');
=======
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();
>>>>>>> 58b8a40facc7caec51d3528b32bbd462b0d9e0d4:database/migrations/2019_06_25_152910_create_order_statuses_table.php
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD:database/migrations/2019_06_16_131822_create_labor_attendances_table.php
        Schema::dropIfExists('labor_attendances');
=======
        Schema::dropIfExists('order_statuses');
>>>>>>> 58b8a40facc7caec51d3528b32bbd462b0d9e0d4:database/migrations/2019_06_25_152910_create_order_statuses_table.php
    }
}
