@extends('layouts/client.app')
@section('content')
<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="img/product/details/product-details-1.jpg"
                            alt="">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <img data-imgbigurl="img/product/details/product-details-2.jpg"
                            src="img/product/details/thumb-1.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-3.jpg"
                            src="img/product/details/thumb-2.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-5.jpg"
                            src="img/product/details/thumb-3.jpg" alt="">
                        <img data-imgbigurl="img/product/details/product-details-4.jpg"
                            src="img/product/details/thumb-4.jpg" alt="">
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
<section class="shop-info spad">
    <div class="container">
        <div class="row">
            <!-- Shop Avatar and Name with Online Status -->
            <div class="col-lg-3 col-md-6">
                <div class="shop-info__item">
                    <!-- Header with Avatar and Shop Name -->
                    <div class="shop-info__header d-flex align-items-center">
                        <!-- Shop Avatar -->
                        <img src="https://static.vecteezy.com/system/resources/previews/011/490/381/original/happy-smiling-young-man-avatar-3d-portrait-of-a-man-cartoon-character-people-illustration-isolated-on-white-background-vector.jpg"
                            alt="Shop Avatar" class="shop-avatar">
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
@endsection
<script>
    // JavaScript to handle chat box toggle

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

// Thêm sự kiện để gửi tin nhắn mới
document.querySelector('.btn-primary').addEventListener('click', function() {
    const input = document.querySelector('.chat-input');
    const newMessage = input.value.trim();

    if (newMessage) {
        const chatContent = document.getElementById('chatContent');
        chatContent.innerHTML += `<div class="chat-message">Bạn: ${newMessage}</div>`;
        input.value = ''; // Xóa nội dung ô nhập
    }
});

// Thêm sự kiện để đóng chat
document.getElementById('closeChat').addEventListener('click', function() {
    document.getElementById('chatSection').style.display = 'none';
});
        document.getElementById("chatButton").addEventListener("click", function() {
            document.getElementById("chatSection").style.display = "block";
        });
        
        // Hide the chat section when close button is clicked
        document.getElementById("closeChat").addEventListener("click", function() {
            document.getElementById("chatSection").style.display = "none";
        });
</script>