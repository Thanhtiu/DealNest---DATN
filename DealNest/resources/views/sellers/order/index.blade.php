@extends('layouts.sellers.app')
@section('content')
<style>
    .tabs {
        display: flex;
        justify-content: space-around;
        background-color: #ffffff;
        padding: 15px;
        border-bottom: 2px solid #f0f0f0;
        border-radius: 8px 8px 0 0;
        margin-bottom: 20px;
    }

    .tab-item {
        padding: 10px 15px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
        color: #0d6efd;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .tab-item.active {
        color: #0d6efd;
        border-bottom: 3px solid #0d6efd;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
        background-color: #fff;
        border-radius: 0 0 8px 8px;
        padding: 20px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 400;
    }

    th,
    td {
        padding: 10px;
        border-bottom: 1px solid #f0f0f0;
        text-align: left;
        color: #333;
    }

    th {
        background-color: #f9f9f9;
        font-weight: 700;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #fff;
        padding: 5px 10px;
        border-radius: 4px;
    }

    .btn-icon-text {
        display: inline-flex;
        align-items: center;
        padding: 5px 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
        background-color: #fff;
        transition: background-color 0.3s ease;
        text-decoration: none;
    }

    .btn-icon-text i {
        margin-right: 5px;
    }

    .btn-icon-text:hover {
        background-color: #f0f0f0;
        color: #0d6efd;
    }
</style>

<div class="tabs" role="tablist">
    <a href="#" class="tab-item active" data-tab="all">Tất cả đơn hàng </a>
    <a href="#" class="tab-item" data-tab="pending">Đơn chờ duyệt </a>
    <a href="#" class="tab-item" data-tab="waitingForDelivery">Đang giao </a>
    <a href="#" class="tab-item" data-tab="refused">Đơn từ chối </a>
    <a href="#" class="tab-item" data-tab="cancellted">Đơn hủy </a>
    <a href="#" class="tab-item" data-tab="completed">Hoàn thành </a>
</div>

