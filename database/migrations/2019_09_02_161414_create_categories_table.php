<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->string('name')->comment('Название');
            $table->string('img')->nullable()->comment('Изображение');
            $table->string('icon')->nullable()->comment('Иконка');
            $table->text('description')->nullable()->comment('Описание');
            $table->string('slug')->unique();
            $table->integer('parent_id')->unsigned()->nullable()->comment('Родительская категория');
            $table->integer('order')->unsigned()->nullable()->comment('Сортировка');
            $table->integer('status')->unsigned()->default(1)->comment('Видимость категории');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['parent_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
