@extends('layouts.sellers.app')
@section('content')
<style>
    .tabs {
        display: flex;
        border-bottom: 2px solid #f0f0f0;
        margin-bottom: 20px;
        justify-content: space-around;
        background-color: #ffffff;
        padding: 15px;
        border-radius: 8px 8px 0 0;
    }

    .tab-item {
        padding: 12px 20px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
        color: #0d6efd;
        text-decoration: none;
        position: relative;
        transition: color 0.3s ease, background-color 0.3s ease;
    }

    .tab-item.active {
        color: #0d6efd;
        border-bottom: 3px solid #0d6efd;

    }

    .tab-item::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0;
        height: 3px;
        background-color: var(--primary-color);
        transition: width 0.3s ease;
    }

    .tab-item:hover::after {
        width: 100%;
        text-align: none;
    }

    .tab-item:hover {
        opacity: 0.5;
        text-decoration: none;
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

    .btn-container {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .btn-container a {
        padding: 12px 24px;
        background-color: var(--primary-color);
        color: white;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        font-size: 14px;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .btn-container a:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        text-decoration: none;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 400;
    }

    th,
    td {
        text-align: left;
        padding: 15px 10px;
        border-bottom: 1px solid #f0f0f0;
        color: #333;
    }

    th {
        background-color: #f9f9f9;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    td {
        vertical-align: middle;
    }

    td img {
        border-radius: 5px;
        object-fit: cover;
    }

    tr:hover {
        background-color: #f9f9f9;
        transition: background-color 0.3s ease;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        text-transform: uppercase;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #fff;
    }

    .badge-success {
        background-color: #28a745;
        color: #fff;
    }

    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-icon-text {
        padding: 8px 14px;
        border: 1px solid #ddd;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.3s ease;
        color: #333;
        background-color: white;
        font-size: 14px;
        font-weight: 500;
    }

    .btn-icon-text i {
        margin-right: 8px;
        font-size: 16px;
    }

    .btn-icon-text:hover {
        background-color: #f0f0f0;
        border-color: var(--primary-color);
        color: var(--primary-color);
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }

    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: white;
    }
</style>

<div class="tabs" role="tablist">
    <a href="#" class="tab-item active" data-tab="all">Tất cả ()</a>
    <a href="#" class="tab-item" data-tab="pending">Đơn chờ duyệt ()</a>
    <a href="#" class="tab-item" data-tab="waiting_for_delivery">Đang giao ()</a>
    <a href="#" class="tab-item" data-tab="success">Hoàn thành ()</a>
</div>

<div class="tab-content active" id="tab-all">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tổng sản phẩm</h4>
                    <table id="productTableAll" class="table table-striped">
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
                            <tr>
                                <td></td>
                                <td></td>
                                <td>

                                    <img src="" alt=""
                                        style="width: 80px; height: 80px; border-radius: 5px; object-fit: cover">

                                </td>
                                <td data-order=""></td>
                                <td></td>
                                <td>

                                    <label class="badge badge-warning">Chờ phê duyệt</label>

                                    <label class="badge badge-success">Đang hoạt động</label>
                                    <label class="badge badge-danger">Không hoạt động</label>
                                </td>
                                <td>
                                    <a href=""
                                        class="btn btn-outline-secondary btn-icon-text">
                                        <i class="bi bi-pen"></i> Sửa
                                    </a>
                                    <a href=""
                                        class="btn btn-outline-danger btn-icon-text"><i class="bi bi-trash"></i>
                                        Xóa</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="tab-content" id="tab-active">
    <!-- <img src="{{asset('sellers/assets/images/no-product-found.png')}}"> -->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tổng sản phẩm</h4>
                    <table class="table" id="productTableActive">
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
                            <tr>
                                <td></td>
                                <td></td>
                                <td>

                                    <img src="" alt=""
                                        style="width: 80px; height: 80px; border-radius: 5px; object-fit: cover">

                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="" class="btn btn-outline-secondary btn-icon-text"><i
                                            class="bi bi-pen"></i>
                                        Sửa</a>
                                    <a href="" class="btn btn-outline-danger btn-icon-text"><i
                                            class="bi bi-trash"></i>
                                        Xóa</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

</div>

<div class="tab-content" id="tab-violations">
    <!-- <img src="{{asset('sellers/assets/images/no-product-found.png')}}"> -->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tổng sản phẩm</h4>
                    <table class="table" id="productTableViolations">
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

                            <tr>
                                <td></td>
                                <td></td>
                                <td>

                                    <img src="" alt=""
                                        style="width: 80px; height: 80px; border-radius: 5px; object-fit: cover">

                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="" class="btn btn-outline-secondary btn-icon-text"><i
                                            class="bi bi-pen"></i>
                                        Sửa</a>
                                    <a href="" class="btn btn-outline-danger btn-icon-text"><i
                                            class="bi bi-trash"></i>
                                        Xóa</a>
                                </td>
                            </tr>


                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

</div>
<div class="tab-content" id="tab-pending">
    <!-- <img src="{{asset('sellers/assets/images/no-product-found.png')}}"> -->
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tổng sản phẩm</h4>
                    <table class="table" id="productTablePending">
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
                            <tr>
                                <td></td>
                                <td></td>
                                <td>

                                    <img src="" alt=""
                                        style="width: 80px; height: 80px; border-radius: 5px; object-fit: cover">

                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <a href="" class="btn btn-outline-secondary btn-icon-text"><i
                                            class="bi bi-pen"></i>
                                        Sửa</a>
                                    <a href="" class="btn btn-outline-danger btn-icon-text"><i
                                            class="bi bi-trash"></i>
                                        Xóa</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>



@endsection