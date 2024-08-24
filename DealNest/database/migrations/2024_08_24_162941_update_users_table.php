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
        Schema::table('users', function (Blueprint $table) {
            $table->string('full_name', 255)->notNullable();
            $table->string('phone', 255)->notNullable();
            $table->string('image')->nullable();
            $table->enum('role', ['admin', 'seller','buyer'])->notNullable();
            $table->boolean('is_active')->default(true);
            $table->string('google_id', 255)->nullable();
            $table->string('google_email', 255)->nullable();
            $table->string('google_image', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'full_name',
                'phone',
                'image',
                'role',
                'is_active',
                'google_id',
                'google_email',
                'google_image',
            ]);
        });
    }
};