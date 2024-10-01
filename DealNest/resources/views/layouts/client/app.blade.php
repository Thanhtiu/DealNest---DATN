<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Ogani | Template</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    {{--
    <link rel="stylesheet" href="{{asset('client/css/bootstrap.min.css')}}" type="text/css"> --}}
    <link rel="stylesheet" href="{{asset('client/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/elegant-icons.css')}}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{--
    <link rel="stylesheet" href="{{asset('client/css/nice-select.css')}}" type="text/css"> --}}
    {{--
    <link rel="stylesheet" href="{{asset('client/css/jquery-ui.min.css')}}" type="text/css"> --}}
    {{--
    <link rel="stylesheet" href="{{asset('client/css/owl.carousel.min.css')}}" type="text/css"> --}}
    {{--
    <link rel="stylesheet" href="{{asset('client/css/slicknav.min.css')}}" type="text/css"> --}}
    <link rel="stylesheet" href="{{asset('client/css/style.css')}}" type="text/css">
    {{--
    <link rel="stylesheet" href="{{asset('client/css/spinner.css')}}" type="text/css"> --}}
    <link rel="stylesheet" href="{{asset('client/css/header.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/css/home-product.css')}}" type="text/css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">


</head>

<body>

    <!-- Header Section Begin -->
    <header>
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- Logo -->
                <a class="navbar-brand" href="{{route('client.index')}}">
                    <img src="{{asset('image/dealnest-logo.png')}}"
                        alt="Tiki Logo"> <!-- Replace with your logo -->
                    Mua sắm & Trò truyện
                </a>

                <!-- Search form -->
                <form class="d-flex mx-auto" action="{{route('client.search')}}" method="POST">
                    @csrf
                    <input class="form-control me-2" type="text" placeholder="100% hàng thật" aria-label="Search"
                        name="key">
                    <button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
                </form>

                <!-- Right Side Menu -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('seller.index')}}">Kênh người bán</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        @if(Auth::check())
                        <a class="nav-link" href="{{route('account.profile.index')}}">{{ Auth::user()->name }}</a>
                        @else
                        <a class="nav-link" href="{{route('account.login')}}">Đăng nhập</a>
                        @endif
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
                    @if(Session::has('stringAddress'))
                    Giao đến: <a href="{{route('account.address.index')}}">{{ Session::get('stringAddress') }}</a>
                    @else
                    <a href="{{ route('account.address.index') }}">Cập nhật địa chỉ</a>
                    @endif

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


    {{-- <div class="container">
        <div class="loader-client" id="loader-client">
            <svg class="pl" width="240" height="240" viewBox="0 0 240 240">
                <circle class="pl__ring pl__ring--a" cx="120" cy="120" r="105" fill="none" stroke="#000"
                    stroke-width="20" stroke-dasharray="0 660" stroke-dashoffset="-330" stroke-linecap="round">
                </circle>
                <circle class="pl__ring pl__ring--b" cx="120" cy="120" r="35" fill="none" stroke="#000"
                    stroke-width="20" stroke-dasharray="0 220" stroke-dashoffset="-110" stroke-linecap="round">
                </circle>
                <circle class="pl__ring pl__ring--c" cx="85" cy="120" r="70" fill="none" stroke="#000" stroke-width="20"
                    stroke-dasharray="0 440" stroke-linecap="round"></circle>
                <circle class="pl__ring pl__ring--d" cx="155" cy="120" r="70" fill="none" stroke="#000"
                    stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
            </svg>
        </div>
    </div> --}}
    @yield('content')

    <!-- Footer Section Begin -->
    <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div></div>
                <div class="col-md-3 ">
                    <div class="footer__widget">
                        <h6> CHĂM SÓC KHÁCH HÀNG </h6>
                        <ul>
                            <li><a href="#">Trung Tâm Trợ Giúp </a></li>
                            <li><a href="#">Shoppe Mall</a></li>
                            <li><a href="#">Thanh Toán</a></li>
                            <li><a href="#">Shopee Xu</a></li>
                            <li><a href="#">Vận Chuyển</a></li>
                            <li><a href="#">Trả Hàng và Hoàn Tiền </a></li>
                            <li><a href="#">Liên Hệ Shopee</a></li>
                            <li><a href="#">Chính Sách Bảo Hành </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer__widget">
                        <h6>VỀ SHOPEE</h6>
                        <ul>
                            <li><a href="#">Giới Thiệu Về Shopee </a></li>
                            <li><a href="#">Tuyển Dụng </a></li>
                            <li><a href="#">Điều Khoản Shopee</a></li>
                            <li><a href="#">Chính Sách Bảo Mật </a></li>
                            <li><a href="#">Chính Hãng</a></li>
                            <li><a href="#">Flash Sale </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="footer__widget">
                        <h6>THANH TOÁN</h6>
                        <img src="{{asset('client/img/footer/jcb.jpg')}}"  style="width: 50px; margin: 0 10px;">
                        <img src="{{asset('client/img/footer/mastercard.jpg')}}" alt="Image 2" style="width: 50px; margin: 0 10px;">
                        <img src="{{asset('client/img/footer/mbbank.jpg')}}" alt="Image 3" style="width: 50px; margin: 0 10px;">
                        <img src="{{asset('client/img/footer/shoppepay.png')}}" alt="Image 4" style="width: 50px; margin: 0 10px;">
                        <img src="{{asset('client/img/footer/tragop.png')}}" alt="Image 1" style="width: 50px; margin: 0 10px;">
                        <img src="{{asset('client/img/footer/visa.png')}}" alt="Image 3" style="width: 50px; margin: 0 10px;">
                    </div>
                    <div class="footer__widget">
                        <h6>ĐƠN VỊ VẬN CHUYỂN </h6>
                        <img src="{{asset('client/img/footer/best.png')}}" alt="Image 1" style="width: 50px; margin: 0 10px;">
                        <img src="{{asset('client/img/footer/ghn.jpg')}}" alt="Image 2" style="width: 50px; margin: 0 10px;">
                        <img src="{{asset('client/img/footer/ghtk.png')}}" alt="Image 3" style="width: 50px; margin: 0 10px;">
                        <img src="{{asset('client/img/footer/grab.webp')}}" alt="Image 4" style="width: 50px; margin: 0 10px;">
                        <img src="{{asset('client/img/footer/jt-express.jpg')}}" alt="Image 1" style="width: 50px; margin: 0 10px;">
                        <img src="{{asset('client/img/footer/ninja.png')}}" alt="Image 2" style="width: 50px; margin: 0 10px;">
                        <img src="{{asset('client/img/footer/shoppeexpress.png')}}" alt="Image 3" style="width: 50px; margin: 0 10px;">
                        <img src="{{asset('client/img/footer/vnpost.png')}}" alt="Image 3" style="width: 50px; margin: 0 10px;">
                    </div>
              
            </div>
            <div class="col-md-3">
                <div class="footer__widget">
                    <h6>THEO DÕI CHÚNG TÔI TRÊN </h6>
                    <div class="footer__widget__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>

                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <!-- <script src="{{asset('client/js/jquery-3.3.1.min.js')}}"></script> -->
    
    {{-- <script src="{{asset('client/js/spinner.js')}}"></script> --}}
    <script src="{{asset('client/js/cart-delete.js')}}"></script>
    <script src="{{asset('client/js/cart-create.js')}}"></script>
    <script src="{{asset('client/js/profile.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{asset('client/js/bootstrap.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    {{-- <script src="{{asset('client/js/jquery.nice-select.min.js')}}"></script> --}}
    {{-- <script src="{{asset('client/js/jquery-ui.min.js')}}js/jquery-ui.min.js"></script> --}}
    {{-- <script src="{{asset('client/js/jquery.slicknav.js')}}"></script> --}}
    {{-- <script src="{{asset('client/js/mixitup.min.js')}}"></script> --}}
    {{-- <script src="{{asset('client/js/owl.carousel.min.js')}}"></script> --}}
    <script src="{{asset('client/js/main.js')}}"></script>
    <script>
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
    </script>

    {{-- Category Ajax --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
    <script>
        // Button Click
        const buttons = document.querySelectorAll('.price-option');
        console.log(buttons);
        buttons.forEach(button => {
            button.onclick = function() {
                const value = this.value;
                var url = "{{ url()->current() }}?";
                window.location.href = url + "sortby=" + value;
            };
        });

        // Onchange Select 
        $('#sort-category').change(function() {

        const selectedValue = $(this).val(); 

        var url = "{{ url()->current() }}?";

        window.location.href = url + "sortby=" + selectedValue;
    });

    // Checkbox Adress

    $(".province").change(function(){
        apply_filters();
    });

    function apply_filters(){

        var province = [];

        $('.province').each(function(){
            if($(this).is(":checked") == true){

                province.push($(this).val());   
            }
        });

        $.ajax({
            url: "{{ route('category.productAddress') }}", 
            type: "POST", 
            data: {
                _token: "{{ csrf_token() }}", 
                province: province,
            },
            success: function(response) {
                // Xử lý kết quả khi gửi thành công
                if(response.success){
                    $.each(response.data,function(key,value){

                        console.log('key ' + key + "value " + value);

                        
                    })
                }
                console.log(response.message);
            },
            error: function(xhr) {

                console.log(xhr.responseText);
            }
        });

    }




    </script>

</body>

</html>