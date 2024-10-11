<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->enum('status', ['pending', 'waiting_for_delivery', 'success', 'cancel'])
                ->default('pending')->after('price');
            $table->string('cancellation_reason')->nullable()->after('status');
            $table->timestamp('canceled_at')->nullable()->after('cancellation_reason');
        });
    }

    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn('cancellation_reason');
            $table->dropColumn('canceled_at');
        });
    }
};
