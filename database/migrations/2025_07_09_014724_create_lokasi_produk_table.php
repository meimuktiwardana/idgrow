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
        Schema::create('lokasi_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained()->onDelete('cascade');
            $table->foreignId('lokasi_id')->constrained()->onDelete('cascade');
            $table->integer('stok')->default(0); // Poin 8
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_produk');
    }
};
