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
                            <img src="{{asset('client/img/no-cart.png')}}" alt="" class="img-fit">
                        </div>
                        <a href="{{route('client.index')}}" class="btn btn-primary text-center d-block">Mua hàng</a>
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
                                                <img src="{{asset('uploads/'.$item->product->product_image->first()->url)}}" alt="" style="max-width: 100px; max-height: 140px; object-fit:cover;">
                                            @else
                                                <img src="{{asset('client/img/no-image.png')}}" alt="" style="max-width: 100px; max-height: 140px; object-fit:cover;">
                                            @endif
                                            <h5>{{$item->product->name}}</h5>
                                        </td>
                                        <td class="shoping__cart__price" style="font-weight: 400;">
                                            {{number_format($item->product->price, 0, ',', '.')}}
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{$item->quantity}}">
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

<div class="container">
    <h4 style="font-weight: 400;">Có thể bạn cũng thích</h2>
    <div class="row product-container">
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dâdadada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dâdadada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 1k3</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dâdadada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 200+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dầdasdada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 912</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dâdadada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dâdadada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 dâdadada</h2>
                
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-3.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 Essager 20W</h2>
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-2.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 Essager 20W</h2>
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-5.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 Essager 20Wđ</h2>
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-2.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 Essager 20W</h2>
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 1k3</div>
        </div>
        <div class="card">
            <img src="img/categories/cat-4.jpg" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">Sạc Nhanh QC 3.0 Essager 20W</h2>
                <p class="price">₫ 71.000</p>
            </div>
            <div class="sold">Đã bán 100+</div>
        </div>
    </div>
</div>

@endsection


