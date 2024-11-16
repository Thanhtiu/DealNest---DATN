@extends('layouts.client.app')
<style>
    /* Logo and Title Section */
    .header-section {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 20px 0;
        background-color: #fff;
        border-bottom: 2px solid #e1e1e1;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        max-width: 1200px;
        margin: 0 auto;
    }

    .header-section img {
        width: 120px;
        /* Đặt kích thước logo */
        height: auto;
    }

    .header-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-left: 20px;
        flex-grow: 1;
        text-align: center;
    }

    .fixed-section {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        max-width: 1200px;
        margin: 0 auto;
        background-color: #f9f9f9;
        padding: 20px;
        box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        font-family: 'Arial', sans-serif;
        font-size: 14px;
        border-top: 2px solid #e1e1e1;
    }

    .voucher-row,
    .shopee-xu-row,
    .bottom-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .voucher-row input,
    .shopee-xu-row input,
    .bottom-row input {
        margin-right: 10px;
    }

    .voucher-row a,
    .shopee-xu-row span {
        color: #007bff;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .voucher-row a:hover,
    .shopee-xu-row span:hover {
        color: #0056b3;
    }

    .amount-deducted {
        margin-left: auto;
        color: #777;
    }

    .bottom-row input {
        margin-right: 10px;
    }

    .bottom-row a {
        color: #ff5722;
        margin-right: 20px;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .bottom-row a:hover {
        color: #e64a19;
    }

    .save-section {
        color: red;
        margin-right: auto;
        font-weight: bold;
    }

    .total-payment {
        display: flex;
        align-items: center;
        margin-right: 20px;
    }

    .total-amount {
        color: #ff5722;
        font-size: 20px;
        font-weight: bold;
        margin-left: 10px;
    }

    .savings {
        color: #777;
        font-size: 12px;
        margin-left: 5px;
    }

    .purchase-button {
        background-color: #ff5722;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        font-size: 16px;
    }

    .purchase-button:hover {
        background-color: #e64a19;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .click-code {
        text-decoration: none;
        color: #007bff;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    .click-code:hover {
        color: #0056b3;
    }
</style>
@section('content')
<!-- Logo and Title Section Begin -->
<section class="header-section">

    <div class="header-title">Giỏ Hàng Của Bạn</div> <!-- Tiêu đề giỏ hàng -->
</section>
<!-- Logo and Title Section End -->
<!-- Shoping Cart Section Begin -->

<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    @if($cartItems->isEmpty())
                    <div class="nodata-empty">
                    <img class="nodata-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data">
                    <p class="text-center mt-3">Chưa có sản phẩm nào trong giỏ hàng!</p>
                </div>
                    <a href="{{ route('client.index') }}" class="btn btn-primary text-center d-block">Mua hàng</a>
                    @else
                    <table>
                        <thead>
                            <tr>
                                <th></th>
                                <th class="shoping__product">Sản phẩm</th>
                                <th style="font-weight: 400;">Giá</th>
                                <th style="font-weight: 400;">Số lượng</th>
                                <th style="font-weight: 400;">Tổng tiền</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalPriceSum = 0;
                            @endphp

                            <form id="cartForm">
                                @csrf
                                @foreach($cartItems as $item)
                                <tr>
                                    <td class="shoping__cart__item shoping_cart_item_checkbox">
                                        <input type="checkbox" class="shoping_cart_item_checkbox_checkbox"
                                            name="checkbox[]" value="{{ $item->id }}"
                                            data-total-price="{{ $item->total_price }}">
                                    </td>
                                    <td class="shoping__cart__item">
                                        @if($item->product->image)
                                        <img src="{{ asset('uploads/'.$item->product->image) }}" alt="Product Image"
                                            style="max-width: 100px; max-height: 140px; object-fit: cover;">
                                        @else
                                        <img src="{{ asset('client/img/no-image.png') }}" alt="No Image"
                                            style="max-width: 100px; max-height: 140px; object-fit: cover;">
                                        @endif
                                        <h5>{{ $item->product->name }}</h5>
                                        <p class="text-center">Màu: {{ $item->color }}, Kích thước: {{ $item->size }}
                                        </p>
                                    </td>
                                    <td class="shoping__cart__price">{{ number_format($item->price, 0, ',',
                                        '.') }} VNĐ</td>
                                    <td class="shoping__cart__quantity">{{ $item->quantity }}</td>
                                    <td class="shoping__cart__total">{{ number_format($item->total_price, 0, ',', '.')
                                        }} VNĐ</td>
                                </tr>
                                @php
                                $totalPriceSum += $item->total_price;
                                @endphp
                                @endforeach
                                <tr>
                                    <td colspan="4" style="text-align: right;"><strong>Tổng cộng:</strong></td>
                                    <td class="shoping__cart__total" id="total-price-display">{{
                                        number_format($totalPriceSum, 0, ',', '.') }} VNĐ</td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>





<!-- Shoping Cart Section End -->
<!-- dat hang -->
<div class="fixed-section">
    <div class="voucher-row">
        <input type="checkbox" id="voucher-checkbox">
        <label for="voucher-checkbox">
            <span class="voucher-icon"></span> Shopee Voucher
        </label>
        <a class="click-code" href="#">Chọn hoặc nhập mã</a>
    </div>
    <div class="shopee-xu-row">
        <input type="checkbox" id="shopee-xu-checkbox" disabled>
        <label for="shopee-xu-checkbox">Shopee Xu</label>
        <span>Bạn chưa có Shopee Xu</span>
        <span class="amount-deducted">₫0</span>
    </div>
    <div class="bottom-row">
        <input type="checkbox" id="select-all">
        <label for="select-all">
        </label>
        <a href="#" class="delete-selected">Xóa</a>
        <span class="save-section">Lưu vào mục Đã thích</span>
        <div class="total-payment">
            <span id="total-payment-label">Tổng thanh toán (0 Sản phẩm):</span>
            <span class="total-amount" id="total-payment-amount">
                {{ number_format($totalPriceSum ?? 0, 0, ',', '.') }}
            </span>
            <span class="savings">Tiết kiệm ₫43k</span>
        </div>
        <button type="button" class="purchase-button btn btn-primary">Mua Hàng</button>
    </div>
</div>

<!--end dat hang -->



{{-- Delete cart --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.shoping_cart_item_checkbox_checkbox');
        const selectAllCheckbox = document.getElementById('select-all');
        const totalPriceDisplay = document.getElementById('total-price-display');
        const totalPaymentLabel = document.getElementById('total-payment-label');
        const totalPaymentAmount = document.getElementById('total-payment-amount');
        const deleteSelectedButton = document.querySelector('.delete-selected');

        function updateTotalPayment() {
            let total = 0;
            let selectedItems = 0;

            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    total += parseFloat(checkbox.getAttribute('data-total-price'));
                    selectedItems += 1;
                }
            });

            // Cập nhật tổng tiền
            totalPriceDisplay.innerText = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(total);
            totalPaymentAmount.innerText = new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(total);

            // Cập nhật số lượng sản phẩm đã chọn trong "Tổng thanh toán"
            totalPaymentLabel.innerText = `Tổng thanh toán (${selectedItems} Sản phẩm):`;
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('click', updateTotalPayment);
        });

        selectAllCheckbox.addEventListener('change', function() {
            const isChecked = selectAllCheckbox.checked;
            checkboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });
            updateTotalPayment();
        });

        deleteSelectedButton.addEventListener('click', function(e) {
            e.preventDefault();
            const selectedIds = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.value);

            if (selectedIds.length === 0) {
                alert("Vui lòng chọn sản phẩm để xóa.");
                return;
            }

            // Gửi AJAX đến route cart.destroy
            fetch("{{ route('cart.destroy') }}", {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        ids: selectedIds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Xóa các dòng sản phẩm đã xóa khỏi giao diện
                        selectedIds.forEach(id => {
                            document.querySelector(`input[value="${id}"]`).closest('tr').remove();
                        });
                        updateTotalPayment(); // Cập nhật lại tổng tiền sau khi xóa
                        alert("Sản phẩm đã được xóa thành công.");
                    } else {
                        const errorMessage = data.message || "Có lỗi xảy ra khi xóa sản phẩm.";
                        alert(errorMessage);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert(`Có lỗi xảy ra khi xóa sản phẩm: ${error.message}`);
                });
        });

        updateTotalPayment();
    });
</script>

{{-- Check out --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const purchaseButton = document.querySelector('.purchase-button');

        purchaseButton.addEventListener('click', function() {
            // Lấy danh sách sản phẩm đã chọn
            const selectedIds = Array.from(document.querySelectorAll('.shoping_cart_item_checkbox_checkbox:checked'))
                .map(checkbox => checkbox.value);

            if (selectedIds.length === 0) {
                alert("Vui lòng chọn sản phẩm để mua.");
                return;
            }

            // Tạo URL với các tham số ID sản phẩm đã chọn
            const params = new URLSearchParams();
            selectedIds.forEach(id => params.append('cartIdtem[]', id));

            const checkoutUrl = "{{ route('checkout') }}?" + params.toString();

            // Điều hướng đến trang thanh toán
            window.location.href = checkoutUrl;
        });
    });
</script>




































@endsection