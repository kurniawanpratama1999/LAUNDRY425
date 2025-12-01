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
        Schema::create('details', function (Blueprint $col) {
            $col->id();
            $col->foreignId('order_id')->constrained('orders')->restrictOnDelete();
            $col->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $col->integer('quantity');
            $col->decimal('subtotal', 10,2);
            $col->string('notes');
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
        
    }
};
