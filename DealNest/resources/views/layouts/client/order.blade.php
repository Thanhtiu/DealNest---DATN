<div class="order-list">
    @if($orders->isEmpty())
    <div class="text-center">
        <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
        <p class="text-center mt-3">Không có đơn hàng nào trong trạng thái này</p>
    </div>
    @else
    @foreach($orders as $order)
    <div class="order" id="order-{{ $order->id }}">
        @foreach($order->orderItems as $item)
        <div class="order-item" id="order-item-{{ $item->id }}">
            <div class="order-item-info">
                <div class="order-item-image">
                    <img src="{{ asset('uploads/' . $item->product->image) }}" alt="Product Image">
                </div>
                <div class="order-item-details">
                    <p>{{ $item->product->name }}</p>
                    <p>Phân loại hàng: {{ $item->color }}, Size: {{ $item->size }}</p>
                    <p>Thành tiền {{$item->total}}</p>

                    @if($order->status === 'waiting_for_delivery')
                    <p>Ngày giao: {{ $order->delivery_date }}</p>
                    @endif

                    <p>Trạng thái:
                        @switch(true)
                        @case($order->status === 'pending')
                        <span>Chờ xác nhận</span>
                        @break
                        @case($order->status === 'waiting_for_delivery')
                        <span>Đang giao hàng</span>
                        @break
                        @case($order->status === 'completed')
                        <span>Hoàn thành</span>
                        @break
                        @case($order->status === 'refuse')
                        <span>Đơn từ chối</span>
                        @break
                        @default
                        <span>Đơn hủy</span>
                        @endswitch
                    </p>


                </div>
            </div>
        </div>
        @endforeach
        <div class="order-actions">
            <button class="secondary-button">Liên hệ người bán</button>
            @switch($order->status)
            @case('pending')
            <button class="cancel-order-item" data-order-id="{{ $order->id }}" data-status="cancelled">Hủy đơn hàng</button>
            @break
            @case('cancelled')
            <button>Mua lại</button>
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