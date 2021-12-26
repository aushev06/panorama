<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartPropertyOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_property_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('cart_property_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->unsignedBigInteger('option_id');
            $table->timestamps();

            $table->foreign('option_id')->references('id')->on('options')->onDelete('CASCADE');
            $table->foreign('cart_property_id')->references('id')->on('cart_properties')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_property_options');
    }
}
