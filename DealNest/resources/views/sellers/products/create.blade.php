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
    color: #0d6efd;
    font-weight: bold;
  }

  .checkbox-container {
    display: flex;
    flex-wrap: wrap;
    /* Để các checkbox xuống hàng mới nếu không đủ chỗ trên một hàng */
    gap: 20px;
    /* Khoảng cách giữa các checkbox */
  }

  .form-check {
    display: flex;
    align-items: center;
    margin-right: 20px;
    /* Khoảng cách giữa các checkbox nếu cần */
  }

  .form-check-input {
    margin-right: 10px;
    /* Khoảng cách giữa checkbox và label */
  }

  /* Container chính của ảnh bìa */
  .file-upload-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 10px;
  }

  /* Label hiển thị thông tin upload */
  .file-upload-info {
    font-size: 14px;
    color: #6c757d;
    margin-bottom: 10px;
    cursor: pointer;
    transition: color 0.3s ease;
  }

  .file-upload-info:hover {
    color: #007bff;
  }

  /* Ảnh bìa preview */
  #coverImagePreview {
    display: block;
    max-width: 70%;
    max-height: 300px;
    border-radius: 10px;
    object-fit: cover;
    /* Đảm bảo ảnh không bị méo */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Tạo bóng cho ảnh */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    /* margin-bottom: 10px; */
  }

  /* Hiệu ứng hover cho ảnh bìa */
  #coverImagePreview:hover {
    transform: scale(1.05);
    /* Zoom nhẹ khi hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    /* Tăng độ bóng khi hover */
  }

  /* Thông báo nhỏ dưới ảnh */
  .mt-2.text-muted {
    font-size: 12px;
    color: #6c757d;
    text-align: center;
  }

  .attribute-form {
    margin-bottom: 20px;
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
  }

  .attribute-form .form-row {
    align-items: center;
  }

  .attribute-form .form-control {
    margin-right: 10px;
  }

  .remove-button {
    margin-left: 10px;
  }

  .price-input {
    display: none;
    /* Ẩn mặc định */
  }

  .add-attribute-btn {
    margin-top: 10px;
  }

  .attribute-con-wrapper {
    margin-top: 20px;
  }

  .full-width {
    width: 100%;
  }

  .price-checkbox {
    margin-top: 10px;
  }

  .attribute-block {
    margin-bottom: 20px;
  }

  .attribute-block {
    margin-bottom: 20px;
  }

  .form-control {
    margin-bottom: 10px;
  }

  .price-input {
    display: none;
  }

  .attribute-form .price-input {
    display: block;
  }

  .btn-danger {
    margin-left: 10px;
  }

  .attribute-form {
    margin-bottom: 15px;
  }

  .remove-button[disabled] {
    display: none;
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
  @if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif
  <div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Thông tin cơ bản</h4>
        <form class="forms-sample" action="{{route('seller.product.create')}}" method="POST"
          enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label class="form-label">* Thêm ảnh bìa</label>
            <div class="file-upload-container">
              <label for="image" class="file-upload-info" id="fileUploadCoverInfo">Thêm hình ảnh (0/1)</label>
              <input type="file" id="image" name="image" class="file-upload-default" accept="image/*">
              <img id="coverImagePreview" src="#" alt="" style="display: none; margin-top: 10px;" />
            </div>
            <p class="mt-2 text-muted">
              • Tải lên hình ảnh 1:1. Ảnh bìa sẽ được hiển thị tại các trang Kết quả tìm kiếm, Gợi ý hôm nay,...
            </p>
          </div>

          <!-- Section for multiple images without preview -->
          <div class="form-group">
            <label class="form-label">* Thêm hình ảnh</label>
            <div class="file-upload-container">
              <label for="img" class="file-upload-info" id="fileUploadInfo">Thêm hình ảnh (0/10)</label>
              <input type="file" id="img" name="img[]" class="file-upload-default" multiple accept="image/*">
            </div>
          </div>



          <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Tên sản phẩm"
              value="{{ old('name') }}">

          </div>

          <div class="form-group">
            <label for="slug">Tên sản phẩm</label>
            <input type="text" name="slug" class="form-control" id="slug" placeholder="Tên sản phẩm"
              value="{{ old('slug') }}">

          </div>

          <div class="form-group">
            <label for="categorySelect" class="form-label">Thể loại</label>
            <select class="form-select" id="categorySelect" name="">
              <option value="">Chọn thể loại</option>
              @foreach ($category as $item)
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Thể loại con</h4>
                <div class="form-group">
                  <label for="subCategorySelect" class="form-label">Thể loại con</label>
                  <select class="form-select" id="subCategorySelect" name="category_id">
                    <option value="">Chọn thể loại con</option>
                  </select>
                </div>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="form-group">
              <label for="price">Giá</label>
              <input type="text" class="form-control" name="price" id="price" placeholder="Giá" value={{old('price')}}>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label for="mrp">Giá bán lẻ</label>
              <input type="text" class="form-control" name="mrp" id="mrp" placeholder="mrp" value={{old('mrp')}}>
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
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control" id="description"
              rows="4">{{ old('description') }}</textarea>
          </div>

          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Thông tin chi tiết</h4>
                <p class="card-description"> Hoàn thành: Thông tin thuộc tính để tăng mức độ hiển thị cho sản phẩm</p>
                <div class="row">
                  <div class="form-group col-6">
                    <label for="quantity">Số lượng</label>
                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{old('quantity')}}">
                  </div>
                  <div class="form-group col-6">
                    <label for="brand">Xuất xứ</label>
                    <select class="form-select form-select-lg" id="brand" name="country_id">
                      @foreach($country as $item)
                      <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>


                <div class="container mt-5">
                  <h2>Chọn Thuộc Tính Sản Phẩm</h2>

                  <!-- Thuộc tính chính: Kích thước -->
                  <div class="row attribute-block">
                    <div class="col-12">
                      <label class="form-check-label">Kích thước</label>
                      <div class="form-inline-row">
                        <div class="attribute-form" id="size-attributes">
                          <div class="form-row mb-2">
                           
                              <input type="hidden" name="attributes[0][variant]" value="Kích thước">
                        
                            <div class="col">
                              <input type="text" name="attributes[0][value][]" class="form-control" placeholder="Nhập kích thước">
                            </div>
                            <div class="col-auto">
                              <button type="button" class="btn btn-danger remove-button" disabled>Xóa</button>
                            </div>
                          </div>
                        </div>
                        <button type="button" id="add-size-form" class="btn btn-success mt-2">Thêm kích thước</button>
                      </div>
                    </div>
                  </div>

                  <!-- Thuộc tính chính: Màu sắc -->
                  <div class="row attribute-block mt-4">
                    <div class="col-12">
                      <label class="form-check-label">Màu sắc</label>
                      <div class="form-inline-row">
                        <div class="attribute-form" id="color-attributes">
                          <div class="form-row mb-2">
                           
                              <input type="hidden" name="attributes[1][variant]" value="Màu sắc">
                          
                            <div class="col">
                              <input type="text" name="attributes[1][value][]" class="form-control" placeholder="Nhập màu sắc">
                            </div>
                            <div class="col price-input">
                              <input type="number" name="attributes[1][price][]" class="form-control" placeholder="Nhập giá">
                            </div>
                            <div class="col-auto">
                              <button type="button" class="btn btn-danger remove-button" disabled>Xóa</button>
                            </div>
                          </div>
                        </div>
                        <button type="button" id="add-color-form" class="btn btn-success mt-2">Thêm màu sắc</button>
                      </div>
                    </div>
                  </div>
                </div>






              </div>
            </div>
          </div>
      </div>
      <button type="submit" class="btn btn-primary">Thêm</button>
      <button class="btn btn-light" type="reset">Hủy bỏ</button>
      </form>
    </div>

  </div>

