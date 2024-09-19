@extends('layouts.client.app')
@section('content')
<link rel="stylesheet" href="{{asset('client/css/shop.css')}}" type="text/css">
<link rel="stylesheet" href="{{asset('client/css/tabindex.css')}}" type="text/css">

<div class="shop-container">
    <div class="shop-header">
        <div class="logo">
            <div class="shop-image">
                <img src="https://shardaproduction.com.np/wp-content/uploads/2024/02/Logo-Designing.jpg"
                    alt="Shop Logo">
                <button class="favorite-btn">Yêu thích</button>
            </div>
            <div class="shop-info">
                <h1>{{$shop->store_name}}</h1>
                <p>Online 2 phút trước</p>
                <button class="follow-btn">ĐANG THEO</button>
            </div>
        </div>
        <div class="shop-stats">
            <div class="stat-item"><i class="fa fa-shopping-bag"></i> Sản Phẩm: <span
                    class="highlight">{{$products->count()}}</span></div>
            <div class="stat-item"><i class="fa fa-users"></i> Đang Theo: <span class="highlight">1000</span></div>
            <div class="stat-item"><i class="fa fa-comments"></i> Tỉ Lệ Phản Hồi Chat: <span
                    class="highlight">95%</span> (Trong Vài Giờ)</div>
            <div class="stat-item"><i class="fa fa-user-plus"></i> Người Theo Dõi: <span class="highlight">
                    @if($shop->follow == 0)
                    0
                    @else
                    {{ number_format($shop->follow / 1000, 0) . 'k' }}
                    @endif</span>
            </div>
            <div class="stat-item"><i class="fa fa-star"></i> Đánh Giá: <span class="highlight">5</span> (10k Đánh Giá)
            </div>
            <div class="stat-item"><i class="fa fa-users"></i> Tham Gia: <span class="highlight">
                    {{$join}} ngày trước
                </span></div>
        </div>
    </div>
    <div class="shop-categories tabs">
        <a href="#" class="active">TẤT CẢ SẢN PHẨM</a>
        <a href="#">Giá đỡ laptop</a>
        <a href="#">túi chống sốc laptop và ...</a>
        <a href="#">Thiết bị nhà bếp và đồ gi...</a>
        <a href="#">chăm sóc cá nhân</a>
    </div>
</div>
    <div class="content">
        <div id="1" class="tab-content active">
            <p class="title">Gợi ý cho bạn</p>
            <div class="product-container">
                @foreach($products as $item)
                <div class="card">
                    <a href="{{route('client.productDetail',['id'=>$item->id])}}">
                        <div class="cardd">
                            <img src="{{asset('uploads/'.$item->product_image->first()->url)}}" alt="Product Image">
                            <div class="discount">-92%</div>
                            <div class="content">
                                <h2 class="title">{{$item->name}}</h2>
                                <p class="pricee">{{ number_format($item->price, 0, ',', '.') }}<span
                                        style="font-size: 12px; text-decoration: underline;">đ</span></p>
                            </div>
                            <div class="sold"><span class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
            
                                </span>{{ number_format($item->sales >= 1000 ? $item->sales / 1000 : $item->sales, 1) .
                                ($item->sales >= 1000 ? 'k' : '') }} lượt bán</div>
            
                        </div>
                    </a>
            
                </div>
                @endforeach
            </div>
        </div>
        <div id="tab-2" class="tab-content">
            <p>Giá đỡ laptop</p>
        </div>
        <div id="tab-3" class="tab-content">
            <p>Túi chống sốc laptop</p>
        </div>
        <div id="tab-4" class="tab-content">
            <p>Chăm sóc cá nhân</p>
        </div>
    </div>

<script src="{{asset('client/js/tabindex.js')}}"></script>

@endsection