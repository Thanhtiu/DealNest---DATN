@extends('layouts/client.app')
@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Kho Voucher</h2>
                        <div class="float-end">
                            <a href="#" class="text-decoration-none text-danger">Tìm thêm voucher</a> |
                            <a href="#" class="text-decoration-none text-danger">Xem lịch sử voucher</a> |
                            <a href="#" class="text-decoration-none text-secondary">Tìm hiểu</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="voucher-code" class="form-label">Mã Voucher</label>
                            <input type="text" class="form-control" id="voucher-code" placeholder="Nhập mã voucher tại đây">
                        </div>
                        <button class="btn btn-success mt-3">Lưu</button>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection