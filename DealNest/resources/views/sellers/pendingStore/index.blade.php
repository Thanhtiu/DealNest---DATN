<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cửa hàng đang chờ duyệt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }
        .status {
            color: #ff8800;
            font-weight: bold;
        }
        .illustration {
            width: 100%;
            max-width: 300px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-body">
                        <!-- Thêm hình ảnh -->
                        <img src="{{asset('/image/pendingStore.jpg')}}" alt="Đang chờ duyệt" class="illustration">
                        <h3 class="mb-4">Cửa hàng của bạn đang chờ duyệt</h3>
                        <p class="mb-4">Thông tin của bạn đã được gửi thành công. Vui lòng đợi quản trị viên duyệt yêu cầu. Quá trình này có thể mất đến 24 giờ.</p>
                        <p class="status">Trạng thái: Đang chờ duyệt</p>
                        <!-- Sửa link và nút -->
                        <a href="/" class="btn btn-primary mt-3">Quay lại Trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
