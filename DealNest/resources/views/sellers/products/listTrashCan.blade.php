@extends('layouts.sellers.app')
@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if($products->count() <= 0) <img src="{{asset('sellers/assets/images/no-product-found.png')}}">
    @else
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tổng sản phẩm</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Thể loại</th>
                                <th>Hình ảnh</th>
                                <th>Giá</th>
                                <th>Tồn kho</th>
                                <th>Trang thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $item)
                            <tr>
                                <td>{{ \Illuminate\Support\Str::limit($item->name, 25, '...') }}</td>

                                <td>{{ \Illuminate\Support\Str::limit($item->subcategory->name, 20, '...') }}</td>
                                <td>
                                    @if($item->product_image->isNotEmpty())
                                    <img src="{{asset('uploads/'.$item->image)}}" alt=""
                                        style="width: 80px; height: 80px; border-radius: 5px; object-fit: cover">
                                    @endif
                                </td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>
                                    @if($item->status == 'Chờ phê duyệt')
                                    <label class="badge badge-warning">Chờ phê duyệt</label>
                                    @elseif($item->status == 'Đã phê duyệt')
                                    <label class="badge badge-success">Đang hoạt động</label>
                                    @else
                                    <label class="badge badge-danger">Không hoạt động</label>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('seller.product.restore', ['id' => $item->id]) }}"
                                        class="btn btn-outline-secondary btn-icon-text">
                                        <i class="bi bi-arrow-clockwise"></i> Khôi phục
                                    </a>
                                    <a href="{{route('seller.product.delete',['id'=>$item->id])}}"
                                        class="btn btn-outline-danger btn-icon-text"><i class="bi bi-trash"></i>
                                        Xóa</a>
                                </td>
                            </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endsection