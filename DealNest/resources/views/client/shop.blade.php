@extends('layouts.client.app')
@section('content')
<div class="container mt-5">
    <div class="shop-header">
        <div class="row align-items-center">
            <div class="col-md-2">
                <img src="https://img.lovepik.com/free-png/20211204/lovepik-cartoon-avatar-png-image_401302777_wh1200.png" alt="Shop Logo" class="img-fluid rounded-circle">
            </div>
            <div class="col-md-6">
                <div class="shop-name">Qkiet</div>
                <div class="shop-stats">
                    <span><i class="fas fa-box-open"></i>Sản Phẩm: <strong>93k</strong></span> | 
                    <span><i class="fas fa-user-friends"></i>Đang Theo: <strong>3</strong></span> | 
                    <span><i class="fas fa-comment-dots"></i>Tỉ Lệ Phản Hồi Chat: <strong>100%</strong> (Trong Vài Phút)</span> | 
                    <span><i class="fas fa-ban"></i>Tỉ Lệ Shop Hủy Đơn: <strong>5%</strong></span>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <button class="btn btn-primary"><i class="fas fa-plus"></i> THEO DÕI</button>
                <button class="btn btn-secondary"><i class="fas fa-comments"></i> CHAT</button>
            </div>
        </div>
        <hr>
        <div class="shop-info">
            <div>
                <span><i class="fas fa-users"></i>Người Theo Dõi: <strong>18k</strong></span> | 
                <span><i class="fas fa-star"></i>Đánh Giá: <strong>4.7</strong> (3k Đánh Giá)</span> | 
                <span><i class="fas fa-calendar-alt"></i>Tham Gia: <strong>1 Tháng Trước</strong></span>
            </div>
        </div>
    </div>
    <nav class="mt-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="#"><i class="fas fa-store"></i> Dạo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-list"></i> TẤT CẢ SẢN PHẨM</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-female"></i> Thời Trang Nữ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-paint-brush"></i> Sắc Đẹp</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-gem"></i> Phụ Kiện & Trang Sức</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="fas fa-biking"></i> Thể Thao & Du Lịch</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><i class="fas fa-ellipsis-h"></i> Thêm</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-caret-right"></i> Menu Item 1</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-caret-right"></i> Menu Item 2</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
@endsection