@extends('layouts.sellers.app')
@section('content')
<style>
    .tabs {
        display: flex;
        border-bottom: 2px solid #f0f0f0;
        margin-bottom: 20px;
    }

    .tab-item {
        padding: 10px 20px;
        cursor: pointer;
        color: #333;
        text-decoration: none;
    }

    /* Khi tab được active */
    .tab-item.active {
        color: #0d6efd;
        border-bottom: 2px solid #0d6efd;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .card-body {
        position: relative;
    }
</style>

<div class="tab-index" role="tab_list">
    <a href="#" class="tab-item active" data-tab="categories">Danh mục ({{$countCategories}})</a>
    <a href="#" class="tab-item" data-tab="subcategories">Thể loại ({{$countSubCategories}})</a>
</div>

{{-- Hiển thị thông báo thành công --}}
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- Tab Categories -->
<div class="tab-content active" id="tab-categories">
    @if($countCategories <= 0)
    <div class="text-center">
        <img class="no-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
        <p class="text-center mt-3">Chưa có danh mục nào</p>
    </div>
    @else
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table id="productTableAll" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Tên danh mục</th>
                                <th>Hình ảnh</th>
                                <th>Slug</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td></td>
                                <td>{{$item->slug}}</td>
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

<!-- Tab Subcategories -->
<div class="tab-content" id="tab-subcategories">
    @if($countSubCategories <= 0)
    <div class="text-center">
        <img class="no-data-image" src="{{ asset('image/no-data.png') }}" alt="No Data" style="width: 200px;">
        <p class="text-center mt-3">Chưa có sản phẩm nào hoạt động</p>
    </div>
    @else
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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subCategories as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->category->name}}</td>
                                <td></td>
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
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-item');
        const tabContents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const target = this.getAttribute('data-tab');

                // Xóa class active khỏi tất cả tab và nội dung
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(c => c.classList.remove('active'));

                // Thêm class active vào tab và nội dung được chọn
                this.classList.add('active');
                document.getElementById(`tab-${target}`).classList.add('active');
            });
        });
    });
</script>

@endsection