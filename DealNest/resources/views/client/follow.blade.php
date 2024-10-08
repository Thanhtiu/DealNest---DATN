@extends('layouts/client.app')
@section('content')
<style>
    .follow-container {
        width: 100%;
        margin: 0 auto;
        background-color: white;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        padding: 20px;
    }

    h2 {
        margin-top: 3px;
        margin-bottom: 16px;
        font-size: 30px;
    }

    .store-list {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }

    .store-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.08);
        padding: 20px;
        text-align: center;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .store-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .store-img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
        border: 3px solid var(--primary-color);
    }

    .store-name {
        font-size: 20px;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 5px;
    }

    p {
        font-size: 14px;
        color: #777;
    }

    .unfollow-btn {
        padding: 10px 25px;
        background: var(--primary-color);
        color: #fff;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: background 0.3s, box-shadow 0.3s;
        font-size: 14px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .unfollow-btn:hover {
        opacity: 0.7;
        transition: .5s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .view-store-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 25px;
        background: #fff;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
        border-radius: 50px;
        cursor: pointer;
        text-transform: uppercase;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.3s, box-shadow 0.3s, color 0.3s;
    }

    .view-store-btn:hover {
        background: var(--primary-color);
        color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .store-details p {
        margin: 5px 0;
        /* Thêm chút khoảng cách giữa các đoạn văn */
    }

    .store-details p:last-child {
        font-weight: 600;
        /* Tô đậm lượt bán */
        color: #333;
        /* Màu chữ đậm hơn */
    }

    /* Màu chủ đạo */
    :root {
        --primary-color: #3498db;
    }
</style>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('layouts.client.sidebar')
            </div>
            <div class="col-md-9">
                <div class="container follow-container">
                    <h2>Danh sách cửa hàng theo dỗi</h2>
                    @if($listFollow->isEmpty())
                    <div class="text-center">
                        <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
                        <p class="text-center mt-3">Chưa có cửa hàng nào được theo dỗi</p>
                    </div>
                    @else
                    <div class="store-list">
                        @foreach($listFollow as $item)
                        <div class="store-card">
                            <img src="{{ asset('uploads/' . ($item->seller->logo === null ? 'logo-default-seller.png' : $item->seller->logo)) }}" alt="Shop Logo" class="store-img">
                            <div class="store-details">
                                <h2 class="store-name">{{$item->seller->store_name}}</h2>
                                <p>Số sản phẩm: {{$item->seller->products->count()}}</p>
                                <p>Lượt bán: {{ $item->seller->totalSales() }}</p>
                            </div>
                            <button class="unfollow-btn" data-seller-id="{{ $item->seller->id }}">Hủy Theo Dõi</button>
                            <a href="{{ route('client.shop', ['id' => $item->seller->id]) }}" class="view-store-btn">Xem Cửa Hàng</a>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    $('.unfollow-btn').on('click', function() {
        var sellerId = $(this).data('seller-id');
        var button = $(this);

        $.ajax({
            url: '/theo-doi/cua-hang',
            method: 'POST',
            data: {
                seller_id: sellerId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    if (response.status == 'added') {
                        toastr.success(response.message); // Hiển thị thông báo khi thành công
                        window.location.reload();
                    } else if (response.status == 'removed') {
                        toastr.success(response.message); // Hiển thị thông báo khi hủy theo dõi thành công
                        window.location.reload();
                    }
                } else {
                    toastr.error('Có lỗi xảy ra!');
                }
            },
            error: function(xhr) {
                toastr.error('Lỗi: ' + xhr.responseText);
            }
        });
    });
</script>



@endsection