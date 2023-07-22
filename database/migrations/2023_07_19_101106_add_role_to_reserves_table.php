<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToReservesTable extends Migration
{
    public function up()
    {
        Schema::table('reserves', function (Blueprint $table) {
            $table->integer('role')->nullable();
        });
    }

    public function down()
    {
        Schema::table('reserves', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
}
