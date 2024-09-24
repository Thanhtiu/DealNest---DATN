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
       
            Schema::create('variants', function (Blueprint $table) {
                $table->id();
                $table->foreignId(column: 'product_id')->constrained('products')->onDelete('cascade'); 
                $table->string('type'); // Loại biến thể (size/color)
                $table->string('value'); // Giá trị của biến thể (ví dụ: M, L, Đỏ, Vàng)
                $table->timestamps(); // Tạo cột created_at và updated_at

            });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
