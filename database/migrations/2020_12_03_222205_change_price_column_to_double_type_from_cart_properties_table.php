<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangePriceColumnToDoubleTypeFromCartPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart_properties', function (Blueprint $table) {
            DB::statement('ALTER TABLE cart_properties MODIFY price DOUBLE(8, 2)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cart_properties', function (Blueprint $table) {
            $table->float('price')->change();
        });
    }
}
