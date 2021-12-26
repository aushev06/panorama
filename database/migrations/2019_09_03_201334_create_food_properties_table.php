<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodPropertiesTable extends Migration
{
    const TABLE_NAME = 'food_properties';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(static::TABLE_NAME, function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->unsignedInteger('food_id');
            $table->string('name');
            $table->float('price')->index();
            $table->float('old_price')->nullable()->index();
            $table->integer('sort');
            $table->integer('is_visible')->default(1)->index('idx-' . static::TABLE_NAME . '[is_visible]'); // 1 - active

            $table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('food_properties');
    }
}
