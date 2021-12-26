<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateRefUserTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_user', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->string('phone')->nullable()->change();
            $table->string('email')->change()->index();
            $table->integer('role')->default(User::ROLE_USER)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ref_user', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->string(User::ATTR_PHONE)->change();
            $table->string(User::ATTR_EMAIL)->nullable()->change();
            $table->dropColumn(User::ATTR_ROLE);
        });
    }
}
