<div class="list-group">
    <a href="{{route('account.profile.index')}}" class="btn btn-primary" aria-current="true">
        <i class="fa fa-user"></i>
        @if(Session::has('userFullName'))
        {{Session::get('userFullName')}}
        @endif
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
    <a href="{{route('account.address.index')}}" class="list-group-item list-group-item-action"><i class="fa fa-map-marker"></i> Địa
        Chỉ</a>
    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-lock"></i> Đổi Mật
        Khẩu</a>
    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-bell"></i> Cài Đặt
        Thông Báo</a>
    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-cog"></i> Những Thiết
        Lập Riêng Tư</a>
    <a href="{{route('client.order.index')}}" class="list-group-item list-group-item-action"><i class="fa fa-shopping-cart"></i> Đơn
        Mua</a>
    <a href="{{route('client.favourite')}}" class="list-group-item list-group-item-action"> <i class="bi bi-heart-fill bi-hear"></i> Yêu Thích</a>
    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-bell"></i> Thông
        Báo</a>
    <a href="voucher.html" class="list-group-item list-group-item-action"><i class="fa fa-gift"></i> Kho Voucher</a>
    <a href="#" class="list-group-item list-group-item-action"><i class="fa fa-money"></i> Shopee Xu</a>
    <a href="{{route('account.logout')}}" class="list-group-item list-group-item-action"><i class="fa fa-money"></i> Đăng xuất</a>
</div>