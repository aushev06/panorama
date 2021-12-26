<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('value')->default('');
            $table->timestamps();
        });


        foreach ($this->data() as $datum) {
            DB::table('settings')->insert($datum);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach ($this->data() as $datum) {
            DB::table('settings')->where('key', $datum['key'])->delete();
        }
        Schema::dropIfExists('settings');
    }

    private function data()
    {
        return [
            ['key' => 'TILLYPAD_TOKEN', 'value' => ''],
            ['key' => 'DEMO_MRH_LOGIN', 'value' => ''],
            ['key' => 'DEMO_MRH_PASSWORD', 'value' => ''],
            ['key' => 'DEMO_MRH_PASSWORD2', 'value' => ''],

            ['key' => 'MRH_LOGIN', 'value' => ''],
            ['key' => 'MRH_PASSWORD', 'value' => ''],
            ['key' => 'MRH_PASSWORD2', 'value' => ''],

        ];


    }
}
