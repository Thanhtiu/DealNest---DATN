@extends('layouts.client.app')
<style>
    .fixed-section {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
        padding: 15px 20px;
        box-shadow: -1px -1px 5px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        font-family: Arial, sans-serif;
        font-size: 14px;
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
        margin-right: 5px;
    }

    .voucher-row a,
    .shopee-xu-row span {
        color: #007bff;
    }

    .amount-deducted {
        margin-left: auto;
        color: #999;
    }

    .bottom-row input {
        margin-right: 5px;
    }

    .bottom-row a {
        color: #ff5722;
        margin-right: 20px;
    }

    .save-section {
        color: red;
        margin-right: auto;
    }

    .total-payment {
        display: flex;
        align-items: center;
        margin-right: 20px;
    }

    .total-amount {
        color: #ff5722;
        font-size: 18px;
        font-weight: bold;
        margin-left: 10px;
    }

    .savings {
        color: #999;
        margin-left: 5px;
    }

    .purchase-button {
        background-color: #ff5722;
        color: white;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }

    .purchase-button:hover {
        background-color: #e64a19;
    }

    .click-code {
        text-decoration: none;
    }

    .click-code:hover {
        color: #0d6efd;
    }
</style>
@section('content')

<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    @if($carts->isEmpty())
                    <div class="text-center">
                        <img src="{{ asset('client/img/no-cart.png') }}" alt="No Cart" class="img-fit">
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
                            $totalPriceSum = 0; // Khởi tạo biến để tính tổng
                            @endphp

                            <form id="cartForm">
                                @csrf
                                @foreach($carts as $item)
                                <tr>
                                    <td class="shoping__cart__item shoping_cart_item_checkbox">
                                        <input type="checkbox" class="shoping_cart_item_checkbox_checkbox"
                                            name="checkbox[]" value="{{ $item->id }}"
                                            data-total-price="{{ $item->total_price }}">
                                    </td>
                                    <td class="shoping__cart__item">
                                        @if($item->product->product_image->isNotEmpty())
                                        <img src="{{ asset('uploads/'.$item->product->image) }}" alt="Product Image"
                                            style="max-width: 100px; max-height: 140px; object-fit: cover;">
                                        @else
                                        <img src="{{ asset('client/img/no-image.png') }}" alt="No Image"
                                            style="max-width: 100px; max-height: 140px; object-fit: cover;">
                                        @endif
                                        <h5>{{ $item->product->name }}</h5>
                                        @forelse($item->items as $cartItem)
                                        <p class="text-center">{{ $cartItem->attribute->name }}: {{ $cartItem->value }}
                                        </p>
                                        @empty
                                        <p>Không có thuộc tính</p>
                                        @endforelse
                                    </td>
                                    <td class="shoping__cart__price">{{ number_format($item->discount) }}</td>
                                    <td class="shoping__cart__quantity">{{ $item->quantity }}</td>
                                    <td class="shoping__cart__total">{{ number_format($item->total_price, 0, ',', '.')
                                        }}</td>
                                        
                                </tr>
                                @php
                                $totalPriceSum += $item->total_price; // Cộng dồn total_price vào biến totalPriceSum
                                @endphp
                                @endforeach
                                <tr>
                                    <td colspan="4" style="text-align: right;"><strong>Tổng cộng:</strong></td>
                                    <td class="shoping__cart__total">{{ number_format($totalPriceSum, 0, ',', '.') }}
                                    </td>
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
            <span class="checkmark"></span> Chọn Tất Cả ({{ count($carts) }})
        </label>
        <a href="#" class="delete-selected">Xóa</a>
        <span class="save-section">Lưu vào mục Đã thích</span>
        <div class="total-payment">
            <span>Tổng thanh toán (1 Sản phẩm):</span>
            <span class="total-amount">{{ number_format($totalPriceSum, 0, ',','.') }} </span>
            <span class="savings">Tiết kiệm ₫43k</span>
        </div>
        <button type="button" class="purchase-button">Mua Hàng</button>
    </div>
</div>

<!--end dat hang -->

<script>
    // Cart Submit
document.querySelector('.purchase-button').addEventListener('click', function (e) {
    e.preventDefault();

    let form = document.getElementById('cartForm');
    let formData = new FormData(form);

    fetch('{{ route('cart.submit') }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Chuyển hướng đến route checkout
            window.location.href = '{{ route('checkout') }}';
        } else {
            alert('Vui lòng chọn ít nhất một sản phẩm!');
        }
    })
    .catch(error => console.error('Error:', error));
});


    // Selected product
    document.getElementById('select-all').addEventListener('change', function() {
    let checkboxes = document.querySelectorAll('.shoping_cart_item_checkbox_checkbox');
    let totalAmount = 0; // Khởi tạo biến tổng

    checkboxes.forEach(function(checkbox) {
        checkbox.checked = document.getElementById('select-all').checked;

        // Nếu checkbox được chọn, tính tổng giá trị
        if (checkbox.checked) {
            let totalPrice = parseFloat(checkbox.getAttribute('data-total-price')); // Lấy giá trị total_price từ thuộc tính data-total-price
            if (!isNaN(totalPrice)) {
                totalAmount += totalPrice; // Cộng dồn
            }
        }
    });

    // Cập nhật tổng số tiền
    document.querySelector('.total-amount').textContent = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(totalAmount);
    document.querySelector('.total-payment span').textContent = `Tổng thanh toán (${checkboxes.length} Sản phẩm):`;
});


// Destroy cart
document.querySelector('.delete-selected').addEventListener('click', function (e) {
    e.preventDefault();

    // Lấy tất cả các checkbox đã được chọn
    let checkedBoxes = document.querySelectorAll('input[name="checkbox[]"]:checked');

    // Kiểm tra xem có checkbox nào được chọn không
    if (checkedBoxes.length === 0) {
        alert('Vui lòng chọn ít nhất một sản phẩm để xóa.');
        return;
    }

    // Tạo một mảng để lưu id của các mục được chọn
    let selectedItems = [];
    checkedBoxes.forEach(function (checkbox) {
        selectedItems.push(checkbox.value);
    });

    // Tạo form data để gửi qua Ajax
    let formData = new FormData();
    formData.append('_token', document.querySelector('input[name=_token]').value);
    selectedItems.forEach(function (item) {
        formData.append('checkbox[]', item);
    });

    // Gửi Ajax request để xóa các mục đã chọn
    fetch('{{ route('cart.destroy') }}', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Xóa thành công!');
            location.reload();  // Tải lại trang sau khi xóa thành công
        } else {
            alert('Có lỗi xảy ra khi xóa các mục.');
        }
    })
    .catch(error => console.error('Error:', error));
});


// Sum totalprice
document.querySelectorAll('.shoping_cart_item_checkbox_checkbox').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
        let totalAmount = 0;
        let selectedCount = 0;

        // Lặp qua tất cả các checkbox, nếu được chọn thì cộng giá trị total_price
        document.querySelectorAll('.shoping_cart_item_checkbox_checkbox:checked').forEach(function(checkedBox) {
            totalAmount += parseFloat(checkedBox.getAttribute('data-total-price')); // Lấy giá trị total_price từ thuộc tính data-total-price
            selectedCount++;
        });

        // Cập nhật số lượng sản phẩm đã chọn và tổng số tiền
        document.querySelector('.total-amount').textContent = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(totalAmount);
        document.querySelector('.total-payment span').textContent = `Tổng thanh toán (${selectedCount} Sản phẩm):`;
    });
});



</script>


@endsection
