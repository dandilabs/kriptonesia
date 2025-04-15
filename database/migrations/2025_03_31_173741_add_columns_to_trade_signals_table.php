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
            // Tambahkan kolom baru
            $table->string('symbol', 20)->after('name');
            $table->enum('type', ['buy', 'sell', 'strong_buy', 'strong_sell'])->after('symbol');
            $table->decimal('entry_price', 16, 8)->after('type');
            $table->decimal('target_price', 16, 8)->after('entry_price');
            $table->decimal('stop_loss', 16, 8)->after('target_price');
            $table->text('analysis')->after('stop_loss');
            $table->renameColumn('content', 'description'); // Ubah nama kolom content menjadi description
            $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
            $table->timestamp('expired_at')->nullable()->after('description');

            // Ubah kolom image menjadi nullable
            $table->string('image')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trade_signals', function (Blueprint $table) {
            // Hapus kolom yang ditambahkan
            $table->dropColumn([
                'symbol',
                'type',
                'entry_price',
                'target_price',
                'stop_loss',
                'analysis',
                'user_id',
                'expired_at'
            ]);

            // Kembalikan nama kolom description ke content
            $table->renameColumn('description', 'content');

            // Kembalikan kolom image menjadi tidak nullable
            $table->string('image')->nullable(false)->change();
        });
    }
};
