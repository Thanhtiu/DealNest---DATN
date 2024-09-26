@extends('layouts/client.app')
@section('content')
<!-- Product Details Section Begin -->
<style>
  .col-lg-12{
    max-width: 1200px;
    margin: 0 auto;
  }
  .product-section {
    padding: 20px;
    background-color: #f9f9f9;
  }

  .product-layout {
    display: flex;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 1200px;
    /* Hạn chế chiều rộng tổng thể */
    margin: 0 auto;
    /* Canh giữa trang */
  }

  .product-images {
    flex: 4;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-right: 20px;
  }

  .main-image img {
    width: 200%;
    /* Giữ tỷ lệ hình ảnh chính */
    max-width: 450px;
    /* Kích thước tối đa */
    height: auto;
  }

  .thumbnail-slider-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    overflow: hidden;
    margin: 10px;
    margin-left: 30px;
}

.thumbnail-images-slider {
    display: flex;
    overflow: hidden;
    width: 100%;
}

.thumbnail-track {
    display: flex;
    transition: transform 0.3s ease;
}

.thumbnail-slide {
    flex: 0 0 calc(20% - 20px); /* Mỗi slide chiếm khoảng 20% của slider, trừ đi khoảng cách */
    box-sizing: border-box; /* Đảm bảo padding/margin không ảnh hưởng đến kích thước */
    margin-right: 10px; /* Khoảng cách giữa các ảnh */
}

.thumbnail-slide img {
    width: 100%;
    height: auto;
    display: block; /* Đảm bảo không có khoảng trắng dưới ảnh */
}

.prev-btn, .next-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0, 0, 0, 0.5); /* Nền trong suốt với màu đen */
    color: #fff;
    border: none;
    padding: 10px;
    cursor: pointer;
    transition: background-color 0.3s ease; /* Hiệu ứng chuyển màu nền */
    z-index: 1; /* Đảm bảo các nút nằm trên các phần tử khác */
}

.prev-btn {
    left: 0px; /* Đặt nút "trước" ở bên trái */
}

.next-btn {
    right: 0px; /* Đặt nút "tiếp theo" ở bên phải */
}

.prev-btn:hover, .next-btn:hover {
    background-color: rgba(0, 0, 0, 0.8); /* Tăng độ đậm khi hover */
}

