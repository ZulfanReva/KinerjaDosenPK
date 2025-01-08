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
        Schema::create('penilaian_bkd', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dosen_id')->constrained('dosen')->cascadeOnDelete();
            $table->foreignId('periode_id')->nullable()->constrained('periode')->onDelete('set null');
            $table->tinyInteger('bidang_pendidikan')->unsigned();
            $table->tinyInteger('bidang_penelitian')->unsigned();
            $table->tinyInteger('bidang_pengabdian')->unsigned();
            $table->tinyInteger('bidang_penunjang')->unsigned();
            $table->decimal('nilai_ncf');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian_bkd');
    }
};
