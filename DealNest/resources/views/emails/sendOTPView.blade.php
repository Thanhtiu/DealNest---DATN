<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực tài khoản</title>
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f7;
            margin: 0;
            padding: 0;
            color: #51545e;
        }
        .email-container {
            background-color: #ffffff;
            width: 100%;
            max-width: 600px;
            margin: 30px auto;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #007bff; /* Màu primary */
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 24px;
        }
        .email-header img {
            max-width: 120px; /* Chỉnh kích thước logo */
            margin-bottom: 10px;
        }
        .email-body {
            padding: 20px;
        }
        h1 {
            font-size: 22px;
            color: #333333;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            color: #51545e;
        }
        .otp-code {
            font-size: 28px;
            font-weight: bold;
            color: #007bff; /* Màu primary */
            letter-spacing: 2px;
            text-align: center;
            margin: 20px 0;
        }
        .footer {
            background-color: #f4f4f7;
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: #a0a3ab;
        }
        .footer a {
            color: #007bff; /* Màu primary */
            text-decoration: none;
        }
        .btn {
            display: inline-block;
            padding: 12px 20px;
            background-color: #007bff; /* Màu primary */
            color: white;
            text-align: center;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            margin: 20px 0;
        }
        .btn:hover {
            background-color: #0069d9; /* Màu primary đậm hơn */
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <!-- Thêm logo cửa hàng -->
            <img src="{{ asset('image/dealnest-logo.png') }}" alt="Logo Cửa Hàng">
            Xác thực tài khoản
        </div>
        <div class="email-body">
            <h1>Chào mừng bạn đến với dịch vụ của chúng tôi!</h1>
            <p>Chúng tôi rất vui khi bạn đăng ký tài khoản. Để hoàn tất quá trình đăng ký, vui lòng sử dụng mã OTP dưới đây để xác thực tài khoản của bạn.</p>

            <div class="otp-code">
                {{ $otp }}
            </div>

            <p>Mã OTP này sẽ hết hạn sau 10 phút, vui lòng không chia sẻ mã này cho bất kỳ ai.</p>

            <a href="#" class="btn">Xác thực ngay</a>

            <p>Nếu bạn không thực hiện yêu cầu này, vui lòng bỏ qua email này.</p>
        </div>
        <div class="footer">
            <p>Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
            <p>Liên hệ chúng tôi: <a href="mailto:dealnest@gmail.com">dealnest@gmail.com</a></p>
        </div>
    </div>
</body>
</html>
