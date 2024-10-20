@extends('layouts.sellers.app')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .revenue-card {
        width: 300px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        font-family: Arial, sans-serif;
        margin-bottom: 20px;
        position: relative;
        border-top: 5px solid #0288d1;
        margin-right: 20px;
    }

    .revenue-card h3 {
        font-size: 14px;
        color: #666;
        margin-bottom: 5px;
    }

    .revenue-card .amount {
        font-size: 28px;
        font-weight: bold;
        color: #0288d1;
    }

    .revenue-card .amount span {
        font-size: 18px;
        color: #666;
    }

    .revenue-card .amount::after {

        font-size: 16px;
        font-weight: normal;
        color: #666;
    }

    #bestSellingChart {
        max-height: 450px;
    }



    .chart-container {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .chart-item {
        width: 48%;
        /* Mỗi biểu đồ chiếm 48% để có khoảng trống giữa chúng */
        background-color: white;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .chart-item h3 {
        text-align: center;
        margin-bottom: 20px;
        font-family: Arial, sans-serif;
        font-size: 16px;
        color: #0288d1;
    }

    canvas {
        max-height: 400px;
    }

    .list {
        display: flex;
    }

    .page-title {
        text-align: left;
        font-size: 24px;
        margin-bottom: 20px;
    }
</style>
<div class="page-title">
    <h1>Thống Kê Sản Phẩm</h1>
</div>
<!-- Thẻ hiển thị tổng doanh thu -->
<div class="list">
    <div class="revenue-card">
        <h3>Tổng số lượt bán sản phẩm bán chạy</h3>
        <div class="amount">{{$countSales}} <span>lượt bán</span></div>

        <!-- SVG đường cong -->
        <svg class="curve" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 50" preserveAspectRatio="none">
            <path d="M0,50 C150,30 350,30 500,50 L500,00 L0,0 Z" style="stroke: none; fill: #81d4fa;"></path>
        </svg>
    </div>
    <div class="revenue-card">
        <h3>Tồn kho</h3>
        <div class="amount">{{$inventory<0 ? '0' : $inventory}}</div>

        <!-- SVG đường cong -->
        <svg class="curve" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 50" preserveAspectRatio="none">
            <path d="M0,50 C150,30 350,30 500,50 L500,00 L0,0 Z" style="stroke: none; fill: #81d4fa;"></path>
        </svg>
    </div>
</div>
<!-- Container chứa hai biểu đồ đường -->
<div class="chart-container">
    <div class="chart-item">
        <h3>Biểu đồ sản phẩm bán chạy</h3>
        <canvas id="bestSellingLineChart"></canvas>
    </div>

    <div class="chart-item">
        <h3>Thống kê lượt bán trong tháng</h3>
        <canvas id="topSellingProductsChart"></canvas>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Danh sách sản phẩm bán chạy</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> Hình ảnh </th>
                                <th> Tên </th>
                                <th> Giá </th>
                                <th> Yêu thích </th>
                                <th> Xem chi tiết </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bestSeller as $item)
                            <tr>
                                <td>
                                    <img src="{{asset('uploads/'.$item->image)}}" class="me-2" alt="image"> wefwfwefwe
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($item->name, 25, '...') }}</td>
                                <td>
                                    {{ number_format($item->price, 0, ',', '.') }} vnđ
                                </td>
                                <td>{{$item->favourite}} lượt</td>
                                <td>
                                    <a href="{{route('seller.productStatistics.detail',['id'=>$item->id])}}" class="btn btn-outline-info btn-icon-text"> Xem chi tiết <i class="mdi mdi-printer btn-icon-append"></i>
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
</div>
<script>
    var ctx = document.getElementById('bestSellingLineChart').getContext('2d');

    // Lấy dữ liệu từ server (dữ liệu được truyền từ controller)
    var productNames = @json($bestSeller -> pluck('name')).map(function(name) {
        return name.length > 10 ? name.substring(0, 10) + '...' : name; // Cắt tên sản phẩm còn 10 ký tự
    });
    var productSales = @json($bestSeller -> pluck('sales'));

    var bestSellingChart = new Chart(ctx, {
        type: 'bar', // Loại biểu đồ cột
        data: {
            labels: productNames, // Tên các sản phẩm (đã cắt ngắn)
            datasets: [{
                    label: 'Số lượng bán',
                    data: productSales, // Số lượng bán của các sản phẩm tương ứng
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', // Màu khác nhau cho từng cột
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(201, 203, 207, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(201, 203, 207, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                },
                {
                    type: 'line', // Thêm loại biểu đồ đường
                    label: 'Xu hướng bán hàng',
                    data: productSales, // Dùng lại số lượng bán cho đường xu hướng
                    borderColor: 'rgba(54, 162, 235, 1)', // Màu xanh dương cho đường biểu đồ
                    fill: false,
                    tension: 0.4 // Tạo đường cong cho biểu đồ đường
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });



    var topSellingProductsCtx = document.getElementById('topSellingProductsChart').getContext('2d');
    var topSellingProductsData = @json($topProductsData);
    var productLabels = [];
    var productQuantities = [];

    // Lặp qua từng tháng và thêm tên sản phẩm cắt ngắn vào mảng
    Object.keys(topSellingProductsData).forEach(function(month) {
        topSellingProductsData[month].forEach(function(product) {
            // Cắt tên sản phẩm chỉ còn 10 ký tự
            var shortenedName = product.product_name.length > 10 ? product.product_name.substring(0, 10) + '...' : product.product_name;
            productLabels.push(shortenedName + ' (Tháng ' + month + ')');
            productQuantities.push(product.total_quantity);
        });
    });

    var ctx = document.getElementById('topSellingProductsChart').getContext('2d');

    // Dữ liệu từ backend
    var topProductsData = @json($topProductsData);

    var productLabels = [];
    var productQuantities = [];

    // Lặp qua dữ liệu từng tháng để tạo nhãn sản phẩm và số lượng
    Object.keys(topProductsData).forEach(function(month) {
        topProductsData[month].forEach(function(product) {
            // Cắt tên sản phẩm chỉ còn 10 ký tự nếu dài quá
            var shortenedName = product.product_name.length > 10 ? product.product_name.substring(0, 10) + '...' : product.product_name;
            productLabels.push(shortenedName + ' (Tháng ' + month + ')');
            productQuantities.push(product.total_quantity);
        });
    });

    var ctx = document.getElementById('topSellingProductsChart').getContext('2d');

    // Dữ liệu từ backend
    var topProductsData = @json($topProductsData);

    var productLabels = [];
    var productQuantities = [];

    // Lặp qua dữ liệu từng tháng để tạo nhãn sản phẩm và số lượng
    Object.keys(topProductsData).forEach(function(month) {
        topProductsData[month].forEach(function(product) {
            // Cắt tên sản phẩm chỉ còn 10 ký tự nếu dài quá
            var shortenedName = product.product_name.length > 10 ? product.product_name.substring(0, 10) + '...' : product.product_name;
            productLabels.push(shortenedName + ' (Tháng ' + month + ')');
            productQuantities.push(product.total_quantity);
        });
    });

    // Tạo biểu đồ cột và đường cho dữ liệu động
    var topSellingProductsCtx = document.getElementById('topSellingProductsChart').getContext('2d');
    var topSellingProductsData = @json($topProductsData);
    var productLabels = [];
    var productQuantities = [];

    // Lặp qua từng tháng và thêm tên sản phẩm cắt ngắn vào mảng
    Object.keys(topSellingProductsData).forEach(function(month) {
        topSellingProductsData[month].forEach(function(product) {
            // Cắt tên sản phẩm chỉ còn 10 ký tự
            var shortenedName = product.product_name.length > 10 ? product.product_name.substring(0, 10) + '...' : product.product_name;
            productLabels.push(shortenedName + ' (Tháng ' + month + ')');
            productQuantities.push(product.total_quantity);
        });
    });

    var topSellingProductsChart = new Chart(topSellingProductsCtx, {
        type: 'line', // Hoặc 'bar' nếu muốn biểu đồ cột
        data: {
            labels: productLabels,
            datasets: [{
                label: 'Số lượng bán',
                data: productQuantities,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2,
                fill: false,
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection