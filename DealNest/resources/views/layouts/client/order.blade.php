<style>
    .order-list {
        font-family: Arial, sans-serif;
        margin: 20px 0;
    }

    .order {
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px;
        background-color: #f9f9f9;
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .order-header .shop-name {
        font-weight: bold;
        color: #007bff;
    }

    .order-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .order-item-image img {
        width: 80px;
        height: 80px;
        margin-right: 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    .order-item-details p {
        margin: 5px 0;
    }

    .order-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .order-actions button {
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .order-actions .secondary-button {
        background-color: #f0f0f0;
        color: #333;
    }

    .order-actions .secondary-button:hover {
        background-color: #ddd;
    }

    .cancel-order-item {
        background-color: #ff5c5c;
        color: white;
    }

    .cancel-order-item:hover {
        background-color: #e04e4e;
    }

    .order-status-reason {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
    }

    .order-status-reason span {
        margin-right: 15px;
    }

    .product-info {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .product-info img {
        width: 80px;
        /* Kích thước hình ảnh */
        height: 80px;
        /* Kích thước hình ảnh */
        margin-right: 15px;
    }

    .custom-file-upload {
        display: inline-flex;
        align-items: center;
        cursor: pointer;
        padding: 10px;
        border: 1px solid #007bff;
        border-radius: 5px;
        background-color: #fff;
        color: #007bff;
        transition: background-color 0.3s;
    }

    .custom-file-upload:hover {
        background-color: #007bff;
        color: #fff;
    }

    .custom-file-upload i {
        margin-right: 5px;
    }
</style>
<div class="order-list">
    @if($orders->isEmpty())
    <div class="text-center">
        <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
        <p class="text-center mt-3">Không có đơn hàng nào trong trạng thái này</p>
    </div>
    @else
    @foreach($orders as $order)
    <div class="order" id="order-{{ $order->id }}">
        <div class="order-header">
            <span class="shop-name">Cửa hàng: {{$order->seller->name}}</span>
            <span>Mã đơn: #{{ $order->id }}</span>
        </div>

        @foreach($order->orderItems as $item)
        <div class="order-item" id="order-item-{{ $item->id }}">
            <div class="order-item-image">
                <img src="{{ asset('uploads/' . $item->product->image) }}" alt="Product Image">
            </div>
            <div class="order-item-details">
                <p>{{ \Illuminate\Support\Str::limit($item->product->name, 50, '...') }}</p>

                <p>Phân loại hàng: {{ $item->color }}, Size: {{ $item->size }}</p>
                <p>Thành tiền {{ number_format($item->total, 0, ',', '.') }} VND</p>

                @if($order->status === 'waiting_for_delivery')
                <p>Ngày giao: {{ $order->delivery_date }}</p>
                @endif

                <!-- Nút đánh giá sản phẩm -->
                @if($order->status === 'completed')
                <button type="button" class="btn btn-primary review-button"
                    data-toggle="modal"
                    data-target="#reviewModal"
                    data-product-id="{{ $item->product->id }}"
                    data-product-name="{{ $item->product->name }}"
                    data-product-image="{{ asset('uploads/' . $item->product->image) }}"
                    data-product-type="Phân loại: {{ $item->color }}, Size: {{ $item->size }}">
                    Đánh giá sản phẩm
                </button>
                @endif
            </div>
        </div>
        @endforeach

        <div class="order-status-reason">
            <span>Trạng thái:
                @switch($order->status)
                @case('pending')
                <strong>Chờ xác nhận</strong>
                @break
                @case('waiting_for_delivery')
                <strong>Đang giao hàng</strong>
                @break
                @case('completed')
                <strong>Hoàn thành</strong>
                @break
                @case('refuse')
                <strong>Đơn từ chối</strong>
                @break
                @default
                <strong>Đơn hủy</strong>
                @endswitch
            </span>
            @if($order->status === 'refuse')
            <span>Lý do từ chối: {{ $order->cancellation_reason }}</span>
            @endif
        </div>

        <div class="order-actions">
            <button class="secondary-button">Liên hệ người bán</button>
            @switch($order->status)
            @case('pending')
            <button class="cancel-order-item" data-order-id="{{ $order->id }}" data-status="cancelled">Hủy đơn hàng</button>
            @break
            @case('cancelled')
            <button class="secondary-button">Mua lại</button>
            @break
            @case('waiting_for_delivery')
            <button class="cancel-order-item" data-order-id="{{ $order->id }}" data-status="completed">Đã nhận được hàng</button>
            @break
            @endswitch
        </div>
    </div>
    <hr>
    @endforeach
    @endif
</div>