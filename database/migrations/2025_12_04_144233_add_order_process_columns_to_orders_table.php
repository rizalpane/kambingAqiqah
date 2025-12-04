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
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('order_status', ['pending', 'processing', 'shipped', 'delivered', 'received', 'cancelled'])
                ->default('pending')
                ->after('status')
                ->comment('Status proses order');
            $table->boolean('is_received')->default(false)->after('order_status')->comment('Konfirmasi penerimaan dari user');
            $table->timestamp('received_at')->nullable()->after('is_received')->comment('Tanggal konfirmasi diterima');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['order_status', 'is_received', 'received_at']);
        });
    }
};
