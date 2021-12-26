<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrders extends Migration
{
    const TABLE = 'orders';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(static::TABLE, function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('id');
            $table->unsignedInteger('cart_id');
            $table->string('name');
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('home')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('porch')->nullable();
            $table->string('time_delivery')->nullable()->comment('Время доставки');
            $table->string('date_delivery')->nullable()->comment('Дата доставки');
            $table->string('organization')->nullable();
            $table->integer('pay_type')->comment('Тип оплаты'); // Тип оплаты

            $table->integer('user_id')->nullable();

            $table->integer('total');
            $table->text('comment')->nullable();
            $table->integer('status')->defalut(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(static::TABLE);
    }
}
