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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'order' atau 'system'
            $table->string('action'); // 'new_order', 'delete_user', 'update_password', dll
            $table->text('message'); // Pesan notifikasi
            $table->string('icon')->nullable(); // Icon untuk notifikasi
            $table->unsignedBigInteger('related_id')->nullable(); // ID terkait (order_id, user_id, dll)
            $table->string('related_type')->nullable(); // Tipe model terkait
            $table->boolean('is_read')->default(false); // Status dibaca
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
