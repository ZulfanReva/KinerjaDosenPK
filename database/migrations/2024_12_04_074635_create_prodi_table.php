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
        Schema::create('prodi', function (Blueprint $table) {
            $table->id(); // Primary key otomatis
            $table->string('nama_prodi')->unique(); // Kolom nama prodi dengan constraint unique
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('prodi');
    }
};
