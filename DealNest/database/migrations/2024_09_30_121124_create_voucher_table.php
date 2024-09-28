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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id(); // Tự động tạo khóa chính với auto-increment
            $table->string('name', 255)->notNullable(); // Tên promotion
            $table->string('code', 50)->unique()->notNullable(); // Mã code giảm độ dài xuống còn 50 ký tự, thêm unique
            $table->text('descriptions')->nullable(); // Cho phép mô tả dài hơn và có thể null
            $table->enum('type', ['percentage', 'fixed'])->notNullable(); // Loại giảm giá (theo phần trăm hoặc cố định)
            $table->decimal('value', 10, 2)->notNullable(); // Giá trị giảm giá (số tiền hoặc phần trăm)
            $table->dateTime('start_date')->notNullable(); // Thời gian bắt đầu
            $table->dateTime('end_date')->notNullable(); // Thời gian kết thúc
            $table->boolean('status')->default(1); // Trạng thái, mặc định là 1 (kích hoạt)
            $table->timestamps(); // Tự động tạo cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher');
    }
};
