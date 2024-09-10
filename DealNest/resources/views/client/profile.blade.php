@extends('layouts/client.app')
@section('content')
<style>
    body {
            font-family: sans-serif;
        }
        .custom-card-body {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .custom-form-label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .custom-form-control {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            margin-bottom: 10px;
        }
        .custom-form-text {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        .custom-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 5px;
        }
        .custom-btn-primary {
            background-color: #007bff;
            color: white;
        }
        .custom-btn-link {
            color: #007bff;
            text-decoration: none;
        }
        .custom-form-check-inline {
            margin-right: 10px;
        }
        .custom-input-group {
            display: flex;
            align-items: center;
        }
        .custom-input-group-text {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
        }
        .custom-form-select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 0 4px 4px 0;
            width: 100px;
        }
        .custom-text-muted {
            color: #666;
        }
        .custom-mb-3 {
            margin-bottom: 15px;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .left-sidebar {
            width: 200px;
        }
        .left-sidebar ul {
            list-style: none;
            padding: 0;
        }
        .left-sidebar li {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            display: flex;
            align-items: center;
        }
        .left-sidebar li .icon {
            margin-right: 10px;
        }
        .left-sidebar li a {
            text-decoration: none;
            color: #333;
        }
        .left-sidebar li a:hover {
            color: #007bff;
        }
        .right-content {
            flex: 1;
        }
        .right-content h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .custom-col-md-3 {
            width: 25%;
        }
        .custom-img-fluid {
            width: 100%;
            height: auto;
        }
        .custom-rounded-circle {
            border-radius: 50%;
        }
        .custom-mx-auto {
            margin-left: auto;
            margin-right: auto;
        }
        .custom-d-block {
            display: block;
        }
        .custom-mt-3 {
            margin-top: 15px;
        }
</style>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3 left-sidebar">
                <ul>
                    <li class="btn btn-success"
                        aria-current="true">
                        <i class="fa fa-user icon"></i>
                        Datbui2503
                        <span class="btn btn-success rounded-pill" style="float: right;">
                            <i class="fa fa-pencil"></i>
                        </span>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-gift icon"></i> Ưu Đãi
                            Dành Riêng Cho Bạn 
                            <span class="badge bg-primary rounded-pill" style="float: right;">New</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-money icon"></i> 25.8 Lương Về
                            Sale To 
                            <span class="badge bg-primary rounded-pill" style="float: right;">New</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-key icon"></i> Tài
                            Khoản Của Tôi
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bank icon"></i> Ngân
                            Hàng
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-map-marker icon"></i> Địa
                            Chỉ
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-lock icon"></i> Đổi Mật
                            Khẩu
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bell icon"></i> Cài Đặt
                            Thông Báo
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cog icon"></i> Những Thiết
                            Lập Riêng Tư
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-shopping-cart icon"></i> Đơn
                            Mua
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bell icon"></i> Thông
                            Báo
                        </a>
                    </li>
<li>
                        <a href="voucher.html"><i class="fa fa-gift icon"></i> Kho Voucher</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-money icon"></i> Shopee Xu</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6 right-content">
                <div class="card">
                    <div class="card-header">
                        <h4>Hồ Sơ Của Tôi</h4>
                        <p class="card-text">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                    </div>
                    <div class="custom-card-body">
                        <div class="custom-mb-3">
                            <label for="username" class="custom-form-label">Tên đăng nhập</label>
                            <input type="text" class="custom-form-control" id="username" value="datbui" readonly>
                            <small class="custom-form-text custom-text-muted">Tên Đăng nhập chỉ có thể thay đổi một lần.</small>
                        </div>
                        <div class="custom-mb-3">
                            <label for="name" class="custom-form-label">Tên</label>
                            <input type="text" class="custom-form-control" id="name">
                        </div>
                        <div class="custom-mb-3">
                            <label for="email" class="custom-form-label">Email</label>
                            <input type="email" class="custom-form-control" id="email" value="" readonly>
                            <a href="#" class="custom-btn custom-btn-link">Thay Đổi</a>
                        </div>
                        <div class="custom-mb-3">
                            <label for="phone" class="custom-form-label">Số điện thoại</label>
                            <input type="tel" class="custom-form-control" id="phone">
                            <a href="#" class="custom-btn custom-btn-link">Thêm</a>
                        </div>
                        <div class="custom-mb-3">
                            <label for="gender" class="custom-form-label">Giới tính</label>
                            <div class="custom-form-check custom-form-check-inline">
                                <input class="custom-form-check-input" type="radio" name="gender" id="male" value="male">
                                <label class="custom-form-check-label" for="male">Nam</label>
                            </div>
                            <div class="custom-form-check custom-form-check-inline">
                                <input class="custom-form-check-input" type="radio" name="gender" id="female" value="female">
<label class="custom-form-check-label" for="female">Nữ</label>
                            </div>
                            <div class="custom-form-check custom-form-check-inline">
                                <input class="custom-form-check-input" type="radio" name="gender" id="other" value="other">
                                <label class="custom-form-check-label" for="other">Khác</label>
                            </div>
                        </div>
                        <div class="custom-mb-3">
                            <label for="birthday" class="custom-form-label">Ngày sinh</label>
                            <div class="custom-input-group">
                                <input type="number" class="custom-form-control" id="day" value="23" min="1" max="31">
                                <span class="custom-input-group-text">/</span>
                                <select class="custom-form-select" id="month">
                                    <option value="8">Tháng 8</option>
                                    <option value="1">Tháng 1</option>
                                    <option value="2">Tháng 2</option>
                                    <option value="3">Tháng 3</option>
                                    <option value="4">Tháng 4</option>
                                    <option value="5">Tháng 5</option>
                                    <option value="6">Tháng 6</option>
                                    <option value="7">Tháng 7</option>
                                    <option value="9">Tháng 9</option>
                                    <option value="10">Tháng 10</option>
                                    <option value="11">Tháng 11</option>
                                    <option value="12">Tháng 12</option>
                                </select>
                                <span class="custom-input-group-text">/</span>
                                <input type="number" class="custom-form-control" id="year" value="2024" min="1900" max="2024">
                            </div>
                        </div>
                        <button type="submit" class="custom-btn custom-btn-primary">Lưu</button>
                    </div>
                    
                </div>
            </div>
            <div class="custom-col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Ảnh đại diện</h4>
                    </div>
                    <div class="custom-card-body">
                        <img src="" alt="Ảnh đại diện" class="custom-img-fluid custom-rounded-circle custom-mx-auto custom-d-block"
                            style="width: 150px;">
<button type="button" class="custom-btn custom-btn-success custom-mt-3">Chọn Ảnh</button>
                        <small class="custom-form-text custom-text-muted custom-mt-2">Dung lượng file tối đa 1 MB.
                            Định dạng: JPEG, PNG
                        </small>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection