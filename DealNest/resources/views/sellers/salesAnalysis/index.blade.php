@extends('layouts.sellers.app')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    .revenue-list {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        /* Khoảng cách giữa các thẻ */
        width: 100%;
    }

    .revenue-card {
        flex: 1 1 calc(20% - 20px);
        /* Mỗi thẻ sẽ chiếm 20% chiều rộng trừ đi khoảng cách */
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        font-family: Arial, sans-serif;
        margin-bottom: 20px;
        position: relative;
        border-top: 5px solid #0288d1;
        box-sizing: border-box;
    }

    /* Màu cho các trạng thái */
    .revenue-card.pending-confirmation h3,
    .revenue-card.pending-confirmation .amount {
        color: #ff9800;
        /* Màu cam cho "Chờ xác nhận" */
    }

    .revenue-card.pending-pickup h3,
    .revenue-card.pending-pickup .amount {
        color: #03a9f4;
        /* Màu xanh pending cho "Chờ lấy hàng" */
    }

    .revenue-card.cancelled h3,
    .revenue-card.cancelled .amount {
        color: #f44336;
        /* Màu đỏ cho "Đơn hủy" */
    }

    .revenue-card.completed h3,
    .revenue-card.completed .amount {
        color: #4caf50;
        /* Màu xanh success cho "Hoàn thành" */
    }

    /* Đổi màu đường cong SVG theo trạng thái */
    .revenue-card.pending-confirmation .curve path {
        fill: #ffe0b2;
        /* Màu nhạt cho "Chờ xác nhận" */
    }

    .revenue-card.pending-pickup .curve path {
        fill: #b3e5fc;
        /* Màu nhạt cho "Chờ lấy hàng" */
    }

    .revenue-card.cancelled .curve path {
        fill: #ffcdd2;
        /* Màu nhạt cho "Đơn hủy" */
    }

    .revenue-card.completed .curve path {
        fill: #c8e6c9;
        /* Màu nhạt cho "Hoàn thành" */
    }

    .revenue-card h3 {
        font-size: 14px;
        color: #ff5722;
        /* Màu tiêu đề trong card - đổi thành màu cam */
        margin-bottom: 5px;
    }

    .revenue-card .amount {
        font-size: 28px;
        font-weight: bold;
        color: #37474f;
        /* Màu chữ cho số liệu - đổi thành màu xám đậm */
    }

    .revenue-card .amount::after {
        content: ' đơn';
        font-size: 16px;
        font-weight: normal;
        color: #607d8b;
        /* Màu chữ nhỏ hơn - đổi thành màu xám nhạt */
    }

    #statusChart,
    #followerChart {
        max-height: 350px;
    }

    .chart-container {
        width: 100%;
        margin: 0;
    }

    .chart-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 20px;
    }

    .chart-item {
        flex: 1;
        padding: 20px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .page-title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        /* Màu tiêu đề chính */
        margin-bottom: 30px;
    }

    /* Đổi màu chữ cho tiêu đề biểu đồ */
    .chart-item h3 {
        font-size: 16px;
        color: #009688;
        /* Màu chữ tiêu đề của biểu đồ - đổi thành màu xanh ngọc */
    }
</style>

<!-- Tiêu đề chính của trang -->
<div class="page-title">
    Thống Kê Doanh Thu & Người Theo Dõi
</div>

