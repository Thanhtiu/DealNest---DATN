@extends('layouts.client.app')
@section('content')
<link rel="stylesheet" href="{{asset('client/css/shop.css')}}" type="text/css">

<div class="shop-container">
    <div class="shop-header">
        <div class="logo" style="background-image: url('{{ asset('uploads/'.$shop->background) }}') !important;">
            <div class="shop-image">
                <img src="{{asset('uploads/'.$shop->logo)}}" alt="Shop Logo">
                <button class="favorite-btn">Yêu thích</button>
            </div>
            <div class="shop-info">
                <h1>{{$shop->store_name}}</h1>
                <p>Online 2 phút trước</p>
                <button class="follow-btn">Theo dỗi</button>
            </div>
        </div>
        <div class="shop-stats">
            <div class="stat-item"><i class="fa fa-shopping-bag"></i> Sản Phẩm: <span
                    class="highlight">{{$countProduct}}</span></div>
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
        <a href="{{ route('client.shop', ['id' => $shop->id]) }}" class="active">TẤT CẢ SẢN PHẨM</a>
        <a href="{{ route('client.shop', ['id' => $shop->id, 'newProducts' => true]) }}">Sản phẩm mới nhất 30 ngày
            qua</a>
        @foreach($categories as $categoryId => $categoryName)
        <a href="{{ route('client.shop', ['id' => $shop->id, 'category_id' => $categoryId]) }}">
            {{ $categoryName }}
        </a>
        @endforeach
    </div>


</div>
<div class="content">
    <div id="1" class="tab-content active">
        <p class="title">Sản phẩm theo thể loại</p>
        <div class="product-container">
            @if(count($filteredProducts) > 0)
            @foreach($filteredProducts as $item)
            <div class="card">
                <a href="{{ route('client.productDetail', ['id' => $item->id]) }}">
                    <div class="cardd">
                        <img src="{{ asset('uploads/'.$item->image) }}" alt="Product Image">
                        <div class="discount">-92%</div>
                        <div class="content">
                            <h2 class="title">{{ $item->name }}</h2>
                            <p class="pricee">{{ number_format($item->price, 0, ',', '.') }}<span
                                    style="font-size: 12px; text-decoration: underline;">đ</span></p>
                        </div>
                        <div class="sold">
                            <span class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </span>
                            {{ number_format($item->sales >= 1000 ? $item->sales / 1000 : $item->sales, 1) .
                            ($item->sales >= 1000 ? 'k' : '') }} lượt bán
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
            @else
            <p>Không có sản phẩm nào thuộc thể loại này.</p>
            @endif
        </div>
    </div>
</div>
@endsection