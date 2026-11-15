<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('coffee_items', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 120);
            $table->string('slug', 140)->unique();
            $table->string('category', 24)->index();
            $table->text('description');
            $table->string('tasting_notes', 180)->default('');
            $table->string('size', 50)->default('250 мл');
            $table->unsignedInteger('price');
            $table->string('image_url', 500);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_available')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coffee_items');
    }
};
