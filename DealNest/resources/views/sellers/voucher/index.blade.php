@extends('layouts.sellers.app')
@section('content')
<style>
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

    .voucher-type {
        font-size: 0.9rem;
        color: #888;
        margin-top: 10px;
    }

    .voucher-value {
        font-size: 1.2rem;
        font-weight: bold;
        color: #28a745;
    }

    .text-success {
        color: #28a745 !important;

    }

    .voucher-status {
        margin-top: 10px;
        font-size: 0.9rem;
    }

    .voucher-status.active {
        color: #28a745;
    }

    .voucher-status.expired {
        color: #dc3545;
    }

    .voucher-dates {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 10px;
    }

    .voucher-actions {
        margin-top: 15px;
    }

    .voucher-actions .btn {
        margin-right: 10px;
    }

    .btn-create-voucher {
        margin-bottom: 20px;
    }

    .voucher-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .voucher-header h2 {
        margin: 0;
    }

    .voucher-status {
        color: #6c757d;
    }
</style>

<div class="container voucher-list">
    <div class="voucher-header">
        <h2>Danh Sách Voucher</h2>
        <!-- Nút Tạo mới voucher -->
        <button class="btn btn-success btn-create-voucher" data-toggle="modal" data-target="#createVoucherModal">Tạo mới voucher</button>
    </div>

    <div class="row">
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <!-- Voucher 1 -->
        @if($vouchers->count() <= 0)
            <div class="text-center">
            <img class="no-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
            <p class="text-center mt-3">Chưa có sản phẩm nào chờ duyệt</p>
    </div>
    @else
    @foreach($vouchers as $item)
    <div class="col-12 col-md-6 col-lg-4 mb-4">
        <div class="voucher-card">
            <div class="d-flex justify-content-between align-items-center">
                <span class="voucher-name">{{$item->name}}</span>
                <span class="voucher-code">{{$item->code}}</span>
            </div>
            <p class="voucher-type">Giảm giá theo
                @if($item->subcategory_id !== null)
                Thể loại: {{$item->subcategory->name}}
                @endif
            </p>
            <p class="voucher-type">Loại: Giảm giá theo
                @if($item->type == 'percentage')
                phần trăm
                @else
                VNĐ
                @endif
            </p>

            <p class="voucher-value">Giảm:
                @if($item->type == 'percentage')
                {{ intval($item->value) }}%
                @else
                {{ number_format($item->value, 0, ',', '.') }} VNĐ
                @endif
            </p>

            <p class="voucher-status">Trạng thái:
                <span class="{{ \Carbon\Carbon::parse($item->end_date)->isPast() ? 'text-danger' : 'text-success' }}">
                    {{ \Carbon\Carbon::parse($item->end_date)->isPast() ? 'Hết hạn' : 'Có hiệu lực' }}
                </span>

            </p>

            <p class="voucher-dates">Thời gian:
                {{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }} -
                {{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}
            </p>


            <!-- Nút Edit và Xóa -->
            <div class="voucher-actions">
                <button class="btn btn-primary btn-edit-voucher" data-id="{{ $item->id }}" data-toggle="modal" data-target="#editVoucherModal">
                    Chỉnh sửa
                </button>
                <a href="{{route('seller.voucher.destroy',['id'=>$item->id])}}" class="btn btn-danger">Xóa</a>
            </div>
        </div>
    </div>
    @endforeach
    @endif
    <!-- Các voucher khác... -->
</div>
</div>

<!-- Modal để tạo mới voucher -->
<div class="modal fade" id="createVoucherModal" tabindex="-1" role="dialog" aria-labelledby="createVoucherModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createVoucherModalLabel">Tạo Voucher Mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="forms-sample" action="{{route('seller.voucher.create')}}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <!-- Các trường input -->
                    <div class="mb-3 form-group">
                        <label for="voucherName">Tên Voucher</label>
                        <input type="text" class="form-control" id="voucherName" placeholder="Nhập tên voucher" name="name" value="{{old('name')}}">
                        <input type="hidden" name="seller_id" value="{{$seller->id}}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Mã Voucher -->
                    <div class="mb-3 form-group">
                        <label for="voucherCode">Mã Voucher</label>
                        <input type="text" class="form-control" id="voucherCode" placeholder="Nhập mã voucher" name="code" value="{{old('code')}}">
                        @error('code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Loại Giảm giá (Mệnh giá hoặc Phần trăm) -->
                    <div class="mb-3 form-group">
                        <label>Loại Giảm Giá</label><br>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="discountAmount" value="fixed"
                                {{ old('type') == 'fixed' ? 'checked' : '' }}>
                            <label class="form-check-label" for="discountAmount">Mệnh giá</label>
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="type" id="discountPercent" value="percentage"
                                {{ old('type') == 'percentage' ? 'checked' : '' }}>
                            <label class="form-check-label" for="discountPercent">Phần trăm</label>
                        </div>
                        @error('type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Giá trị Giảm giá (VNĐ) -->
                    <div class="mb-3 form-group" id="discountAmountField">
                        <label for="voucherDiscountAmount">Giá trị Giảm giá (VNĐ)</label>
                        <input type="number" class="form-control" id="voucherDiscountAmount" placeholder="Nhập số tiền giảm giá" name="value_amount" value="{{ old('value_amount') }}">
                        @error('value_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Giá trị Giảm giá (%) -->
                    <div class="mb-3 form-group d-none" id="discountPercentField">
                        <label for="voucherDiscountPercent">Giá trị Giảm giá (%)</label>
                        <input type="number" class="form-control" id="voucherDiscountPercent" placeholder="Nhập phần trăm giảm giá" name="value_percent" value="{{ old('value_percent') }}">
                        @error('value_percent')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Ngày hết hạn -->
                    <div class="mb-3 form-group">
                        <label for="expiryDate">Ngày hết hạn</label>
                        <input type="date" class="form-control" id="expiryDate" name="end_date" value="{{old('end_date')}}">
                        @error('end_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- Trạng thái Voucher -->
                    <div class="mb-3 form-group">
                        <label for="status">Cho sản phẩm</label>
                        <select class="form-select" id="status" name="subcategory_id">
                            <option value="" disabled {{ old('subcategory_id') ? '' : 'selected' }}>Chọn thể loại giảm giá</option>
                            @foreach($subcategories as $item)
                            <option value="{{ $item->id }}" {{ old('subcategory_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('subcategory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nút tạo voucher -->
                    <div class="mb-3">
                        <button type="submit" class="btn-submit btn btn-primary">Tạo Voucher</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal to update voucher -->
<div class="modal fade" id="editVoucherModal" tabindex="-1" role="dialog" aria-labelledby="editVoucherModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editVoucherModalLabel">Chỉnh sửa Voucher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body">
                <!-- Form update -->
                <form id="editVoucherForm" method="POST" action="">
                    @csrf
                    <!-- Tên voucher -->
                    <div class="mb-3">
                        <label for="editVoucherName">Tên Voucher</label>
                        <input type="text" name="edit_name" class="form-control" id="editVoucherName" value="{{ old('edit_name') }}">
                        @error('edit_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Mã voucher -->
                    <div class="mb-3">
                        <label for="editVoucherCode">Mã Voucher</label>
                        <input type="text" name="edit_code" class="form-control" id="editVoucherCode" value="{{ old('edit_code') }}">
                        @error('edit_code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Loại giảm giá -->
                    <div class="mb-3">
                        <label>Loại Giảm Giá</label><br>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="edit_type" value="fixed" {{ old('edit_type') == 'fixed' ? 'checked' : '' }}> Mệnh giá
                        </div>
                        <div class="form-check-inline">
                            <input class="form-check-input" type="radio" name="edit_type" value="percentage" {{ old('edit_type') == 'percentage' ? 'checked' : '' }}> Phần trăm
                        </div>
                        @error('edit_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Giá trị giảm giá (VNĐ) -->
                    <div class="mb-3" id="edit_discountAmountField">
                        <label for="editValueAmount">Giá trị Giảm giá (VNĐ)</label>
                        <input type="number" name="edit_value_amount" class="form-control" id="editValueAmount" value="{{ old('edit_value_amount') }}">
                        @error('edit_value_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Giá trị giảm giá (%) -->
                    <div class="mb-3" id="edit_discountPercentField">
                        <label for="editValuePercent">Giá trị Giảm giá (%)</label>
                        <input type="number" name="edit_value_percent" class="form-control" id="editValuePercent" value="{{ old('edit_value_percent') }}">
                        @error('edit_value_percent')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Ngày hết hạn -->
                    <div class="mb-3">
                        <label for="editEndDate">Ngày hết hạn</label>
                        <input type="date" name="edit_end_date" class="form-control" id="editEndDate" value="{{ old('edit_end_date') }}">
                        @error('edit_end_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Danh mục -->
                    <div class="mb-3">
                        <label for="editSubCategory">Cho sản phẩm</label>
                        <select name="edit_subcategory_id" class="form-select" id="editSubCategory">
                            <option value="" disabled>Chọn thể loại</option>
                            @foreach($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}" {{ old('edit_subcategory_id') == $subcategory->id ? 'selected' : '' }}>
                                {{ $subcategory->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('edit_subcategory_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nút lưu -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Cập nhật Voucher</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>







<!-- Mở lại modal nếu có lỗi -->
@if($errors -> has('name') || $errors -> has('code') || $errors -> has('type') || $errors -> has('value_amount') || $errors -> has('value_percent') || $errors -> has('end_date') || $errors -> has('subcategory_id'))
<script>
    $(document).ready(function() {
        $('#createVoucherModal').modal('show');
    });
</script>
@endif
@if($errors->has('edit_name') || $errors->has('edit_code') || $errors->has('edit_type') || $errors->has('edit_value_amount') || $errors->has('edit_value_percent') || $errors->has('edit_end_date') || $errors->has('edit_subcategory_id'))
<script>
    $(document).ready(function() {
        $('#editVoucherModal').modal('show');
    });
</script>
@endif



<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tạo mới voucher
        const amountRadio = document.getElementById('discountAmount');
        const percentRadio = document.getElementById('discountPercent');
        const amountField = document.getElementById('discountAmountField');
        const percentField = document.getElementById('discountPercentField');
        const amountInput = document.getElementById('voucherDiscountAmount');
        const percentInput = document.getElementById('voucherDiscountPercent');

        // Hàm để hiển thị trường đúng với lựa chọn loại giảm giá
        function toggleFields() {
            if (amountRadio.checked) {
                amountField.classList.remove('d-none');
                percentField.classList.add('d-none');
            } else if (percentRadio.checked) {
                percentField.classList.remove('d-none');
                amountField.classList.add('d-none');
            }
        }

        // Kiểm tra ban đầu khi tải trang
        toggleFields();

        // Lắng nghe sự kiện thay đổi trên radio button
        amountRadio.addEventListener('change', toggleFields);
        percentRadio.addEventListener('change', toggleFields);

        // Logic chỉnh sửa voucher
        const editButtons = document.querySelectorAll('.btn-edit-voucher');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const voucherId = this.getAttribute('data-id');

                // Gửi yêu cầu AJAX để lấy thông tin voucher từ server
                $.ajax({
                    url: `/kenh-nguoi-ban/voucher/edit/${voucherId}`,
                    method: 'GET',
                    success: function(response) {
                        const voucher = response.voucher;

                        // Điền dữ liệu vào modal
                        document.querySelector('#editVoucherForm').setAttribute('action', `/kenh-nguoi-ban/voucher/cap-nhat/${voucher.id}`);
                        document.querySelector('#editVoucherModal input[name="edit_name"]').value = voucher.name;
                        document.querySelector('#editVoucherModal input[name="edit_code"]').value = voucher.code;
                        document.querySelector('#editVoucherModal input[name="edit_end_date"]').value = voucher.end_date;

                        // Xử lý loại giảm giá
                        if (voucher.type === 'fixed') {
                            document.querySelector('#editVoucherModal input[name="edit_type"][value="fixed"]').checked = true;
                            document.querySelector('#editValueAmount').value = voucher.value; // Gán giá trị VNĐ
                            document.querySelector('#edit_discountAmountField').classList.remove('d-none'); // Hiển thị VNĐ
                            document.querySelector('#edit_discountPercentField').classList.add('d-none'); // Ẩn phần trăm
                            document.querySelector('#editValuePercent').value = ''; // Đảm bảo phần trăm bị xóa
                        } else if (voucher.type === 'percentage') {
                            document.querySelector('#editVoucherModal input[name="edit_type"][value="percentage"]').checked = true;
                            document.querySelector('#editValuePercent').value = voucher.value; // Gán giá trị phần trăm
                            document.querySelector('#edit_discountAmountField').classList.add('d-none'); // Ẩn VNĐ
                            document.querySelector('#edit_discountPercentField').classList.remove('d-none'); // Hiển thị phần trăm
                            document.querySelector('#editValueAmount').value = ''; // Đảm bảo VNĐ bị xóa
                        }


                        // Set danh mục
                        document.querySelector('#editSubCategory').value = voucher.subcategory_id;

                        // Hiển thị modal
                        $('#editVoucherModal').modal('show');
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra khi lấy dữ liệu voucher!');
                    }
                });
            });
        });
    });
</script>


@endsection