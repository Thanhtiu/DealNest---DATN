@extends('layouts.sellers.app')
@section('content')
<style>
    /* CSS thẻ voucher giữ nguyên */
    .voucher-card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        margin-bottom: 20px;
        overflow: hidden;
        background-color: #fff;
        padding: 20px;
        height: 100%;
    }

    .voucher-name {
        font-size: 1.25rem;
        font-weight: bold;
    }

    .voucher-code {
        font-size: 1rem;
        font-weight: bold;
        background-color: #ffefc1;
        padding: 5px;
        border-radius: 4px;
        display: inline-block;
    }

    .voucher-type,
    .voucher-value,
    .voucher-status,
    .voucher-dates,
    .voucher-actions {
        margin-top: 10px;
    }

    .voucher-empty {
        text-align: center;
        margin-top: 30px;
        font-size: 16px;
        color: #999;
    }
</style>

<div class="container voucher-list">
    <div class="text-end mb-4">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addVoucherModal">
            Thêm Voucher
        </button>
    </div>
    @if($vouchers->isEmpty())
    <div class="voucher-empty">
        <img class="wishlist-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data">
        <p class="text-center mt-3">Chưa có voucher nào được tạo </p>
    </div>
    @else
    <h2 class="text-center mb-4">Danh Sách Voucher</h2>
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
    <!-- Nút Thêm Voucher -->


    <div class="row">
        <!-- Danh sách voucher --> @foreach ($vouchers as $voucher)
        <div class="col-12 col-md-6 col-lg-4 mb-4">

            <div class="voucher-card">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="voucher-name">{{ $voucher->name }}</span>
                    <span class="voucher-code">{{ $voucher->code }}</span>
                </div>
                <p class="voucher-type">Loại: {{ $voucher->type === 'percentage' ? 'Giảm giá theo phần trăm' : 'Giảm giá cố định' }}</p>
                <p class="voucher-value">Giảm: {{ $voucher->type === 'percentage' ? $voucher->value . '%' : number_format($voucher->value, 2) . ' VNĐ' }}</p>
                <p class="voucher-status {{ $voucher->status == 1 ? 'active' : 'inactive' }}">Trạng thái: {{ $voucher->status == 1 ? 'Có hiệu lực' : 'Không có hiệu lực' }}</p>
                <p class="voucher-dates">Thời gian: {{ \Carbon\Carbon::parse($voucher->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y') }}</p>
                <!-- Nút Edit và Xóa -->
                <div class="voucher-actions">
                    <a href="javascript:void(0)" onclick="openEditModal({{ $voucher->id }})" class="btn btn-primary">Edit</a>

                    <form action="{{route('seller.voucher.destroy',['id'=>$voucher->id])}}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
@endif
</div>

<!-- Modal Thêm Voucher -->
<div class="modal fade" id="addVoucherModal" tabindex="-1" aria-labelledby="addVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVoucherModalLabel">Thêm Voucher Mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form thêm voucher mới -->
                <form id="voucherForm" action="{{ route('seller.voucher.create') }}" method="POST">
                    @csrf <!-- Thêm token CSRF -->
                    <div class="mb-3">
                        <label for="voucherName" class="form-label">Tên Voucher</label>
                        <input type="text" class="form-control" id="voucherName" placeholder="Nhập tên voucher" required name="name">
                    </div>
                    <div class="mb-3">
                        <label for="voucherCode" class="form-label">Mã Voucher</label>
                        <input type="text" class="form-control" id="voucherCode" placeholder="Nhập mã voucher" required name="code">
                    </div>
                    <div class="mb-3">
                        <label for="productSelect" class="form-label">Chọn Sản Phẩm</label>
                        <select class="form-select" id="productSelect" required name="product_id">
                            <option value="" disabled selected>Chọn sản phẩm</option>
                            @foreach($products as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="startDate" class="form-label">Thời Gian Bắt Đầu</label>
                            <input type="date" class="form-control" id="startDate" required name="start_date">
                        </div>
                        <div class="col">
                            <label for="endDate" class="form-label">Thời Gian Kết Thúc</label>
                            <input type="date" class="form-control" id="endDate" required name="end_date">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loại Giảm Giá</label>
                        <div>
                            <div class="col">
                                <input class="form-check-input" type="radio" id="discountVND" name="type" value="fixed" required onclick="toggleVndInput()">
                                <label class="form-check-label" for="discountVND">Giảm theo VND</label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" id="discountPercent" name="type" value="percentage" required onclick="togglePercentInput()">
                                <label class="form-check-label" for="discountPercent">Giảm theo %</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3" id="vndInputContainer" style="display: none;">
                        <label for="vndValue" class="form-label">Giá Trị Giảm (VND)</label>
                        <input type="number" class="form-control" id="vndValue" placeholder="Nhập giá trị giảm theo VND" min="1000" name="vndValue">
                    </div>
                    <div class="mb-3" id="percentInputContainer" style="display: none;">
                        <label for="percentValue" class="form-label">Giá Trị Giảm (%)</label>
                        <input type="number" class="form-control" id="percentValue" placeholder="Nhập giá trị giảm theo %" min="0" max="100" name="percentValue">
                    </div>
                    <div class="mb-3">
                        <label for="statusSelect" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="statusSelect" required name="status">
                            <option value="" disabled selected>Chọn trạng thái</option>
                            <option value="1">Có hiệu lực</option>
                            <option value="0">Hết hiệu lực</option>
                        </select>
                    </div>
                    <div id="errorMessage" class="text-danger" style="display: none;"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary" form="voucherForm">Lưu Voucher</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="editVoucherModal" tabindex="-1" aria-labelledby="editVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVoucherModalLabel">Chỉnh Sửa Voucher</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editVoucherForm" method="POST">
                    @csrf
                    @method('POST')
                    <div class="mb-3">
                        <label for="editVoucherName" class="form-label">Tên Voucher</label>
                        <input type="text" class="form-control" id="editVoucherName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editVoucherCode" class="form-label">Mã Voucher</label>
                        <input type="text" class="form-control" id="editVoucherCode" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductSelect" class="form-label">Chọn Sản Phẩm</label>
                        <select class="form-select" id="editProductSelect" name="product_id" required>
                            <option value="" disabled>Chọn sản phẩm</option>
                            <!-- Options được thêm động từ JavaScript -->
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="editStartDate" class="form-label">Thời Gian Bắt Đầu</label>
                            <input type="date" class="form-control" id="editStartDate" name="start_date" required>
                        </div>
                        <div class="col">
                            <label for="editEndDate" class="form-label">Thời Gian Kết Thúc</label>
                            <input type="date" class="form-control" id="editEndDate" name="end_date" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loại Giảm Giá</label>
                        <div>
                            <div class="col">
                                <input class="form-check-input" type="radio" id="editdiscountVND" name="type" value="fixed" required onclick="toggleVndInput()">
                                <label class="form-check-label" for="discountVND">Giảm theo VND</label>
                            </div>
                            <div class="col">
                                <input class="form-check-input" type="radio" id="editdiscountPercent" name="type" value="percentage" required onclick="togglePercentInput()">
                                <label class="form-check-label" for="discountPercent">Giảm theo %</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3" id="editvndInputContainer" style="display: none;">
                        <label for="editeditvndValue" class="form-label">Giá Trị Giảm (VND)</label>
                        <input type="number" class="form-control" id="editeditvndValue" name="value" min="1000">
                    </div>
                    <div class="mb-3" id="editpercentInputContainer" style="display: none;">
                        <label for="editeditpercentValue" class="form-label">Giá Trị Giảm (%)</label>
                        <input type="number" class="form-control" id="editeditpercentValue" name="value" min="0" max="100">
                    </div>
                    <div class="mb-3">
                        <label for="editStatusSelect" class="form-label">Trạng Thái</label>
                        <select class="form-select" id="editStatusSelect" name="status" required>
                            <option value="" disabled>Chọn trạng thái</option>
                            <option value="1">Có hiệu lực</option>
                            <option value="0">Hết hiệu lực</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary" form="editVoucherForm">Cập Nhật Voucher</button>
            </div>
        </div>
    </div>
</div>


<script>
    function toggleVndInput() {
        const vndInputContainer = document.getElementById('vndInputContainer');
        vndInputContainer.style.display = document.getElementById('discountVND').checked ? 'block' : 'none';
    }

    function togglePercentInput() {
        const percentInputContainer = document.getElementById('percentInputContainer');
        percentInputContainer.style.display = document.getElementById('discountPercent').checked ? 'block' : 'none';
    }

    function openEditModal(voucherId) {
        // Cập nhật action cho form
        const form = document.getElementById('editVoucherForm');
        form.action = `/kenh-nguoi-ban/voucher/cap-nhat/${voucherId}`;

        // Gọi API lấy thông tin voucher
        fetch(`/kenh-nguoi-ban/voucher/edit/${voucherId}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    console.error(data.error);
                    return;
                }

                // In dữ liệu nhận được từ API ra console
                console.log('Voucher Data:', data);

                // Điền dữ liệu voucher vào form
                document.getElementById('editVoucherName').value = data.voucher.name;
                document.getElementById('editVoucherCode').value = data.voucher.code;

                // Kiểm tra và gán giá trị cho ngày bắt đầu và ngày kết thúc
                document.getElementById('editStartDate').value = data.voucher.start_date.slice(0, 10); // Lấy dạng YYYY-MM-DD
                document.getElementById('editEndDate').value = data.voucher.end_date.slice(0, 10);

                // Gán giá trị checked cho loại giảm giá
                if (data.voucher.type === "fixed") {
                    document.getElementById('editdiscountVND').checked = true;
                    document.getElementById('editvndInputContainer').style.display = "block";
                    document.getElementById('editpercentInputContainer').style.display = "none";
                    document.getElementById('editeditvndValue').value = data.voucher.value; // Gán giá trị vào input
                } else if (data.voucher.type === "percentage") {
                    document.getElementById('editdiscountPercent').checked = true;
                    document.getElementById('editpercentInputContainer').style.display = "block";
                    document.getElementById('editvndInputContainer').style.display = "none";
                    document.getElementById('editeditpercentValue').value = data.voucher.value; // Gán giá trị vào input
                }

                // Đổ dữ liệu vào dropdown sản phẩm
                const productSelect = document.getElementById('editProductSelect');
                productSelect.innerHTML = '';
                data.products.forEach(product => {
                    const option = document.createElement('option');
                    option.value = product.id;
                    option.textContent = product.name;
                    option.selected = product.id === data.voucher.product_id; // chọn sản phẩm hiện tại
                    productSelect.appendChild(option);
                });

                // Gán trạng thái
                document.getElementById('editStatusSelect').value = data.voucher.status;

                // Hiển thị modal
                new bootstrap.Modal(document.getElementById('editVoucherModal')).show();
            })
            .catch(error => console.error('Error:', error));
    }
</script>

@endsection