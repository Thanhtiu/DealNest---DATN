@extends('layouts.sellers.app')
@section('content')
<style>
    .review-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }

    .review-card {
        width: 48%;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .review-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .review-card .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 15px;
    }

    .review-card .header .buyer-info {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1em;
        color: #555;
    }

    .review-card .header .buyer-info img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #ddd;
    }

    .review-card .header .rating {
        display: flex;
        gap: 3px;
        color: #ffc107;
        font-size: 1.3em;
    }

    .review-card .content {
        font-size: 0.95em;
        color: #444;
        margin-bottom: 15px;
        line-height: 1.4;
    }

    .review-card .images {
        display: flex;
        gap: 10px;
    }

    .review-card .images img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 5px;
        border: 1px solid #ddd;
        transition: transform 0.3s;
    }

    .review-card .images img:hover {
        transform: scale(1.1);
    }

    .review-card .delete-btn {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background-color: #e74c3c;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 7px 12px;
        cursor: pointer;
        font-size: 0.85em;
        transition: background-color 0.3s ease;
    }

    .review-card .delete-btn:hover {
        background-color: #c0392b;
    }

    .rating-star {
        color: #ffc107;
    }

    .rating-star-gray {
        color: #ddd;
    }

    .rating-summary {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .rating-average {
        text-align: center;
    }

    .rating-average h2 {
        font-size: 3em;
        color: #ffc107;
        margin: 0;
    }

    .rating-average span {
        color: #555;
        font-size: 1.2em;
    }

    .rating-distribution {
        width: 70%;
    }

    .rating-bar {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .rating-bar span {
        font-size: 1em;
        color: #555;
        margin-right: 10px;
    }

    .progress {
        width: 100%;
        background-color: #ddd;
        border-radius: 5px;
        height: 10px;
        overflow: hidden;
    }

    .progress-bar {
        background-color: #ffc107;
        height: 100%;
    }
</style>

@if($reviews->isEmpty())
<div class="text-center no-data">
    <img class="data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
    <p class="text-center mt-3">Sản phẩm chưa có đánh giá nào !</p>
</div>
@else
<div class="container">
    <h2>Đánh giá sản phẩm</h2>
    <div class="rating-summary">
        <div class="rating-average">
            <h2>{{ number_format($averageRating, 1) }}</h2>
            <span>trên 5</span>
        </div>
        <div class="rating-distribution">
            @for ($i = 5; $i >= 1; $i--)
            @php
            $percentage = $reviewCounts ? ($stars[$i] / $reviewCounts) * 100 : 0;
            @endphp
            <div class="rating-bar">
                <span>{{ $i }} sao</span>
                <div class="progress">
                    <div class="progress-bar" style="width: {{ $percentage }}%;"></div>
                </div>
                <span class="count">{{ $stars[$i] }} đánh giá</span>
            </div>
            @endfor
        </div>
    </div>

    <div class="review-container">
        @foreach($reviews as $item)
        <div class="review-card">
            <div class="header">
                <div class="buyer-info">
                    <img src="{{ asset('uploads/' . ($item->user->image != 'user_default.jpg' ? $item->user->image : 'default/user_default.jpg')) }}" alt="User Image">
                    <span>{{ $item->user->name }}</span>

                </div>
                <div class="rating">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <=$item->rating)
                        <span class="rating-star">★</span>
                        @else
                        <span class="rating-star-gray">★</span>
                        @endif
                        @endfor
                </div>
            </div>
            <p>{{$item->classify}}</p>
            <div class="content">{{ $item->description }}</div>
            <div class="images">
                @foreach($item->images as $image)
                <img src="{{ asset('uploads/reviews/' . $image->image) }}" alt="Product Image">
                @endforeach
            </div>
            <button class="delete-btn" data-id="{{$item->id}}">Xóa</button>
        </div>
        @endforeach
    </div>
</div>
@endif
<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const reviewId = this.getAttribute('data-id');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            Swal.fire({
                title: 'Bạn chắc chắn muốn xóa đánh giá này?',
                text: "Hành động này không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("POST", '/kenh-nguoi-ban/xoa/danh-gia/' + reviewId, true);
                    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);

                    xhr.onload = function() {
                        if (xhr.status == 200) {
                            Swal.fire(
                                'Đã xóa!',
                                'Đánh giá đã được xóa.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire(
                                'Lỗi!',
                                'Đã xảy ra lỗi khi xóa đánh giá.',
                                'error'
                            );
                        }
                    };

                    xhr.send(JSON.stringify({
                        id: reviewId
                    }));
                } else {
                    Swal.close();
                }
            });
        });
    });
</script>




@endsection