<div class="tab-content active" id="tab-all">
    @if($all->isEmpty())
    <div class="text-center no-data">
        <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
        <p class="text-center mt-3">Chưa có đơn hàng nào</p>
    </div>
    @else
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tất cả đơn hàng</h4>
                    <table id="orderTableAll" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>PT thanh toán</th>
                                <th>Ngày đặt</th>
                                <th>Số lượng</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($all as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>

                                <td>{{ $order->payment_method==='vnpay' ? 'vnpay':'Khi nhận hàng'}}</td>
                                <td>{{ $order->created_at }}</td>

                                <td>{{$order->order_items_count}}</td>
                                @if($order->status==='pending')
                                <td><label class="badge badge-warning">Chờ duyệt</label></td>
                                @elseif($order->status==='waiting_for_delivery')
                                <td><label class="badge badge-info">Đang giao</label></td>
                                @elseif($order->status === 'completed')
                                <td><label class="badge badge-success">Hoàn thành</label></td>
                                @elseif($order->status === 'cancelled')
                                <td><label class="badge badge-danger">Từ chối</label></td>
                                @elseif($order->status === 'refuse')
                                <td><label class="badge badge-danger">Đơn hủy</label></td>
                                @endif
                                <td>
                                    <a href="{{ route('seller.order.detail', ['id' => $order->id, 'status' => $order->status]) }}" class="btn btn-outline-secondary btn-icon-text">
                                        <i class="bi bi-eye"></i> Chi tiết
                                    </a>
                                    <a href="" class="btn btn-outline-danger btn-icon-text">
                                        <i class="bi bi-trash"></i> Xóa
                                    </a>
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

<!-- Tab Content for Pending Orders -->
<div class="tab-content" id="tab-pending">
    @if($pending->isEmpty())
    <div class="text-center no-data">
        <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
        <p class="text-center mt-3">Chưa có đơn hàng nào</p>
    </div>
    @else
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tất cả đơn hàng đang giao</h4>
                    <table id="orderTablePending" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>PT thanh toán</th>
                                <th>Ngày đặt</th>
                                <th>Số lượng</th>
                              
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pending as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
                                <td>{{ $order->payment_method==='vnpay' ? 'vnpay':'Khi nhận hàng'}}</td>
                                <td>{{ $order->created_at }}</td>

                                <td>{{$order->order_items_count}}</td>
                               
                                <td>
                                    <a href="{{ route('seller.order.detail', ['id' => $order->id, 'status' => 'pending']) }}" class="btn btn-outline-secondary btn-icon-text">
                                        <i class="bi bi-eye"></i> Chi tiết
                                    </a>
                                    <a href="" class="btn btn-outline-danger btn-icon-text">
                                        <i class="bi bi-trash"></i> Xóa
                                    </a>
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

<!-- Tab Content for waitingForDelivery Orders -->
<div class="tab-content" id="tab-waitingForDelivery">
    @if($waitingForDelivery->isEmpty())
    <div class="text-center no-data">
        <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
        <p class="text-center mt-3">Chưa có đơn hàng nào</p>
    </div>
    @else
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tất cả đơn hàng đang giao</h4>
                    <table id="orderTableWaitingForDelivery" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>PT thanh toán</th>
                                <th>Ngày đặt</th>

                                <th>Số lượng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($waitingForDelivery as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
                                <td>{{ $order->payment_method==='vnpay' ? 'vnpay':'Khi nhận hàng'}}</td>
                                <td>{{ $order->created_at }}</td>

                                <td>{{$order->order_items_count}}</td>


                                <td>
                                    <a href="{{ route('seller.order.detail', ['id' => $order->id, 'status' => 'waiting_for_delivery']) }}" class="btn btn-outline-secondary btn-icon-text">
                                        <i class="bi bi-eye"></i> Chi tiết
                                    </a>
                                    <a href="" class="btn btn-outline-danger btn-icon-text">
                                        <i class="bi bi-trash"></i> Xóa
                                    </a>
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

<!-- Tab Content for refused Orders -->
<div class="tab-content" id="tab-refused">
    @if($refused->isEmpty())
    <div class="text-center no-data">
        <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
        <p class="text-center mt-3">Chưa có đơn hàng nào</p>
    </div>
    @else
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tất cả đơn hàng từ chối</h4>
                    <table id="orderTableRefused" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>PT thanh toán</th>
                                <th>Ngày đặt</th>

                                <th>Số lượng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($refused as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
                                <td>{{ $order->payment_method==='vnpay' ? 'vnpay':'Khi nhận hàng'}}</td>
                                <td>{{ $order->created_at }}</td>

                                <td>{{$order->order_items_count}}</td>

                                <td>
                                    <a href="{{ route('seller.order.detail', ['id' => $order->id, 'status' => 'refused']) }}" class="btn btn-outline-secondary btn-icon-text">
                                        <i class="bi bi-eye"></i> Chi tiết
                                    </a>
                                    <a href="" class="btn btn-outline-danger btn-icon-text">
                                        <i class="bi bi-trash"></i> Xóa
                                    </a>
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

<!-- Tab Content for refused Orders -->
<div class="tab-content" id="tab-cancellted">
    @if($cancelled->isEmpty())
    <div class="text-center no-data">
        <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
        <p class="text-center mt-3">Chưa có đơn hàng nào</p>
    </div>
    @else
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tất cả đơn hàng bị hủy</h4>
                    <table id="orderTableCancellted" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>PT thanh toán</th>
                                <th>Ngày đặt</th>

                                <th>Số lượng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cancelled as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
                                <td>{{ $order->payment_method==='vnpay' ? 'vnpay':'Khi nhận hàng'}}</td>
                                <td>{{ $order->created_at }}</td>

                                <td>{{$order->order_items_count}}</td>

                                <td>
                                    <a href="{{ route('seller.order.detail', ['id' => $order->id, 'status' => 'cancelled']) }}" class="btn btn-outline-secondary btn-icon-text">
                                        <i class="bi bi-eye"></i> Chi tiết
                                    </a>
                                    <a href="" class="btn btn-outline-danger btn-icon-text">
                                        <i class="bi bi-trash"></i> Xóa
                                    </a>
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

<!-- Tab Content for refused Orders -->
<div class="tab-content" id="tab-completed">
    @if($completed->isEmpty())
    <div class="text-center no-data">
        <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
        <p class="text-center mt-3">Chưa có đơn hàng nào</p>
    </div>
    @else
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tất cả đơn hàng hoàn thành</h4>
                    <table id="orderTableCompleted" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tổng tiền</th>
                                <th>PT thanh toán</th>
                                <th>Ngày đặt</th>

                                <th>Số lượng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($completed as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ number_format($order->total, 0, ',', '.') }} VND</td>
                                <td>{{ $order->payment_method==='vnpay' ? 'vnpay':'Khi nhận hàng'}}</td>
                                <td>{{ $order->created_at }}</td>

                                <td>{{$order->order_items_count}}</td>

                                <td>
                                    <a href="{{ route('seller.order.detail', ['id' => $order->id, 'status' => 'completed']) }}" class="btn btn-outline-secondary btn-icon-text">
                                        <i class="bi bi-eye"></i> Chi tiết
                                    </a>
                                    <a href="" class="btn btn-outline-danger btn-icon-text">
                                        <i class="bi bi-trash"></i> Xóa
                                    </a>
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
    $(document).ready(function() {
        // Hàm khởi tạo DataTable
        function initializeDataTable(tableId) {
            $(tableId).DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "lengthMenu": [5, 10, 25, 50],
                "pageLength": 5,
                "language": {
                    "paginate": {
                        "previous": "<i class='bi bi-arrow-left'></i>",
                        "next": "<i class='bi bi-arrow-right'></i>"
                    },
                    "search": "Tìm kiếm:",
                    "lengthMenu": "Hiển thị _MENU_ mục",
                    "info": "Hiển thị _START_ đến _END_ của _TOTAL_ mục"
                },
                "dom": '<"row"<"col-md-6"l><"col-md-6"f>>' +
                    '<"row"<"col-sm-12"tr>>' +
                    '<"row"<"col-md-5"i><"col-md-7"p>>',
                "columnDefs": [{
                    "targets": 2, // Cột tổng tiền
                    "render": $.fn.dataTable.render.number(',', '.', 0, '', ' VND')
                }]
            });
        }

        // Khởi tạo DataTable cho bảng đầu tiên khi load trang
        initializeDataTable('#orderTableAll');

        // Khởi tạo DataTable khi chuyển tab
        $('.tab-item').on('click', function() {
            var tabId = $(this).data('tab');
            $('.tab-item').removeClass('active');
            $(this).addClass('active');
            $('.tab-content').removeClass('active');
            $('#tab-' + tabId).addClass('active');

            var tableId = '#orderTable' + capitalizeFirstLetter(tabId);

            // Chỉ khởi tạo DataTable nếu nó chưa được khởi tạo
            if (!$.fn.DataTable.isDataTable(tableId)) {
                initializeDataTable(tableId);
            }
        });

        // Hàm hỗ trợ viết hoa chữ cái đầu tiên
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
    });
</script>
@endsection