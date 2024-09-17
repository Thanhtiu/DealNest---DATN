@extends('layouts/client.app')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    .product-container {
    display: grid;
    grid-template-columns: repeat(6, 1fr); /* 6 columns of equal width */
    gap: 10px; /* Reduced space between items */
    margin-top: 20px;
    margin: 70px auto; /* Centering the container with auto margins on the sides */
    max-width: 1200px; /* Optional: Max width to center the container and prevent it from stretching too wide */
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    border-radius: 3px;
    height: 308px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    width: 100%; /* Ensures card takes full width of the grid column */
}

    .cardd {
        position: relative;
        display: flex;
        flex-direction: column;
        border-radius: 3px;
        height: 308px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .discount {
        position: absolute;
        top: 0px;
        right: 0px;
        background-color: #ee8f71;
        color: #fff;
        padding: 2px 5px;
        font-size: 11px;
        font-weight: bold;
        border-radius: 1px;
    }

    *,
    ::after,
    ::before {
        box-sizing: border-box;
    }

    .content {
        padding: 10px;
        text-align: left;
        flex: 1;
        position: relative;
    }

    .title {
        font-size: 14px;
        font-weight: bold;
        color: #333;
        margin: 0;
        text-align: left;
    }

    .pricee {
        font-size: 16px;
        color: #FF5722;
        position: absolute;
        bottom: 10px;
        left: 10px;
        /* chỉnh lại giá nằm sát trái */

    }

    .rating {
        display: inline-block;
        margin-right: 8px;
        color: #FFD700;
        font-size: 9px;
        vertical-align: middle;
    }

    .rating i {
        margin-right: 1px;
    }

    .sold {
        display: flex;
        align-items: center;
        font-size: 8px;
        color: #777;
        position: absolute;
        bottom: 10px;
        left: 10px;
    }

    .category-section {
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        width: 80%;
        position: relative;
    }

    .category-wrapper {
        display: flex;
        overflow-x: hidden;
        overflow-y: hidden;
        white-space: nowrap;
    }

    .category-slider {
        display: flex;
        flex-direction: column;
        gap: 15px;
        flex-shrink: 0;
        width: 100%;
        height: 320px;
    }

    .category-list {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        margin-left: 50px;
    }

    .category-item {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 120px;
        height: 150px;
        overflow: hidden;
    }

    .category-item img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .category-item span {
        font-size: 14px;
        color: #333;
        font-weight: 500;
        display: block;
        width: 100%;
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .scroll-button {
        background-color: rgba(0, 0, 0, 0.2);
        color: #fff;
        border: none;
        border-radius: 0;
        width: 24px;
        height: 24px;
        cursor: pointer;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 2;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .scroll-button.prev {
        left: -10px;
    }

    .scroll-button.next {
        right: -10px;
    }

    .scroll-button:hover {
        background-color: rgba(0, 0, 0, 0.4);
        transform: translateY(-50%) scale(1.2);
    }
</style>
<section class="category-section">
    <h2>DANH MỤC</h2>
    <button class="scroll-button prev">&lt;</button>
    <div class="category-wrapper">
        <div class="category-slider">
            <div class="category-list">
                <!-- Danh sách mục trong slider -->
                @foreach($category_1 as $item)
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/ce8f8abc726cafff671d0e5311caa684@resize_w320_nl.webp"
                        alt="Category 1">
                    <span> {{$item->name}} </span>
                </div>
                @endforeach

                <!-- Thêm các mục khác -->
            </div>
        </div>
        <div class="category-slider">
            <div class="category-list">
                <!-- Danh sách mục trong slider -->
                @foreach($category_2 as $item)
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/86c294aae72ca1db5f541790f7796260@resize_w320_nl.webp"
                        alt="Category 3">
                    <span>{{ $item->name }}</span>
                </div>
                @endforeach
                <!-- Thêm các mục khác -->
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
</div>
<script src="{{asset('client/js/index.js')}}"></script>

@endsection