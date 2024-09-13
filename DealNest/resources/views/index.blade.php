@extends('layouts/client.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .card {
    position: relative;
    display: flex;
    flex-direction: column;
    border-radius: 3px;
    height: 308px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.cardd {
    position: relative;
    display: flex;
    flex-direction: column;
    border-radius: 3px;
    height: 308px;
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.discount {
    position: absolute;
    top: 0px;
    right: 0px;
    background-color: #ee8f71;
    color: #fff;
    padding: 2px 5px;
    font-size: 11px;
    font-weight: bold;
    border-radius: 1px;
}

*, ::after, ::before {
    box-sizing: border-box;
}
.content {
    padding: 10px;
    text-align: left;
    flex: 1;
    position: relative;
}
.title {
    font-size: 14px;
    font-weight: bold;
    color: #333;
    margin: 0;
    text-align: left;
}
    .pricee {
    font-size: 16px;
    color: #FF5722;
    position: absolute;
    bottom: 10px;
    left: 10px; /* chỉnh lại giá nằm sát trái */
    
}
.rating {
        display: inline-block;
        margin-right: 8px;
        color: #FFD700;
        font-size: 9px;
        vertical-align: middle;
    }

    .rating i {
        margin-right: 1px;
    }

    .sold {
        display: flex;
        align-items: center;
        font-size: 8px;
        color: #777;
        position: absolute;
        bottom: 10px;
        left: 10px;
    }

</style>
<div class="container">
  
    <div class="row product-container">
        @foreach($products as $item)
        <div class="card">
            <a href="{{route('client.productDetail',['id'=>$item->id])}}">
            <div class="cardd">
            <img src="{{asset('uploads/'.$item->product_image->first()->url)}}" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">{{$item->name}}</h2>
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
</div>
@endsection 