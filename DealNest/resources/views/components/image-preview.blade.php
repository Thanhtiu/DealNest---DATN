{{-- components/image-preview.blade.php --}}
<div>
    @if(isset($image))
    {{-- Hiển thị ảnh chính --}}
    <div class="image-item-container">
        <img src="{{ $image }}" alt="Hình ảnh chính" class="image-item">
        <span class="image-label">Ảnh chính</span> {{-- Thêm dòng text cho ảnh chính --}}
    </div>
    @endif

    @if(isset($images) && count($images) > 0)
    {{-- Hiển thị tất cả ảnh phụ --}}
    <div class="image-gallery">
        @foreach($images as $image)
        <div class="image-item-container">
            <img src="{{ $image }}" alt="Ảnh phụ" class="image-item">
            <span class="image-label">Ảnh phụ</span> {{-- Thêm dòng text cho ảnh phụ --}}
        </div>
        @endforeach
    </div>
    @endif
</div>

{{-- Thêm CSS vào trong file Blade --}}
<style>
    /* Đảm bảo các ảnh phụ nằm trong một hàng ngang */
    .image-gallery {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        /* Khoảng cách giữa các ảnh */
    }

    /* Các ảnh phụ có kích thước nhỏ hơn và căn chỉnh theo hàng ngang */
    .image-item {
        max-width: 120px;
        /* Điều chỉnh kích thước của ảnh phụ */
        height: auto;
        /* Giữ tỉ lệ của ảnh */
        object-fit: cover;
        /* Cắt bớt nếu ảnh lớn hơn khung */
    }

    /* Style cho chứa ảnh và label */
    .image-item-container {
        position: relative;
    }

    /* Style cho text bên dưới ảnh */
    .image-label {
        position: absolute;
        bottom: 5px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 2px 5px;
        font-size: 12px;
        border-radius: 3px;
    }
</style>