.prev-btn:disabled, .next-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}



  .product-info {
    flex: 6;
    padding-left: 20px;
    display: flex;
    flex-direction: column;
    margin-right: 50px;
   
  }

  .product-info h1 {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .rating-sales {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    margin-right: 125px;
  }

  .price-container {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-right: 50px;
  }

  .original-price {
    font-size: 18px;
    color: #888;
    text-decoration: line-through;
  }

  .discounted-price {
    font-size: 24px;
    color: #e12d2d;
    font-weight: bold;
  }

  .discount-badge {
    background-color: #e12d2d;
    color: white;
    font-size: 14px;
    padding: 3px 8px;
    border-radius: 3px;
    font-weight: bold;
  }

  .discount-section {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
  }

  .discount-tag {
    background-color: #fef1f1;
    color: #d83333;
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: bold;
  }

  .insurance-section {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
    margin-right: 20px;
  }

  .shipping-section {
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;

  }

  .insurance-section span,
  .shipping-section span {
    margin-bottom: 5px;
    margin-right: 20px;
  }

  .insurance-section .new-tag {
    background-color: #ff4c4c;
    color: white;
    padding: 3px 5px;
    border-radius: 3px;
    margin-left: 10px;
  }

  .shipping-info {
    display: flex;
    flex-direction: column;
  }

  .product-options {
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
    margin-left: 145px;
  }

  .product-options .option {
    display: flex;
    align-items: flex-start;
    /* Đặt căn chỉnh từ trên xuống */
    margin-bottom: 15px;
  }

  .product-options label {
    width: 80px;
    margin-right: 10px;
    text-align: left;
    font-size: 14px;
    font-weight: bold;
  }

  .attribute-options {
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
  }

  .attribute-options {
    display: flex;
    gap: 5px;
    flex-wrap: wrap;
  }

  .attribute-option,
  .attribute-option {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 3px 6px;
    border: 1px solid #ccc;
    background-color: #fff;
    cursor: pointer;
  }

  .attribute-option img {
    width: 30px;
    height: 30px;
    object-fit: cover;
    margin-bottom: 3px;
  }

  .attribute-option span {
    font-size: 12px;
  }

  .attribute-option {
    padding: 6px 12px;
    font-size: 12px;
    font-weight: bold;
    border-radius: 3px;
    background-color: #fff;
    border: 1px solid #ccc;
    cursor: pointer;
    text-align: center;
  }

  /* Hiệu ứng hover */
  .attribute-option:hover,
  .attribute-option:hover {
    background-color: #f0f0f0;
    border-color: #999;
  }

  .product-options .option {
    margin-bottom: 20px;
  }

  .attribute-options {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    /* Space between the options */
  }

  .attribute-option {
    padding: 8px 16px;
    border: 1px solid #ddd;
    background-color: #fff;
    cursor: pointer;
  }

  .attribute-option:hover {
    background-color: #f0f0f0;
  }

  .quantity-selector {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
  }

  .quantity-selector label {
    margin-right: 10px;
    /* Khoảng cách giữa nhãn số lượng và các nút */
  }

  .quantity-selector button {
    background-color: #dcdcdc;
    border: none;
    padding: 5px 10px;
    margin: 0 5px;
  }

  .quantity-selector input {
    width: 50px;
    text-align: center;
  }

  .product-actions {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
  }

  .add-to-cart {
    background-color: #dcdcdc;
    padding: 10px 20px;
    border: none;
    font-size: 16px;
  }

  .buy-now {
    background-color: red;
    color: white;
    padding: 10px 20px;
    border: none;
    font-size: 16px;
  }

  .guarantees {
    display: flex;
    justify-content: space-between;
    font-size: 12px;
    color: #666;
    margin-top: 20px;
    gap: 10px;
  }

  /* shop info */
  .shop-info__item {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    text-align: center;
    margin-bottom: 20px;
  }


  .shop-info__header {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 15px;
  }


  .shop-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
  }


  .shop-name {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  .shop-name h5 {
    margin: 0;
    font-size: 16px;
    font-weight: bold;
  }

  .shop-name p {
    margin: 0;
    font-size: 12px;
    color: gray;
  }


  .shop-info__buttons {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
  }


  .shop-info__item .btn {
    display: inline-block;
    width: 120px;
    padding: 8px 0;
    font-size: 14px;
    border-radius: 5px;
    text-align: center;
    color: #000;
    background-color: transparent;
    border: 2px solid #000;
    transition: background-color 0.3s, color 0.3s;
  }

  .shop-info__item .btn-primary:hover {
    background-color: rgba(0, 123, 255, 0.1);
    color: #007bff;
  }

  .shop-info__item .btn-success:hover {
    background-color: rgba(40, 167, 69, 0.1);
    color: #28a745;
  }

  body {
    position: relative;
  }

  /* chat */
  .chat-section {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 650px;
    max-width: 100%;
    border: 1px solid #e0e0e0;
    border-radius: 10px;
    background-color: #fff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }

  .chat-header {
    background-color: #f5f5f5;
    padding: 10px;
    border-bottom: 1px solid #e0e0e0;
  }

  .chat-title {
    margin: 0;
    font-size: 16px;
  }

  .btn-close {
    background: none;
    border: none;
    font-size: 20px;
    cursor: pointer;
  }

  .chat-body {
    display: flex;
    max-height: 400px;
    overflow: hidden;
  }

  .chat-list {
    width: 60%;
    padding: 10px;
    border-right: 1px solid #e0e0e0;
    overflow-y: auto;
  }

  .search-input {
    width: 100%;
    padding: 8px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    margin-bottom: 10px;
  }

  .chat-item {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #e0e0e0;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .chat-item:hover {
    background-color: #f5f5f5;
  }

  .chat-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 10px;
  }

  .chat-avatar img {
    width: 100%;
    height: auto;
  }

  .chat-info {
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .chat-name {
    margin: 0;
    font-weight: bold;
    font-size: 14px;
    color: #333;
  }

  .chat-message {
    margin: 5px 0 0 0;
    color: #555;
    font-size: 13px;
  }

  .chat-date {
    font-size: 12px;
    color: #999;
    margin-left: 10px;
  }

  .chat-content {
    width: 80%;
    padding: 10px;
    overflow-y: auto;
  }

  .chat-warning {
    background-color: #ffeb3b;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 10px;
  }

  .chat-footer {
    display: flex;
    padding: 10px;
    border-top: 1px solid #e0e0e0;
  }

  .chat-input {
    flex: 1;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #e0e0e0;
    margin-right: 10px;
  }

  .btn-primary {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 5px;
    cursor: pointer;
  }

  .chat-message {
    margin-top: 10px;
    padding: 10px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    background-color: #f9f9f9;
  }

  .product-info {
    display: flex;
    align-items: center;
    margin-top: 10px;
  }

  .product-image {
    width: 80px;
    height: 80px;
    border-radius: 5px;
    margin-right: 10px;
    margin-top: 2px;
  }

  .product-details {
    flex: 1;
  }

  .product-name {
    margin: 0;
    font-weight: bold;
  }

  .product-price {
    color: #d9534f;
    font-weight: bold;
    margin-top: 5px;
  }

  .chat-user {
    font-weight: bold;
    color: #007bff;
  }

  .chat-message {
    margin: 10px 0;
    padding: 10px;
    border-radius: 8px;
  }

  .chat-message:nth-child(odd) {
    background-color: #e9f7ff;
    align-self: flex-start;
  }

  .chat-message:nth-child(even) {
    background-color: #d4edda;
    align-self: flex-end;
  }

  .chat-message>span {
    font-weight: bold;
  }
  .text-shop{
    color:red;
  }
</style>
<section class="product-section">
  <div class="product-layout">
    <!-- Bên trái: Hình ảnh -->
    <div class="product-images">
    <!-- Hình ảnh chính (ảnh lớn) -->
    <div class="main-image">
        <img src="{{ asset('uploads/'.$productDetail->image) }}" alt="Giày PUMA"
            class="img-responsive" id="main-product-image">
    </div>

    <!-- Slider thumbnail -->
    <div class="thumbnail-slider-container">
        <button class="prev-btn">‹</button>

        <div class="thumbnail-images-slider">
            <div class="thumbnail-track">
                @foreach($productDetail->product_image as $item)
                <div class="thumbnail-slide">
                    <img src="{{ asset('uploads/'.$item->url) }}" alt="Thumbnail {{ $loop->index }}">
                </div>
                @endforeach
            </div>
        </div>

        <button class="next-btn">›</button>
    </div>
</div>


    <!-- Bên phải: Thông tin sản phẩm -->
    <div class="product-info">
      <h1>{{$productDetail->name}}</h1>
      <div class="rating-sales">
        <span>4.8 ★ (43 Đánh Giá) -</span>
        <span>- {{$productDetail->sales}} Đã Bán</span>
      </div>
      <div class="price-container">
        <span class="original-price">{{number_format($productDetail->price, 0, ',', '.')}}</span>
        <span class="discounted-price">₫600.000</span>
        <span class="discount-badge">40% GIẢM</span>
      </div>
      <div class="discount-section">
        <span>Mã Giảm Giá Của Shop:</span>
        <span class="discount-tag">5% GIẢM</span>
      </div>
      {{-- <div class="insurance-section">
        <span>Bảo Hiểm:</span>
        <span>Bảo hiểm Bảo vệ người tiêu dùng <span class="new-tag">Mới</span></span>
        <a href="#" class="learn-more">Tìm hiểu thêm</a>
      </div> --}}
      <div class="shipping-section">
        <span class="free-ship">Miễn phí vận chuyển</span>
        <div class="shipping-info">
          <span>Vận Chuyển Tới: {{$string_address}}</span>
          <span>Phí Vận Chuyển: 0₫</span>
        </div>
      </div>
      <form action="{{ route('cart.add') }}" method="POST">
        @csrf
        <div class="product-options">
    @foreach ($productDetail->attribute_values->groupBy('attribute_id') as $attribute_id => $attributes)
    <div class="option mb-3">
        <label class="form-label">{{ strtoupper($attributes->first()->attribute->name) }}</label>
        <select class="form-select attribute-select" name="attributes[{{ $attribute_id }}]" required>
            <option value="" selected>Chọn {{ strtolower($attributes->first()->attribute->name) }}</option>
            @foreach ($attributes as $attribute)
            <option value="{{ $attribute->value }}" data-attribute-id="{{ $attribute->attribute_id }}">
                {{ $attribute->value }} 
                @if ($attribute->price)
                    - Giá: {{ number_format($attribute->price, 2) }} 
                @endif
            </option>
            @endforeach
        </select>
    </div>
    @endforeach
</div>

    
        <div class="quantity-selector">
    <label for="quantity">Số Lượng</label>
    <button type="button" class="decrease">-</button>
    <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $productDetail->quantity }}">
    <button type="button" class="increase">+</button>
    <span>{{ $productDetail->quantity }} sản phẩm có sẵn</span>
