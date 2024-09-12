@extends('layouts/client.app')
@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 20px;
    }

    .address-container {
        width: 100%;
        margin: 0 auto;
        background-color: white;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 20px;
    }

    h2 {
        margin-top: 3px;
        margin-bottom: 16px;
        font-size: 30px;
    }

    .address-card {
        padding: 15px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .address-info p {
        margin: 5px 0;
        font-size: 14px;
    }

    .default {
        color: red;
        font-size: 13px;
    }

    .address-actions {
        margin-top: 10px;
    }

    button {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 5px;
        font-size: 14px;
    }

    .update-btn {
        background-color: #007bff;
        color: white;
    }

    .delete-btn {
        background-color: #dc3545;
        color: white;
    }

    .set-default-btn {
        background-color: #6c757d;
        color: white;
        cursor: not-allowed;
    }

    .add-new-btn {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        font-size: 14px;
        border-radius: 5px;
    }
</style>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="btn btn-success" aria-current="true">
                        <i class="fa fa-user"></i>
                        Datbui2503
                        <span class="btn btn-success rounded-pill" style="float: right;">
                            <i class="fa fa-pencil"></i>
                        </span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-gift"></i> Ưu Đãi
                        Dành Riêng Cho Bạn <span class="badge bg-primary rounded-pill"
                            style="float: right;">New</span></a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-money"></i> 25.8 Lương Về
                        Sale To <span class="badge bg-primary rounded-pill" style="float: right;">New</span></a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-key"></i> Tài
                        Khoản Của Tôi</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-bank"></i> Ngân
                        Hàng</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-map-marker"></i> Địa
                        Chỉ</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-lock"></i> Đổi Mật
                        Khẩu</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-bell"></i> Cài Đặt
                        Thông Báo</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-cog"></i> Những Thiết
                        Lập Riêng Tư</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-shopping-cart"></i> Đơn
                        Mua</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-bell"></i> Thông
                        Báo</a>
                    <a href="voucher.html" class="list-group-item list-group-item-action"><i class="fa fa-gift"></i> Kho
                        Voucher</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-money"></i> Shopee Xu</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="address-container">
                    <h2>Địa chỉ của tôi</h2>
                    <div class="address-card">
                        <div class="address-info">
                            <p><strong>Trần Quốc Kiệt</strong> | 0012321312</p>
                            <p>Giang Thành, Kiên Giang</p>
                            <p class="default">Mặc định</p>
                        </div>
                        <div class="address-actions">
                            <button class="update-btn">Cập nhật</button>
                            <button class="delete-btn">Xóa</button>
                            <button class="set-default-btn" disabled>Thiết lập mặc định</button>
                        </div>

                    </div>
                    <div class="address-card">
                        <div class="address-info">
                            <p><strong>Trần Quốc Kiệt</strong> | 0012321312</p>
                            <p>Giang Thành, Kiên Giang</p>
                            <p class="default">Mặc định</p>
                        </div>
                        <div class="address-actions">
                            <button class="update-btn">Cập nhật</button>
                            <button class="delete-btn">Xóa</button>
                            <button class="set-default-btn" disabled>Thiết lập mặc định</button>
                        </div>

                    </div>
                    <div class="address-card">
                        <div class="address-info">
                            <p><strong>Trần Quốc Kiệt</strong> | 0012321312</p>
                            <p>Giang Thành, Kiên Giang</p>
                            <p class="default">Mặc định</p>
                        </div>
                        <div class="address-actions">
                            <button class="update-btn">Cập nhật</button>
                            <button class="delete-btn">Xóa</button>
                            <button class="set-default-btn" disabled>Thiết lập mặc định</button>
                        </div>

                    </div>
                    <button class="add-new-btn">+ Thêm địa chỉ mới</button>
                </div>
            </div>

        </div>
    </div>
    s
</section>
@endsection