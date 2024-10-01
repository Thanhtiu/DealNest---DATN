@extends('layouts/client.app')
@section('content')
<link rel="stylesheet" href="{{asset('client/css/product.css')}}" type="text/css">

<style>
    .custom-pagination .page-item {
  margin: 0 8px; /* Khoảng cách giữa các phần tử */
}

.custom-pagination .page-item.active .page-link {
  background-color: #0d6efd; /* Màu nền cam */
  border-color: #f05440;
  color: white;
}

.custom-pagination .page-link {
  color: #6c757d; /* Màu xám */
  border: none;  /* Loại bỏ viền */
  padding: 10px 15px; /* Tăng kích thước padding để khoảng cách lớn hơn */
}

.custom-pagination .page-item.disabled .page-link {
  color: #6c757d; /* Màu xám cho disabled */
}

.custom-pagination .page-item .page-link:hover {
  color: #f05440; /* Màu cam khi hover */
}


</style>

<section class="category-section">
    <h2>DANH MỤC</h2>
    <button class="scroll-button prev">&lt;</button>
    <div class="category-wrapper">
        <div class="category-slider">
            <div class="category-list">
                <!-- Danh sách mục trong slider -->
                @foreach($categories as $item)
                <div class="category-item">
                    <img src="https://down-vn.img.susercontent.com/file/ce8f8abc726cafff671d0e5311caa684@resize_w320_nl.webp"
                        alt="Category 1">
                    <span> {{$item->name}} </span>
                </div>
                @endforeach
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
                <img src="{{asset('uploads/'.$item->image)}}" alt="Product Image">
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
<!-- Phân trang -->
<nav aria-label="Page navigation">
  <ul class="pagination justify-content-center custom-pagination">
    <!-- Nút Previous -->
    <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
      <a class="page-link" href="{{ $products->previousPageUrl() }}" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>

    <!-- Số trang -->
    @for ($i = 1; $i <= $products->lastPage(); $i++)
      <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}">
        <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
      </li>
    @endfor

    <!-- Dấu ... nếu có nhiều trang -->
    @if ($products->lastPage() > 5)
      <li class="page-item disabled">
        <span class="page-link">...</span>
      </li>
    @endif

    <!-- Nút Next -->
    <li class="page-item {{ $products->hasMorePages() ? '' : 'disabled' }}">
      <a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>


<script src="{{asset('client/js/index.js')}}"></script>

@endsection





