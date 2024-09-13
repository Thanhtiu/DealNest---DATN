@extends('layouts/client.app')
@section('content')
<!-- Product Details Section Begin -->
 <style>
   

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
  max-width: 1200px; /* Hạn chế chiều rộng tổng thể */
  margin: 0 auto; /* Canh giữa trang */
}

.product-images {
  flex: 4;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-right: 20px;
}

.main-image img {
  width: 200%; /* Giữ tỷ lệ hình ảnh chính */
  max-width: 500px; /* Kích thước tối đa */
  height: auto; 
}

.thumbnail-images {
  display: flex;
  margin-top: 10px;
  margin-left: 30px; /* Đưa hình thu nhỏ ra khỏi lề */
}

.thumbnail-images img {
  width: 80px; /* Kích thước hình thu nhỏ */
  height: auto;
  margin-right: 10px; /* Khoảng cách giữa các hình thu nhỏ */
  cursor: pointer;
}

.product-info {
  flex: 6;
  padding-left: 20px;
  display: flex;
  flex-direction: column;
  margin-right: 80px;
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

.insurance-section{
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
  align-items: flex-start; /* Đặt căn chỉnh từ trên xuống */
  margin-bottom: 15px;
}

.product-options label {
  width: 80px;
  margin-right: 10px;
  text-align: left;
  font-size: 14px;
  font-weight: bold;
}

.color-options {
  display: flex;
  flex-wrap: wrap; /* Cho phép các tùy chọn tự động xuống dòng */
  gap: 10px; /* Khoảng cách giữa các tùy chọn */
  max-width: 500px; /* Giới hạn độ rộng của container tùy chọn màu */
}

.size-options {
  display: flex;
  gap: 5px;
  flex-wrap: wrap;
}

.color-option, .size-option {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 3px 6px;
  border: 1px solid #ccc;
  background-color: #fff;
  cursor: pointer;
}

.color-option img {
  width: 30px;
  height: 30px;
  object-fit: cover;
  margin-bottom: 3px;
}

.color-option span {
  font-size: 12px;
}

.size-option {
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
.color-option:hover, .size-option:hover {
  background-color: #f0f0f0;
  border-color: #999;
}

.quantity-selector {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
}

.quantity-selector label {
  margin-right: 10px; /* Khoảng cách giữa nhãn số lượng và các nút */
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

.chat-message > span {
    font-weight: bold; 
}</style>
<section class="product-section">
  <div class="product-layout">
    <!-- Bên trái: Hình ảnh -->
    <div class="product-images">
      <div class="main-image">
        <img src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lwpfrmg96zmh76.webp" alt="Giày PUMA" class="img-responsive" id="main-product-image">
      </div>
      <div class="thumbnail-images">
        <img src="https://down-vn.img.susercontent.com/file/013645d5052bba873e41e1d4e6cec0bb@resize_w450_nl.webp" alt="Thumbnail 1">
        <img src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lomic8or785n19.webp" alt="Thumbnail 2">
        <img src="https://down-vn.img.susercontent.com/file/013645d5052bba873e41e1d4e6cec0bb@resize_w450_nl.webp" alt="Thumbnail 3">
        <img src="https://down-vn.img.susercontent.com/file/vn-11134207-7r98o-lomic8or785n19.webp" alt="Thumbnail 4">
        <img src="https://down-vn.img.susercontent.com/file/013645d5052bba873e41e1d4e6cec0bb@resize_w450_nl.webp" alt="Thumbnail 4">
      </div>
    </div>

    <!-- Bên phải: Thông tin sản phẩm -->
    <div class="product-info">
      <h1>Đồng Hồ Casio Nam Dây Nhựa GSHOCK GA-2100-1A1</h1>
      <div class="rating-sales">
        <span>4.8 ★ (43 Đánh Giá)</span>
        <span>126 Đã Bán</span>
      </div>
      <div class="price-container">
  <span class="original-price">₫1.000.000</span>
  <span class="discounted-price">₫600.000</span>
  <span class="discount-badge">40% GIẢM</span>
</div>
      <div class="discount-section">
        <span>Mã Giảm Giá Của Shop:</span>
        <span class="discount-tag">5% GIẢM</span>
      </div>
      <div class="insurance-section">
        <span>Bảo Hiểm:</span>
        <span>Bảo hiểm Bảo vệ người tiêu dùng <span class="new-tag">Mới</span></span>
        <a href="#" class="learn-more">Tìm hiểu thêm</a>
      </div>
      <div class="shipping-section">
        <span class="shipping-label">Vận Chuyển:</span>
        <span class="free-ship">Miễn phí vận chuyển</span>
        <div class="shipping-info">
          <span>Vận Chuyển Tới: Xã Khánh Lâm, Huyện U Minh</span>
          <span>Phí Vận Chuyển: 0₫</span>
        </div>
      </div>
      <div class="product-options">
  <div class="option">
    <label for="color">MÀU</label>
    <div class="color-options">
      <button class="color-option">
        <img src="https://upload.wikimedia.org/wikipedia/commons/b/b9/Solid_red.png" alt="">
        <span>ĐỎ</span>
      </button>
      <button class="color-option">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAMAAACahl6sAAAAA1BMVEX//wCKxvRFAAAAPUlEQVR4nO3BAQ0AAADCoPdPbQ8HFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA8GadCAABYe850QAAAABJRU5ErkJggg==" alt="">
        <span>VÀNG</span>
      </button>
      <button class="color-option">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAMAAACahl6sAAAAA1BMVEVmAJli86GoAAAAPUlEQVR4nO3BAQ0AAADCoPdPbQ8HFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA8GadCAABYe850QAAAABJRU5ErkJggg==" alt="">
        <span>TÍM</span>
      </button>
      <button class="color-option">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAMAAACahl6sAAAAA1BMVEVmAJli86GoAAAAPUlEQVR4nO3BAQ0AAADCoPdPbQ8HFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA8GadCAABYe850QAAAABJRU5ErkJggg==" alt="">
        <span>TÍM</span>
      </button>
      <button class="color-option">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAMAAACahl6sAAAAA1BMVEVmAJli86GoAAAAPUlEQVR4nO3BAQ0AAADCoPdPbQ8HFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA8GadCAABYe850QAAAABJRU5ErkJggg==" alt="">
        <span>TÍM</span>
      </button>
      <button class="color-option">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAMAAACahl6sAAAAA1BMVEVmAJli86GoAAAAPUlEQVR4nO3BAQ0AAADCoPdPbQ8HFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA8GadCAABYe850QAAAABJRU5ErkJggg==" alt="">
        <span>TÍM</span>
      </button>
      <button class="color-option">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAMAAACahl6sAAAAA1BMVEVmAJli86GoAAAAPUlEQVR4nO3BAQ0AAADCoPdPbQ8HFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA8GadCAABYe850QAAAABJRU5ErkJggg==" alt="">
        <span>TÍM</span>
      </button>
      <button class="color-option">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAMAAACahl6sAAAAA1BMVEVmAJli86GoAAAAPUlEQVR4nO3BAQ0AAADCoPdPbQ8HFAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA8GadCAABYe850QAAAABJRU5ErkJggg==" alt="">
        <span>TÍM</span>
      </button>
      
      
    </div>
  </div>

  <div class="option">
    <label for="size-uk">SIZE</label>
    <div class="size-options">
      <button class="size-option">S</button>
      <button class="size-option">M</button>
      <button class="size-option">L</button>
      <button class="size-option">XL</button>
      <button class="size-option">XL</button>
      <button class="size-option">XL</button>
      <button class="size-option">XL</button>
      <button class="size-option">XL</button>
      <button class="size-option">XL</button>
      <button class="size-option">XL</button>
      <button class="size-option">XL</button>
      

    </div>
  </div>
</div>

      <div class="quantity-selector">
        <label for="quantity">Số Lượng</label>
        <button class="decrease">-</button>
        <input type="number" id="quantity" value="1">
        <button class="increase">+</button>
        <span>1 sản phẩm có sẵn</span>
      </div>
      <div class="product-actions">
        <button class="add-to-cart">Thêm Vào Giỏ Hàng</button>
        <button class="buy-now">Mua Ngay</button>
      </div>
      <div class="guarantees">
        <span>Đổi ý miễn phí 15 ngày</span>
        <span>Hàng chính hãng 100%</span>
        <span>Miễn phí vận chuyển</span>
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
// anh
// Lấy danh sách các ảnh thumbnail
const thumbnails = document.querySelectorAll('.thumbnail-images img');
  
  // Lấy hình ảnh chính
  const mainImage = document.getElementById('main-product-image');
  
  // Lặp qua từng thumbnail và thêm sự kiện hover
  thumbnails.forEach(thumbnail => {
    thumbnail.addEventListener('mouseenter', function() {
      // Khi rê chuột vào thumbnail, thay đổi src của hình ảnh chính
      mainImage.src = this.src;
    });
  });



    </script>
    
 @endsection