</div>
    
        <input type="hidden" name="product_id" value="{{ $productDetail->id }}">
    
        <div class="product-actions">
            @if(Session::get('userId'))
            <button type="submit" class="add-to-cart">Thêm Vào Giỏ Hàng</button>
            @else
            <a href="{{ route('account.login') }}" style="color: red;">Bạn cần phải đăng nhập</a>
            @endif
        </div>
    </form>
  
      <div class="guarantees">
        <span>Đổi ý miễn phí 15 ngày</span>
        <span>Hàng chính hãng 100%</span>
        <span>Miễn phí vận chuyển</span>
      </div>
    </div>
  </div>
</section>
<!-- Product Details Section End -->

<div class="col-lg-12">
  <div class="product__details__tab">
      <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                  aria-selected="true">Mô tả</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                  aria-selected="false">Thông tin liên quan</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                  aria-selected="false">Đánh giá <span>(1)</span></a>
          </li>
      </ul>
      <div class="tab-content">
          <div class="tab-pane active" id="tabs-1" role="tabpanel">
              <div class="product__details__tab__desc">
                  <h6>Mô tả sản phẩm {{$productDetail->name}}</h6>
                  {!! $productDetail->description !!}
              </div>
          </div>
          <div class="tab-pane" id="tabs-2" role="tabpanel">
              <div class="product__details__tab__desc">
                  <h6>Products Infomation</h6>
                  <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                      Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                      Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                      sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                      eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                      Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                      sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                      diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                      ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                      Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                      Proin eget tortor risus.</p>
                  <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                      ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                      elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                      porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                      nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
              </div>
          </div>
          <div class="tab-pane" id="tabs-3" role="tabpanel">
              <div class="product__details__tab__desc">
                  <!-- Đánh giá sản phẩm -->
    <section class="product-details spad" style="padding: 0px;">
      <div class="container mt-4" >
          <div class="border p-3 ">
              <h4>ĐÁNH GIÁ SẢN PHẨM</h4>
              <div class="d-flex align-items-center">
                  <h3 class="mb-0">4.5</h3>
                  <span class="ms-2 text-muted">trên 5</span>
                  <div class="ms-3">
                      <div class="d-flex">
                          <span class="text-warning">★</span>
                          <span class="text-warning">★</span>
                          <span class="text-warning">★</span>
                          <span class="text-warning">★</span>
                          <span class="text-warning">★</span>
                      </div>
                  </div>
              </div>
              <div class="mt-2">
                  <button class="btn btn-outline-secondary btn-sm">Tất Cả</button>
                  <button class="btn btn-outline-secondary btn-sm">5 Sao (453)</button>
                  <button class="btn btn-outline-secondary btn-sm">4 Sao (70)</button>
                  <button class="btn btn-outline-secondary btn-sm">3 Sao (32)</button>
                  <button class="btn btn-outline-secondary btn-sm">2 Sao (18)</button>
                  <button class="btn btn-outline-secondary btn-sm">1 Sao (26)</button>
                  <button class="btn btn-outline-secondary btn-sm">Có Bình Luận (179)</button>
                  <button class="btn btn-outline-secondary btn-sm">Có Hình Ảnh / Video (64)</button>
              </div>
          </div>
      
          <div class="mt-4">
              <div class="border-bottom pb-3 mb-3">
                  <div class="d-flex align-items-start">
                      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkMKELi_bJbHSqXl1yj0HosEYlsAvMIomsZg&s" alt="User" class="rounded-circle me-3" style="width: 40px;">
                      <div>
                          <h6 class="mb-1">dosen98</h6>
                          <p class="mb-1 text-muted">2023-08-02 15:38 | Phân loại hàng: COOL,M(30-45KG)</p>
                          <div class="d-flex align-items-center">
                              <span class="text-warning">★</span>
                              <span class="text-warning">★</span>
                              <span class="text-warning">★</span>
                              <span class="text-warning">★</span>
                              <span class="text-warning">★</span>
                          </div>
                          <p class="mt-2 mb-2">Đúng với mô tả: chất đẹp ,vừa tiền giao đúng. Shop tư vấn nhiệt tình, giao nhanh.</p>
                          <div class="d-flex " >
                              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLfgct344qmtPhte_NdC1knPF8izcN_8kUHQ&s" alt="Product" class="mr-2 " style="width: 100px;">
                              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLfgct344qmtPhte_NdC1knPF8izcN_8kUHQ&s" alt="Product" style="width: 100px;">
                          </div>
                          <div class="mt-2">
                              <span class="text-muted">12  <i class="icon_like mr-2" ></i></span>
                          </div>
                      </div>
                  </div>
              </div>
      
              <div>
                  <div class="d-flex align-items-start">
                      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSkMKELi_bJbHSqXl1yj0HosEYlsAvMIomsZg&s" alt="User" class="rounded-circle me-3" style="width: 40px;">
                      <div>
                          <h6 class="mb-1">trannhicherry1997</h6>
                          <p class="mb-1 text-muted">2024-06-23 11:52 | Phân loại hàng: UNIQUE HỒNG,M(30-45KG)</p>
                          <div class="d-flex align-items-center">
                              <span class="text-warning">★</span>
                              <span class="text-warning">★</span>
                              <span class="text-warning">★</span>
                              <span class="text-warning">★</span>
                              <span class="text-muted">★</span>
                          </div>
                          <p class="mt-2 mb-2">Giao hàng nhanh, đóng gói bao bì cẩn thận, sản phẩm rất đẹp vải mát không bị nóng đâu.</p>
                          <div class="d-flex " >
                              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLfgct344qmtPhte_NdC1knPF8izcN_8kUHQ&s" alt="Product" class="mr-2 " style="width: 100px;">
                              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQLfgct344qmtPhte_NdC1knPF8izcN_8kUHQ&s" alt="Product" style="width: 100px;">
                          </div>
                          <div class="mt-2">
                              <span class="text-muted">12  <i class="icon_like mr-2" ></i></span>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
       <!-- END Đánh giá sản phẩm -->
              </div>
          </div>
      </div>
  </div>
