<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('kofi:about', function (): void {
    $this->comment('KOFI / 02 · Coffee, slowly.');
})->purpose('Print a short note about the cafe site');
