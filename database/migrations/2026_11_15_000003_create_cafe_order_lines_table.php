<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cafe_order_lines', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('cafe_order_id')->constrained('cafe_orders')->cascadeOnDelete();
            $table->foreignId('coffee_item_id')->nullable()->constrained('coffee_items')->nullOnDelete();
            $table->string('name', 120);
            $table->string('size', 50);
            $table->unsignedInteger('price');
            $table->unsignedTinyInteger('quantity');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cafe_order_lines');
    }
};
