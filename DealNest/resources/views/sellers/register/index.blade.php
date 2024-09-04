<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopee - Become a Seller</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .header-wrapper {
            background-color: #fff;
            padding: 10px;
        }

       

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 900px;
            height: 500px;
        }

        .logo {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .logo img {
            width: 30px;
            margin-right: 10px;
        }

        .logo h1 {
            font-size: 1.5rem;
            color: #ff3333;
            margin: 0;
        }

        .illustration {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .illustration img {
            width: 200px;
        }

        .message {
            text-align: center;
            margin-bottom: 50px;
        }

        .button {
            display: block;
            width: 100%;
            background-color: #ff3333;
            color: #fff;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }

    </style>
</head>
<body>
  
    <div class="header-wrapper">
        <h2>Đăng ký trở thành Người bán Shopee</h2>
        <h2>Session user: {{Session('seller_register_name')}}</h2>
        <h2>Session user: {{Session('seller_register_id')}}</h2>
    </div>
    <div class="container">
        <div class="card">
            <div class="logo">
                <img src="https://www.shopee.vn/favicon.ico" alt="Shopee Logo">
                <h1>Shoppe</h1>
            </div>
            <div class="illustration">
                <img src="https://deo.shopeesz.com/shopee/pap-admin-live-sg/upload/upload_9dab85081088531ee6d1aa958a90f55e.png" alt="Shopee Seller Illustration">
            </div>
            <div class="message">
                <p>Vui lòng cung cấp thông tin để thành lập tài khoản người bán trên Shopee</p>
            </div>
            <a href="{{route('seller.register.form')}}" class="button">Bắt đầu đăng ký</a>
        </div>
    </div>
</body>
</html>