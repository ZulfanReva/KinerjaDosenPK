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
        Schema::create('penilaian_pm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_admin')->constrained('users');
            $table->foreignId('id_dosen')->constrained('dosen');
            $table->foreignId('id_penilaianbkd')->constrained('penilaian_bkd');
            $table->foreignId('id_penilaianpk')->constrained('penilaian_pk');
            $table->foreignId('periode_id')->constrained('periode')->onDelete('cascade');
            $table->integer('nilai_npm');
            $table->text('umpan_balik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_pm');
    }
};