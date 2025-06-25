<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('polygons', function (Blueprint $table) {
            $table->integer('vote')->default(0)->after('name'); // sesuaikan kolom after-nya
        });
    }

    public function down()
    {
        Schema::table('polygons', function (Blueprint $table) {
            $table->dropColumn('vote');
        });
    }
};
