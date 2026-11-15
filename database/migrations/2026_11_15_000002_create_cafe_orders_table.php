<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cafe_orders', function (Blueprint $table): void {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('customer_name', 120);
            $table->string('phone', 40);
            $table->string('email', 254)->nullable();
            $table->string('pickup_slot', 20);
            $table->string('comment', 500)->nullable();
            $table->string('status', 20)->default('new')->index();
            $table->unsignedInteger('total');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cafe_orders');
    }
};