</div>

<!-- Shop Info Section Begin -->
<!-- Shop Info Section -->
<section class="shop-info spad">
  <div class="container">
    <div class="row">
      <!-- Shop Avatar and Name with Online Status -->
      <div class="col-lg-3 col-md-6">
        <div class="shop-info__item">
          <!-- Header with Avatar and Shop Name -->
          <div class="shop-info__header d-flex align-items-center">
            <!-- Shop Avatar -->
            <img
              src="{{asset('uploads/'.$seller->logo)}}"
              alt="Shop Avatar" class="shop-avatar">
            <div class="shop-name ml-3">
              <h5>{{$seller->store_name}}</h5>
              <p class="text-shop">Online 1 giờ trước</p>
            </div>
          </div>

          <!-- Nút xem shop và chat ngay -->
          <div class="shop-info__buttons mt-3">
            <a href="{{route('client.shop',['id'=>$seller->id])}}" class="btn btn-primary">Xem Shop</a>
            <button id="chatButton" class="btn btn-success">Chat Ngay</button>
          </div>
        </div>
      </div>

      <!-- Rating -->
      <div class="col-lg-3 col-md-6">
        <div class="shop-info__item">
          <h5>Đánh giá</h5>
          <p class="text-shop">95,2k</p>
          <h5>Tham gia</h5>
          <p class="text-shop">{{$dateJoin}} ngày trước</p>
        </div>
      </div>

      

      <!-- Followers and Products -->
      <div class="col-lg-3 col-md-6">
        <div class="shop-info__item">
          <h5>Người theo dõi</h5>
          @if($seller->follow == '')
          <p class="text-shop">0</p>
          @else
          <p class="text-shop">{{$seller->follow}}</p>
          @endif
          <h5>Sản phẩm</h5>
          <p class="text-shop">{{$countProduct}}</p>
        </div>
      </div>
    </div>
  </div>
