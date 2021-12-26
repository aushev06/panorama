<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSiteSettingsTable extends Migration
{
    public $table = 'site_settings';

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
                $table->string('description')->default('');
            }
        );

        DB::table($this->table)->insert(
            [
                [
                    'key'         => 'schedule_weekdays_open',
                    'value'       => '11:00',
                    'description' => 'Открытие в будние дни'
                ],
                [
                    'key'         => 'schedule_weekdays_close',
                    'value'       => '00:00',
                    'description' => 'Закрытие в будние дни'
                ],
                [
                    'key'         => 'schedule_weekdays_orders_end',
                    'value'       => '23:40',
                    'description' => 'Последний заказ в будние дни'
                ],
                [
                    'key'         => 'schedule_weekend_open',
                    'value'       => '11:00',
                    'description' => 'Открытие в выходные дни'
                ],
                [
                    'key'         => 'schedule_weekend_close',
                    'value'       => '01:00',
                    'description' => 'Закрытие в выходные дни'
                ],
                [
                    'key'         => 'schedule_weekend_orders_end',
                    'value'       => '00:40',
                    'description' => 'Последний заказ в выходные дни'
                ],
                [
                    'key'         => 'phone_number',
                    'value'       => '79780438740',
                    'description' => 'Номер телефона'
                ],
                [
                    'key'         => 'mail',
                    'value'       => 'alikehome@mail.ru',
                    'description' => 'Mail'
                ],
                [
                    'key'         => 'instagram',
                    'value'       => 'https://instagram.com/alikehome',
                    'description' => 'Instagram'
                ],
                [
                    'key'         => 'site_name',
                    'value'       => 'A like home',
                    'description' => 'Название сайта'
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
        Schema::dropIfExists('site_settings');
    }
}
