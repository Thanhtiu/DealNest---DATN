@extends('layouts/client.app')
@section('content')
<style>
    /* General Styling */
    .card-profile,
    .card-add {
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .card-pro {
        padding: 20px;
        margin-bottom: 10px;
        background-color: #f7f8fa;
        border-bottom: 2px solid #dee2e6;
    }

    .profile-card-body,
    .avatar-card-body {
        padding: 15px;
    }

    /* Form Inputs */
    .profile-form-label {
        font-weight: 500;
        margin-bottom: 5px;
        color: #333;
    }

    .profile-form-control {
        padding: 8px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        width: 100%;
        margin-bottom: 10px;
    }

    .profile-btn {
        padding: 8px 16px;
        border-radius: 4px;
        background-color: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    .profile-btn:hover {
        background-color: #0056b3;
    }

    /* Avatar Section */
    .avatar-img-fluid {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 10px;
    }

    /* File Upload */
    #avatarBtn {
        display: inline-block;
        background-color: #007bff;
        color: white;
        font-size: 14px;
        padding: 8px 16px;
        border-radius: 4px;
        border: none;
        cursor: pointer;
    }

    #avatarBtn:hover {
        background-color: #0056b3;
    }

    /* Responsive Layout */
    @media (max-width: 768px) {

        .card-profile,
        .card-add {
            margin-bottom: 15px;
        }
    }
</style>

<section class="py-5">
    <div class="container">
        <form action="{{ route('account.changePasswordProcessing') }}" method="POST">
            @csrf
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 mb-4">
                    @include('layouts.client.sidebar')
                </div>

                <!-- Profile Content -->
                <div class="col-md-6 profile-content">
                    <div class="card-profile">
                        <div class="card-pro">
                            <h4 class="mb-3">Đổi mật khẩu</h4>
                            <p class="text-muted">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                        </div>
                        <div class="profile-card-body">
                            <!-- Old Password Field -->
                            <div class="form-group">
                                <label for="old_password" class="profile-form-label">Mật khẩu hiện tại</label>
                                <input type="password" class="profile-form-control" id="old_password" name="old_password" value="{{ old('old_password') }}">
                                @error('old_password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- New Password Field -->
                            <div class="form-group">
                                <label for="password" class="profile-form-label">Mật khẩu mới</label>
                                <input type="password" class="profile-form-control" id="password" name="password">
                                @error('password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirm New Password Field -->
                            <div class="form-group">
                                <label for="password_confirmation" class="profile-form-label">Nhập lại mật khẩu mới</label>
                                <input type="password" class="profile-form-control" id="password_confirmation" name="password_confirmation">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="profile-btn mt-3">Cập nhật</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection