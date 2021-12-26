<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecomendFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recomend_foods', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->unsignedInteger('food_id');
            $table->unsignedInteger('food_recomend_id');
            $table->timestamps();


            $table->foreign(['food_id'])->references(['id'])->on('foods')->onDelete('CASCADE');
            $table->foreign(['food_recomend_id'])->references(['id'])->on('foods')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recomend_foods');
    }
}
