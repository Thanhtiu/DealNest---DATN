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
        Schema::table('products', function (Blueprint $table) {
            $table->enum('status', ['Chờ phê duyệt', 'Đã phê duyệt', 'Từ chối'])->default('Chờ phê duyệt')->change();
            $table->string('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->change();
        });
    }
};
