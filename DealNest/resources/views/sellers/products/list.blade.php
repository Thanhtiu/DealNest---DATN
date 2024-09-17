@extends('layouts.sellers.app')
@section('content')
<style>
    body {
        font-family: Arial, sans-serif;
    }

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
    }

    .tab-item.active {
        color: #ff5722;
        border-bottom: 2px solid #ff5722;
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
        background-color: #ff5722;
        color: white;
        border-radius: 4px;
        font-weight: bold;
        text-decoration: none;
    }

    .btn-container button.dropdown {
        background-color: #f0f0f0;
        color: #333;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }
</style>

<div class="btn-container">

    <a href="{{route('seller.product.store')}}">+ Thêm 1 sản phẩm mới</button>
</div>

<div class="tabs" role="tablist">
    <a href="#" class="tab-item active" data-tab="all">Tất cả ({{$countProductAll}})</a>
    <a href="#" class="tab-item" data-tab="active">Đang hoạt động ({{$countProductSuccess}})</a>
    <a href="#" class="tab-item" data-tab="violations">Vi phạm ({{$countProductFail}})</a>
    <a href="#" class="tab-item" data-tab="pending">Chờ duyệt bởi Shopee ({{$countProductPending}})</a>
</div>

<div class="tab-content active" id="tab-all">
    @if($countProductAll <= 0)
    <img src="{{asset('sellers/assets/images/no-product-found.png')}}">
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
                            @foreach($productAll as $item)
                            <tr>
                                <td>{{ \Illuminate\Support\Str::limit($item->name, 25, '...') }}</td>

                                <td>{{ \Illuminate\Support\Str::limit($item->subcategory->name, 20, '...') }}</td>
                                <td>
                                    @if($item->product_image->isNotEmpty())
                                    <img src="{{asset('uploads/'.$item->product_image->first()->url)}}" alt=""
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
                                    <a href="{{ route('seller.product.edit', ['id' => $item->id]) }}" class="btn btn-outline-secondary btn-icon-text">
                                        <i class="bi bi-pen"></i> Sửa
                                    </a>                                    
                                    <a href="{{route('seller.product.delete',['id'=>$item->id])}}" class="btn btn-outline-danger btn-icon-text"><i class="bi bi-trash"></i>
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
        <img src="{{asset('sellers/assets/images/no-product-found.png')}}">
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
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productSuccess as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->subCategory->name}}</td>
                                <td>
                                    @if($item->product_image->isNotEmpty())
                                    <img src="{{asset('uploads/'.$item->product_image->first()->url)}}" alt=""
                                        style="width: 80px; height: 80px; border-radius: 5px; object-fit: cover">
                                    @endif
                                </td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>
                                    <a href="" class="btn btn-outline-secondary btn-icon-text"><i class="bi bi-pen"></i>
                                        Sửa</a>
                                    <a href="" class="btn btn-outline-danger btn-icon-text"><i class="bi bi-trash"></i>
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

<div class="tab-content" id="tab-violations">
    @if($countProductFail <=0)
    <img src="{{asset('sellers/assets/images/no-product-found.png')}}">
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
                                <th>Thao tác</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productFail as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->subCategory->name}}</td>
                                <td>
                                    @if($item->product_image->isNotEmpty())
                                    <img src="{{asset('uploads/'.$item->product_image->first()->url)}}" alt=""
                                        style="width: 80px; height: 80px; border-radius: 5px; object-fit: cover">
                                    @endif
                                </td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>
                                    <a href="" class="btn btn-outline-secondary btn-icon-text"><i class="bi bi-pen"></i>
                                        Sửa</a>
                                    <a href="" class="btn btn-outline-danger btn-icon-text"><i class="bi bi-trash"></i>
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
<div class="tab-content" id="tab-pending">
    @if($countProductPending <= 0)
    <img src="{{asset('sellers/assets/images/no-product-found.png')}}">
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
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productPending as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->subCategory->name}}</td>
                                <td>
                                    @if($item->product_image->isNotEmpty())
                                    <img src="{{asset('uploads/'.$item->product_image->first()->url)}}" alt=""
                                        style="width: 80px; height: 80px; border-radius: 5px; object-fit: cover">
                                    @endif
                                </td>
                                <td>{{$item->price}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>
                                    <a href="" class="btn btn-outline-secondary btn-icon-text"><i class="bi bi-pen"></i>
                                        Sửa</a>
                                    <a href="" class="btn btn-outline-danger btn-icon-text"><i class="bi bi-trash"></i>
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


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.tab-item');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', function (event) {
                event.preventDefault();

                // Remove active class from all tabs and content
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(content => content.classList.remove('active'));

                // Add active class to clicked tab
                tab.classList.add('active');

                // Show the corresponding content
                const targetTab = tab.getAttribute('data-tab');
                document.getElementById(`tab-${targetTab}`).classList.add('active');
            });
        });
    });
</script>
@endsection