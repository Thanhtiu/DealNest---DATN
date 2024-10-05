@extends('layouts.client.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    /* Global Styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        overflow-x: hidden;
    }

    /* Container */
    .container-fluid {
        padding: 0;
    }

    /* Sidebar */
    .sidebar {
        right: 30px;
        padding: 50px;
    }

    .sidebar h3 {
        font-size: 18px;
        margin-bottom: 15px;
    }

    /* Separator line */
    .sidebar .separator {
        margin: 20px 0;
        /* Space above and below the line */
        border-top: 1px solid #ddd;
        /* Line color and thickness */
    }

    .sidebar ul {
        list-style: none;
        padding-left: 0;
    }

    .sidebar ul li {
        margin-bottom: 10px;
        font-size: 14px;
    }

    .sidebar ul li a {
        color: #333;
        text-decoration: none;
    }

    .sidebar ul li ul {
        padding-left: 15px;
    }

    .sidebar ul li ul li a {
        font-size: 14px;
    }

    .sidebar input[type="checkbox"] {
        margin-right: 8px;
    }


    /* Sorting Bar */
    .sort-bar {
        display: flex;
        flex-direction: column;
        margin-bottom: 20px;
        padding: 10px 20px;
    }

    .sort-bar label {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .sort-options {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .sort-options select {
        padding: 5px;
        border-radius: 3px;
        border: 1px solid #ccc;
        font-size: 14px;
    }

    .price-sort {
        display: flex;
        gap: 10px;
    }

    .price-option {
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
        background-color: #fff;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .price-option:hover {
        background-color: #f0f0f0;
    }

    .price-option.active {
        background-color: #eee;
        border-color: #bbb;
        font-weight: bold;
    }


    /* Product Grid Layout */
    /* Adjusted Container */

    /* Adjust Sidebar and Main Content */
    .col-md-3 {
        padding-right: 10px;
        /* Reduce space on the right */
    }

    .col-md-9 {
        padding-left: 10px;
        /* Reduce space on the left */
    }

    /* Adjust product list layout */
    .product-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: flex-start;
        padding: 10px;
        /* Reduce padding to move closer to the sidebar */
        margin-left: 0;
        /* Set margin to 0 to minimize spacing */
    }

    .cardd {
        position: relative;
        display: flex;
        flex-direction: column;
        border-radius: 3px;
        height: 340px;
        width: 188px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .cardd img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }

    .cardd:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .discount {
        position: absolute;
        top: 0;
        right: 0;
        background-color: #ee8f71;
        color: #fff;
        padding: 2px 5px;
        font-size: 11px;
        font-weight: bold;
        border-radius: 1px;
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
        height: 40px;
        overflow: hidden;
    }

    .price {
        font-size: 16px;
        color: #FF5722;
        position: absolute;
        bottom: 10px;
        left: 10px;
    }

    .rating {
        display: inline-block;
        margin-right: 10px;
        color: #FFD700;
        font-size: 10px;
        vertical-align: middle;
        padding-left: 10px;
    }

    .rating i {
        margin-right: 1px;
    }

    .sold {
        display: flex;
        align-items: center;
        font-size: 12px;
        color: #777;
        margin-top: 10px;
        /* Adjust the margin to create spacing from the price */
        position: relative;
        /* Change from absolute to relative to place it naturally within the content flow */
    }

    .location {
        font-size: 12px;
        color: #999;
        margin-top: 5px;
        padding-left: 10px;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <!-- Sidebar -->
        <div class="col-md-3">
            <div class="sidebar">
                <h3>Tất Cả Danh Mục</h3>
                <ul>
                    <li>
                        <a href="#">{{ $category->name }} </a>
                        <ul>
                            @foreach($listSubCategory as $item)
                            <li><a href="/the-loai/{{ $category->slug }}/{{ $item->slug }}" style={{ ($item->slug ===
                                    $subcategory_slug) ? "color:red" : "" }} href="#"
                                    class="subcategory-link" data-id="{{ $item->id }}">
                                    {{$item->name}} </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <div class="separator"></div>
                <ul>
                    <li>
                        <a href="#">BỘ LỌC TÌM KIẾM</a>
                        <ul>
                            <li><input class="province" type="checkbox" id="ao-thun" value="Hà nội">
                                <label for="ao-thun">Hà nội</label>
                            </li>
                            <li><input class="province" type="checkbox" id="ao-so-mi" value="TP HCM">
                                <label for="ao-so-mi">TP HCM</label>
                            </li>
                            <li><input class="province" type="checkbox" id="ao-khoac" value="Thái nguyên">
                                <label for="ao-khoac">Thái nguyên</label>
                            </li>
                            <li><input class="province" type="checkbox" id="phu-kien" value="Vĩnh phúc">
                                <label for="phu-kien">Vĩnh phúc</label>
                            </li>
                            <li><input class="province" type="checkbox" id="phu-kien" value="Hải phòng">
                                <label for="phu-kien">Hải phòng</label>
                            </li>
                            <li><input class="province" type="checkbox" id="phu-kien" value="Cần thơ">
                                <label for="phu-kien">Cần thơ</label>
                            </li>
                            <li><input class="province" type="checkbox" id="phu-kien" value="Nam định">
                                <label for="phu-kien">Nam Định</label>
                            </li>
                            {{-- <li><a href="#">Thêm</a></li> --}}
                        </ul>
                    </li>
                </ul>
            </div>
        </div>


        <!-- Main Content -->
        <div class="col-md-9">
            <!-- Sort Bar -->
            <!-- Sort Bar -->
            <div class="sort-bar">

                <div class="sort-options">
                    <label for="sort">Sắp xếp theo:</label>
                    <div class="price-sort">
                        <button class="price-option" id="sortby-desc" value="DESC">Mới Nhất</button>
                        <button class="price-option" id="sortby-asc" value="ASC">Cũ Nhất</button>
                        <button class="price-option" id="sortby-sale" value="sale">Bán Chạy</button>
                    </div>
                    <select id="sort-category">
                        <option value="">Giá</option>
                        <option value="price-asc">Thấp Đến Cao</option>
                        <option value="price-desc">Cao Đến Thấp</option>
                    </select>
                </div>
            </div>


            <!-- Product List -->
            <div class="product-list">

                @foreach($productCategory as $item)
                <div class="cardd">
                    <img src="{{asset('uploads/' . $item->product_image->first()->url)}}" alt="Product Image">
                    <div class="discount">-92%</div>
                    <div class="content">
                        <h2 class="title"> {{$item->name}} </h2>
                        <p class="price">₫ {{number_format($item->price, 0, ',', '.')}}</p>
                    </div>
                    <div class="sold">
                        <span class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </span>
                        Đã bán {{ $item->sales }}+
                    </div>
                    {{-- <span class="location">Hà Nội</span> --}}
                    <span class="location">
                        @php

                        $string = $item->seller->address->string_address;

                        $array = preg_split('/[\s,]+/', $string, -1, PREG_SPLIT_NO_EMPTY);

                        $lastTwoWords = array_slice($array, -2);

                        $result = implode(' ', $lastTwoWords);


                        @endphp

                        {{ $result }}

                    </span>



                </div>
                @endforeach


                <!-- Additional product cards -->
            </div>
        </div>
    </div>
</div>
@endsection