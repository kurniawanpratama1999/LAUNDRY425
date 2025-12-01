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
        Schema::create('pickups', function (Blueprint $col) {
            $col->id();
            $col->foreignId('customer_id')->constrained('customers')->restrictOnDelete();
            $col->foreignId('order_id')->constrained('orders')->restrictOnDelete();
            $col->timestamp('pickup_date');
            $col->string('notes');
            $col->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickups');
        
    }
};
