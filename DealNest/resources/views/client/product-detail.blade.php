@extends('layouts/client.app')
@section('content')
<!-- Product Details Section Begin -->
 <style>
    .product-details {
    padding-top: 80px;
}

.product__details__pic__item {
    margin-bottom: 20px;
}

.product__details__pic__item img {
    min-width: 100%;
}

.product__details__pic__slider img {
    cursor: pointer;
}

.product__details__pic__slider.owl-carousel .owl-item img {
    width: auto;
}

.product__details__text h3 {
    color: #252525;
    font-weight: 700;
    margin-bottom: 16px;
}

.product__details__text .product__details__rating {
    font-size: 14px;
    margin-bottom: 12px;
}

.product__details__text .product__details__rating i {
    margin-right: -2px;
    color: #EDBB0E;
}

.product__details__text .product__details__rating span {
    color: #dd2222;
    margin-left: 4px;
}

.product__details__text .product__details__price {
    font-size: 30px;
    color: #dd2222;
    font-weight: 600;
    margin-bottom: 15px;
}

.product__details__text p {
    margin-bottom: 45px;
}

/* Primary Button */
.product__details__text .primary-btn {
    padding: 16px 28px 14px;
    margin-right: 6px;
    margin-bottom: 5px;
}

/* Checkout Button */
.product__details__buttons .primary-btn.btn-checkout {
    background-color: #28a745;
    color: white;
}

.product__details__buttons .primary-btn.btn-checkout:hover {
    background-color: #218838;
    color: white;
}

/* Heart Icon */
.product__details__text .heart-icon {
    display: inline-block;
    font-size: 16px;
    color: #6f6f6f;
    padding: 13px 16px 13px;
    background: #f5f5f5;
}

/* Size, Color, Voucher Option */
.product__details__option {
    margin-bottom: 20px;
}

.product__details__option b {
    font-weight: 700;
    margin-right: 10px;
}

.product__details__option select {
    padding: 8px 12px;
    border: 1px solid #ebebeb;
    color: #333;
    font-size: 14px;
    width: auto;
    display: inline-block;
    margin-right: 10px;
}

.product__details__quantity {
    display: inline-block;
    margin-right: 6px;
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

.chat-message > span {
    font-weight: bold; 
}</style>
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="{{asset('client/img/product/details/product-details-1.jpg')}}"
                            alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="{{asset('client/img/product/details/product-details-2.jpg')}}"
                            src="{{asset('client/img/product/details/thumb-1.jpg')}}" alt="">
                        <img data-imgbigurl="{{asset('client/img/product/details/product-details-3.jpg')}}"
                            src="{{asset('client/img/product/details/thumb-2.jpg')}}" alt="">
                        <img data-imgbigurl="{{asset('client/img/product/details/product-details-5.jpg')}}"
                            src="{{asset('client/img/product/details/thumb-3.jpg')}}" alt="">
                        <img data-imgbigurl="{{asset('client/img/product/details/product-details-4.jpg')}}"
                            src="{{asset('client/img/product/details/thumb-4.jpg')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>Vetgetable’s Package</h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div>
                    <div class="product__details__price">$50.00</div>
                    <p>Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam
                        vehicula elementum sed sit amet dui.</p>

                    <!-- Size Option -->
                    <div class="product__details__option">
                        <b>Size:</b>
                        <select>
                            <option value="S">Small</option>
                            <option value="M">Medium</option>
                            <option value="L">Large</option>
                        </select>
                    </div>

                    <!-- Color Option -->
                    <div class="product__details__option">
                        <b>Color:</b>
                        <select>
                            <option value="red">Red</option>
                            <option value="green">Green</option>
                            <option value="blue">Blue</option>
                        </select>
                    </div>

                    <!-- Voucher Option -->
                    <div class="product__details__option">
                        <b>Voucher:</b>
                        <select>
                            <option value="5off">$5 Off</option>
                            <option value="10off">$10 Off</option>
                            <option value="15off">$15 Off</option>
                        </select>
                    </div>

                    <!-- Quantity -->
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1">
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="product__details__buttons">
                        <a href="#" class="primary-btn">ADD TO CART</a>
                        <a href="#" class="primary-btn btn-checkout">CHECKOUT</a>
                        <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>
                    </div>

                    <ul>
                        <li><b>Availability:</b> <span>In Stock</span></li>
                        <li><b>Shipping:</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                        <li><b>Weight:</b> <span>0.5 kg</span></li>
                        <li><b>Share on:</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                aria-selected="false">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                aria-selected="false">Reviews <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                    Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus
                                    suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam
                                    vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
                                    Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,
                                    accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a
                                    pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula
                                    elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci luctus
                                    et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam
                                    vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>
                                <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                    ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                    elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                    porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                    nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                                    Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
                                    porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
                                    sed sit amet dui. Proin eget tortor risus.</p>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->
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
                        <img src="https://static.vecteezy.com/system/resources/previews/011/490/381/original/happy-smiling-young-man-avatar-3d-portrait-of-a-man-cartoon-character-people-illustration-isolated-on-white-background-vector.jpg" alt="Shop Avatar" class="shop-avatar">
                        <div class="shop-name ml-3">
                            <h5>TORANO Official Store</h5>
                            <p>Online 1 giờ trước</p>
                        </div>
                    </div>
                    
                    <!-- Nút xem shop và chat ngay -->
                    <div class="shop-info__buttons mt-3">
                        <a href="link-to-shop-page" class="btn btn-primary">Xem Shop</a>
                        <button id="chatButton" class="btn btn-success">Chat Ngay</button>
                    </div>
                </div>
            </div>

            <!-- Rating -->
            <div class="col-lg-3 col-md-6">
                <div class="shop-info__item">
                    <h5>Đánh giá</h5>
                    <p>95,2k</p>
                    <h5>Tham gia</h5>
                    <p>9 năm trước</p>
                </div>
            </div>

            <!-- Response Rate and Response Time -->
            <div class="col-lg-3 col-md-6">
                <div class="shop-info__item">
                    <h5>Tỉ lệ phản hồi</h5>
                    <p>100%</p>
                    <h5>Thời gian phản hồi</h5>
                    <p>Trong vài giờ</p>
                </div>
            </div>

            <!-- Followers and Products -->
            <div class="col-lg-3 col-md-6">
                <div class="shop-info__item">
                    <h5>Người theo dõi</h5>
                    <p>438,9k</p>
                    <h5>Sản phẩm</h5>
                    <p>578</p>
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
                        <img src="https://static.vecteezy.com/system/resources/previews/011/490/381/original/happy-smiling-young-man-avatar-3d-portrait-of-a-man-cartoon-character-people-illustration-isolated-on-white-background-vector.jpg" alt="User Avatar">
                    </div>
                    <div class="chat-info">
                        <h6 class="chat-name">User1</h6>
                        <p class="chat-message">Sản phẩm của bạn có sẵn không?</p>
                    </div>
                    <span class="chat-date">16/06</span>
                </div>
                <div class="chat-item" onclick="selectChat('user2')">
                    <div class="chat-avatar">
                        <img src="https://static.vecteezy.com/system/resources/previews/011/490/381/original/happy-smiling-young-man-avatar-3d-portrait-of-a-man-cartoon-character-people-illustration-isolated-on-white-background-vector.jpg" alt="User Avatar">
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


<script>// JavaScript to handle chat box toggle

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

    </script>
    
 @endsection