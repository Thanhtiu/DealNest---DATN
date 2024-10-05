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

  .image-preview-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    /* Adjust gap between images */
  }

  .image-preview-container img {
    width: 150px;
    /* Adjust width as needed */
    height: 150px;
    /* Adjust height as needed */
    object-fit: cover;
    /* Ensures the image covers the container */
    border: 1px solid #e6e6e6;
    border-radius: 5px;
    cursor: pointer;
  }

  .list-image {
    display: flex;
    /* Sử dụng Flexbox để sắp xếp các phần tử nằm ngang */
    gap: 10px;
    /* Khoảng cách giữa các phần tử, có thể điều chỉnh theo nhu cầu */
    flex-wrap: wrap;
    /* Cho phép các phần tử xuống dòng khi không đủ chỗ */
  }

  .item-image {
    display: flex;
    /* Đảm bảo các phần tử bên trong .item-image được căn chỉnh đúng */
    flex-direction: column;
    /* Sắp xếp hình ảnh và input file theo chiều dọc */
    align-items: center;
    /* Canh giữa hình ảnh và input file */
    justify-content: center;
    /* Canh giữa hình ảnh và input file theo chiều dọc */
    flex: 1 1 calc(20% - 10px);
    /* Đảm bảo mỗi item chiếm khoảng 20% của chiều rộng container, trừ khoảng cách */
    box-sizing: border-box;
    /* Bao gồm padding và border trong tổng kích thước phần tử */
  }

  .item-image img {
    width: 100%;
    /* Đảm bảo hình ảnh chiếm toàn bộ chiều rộng của phần tử chứa */
    height: auto;
    /* Đảm bảo hình ảnh giữ tỷ lệ khung hình */
    max-height: 200px;
    /* Đảm bảo hình ảnh không vượt quá chiều cao tối đa */
    object-fit: cover;
    /* Đảm bảo hình ảnh không bị biến dạng */
  }

  .file-upload-default {
    display: none;
    /* Ẩn input file */
  }

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
  <h3 class="page-title">Chỉnh sửa </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      {{-- <li class="breadcrumb-item"><a href="#">Forms</a></li> --}}
      {{-- <li class="breadcrumb-item active" aria-current="page">Form elements</li> --}}
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
        <form class="forms-sample" action="{{ route('seller.product.update', ['id' => $product->id]) }}" method="POST"
          enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="form-group">
            <label class="form-label">* Sửa ảnh bìa</label>
            <div class="file-upload-container">
              <label for="image" class="file-upload-info" id="fileUploadCoverInfo">Sửa hình ảnh (1/1)</label>
              <input type="file" id="image" name="image" class="file-upload-default" accept="image/*">
              <img id="coverImagePreview" src="{{asset('uploads/'.$product->image)}}" alt="" style="" />
            </div>
            <p class="mt-2 text-muted">
              • Tải lên hình ảnh 1:1. Ảnh bìa sẽ được hiển thị tại các trang Kết quả tìm kiếm, Gợi ý hôm nay,...
            </p>
          </div>

          <!-- Cover Image Upload Section -->
          <div class="form-group">
            <label class="form-label">* Sửa hình ảnh</label>
            <div class="list-image">
              @foreach($product->product_image as $item)
              <div class="item-image">
                <img src="{{ asset('uploads/' . $item->url) }}" alt="Image"
                  style="width: 200px; height: 200px; object-fit: cover; display:block;">
                <div class="form-group mt-3">
                  {{-- <label>File upload</label> --}}
                  <input type="file" name="img[{{ $item->id }}]" class="file-upload-default" style="display: none;">
                  <!-- Image ID as name -->
                  <div class="input-group">
                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image"
                      style="height: 50px;">
                    <span class="input-group-append">
                      <button class="file-upload-browse btn btn-gradient-primary py-3" type="button"
                        style="height: 50px;">Upload</button>
                    </span>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>



          <div class="form-group">
            <label for="name">Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Tên sản phẩm"
              value="{{$product->name}}">
          </div>

          <div class="form-group">
            <label for="categorySelect" class="form-label">Thể loại</label>
            <select class="form-select" id="categorySelect" name="category_id">
              @foreach ($category as $item)
              <option value="{{ $item->id }}" @if($item->id === $product->category_id) selected @endif>
                {{ $item->name }}
              </option>
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
                      <select class="form-select" id="subCategorySelect" name="subcategory_id"
                        data-selected-subcategory-id="{{ $product->subcategory_id }}">
                        {{-- Subcategories will be populated by JavaScript --}}
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
              <input type="text" class="form-control" name="price" id="price" placeholder="Giá"
                value="{{$product->price}}">
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
            <textarea name="description" id="description" class="form-control" id="description"
              rows="4">{{$product->description}}</textarea>
          </div>
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Thông tin chi tiết</h4>
                <p class="card-description"> Hoàn thành: Thông tin thuộc tính để tăng mức độ hiển thị cho sản phẩm</p>
                <div class="row">
                  <div class="form-group col-6">
                    <label for="quantity">Số lượng</label>
                    <input type="text" class="form-control" id="quantity" name="quantity"
                      value="{{$product->quantity}}">
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
                @foreach($attribute as $item)
                @php
                // Lấy tất cả các giá trị của thuộc tính từ cơ sở dữ liệu
                $selectedValues = $product->attribute_values->where('attribute_id', $item->id);
                @endphp
                <div class="row attribute-block">
                  <div class="col-12">
                    <label class="form-check-label" for="attribute-{{$item->id}}">{{$item->name}}</label>
                    <div class="form-inline-row">
                      <!-- Checkbox để chọn thuộc tính -->
                      <input type="checkbox" class="form-check-input attribute-checkbox"
                        id="attribute-{{$item->id}}"
                        value="{{$item->name}}"
                        data-id="{{$item->id}}"
                        data-name="{{$item->name}}"
                        {{ $selectedValues->isNotEmpty() ? 'checked' : '' }}>
                    </div>

                    <!-- Checkbox chọn giá cho thuộc tính -->
                    <div class="price-checkbox">
                      <input type="checkbox" class="form-check-input price-checkbox"
                        id="attribute-price-{{$item->id}}"
                        data-id="{{$item->id}}"
                        value="attribute-price-{{$item->id}}"
                        data-name="Giá {{$item->name}}"
                        {{ $selectedValues->first() && $selectedValues->first()->price ? 'checked' : '' }}>
                      <label class="form-check-label" for="attribute-price-{{$item->id}}">Chọn Giá</label>
                    </div>

                    <!-- Hiển thị các giá trị của thuộc tính -->
                    <div id="attribute-{{$item->id}}-forms">
                      @foreach($selectedValues as $index => $value)
                      <div class="form-row">
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Tên {{$item->name}}"
                            name="attributes[{{$item->id}}][values][{{$index}}][value]"
                            value="{{ $value->value }}">
                        </div>
                        <div class="col price-input" style="{{ $value->price ? 'display:block' : 'display:none' }}">
                          <input type="number" class="form-control" placeholder="Nhập giá"
                            name="attributes[{{$item->id}}][values][{{$index}}][price]"
                            value="{{ $value->price }}">
                        </div>
                        <div class="col-auto">
                          <button type="button" class="btn btn-danger remove-button">Xóa</button>
                        </div>
                      </div>
                      @endforeach
                    </div>

                    <!-- Nút thêm thuộc tính con -->
                    <button type="button" id="add-attribute-{{$item->id}}-form" class="btn btn-success add-attribute-btn" style="display: block;">Thêm thuộc tính con</button>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Cập nhật</button>
          <button class="btn btn-light" type="reset">Hủy bỏ</button>
        </form>
      </div>
    </div>

  </div>

