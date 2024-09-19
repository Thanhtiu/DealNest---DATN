@extends('layouts/client.app')
@section('content')
<style>
    .card-profile {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 3px;
        height: 800px;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-add {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 3px;
        height: auto;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-pro {
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        background-color: #f8f9fa;
    }

    .profile-card-body {
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .profile-form-label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .profile-form-control {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
        margin-bottom: 10px;
    }

    .profile-form-text {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
    }

    .profile-btn {
        padding: 8px 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-right: 5px;
    }

    .profile-btn-primary {
        background-color: #007bff;
        color: white;
    }

    .profile-form-check-inline {
        margin-right: 10px;
    }

    .profile-input-group {
        display: flex;
        align-items: center;
    }

    .profile-input-group-text {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px 0 0 4px;
    }

    .profile-form-select {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 0 4px 4px 0;
        width: 100px;
    }

    /* Avatar Section */
    .avatar-card-body {
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .avatar-img-fluid {
        width: 130px;
        height: 130px;
        object-fit: cover;
    }

    .avatar-rounded-circle {
        border-radius: 50%;
    }

    /* .avatar-mx-auto {
        margin-left: auto;
        margin-right: auto;
    } */
    /* .avatar-d-block {
        display: block;
    } */
    .avatar-mt-3 {
        margin-top: 15px;
    }

    .avatar-mt-2 {
        margin-top: 10px;
    }

    /* Fix for disappearing text */
    .profile-btn-link {
        background: none;
        color: #007bff;
        text-decoration: none;
        padding: 0;
        border: none;
        cursor: pointer;
        font-size: 14px;
    }

    .profile-btn-link:hover {
        text-decoration: underline;
        color: #0056b3;
    }
</style>
<section class="py-5">
    <div class="container">
        <form action="{{route('account.profile.update',['id'=>$user->id])}}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-3">
                    @include('layouts.client.sidebar')
                </div>
                <!-- Profile Content -->
                <div class="col-md-6 profile-content">
                    <div class="card-profile">
                        <div class="card-pro">
                            <h4>Hồ Sơ Của Tôi</h4>
                            <p class="card-text">Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                        </div>
                        <div class="profile-card-body">
                            <!-- Name Field -->
                            <div class="profile-mb-3">
                                <label for="username" class="profile-form-label">Tên</label>
                                <input type="text" class="form-control" id="username" name="name"
                                    value="{{ $user->name }}" readonly>
                            </div>
                            <!-- Full Name Field -->
                            <div class="profile-mb-3">
                                <label for="name" class="profile-form-label">Họ và tên</label>
                                <input type="text" class="form-control" id="name" name="full_name"
                                    value="{{ $user->full_name }}">
                            </div>
                            <!-- Email Field -->
                            <div class="profile-mb-3">
                                <label for="email" class="profile-form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly
                                    name="email">
                            </div>
                            <!-- Phone Field -->
                            <div class="profile-mb-3">
                                <label for="phone" class="profile-form-label">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phone" name="phone"
                                    value="{{ $user->phone }}">
                            </div>
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
                        </div>
                    </div>
                </div>

                <!-- Avatar Section -->
                <div class="col-md-3 avatar-content">
                    <div class="card-add">
                        <div class="card-header">
                            <h4>Ảnh đại diện</h4>
                        </div>
                        <div class="avatar-card-body">
                            <!-- Image preview -->
                            <img id="avatarPreview" src="{{ asset('uploads/' . $user->image) }}" alt="Ảnh đại diện"
                                class="avatar-img-fluid avatar-rounded-circle avatar-mx-auto avatar-d-block"
                                style="width: 150px;" name="image">
                        </div>
                        <!-- Hidden file input -->
                        <input type="file" id="avatarInput" style="display: none;" accept="image/jpeg, image/png"
                            name="image">
                        <button type="button" id="avatarBtn" class="btn btn-primary mt-3">Chọn Ảnh</button>
                        <!-- Small tag to display file name -->
                        <small id="fileName" class="form-text text-muted mt-2">Dung lượng file tối đa 1 MB. Định dạng:
                            JPEG, PNG</small>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection