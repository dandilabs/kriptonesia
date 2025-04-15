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
        Schema::table('trade_signals', function (Blueprint $table) {
            $table->enum('trade_type', ['spot', 'future'])->default('spot')->after('type');
            $table->decimal('leverage', 5, 2)->nullable()->after('trade_type'); // Hanya untuk futur
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trade_signals', function (Blueprint $table) {
            $table->dropColumn(['trade_type', 'leverage']);
        });
    }
};
