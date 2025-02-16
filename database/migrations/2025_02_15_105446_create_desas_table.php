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
        Schema::create('desas', function (Blueprint $table) {
            $table->string('kode_prov', 5);
            $table->string('kode_kab', 5);
            $table->string('kode_kec', 5);
            $table->string('kode_desa', 5);
            $table->string('kode_gabung', 20)->nullable();
            $table->string('nama', 100)->nullable();

            $table->index('kode_prov');
            $table->index('kode_kab');
            $table->index('kode_kec');
            $table->index('kode_desa');
            $table->index('kode_gabung');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desas');
    }
};
