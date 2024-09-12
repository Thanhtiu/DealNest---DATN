@extends('layouts/client.app')
@section('content')
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
.sold {
    position: absolute;
    bottom: 10px;
    right: 10px;
    font-size: 12px;
    color: #777;
    background-color: #fff;
}
</style>
<div class="container">
  
    <div class="row product-container">
        @foreach($products as $item)
        <div class="card">
            <a href="">
            <div class="cardd">
            <img src="{{asset('uploads/'.$item->product_image->first()->url)}}" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">{{$item->name}}</h2>
                <p class="pricee">{{ number_format($item->price, 0, ',', '.') }}<span style="font-size: 12px; text-decoration: underline;">đ</span></p>
            </div>
            <div class="sold">{{ number_format($item->sales >= 1000 ? $item->sales / 1000 : $item->sales, 1) . ($item->sales >= 1000 ? 'k' : '') }} lượt bán</div>
            </div>
            </a>
            
        </div>
        @endforeach
    </div>
</div>
@endsection 