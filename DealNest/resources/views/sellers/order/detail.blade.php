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
        width: 80px !important;
        height: 80px !important;
        border-radius: 5px !important;
        object-fit: cover !important;
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

    .order-status-select {
        width: 100%;
        max-width: 250px;
        padding: 8px;
        font-size: 14px;
        border-radius: 4px;
        border: 1px solid #ced4da;
        transition: border-color 0.3s;
        background: #f8f9fa;
        appearance: none;
        /* Loại bỏ dấu mũi tên mặc định của trình duyệt */
        padding-right: 30px;
        /* Tạo khoảng trống cho icon */
        position: relative;
    }

    .order-status-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
    }
</style>
<div class="container order-details-container">
    <form action="{{ route('seller.order.confirm', ['id' => $orderDetail->id]) }}" method="POST">
        @csrf
        <h2 class="order-title">Chi Tiết Đơn Hàng</h2>
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="order-info">
                    <h5>Thông Tin Đơn Hàng</h5>
                    <p><strong>Mã đơn hàng:</strong> {{$orderDetail->id}}</p>
                    <p><strong>Khách hàng:</strong> {{$orderDetail->user->full_name}}</p>
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
                    <h5>Thông tin người nhận hàng</h5>
                    <p><strong>Tên:</strong> {{ $orderDetail->orderItems->first()->name }}</p>
                    <p><strong>Địa chỉ:</strong> {{$orderDetail->orderItems->first()->address}} </p>
                    <p><strong>Số điện thoại:</strong> {{$orderDetail->orderItems->first()->phone}}</p>
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
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderItems as $item)
                <tr>
                    <td><img src="{{ asset('uploads/' . $item->product->image) }}" alt="Product Image" class="product-image"></td>
                    <td>
                        <strong>{{ \Illuminate\Support\Str::limit($item->product->name, 25, '...') }}</strong>
                        @if($item->attribute)
                        @php
                        $attributes = explode(', ', $item->attribute);
                        @endphp
                        <div class="product-attributes mt-3">
                            @foreach($attributes as $attribute)
                            <span class="badge attribute-badge" style="color: #333">{{ $attribute }}</span>
                            @endforeach
                        </div>
                        @else
                        <p><small>Không có thông tin kích thước và màu sắc</small></p>
                        @endif
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 0, ',', '.') }} vnđ</td>
                    <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} vnđ</td>
                    <td>
                        <input type="hidden" name="items[{{ $item->id }}][id]" value="{{ $item->id }}">
                        <select class="form-control order-status-select" name="items[{{ $item->id }}][status]">
                            @if(isset($status) && $status === 'waiting_for_delivery')
                            <option value="waiting_for_delivery" {{ $item->status == 'waiting_for_delivery' ? 'selected' : '' }}>✔️ Duyệt</option>
                            @else
                            <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>⏳ Chờ duyệt</option>
                            <option value="waiting_for_delivery" {{ $item->status == 'waiting_for_delivery' ? 'selected' : '' }}>✔️ Duyệt</option>
                            <option value="out_of_stock" {{ $item->status == 'out_of_stock' ? 'selected' : '' }}>❌ Hết hàng</option>
                            <option value="invalid_info" {{ $item->status == 'invalid_info' ? 'selected' : '' }}>⚠️ Thông tin không hợp lệ</option>
                            <option value="unknown_reason" {{ $item->status == 'unknown_reason' ? 'selected' : '' }}>❔ Lý do khác</option>
                            @endif
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="order-actions">
        @if(isset($status) && $status === 'pending')
            <button type="submit" class="btn btn-primary">Cập nhật trạng thái</button>
            <button type="button" class="btn btn-secondary">In đơn hàng</button>

        @else
            <button type="button" class="btn btn-secondary">In đơn hàng</button>
        @endif
        </div>
    </form>

</div>
@endsection