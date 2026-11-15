<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscribers', function (Blueprint $table): void {
            $table->id();
            // Keep the unique index below MySQL's legacy 767-byte limit.
            $table->string('email', 191)->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscribers');
    }
};
