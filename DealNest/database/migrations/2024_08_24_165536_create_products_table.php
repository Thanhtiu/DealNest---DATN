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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subcategory_id')->constrained('subcategories')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->string('name', 255)->notNullable();
            $table->text('description')->notNullable();
            $table->decimal('price', 10, 2)->notNullable();
            $table->integer('quantity')->notNullable();
            $table->integer('favourite')->notNullable();
            $table->decimal('rating', 3, 2)->notNullable();
            $table->integer('sales')->notNullable();
            $table->string('sku', 255)->notNullable();
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