</div>











<script>
  let selectedAttributeWithPrice = null;

  // Xử lý checkbox chọn thuộc tính
  document.querySelectorAll('.attribute-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
      let attributeId = this.dataset.id;
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
      } else {
        addButton.style.display = 'none'; // Ẩn nút nếu checkbox bị bỏ chọn
        container.innerHTML = ''; // Xóa toàn bộ form nếu bỏ chọn checkbox thuộc tính chính
      }
    });
  });

  // Đăng ký sự kiện click cho tất cả các nút "Thêm thuộc tính con"
  document.querySelectorAll('.add-attribute-btn').forEach(button => {
    button.addEventListener('click', function() {
      let attributeId = this.id.split('-')[2]; // Lấy ID của thuộc tính từ ID của nút
      let container = document.getElementById(`attribute-${attributeId}-forms`);
      let attributeName = document.querySelector(`#attribute-${attributeId}`).dataset.name;
      let index = container.children.length - 1; // Đếm số lượng phần tử con trừ đi input ẩn

      // Tạo form mới cho thuộc tính con
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

      // Kiểm tra nếu checkbox giá đã được chọn
      if (selectedAttributeWithPrice && selectedAttributeWithPrice.dataset.id === attributeId) {
        newFormGroup.querySelector('.price-input').style.display = 'block';
      } else {
        newFormGroup.querySelector('.price-input').style.display = 'none';
      }
    });
  });

  // Xử lý checkbox "Chọn Giá"
  document.querySelectorAll('.price-checkbox').forEach(priceCheckbox => {
    priceCheckbox.addEventListener('change', function() {
      let attributeId = this.dataset.id;
      let priceContainers = document.querySelectorAll(`#attribute-${attributeId}-forms .price-input`);

      if (this.checked) {
        if (selectedAttributeWithPrice) {
          alert('Bạn đã chọn giá cho một thuộc tính rồi, không thể thay đổi!');
          this.checked = false;
          return;
        }

        // Ghi nhận thuộc tính chính đang được nhập giá
        selectedAttributeWithPrice = this;

        // Hiển thị tất cả các input giá của thuộc tính này
        priceContainers.forEach(container => container.style.display = 'block');

        // Vô hiệu hóa các checkbox khác
        document.querySelectorAll('.price-checkbox').forEach(cb => {
          if (cb !== this) {
            cb.disabled = true;
          }
        });
      } else {
        this.checked = true; // Không cho phép bỏ chọn
      }
    });
  });

  // Sử dụng event delegation để xóa thuộc tính con
  document.addEventListener('click', function(event) {
    if (event.target.classList.contains('remove-button')) {
      let formRow = event.target.closest('.form-row');
      if (formRow) {
        formRow.remove(); // Xóa thuộc tính con
      }
    }
  });

  // Kiểm tra nếu có checkbox nào đã được chọn giá khi trang tải lại
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.price-checkbox').forEach(priceCheckbox => {
      let attributeId = priceCheckbox.dataset.id;
      let priceContainers = document.querySelectorAll(`#attribute-${attributeId}-forms .price-input`);

      if (priceCheckbox.checked) {
        // Nếu checkbox giá đã được chọn, hiển thị các input giá tương ứng
        selectedAttributeWithPrice = priceCheckbox;
        priceContainers.forEach(container => container.style.display = 'block');

        // Vô hiệu hóa các checkbox khác
        document.querySelectorAll('.price-checkbox').forEach(cb => {
          if (cb !== priceCheckbox) {
            cb.disabled = true;
          }
        });
      }
    });
  });
