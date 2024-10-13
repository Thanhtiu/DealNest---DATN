<style>
    .list-group {
    font-size: 16px;
}

.list-group-item {
    position: relative;
    padding: 15px 20px;
    font-weight: 500;
    border: 1px solid #ddd;
    transition: all 0.3s ease;
    background-color: #f9f9f9;
}

.list-group-item:hover {
    background-color: #f1f1f1;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.list-group-item i {
    font-size: 18px;
    margin-right: 10px;
    color: #555;
}

.active-sidebar {
    background-color: #007bff;
    color: #fff;
    border-color: #007bff;
}

.active-sidebar i {
    color: #fff;
}

.edit-profile {
    background-color: #fff;
    color: #007bff;
    font-size: 14px;
    padding: 5px 10px;
    transition: all 0.3s ease;
}

.edit-profile:hover {
    background-color: #f1f1f1;
    color: #007bff;
}

.edit-profile i {
    font-size: 14px;
}

.btn-light {
    border: 1px solid #ddd;
}

.list-group-item-action:hover {
    background-color: #f8f9fa;
    color: #007bff;
}

.list-group-item-action:hover i {
    color: #007bff;
}

.list-group-item.active-sidebar .edit-profile {
    background-color: #007bff;
    color: #fff;
    border-color: #fff;
}

</style>
<div class="list-group">
    <a href="{{route('account.profile.index')}}" class="list-group-item list-group-item-action active-sidebar">
        <i class="bi bi-person-circle"></i>
        @if(Session::has('userFullName'))
        {{Session::get('userFullName')}}
        @endif
        <span class="btn btn-light rounded-pill edit-profile" style="float: right;">
            <i class="bi bi-pencil-fill"></i>
        </span>
    </a>

    <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-person"></i> Tài Khoản Của Tôi</a>
    <a href="{{route('client.follow')}}" class="list-group-item list-group-item-action"><i class="bi bi-shop"></i> Cửa Hàng Theo Dõi</a>
    <a href="{{route('account.address.index')}}" class="list-group-item list-group-item-action"><i class="bi bi-geo-alt"></i> Địa Chỉ</a>
    <a href="#" class="list-group-item list-group-item-action"><i class="bi bi-shield-lock"></i> Đổi Mật Khẩu</a>
    <a href="{{route('client.order')}}" class="list-group-item list-group-item-action"><i class="bi bi-cart"></i> Đơn Mua</a>
    <a href="{{route('client.favourite')}}" class="list-group-item list-group-item-action"><i class="bi bi-heart-fill"></i> Yêu Thích</a>
    <a href="voucher.html" class="list-group-item list-group-item-action"><i class="bi bi-gift"></i> Kho Voucher</a>
    <a href="{{route('account.logout')}}" class="list-group-item list-group-item-action"><i class="bi bi-box-arrow-right"></i> Đăng Xuất</a>
</div>
