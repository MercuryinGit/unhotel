<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kamars', function (Blueprint $table) {
            $table->enum('status', [
                'tersedia',
                'terisi',
                'cleaning',
                'maintenance',
            ])->default('tersedia')->change();
        });
    }

    public function down(): void
    {
        DB::table('kamars')
            ->where('status', 'cleaning')
            ->update(['status' => 'tersedia']);

        Schema::table('kamars', function (Blueprint $table) {
            $table->enum('status', [
                'tersedia',
                'terisi',
                'maintenance',
            ])->default('tersedia')->change();
        });
    }
};