<!-- Thẻ hiển thị tổng số đơn hàng chờ xử lý -->
<!-- Thẻ hiển thị tổng số đơn hàng chờ xử lý -->
<div class="revenue-list">
    <div class="revenue-card pending-confirmation">
        <h3>Chờ xác nhận</h3>
        <div class="amount">{{ $pending < 0 ? '0' : $pending }}</div>
        <svg class="curve" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 50" preserveAspectRatio="none">
            <path d="M0,50 C150,30 350,30 500,50 L500,00 L0,0 Z" style="stroke: none; fill: #81d4fa;"></path>
        </svg>
    </div>

    <div class="revenue-card pending-pickup">
        <h3>Chờ lấy hàng</h3>
        <div class="amount">{{$waitingForDelivery < 0 ? '0' : $waitingForDelivery}}</div>
        <svg class="curve" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 50" preserveAspectRatio="none">
            <path d="M0,50 C150,30 350,30 500,50 L500,00 L0,0 Z" style="stroke: none; fill: #81d4fa;"></path>
        </svg>
    </div>

    <div class="revenue-card cancelled">
        <h3>Đơn hủy</h3>
        <div class="amount">{{$buyerCancel < 0 ? '0' : $buyerCancel}}</div>
        <svg class="curve" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 50" preserveAspectRatio="none">
            <path d="M0,50 C150,30 350,30 500,50 L500,00 L0,0 Z" style="stroke: none; fill: #81d4fa;"></path>
        </svg>
    </div>

    <div class="revenue-card completed">
        <h3>Hoàn thành</h3>
        <div class="amount">{{$success < 0 ? '0' : $success}}</div>
        <svg class="curve" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 50" preserveAspectRatio="none">
            <path d="M0,50 C150,30 350,30 500,50 L500,00 L0,0 Z" style="stroke: none; fill: #81d4fa;"></path>
        </svg>
    </div>

    <!-- Thẻ thứ 5 rơi xuống hàng dưới -->
    <div class="revenue-card rejected">
        <h3>Sản phẩm từ chối</h3>
        <div class="amount">{{$cancel < 0 ? '0' : $cancel}}</div>
        <svg class="curve" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 50" preserveAspectRatio="none">
            <path d="M0,50 C150,30 350,30 500,50 L500,00 L0,0 Z" style="stroke: none; fill: #81d4fa;"></path>
        </svg>
    </div>

</div>


<!-- Biểu đồ thống kê doanh thu và người theo dõi -->
<div class="chart-row">
    <div class="chart-item">
        <h3 style="text-align: center;">Thống kê doanh thu</h3>
        <canvas id="revenueChart"></canvas>
    </div>

    <div class="chart-item">
        <h3 style="text-align: center;">Thống kê người dùng</h3>
        <canvas id="user"></canvas>
    </div>
</div>

<script>
    // Biểu đồ thống kê doanh thu
    var revenueCtx = document.getElementById('revenueChart').getContext('2d');
    var revenueChart = new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'],
            datasets: [{
                label: 'Doanh thu (triệu VND)',
                data: @json($revenueData),
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
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


    // Lấy dữ liệu người dùng từ backend
    var userData = @json($userData); // Dữ liệu từ backend về số lượng người dùng

    var ctxUser = document.getElementById('user').getContext('2d');
    var monthlyUserLineChart = new Chart(ctxUser, {
        type: 'line', // Biểu đồ đường
        data: {
            labels: ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'], // Tên các tháng
            datasets: [
                {
                    label: 'Số lượng người dùng',
                    data: userData, // Dữ liệu người dùng theo tháng
                    borderColor: 'rgba(255, 99, 132, 1)', // Màu đường
                    backgroundColor: 'rgba(255, 99, 132, 0.2)', // Màu nền trong suốt
                    fill: false, // Không tô màu phía dưới đường
                    tension: 0.3, // Độ cong của đường
                    pointBackgroundColor: 'rgba(255, 99, 132, 1)', // Màu của điểm trên đường biểu đồ
                    pointRadius: 4, // Kích thước của điểm
                    borderWidth: 2, // Độ dày của đường
                }
            ]
        },
        options: {
            plugins: {
                legend: {
                    display: true, // Hiển thị chú thích
                    labels: {
                        color: '#000' // Màu chữ của chú thích
                    }
                },
                title: {
                    display: true,
                    text: 'Thống kê số lượng người dùng theo tháng', // Tiêu đề biểu đồ
                    color: '#007bff', // Màu của tiêu đề
                    font: {
                        size: 18
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true, // Bắt đầu từ 0
                    ticks: {
                        color: '#000' // Màu của trục y
                    }
                },
                x: {
                    ticks: {
                        color: '#000' // Màu của trục x
                    }
                }
            }
        }
    });
</script>

@endsection