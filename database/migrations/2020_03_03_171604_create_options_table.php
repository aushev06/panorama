<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->integer('price');
            $table->integer('multiplier')->default(1);
            $table->unsignedBigInteger('option_category_id');
            $table->integer('status')->index();
            $table->timestamps();
            $table->softDeletes();

            $table
                ->foreign('option_category_id', 'fk-options[option_category]')
                ->on('option_categories')
                ->references('id')
                ->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
