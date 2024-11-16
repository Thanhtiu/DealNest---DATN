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
        padding: 5px 0;
        /* Thêm khoảng cách cho các tab */
        transition: color 0.3s ease, border-bottom 0.3s ease;
        /* Hiệu ứng chuyển tiếp */
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
        transition: border 0.3s ease;
        /* Hiệu ứng chuyển tiếp cho border */
    }

    .search-bar input:focus {
        border-color: #0d6efd;
        /* Đổi màu border khi focus */
        outline: none;
        /* Bỏ outline mặc định */
    }

    .search-bar button {
        background-color: #0d6efd;
        color: #fff;
        padding: 8px 20px;
        border: none;
        margin-left: 10px;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        /* Hiệu ứng chuyển tiếp */
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
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* Thêm bóng để làm nổi bật */
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
        align-items: center;
        padding: 10px;
        margin-bottom: 15px;
        background-color: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #e1e1e1;
        transition: background-color 0.3s ease;
        /* Hiệu ứng chuyển tiếp */
    }

    .order-item:hover {
        background-color: #e9e9e9;
        /* Thay đổi màu nền khi hover */
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
        transition: background-color 0.3s ease;
        /* Hiệu ứng chuyển tiếp */
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
        transition: background-color 0.3s ease;
        /* Hiệu ứng chuyển tiếp */
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
                        @include('layouts.client.order', ['orders' => $all])

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
<!-- Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" role="dialog" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewModalLabel">Đánh giá sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Đóng">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Thêm form -->
                <form id="reviewForm" action="{{route('client.review.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf <!-- Thêm token CSRF để bảo mật -->

                    <!-- Thông tin sản phẩm -->
                    <div class="product-info">
                        <img src="https://via.placeholder.com/80" id="modalProductImage" alt="Hình ảnh sản phẩm">
                        <div>
                            <h6 id="modalProductName">Tên sản phẩm</h6>
                            <p id="modalProductType">Phân loại: Điện tử</p>
                            <input type="hidden" id="productId" name="product_id">
                            <input type="hidden" id="classify" name="classify">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="rating">Đánh giá:</label>
                        <select class="form-control" id="rating" name="rating">
                            <option value="5">⭐️⭐️⭐️⭐️⭐️</option>
                            <option value="4">⭐️⭐️⭐️⭐️</option>
                            <option value="3">⭐️⭐️⭐️</option>
                            <option value="2">⭐️⭐️</option>
                            <option value="1">⭐️</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="reviewText">Nội dung đánh giá:</label>
                        <textarea class="form-control" id="reviewText" name="description" rows="4" placeholder="Nhập nội dung đánh giá"></textarea>
                    </div>

                    <!-- Nút chọn hình ảnh -->
                    <label for="imageUpload" class="custom-file-upload">
                        <i class="bi bi-camera"></i> Thêm hình ảnh
                        <input type="file" id="imageUpload" name="images[]" accept="image/*" multiple style="display: none;" />
                    </label>

                    <!-- Khu vực hiển thị hình ảnh đã chọn -->
                    <div id="imagePreview" class="image-preview mt-3"></div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary" id="submitReviewButton">Gửi đánh giá</button> <!-- Thêm id cho nút -->
                    </div>
                </form>
            </div>


        </div>
    </div>
</div>

<script src="{{asset('client/js/tabindex.js')}}"></script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.cancel-order-item').forEach(function(button) {
            button.addEventListener('click', function() {
                var orderId = this.getAttribute('data-order-id');
                var status = this.getAttribute('data-status');
                var orderElement = document.getElementById('order-' + orderId);

                console.log('Order ID:', orderId);
                console.log(orderElement);

                fetch('{{ route("acccount.order.updateStatus") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            order_item_id: orderId,
                            status: status
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            orderElement.style.transition = 'opacity 0.5s';
                            orderElement.style.opacity = '0';
                            setTimeout(() => {
                                orderElement.remove();
                            }, 500);
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        toastr.error('Có lỗi xảy ra khi cập nhật trạng thái đơn hàng.');
                    });
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        const style = `
            <style>
                .image-preview {
                    display: flex;
                    flex-wrap: wrap;
                }

                .image-thumbnail {
                    margin: 5px;
                }
            </style>
        `;
        $('head').append(style);

        $('.review-button').on('click', function() {
            const productId = $(this).data('product-id');
            const productName = $(this).data('product-name');
            const productImage = $(this).data('product-image');
            const productType = $(this).data('product-type');
            const classify = $(this).data('classify');

            $('#productId').val(productId);
            $('#classify').val(productType);
            $('#modalProductName').text(productName);
            $('#modalProductImage').attr('src', productImage);
            $('#modalProductType').text(productType);
            $('#imagePreview').empty();
        });

        // Xử lý sự kiện khi chọn hình ảnh
        $('#imageUpload').on('change', function() {
            const files = this.files;
            $('#imagePreview').empty();

            const maxFiles = 5;
            const fileCount = files.length > maxFiles ? maxFiles : files.length;

            for (let i = 0; i < fileCount; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    if ($('#imagePreview').find(`img[src="${e.target.result}"]`).length === 0) {
                        $('#imagePreview').append(`
                            <div class="image-thumbnail">
                                <img src="${e.target.result}" alt="Hình ảnh sản phẩm" style="width: 100px; height: 100px;">
                            </div>
                        `);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>


@endsection