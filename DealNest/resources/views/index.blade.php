@extends('layouts/client.app')
@section('content')
<link rel="stylesheet" href="{{asset('client/css/product.css')}}" type="text/css">


<section class="category-section">
    <h2>DANH MỤC</h2>
    <button class="scroll-button prev">&lt;</button>
    <div class="category-wrapper">
        <div class="category-slider">
            <div class="category-list">
                <!-- Danh sách mục trong slider -->
                @foreach($categories as $item)
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/ce8f8abc726cafff671d0e5311caa684@resize_w320_nl.webp"
                        alt="Category 1">
                    <span> {{$item->name}} </span>
                </div>
                @endforeach
            </div>
        </div>
      

        <!-- Thêm nhiều slider nếu cần -->
    </div>
    <button class="scroll-button next">&gt;</button>
</section>


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

<script src="{{asset('client/js/index.js')}}"></script>

@endsection