</section>




<!-- Chat Section (Hidden by Default) -->
<section id="chatSection" class="chat-section">
  <div class="chat-box">
    <div class="chat-header d-flex justify-content-between align-items-center">
      <h5 class="chat-title">Chat với <span class="chat-user">rowler.official</span></h5>
      <button id="closeChat" class="btn btn-close">&times;</button>
    </div>
    <div class="chat-body d-flex">
      <!-- Chat List -->
      <div class="chat-list">
        <input type="text" placeholder="Tìm kiếm" class="search-input">
        <div class="chat-item" onclick="selectChat('user1')">
          <div class="chat-avatar">
            <img
              src="https://static.vecteezy.com/system/resources/previews/011/490/381/original/happy-smiling-young-man-avatar-3d-portrait-of-a-man-cartoon-character-people-illustration-isolated-on-white-background-vector.jpg"
              alt="User Avatar">
          </div>
          <div class="chat-info">
            <h6 class="chat-name">User1</h6>
            <p class="chat-message">Sản phẩm của bạn có sẵn không?</p>
          </div>
          <span class="chat-date">16/06</span>
        </div>
        <div class="chat-item" onclick="selectChat('user2')">
          <div class="chat-avatar">
            <img
              src="https://static.vecteezy.com/system/resources/previews/011/490/381/original/happy-smiling-young-man-avatar-3d-portrait-of-a-man-cartoon-character-people-illustration-isolated-on-white-background-vector.jpg"
              alt="User Avatar">
          </div>
          <div class="chat-info">
            <h6 class="chat-name">User 2</h6>
            <p class="chat-message">Chào bạn, tôi có thể giúp gì?</p>
          </div>
          <span class="chat-date">15/06</span>
        </div>
      </div>

      <!-- Chat Content -->
      <div class="chat-content" id="chatContent">
        <p class="welcome-message">Chào mừng bạn đến với Shopee Chat</p>
        <p>Bắt đầu trả lời người mua!</p>
      </div>
    </div>

    <!-- Chat Footer -->
    <div class="chat-footer">
      <input type="text" placeholder="Nhập nội dung tin nhắn" class="chat-input">
      <button class="btn btn-primary">Gửi</button>
    </div>
  </div>
