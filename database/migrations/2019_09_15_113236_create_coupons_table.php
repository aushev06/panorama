<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    const TABLE_NAME = 'coupons';

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
            $table->string('coupon');
            $table->integer('value');
            $table->integer('type')->comment('Процент или сумма');
            $table->integer('quantity')->default(0)->comment('0 - бесконечно');
            $table->integer('status')->default(0);
            $table->integer('number_of_activations')->default(0)->comment('количество активаций');
            $table->timestamp('expired_at')->nullable()->comment('Срок действия');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(static::TABLE_NAME);
    }
}
