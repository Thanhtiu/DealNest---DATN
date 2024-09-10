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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->integer('province_id');
            $table->integer('district_id');
            $table->integer('ward_id');
            $table->text('street');
            $table->text('string_address');
            $table->timestamps(); 
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
