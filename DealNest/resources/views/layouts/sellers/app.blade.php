<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- Bootstrap 4 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap 4 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- DataTables Bootstrap 4 JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>




    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('sellers/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <!-- <link rel="stylesheet" href="{{asset('sellers/assets/vendors/ti-icons/css/themify-icons.css')}}"> -->
    <!-- <link rel="stylesheet" href="{{asset('sellers/assets/vendors/css/vendor.bundle.base.css')}}"> -->
    <!-- <link rel="stylesheet" href="{{asset('sellers/assets/vendors/font-awesome/css/font-awesome.min.css')}}"> -->
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- <link rel="stylesheet" href="{{asset('sellers/assets/vendors/font-awesome/css/font-awesome.min.css')}}" /> -->
    <!-- <link rel="stylesheet" href="{{asset('sellers/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}"> -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('sellers/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('sellers/assets/css/spinner.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('sellers/assets/images/favicon.png')}}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.css">


</head>
<style>
    /* Style cho dropdown chọn số lượng mục */
    .dataTables_length select {
        padding: 5px 20px;
        border: 2px solid #ff5722;
        border-radius: 8px;
        font-size: 14px;
        color: #333;
        background-color: #fff;
        cursor: pointer;
        transition: border 0.3s ease;
        outline: none;
    }

    .dataTables_length select:focus {
        border: 2px solid #ff8a50;
    }

    .dataTables_length label {
        font-weight: bold;
        color: #333;
    }

    /* Style cho input tìm kiếm */
    .dataTables_filter input {
        border: 2px solid #ff5722;
        border-radius: 25px;
        padding: 8px 15px 8px 35px;
        /* Tạo không gian cho icon */
        width: 300px;
        font-size: 14px;
        transition: border 0.3s ease;
        outline: none;
        background: url('https://cdn-icons-png.flaticon.com/512/622/622669.png') no-repeat scroll 10px 8px;
        background-size: 20px 20px;
    }

    .dataTables_filter input:focus {
        border: 1px solid #ff5722;
    }

    .dataTables_filter label {
        font-weight: bold;
        color: #333;
        margin-right: 10px;
    }

    .dataTables_wrapper .dataTables_filter input::placeholder {
        color: #aaa;
        font-style: italic;
    }
    .no-data-image{
        margin-top: 5%;
    }
