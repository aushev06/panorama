<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSettingsTable extends Migration
{
    public $table = 'settings';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            $this->table,
            function (Blueprint $table) {
                $table->string('key')->primary();
                $table->string('value')->default('');
                $table->integer('status')->default(1);
                $table->string('description')->default('');
            }
        );

        DB::table($this->table)->insert(
            [
                [
                    'key'         => 'schedule_weekdays_open',
                    'value'       => '09:00',
                    'status'      => 1,
                    'description' => 'Открытие в будние дни'
                ],
                [
                    'key'         => 'schedule_weekdays_close',
                    'value'       => '22:00',
                    'status'      => 1,
                    'description' => 'Закрытие в будние дни'
                ],
                [
                    'key'         => 'schedule_weekdays_orders_open',
                    'value'       => '09:00',
                    'status'      => 0,
                    'description' => 'Первый заказ в будние дни'
                ],
                [
                    'key'         => 'schedule_weekdays_orders_close',
                    'value'       => '21:30',
                    'status'      => 1,
                    'description' => 'Последний заказ в будние дни'
                ],
                [
                    'key'         => 'schedule_weekend_open',
                    'value'       => '10:00',
                    'status'      => 1,
                    'description' => 'Открытие в выходные дни'
                ],
                [
                    'key'         => 'schedule_weekend_close',
                    'value'       => '22:00',
                    'status'      => 1,
                    'description' => 'Закрытие в выходные дни'
                ],
                [
                    'key'         => 'schedule_weekend_orders_open',
                    'value'       => '10:00',
                    'status'      => 0,
                    'description' => 'Первый заказ в выходные дни'
                ],
                [
                    'key'         => 'schedule_weekend_orders_close',
                    'value'       => '21:30',
                    'status'      => 1,
                    'description' => 'Последний заказ в выходные дни'
                ],
                [
                    'key'         => 'schedule_everyday_orders_open',
                    'value'       => '09:00',
                    'status'      => 1,
                    'description' => 'Первый заказ на каждый день'
                ],
                [
                    'key'         => 'schedule_everyday_orders_close',
                    'value'       => '21:30',
                    'status'      => 1,
                    'description' => 'Последний заказ на каждый день'
                ],
                [
                    'key'         => 'orders_off',
                    'value'       => 'На данный момент заказы не принимаются!',
                    'status'      => 0,
                    'description' => 'Отключение корзины (заказов). Если указать значение, то будет отображаться в сообщении на сайте.'
                ],
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
