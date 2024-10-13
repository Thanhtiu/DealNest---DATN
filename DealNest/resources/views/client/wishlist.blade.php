@extends('layouts.client.app')
@section('content')
<style>
    /* General Container */
    .wishlist-container {
        background-color: #f9f9f9;
        border: 1px solid #e1e1e1;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }

    /* Wishlist Header */
    .wishlist-header {
        font-size: 22px;
        font-weight: bold;
        color: #555;
        margin-bottom: 20px;
        text-align: center;
        border-bottom: 1px solid #e1e1e1;
        padding-bottom: 15px;
        background-color: #fff;
        border-radius: 10px 10px 0 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    /* Wishlist Item */
    .wishlist-item {
        display: flex;
        align-items: center;
        padding: 15px;
        background-color: #fff;
        margin-bottom: 15px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: background-color 0.3s ease;
    }

    .wishlist-item:hover {
        background-color: #f0f0f0;
    }

    /* Image Styling */
    .wishlist-item-image img {
        width: 90px;
        height: 90px;
        object-fit: cover;
        border-radius: 8px;
        margin-right: 20px;
    }

    /* Item Details */
    .wishlist-item-details {
        flex-grow: 1;
        font-size: 14px;
        color: #666;
    }

    .wishlist-item-details h5 {
        font-size: 16px;
        font-weight: 600;
        margin: 0 0 8px;
        color: #333;
    }

    .wishlist-item-price {
        font-size: 16px;
        color: #f53d2d;
        font-weight: bold;
    }

    /* Actions */
    .wishlist-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-left: 20px;
    }

    .wishlist-actions a {
        text-decoration: none;
        padding: 6px 12px;
        font-size: 12px;
        border-radius: 6px;
        margin-left: 10px;
        color: #fff;
        transition: background-color 0.3s ease;
    }

    .wishlist-actions a.btn-danger {
        background-color: #dc3545;
    }

    .wishlist-actions a.btn-danger:hover {
        background-color: #c82333;
    }

    .wishlist-actions a.btn-primary {
        background-color: #007bff;
    }

    .wishlist-actions a.btn-primary:hover {
        background-color: #0056b3;
    }

    /* No Data Section */
    .wishlist-data-image {
        margin-top: 15%;
        width: 150px;
    }

    .wishlist-empty {
        text-align: center;
        margin-top: 30px;
        font-size: 16px;
        color: #999;
    }

</style>

<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('layouts.client.sidebar')
            </div>

            <div class="col-md-9">
                @if($WishLists->isEmpty())
                <div class="wishlist-empty">
                    <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data">
                    <p class="text-center mt-3">Chưa có sản phẩm nào được yêu thích</p>
                </div>
                @else
                <div class="wishlist-container">
                    <div class="wishlist-header">Danh sách sản phẩm yêu thích</div>
                    @foreach($WishLists as $item)
                    <div class="wishlist-item">
                        <div class="wishlist-item-image">
                            <img src="{{ asset('uploads/' . $item->product->image) }}" alt="Product Image">
                        </div>
                        <div class="wishlist-item-details">
                            <h5>{{ $item->product->name }}</h5>
                            <p>Danh mục: {{ $item->product->category->name }}</p>
                            <p>Thể loại: {{ $item->product->subCategory->name }}</p>
                            <p><i class="bi bi-heart-fill text-danger"></i> {{ $item->product->favourite }} lượt yêu thích</p>
                        </div>
                        <div class="wishlist-item-price">
                            {{ number_format($item->product->price, 0, ',', '.') }} vnđ
                        </div>
                        <div class="wishlist-actions">
                            <a href="{{ route('client.wishList.destroy', ['id' => $item->id]) }}" class="btn btn-danger">
                                <i class="bi bi-trash2-fill"></i> Xóa
                            </a>
                            <a href="#" class="btn btn-primary">
                                <i class="bi bi-bag-fill"></i> Mua
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
