<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsTable extends Migration
{
    const TABLE_NAME = 'foods';

    /**
     * Run the migrations.
     *
     * @return void
     *
     * @author Ibra Aushev <aushevibra@yandex.ru>
     */
    public function up()
    {
        Schema::create(static::TABLE_NAME, function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('name');
            $table->string('img')->nullable();
            $table->text('description')->nullable();
            $table->string('slug')->unique()->index('idx-foods[slug]');
            $table->unsignedInteger('category_id');
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foods');
    }
}
