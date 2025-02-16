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
        Schema::create('bidangs', function (Blueprint $table) {
            $table->string('kode_bidang', 5);
            $table->string('kode_gabung', 15)->nullable();
            $table->string('nama', 100)->nullable();

            $table->index('kode_bidang');
            $table->unique('kode_gabung');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bidangs');
    }
};
