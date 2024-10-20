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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('address_id')->constrained('address')->onDelete('cascade');
            $table->string('name', 255)->notNullable();
            $table->string('description', 255)->nullable();
            $table->date('join')->nullable();
            $table->string('store_email', 255)->notNullable();
            $table->string('store_phone', 255)->notNullable();
            $table->string('logo', 255)->nullable();
            $table->string('background', 255)->nullable();
            $table->string('note', 255)->nullable();
            $table->integer('status')->default(1);
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
