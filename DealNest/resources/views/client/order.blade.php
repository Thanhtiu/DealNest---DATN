@extends('layouts.client.app')
@section('content')
<!-- Bootstrap CSS and Icons -->

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
    /* Tabs Styling */
.tabs-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid #e1e1e1;
    margin-bottom: 20px;
}

.tabs-container .tabs {
    display: flex;
    width: 100%;
}

.tabs-container .tabs a {
    color: #333;
    text-decoration: none;
    margin-right: 30px;
    border-bottom: 2px solid transparent;
    padding: 5px 0; /* Thêm khoảng cách cho các tab */
    transition: color 0.3s ease, border-bottom 0.3s ease; /* Hiệu ứng chuyển tiếp */
}

.tabs-container .tabs a.active {
    color: #f53d2d;
    border-bottom: 2px solid #f53d2d;
}

/* Search Bar */
.search-bar {
    display: flex;
    align-items: center;
    margin: 15px 0;
}

.search-bar input {
    padding: 8px 15px;
    width: 100%;
    max-width: 600px;
    border: 1px solid #e1e1e1;
    border-radius: 4px;
    transition: border 0.3s ease; /* Hiệu ứng chuyển tiếp cho border */
}

.search-bar input:focus {
    border-color: #0d6efd; /* Đổi màu border khi focus */
    outline: none; /* Bỏ outline mặc định */
}

.search-bar button {
    background-color: #0d6efd;
    color: #fff;
    padding: 8px 20px;
    border: none;
    margin-left: 10px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease; /* Hiệu ứng chuyển tiếp */
}

.search-bar button:hover {
    background-color: #e03a26;
}

/* Order Section */
.order-container {
    background-color: #fff;
    border: 1px solid #e1e1e1;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Thêm bóng để làm nổi bật */
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #e1e1e1;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.order-header-left {
    font-weight: bold;
    color: #f53d2d;
}

.order-header-right {
    color: #9e9e9e;
    display: flex;
    align-items: center;
}

/* Order Item */
.order-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    margin-bottom: 15px;
    background-color: #f9f9f9;
    border-radius: 8px;
    border: 1px solid #e1e1e1;
    transition: background-color 0.3s ease; /* Hiệu ứng chuyển tiếp */
}

.order-item:hover {
    background-color: #e9e9e9; /* Thay đổi màu nền khi hover */
}

.order-item-image {
    width: 100px;
    height: 100px;
    margin-right: 15px;
    overflow: hidden;
}

.order-item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}

.order-item-info {
    display: flex;
    align-items: center;
    max-width: 60%;
}

.order-item-price {
    color: #f53d2d;
    font-weight: bold;
}

/* Updated Order Actions */
.order-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-top: 15px;
}

.order-actions button {
    background-color: #0d6efd;
    color: #fff;
    padding: 5px 10px;
    font-size: 14px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-left: 8px;
    min-width: 80px;
    transition: background-color 0.3s ease; /* Hiệu ứng chuyển tiếp */
}

.order-actions button:hover {
    background-color: #337ce8;
}

.order-actions .secondary-button {
    background-color: #f1f1f1;
    color: #333;
    padding: 5px 10px;
    font-size: 14px;
    border: 1px solid #e1e1e1;
    min-width: 80px;
    transition: background-color 0.3s ease; /* Hiệu ứng chuyển tiếp */
}

.order-actions .secondary-button:hover {
    background-color: #ddd;
}

/* Tab Content Visibility */
.tab-content {
    display: none;
}

.tab-content.active {
    display: block;
}

</style>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('layouts.client.sidebar')
            </div>
            <div class="col-md-9">
                <div class="order-container">
                    <div class="tabs-container">
                        <div class="tabs">
                            <a href="#tab-all" class="active">Tất cả</a>
                            <a href="#tab-pending">Chờ xác nhận</a>
                            <a href="#tab-shipping">Chờ giao hàng</a>
                            <a href="#tab-completed">Hoàn thành</a>
                            <a href="#tab-rejected">Đã từ chối</a>
                            <a href="#tab-canceled">Đã hủy</a>
                        </div>
                    </div>

                    <!-- Tab nội dung -->
                    <div id="tab-all" class="tab-content active">
                    </div>

                    <div id="tab-pending" class="tab-content">
                        @include('layouts.client.order', ['orders' => $pending])
                    </div>

                    <div id="tab-shipping" class="tab-content">
                        @include('layouts.client.order', ['orders' => $waitingForDelivery])
                    </div>

                    <div id="tab-completed" class="tab-content">
                        @include('layouts.client.order', ['orders' => $completed])
                    </div>

                    <div id="tab-rejected" class="tab-content">
                        @include('layouts.client.order', ['orders' => $refuse])
                    </div>

                    <div id="tab-canceled" class="tab-content">
                        @include('layouts.client.order', ['orders' => $cancelled])
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script src="{{asset('client/js/tabindex.js')}}"></script>
<script>
    $(document).on('click', '.cancel-order-item', function() {
        var orderItemId = $(this).data('order-item-id');
        var status = $(this).data('status'); // Lấy giá trị trạng thái từ data-status
        var orderItemElement = $(this).closest('.order-item'); // Lấy phần tử chứa thông tin sản phẩm

        console.log(orderItemElement); // Kiểm tra xem phần tử có được chọn đúng không

        $.ajax({
            url: '{{ route("acccount.order.updateStatus") }}',
            type: 'POST',
            data: {
                order_item_id: orderItemId,
                status: status, // Truyền trạng thái động
                _token: '{{ csrf_token() }}' // Đảm bảo bảo vệ CSRF
            },
            success: function(response) {
                if (response.success) {

                    // Ẩn hoặc loại bỏ mục OrderItem khỏi giao diện sau khi cập nhật thành công
                    orderItemElement.fadeOut(500, function() {
                        $(this).remove(); // Xóa phần tử khỏi DOM
                    });
                    toastr.success(response.message);
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Có lỗi xảy ra khi cập nhật trạng thái đơn hàng.');
            }
        });
    });
</script>
@endsection