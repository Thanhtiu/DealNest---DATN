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
        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('discount_rate', 10, 2)->nullable()->after('total'); // thêm cột discount_rate với kiểu decimal
            $table->decimal('percent', 10, 2)->default(0.05)->after('discount_rate'); // thêm cột percent với giá trị mặc định là 0.05
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('discount_rate');
        });
    }
};
