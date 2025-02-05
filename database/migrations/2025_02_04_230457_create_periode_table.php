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
        Schema::create('periode', function (Blueprint $table) {
            $table->id();
            $table->string('nama_periode')->unique(); // Tambahkan unique() di sini
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('periode');
    }
};
