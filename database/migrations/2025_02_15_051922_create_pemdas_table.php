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
        Schema::create('pemdas', function (Blueprint $table) {
            $table->string('kode_prov', 5);
            $table->string('kode_kab', 5);
            $table->string('kode_gabung', 10)->nullable();
            $table->string('nama', 100)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->string('ibukota', 50)->nullable();
            $table->string('nama_bupati', 50)->nullable();
            $table->string('jabatan_bupati', 50)->nullable();

            $table->index('kode_prov');
            $table->index('kode_kab');
            $table->index('kode_gabung');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemdas');
    }
};
