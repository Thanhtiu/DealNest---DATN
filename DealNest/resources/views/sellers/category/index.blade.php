@extends('layouts.sellers.app')
@section('content')
<style>
    .tabs {
        display: flex;
        border-bottom: 2px solid #f0f0f0;
        margin-bottom: 20px;
    }

    .tab-item {
        padding: 10px 20px;
        cursor: pointer;
        color: #333;
        text-decoration: none;
        /* Loại bỏ gạch chân */
    }

    /* Khi tab được active */
    .tab-item.active {
        color: #0d6efd;
        border-bottom: 2px solid #0d6efd;
    }

    /* Loại bỏ gạch chân khi hover và focus */
    .tab-item:hover,
    .tab-item:focus {
       
        /* Màu cam khi hover */
        text-decoration: none;
        /* Loại bỏ gạch chân */
    }

    .btn-container {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        justify-content: flex-end;
    }

    .btn-container a {
        padding: 10px;
        border: none;
        cursor: pointer;
        background-color: #0d6efd;
        color: white;
        border-radius: 4px;
        font-weight: bold;
        text-decoration: none;
        /* Loại bỏ gạch chân */
    }

    .btn-container a:hover,
    .btn-container a:focus {
        text-decoration: none;
        /* Loại bỏ gạch chân khi hover */
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .card-body {
        position: relative;
    }
</style>

<div class="tabs" role="tablist">
    <a href="#" class="tab-item active" data-tab="all">Danh mục ({{$countProductAll}})</a>
    <a href="#" class="tab-item" data-tab="active">Thể loại ({{$countProductSuccess}})</a>
    
</div>
{{-- Hiển thị thông báo thành công --}}
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="tab-content active" id="tab-all">
    @if($countProductAll <= 0)
        <div class="text-center">
        <img class="no-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
        <p class="text-center mt-3">Chưa có sản phẩm nào</p>
</div>
@else

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tổng sản phẩm</h4>
                <table id="productTableAll" class="table table-striped">
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
                        @foreach($productAll as $item)
                        <tr>

                            <td>{{ \Illuminate\Support\Str::limit($item->name, 20, '...') }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->subcategory->name, 20, '...') }}</td>
                            <td>

                                <img src="{{asset('uploads/'.$item->image)}}" alt=""
                                    style="width: 80px; height: 80px; border-radius: 5px; object-fit: cover">

                            </td>
                            <td data-order="{{$item->price}}">{{ number_format($item->price, 0, ',', '.') }}vnđ</td>
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
                                <a href="{{ route('seller.product.edit', ['id' => $item->id]) }}"
                                    class="btn btn-outline-secondary btn-icon-text">
                                    <i class="bi bi-pen"></i> Sửa
                                </a>
                                <a href="{{route('seller.product.softDelete',['id'=>$item->id])}}"
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
</div>
<div class="tab-content" id="tab-active">
    @if($countProductSuccess <= 0)
        <div class="text-center">
        <img class="no-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
        <p class="text-center mt-3">Chưa có sản phẩm nào hoạt động</p>
</div>
@else
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tổng sản phẩm</h4>
                <table class="table" id="productTableActive">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Thể loại</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>Tồn kho</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productSuccess as $item)
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
                                <a href="" class="btn btn-outline-secondary btn-icon-text"><i
                                        class="bi bi-pen"></i>
                                    Sửa</a>
                                <a href="" class="btn btn-outline-danger btn-icon-text"><i
                                        class="bi bi-trash"></i>
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
</div>


@endsection