</section>









<script>
  document.addEventListener('DOMContentLoaded', function () {
      const decreaseButton = document.querySelector('.decrease');
      const increaseButton = document.querySelector('.increase');
      const quantityInput = document.getElementById('quantity');
      const maxQuantity = parseInt("{{$productDetail->quantity}}"); // Số lượng sản phẩm tối đa có sẵn

      // Xử lý khi nhấn nút giảm
      decreaseButton.addEventListener('click', function () {
          let currentQuantity = parseInt(quantityInput.value);
          if (currentQuantity > 1) {
              quantityInput.value = currentQuantity - 1;
          }
      });

      // Xử lý khi nhấn nút tăng
      increaseButton.addEventListener('click', function () {
          let currentQuantity = parseInt(quantityInput.value);
          if (currentQuantity < maxQuantity) {
              quantityInput.value = currentQuantity + 1;
          }
      });

      // Giới hạn khi người dùng tự nhập số lượng
      quantityInput.addEventListener('input', function () {
          let currentQuantity = parseInt(quantityInput.value);

          if (currentQuantity > maxQuantity) {
              quantityInput.value = maxQuantity;
          } else if (currentQuantity < 1 || isNaN(currentQuantity)) {
              quantityInput.value = 1;
          }
      });
  });
</script>


