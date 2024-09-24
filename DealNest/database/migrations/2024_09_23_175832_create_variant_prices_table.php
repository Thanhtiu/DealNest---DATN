<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('variant_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->constrained('variants')->onDelete('cascade');
            $table->decimal('price', 15, 2); // Giá của biến thể
            $table->timestamps(); // Tạo cột created_at và updated_at
            // Foreign key relationships

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variant_prices');
    }
};
