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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->string('store_name', 255)->notNullable();
            $table->text('store_description')->nullable();
            $table->decimal('rating', 3, 2)->default(0.00)->notNullable();
            $table->integer('follow')->nullable();
            $table->date('join')->nullable();
            $table->string('store_email',255)->notNullable();
            $table->string('store_phone',255)->notNullable();
            $table->foreignId('address_id')->constrained('address')->onDelete('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};