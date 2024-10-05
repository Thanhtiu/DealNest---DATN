@extends('layouts.client.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css">

<style>
    /* General Styling */
    .container {
        width: 80%;
        margin: 20px auto;
        padding: 20px;
        border-radius: 10px;
        font-family: Arial, sans-serif;
    }

    /* Header */
    .header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .header h2 {
        font-size: 24px;
        color: #333;
        font-weight: bold;
    }

    /* Shipping Info */
    .shipping-info {
        border: 1px solid #ddd;
        padding: 15px;
        background-color: #fefefe;
        margin-bottom: 20px;
        position: relative;
    }

    .shipping-info h3 {
        color: #f56b00;
        font-size: 18px;
        margin-bottom: 8px;
    }

    .shipping-info .name {
        font-weight: bold;
        font-size: 16px;
        margin-bottom: 5px;
    }

    .shipping-info .address {
        color: #666;
        font-size: 14px;
    }

    .change-btn {
        position: absolute;
        right: 15px;
        top: 15px;
        background-color: transparent;
        color: #007bff;
        font-size: 12px;
        border: none;
        cursor: pointer;
    }

    /* Product Details */
    .product-details {
        border: 1px solid #ddd;
        padding: 15px;
        background-color: #fefefe;
    }


    .product {
        display: flex;
        justify-content: space-between;

    }

    .product img {
        width: 80px;
        height: 80px;
    }

    .product-info {
        flex: 1;
        margin-left: 10px;
    }

    .product-info p {
        font-size: 14px;
        margin-bottom: 5px;
    }

    .price-info {
        text-align: right;
        font-size: 14px;
    }

    /* Voucher & Shipping */
    .voucher,
    .shipping {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
        border-top: 1px solid #ddd;
        padding-top: 10px;
        font-size: 14px;
    }

    .voucher a,
    .shipping button {
        color: #007bff;
        font-size: 12px;
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .voucher a:hover,
    .chat:hover {
        color: #0056b3;
        /* Ensures that the link color changes but stays visible */
        text-decoration: none;
        /* Optional: removes underline on hover */
    }

    .total-price {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
        font-size: 18px;
        /* Increased font size */
        font-weight: bold;
        color: #ff4500;
        /* Orange-red for the total amount */
    }

    .price,
    .total-amount {
        font-size: 20px;
        /* Larger font size for emphasis */
        color: #ff4500;
        /* Matching orange-red color for total amount */
    }

    /* Additional Section */
    .additional-section {
        border: 1px solid #ddd;
        padding: 20px;
        background-color: #fefefe;
        margin-bottom: 20px;
    }

    .voucher-shopee,
    .shopee-xu,
    .payment-method {
        padding: 10px 0;
        border-top: 1px solid #ddd;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Payment Method */
    .payment-method {
        margin-bottom: 20px;
        /* Thêm khoảng cách dưới để tạo không gian */
        padding-bottom: 10px;
        /* Thêm một chút padding ở dưới cho sự phân tách tốt hơn */
        border-bottom: 1px solid #ddd;
        /* Thêm đường viền dưới để phân tách */
        font-size: 12px;
        /* Giảm kích thước chữ cho toàn bộ phần này */
    }

    .breakdow-method {
        margin-top: 10px;
        padding-top: 10px;
        font-size: 15px;
        text-align: right;
    }

    .payment-details {
        display: flex;
        justify-content: space-between;
        /* Căn chỉnh giữa nội dung */
        align-items: center;
        /* Căn giữa theo chiều dọc */
        width: 100%;
        /* Đảm bảo sử dụng toàn bộ chiều rộng */
    }

    .payment-details p {
        margin: 0;
        /* Xóa margin để căn chỉnh chính xác */
    }

    .breakdown {
        margin-top: 10px;
        /* Đảm bảo có khoảng cách phía trên phần breakdown */
        padding-top: 10px;
        /* Thêm padding ở trên cho sự phân tách */
        font-size: 12px;
        /* Giữ kích thước phông chữ cho các mục breakdown */
    }

    .payment-method h3 {
        font-size: 14px;
        /* Giảm kích thước chữ cho tiêu đề */
    }

    .payment-details p {
        font-size: 14px;
        /* Giảm kích thước chữ cho nội dung */
    }


    /* Nút Đặt hàng */
    .place-order {
        text-align: right;
        /* Căn chỉnh nút sang bên phải */
    }

    /* General link styling: remove underline and change color on hover */
    a {
        text-decoration: none;
        /* Removes underline for all links */
    }

    a:hover {
        text-decoration: none;
        /* Ensures underline stays removed when hovered */
        color: #0056b3;
        /* Keeps links visible with a darker blue on hover */
    }

    /* Keep 'Chọn Voucher' visible on hover */
    .voucher a {
        text-decoration: none;
        /* Removes underline */
        color: #007bff;
    }

    .voucher a:hover {
        color: #0056b3;
        /* Darker blue on hover, still visible */
    }

    /* Payment Details alignment */
    .payment-method .payment-details p {
        text-align: right;
        /* Aligns the payment method text to the right */
        margin: 0;
        /* Removes any default margin */
    }

    .payment-details a {
        text-align: right;
        /* Aligns the change link to the right */
    }


    /* Place Order Button */
    .place-order {
        text-align: right;
        /* Aligns the button to the right */
    }

    .place-order button {
        background-color: #ff4747;
        color: white;
        padding: 10px 20px;
        font-size: 14px;
        /* Slightly smaller font size */
        border-radius: 5px;
        border: none;
        cursor: pointer;
    }




    /* Chat Icon */
    .chat-icon {
        position: fixed;
        bottom: 20px;
        right: 20px;
    }

    /* Payment Method */
    .payment-method {
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px solid #ddd;
    }

    .payment-method h3 {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    .payment-details {
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: right;
    }

    .payment-details p {
        margin: 0;
        font-size: 14px;
        color: #333;
    }

    .payment-details a {
        text-decoration: none;
        font-size: 14px;
        color: #007bff;
        cursor: pointer;
    }

    .payment-details a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .payment-options {
        display: none;
        margin-top: 10px;
    }

    /* Payment Method Button */
    .payment-method-button {
        border: 1px solid #ddd;
        padding: 12px 20px;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        font-size: 14px;
        background-color: #fff;
        margin-bottom: 10px;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .payment-method-button:hover {
        background-color: #f1f1f1;
        border-color: #007bff;
    }

    .payment-method-button.active {
        background-color: #f56b00;
        border-color: #f56b00;
        color: #fff;
    }

    .payment-method-button.active:hover {
        background-color: #e64a00;
        border-color: #e64a00;
    }

    .payment-info {
        margin-top: 20px;
        font-size: 14px;
        text-align: right;
        color: #666;
    }

    /* Smooth Transition for Payment Options */
    .payment-options {
        display: none;
        margin-top: 10px;
        transition: max-height 0.4s ease-out;
        overflow: hidden;
    }

    .payment-options.open {
        display: block;
        max-height: 400px;
        transition: max-height 0.4s ease-in;
    }

    /* Voucher Styling */
    /* Cập nhật phong cách modal */
    /* Voucher Modal */
    .modal-content {
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        background-color: #f9f9f9;
    }

    .modal-header {
        background-color: #007bff;
        /* Màu primary cho header */
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .modal-title {
        font-size: 18px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .btn-close {
        background-color: white;
        border-radius: 50%;
    }

    .modal-body {
        padding: 20px;
        background-color: #fff;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    .modal-footer {
        background-color: #f1f1f1;
        border-bottom-left-radius: 15px;
        border-bottom-right-radius: 15px;
    }

    /* Voucher List Style */
    .voucher-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        padding: 10px;
    }

    .voucher-item {
        flex: 1 1 calc(50% - 20px);
        border: 1px solid #ddd;
        border-radius: 15px;
        padding: 15px;
        background-color: #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .voucher-item:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        background-color: #e7f1ff;
        /* Màu nền khi hover */
    }

    .voucher-image {
        width: 80px;
        height: 80px;
        margin-right: 15px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid #007bff;
        /* Màu primary cho border */
    }

    .voucher-details h6 {
        font-size: 18px;
        font-weight: bold;
        color: #007bff;
        /* Màu primary cho tiêu đề */
        margin-bottom: 5px;
    }

    .voucher-details p {
        font-size: 14px;
        color: #333;
    }

    .voucher-details small {
        font-size: 12px;
        color: #888;
    }

    .voucher-select input[type="radio"] {
        margin-top: 15px;
        accent-color: #007bff;
        /* Màu primary cho nút radio */
    }

    .voucher-select {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Button Customization */
    .btn-primary {
        background-color: #007bff;
        /* Màu primary cho button */
        border: none;
        padding: 10px 20px;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Đậm hơn khi hover */
    }

    .btn-secondary {
        background-color: #999;
        border: none;
        padding: 10px 20px;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #666;
    }
</style>

<div class="container">
    <!-- Header -->
    <div class="header">
        <img src="logo.png" alt="Shop Logo" class="logo">
        <h2>Thanh Toán</h2>
    </div>

    <!-- Shipping Info -->
    <div class="shipping-info">
        <h3><i class="bi bi-geo-alt-fill"></i> Địa Chỉ Nhận Hàng</h3>
        <p class="name">{{$userAddress->name}} | {{$userAddress->phone}}</p>
        <p class="address">{{$userAddress->string_address}} {{$userAddress->street}}</p>
        <button class="change-btn"><i class="bi bi-pencil-fill"></i> Thay Đổi</button>
    </div>

    <!-- Product Details -->
    <div class="product-details">



        @if(count($selectedItems) > 0)
        @foreach($selectedItems as $item)
        @php
        // Lấy thông tin sản phẩm từ danh sách products
        $product = $products->firstWhere('id', $item['product_id']);
        @endphp
        <div class="product">
            <img src="{{ asset('/uploads/'.$product->image) }}" alt="{{ $product->name }}">
            <div class="product-info">
                <p>{{ $product->name }}</p>
                <!-- Hiển thị thuộc tính -->
                @if(isset($item['attributes']) && count($item['attributes']) > 0)
                <ul>
                    @foreach($item['attributes'] as $attribute)
                    <li>{{ $attribute['name'] }}: {{ $attribute['value'] }}</li>
                    @endforeach
                </ul>
                @else
                <p>Không có thuộc tính</p>
                @endif

                <p class="return-policy"><i class="bi bi-arrow-repeat"></i> Đổi ý miễn phí 15 ngày</p>
            </div>
            <div class="price-info">
                <p>Đơn giá: ₫{{ number_format($product->price, 0, ',', '.') }}</p>
                <p>Số lượng: {{ $item['quantity'] }}</p>
                <p>Thành tiền: ₫{{ number_format($item['total_price'], 0, ',', '.') }}</p>
            </div>
        </div>
        @endforeach
        @else
        <p>Không có sản phẩm nào được chọn.</p>
        @endif

        <!-- Voucher Section -->
        <div class="voucher">
            <span><i class="bi bi-ticket-fill"></i> Voucher của Shop</span>
            <div id="voucher-display"></div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#voucherModal">
                Chọn Voucher
            </button>
        </div>

        <!-- Modal -->
        <!-- Modal Voucher -->
        <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="voucherModalLabel">Chọn Shopee Voucher</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Tab navigation -->
                        <ul class="nav nav-tabs" id="voucherTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="shop-voucher-tab" data-bs-toggle="tab" data-bs-target="#shop-voucher" type="button" role="tab" aria-controls="shop-voucher" aria-selected="true">Mã Voucher</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="shopee-voucher-tab" data-bs-toggle="tab" data-bs-target="#shopee-voucher" type="button" role="tab" aria-controls="shopee-voucher" aria-selected="false">Mã Shopee Voucher</button>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- Shopee Voucher List -->
                            <div class="tab-pane fade show active" id="shop-voucher" role="tabpanel" aria-labelledby="shop-voucher-tab">
                                <div class="voucher-list">
                                    <!-- Vòng lặp hiển thị voucher cho từng sản phẩm -->
                                    @foreach($groupedProducts as $sellerId => $products)
                                    @php
                                    // Kiểm tra có voucher hay không
                                    $hasVoucher = isset($sellerVouchers[$sellerId]) && $sellerVouchers[$sellerId]->count() > 0;
                                    @endphp

                                    <!-- Chỉ hiển thị sản phẩm và voucher nếu có voucher -->
                                    @if($hasVoucher)
                                    <div class="seller-section">
                                        <h3>{{ $products->first()->seller->store_name }}</h3>
                                        <div class="product-list">
                                            @foreach($products as $product)
                                            <div class="product-item">
                                                <p>{{ $product->name }}</p>
                                                <p>Giá: <span style="color: red;">{{ number_format($product->price, 0, ',', '.') }} vnđ</span></p>
                                            </div>
                                            @endforeach
                                        </div>

                                        <!-- Hiển thị voucher -->
                                        <div class="voucher-list">
                                            <h4>Voucher của sản phẩm</h4>
                                            <div class="row">
                                                @foreach($sellerVouchers[$sellerId] as $voucher)
                                                <div class="voucher-item col-md-6">
                                                    <div class="voucher-info">
                                                        <img src="https://st4.depositphotos.com/27867620/30555/v/1600/depositphotos_305556988-stock-illustration-voucher-web-icon-simple-design.jpg" alt="Voucher Image" class="voucher-image">
                                                        <div class="voucher-details">
                                                            <h6>{{ $voucher->name }}</h6>
                                                            <p>Giảm: {{ $voucher->type == 'percentage' ? $voucher->value . '%' : '₫' . number_format($voucher->value, 0, ',', '.') }}</p>
                                                            <small>HSD: {{ \Carbon\Carbon::parse($voucher->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}</small>
                                                        </div>
                                                        <div class="voucher-select">
                                                            <input type="radio" name="voucher_{{ $sellerId }}" value="{{ $voucher->id }}" data-value="{{ $voucher->value }}" data-type="{{ $voucher->type }}" data-product-name="{{ $products->first()->name }}" class="form-check-input voucher-radio">
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endif <!-- Kết thúc kiểm tra voucher -->
                                    @endforeach
                                </div>
                            </div>

                            <!-- Shopee Voucher List -->
                            <div class="tab-pane fade" id="shopee-voucher" role="tabpanel" aria-labelledby="shopee-voucher-tab">
                                <p>Danh sách Shopee Voucher của bạn</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Trở Lại</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>



    </div>

    <!-- Additional Section -->
    <div class="additional-section">
        <div class="voucher-shopee">
            <p><i class="bi bi-gift-fill"></i> Shopee Voucher</p>
            <a href="#"><i class="bi bi-chevron-right"></i> Chọn Voucher</a>
        </div>




        <!-- Payment Method -->
        <!-- Payment Method -->
        <div class="payment-method">
            <h3 style="font-size: 14px;"><i class="bi bi-credit-card"></i> Phương thức thanh toán</h3>

            <!-- Hiển thị phương thức thanh toán hiện tại -->
            <div class="payment-details"
                style="display: flex; justify-content: space-between; align-items: center; text-align: right;">
                <p style="margin: 0; font-size: 14px;" id="selected-method">Thanh toán khi nhận hàng</p>
                <a href="javascript:void(0)" id="change-method"><i class="bi bi-chevron-right"></i> THAY ĐỔI</a>
            </div>
            <hr style="border: 1px solid #ddd; margin: 10px 0;">

            <!-- Danh sách phương thức thanh toán (Ẩn mặc định) -->
            <div id="payment-options" style="display: none; margin-top: 10px;">
                <div class="payment-method-button" data-method="ShopeePay" style="cursor: pointer;">Ví ShopeePay</div>
                <div class="payment-method-button" data-method="GooglePay" style="cursor: pointer;">Google Pay</div>
                <div class="payment-method-button" data-method="CreditCard" style="cursor: pointer;">Thẻ Tín dụng/Ghi nợ
                </div>
                <div class="payment-method-button" data-method="COD" style="cursor: pointer;">Thanh toán khi nhận hàng
                </div>
            </div>
        </div>

        <div class="breakdow-method">
            <div class="breakdown">
                <div class="breakdown-item">
                    <span>Tổng tiền hàng</span>
                    <span id="total-item-price">0</span>
                </div>
                <div class="breakdown-item">
                    <span>Phí vận chuyển</span>
                    <span id="shipping-fee">15.000 vnđ</span>
                </div>
                <div class="breakdown-item">
                    <span>Tổng cộng Voucher giảm giá:</span>
                    <span id="voucher-discount">0</span>
                </div>
                <div class="breakdown-item total">
                    <span>Tổng thanh toán</span>
                    <span id="total-payment" class="total-amount">₫172.700</span>
                </div>
            </div>
        </div>


        <!-- Place Order Button -->
        <div class="place-order">
            <button><i class="bi bi-bag-check-fill"></i> Đặt hàng</button>
            <p>Nhấn "Đặt hàng" đồng nghĩa với việc bạn đồng ý tuân theo <a href="#"><i
                        class="bi bi-exclamation-triangle"></i> Điều khoản Shopee</a></p>
        </div>
    </div>

    <!-- Chat Icon -->
    <div class="chat-icon">
        <i class="bi bi-chat-fill" style="font-size: 24px; color: #ff4747;"></i>
    </div>
</div>
<script>
    const changeMethodLink = document.getElementById('change-method');
    const paymentOptions = document.getElementById('payment-options');
    const selectedMethod = document.getElementById('selected-method');
    const paymentButtons = document.querySelectorAll('.payment-method-button');

    changeMethodLink.addEventListener('click', function() {
        if (paymentOptions.style.display === 'none') {
            paymentOptions.style.display = 'block';
        } else {
            paymentOptions.style.display = 'none';
        }
    });

    paymentButtons.forEach(button => {
        button.addEventListener('click', function() {
            selectedMethod.textContent = this.textContent;
            paymentOptions.style.display = 'none';
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Khi nhấn nút OK trong modal
        document.querySelector('.btn-primary[data-bs-dismiss="modal"]').addEventListener('click', function() {
            const voucherDisplay = document.getElementById('voucher-display'); // Khu vực hiển thị voucher
            voucherDisplay.innerHTML = ''; // Xóa nội dung cũ trước khi hiển thị mới

            // Lấy tất cả các radio button đã được chọn
            const selectedVouchers = document.querySelectorAll('.voucher-radio:checked');

            selectedVouchers.forEach(function(voucher) {
                let value = voucher.getAttribute('data-value');
                let type = voucher.getAttribute('data-type');
                let productName = voucher.getAttribute('data-product-name');
                let displayValue = '';

                // Hiển thị loại giảm giá (phần trăm hoặc tiền)
                if (type === 'percentage') {
                    displayValue = `${value}% giảm giá`;
                } else {
                    displayValue = `₫${parseFloat(value).toLocaleString('vi-VN')} giảm giá`;
                }

                // Tạo một phần tử div mới để hiển thị
                let voucherInfo = document.createElement('div');
                voucherInfo.innerHTML = `<p>Voucher cho sản phẩm ${productName}: ${displayValue}</p>`;

                // Thêm vào khu vực hiển thị
                voucherDisplay.appendChild(voucherInfo);
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectedItems = {
            !!json_encode($selectedItems) !!
        }; // Lấy dữ liệu từ backend
        const shippingFee = 15000; // Phí vận chuyển cố định
        let voucherDiscount = 0; // Giảm giá voucher, mặc định là 0 nếu chưa chọn

        // Hàm tính tổng tiền hàng
        function calculateTotalItemPrice() {
            let totalItemPrice = 0;
            selectedItems.forEach(item => {
                // Đảm bảo cộng số thay vì chuỗi
                totalItemPrice += parseFloat(item.total_price) || 0;
            });
            return totalItemPrice;
        }

        // Cập nhật lại tổng thanh toán
        function updateTotalPayment() {
            const totalItemPrice = calculateTotalItemPrice();
            const totalPayment = totalItemPrice + shippingFee - voucherDiscount;

            // Cập nhật giao diện
            document.getElementById('total-item-price').textContent = `₫${totalItemPrice.toLocaleString('vi-VN')}`;
            document.getElementById('voucher-discount').textContent = `₫${voucherDiscount.toLocaleString('vi-VN')}`;
            document.getElementById('total-payment').textContent = `₫${totalPayment.toLocaleString('vi-VN')}`;
        }

        // Khi chọn voucher
        document.querySelector('.btn-primary[data-bs-dismiss="modal"]').addEventListener('click', function() {
            const selectedVouchers = document.querySelectorAll('.voucher-radio:checked');
            voucherDiscount = 0; // Reset lại giảm giá voucher

            selectedVouchers.forEach(function(voucher) {
                const value = parseFloat(voucher.getAttribute('data-value'));
                const type = voucher.getAttribute('data-type');

                if (type === 'percentage') {
                    voucherDiscount += calculateTotalItemPrice() * (value / 100);
                } else {
                    voucherDiscount += value;
                }
            });

            // Cập nhật lại tổng tiền sau khi áp dụng voucher
            updateTotalPayment();
        });

        // Gọi hàm để tính toán và cập nhật khi trang tải lần đầu
        updateTotalPayment();
    });
</script>
@endsection