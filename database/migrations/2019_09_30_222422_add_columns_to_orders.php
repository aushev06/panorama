<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->engine = "InnoDB";
//            City
//Street
//House
//Building
//Apartment
//Entrance
//Floor
//Intercom
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable()->comment('Дом');
            $table->string('apartment')->nullable()->comment('Квартира');
            $table->string('entrance')->nullable()->comment('Подъезд');
            $table->string('intercom')->nullable()->comment('Домофон');
            $table->string('building')->nullable()->comment('Корпус');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->dropColumn('city');
            $table->dropColumn('street');
            $table->dropColumn('house');
            $table->dropColumn('apartment');
            $table->dropColumn('entrance');
            $table->dropColumn('intercom');
            $table->dropColumn('building');
        });
    }
}
