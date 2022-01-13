<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('from_address');
            $table->string('to_address');
            $table->string('from_coordinate_x');
            $table->string('from_coordinate_y');
            $table->string('to_coordinate_x');
            $table->string('to_coordinate_y');
            $table->integer('min_cost');
            $table->integer('cost_by_km');
            $table->integer('cost_by_minutes');
            $table->integer('final_cost');
            $table->string('status');
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
        Schema::dropIfExists('orders');
    }
}
