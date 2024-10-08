@extends('layouts.sellers.app')

@section('content')
<style>
    /* General styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f7f7f7;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .main-container {
        display: flex;
        flex-grow: 1;
        margin: 20px auto;
        padding: 20px;
        background-color: #ffffff;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Thêm bóng đổ lớn hơn */
        border-radius: 12px; /* Bo góc mềm mại hơn */
        max-width: 1200px;
    }

    .form-content {
        flex-grow: 1;
        background-color: #f2f2f5;
        padding: 20px;
        border-radius: 12px;
    }

    .tab-menu {
        display: flex;
        border-bottom: 2px solid #ddd;
        margin-bottom: 20px;
        justify-content: space-around;
    }

    .tab-menu a {
        padding: 10px 20px;
        text-decoration: none;
        color: #333;
        font-weight: bold;
        transition: color 0.3s ease, border-bottom 0.3s ease;
        border-bottom: 3px solid transparent;
    }

    .tab-menu a.active {
        color: var(--primary-color);
        border-bottom: 3px solid var(--primary-color); /* Màu chủ đạo */
    }

    .tab-menu a:hover {
        color: var(--primary-color);
    }

    /* Form groups */
    .form-group {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    label {
        width: 180px;
        font-weight: 600;
        margin-right: 20px;
    }

    input[type="text"],
    textarea {
        width: 100%;
        max-width: 650px;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 15px;
        transition: border 0.3s ease, box-shadow 0.3s ease;
        box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    input[type="text"]:focus,
    textarea:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Hiệu ứng khi focus */
        outline: none;
    }

    /* Input counter */
    .input-counter {
        position: absolute;
        right: 10px;
        bottom: -20px;
        font-size: 12px;
        color: #999;
    }

    /* Logo and background container */
    .logo-container,
    .bg-container {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .logo-container img,
    .bg-container img {
        width: 110px;
        height: 110px;
        border-radius: 8px;
        background-color: #ddd;
        margin-right: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Thêm bóng đổ cho ảnh */
    }

    .logo-container button,
    .bg-container button {
        padding: 10px 20px;
        background-color: #0d6efd; 
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s ease, opacity 0.3s ease;
        margin-right: 15px;
    }

    .logo-container button:hover,
    .bg-container button:hover,
    .save-btn:hover {
        opacity: 0.85; /* Giảm opacity khi hover */
    }

    .logo-details {
        font-size: 13px;
        color: #777;
    }

    /* Buttons */
    .save-btn,
    .cancel-btn {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s ease, opacity 0.3s ease;
    }

    .save-btn {
        background-color: #0d6efd;
        color: white;
    }

    .cancel-btn {
        background-color: #ffffff;
        color: #333;
        margin-left: 10px;
        border: 1px solid #ccc;
    }

    .cancel-btn:hover {
        opacity: 0.85; /* Giảm opacity khi hover */
    }

    .button-group {
        display: flex;
        justify-content: flex-start;
        margin-left: 180px;
        margin-top: 30px;
    }

    .button-group button {
        margin-right: 15px;
    }

    .bg-container .bg-image {
        min-width: 650px;
        min-height: 250px;
        object-fit: cover;
        border-radius: 12px;
    }
</style>

<div class="main-container">
    <!-- Sidebar remains part of the layout -->
    <div class="form-content">
        <div class="tab-menu">
            <a href="#" class="active">Thông tin cơ bản</a>
        </div>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{route('seller.info.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="shop-name">Số căn cước công dân</label>
                <div>{{$seller->cccd}}</div>
                <div class="input-counter">17/30</div>
            </div>
            <div class="form-group">
                <label for="shop-name">Tên Shop</label>
                <input type="text" id="shop-name" name="store_name" value="{{$seller->store_name}}" maxlength="30">
                <input type="hidden" id="seller_id" name="seller_id" value="{{$seller->id}}" maxlength="30">
                <div class="input-counter">17/30</div>
            </div>

            <div class="form-group">
                <label for="shop-logo">Logo của hàng</label>
                <div class="logo-container">
                    <img id="shop-logo-preview" src="{{asset('uploads/'.$seller->logo)}}" alt="Shop Logo" style="width: 100px; height: 100px;">

                    <button type="button" id="edit-logo-btn">Sửa</button>
                    <input type="file" id="shop-logo-input" accept="image/*" style="display: none;" name="image">
                    <p class="logo-details">
                        • Kích thước hình ảnh tiêu chuẩn: Chiều rộng 300px, Chiều cao 300px<br>
                        • Dung lượng file tối đa: 2.0MB<br>
                        • Định dạng file hỗ trợ: JPG, JPEG, PNG, Webp
                    </p>
                </div>
            </div>
            <div class="form-group">
                <label for="shop-bg">Background cửa hàng</label>
                <div class="bg-container">
                    <img id="shop-bg-preview" class="bg-image" src="@if($seller->background == 'nulll' || !$seller->background)
                    {{asset('sellers/assets/images/no-bg.png')}}
                    @else
                    {{asset('uploads/'.$seller->background)}}
                    @endif
                    " alt="Shop Bg" style="width: 100px; height: 100px;">
                    <button type="button" id="edit-bg-btn" class="edit-bg-btn">Sửa</button>
                    <input type="file" id="shop-bg-input" accept="image/*" style="display: none;" name="background">
                </div>
            </div>

            <div class="form-group">
                <label for="shop-description">Mô tả Shop</label>
                <textarea id="shop-description" name="store_description" rows="4" maxlength="500"
                    placeholder="Nhập mô tả hoặc thông tin về Shop của bạn tại đây">{{$seller->store_description}}</textarea>
            </div>

            <div class="button-group">
                <button type="submit" class="save-btn">Lưu</button>
            </div>
        </form>
    </div>
</div>
<script>
    // Bắt sự kiện click vào nút "Sửa"
    document.getElementById('edit-logo-btn').addEventListener('click', function() {
        document.getElementById('shop-logo-input').click(); // Mở input file khi nhấn "Sửa"
    });

    // Bắt sự kiện khi người dùng chọn file ảnh
    document.getElementById('shop-logo-input').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Lấy file người dùng chọn
        if (file) {
            // Tạo URL cho ảnh vừa chọn để hiển thị preview
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('shop-logo-preview').src = e.target.result; // Cập nhật ảnh preview
            };
            reader.readAsDataURL(file); // Đọc file và chuyển sang định dạng URL
        }
    });

    document.getElementById('edit-bg-btn').addEventListener('click', function() {
        document.getElementById('shop-bg-input').click(); // Mở input file khi nhấn "Sửa"
    });

    // Bắt sự kiện khi người dùng chọn file ảnh
    document.getElementById('shop-bg-input').addEventListener('change', function(event) {
        const file = event.target.files[0]; // Lấy file người dùng chọn
        if (file) {
            // Tạo URL cho ảnh vừa chọn để hiển thị preview
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('shop-bg-preview').src = e.target.result; // Cập nhật ảnh preview
            };
            reader.readAsDataURL(file); // Đọc file và chuyển sang định dạng URL
        }
    });
</script>
@endsection
