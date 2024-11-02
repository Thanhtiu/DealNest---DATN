@extends('layouts.sellers.app')
@section('content')
<style>
    .order-details-container {
        padding: 20px;
        background-color: #ffffff;
        border-radius: 6px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        max-width: 1000px;
        margin: 20px auto;
    }

    .order-title {
        text-align: center;
        font-size: 28px;
        margin-bottom: 25px;
        color: #333;
        font-weight: 600;
    }

    .badge-warning {
        background-color: #ff9800;
        color: #fff;
    }

    .badge-success {
        background-color: #4caf50;
        color: #fff;
    }

    .badge-danger {
        background-color: #f44336;
        color: #fff;
    }

    .product-image {
        width: 70px;
        height: 70px;
        border-radius: 4px;
        object-fit: cover;
    }

    .order-info,
    .customer-info {
        border: 1px solid #e0e0e0;
        padding: 15px;
        border-radius: 6px;
        background-color: #f9f9f9;
        margin-bottom: 20px;
    }

    .order-info h5,
    .customer-info h5 {
        font-size: 16px;
        color: #555;
        margin-bottom: 12px;
    }

    .order-actions {
        text-align: center;
        margin-top: 25px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: #565e64;
    }

    .order-status-select {
        width: 100%;
        max-width: 250px;
        padding: 8px;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid #ced4da;
        background-color: #f1f1f1;
    }

    .delivery-date-input,
    textarea.form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        margin-top: 10px;
    }

    .customer-image-container {
        margin-bottom: 10px;
    }

    .customer-image {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #007bff;
    }

    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }

    .product-attributes span {
        display: inline-block;
        margin-top: 5px;
        padding: 4px 6px;
        font-size: 12px;
        background-color: #eee;
        border-radius: 4px;
    }

    .delivery_date {
        margin-bottom: 15px;
    }
</style>

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
<div class="container order-details-container">
    <h2 class="order-title">Chi Tiết Đơn Hàng</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="order-info">
                <h5>Thông Tin Đơn Hàng</h5>
                <p><strong>Mã đơn hàng:</strong> {{$orderCode}}</p>
                <p><strong>Khách hàng:</strong> {{$order->user->name}}</p>
                <p><strong>Ngày đặt:</strong> {{$order->created_at}}</p>
                <p><strong>Phương thức thanh toán:</strong> {{ $order->payment_method==='vnpay' ? 'vnpay':'Khi nhận hàng'}}</p>
                <p><strong>Phí ship:</strong> 15.000 vnđ</p>
                <p><strong>Tổng tiền:</strong> {{ number_format($order->total, 0, ',', '.') }} vnđ</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="customer-info text-center">
                <h5>Thông tin người nhận hàng</h5>
                <div class="customer-image-container">
                    <img src="{{ asset('uploads/' . ($order->user->image ?? 'default_avt.png')) }}" alt="Customer Image" class="customer-image">
                </div>
                <p><strong>Tên:</strong> {{ $order->user->name }}</p>
                <p><strong>Địa chỉ:</strong> {{$order->address}} </p>
            </div>
        </div>
    </div>

    <h5 class="mt-4">Sản Phẩm</h5>
    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>Hình Ảnh</th>
                <th>Tên Sản Phẩm</th>
                <th>Số Lượng</th>
                <th>Thành Tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orderDetail as $item)
            <tr>
                <td><img src="{{ asset('uploads/' . $item->product->image) }}" alt="Product Image" class="product-image"></td>
                <td>
                    <strong>{{ \Illuminate\Support\Str::limit($item->product->name, 25, '...') }}</strong>
                    <div class="product-attributes mt-2">
                        @if ($item->color)
                        <span>Kích thước: {{ $item->color }}</span>
                        @endif
                        @if ($item->size)
                        <span>Màu sắc: {{ $item->size }}</span>
                        @endif
                    </div>
                </td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->total, 0, ',', '.') }} vnđ</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="order-actions">

        <form action="{{ route('seller.order.confirm', ['id' => $order->id]) }}" method="POST">
            @csrf
            <div class="delivery_date">
                <label for="delivery-date" class="form-label">Chọn ngày giao hàng:</label>
                <input type="date" id="delivery-date" class="delivery-date-input" name="delivery_date" value="{{$order->delivery_date}}">
            </div>
            <select class="form-control order-status-select" name="status">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>⏳ Chờ duyệt</option>
                <option value="waiting_for_delivery" {{ $order->status == 'waiting_for_delivery' ? 'selected' : '' }}>✔️ Duyệt</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>❌ Từ chối</option>
                <option value="refuse" {{ $order->status == 'refuse' ? 'selected' : '' }}>⚠️ Khách hủy</option>
            </select>

            <textarea class="form-control mt-2" name="note" placeholder="Nhập ghi chú...">{{$order->cancellation_reason}}</textarea>

            <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
        </form>
        <a href="" class="btn btn-secondary mt-2">In đơn hàng</a>
        <a href="{{route('seller.order')}}" class="btn btn-secondary mt-2">Trở về</a>
    </div>
</div>

@endsection