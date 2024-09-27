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
    .click-code{
        text-decoration: none;
    }
    .click-code:hover{
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
                            @foreach($carts as $item)
                            <tr>
                                <td class="shoping__cart__item shoping_cart_item_checkbox">
                                    <input type="checkbox" class="shoping_cart_item_checkbox_checkbox" name="checkbox">
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
                                    <p class="text-center">{{ $cartItem->attribute->name }}: {{ $cartItem->value }}</p>
                                    @empty
                                    <p>Không có thuộc tính</p>
                                    @endforelse
                                </td>
                                <td class="shoping__cart__price" style="font-weight: 400;">
                                    
                                    {{ number_format($item->discount) }}
                                    
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" value="{{ $item->quantity }}">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total" style="font-weight: 400;">
                                    {{ number_format($item->total_price, 0, ',', '.') }}
                                </td>
                                <td class="shoping__cart__item__close">
                                    <span class="icon_close delete-cart-item" data-id="{{ $item->id }}"></span>
                                </td>
                            </tr>
                            @endforeach
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
            <span class="checkmark"></span> Chọn Tất Cả (1)
        </label>
        <a href="#">Xóa</a>
        <span class="save-section">Lưu vào mục Đã thích</span>
        <div class="total-payment">
            <span>Tổng thanh toán (1 Sản phẩm):</span>
            <span class="total-amount">₫53.000</span>
            <span class="savings">Tiết kiệm ₫43k</span>
        </div>
        <button class="purchase-button">Mua Hàng</button>
    </div>
</div>

<!--end dat hang -->



@endsection