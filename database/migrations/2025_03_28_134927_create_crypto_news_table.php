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
        Schema::create('crypto_news', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Judul berita
            $table->text('description'); // Isi berita
            $table->string('source'); // Sumber berita (CoinGecko)
            $table->string('url')->nullable(); // Link sumber asli
            $table->timestamp('published_at'); // Waktu publish
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_news');
    }
};
