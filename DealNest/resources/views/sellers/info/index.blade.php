@extends('layouts.sellers.app')

@section('content')
<style>
    /* Adjust main-container to remove margin and make it fit the available space */
    .main-container {
        display: flex;
        flex-grow: 1;
        margin: 0;
        /* Remove margins */
        padding: 0;
        /* Remove padding */
    }

    /* Adjust form-content to take full width next to the sidebar */
    .form-content {
        flex-grow: 1;
        margin: 0;
        background-color: #f2edf3;
    }

    .tab-menu {
        display: flex;
        border-bottom: 2px solid #ddd;
        margin-bottom: 20px;
    }

    .tab-menu a {
        padding: 10px 20px;
        text-decoration: none;
        color: #333;
        border-bottom: 3px solid transparent;
        transition: all 0.3s ease;
    }

    .tab-menu a.active {
        color: #ff4b4b;
        border-bottom: 3px solid #ff4b4b;
    }

    .form-group {
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        /* Vertically center the label and input */
        justify-content: flex-start;
    }

    label {
        width: 150px;
        /* Set width for the labels */
        font-weight: 500;
        margin-right: 20px;
        /* Space between label and input */
    }

    input[type="text"],
    textarea {
        width: 100%;
        max-width: 600px;
        /* Set a max-width for inputs */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
    }

    .input-counter {
        position: absolute;
        right: 10px;
        bottom: -20px;
        font-size: 12px;
        color: #999;
    }

    .logo-container {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .logo-container img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background-color: #ddd;
        margin-right: 20px;
        /* Space between logo and details */
    }

    .logo-container button {
        margin-left: 20px;
        padding: 8px 16px;
        background-color: #ddd;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .logo-container button:hover {
        background-color: #ccc;
    }

    .logo-details {
        font-size: 12px;
        color: #999;
        margin-left: 15px;
    }

    .save-btn,
    .cancel-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
    }

    .save-btn {
        background-color: #ff4b4b;
        color: white;
    }

    .cancel-btn {
        background-color: #ffffff;
        color: #333;
        margin-left: 10px;
    }

    .button-group {
        display: flex;
        justify-content: flex-start;
        /* Align buttons to the left */
        margin-left: 170px;
        /* Align buttons with the inputs (same as label width) */
        margin-top: 20px;
        /* Add some space above the buttons */
    }

    .button-group button {
        margin-right: 10px;
        /* Add space between the buttons */
    }

    .bg-container button {
        margin-left: 20px;
        padding: 8px 16px;
        background-color: #ddd;
        border: none;
        border-radius: 5px;
    }

    .bg-container .bg-image {
        min-width: 600px;
        min-height: 200px;
        object-fit: cover;

    }
</style>

<div class="main-container">
    <!-- Sidebar remains part of the layout -->
    <div class="form-content">
        <div class="tab-menu">
            <a href="#" class="active">Thông tin cơ bản</a>
            <a href="#">Thông tin Thuế</a>
            <a href="#">Thông tin Định Danh</a>
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
                <div class="input-counter">0/500</div>
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