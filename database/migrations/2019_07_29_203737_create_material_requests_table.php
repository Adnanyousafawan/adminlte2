<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id');
            $table->string('instructions')->nullable();
            $table->string('quantity');
            $table->unsignedBigInteger('requested_by');
            $table->unsignedBigInteger('project_id');
            $table->boolean('seen')->default(0);
            $table->unsignedBigInteger('request_status_id')->default(1);
            $table->timestamps();

            $table->foreign('item_id')
                ->references('id')
                ->on('items');

            $table->foreign('requested_by')
                ->references('id')
                ->on('users');

            $table->foreign('project_id')
                ->references('id')
                ->on('projects');

            $table->foreign('request_status_id')
                ->references('id')
                ->on('material_request_statuses');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_requests');
    }
}
