<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('obats', function (Blueprint $table) {
            $table->string('dosis')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('obats', function (Blueprint $table) {
            $table->string('dosis')->nullable(false)->change();
        });
    }

};