</div>


<script>
  function removeVietnameseTones(str) {
    str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/gi, 'a');
    str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/gi, 'e');
    str = str.replace(/ì|í|ị|ỉ|ĩ/gi, 'i');
    str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/gi, 'o');
    str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/gi, 'u');
    str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/gi, 'y');
    str = str.replace(/đ/gi, 'd');
    str = str.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/gi, ''); // Các dấu huyền, sắc, hỏi, ngã, nặng
    str = str.replace(/\u02C6|\u0306|\u031B/gi, ''); // Các dấu mũ, ă, ơ, â
    return str;
  }

  function convertToSlug(text) {
    text = removeVietnameseTones(text); // Bỏ dấu tiếng Việt
    return text.toLowerCase()
      .replace(/ /g, '-') // Thay khoảng trắng bằng gạch ngang
      .replace(/[^\w-]+/g, ''); // Xóa ký tự không phải là chữ cái, số, gạch ngang
  }

  document.getElementById('name').addEventListener('input', function() {
    const nameValue = this.value;
    const slugValue = convertToSlug(nameValue);
    document.getElementById('slug').value = slugValue;
  });
</script>

<script>
  document.getElementById('categorySelect').addEventListener('change', function() {
    var categoryId = this.value;
    var subCategorySelect = document.getElementById('subCategorySelect');

    subCategorySelect.innerHTML = '<option value="">Chọn thể loại con</option>';

    if (categoryId) {
      fetch(`/kenh-nguoi-ban/categories/${categoryId}/subcategories`)
        .then(response => response.json())
        .then(data => {
          data.forEach(function(subCategory) {
            var option = document.createElement('option');
            option.value = subCategory.id;
            option.text = subCategory.name;
            subCategorySelect.appendChild(option);
          });
        })
        .catch(error => {
          console.error('Error fetching subcategories:', error);
        });
    }
  });