</script>

@endsection



{{-- <script src="{{asset('sellers/assets/js/process-product-edit.js')}}"></script> --}}

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


    const uploadButtons = document.querySelectorAll('.file-upload-browse');

    uploadButtons.forEach((button) => {
      button.addEventListener('click', function() {
        const fileInput = this.closest('.form-group').querySelector('.file-upload-default');
        fileInput.click();
      });
    });

    const fileInputs = document.querySelectorAll('.file-upload-default');

    fileInputs.forEach((input) => {
      input.addEventListener('change', function() {
        const fileName = this.files[0]?.name;
        if (fileName) {
          const textInput = this.closest('.form-group').querySelector('.file-upload-info');
          textInput.value = fileName;
        }
      });
    });


    const categorySelect = document.getElementById('categorySelect');
    const subCategorySelect = document.getElementById('subCategorySelect');
    const selectedCategoryId = categorySelect ? categorySelect.value : null;
    const selectedSubCategoryId = subCategorySelect ? subCategorySelect.getAttribute('data-selected-subcategory-id') : null;

    function populateSubCategories(categoryId) {
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

              if (subcategory.id == selectedSubCategoryId) {
                option.selected = true;
              }

              subCategorySelect.appendChild(option);
            });
          })
          .catch(error => console.error('Error:', error));
      }
    }

    if (categorySelect) {
      if (selectedCategoryId) {
        populateSubCategories(selectedCategoryId);
      }

      categorySelect.addEventListener('change', function() {
        const categoryId = this.value;
        populateSubCategories(categoryId);
      });
    }


  });
</script>