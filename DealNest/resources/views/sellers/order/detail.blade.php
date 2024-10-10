@extends('layouts.sellers.app')
@section('content')
<style>
    .order-details-container {
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.15);
        transition: all 0.3s;
    }

    .order-title {
        text-align: center;
        font-size: 32px;
        margin-bottom: 30px;
        color: #007bff;
        font-weight: bold;
    }

    .badge-warning {
        background-color: #ff9800;
    }

    .badge-success {
        background-color: #4caf50;
    }

    .badge-danger {
        background-color: #f44336;
    }

    .product-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
    }

    .order-info,
    .customer-info {
        border: 1px solid #dee2e6;
        padding: 15px;
        border-radius: 8px;
        background-color: #f8f9fa;
    }

    .order-info h5,
    .customer-info h5 {
        font-size: 18px;
        color: #333;
        margin-bottom: 15px;
    }

    .order-actions {
        text-align: center;
        margin-top: 30px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .btn-secondary:hover {
        background-color: #6c757d;
        border-color: #6c757d;
    }
</style>
<div class="container order-details-container">
    <h2 class="order-title">Chi Tiết Đơn Hàng</h2>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="order-info">
                <h5>Thông Tin Đơn Hàng</h5>
                <p><strong>Mã đơn hàng:</strong> {{$orderDetail->id}}</p>
                <p><strong>Khách hàng:</strong> {{$orderDetail->user->name}}</p>
                <p><strong>Ngày đặt:</strong> {{$orderDetail->delivery_date}}</p>
                <p><strong>Phương thức thanh toán:</strong> {{$orderDetail->payment_method}}</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($orderDetail->total, 0, ',', '.') }} vnđ</p>
                <p><strong>Trạng thái:</strong>
                    @if($orderDetail->status == 'pending')
                    <label class="badge badge-warning">Chờ phê duyệt</label>
                    @elseif($orderDetail->status == 'completed')
                    <label class="badge badge-success">Đã phê duyệt</label>
                    @else
                    <label class="badge badge-danger">Từ chối đơn</label>
                    @endif
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="customer-info">
                <h5>Thông Tin Khách Hàng</h5>
                <p><strong>Tên:</strong> {{$orderDetail->user->name}}</p>
                <p><strong>Địa chỉ:</strong> 123 Đường ABC, Quận XYZ, TP HCM</p>
                <p><strong>Số điện thoại:</strong> 0123456789</p>
            </div>
        </div>
    </div>

    <h5 class="mb-3">Sản Phẩm</h5>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Hình Ảnh</th>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Giá</th>
                <th>Thành Tiền</th>
                <th>Trạng Thái</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderItems as $item)
            <tr>
                <td><img src="product-image.jpg" alt="Product Image" class="product-image"></td>
                <td>Sản phẩm A</td>
                <td>2</td>
                <td>80,000 vnđ</td>
                <td>160,000 vnđ</td>
                <td><span class="badge badge-warning">Chờ phê duyệt</span></td>
                <td>
                    <button class="btn btn-outline-success btn-sm">Duyệt</button>
                    <button class="btn btn-outline-danger btn-sm">Từ chối</button>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>

    <div class="order-actions">
        <button class="btn btn-primary">Cập nhật trạng thái</button>
        <button class="btn btn-secondary">In đơn hàng</button>
    </div>
</div>
@endsection