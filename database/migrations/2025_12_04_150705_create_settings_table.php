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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        DB::table('settings')->insert([
            ['key' => 'site_title', 'value' => 'Selamat Datang', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_subtitle', 'value' => 'Layanan Aqiqah Terpercaya dan Berkualitas', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_description', 'value' => 'Kami menyediakan layanan aqiqah terbaik untuk keluarga Indonesia', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
