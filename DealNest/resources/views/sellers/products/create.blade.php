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
            <label for="categorySelect" class="form-label">Thể loại</label>
            <select class="form-select" id="categorySelect" name="category_id">
              @foreach ($category as $item)
              <option value="{{$item->id}}">{{$item->name}}</option>
              @endforeach
            </select>
          </div>

          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Thể loại con</h4>
                <p class="card-description"></p>
                <div>
                  <div class="row">
                    <!-- Select Thể loại con -->
                    <div class="form-group">
                      <label for="subCategorySelect" class="form-label">Thể loại con</label>
                      <select class="form-select" id="subCategorySelect" name="subCategory_id">
                        <option value="">Chọn thể loại con</option>
                        <!-- Thể loại con sẽ được thêm tự động bởi JavaScript -->
                      </select>
                    </div>
                  </div>
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
                    <select class="form-select form-select-lg" id="brand" name="brand_id">
                      @foreach($brand as $item)
                      <option value="{{$item->id}}">{{$item->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>


                <div class="container mt-5">
                  <h2>Chọn Thuộc Tính Sản Phẩm</h2>

                  <!-- Thuộc tính chính: Kích thước -->
                  @foreach($attribute as $item)
                  <div class="row attribute-block">
                    <div class="col-12">
                      <label class="form-check-label" for="attribute-{{$item->id}}">{{$item->name}}</label>
                      <div class="form-inline-row">
                        <!-- Checkbox để chọn thuộc tính -->
                        <input type="checkbox" class="form-check-input attribute-checkbox" id="attribute-{{$item->id}}" value="{{$item->name}}" data-id="{{$item->id}}" data-name="{{$item->name}}">
                      </div>
                      <div class="price-checkbox">
                        <input type="checkbox" class="form-check-input price-checkbox" id="attribute-price-{{$item->id}}" data-id="{{$item->id}}" value="attribute-price-{{$item->id}}" data-name="Giá {{$item->name}}">
                        <label class="form-check-label" for="attribute-price-{{$item->id}}">Chọn Giá</label>
                      </div>
                      <div id="attribute-{{$item->id}}-forms"></div> <!-- Container thuộc tính con -->
                      <button type="button" id="add-attribute-{{$item->id}}-form" class="btn btn-success add-attribute-btn" style="display: none;">Thêm thuộc tính con</button>
                    </div>
                  </div>
                  @endforeach






                </div>

              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-gradient-primary me-2">Thêm</button>
          <button class="btn btn-light" type="reset">Hủy bỏ</button>
        </form>
      </div>
    </div>

  </div>

</div>



<script>
  let selectedAttributeWithPrice = null;

  // Khi chọn thuộc tính chính, hiển thị form thêm thuộc tính con và nút thêm tương ứng
  document.querySelectorAll('.attribute-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      let attributeId = this.dataset.id; // Lấy ID của checkbox thuộc tính
      let attributeName = this.dataset.name;
      let addButton = document.getElementById(`add-attribute-${attributeId}-form`);
      let container = document.getElementById(`attribute-${attributeId}-forms`);

      if (this.checked) {
        // Hiển thị nút "Thêm thuộc tính con"
        addButton.style.display = 'block';
        container.innerHTML = ''; // Xóa nội dung cũ nếu có

        // Thêm input ẩn để lưu tên thuộc tính vào form
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = `attributes[${attributeId}][name]`;
        hiddenInput.value = attributeName;
        container.appendChild(hiddenInput);

        // Khi nhấn "Thêm thuộc tính con"
        addButton.addEventListener('click', function() {
          let index = container.children.length - 1; // Đếm số lượng phần tử con trừ đi input ẩn
          let newFormGroup = document.createElement('div');
          newFormGroup.classList.add('attribute-form');
          newFormGroup.innerHTML = `
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Tên ${attributeName}" name="attributes[${attributeId}][values][${index}][value]">
                        </div>
                        <div class="col price-input">
                            <input type="number" class="form-control" placeholder="Nhập giá" name="attributes[${attributeId}][values][${index}][price]">
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-danger remove-button">Xóa</button>
                        </div>
                    </div>
                `;
          container.appendChild(newFormGroup);

          // Nếu checkbox "Chọn Giá" của thuộc tính chính đã được chọn, hiển thị input giá ngay lập tức
          if (selectedAttributeWithPrice && selectedAttributeWithPrice.id === `attribute-price-${attributeId}`) {
            newFormGroup.querySelector('.price-input').style.display = 'block';
          } else {
            newFormGroup.querySelector('.price-input').style.display = 'none';
          }

          // Xử lý xóa form mới thêm
          newFormGroup.querySelector('.remove-button').addEventListener('click', function() {
            newFormGroup.remove();
          });
        });
      } else {
        addButton.style.display = 'none'; // Ẩn nút nếu checkbox bị bỏ chọn
        container.innerHTML = ''; // Xóa toàn bộ form nếu bỏ chọn checkbox thuộc tính chính
      }
    });
  });

  // Xử lý hiển thị input giá khi chọn checkbox "Chọn Giá"
  document.querySelectorAll('.price-checkbox').forEach(priceCheckbox => {
    priceCheckbox.addEventListener('change', function() {
      let attributeId = this.dataset.id; // Lấy ID của thuộc tính chính
      let priceContainers = document.querySelectorAll(`#attribute-${attributeId}-forms .price-input`);

      if (this.checked) {
        if (selectedAttributeWithPrice) {
          alert('Bạn đã chọn giá cho một thuộc tính rồi, không thể thay đổi!'); // Thông báo không cho thay đổi
          this.checked = false; // Không cho phép chọn checkbox khác
          return;
        }

        // Ghi nhận thuộc tính chính đang được nhập giá
        selectedAttributeWithPrice = this;

        // Hiển thị tất cả các container chứa input giá của thuộc tính đó ngay lập tức
        priceContainers.forEach(container => container.style.display = 'block');

        // Vô hiệu hóa các checkbox khác
        document.querySelectorAll('.price-checkbox').forEach(cb => {
          if (cb !== this) {
            cb.disabled = true; // Vô hiệu hóa các checkbox khác
          }
        });

      } else {
        this.checked = true; // Giữ checkbox này luôn được chọn
      }
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


    const categorySelect = document.getElementById('categorySelect');
    if (categorySelect) {
      categorySelect.addEventListener('change', function() {
        const categoryId = this.value;


        const subCategorySelect = document.getElementById('subCategorySelect');
        subCategorySelect.innerHTML = '<option value="">Chọn thể loại con</option>';

        if (categoryId) {
          const url = `{{ route('seller.getSubCategory') }}?category_id=${categoryId}`;

          fetch(url)
            .then(response => response.json())
            .then(subcategories => {
              subcategories.forEach(subcategory => {
                const option = document.createElement('option');
                option.value = subcategory.id;
                option.textContent = subcategory.name;
                subCategorySelect.appendChild(option);
              });
            })
            .catch(error => console.error('Error:', error));
        }
      });
    }




  });
</script>