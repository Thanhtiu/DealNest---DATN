<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Purple Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href=" {{ asset('assets/login/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/login/assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/login/assets/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/login/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{ asset('assets/login/assets/css/style.css') }}">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{ asset('assets/login/assets/images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row flex-grow">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="{{ asset('assets/login/assets/images/logo.svg') }}">
              </div>
              @if (session('login_error'))
              <div class="alert alert-danger">
                {{ session('login_error') }}
              </div>
              @endif
              <h4>Đăng nhập</h4>
              <form class="pt-3" method="POST" action=" {{route('account.authenticate')}} ">
                @csrf
                <div class="form-group">
                  <input type="text" name="email" class="form-control form-control-lg" id="exampleInputEmail1"
                    value="{{old('email')}}" placeholder="Email">
                  @error('email')
                  <p class="text-danger"> {{$message}} </p>
                  @enderror
                </div>

                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg"
                    value="{{old('password')}}" id="exampleInputPassword1" placeholder="Mật khẩu">
                  @error('password')
                  <p class="text-danger"> {{$message}} </p>
                  @enderror
                </div>
                <div class="mt-3 d-grid gap-2">
                  <button type="submit"
                    class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"
                    href="../../index.html">Đăng nhập</button>
                </div>
               <div class="login-social">
                  <div class="google">
                    <a href="{{route('login.google')}}">
                      <img src="{{asset('client/img/logo-google.png')}}" alt="" class="google-img">
                    </a>
                  </div>
                  <div class="facebook">
                    <a href="{{route('login.facebook')}}">
                      <img src="{{asset('client/img/logo-facebook.png')}}" alt="" class="google-img">
                    </a>
                  </div>
               </div>
                {{-- <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                  </div>
                  <a href="#" class="auth-link text-primary">Forgot password?</a>
                </div> --}}
                {{-- <div class="mb-2 d-grid gap-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="mdi mdi-facebook me-2"></i>Connect using facebook </button>
                </div> --}}
                <div class="text-center mt-4 font-weight-light"> Bạn mới biết đến DealNest?
                  <a href="{{ route('account.register') }}" class="text-primary">Đăng ký?</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ asset('assets/login/assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('assets/login/assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/login/assets/js/misc.js') }}"></script>
  <script src="{{ asset('assets/login/assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/login/assets/js/todolist.js') }}"></script>
  <script src="{{ asset('assets/login/assets/js/jquery.cookie.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @if(session('alertMessage'))
  <x-sweet-alert :message="session('alertMessage')" :type="session('alertType')" />
  @endif

  <!-- endinject -->
</body>

</html>