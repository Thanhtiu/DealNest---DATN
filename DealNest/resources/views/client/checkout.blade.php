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
        max-width: 80px;
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

    .grand-total {
        text-align: right;
        /* Căn phải */
        font-size: 1.2em;
        /* Tăng kích thước font chữ */
        font-weight: bold;
        margin-top: 20px;
        margin-right: 20px;
        /* Khoảng cách bên phải */
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
        <p class="name">{{$userAddress->name}} | <span id="user-phone">{{$userAddress->phone}}</span></p>
        <p class="address">{{$userAddress->string_address}} {{$userAddress->street}}</p>
        <button class="change-btn"><i class="bi bi-pencil-fill"></i> Thay Đổi</button>
    </div>

    <!-- Product Details -->
    <div class="product-details">
        <div class="product-details">
            @php
            $grandTotal = 0;
            $shippingFee = 15000; // Phí vận chuyển mặc định
            $voucherDiscount = 0; // Giá trị voucher giảm giá
            @endphp

            @foreach ($products as $item)
            @php
            // Tính thành tiền cho sản phẩm
            $itemTotal = $item->total_price * $item->quantity; // Thành tiền ban đầu
            $grandTotal += $itemTotal;
            @endphp
            <div class="product" data-product-id="{{ $item->id }}">
                <img src="{{ asset('/uploads/' . $item->product->image) }}" alt="{{ $item->name }}">
                <div class="product-info">
                    <p class="data-product-id">ID sản phẩm: {{ $item->product->id }}</p>
                    <p class="data-seller-id" id="seller-id-{{ $item->id }}">ID người bán: {{ $item->product->seller_id
                        }}</p>
                    <p class="data-cart-item" id="cart-item-id-{{ $item->id }}">CartItemId: {{ $item->id }}</p>
                    <p>{{ $item->product->name }}</p>
                    <ul>{{ ($item->color != "") ? $item->color : "" }}</ul>
                    <p class="return-policy"><i class="bi bi-arrow-repeat"></i> Đổi ý miễn phí 15 ngày</p>
                </div>
                <div class="price-info" data-product-id="{{ $item->id }}">
                    <p>Đơn giá: ₫<span class="item-price">{{ number_format($item->price, 0, ',', '.') }}</span>
                    </p>
                    <p>Số lượng: <span class="quantity">{{ $item->quantity }}</span></p>
                    <p>Thành tiền: ₫<span class="item-total">{{ number_format($item->total_price, 0, ',', '.') }}</span></p>
                </div>
            </div>
            @endforeach


            <!-- Voucher Section -->
            <div class="voucher">
                <span><i class="bi bi-ticket-fill"></i> Voucher của Shop</span>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#voucherModal">
                    Chọn Voucher
                </button>
            </div>

            <div class="modal fade" id="voucherModal" tabindex="-1" aria-labelledby="voucherModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="voucherModalLabel">Chọn Voucher</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="voucher-list">
                                @foreach($products as $product)
                                <div class="product-item">
                                    <h6>Sản phẩm: {{ $product->product->name }}</h6>
                                    <img src="{{ asset('/uploads/' . $product->product->image) }}"
                                        alt="{{ $product->product->name }}" class="img-fluid" width="100">
                                    <p>Đơn giá: ₫{{ number_format($product->total_price, 0, ',', '.') }}</p>
                                    <p>Số lượng: {{ number_format($product->quantity, 0, ',', '.') }}</p>
                                    <p>Thành tiền: ₫{{ number_format($product->total_price * $product->quantity, 0, ',',
                                        '.') }}</p>
                                    <div class="vouchers-for-product">
                                        @if(isset($vouchers[$product->product->id]))
                                        <!-- Kiểm tra xem voucher có tồn tại không -->
                                        @foreach($vouchers[$product->product->id] as $voucher)
                                        <div class="voucher-item">
                                            <div class="voucher-info">
                                                <img src="https://st4.depositphotos.com/27867620/30555/v/1600/depositphotos_305556988-stock-illustration-voucher-web-icon-simple-design.jpg"
                                                    alt="Voucher Image" class="voucher-image">
                                                <div class="voucher-details">
                                                    <h6>{{ $voucher->name }}</h6>
                                                    <p>Giảm: {{ $voucher->type == 'percentage' ? $voucher->value . '%' :
                                                        '₫' . number_format($voucher->value, 0, ',', '.') }}</p>
                                                    <small>HSD: {{
                                                        \Carbon\Carbon::parse($voucher->start_date)->format('d/m/Y') }}
                                                        - {{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y')
                                                        }}</small>
                                                </div>
                                                <div class="voucher-select">
                                                    <input type="radio" name="voucher_{{ $product->product->id }}"
                                                        value="{{ $voucher->id }}" data-value="{{ $voucher->value }}"
                                                        data-type="{{ $voucher->type }}"
                                                        class="form-check-input voucher-radio">
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <p>Không có voucher cho sản phẩm này.</p>
                                        <!-- Hiển thị thông báo nếu không có voucher -->
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Trở Lại</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                id="apply-voucher">OK</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Section -->
            <!-- <div class="breakdown-method">
            <div class="breakdown-item total">
                <span>Tổng thanh toán</span>
                <span id="total-payment" class="total-amount">₫{{ number_format($grandTotal, 0, ',', '.') }}</span>
            </div>
        </div> -->
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
                <div class="payment-method-button" data-method="vnpay" style="cursor: pointer;">VNPay</div>
                <div class="payment-method-button" data-method="master_card" style="cursor: pointer;">Thẻ Tín dụng/Ghi
                    nợ
                </div>
                <div class="payment-method-button" data-method="cod" style="cursor: pointer;">Thanh toán khi nhận hàng
                </div>
            </div>
        </div>

        <div class="breakdow-method">
            <div class="breakdown">
                <div class="breakdown-item">
                    <span>Tổng tiền hàng</span>
                    <span id="total-item-price">₫{{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>
                <!-- Breakdown Section -->
                <div class="breakdown-item">
                    <span>Tổng tiền hàng</span>
                    <span id="total-item-price">₫{{ number_format($grandTotal, 0, ',', '.') }}</span>
                </div>
                <div class="breakdown-item">
                    <span>Phí vận chuyển</span>
                    <span id="shipping-fee">₫{{ number_format($shippingFee, 0, ',', '.') }}</span>
                </div>
                <div class="breakdown-item">
                    <span>Tổng cộng Voucher giảm giá:</span>
                    <span id="voucher-discount">₫{{ number_format($voucherDiscount, 0, ',', '.') }}</span>
                </div>
                <div class="breakdown-item total">
                    <span>Tổng thanh toán</span>
                    <span id="total-payment" class="total-amount">₫{{ number_format($grandTotal + $shippingFee -
                        $voucherDiscount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Place Order Button -->
        <div class="place-order">
            <button id="order-button"><i class="bi bi-bag-check-fill"></i> Đặt hàng</button>
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
    document.getElementById('apply-voucher').addEventListener('click', function() {
    let selectedVouchers = document.querySelectorAll('input[type="radio"]:checked');
    let totalDiscount = 0;

  

    selectedVouchers.forEach(voucher => {
        let discountValue = parseFloat(voucher.getAttribute('data-value'));
        let discountType = voucher.getAttribute('data-type');

        // Log ra voucher được chọn
        console.log("Voucher đã chọn:");
        console.log("ID voucher:", voucher.value); // ID voucher
        console.log("Giá trị giảm giá:", discountValue); // Giá trị giảm
        console.log("Loại giảm giá:", discountType); // Loại giảm

        if (discountType === 'percentage') {
            totalDiscount += (discountValue / 100) * {{ $grandTotal }};
        } else {
            totalDiscount += discountValue;
        }
    });

    // Cập nhật giá trị giảm giá voucher
    document.getElementById('voucher-discount').innerText = '₫' + totalDiscount.toLocaleString();
    
    // Tính toán tổng thanh toán
    let totalPayment = {{ $grandTotal }} + {{ $shippingFee }} - totalDiscount;
    document.getElementById('total-payment').innerText = '₫' + totalPayment.toLocaleString();
});
</script>



{{-- Checkout --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        let selectedPaymentMethod = '';

        // Thêm sự kiện click cho các nút phương thức thanh toán
        $('.payment-method-button').on('click', function() {
            selectedPaymentMethod = $(this).data('method'); // Lưu phương thức đã chọn
        });

        $('#order-button').on('click', function(e) {
            e.preventDefault(); // Ngăn chặn hành động mặc định của nút
            
            // Lấy giá trị CartItemId
            let cartItemIds = [];
            $('.data-cart-item').each(function() {
                cartItemIds.push($(this).text().split(': ')[1]); // Lấy ID sản phẩm từ text
            });
            
            // Lấy tổng thanh toán
            let totalPayment = $('#total-payment').text().replace(/₫|\.| /g, ''); // Lấy số tiền và loại bỏ ký tự không cần thiết

            // Lấy địa chỉ
            let address = $('.address').text().trim(); // Lấy địa chỉ và loại bỏ khoảng trắng

            // Lấy số điện thoại
            let phone = $('#user-phone').text(); // Lấy số điện thoại và loại bỏ khoảng trắng

            // Lấy danh sách seller IDs
            let sellerIds = [];
            $('.data-seller-id').each(function() {
                sellerIds.push($(this).text().split(': ')[1]); // Lấy ID người bán từ text
            });

            // Gửi dữ liệu qua AJAX
            $.ajax({
                url: '{{ route('checkout.processing') }}', // URL của route
                method: 'POST',
                data: {
                    cartItemIds: cartItemIds,
                    totalPayment: totalPayment,
                    address: address, // Gửi địa chỉ
                    phone: phone, // Gửi số điện thoại
                    paymentMethod: selectedPaymentMethod, // Gửi phương thức thanh toán đã chọn
                    sellerIds: sellerIds, // Gửi danh sách seller IDs
                    _token: '{{ csrf_token() }}' // CSRF token
                },
                success: function(response) {
                    // Xử lý phản hồi từ server
                    alert(response.message); // Thông báo thành công
                    if (response.paymentUrl) {
                        window.location.href = response.paymentUrl; // Chuyển hướng đến URL thanh toán
                    }
                    console.log(response);
                },
                error: function(xhr) {
                    // Xử lý lỗi
                    alert('Có lỗi xảy ra, vui lòng thử lại.');
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>






















@endsection