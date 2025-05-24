<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiagnosaDanKeluhanToPemeriksaansTable extends Migration
{
    public function up()
    {
        Schema::table('pemeriksaans', function (Blueprint $table) {
            $table->text('keluhan')->nullable()->after('pasien_id');   // letakkan setelah pasien_id
            $table->text('diagnosa')->nullable()->after('keluhan');    // letakkan setelah keluhan
        });
    }

    public function down()
    {
        Schema::table('pemeriksaans', function (Blueprint $table) {
            $table->dropColumn(['keluhan', 'diagnosa']);
        });
    }
}

