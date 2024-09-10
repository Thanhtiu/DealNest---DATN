@extends('layouts/client.app')
@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="#" class="btn btn-success"
                        aria-current="true">
                        <i class="fa fa-user"></i>
                        Datbui2503
                        <span class="btn btn-success rounded-pill" style="float: right;">
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
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h4>Địa chỉ của tôi</h4>
                        <p class="card-text"></p>
                    </div>
                    <div class="card-body">
                        <div class="address mt-3">
                            <strong>Trần Quốc Kiệt </strong>| 0012321312 
                            <p>Giang Thành Kiên Giang</p>
                            <span class="text-danger">Mặc định</span>
                            <div class="mt-3">
                                <button class="btn btn-primary">Cập nhật</button>
                                <button class="btn btn-danger">Xóa</button>          
                                <button class="btn btn-secondary ">Thiết lập mặc định</button>     
                        </div>
                        
                    </div>   
                    
                        <button class="btn btn-success  mt-4">+ Thêm địa chỉ mới</button>
                    </div>
                    </div>  
            </div>
            
        </div>
    </div>
</section>
@endsection