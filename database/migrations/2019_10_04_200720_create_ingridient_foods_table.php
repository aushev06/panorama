<?php

use App\Models\Ingridient\IngridientFoods;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngridientFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingridient_foods', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->unsignedInteger('ingridient_id');
            $table->integer('food_id')->unsigned();
            $table->integer('status')->default(IngridientFoods::STATUS_ACTIVE);
            $table->timestamps();


        });

        Schema::table('ingridient_foods', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->foreign('ingridient_id')->references('id')->on('ingridients')->onDelete('CASCADE');
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingridient_foods');
    }
}
