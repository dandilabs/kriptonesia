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
        Schema::create('fear_greed_indices', function (Blueprint $table) {
            $table->id();
            $table->integer('value');
            $table->string('label'); // Extreme Fear, Fear, Neutral, Greed, Extreme Greed
            $table->dateTime('timestamp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fear_greed_indices');
    }
};
