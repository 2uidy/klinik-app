<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPemeriksaanIdToResepsTable extends Migration
{
    public function up()
    {
        Schema::table('reseps', function (Blueprint $table) {
            $table->unsignedBigInteger('pemeriksaan_id')->after('nomor_resep')->nullable();

            // Jika ingin relasi foreign key (optional):
            // $table->foreign('pemeriksaan_id')->references('id')->on('pemeriksaans')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('reseps', function (Blueprint $table) {
            // Hapus dulu foreign key jika ada
            // $table->dropForeign(['pemeriksaan_id']);
            $table->dropColumn('pemeriksaan_id');
        });
    }
}
