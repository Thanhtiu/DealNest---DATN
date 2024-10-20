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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('address')->nullable();
            $table->enum('status', ['pending', 'completed', 'cancelled', 'waiting_for_delivery'])->default('pending');
            $table->decimal('total', 3, 2)->notNullable();
            $table->enum('payment_method', ['cod', 'master_card', 'vnpay'])->default('cod');
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('cancellation_reason')->nullable();
            $table->date('delivery_date')->notNullable();
            $table->timestamps();
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
