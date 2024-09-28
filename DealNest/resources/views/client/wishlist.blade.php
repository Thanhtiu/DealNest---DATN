@extends('layouts.client.app')
@section('content')
<style>
    /* Wishlist Section */
    .wishlist-container {
        background-color: #fff;
        border: 1px solid #e1e1e1;
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 4px;
    }

    .wishlist-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #e1e1e1;
        padding-bottom: 10px;
        margin-bottom: 10px;
    }

    .wishlist-header-left {
        font-weight: bold;
        color: #f53d2d;
    }

    .wishlist-header-right {
        color: #9e9e9e;
    }

    /* Separator between wishlist items */
    .wishlist-item-separator {
        border-bottom: 1px solid #e1e1e1;
        margin: 20px 0;
    }

    .wishlist-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .wishlist-item-info {
        display: flex;
        align-items: center;
    }

    .wishlist-item-image {
        width: 81px;
        height: 81px;
        margin-right: 15px;
    }

    .wishlist-item-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .wishlist-item-details {
        color: #333;
    }

    .wishlist-item-price {
        color: #f53d2d;
        font-weight: bold;
        text-align: right;
    }

    .wishlist-item-price p {
        color: red;
        font-size: 20px;
        font-weight: 700;

    }

    /* Updated Wishlist Actions */
    .wishlist-actions {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-top: 10px;
    }

    .wishlist-item-content {
        display: flex;
        justify-content: space-between;
        flex: 1;
    }



    .wishlist-actions button:hover {
        opacity: 0.7;
        transition: all 0.5s;
    }

    /* Add button style */
    .wishlist-item-content {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .wishlist-item-top {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .wishlist-item-details {
        flex-grow: 1;
        padding-right: 10px;
    }

    /* Separator between wishlist items */
    .wishlist-item-separator {
        border-bottom: 1px solid #e1e1e1;
        margin: 20px 0;
    }

    .favourite-title {
        margin-bottom: 35px;
    }

    .wishlist-delete {
        display: inline;
        margin-right: 10px;
    }

    .wishlist-data-image {
        margin-top: 15%;
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
                <div class="text-center">
                    <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
                    <p class="text-center mt-3">Chưa có sản phẩm nào được yêu thích</p>
                </div>
                @else
                <div class="wishlist-container">
                    <h4 class="favourite-title">Danh sách sản phẩm yêu thích</h4>
                    @foreach($WishLists as $item)
                    <div class="wishlist-item">
                        <div class="wishlist-item-image">
                            <img src="{{ asset('uploads/' . $item->product->image) }}" alt="Product Image" style="width: 150px; height: 100px; object-fit: cover;">
                        </div>
                        <div class="wishlist-item-content">
                            <div class="wishlist-item-top">
                                <div class="wishlist-item-details">
                                    <p><strong>{{ $item->product->name }}</strong></p>
                                    <p>Danh mục: {{ $item->product->category->name }}</p>
                                    <p>Thể loại: {{ $item->product->subCategory->name }}</p>
                                    <p>Đạt: {{ $item->product->favourite }} lượt yêu thích <i class="bi bi-heart-fill text-danger"></i></p>
                                    @if($item->product->sales > 0)
                                    <p>Đã bán: {{ $item->product->sales }}</p>
                                    @endif
                                </div>
                                <div class="wishlist-item-price">
                                    <p>{{ number_format($item->product->price, 0, ',', '.') }} vnđ</p>
                                </div>
                            </div>
                            <div class="wishlist-actions">
                                <a href="{{ route('client.wishList.destroy', ['id' => $item->id]) }}" class="btn btn-danger wishlist-delete">
                                    <i class="bi bi-trash2-fill"></i> Xóa sản phẩm
                                </a>
                                <a href="#" class="btn btn-primary">
                                    <i class="bi bi-bag-fill"></i> Mua sản phẩm
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- khoảng cách sản phẩm -->
                    <div class="wishlist-item-separator" style="border-bottom: 1px solid #ddd; margin: 20px 0;"></div>
                    @endforeach
                </div>
                @endif
            </div>

        </div>
</section>
@endsection