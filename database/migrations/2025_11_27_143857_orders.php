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
        Schema::create('orders', function (Blueprint $col) {
            $col->id();
            $col->foreignId('customer_id')->constrained('customers')->restrictOnDelete();
            $col->string('code');
            $col->timestamp('date')->useCurrent();
            $col->timestamp('end_date')->useCurrent();
            $col->string('status');
            $col->decimal('total', 10, 2);
            $col->decimal('payment', 10, 2);
            $col->decimal('change', 10, 2);
            $col->timestamps();
            $col->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
