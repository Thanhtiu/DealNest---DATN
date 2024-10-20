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

th, td {
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

@if($topUsers->count() <= 0)
  <img src="{{ asset('sellers/assets/images/no-product-found.png') }}">
@else
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Top người mua hàng nhiều nhất</h4>
          <table class="table" id="userTableAll">
            <thead>
              <tr>
                <th>Hình ảnh</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Số lượng hàng đã mua</th>
              </tr>
            </thead>
            <tbody>
              @foreach($topUsers as $user)
              <tr>
                <td>
                <img src="{{ asset('uploads/' . ($user['user']->image === 'default_avt.png' ? 'default_avt.png' :$user['user']->image )) }}" alt="User Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                </td>
                <td>{{ \Illuminate\Support\Str::limit($user['user']->full_name, 25, '...') }}</td>
                <td>{{ \Illuminate\Support\Str::limit($user['user']->email, 25, '...') }}</td>
                <td>{{ $user['total_items'] }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endif

  <script>
        $(document).ready(function() {
            // Khởi tạo DataTable
            $('#userTableAll').DataTable({
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
                    '<"row"<"col-md-5"i><"col-md-7"p>>'
            });
        });
    </script>

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
        datasets: [{
          label: 'Số lượng người dùng',
          data: userData, // Dữ liệu người dùng theo tháng
          borderColor: 'rgba(255, 99, 132, 1)', // Màu đường
          backgroundColor: 'rgba(255, 99, 132, 0.2)', // Màu nền trong suốt
          fill: false, // Không tô màu phía dưới đường
          tension: 0.3, // Độ cong của đường
          pointBackgroundColor: 'rgba(255, 99, 132, 1)', // Màu của điểm trên đường biểu đồ
          pointRadius: 4, // Kích thước của điểm
          borderWidth: 2, // Độ dày của đường
        }]
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