@extends('layouts/client.app')
@section('content')
<link rel="stylesheet" href="{{ asset('client/css/product.css') }}" type="text/css">

<style>
    .custom-pagination .page-item {
        margin: 0 8px;
        /* Khoảng cách giữa các phần tử */
    }

    .custom-pagination .page-item.active .page-link {
        background-color: #0d6efd;
        /* Màu nền xanh */
        border-color: #f05440;
        color: white;
    }

    .custom-pagination .page-link {
        color: #6c757d;
        /* Màu xám */
        border: none;
        /* Loại bỏ viền */
        padding: 10px 15px;
        /* Tăng kích thước padding để khoảng cách lớn hơn */
    }

    .custom-pagination .page-item.disabled .page-link {
        color: #6c757d;
        /* Màu xám cho disabled */
    }

    .custom-pagination .page-item .page-link:hover {
        color: #f05440;
        /* Màu cam khi hover */
    }

    .banner-section {
        position: relative;
        width: 100%;
        max-width: 1200px;
        margin: 30px auto 20px;
        /* Thêm margin-top để đẩy xuống */
        overflow: hidden;
    }

    .banner-wrapper {
        width: 100%;
        overflow: hidden;
    }

    .slider-container {
        padding: 20px;
        /* Khoảng cách xung quanh slider */
        background-color: #f8f9fa;
        /* Màu nền cho khu vực slider */
        border-radius: 15px;
        /* Bo góc cho slider */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        /* Đổ bóng cho slider */
    }

    .banner-slider {
        display: flex;
        gap: 20px;
        /* Khoảng cách giữa các banner */
        transition: transform 0.5s ease-in-out;
    }

    .banner-item {
        min-width: calc(50% - 10px);
        /* Đảm bảo banner chiếm 50% chiều rộng và trừ đi khoảng cách */
        transition: transform 0.5s ease;
    }

    .banner-item img {
        width: 590px;
        height: 311px;
        object-fit: cover;
        /* Đảm bảo hình ảnh lấp đầy không gian, có thể cắt bớt */
        display: block;
        border-radius: 15px;
    }

    .banner-scroll-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
        z-index: 2;
    }

    .banner-scroll-button.prev {
        left: 10px;
    }

    .banner-scroll-button.next {
        right: 10px;
    }

    .slider-indicator {
        text-align: center;
        margin-top: 10px;
        font-size: 16px;
        color: #333;
    }

    .slider-icon {
        font-size: 24px;
        /* Kích thước của biểu tượng */
        margin: 0 5px;
        /* Khoảng cách giữa các biểu tượng */
        color: #6c757d;
        /* Màu sắc mặc định cho các biểu tượng */
    }

    .slider-icon:hover {
        color: #f05440;
        /* Màu khi hover */
    }

    .slider-icon.active {
        color: #0d6efd;
        /* Màu cho biểu tượng đang hoạt động */
    }

    a {
        text-decoration: none;
        /* Bỏ gạch chân */
        color: inherit;
        /* Dùng màu sắc của phần tử cha, hoặc tùy chọn màu sắc khác nếu muốn */
    }

    a:hover {
        text-decoration: none;
        /* Bỏ gạch chân khi hover */
        color: inherit;
        /* Dùng màu sắc của phần tử cha hoặc màu cố định khi hover */
    }
</style>

<section class="banner-section">
    <button class="banner-scroll-button prev">&lt;</button>
    <div class="banner-wrapper">
        <div class="slider-container"> <!-- Thêm thẻ div bao quanh slider -->
            <div class="banner-slider">
                <div class="banner-item">
                    <img src="{{asset('https://i.ytimg.com/vi/4CCGI83vOVo/maxresdefault.jpg')}}" alt="Banner 2">
                </div>
                <div class="banner-item">
                    <img src="{{asset('https://i.ytimg.com/vi/4CCGI83vOVo/maxresdefault.jpg')}}" alt="Banner 3">
                </div>
                <div class="banner-item">
                    <img src="{{asset('https://i.ytimg.com/vi/4CCGI83vOVo/maxresdefault.jpg')}}" alt="Banner 4">
                </div>
                <div class="banner-item">
                    <img src="{{asset('https://i.ytimg.com/vi/4CCGI83vOVo/maxresdefault.jpg')}}" alt="Banner 5">
                </div>
                <div class="banner-item">
                    <img src="{{asset('https://i.ytimg.com/vi/4CCGI83vOVo/maxresdefault.jpg')}}" alt="Banner 6">
                </div>
                <div class="banner-item">
                    <img src="{{asset('https://i.ytimg.com/vi/4CCGI83vOVo/maxresdefault.jpg')}}" alt="Banner 7">
                </div>
                <!-- Thêm nhiều banner nếu cần -->
            </div>
        </div>
    </div>
    <button class="banner-scroll-button next">&gt;</button>
    <div class="slider-indicator">
        <span id="slider-icons"></span> <!-- Cập nhật ở đây -->
    </div>
