@extends('layouts.client.app')
@section('content')

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f9f9f9;

    }

    .shop-container {
        max-width: 1200px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .shop-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .logo {
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: relative;
        width: 40%;
        background-image: url('https://shardaproduction.com.np/wp-content/uploads/2024/02/Logo-Designing.jpg');
        background-size: cover;
        background-position: center;
        padding: 20px;
        border-radius: 10px;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.3);
    }

    .shop-image {
        text-align: center;
        position: relative;
    }

    .shop-image img {
        border-radius: 50%;
        width: 80px;
        height: 80px;
        border: 2px solid #ddd;
    }

    .favorite-btn {
        background-color: #f44336;
        color: #fff;
        border: none;
        padding: 4px 15px;
        font-size: 13px;


    }

    .shop-info {
        margin-left: 20px;
        color: #fff;
    }

    .shop-info h1 {
        margin: 0;
        font-size: 1.8em;
        color: #fff;
    }

    .shop-info p {
        margin: 5px 0;
        color: #fff;
    }

    .follow-btn {
        background-color: blue;
        color: #fff;
        border: 2px solid blue;
        padding: 5px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
    }

    .shop-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        font-size: 15px;
        color: #666;
    }

    .stat-item {
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .stat-item i {
        margin-right: 10px;
        font-size: 20px;
        color: #666;
    }

    .highlight {
        color: red;
        font-weight: bold;
    }

    .shop-categories {
        display: flex;
        justify-content: space-between;
        border-top: 2px solid #ddd;
        padding-top: 10px;
        margin-top: 20px;
        font-size: 14px;
        color: #555;
    }

    .shop-categories span {
        cursor: pointer;
        padding: 5px;
    }

    .shop-categories span.active {
        color: red;
        border-bottom: 2px solid red;
    }

    .shop-categories span:hover {
        color: red;
        border-bottom: 2px solid red;
    }
</style>

<div class="shop-container">
    <div class="shop-header">
        <div class="logo">
            <div class="shop-image">
                <img src="https://shardaproduction.com.np/wp-content/uploads/2024/02/Logo-Designing.jpg"
                    alt="Shop Logo">
                <button class="favorite-btn">Yêu thích</button>
            </div>
            <div class="shop-info">
                <h1>Qkiet_Shop Quần Áo</h1>
                <p>Online 2 phút trước</p>
                <button class="follow-btn">ĐANG THEO</button>
            </div>
        </div>
        <div class="shop-stats">
            <div class="stat-item"><i class="fa fa-shopping-bag"></i> Sản Phẩm: <span class="highlight">23</span></div>
            <div class="stat-item"><i class="fa fa-users"></i> Đang Theo: <span class="highlight">1000</span></div>
            <div class="stat-item"><i class="fa fa-comments"></i> Tỉ Lệ Phản Hồi Chat: <span
                    class="highlight">95%</span> (Trong Vài Giờ)</div>
            <div class="stat-item"><i class="fa fa-user-plus"></i> Người Theo Dõi: <span class="highlight">3k</span>
            </div>
            <div class="stat-item"><i class="fa fa-star"></i> Đánh Giá: <span class="highlight">5</span> (10k Đánh Giá)
            </div>
            <div class="stat-item"><i class="fa fa-users"></i> Tham Gia: <span class="highlight">100 Năm
                    Trước</span></div>
        </div>
    </div>
    <div class="shop-categories">
        <span class="active">Dạo</span>
        <span>TẤT CẢ SẢN PHẨM</span>
        <span>Giá đỡ laptop</span>
        <span>túi chống sốc laptop và ...</span>
        <span>Thiết bị nhà bếp và đồ gi...</span>
        <span>chăm sóc cá nhân</span>
    </div>
</div>
@endsection