<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('kamars', function (Blueprint $table) {
        $table->id();

        $table->string('nomor_kamar')->unique();

        $table->string('tipe_kamar');

        $table->decimal('harga_per_malam', 12, 2);

        $table->integer('kapasitas');

        $table->enum('status', [
            'tersedia',
            'terisi',
            'maintenance'
        ])->default('tersedia');

        $table->text('deskripsi')->nullablme();

        $table->timestamps();
    });
}
};
