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
        
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->notNullable();
            $table->string('code', 255);
            $table->string('descriptions', 255)->notNullable();
            $table->enum('type', ['percentage', 'fixed']);
            $table->dateTime('start_date')->notNullable();
            $table->dateTime('end_date')->notNullable();
            $table->boolean('status')->notNullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};