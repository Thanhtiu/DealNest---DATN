@extends('layouts/client.app')
@section('content')
<style>
    .card-profile{
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 3px;
        height: 800px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-add{
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 3px;
        height: 200px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-pro{
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        background-color: #f8f9fa;
    }
    .profile-card-body {
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .profile-form-label {
        font-weight: bold;
        margin-bottom: 5px;
    }
    .profile-form-control {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
        margin-bottom: 10px;
    }
    .profile-form-text {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
    }
    .profile-btn {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 5px;
    }
    .profile-btn-primary {
        background-color: #007bff;
        color: white;
    }
    .profile-form-check-inline {
        margin-right: 10px;
    }
    .profile-input-group {
        display: flex;
        align-items: center;
    }
    .profile-input-group-text {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px 0 0 4px;
    }
    .profile-form-select {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 0 4px 4px 0;
        width: 100px;
    }
    /* Avatar Section */
    .avatar-card-body {
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .avatar-img-fluid {
        width: 100%;
        height: auto;
    }
    .avatar-rounded-circle {
        border-radius: 50%;
    }
    .avatar-mx-auto {
        margin-left: auto;
        margin-right: auto;
    }
    .avatar-d-block {
        display: block;
    }
    .avatar-mt-3 {
        margin-top: 15px;
    }
    .avatar-mt-2 {
        margin-top: 10px;
    }

    /* Fix for disappearing text */
    .profile-btn-link {
        background: none;
        color: #007bff;
        text-decoration: none;
        padding: 0;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .profile-btn-link:hover {
        text-decoration: underline;
        color: #0056b3;
    }
</style>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="btn btn-primary"
                        aria-current="true">
                        <i class="fa fa-user"></i>
                        Datbui2503
                        <span class="btn btn-primary rounded-pill" style="float: right;">
                            <i class="fa fa-pencil"></i>
                        </span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-gift"></i> Ưu Đãi
                        Dành Riêng Cho Bạn <span class="badge bg-primary rounded-pill" style="float: right;">New</span></a>
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
                    <a href="voucher.html" class="list-group-item list-group-item-action"><i class="fa fa-gift"></i> Kho Voucher</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-money"></i> Shopee Xu</a>
                </div>
            </div>
            <div class="col-md-6 profile-content">
                <div class="card-profile">
                    <div class="card-pro">
                        <h4>Hồ Sơ Của Tôi</h4>
                        <p class="card-text">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                    </div>
                    <div class="profile-card-body">
                        <div class="profile-mb-3">
                            <label for="username" class="profile-form-label">Tên đăng nhập</label>
                            <input type="text" class="profile-form-control" id="username" value="datbui" readonly>
                            <small class="profile-form-text profile-text-muted">Tên Đăng nhập chỉ có thể thay đổi một lần.</small>
                        </div>
                        <div class="profile-mb-3">
                            <label for="name" class="profile-form-label">Tên</label>
                            <input type="text" class="profile-form-control" id="name">
                        </div>
                        <div class="profile-mb-3">
                            <label for="email" class="profile-form-label">Email</label>
                            <input type="email" class="profile-form-control" id="email" value="" readonly>
                            <a href="#" class="profile-btn profile-btn-link">Thay Đổi</a>
                        </div>
                        <div class="profile-mb-3">
                            <label for="phone" class="profile-form-label">Số điện thoại</label>
                            <input type="tel" class="profile-form-control" id="phone">
                            <a href="#" class="profile-btn profile-btn-link">Thêm</a>
                        </div>
                        <div class="profile-mb-3">
                            <label for="gender" class="profile-form-label">Giới tính</label>
                            <div class="profile-form-check profile-form-check-inline">
                                <input class="profile-form-check-input" type="radio" name="gender" id="male" value="male">
                                <label class="profile-form-check-label" for="male">Nam</label>
                            </div>
                            <div class="profile-form-check profile-form-check-inline">
                                <input class="profile-form-check-input" type="radio" name="gender" id="female" value="female">
                                <label class="profile-form-check-label" for="female">Nữ</label>
                            </div>
                            <div class="profile-form-check profile-form-check-inline">
                                <input class="profile-form-check-input" type="radio" name="gender" id="other" value="other">
                                <label class="profile-form-check-label" for="other">Khác</label>
                            </div>
                        </div>
                        <div class="profile-mb-3">
                            <label for="birthday" class="profile-form-label">Ngày sinh</label>
                            <div class="profile-input-group">
                                <input type="number" class="profile-form-control" id="day" value="23" min="1" max="31">
                                <span class="profile-input-group-text">/</span>
                                <select class="profile-form-select" id="month">
                                    <option value="1">Tháng 1</option>
                                    <option value="2">Tháng 2</option>
                                    <option value="3">Tháng 3</option>
                                    <option value="4">Tháng 4</option>
                                    <option value="5">Tháng 5</option>
                                    <option value="6">Tháng 6</option>
                                    <option value="7">Tháng 7</option>
                                    <option value="8">Tháng 8</option>
                                    <option value="9">Tháng 9</option>
                                    <option value="10">Tháng 10</option>
                                    <option value="11">Tháng 11</option>
                                    <option value="12">Tháng 12</option>
                                </select>
                                <span class="profile-input-group-text">/</span>
                                <input type="number" class="profile-form-control" id="year" value="2024" min="1900" max="2024">
                            </div>
                        </div>
                        <button type="submit" class="profile-btn profile-btn-primary">Lưu</button>
                    </div>
                </div>
            </div>

            <div class="col-md-3 avatar-content">
                <div class="card-add">
                    <div class="card-header">
                        <h4>Ảnh đại diện</h4>
                    </div>
                    <div class="avatar-card-body">
                        <img src="" alt="Ảnh đại diện" class="avatar-img-fluid avatar-rounded-circle avatar-mx-auto avatar-d-block" style="width: 150px;">
                        <button type="button" class="profile-btn profile-btn-success avatar-mt-3">Chọn Ảnh</button>
                        <small class="profile-form-text profile-text-muted avatar-mt-2">Dung lượng file tối đa 1 MB. Định dạng: JPEG, PNG</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
