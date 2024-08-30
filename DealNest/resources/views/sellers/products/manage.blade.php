@extends('layouts.sellers.app')
@section('content')
<style>
  /* Style for image upload container */
  .file-upload-info {
    background-color: #fff;
    border: 1px dashed #e6e6e6;
    height: 80px;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    cursor: pointer;
    color: #ff4d4f;
    font-weight: bold;
    border-radius: 5px;
  }

  .file-upload-info::placeholder {
    color: #e6e6e6;
  }

  .input-group-append .btn {
    border-radius: 5px;
    font-weight: bold;
    background-color: transparent;
    color: #ff4d4f;
    padding: 0;
    height: 80px;
    width: 80px;
    border: 1px dashed #e6e6e6;
    text-align: center;
  }

  .input-group-append .btn i {
    font-size: 24px;
    line-height: 80px;
  }

  .file-upload-default {
    visibility: hidden;
    position: absolute;
  }

  .file-upload-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
  }

  .file-upload-container input[type="file"] {
    display: none;
  }

  .file-upload-container img {
    width: 100%;
    height: auto;
    cursor: pointer;
  }

  .file-upload-container label {
    cursor: pointer;
    color: #ff4d4f;
    font-weight: bold;
  }
</style>
<div class="page-header">
  <h3 class="page-title"> Form elements </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Forms</a></li>
      <li class="breadcrumb-item active" aria-current="page">Form elements</li>
    </ol>
  </nav>
</div>
<div class="row">

  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Thông tin cơ bản</h4>
        <form class="forms-sample">
          <!-- Product Images Upload Section -->
          <div class="form-group">
            <label class="form-label">* Hình ảnh sản phẩm</label>
            <div class="file-upload-container mt-3">
              <label for="productImage" class="file-upload-info">Thêm hình ảnh (0/9)</label>
              <input type="file" id="productImage" name="img[]" class="file-upload-default" multiple>
              <img id="productImagePreview" src="" alt="Product Image Preview"
                style="display: none; margin-top: 10px;" />
            </div>
          </div>

          <!-- Cover Image Upload Section -->
          <div class="form-group">
            <label class="form-label">* Ảnh bìa</label>
            <div class="file-upload-container">
              <label for="coverImage" class="file-upload-info">Thêm hình ảnh (0/1)</label>
              <input type="file" id="coverImage" name="cover_img" class="file-upload-default">
              <img id="coverImagePreview" src="#" alt="Cover Image Preview" style="display: none; margin-top: 10px;" />
            </div>
            <p class="mt-2 text-muted">
              • Tải lên hình ảnh 1:1. Ảnh bìa sẽ được hiển thị tại các trang Kết quả tìm kiếm, Gợi ý hôm nay,...
            </p>
          </div>

          <div class="form-group">
            <label for="exampleInputName1">Tên sản phẩm</label>
            <input type="text" class="form-control" id="exampleInputName1" placeholder="Tên sản phẩm">
          </div>

          <div class="form-group">
            <label for="exampleSelect" class="form-label">Thể loại</label>
            <select class="form-select" id="exampleSelect">
              <option value="1">Option 1</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
            </select>
          </div>

          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Thể loại con</h4>
                <p class="card-description"></p>
                <form>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group row d-flex">
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input"> Default </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" checked> Checked </label>
                        </div>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" disabled> Disabled </label>
                        </div>
                         
                        
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
    
          <div class="row">
            <div class="form-group col-6">
              <label for="exampleInputName1">Giá</label>
              <input type="text" class="form-control" id="exampleInputName1" placeholder="Giá">
            </div>
            <div class="form-group col-6">
              <label for="exampleInputName1">Số lượng</label>
              <input type="text" class="form-control" id="exampleInputName1" placeholder="Số lượng">
            </div>
          </div>

          {{-- <div class="form-group">
            <label>File upload</label>
            <input type="file" name="img[]" class="file-upload-default">
            <div class="input-group col-xs-12">
              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-gradient-primary py-3" type="button">Upload</button>
              </span>
            </div>
          </div> --}}
          <div class="form-group">
            <label for="exampleTextarea1">Textarea</label>
            <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>
          </div>
          <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
          <button class="btn btn-light">Cancel</button>
        </form>
      </div>
    </div>

  </div>
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Thông tin chi tiết</h4>
        <p class="card-description"> Hoàn thành: Thông tin thuộc tính để tăng mức độ hiển thị cho sản phẩm</p>
        <div class="row">
          <div class="form-group col-6">
            <label for="exampleFormControlSelect1">Thương hiệu</label>
            <select class="form-select form-select-lg" id="exampleFormControlSelect1">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="exampleFormControlSelect1">Xuất xứ</label>
            <select class="form-select form-select-lg" id="exampleFormControlSelect1">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-6">
            <label for="exampleFormControlSelect2">Màu sắc</label>
            <select class="form-select" id="exampleFormControlSelect2">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
          <div class="form-group col-6">
            <label for="exampleFormControlSelect3">Kích cỡ</label>
            <select class="form-select form-select-sm" id="exampleFormControlSelect3">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection