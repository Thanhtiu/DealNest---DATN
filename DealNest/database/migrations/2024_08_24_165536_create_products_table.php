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
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
            $table->string('name', 255)->notNullable();
            $table->string('slug', 255)->notNullable();
            $table->decimal('price', 10, 2)->notNullable();
            $table->decimal('mrp', 10, 2)->notNullable();
            $table->string('image', 255)->nullable();
            $table->text('description')->notNullable();
            $table->integer('quantity')->notNullable();
            $table->integer('view')->default(0);
            $table->integer('sales')->default(0);
            $table->string('sku', 255)->notNullable();
            $table->enum('status', ['pending', 'approved', 'cancel'])->default('pending')->nullable(false);
            $table->integer('trash_can')->default(1);
            $table->string('note')->nullable();
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
