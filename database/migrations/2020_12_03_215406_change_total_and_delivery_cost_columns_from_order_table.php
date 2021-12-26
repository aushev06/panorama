<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeTotalAndDeliveryCostColumnsFromOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            DB::statement('ALTER TABLE orders MODIFY total DOUBLE(8, 2)');
            DB::statement('ALTER TABLE orders MODIFY delivery_cost DOUBLE(8, 2) DEFAULT 0');
//            $table->double('total', 8, 2)->change();
//            $table->double('delivery_cost', 8, 2)->change();
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
            $table->integer('total')->change();
            $table->integer('delivery_cost')->change();
        });
    }
}
