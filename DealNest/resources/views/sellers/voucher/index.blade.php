@extends('layouts.sellers.app')
@section('content')
<style>
    .voucher-card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-bottom: 20px;
        overflow: hidden;
        background-color: #fff;
        padding: 20px;
        height: 100%;
    }

    .voucher-name {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .voucher-code {
        font-size: 1rem;
        font-weight: bold;
        background-color: #ffefc1;
        padding: 5px;
        border-radius: 4px;
        display: inline-block;
    }

    .voucher-type {
        font-size: 0.9rem;
        color: #888;
        margin-top: 10px;
    }

    .voucher-value {
        font-size: 1.2rem;
        font-weight: bold;
        color: #28a745;
    }

    .voucher-status {
        margin-top: 10px;
        font-size: 0.9rem;
    }

    .voucher-status.active {
        color: #28a745;
    }

    .voucher-status.expired {
        color: #dc3545;
    }

    .voucher-dates {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 10px;
    }

    .voucher-actions {
        margin-top: 15px;
    }

    .voucher-actions .btn {
        margin-right: 10px;
    }
</style>
<div class="container voucher-list">
    <h2 class="text-center mb-4">Danh Sách Voucher</h2>

    <div class="row">
        <!-- Voucher 1 -->
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="voucher-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="voucher-name">Khuyến mãi mùa hè</span>
                    <span class="voucher-code">SUMMER2024</span>
                </div>
                <p class="voucher-type">Loại: Giảm giá theo phần trăm</p>
                <p class="voucher-value">Giảm: 20%</p>
                <p class="voucher-status active">Trạng thái: Có hiệu lực</p>
                <p class="voucher-dates">Thời gian: 01/06/2024 - 31/08/2024</p>
                
                <!-- Nút Edit và Xóa -->
                <div class="voucher-actions">
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Xóa</a>
                </div>
            </div>
        </div>

        <!-- Voucher 2 -->
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="voucher-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="voucher-name">Giảm giá đặc biệt</span>
                    <span class="voucher-code">SPECIAL2024</span>
                </div>
                <p class="voucher-type">Loại: Giảm giá theo mệnh giá</p>
                <p class="voucher-value">Giảm: 50.000 VND</p>
                <p class="voucher-status expired">Trạng thái: Hết hiệu lực</p>
                <p class="voucher-dates">Thời gian: 01/01/2024 - 31/03/2024</p>
                
                <!-- Nút Edit và Xóa -->
                <div class="voucher-actions">
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Xóa</a>
                </div>
            </div>
        </div>

        <!-- Voucher 3 -->
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="voucher-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="voucher-name">Khuyến mãi mùa đông</span>
                    <span class="voucher-code">WINTER2024</span>
                </div>
                <p class="voucher-type">Loại: Giảm giá theo phần trăm</p>
                <p class="voucher-value">Giảm: 10%</p>
                <p class="voucher-status active">Trạng thái: Có hiệu lực</p>
                <p class="voucher-dates">Thời gian: 01/12/2024 - 28/02/2025</p>
                
                <!-- Nút Edit và Xóa -->
                <div class="voucher-actions">
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Xóa</a>
                </div>
            </div>
        </div>

        <!-- Voucher 4 -->
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="voucher-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="voucher-name">Giảm giá mùa thu</span>
                    <span class="voucher-code">AUTUMN2024</span>
                </div>
                <p class="voucher-type">Loại: Giảm giá theo phần trăm</p>
                <p class="voucher-value">Giảm: 15%</p>
                <p class="voucher-status active">Trạng thái: Có hiệu lực</p>
                <p class="voucher-dates">Thời gian: 01/09/2024 - 30/11/2024</p>
                
                <!-- Nút Edit và Xóa -->
                <div class="voucher-actions">
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Xóa</a>
                </div>
            </div>
        </div>

        <!-- Voucher 5 -->
        <div class="col-12 col-md-6 col-lg-4 mb-4">
            <div class="voucher-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="voucher-name">Giảm giá dịp lễ</span>
                    <span class="voucher-code">HOLIDAY2024</span>
                </div>
                <p class="voucher-type">Loại: Giảm giá theo mệnh giá</p>
                <p class="voucher-value">Giảm: 100.000 VND</p>
                <p class="voucher-status active">Trạng thái: Có hiệu lực</p>
                <p class="voucher-dates">Thời gian: 01/12/2024 - 01/01/2025</p>
                
                <!-- Nút Edit và Xóa -->
                <div class="voucher-actions">
                    <a href="#" class="btn btn-primary">Edit</a>
                    <a href="#" class="btn btn-danger">Xóa</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
