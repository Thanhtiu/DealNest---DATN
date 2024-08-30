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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->enum('method', ['cod','vnpay', 'momo'])->notNullable();
            $table->decimal('total', 10, 2)->notNullable();
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->string('momo_transaction_id', 255)->nullable();
            $table->string('phone_number', 255)->nullable();
            $table->dateTime('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};