</section>

<section class="category-section">
    <h2>DANH MỤC</h2>
    <button class="scroll-button prev">&lt;</button>
    <div class="category-wrapper">
        <div class="category-slider">
            <div class="category-list">
                @foreach($categories as $item)
                <div class="category-item">
                    <a href="/the-loai/{{ $item->slug }}">
                        <img src="https://down-vn.img.susercontent.com/file/ce8f8abc726cafff671d0e5311caa684@resize_w320_nl.webp" alt="{{ $item->name }}"> </a>

                    <span><a href="/the-loai/{{ $item->slug }}">
                            {{$item->name}} </a></span>

                </div>
                @endforeach
            </div>
        </div>
    </div>
    <button class="scroll-button next">&gt;</button>
</section>

<div class="product-container">
    @foreach($products as $item)
    <div class="card">
        <a href="{{ route('client.productDetail', ['id' => $item->id]) }}">
            <div class="cardd">
                <img src="{{ asset('uploads/' . $item->image) }}" alt="Product Image">
                <div class="discount">-92%</div>
                <div class="content">
                    <h2 class="title">{{ $item->name }}</h2>
                    <p class="pricee">{{ number_format($item->price, 0, ',', '.') }}<span style="font-size: 12px; text-decoration: underline;">đ</span></p>
                </div>
                <div class="sold"><span class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </span>{{ number_format($item->sales >= 1000 ? $item->sales / 1000 : $item->sales, 1) . ($item->sales >= 1000 ? 'k' : '') }} lượt bán</div>
            </div>
        </a>
    </div>
    @endforeach
</div>

<!-- Phân trang -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center custom-pagination">
        <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        @for ($i = 1; $i <= $products->lastPage(); $i++)
            <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
                <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
            </li>
            @endfor

            @if ($products->lastPage() > 5)
            <li class="page-item disabled">
                <span class="page-link">...</span>
            </li>
            @endif

            <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
    </ul>
</nav>

<script>
    const bannerSlider = document.querySelector('.banner-slider');
    const bannerItems = document.querySelectorAll('.banner-item');
    const prevBannerButton = document.querySelector('.banner-scroll-button.prev');
    const nextBannerButton = document.querySelector('.banner-scroll-button.next');
    let currentBannerIndex = 0;
    const bannersPerView = 2; // Hiển thị 2 banner mỗi lần
    const totalSlides = Math.ceil(bannerItems.length / bannersPerView); // Tổng số slider

    function updateSliderIndicator() {
        const sliderIcons = document.getElementById('slider-icons');
        sliderIcons.innerHTML = ''; // Xóa nội dung trước đó

        // Tạo các icon cho mỗi trang
        for (let i = 0; i < totalSlides; i++) {
            const icon = document.createElement('span');
            icon.className = 'slider-icon'; // Class cho các icon
            icon.innerHTML = currentBannerIndex === i ? '●' : '○'; // Dấu chấm đen cho trang hiện tại, chấm trắng cho các trang khác
            sliderIcons.appendChild(icon);
        }
    }

    function updateBannerSlide() {
        const bannerWidth = bannerItems[0].clientWidth + 20; // Tính toán kích thước mỗi banner + khoảng cách giữa chúng
        const offset = -currentBannerIndex * bannerWidth * bannersPerView; // Điều chỉnh offset theo số banner và kích thước mỗi banner
        bannerSlider.style.transform = `translateX(${offset}px)`;
        updateSliderIndicator(); // Cập nhật chỉ số sau mỗi lần di chuyển
    }

    nextBannerButton.addEventListener('click', () => {
        if (currentBannerIndex < totalSlides - 1) {
            currentBannerIndex++;
        } else {
            currentBannerIndex = 0; // Quay lại trang đầu tiên nếu đang ở cuối
        }
        updateBannerSlide();
    });

    prevBannerButton.addEventListener('click', () => {
        if (currentBannerIndex > 0) {
            currentBannerIndex--;
        } else {
            currentBannerIndex = totalSlides - 1; // Quay lại trang cuối nếu đang ở đầu
        }
        updateBannerSlide();
    });

    // Tự động chuyển banner sau mỗi 5 giây
    setInterval(() => {
        nextBannerButton.click();
    }, 5000);

    // Cập nhật chỉ số ban đầu
    updateSliderIndicator();
</script>

@endsection