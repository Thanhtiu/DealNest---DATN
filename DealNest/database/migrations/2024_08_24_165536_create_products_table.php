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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('sellers')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('subcategory_id')->constrained('subcategories')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->string('name', 255)->notNullable();
            $table->decimal('price', 10, 2)->notNullable();
            $table->string('image', 255)->nullable();
            $table->text('description')->notNullable();
            $table->integer('quantity')->notNullable();
            $table->integer('favourite')->nullable();
            $table->decimal('rating', 3, 2)->nullable();
            $table->integer('sales')->nullable();
            $table->enum('status', ['Chờ phê duyệt', 'Đã phê duyệt', 'Từ chối'])->default('Chờ phê duyệt')->nullable(false);
            $table->string('note')->nullable();
            $table->boolean('has_variants')->default(false);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
