<?php
// ============================================================
// FILE: database/migrations/2024_01_01_000004_add_banner_and_visitors.php
// ============================================================
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add banner & SEO settings ke tabel settings yang sudah ada
        // (settings sudah punya key-value, jadi cukup seed data baru)

        // Buat tabel visitor_logs untuk tracking pengunjung
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->string('page', 255)->default('/');
            $table->string('referrer', 500)->nullable();
            $table->date('visited_date');
            $table->timestamps();

            $table->index('visited_date');
            $table->index('ip_address');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};
