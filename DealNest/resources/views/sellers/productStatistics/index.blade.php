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

    .revenue-card .amount::after {
        content: ' lượt bán';
        font-size: 16px;
        font-weight: normal;
        color: #666;
    }

    #bestSellingChart {
        max-height: 450px;
    }



    .chart-container {
        width: 100%;
        margin: 0;
    }
</style>

<!-- Thẻ hiển thị tổng doanh thu -->
<div class="revenue-card">
    <h3>Tổng số lượt bán sản phẩm bán chạy</h3>
    <div class="amount">{{$countSales}}</div>

    <!-- SVG đường cong -->
    <svg class="curve" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 50" preserveAspectRatio="none">
        <path d="M0,50 C150,30 350,30 500,50 L500,00 L0,0 Z" style="stroke: none; fill: #81d4fa;"></path>
    </svg>
</div>

<!-- Biểu đồ sản phẩm bán chạy -->
<div class="chart-container">
    <canvas id="bestSellingChart"></canvas>
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
    var ctx = document.getElementById('bestSellingChart').getContext('2d');

    // Lấy dữ liệu từ server (dữ liệu được truyền từ controller)
    var productNames = @json($bestSeller -> pluck('name'));
    var productSales = @json($bestSeller -> pluck('sales'));

    var bestSellingChart = new Chart(ctx, {
        type: 'bar', // Loại biểu đồ cột
        data: {
            labels: productNames, // Tên các sản phẩm
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
</script>
@endsection