<script>
  // JavaScript to handle chat box toggle

// Function to select a chat and show chat history
function selectChat(user) {
    const chatContent = document.getElementById('chatContent');
    chatContent.innerHTML = `
        <div class="chat-message">Người mua: Sản phẩm của bạn có sẵn không?</div>
        <div class="chat-message">Người bán: Vâng, sản phẩm hiện có sẵn. Bạn muốn đặt hàng không?</div>
        <div class="chat-message">Người mua: Tôi muốn đặt hàng.</div>
        <div class="chat-message">Người bán: Cảm ơn bạn! Tôi sẽ xử lý đơn hàng ngay lập tức.</div>
        <div class="chat-message">Người mua: Cảm ơn bạn đã hỗ trợ!</div>
    `;
}

document.querySelector('.btn-primary').addEventListener('click', function() {
    const input = document.querySelector('.chat-input');
    const newMessage = input.value.trim();

    if (newMessage) {
        const chatContent = document.getElementById('chatContent');
        chatContent.innerHTML += `<div class="chat-message">Bạn: ${newMessage}</div>`;
        input.value = ''; 
    }
});


document.getElementById("chatButton").addEventListener("click", function() {
    document.getElementById("chatSection").style.display = "block";
});


document.getElementById("closeChat").addEventListener("click", function() {
    document.getElementById("chatSection").style.display = "none";
});


document.addEventListener('DOMContentLoaded', function () {
    const thumbnails = document.querySelectorAll('.thumbnail-slide img');
    const mainImage = document.getElementById('main-product-image');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    const track = document.querySelector('.thumbnail-track');
    const slides = document.querySelectorAll('.thumbnail-slide');

    // Hover effect for changing main image
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('mouseenter', function() {
            mainImage.src = this.src;
        });
    });

    // Slider control
    const visibleSlides = 5; // Number of thumbnails visible at once
    let slideWidth = slides[0].getBoundingClientRect().width; // Width of each thumbnail slide
    let currentIndex = 0;

    function updateSliderPosition() {
        slideWidth = slides[0].getBoundingClientRect().width; // Recalculate slide width
        const totalSlidesWidth = slides.length * slideWidth + (slides.length - 1) * 10; // Total width including margins
        const maxIndex = Math.max(0, slides.length - visibleSlides);
        const maxTranslateX = totalSlidesWidth - (visibleSlides * slideWidth);
        track.style.transform = `translateX(-${Math.min(currentIndex * slideWidth, maxTranslateX)}px)`;
        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= maxIndex;
    }

    nextBtn.addEventListener('click', function () {
        if (currentIndex < slides.length - visibleSlides) {
            currentIndex++;
            updateSliderPosition();
        }
    });

    prevBtn.addEventListener('click', function () {
        if (currentIndex > 0) {
            currentIndex--;
            updateSliderPosition();
        }
    });

    // Initial setup
    updateSliderPosition();

    // Optional: Handle window resize to adjust slideWidth
    window.addEventListener('resize', updateSliderPosition);
});

</script>

@endsection