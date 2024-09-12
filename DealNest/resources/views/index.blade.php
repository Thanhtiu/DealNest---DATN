@extends('layouts/client.app')
@section('content')

<div class="container">
  
    <div class="row product-container">
        @foreach($products as $item)
        <a class="card d-block" href="{{route('client.productDetail',['id'=>$item->id])}}">
            <img src="{{asset('uploads/'.$item->product_image->first()->url)}}" alt="Product Image">
            <div class="discount">-92%</div>
            <div class="content">
                <h2 class="title">{{$item->name}}</h2>
                <p class="price">{{ number_format($item->price, 0, ',', '.') }} đ</p>
            </div>
            <div class="sold">{{ number_format($item->sales >= 1000 ? $item->sales / 1000 : $item->sales, 1) . ($item->sales >= 1000 ? 'k' : '') }} lượt bán</div>
        </a>
        @endforeach
    </div>
</div>
@endsection