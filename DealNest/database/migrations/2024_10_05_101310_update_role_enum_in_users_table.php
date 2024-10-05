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
          // Cập nhật enum của cột role
          $table->enum('role', ['admin', 'seller', 'buyer', 'employer'])->default('buyer')->change();
          $table->string('cccd')->nullable()->after('role'); // 'after' để thêm sau cột 'role'
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('users', function (Blueprint $table) {
          // Quay lại giá trị enum ban đầu
          $table->enum('role', ['admin', 'seller', 'buyer'])->default('buyer')->change();
          $table->dropColumn('cccd');
      });
    }
};
