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
        Schema::create('level_menus', function (Blueprint $col) {
            $col->id();
            $col->foreignId('level_id')->constrained('levels')->cascadeOnDelete();
            $col->foreignId('menu_id')->constrained('menus')->cascadeOnDelete();
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('level_menus');
    }
};
