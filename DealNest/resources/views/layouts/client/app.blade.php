<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ogani | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('client/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/header.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/home-product.css')}}" type="text/css">

</head>

<body>

    <!-- Header Section Begin -->
    <header>
        <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="https://salt.tikicdn.com/cache/w500/ts/upload/c0/8b/46/c3f0dc850dd93bfa7af7ada0cbd75dc0.png" alt="Tiki Logo"> <!-- Replace with your logo -->
                Tốt & Nhanh
            </a>
    
            <!-- Search form -->
            <form class="d-flex mx-auto">
                <input class="form-control me-2" type="search" placeholder="100% hàng thật" aria-label="Search">
                <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
            </form>
    
            <!-- Right Side Menu -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tài khoản</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="bi bi-cart" style="font-size: 20px;"></i></a>
                </li>
            </ul>
        </div>
    </nav>
    
    <!-- Secondary Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light secondary-nav">
        <div class="container-fluid">
            <!-- Product Categories -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">điện gia dụng</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">xe cộ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">mẹ & bé</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">khỏe đẹp</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">nhà cửa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">sách</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">thể thao</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">nồi cơm điện</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">máy sấy tóc</a>
                </li>
            </ul>
    
            <!-- addre -->
            <span class="navbar-text">
                Giao đến: <a href="#">H. Giang Thành, X. Vĩnh Điều, Kiên Giang</a>
            </span>
        </div>
    </nav>
    
    <!--  nav Icons  -->
    <nav class="navbar  navbar-light bg-light secondary-nav">
        <div class="container-fluid">
    <div class="container">
        <div class="commitment-section">
            <div>
                <h5></h5>
            </div>
            <div class="commitment-item">
                <i class="bi bi-shield-check"></i>
                <a>Cam kết 100% hàng thật</a>
            </div>
            <div class="commitment-item">
                <i class="bi bi-arrow-repeat"></i>
                <span>Hoàn 200% nếu hàng giả</span>
            </div>
            <div class="commitment-item">
                <i class="bi bi-box-seam"></i>
                <span>30 ngày đổi trả</span>    
            </div>
            <div class="commitment-item">
                <i class="bi bi-truck"></i>
                <span>Giao nhanh 2h</span>
            </div>
            <div class="commitment-item">
                <i class="bi bi-tags"></i>
                <span>Giá siêu rẻ</span>
            </div>
            <div class="commitment-item">
                <i class="bi bi-truck-flatbed"></i>
                <span>Freeship mọi đơn</span>
            </div>
        </div>
    </div>
    </div>
    </nav>
    </header>
    <!-- Header Section End -->



    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="./index.html"><img src="img/logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: 60-49 Road 11378 New York</li>
                            <li>Phone: +65 11.188.888</li>
                            <li>Email: hello@colorlib.com</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Useful Links</h6>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">About Our Shop</a></li>
                            <li><a href="#">Secure Shopping</a></li>
                            <li><a href="#">Delivery infomation</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Our Sitemap</a></li>
                        </ul>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Our Services</a></li>
                            <li><a href="#">Projects</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Innovation</a></li>
                            <li><a href="#">Testimonials</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                        <h6>Join Our Newsletter Now</h6>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#">
                            <input type="text" placeholder="Enter your mail">
                            <button type="submit" class="site-btn">Subscribe</button>
                        </form>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text">
                            <p>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i class="fa fa-heart"
                                    aria-hidden="true"></i> by <a href="https://colorlib.com"
                                    target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                        <div class="footer__copyright__payment"><img src="img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{asset('client/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('client/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('client/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('client/js/jquery-ui.min.js')}}js/jquery-ui.min.js"></script>
    <script src="{{asset('client/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('client/js/mixitup.min.js')}}"></script>
    <script src="{{asset('client/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('client/js/main.js')}}"></script>



</body>

</html>