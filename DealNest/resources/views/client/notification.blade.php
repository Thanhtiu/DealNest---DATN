@extends('layouts/client.app')
@section('content')
<style>
    h2 {
        margin-top: 3px;
        margin-bottom: 16px;
        font-size: 30px;
    }

    .notification-card {
        display: flex;
        align-items: center;
        background: #fff;
        border-radius: 1rem;
        padding: 1rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
        
    }

    .notification-card:hover {
        transform: scale(1.02);
    }

    .notification-image {
        width: 70px;
        height: 70px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #007bff;
        margin-right: 1rem;
    }

    .notification-content {
        flex: 1;
    }

    .notification-title {
        font-weight: 600;
        color: #333;
        font-size: 1.1rem;
        margin: 0;
    }

    .notification-text {
        color: #666;
        font-size: 0.95rem;
        margin: 0.3rem 0;
    }

    .notification-time {
        font-size: 0.85rem;
        color: #888;
    }

    .notification-button {
        text-align: right;
    }

    .btn-view {
        background-color: #007bff;
        color: #fff;
        padding: 0.4rem 0.8rem;
        font-size: 0.9rem;
        border-radius: 0.5rem;
        transition: background-color 0.3s ease;
    }

    .btn-view:hover {
        background-color: #0056b3;
    }
</style>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('layouts.client.sidebar')
            </div>
            <div class="col-md-9">
                <div class="notification-container mt-5">
                    <h2>Thông báo gần đây</h2>
                    <!-- Thông báo sản phẩm mới -->
                    <div class="notification-card">
                        <img src="https://via.placeholder.com/70" alt="Product Image" class="notification-image">

                        <div class="notification-content">
                            <p class="notification-title"><i class="bi bi-shop"></i> Cửa hàng ABC vừa đăng sản phẩm mới!</p>
                            <p class="notification-text">Sản phẩm mới: Giày thể thao X200 - Phong cách và thời trang dành cho bạn.</p>
                            <span class="notification-time">5 phút trước</span>
                        </div>

                        <div class="notification-button">
                            <a href="#" class="btn btn-view">Xem ngay</a>
                        </div>
                    </div>
                    <div class="notification-card">
                        <img src="https://via.placeholder.com/70" alt="Product Image" class="notification-image">

                        <div class="notification-content">
                            <p class="notification-title"><i class="bi bi-shop"></i> Cửa hàng ABC vừa đăng sản phẩm mới!</p>
                            <p class="notification-text">Sản phẩm mới: Giày thể thao X200 - Phong cách và thời trang dành cho bạn.</p>
                            <span class="notification-time">5 phút trước</span>
                        </div>

                        <div class="notification-button">
                            <a href="#" class="btn btn-view">Xem ngay</a>
                        </div>
                    </div>
                    <div class="notification-card">
                        <img src="https://via.placeholder.com/70" alt="Product Image" class="notification-image">

                        <div class="notification-content">
                            <p class="notification-title"><i class="bi bi-shop"></i> Cửa hàng ABC vừa đăng sản phẩm mới!</p>
                            <p class="notification-text">Sản phẩm mới: Giày thể thao X200 - Phong cách và thời trang dành cho bạn.</p>
                            <span class="notification-time">5 phút trước</span>
                        </div>

                        <div class="notification-button">
                            <a href="#" class="btn btn-view">Xem ngay</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection