<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('icon')->default('📦');
            $table->string('spec')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->json('specs')->nullable(); // array of [key, value]
            $table->string('tokped_url')->nullable();
            $table->string('shopee_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('wa_text')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
