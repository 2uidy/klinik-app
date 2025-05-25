<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('obats', function (Blueprint $table) {
            $table->foreignId('resep_id')->nullable()->constrained('reseps')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('obats', function (Blueprint $table) {
            $table->dropForeign(['resep_id']);
            $table->dropColumn('resep_id');
        });
    }
};
