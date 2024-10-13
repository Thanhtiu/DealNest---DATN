@extends('layouts/client.app')
@section('content')
<style>
    /* General Styling */
    .card-profile, .card-add {
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

    .profile-card-body, .avatar-card-body {
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
        .card-profile, .card-add {
            margin-bottom: 15px;
        }
    }
</style>

<section class="py-5">
    <div class="container">
        <form action="{{route('account.profile.update',['id'=>$user->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3 mb-4">
                    @include('layouts.client.sidebar')
                </div>

                <!-- Profile Content -->
                <div class="col-md-6 profile-content">
                    <div class="card-profile">
                        <div class="card-pro">
                            <h4 class="mb-3">Hồ Sơ Của Tôi</h4>
                            <p class="text-muted">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                        </div>
                        <div class="profile-card-body">
                            <!-- Name Field -->
                            <div class="form-group">
                                <label for="username" class="profile-form-label">Tên</label>
                                <input type="text" class="profile-form-control" id="username" name="name" value="{{ $user->name }}" readonly>
                            </div>

                            <!-- Full Name Field -->
                            <div class="form-group">
                                <label for="name" class="profile-form-label">Họ và tên</label>
                                <input type="text" class="profile-form-control" id="name" name="full_name" value="{{ $user->full_name }}">
                            </div>

                            <!-- Email Field -->
                            <div class="form-group">
                                <label for="email" class="profile-form-label">Email</label>
                                <input type="email" class="profile-form-control" id="email" value="{{ $user->email }}" readonly name="email">
                            </div>

                            <!-- Phone Field -->
                            <div class="form-group">
                                <label for="phone" class="profile-form-label">Số điện thoại</label>
                                <input type="tel" class="profile-form-control" id="phone" name="phone" value="{{ $user->phone }}">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="profile-btn mt-3">Cập nhật</button>
                        </div>
                    </div>
                </div>

                <!-- Avatar Section -->
                <div class="col-md-3">
                    <div class="card-add">
                        <div class="card-header bg-light">
                            <h4 class="mb-2">Ảnh đại diện</h4>
                        </div>
                        <div class="avatar-card-body text-center">
                            <!-- Image preview -->
                            <img id="avatarPreview" src="{{ asset('uploads/' . $user->image) }}" alt="Ảnh đại diện" class="avatar-img-fluid">
                        </div>

                        <!-- File input and button -->
                        <input type="file" id="avatarInput" style="display: none;" accept="image/jpeg, image/png" name="image">
                        <div class="text-center">
                            <button type="button" id="avatarBtn" class="btn btn-primary">Chọn Ảnh</button>
                        </div>

                        <!-- Small tag to display file info -->
                        <small id="fileName" class="form-text text-muted text-center mt-2">Dung lượng tối đa 1 MB. Định dạng: JPEG, PNG</small>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