</style>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="dealnest-logo">
                    <a class="navbar-brand brand-logo" href="{{route('seller.index')}}"><img class="seller-logo-image"
                            src="{{asset('image/dealnest-logo.png')}}" alt="logo" /></a>
                </div>
                <a class="navbar-brand brand-logo-mini" href="index.html"><img src="assets/images/logo-mini.svg"
                        alt="logo" /></a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-stretch">
                {{-- <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button> --}}
                <div class="search-field d-none d-md-block">
                    {{-- <form class="d-flex align-items-center h-100" action="#">
                        <div class="input-group">
                            <div class="input-group-prepend bg-transparent">
                                <i class="input-group-text border-0 mdi mdi-magnify"></i>
                            </div>
                            <input type="text" class="form-control bg-transparent border-0"
                                placeholder="Search projects">
                        </div>
                    </form> --}}
                </div>
                <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="nav-profile-img">
                                <img src="{{asset('sellers/assets/images/faces/face1.jpg')}}" alt="image">
                                <span class="availability-status online"></span>
                            </div>
                            <div class="nav-profile-text">
                                <p class="mb-1 text-black"> {{Auth::user()->name}} </p>
                            </div>
                        </a>
                        <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href=" {{route('account.logout')}} ">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Đăng xuất </a>
                        </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                        <a class="nav-link">
                            <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="mdi mdi-email-outline"></i>
                            <span class="count-symbol bg-warning"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                            aria-labelledby="messageDropdown">
                            <h6 class="p-3 mb-0">Messages</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message
                                    </h6>
                                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{asset('sellers/assets/images/faces/face2.jpg')}}" alt="image"
                                        class="profile-pic">
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a
                                        message</h6>
                                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <img src="{{asset('sellers/assets/images/faces/face3.jpg')}}" alt="image"
                                        class="profile-pic">
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated
                                    </h6>
                                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">4 new messages</h6>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                            data-bs-toggle="dropdown">
                            <i class="mdi mdi-bell-outline"></i>
                            <span class="count-symbol bg-danger"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list"
                            aria-labelledby="notificationDropdown">
                            <h6 class="p-3 mb-0">Notifications</h6>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="mdi mdi-calendar"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today
                                    </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="mdi mdi-cog"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item preview-item">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-info">
                                        <i class="mdi mdi-link-variant"></i>
                                    </div>
                                </div>
                                <div
                                    class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                                </div>
                            </a>
                            <div class="dropdown-divider"></div>
                            <h6 class="p-3 mb-0 text-center">See all notifications</h6>
                        </div>
                    </li>
                    <li class="nav-item nav-logout d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-power"></i>
                        </a>
                    </li>
                    <li class="nav-item nav-settings d-none d-lg-block">
                        <a class="nav-link" href="#">
                            <i class="mdi mdi-format-line-spacing"></i>
                        </a>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item nav-profile">
                        <a href="#" class="nav-link">
                            <div class="nav-profile-image">
                                <img src="{{asset('sellers/assets/images/faces/face1.jpg')}}" alt="profile" />
                                <span class="login-status online"></span>
                                <!--change to offline or busy as needed-->
                            </div>
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2"> {{Auth::user()->name}} </span>
                                <span class="text-secondary text-small">Project Manager</span>
                            </div>
                            <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <span class="menu-title">Thống kê</span>
                            <i class="mdi mdi-home menu-icon"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#orderMenu" aria-expanded="false" aria-controls="orderMenu">
                            <span class="menu-title">Quản lý đơn hàng</span>
                            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                        </a>
                        <div class="collapse" id="orderMenu">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="pages/forms/basic_elements.html">Tất cả</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="pages/forms/basic_elements.html">Đơn hủy</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#userMenu" aria-expanded="false" aria-controls="userMenu">
                            <span class="menu-title">Quản lý người dùng</span>
                            <i class="mdi mdi-lock menu-icon"></i>
                        </a>
                        <div class="collapse" id="userMenu">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="pages/ui-features/buttons.html">Xem thông tin tài khoản</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#productMenu" aria-expanded="false" aria-controls="productMenu">
                            <span class="menu-title">Quản lý sản phẩm</span>
                            <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                        </a>
                        <div class="collapse" id="productMenu">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('seller.product.list')}}">Danh sách sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('seller.product.store')}}">Thêm sản phẩm</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('seller.product.listTrashCan')}}">Thùng rác</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#voucherMenu" aria-expanded="false" aria-controls="voucherMenu">
                            <span class="menu-title">Quản lý voucher</span>
                            <i class="mdi mdi-chart-bar menu-icon"></i>
                        </a>
                        <div class="collapse" id="voucherMenu">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('seller.voucher')}}">Danh sách voucher</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#shopMenu" aria-expanded="false" aria-controls="shopMenu">
                            <span class="menu-title">Quản lý shop</span>
                            <i class="mdi mdi-table-large menu-icon"></i>
                        </a>
                        <div class="collapse" id="shopMenu">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item">
                                    <a class="nav-link" href="pages/tables/basic-table.html">Hồ sơ shop</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="pages/tables/basic-table.html">Trang trí shop</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- partial -->
            <div class="main-panel">
                <!-- <div class="loader" id="loader">
                    <svg class="pl" width="240" height="240" viewBox="0 0 240 240">
                        <circle class="pl__ring pl__ring--a" cx="120" cy="120" r="105" fill="none" stroke="#000"
                            stroke-width="20" stroke-dasharray="0 660" stroke-dashoffset="-330" stroke-linecap="round">
                        </circle>
                        <circle class="pl__ring pl__ring--b" cx="120" cy="120" r="35" fill="none" stroke="#000"
                            stroke-width="20" stroke-dasharray="0 220" stroke-dashoffset="-110" stroke-linecap="round">
                        </circle>
                        <circle class="pl__ring pl__ring--c" cx="85" cy="120" r="70" fill="none" stroke="#000"
                            stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
                        <circle class="pl__ring pl__ring--d" cx="155" cy="120" r="70" fill="none" stroke="#000"
                            stroke-width="20" stroke-dasharray="0 440" stroke-linecap="round"></circle>
                    </svg>
                </div> -->

                <div class="content-wrapper">
                    @yield('content')
                </div>

                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright Â© 2023
                            <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights
                            reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made
                            with
                            <i class="mdi mdi-heart text-danger"></i></span>
                    </div>
                </footer>
            </div>


            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


    <!-- Include jQuery in your HTML -->


    <script>
        $(document).ready(function() {
            // Hàm khởi tạo DataTable
            function initializeDataTable(tableId) {
                $(tableId).DataTable({
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
                        '<"row"<"col-md-5"i><"col-md-7"p>>',
                    "columnDefs": [{
                        "targets": 3, // Cột giá
                        "render": $.fn.dataTable.render.number(',', '.', 0, '', ' VND')
                    }]
                });
            }

            // Khởi tạo DataTable cho bảng đầu tiên khi load trang
            initializeDataTable('#productTableAll');

            // Khởi tạo DataTable khi chuyển tab
            $('.tab-item').on('click', function() {
                var tabId = $(this).data('tab');
                $('.tab-item').removeClass('active');
                $(this).addClass('active');
                $('.tab-content').removeClass('active');
                $('#tab-' + tabId).addClass('active');

                var tableId = '#productTable' + capitalizeFirstLetter(tabId);

                // Chỉ khởi tạo DataTable nếu nó chưa được khởi tạo
                if (!$.fn.DataTable.isDataTable(tableId)) {
                    initializeDataTable(tableId);
                }
            });

            // Hàm hỗ trợ viết hoa chữ cái đầu tiên
            function capitalizeFirstLetter(string) {
                return string.charAt(0).toUpperCase() + string.slice(1);
            }
        });
    </script>



    <!-- <script src="{{asset('sellers/assets/js/spinner.js')}}"></script> -->
    <!-- Bootstrap 5 JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->


    <!-- plugins:js -->

    <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> -->
    <!-- endinject -->
    <!-- Plugin js for this page -->
    {{-- <script src="{{asset('sellers/assets/vendors/chart.js/chart.umd.js')}}"></script> --}}
    {{-- <script src="{{asset('sellers/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    --}}
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    {{-- <script src="{{asset('sellers/assets/js/off-canvas.js')}}"></script> --}}
    {{-- <script src="{{asset('sellers/assets/js/misc.js')}}"></script> --}}
    {{-- <script src="{{asset('sellers/assets/js/settings.js')}}"></script> --}}
    {{-- <script src="{{asset('sellers/assets/js/todolist.js')}}"></script> --}}
    {{-- <script src="{{asset('sellers/assets/js/jquery.cookie.js')}}"></script> --}}
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- <script src="{{asset('sellers/assets/js/dashboard.js')}}"></script> -->
    <!-- <script src="{{asset('sellers/assets/vendors/js/vendor.bundle.base.js')}}"></script> -->

    <!-- End custom js for this page -->
</body>

</html>