</script>


<script>
  document.getElementById('add-size-form').addEventListener('click', function() {
    const newSize = document.createElement('div');
    newSize.classList.add('form-row', 'mb-2');
    newSize.innerHTML = `
        <div class="col">
            <input type="text" name="attributes[0][value][]" class="form-control" placeholder="Nhập kích thước">
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-danger remove-button">Xóa</button>
        </div>
    `;
    document.getElementById('size-attributes').appendChild(newSize);

    // Thêm sự kiện xóa cho nút "Xóa"
    newSize.querySelector('.remove-button').addEventListener('click', function() {
      newSize.remove();
    });
  });

  document.getElementById('add-color-form').addEventListener('click', function() {
    const newColor = document.createElement('div');
    newColor.classList.add('form-row', 'mb-2');
    newColor.innerHTML = `
        <div class="col">
            <input type="text" name="attributes[1][value][]" class="form-control" placeholder="Nhập màu sắc">
        </div>
        <div class="col price-input">
            <input type="number" name="attributes[1][price][]" class="form-control" placeholder="Nhập giá">
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-danger remove-button">Xóa</button>
        </div>
    `;
    document.getElementById('color-attributes').appendChild(newColor);

    // Thêm sự kiện xóa cho nút "Xóa"
    newColor.querySelector('.remove-button').addEventListener('click', function() {
      newColor.remove();
    });
  });
</script>


@endsection




<script type="importmap">
  {
      "imports": {
          "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.1.0/ckeditor5.js",
          "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.1.0/"
      }
  }
</script>
<script type="module">
  import {
    ClassicEditor,
    Essentials,
    Paragraph,
    Bold,
    Italic,
    Font
  } from 'ckeditor5';

  ClassicEditor
    .create(document.querySelector('#description'), {
      plugins: [Essentials, Paragraph, Bold, Italic, Font],
      toolbar: [
        'undo', 'redo', '|', 'bold', 'italic', '|',
        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
      ]
    })
    .then(editor => {
      window.editor = editor;
    })
    .catch(error => {
      console.error(error);
    });
</script>
<!-- A friendly reminder to run on a server, remove this during the integration. -->
<script>
  window.onload = function() {
    if (window.location.protocol === "file:") {
      alert("This sample requires an HTTP server. Please serve this file with a web server.");
    }
  };
</script>


<script>
  document.addEventListener('DOMContentLoaded', function() {

    // Hiển thị số lượng ảnh được chọn và ảnh preview cho ảnh bìa
    document.getElementById('image').addEventListener('change', function() {
      var fileInput = this;
      var fileCount = fileInput.files.length;
      var fileUploadInfo = document.getElementById('fileUploadCoverInfo');
      fileUploadInfo.textContent = `Thêm hình ảnh (${fileCount}/1)`;

      if (fileCount > 0) {
        var reader = new FileReader();
        reader.onload = function(e) {
          var coverImagePreview = document.getElementById('coverImagePreview');
          coverImagePreview.src = e.target.result;
          coverImagePreview.style.display = 'block';
        };
        reader.readAsDataURL(fileInput.files[0]);
      }
    });

    // Cập nhật số lượng file cho phần nhiều hình ảnh mà không hiển thị preview
    document.getElementById('img').addEventListener('change', function() {
      var fileInput = this;
      var fileCount = fileInput.files.length;
      var maxFiles = 10; // Giới hạn số lượng ảnh tối đa là 10
      var fileUploadInfo = document.getElementById('fileUploadInfo');

      if (fileCount > maxFiles) {
        alert(`Bạn chỉ có thể chọn tối đa ${maxFiles} ảnh. Chúng tôi sẽ lưu 10 ảnh đầu tiên.`);
        fileCount = maxFiles; // Chỉ lưu lại 10 ảnh đầu tiên
      }

      fileUploadInfo.textContent = `Thêm hình ảnh (${fileCount}/${maxFiles})`;

      // Lọc chỉ lấy 10 file đầu tiên
      var fileList = Array.from(fileInput.files).slice(0, maxFiles);
      var dataTransfer = new DataTransfer();
      fileList.forEach(function(file) {
        dataTransfer.items.add(file);
      });
      fileInput.files = dataTransfer.files; // Cập nhật input file với 10 file đầu tiên
    });

  });
</script>