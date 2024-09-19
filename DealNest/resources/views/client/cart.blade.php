@extends('layouts.client.app')

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
                                        <td class="shoping__cart__item">
                                            @if($item->product->product_image->isNotEmpty())
                                                <img src="{{ asset('uploads/'.$item->product->product_image->first()->url) }}" alt="Product Image"
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
                                            {{ number_format($item->product->price, 0, ',', '.') }}
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



@endsection
