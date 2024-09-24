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
 
  .attribute-actions {
      display: flex;
      justify-content: space-between;
      align-items: center;
  }

  .attribute-actions .btn {
      margin-right: 10px; /* Khoảng cách giữa các nút */
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


                <div class="container mt-4">
                  <div class="row">
                      <div class="col-12">
                          <h4 class="mb-3">Nhập biến thể sản phẩm</h4>
                          <div id="attributeContainer"></div>
                          <button class="btn btn-primary mt-2" id="addAttributeBtn" type="button">Thêm biến thể chính</button>
                      </div>
                  </div>
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
let currentPriceVariant = null; // Theo dõi biến thể chính chứa giá
let attributeIndex = 0; // Đếm số lượng biến thể chính

document.getElementById('addAttributeBtn').addEventListener('click', function() {
    // Tạo phần tử biến thể chính
    let attributeDiv = document.createElement('div');
    attributeDiv.className = 'attribute mb-3';

    let attributeHeader = document.createElement('h5');
    attributeHeader.innerText = 'Biến thể chính';
    attributeDiv.appendChild(attributeHeader);

    // Input nhập tên biến thể chính
    let attributeNameInput = document.createElement('input');
    attributeNameInput.type = 'text';
    attributeNameInput.name = `attributes[${attributeIndex}][name]`;
    attributeNameInput.className = 'form-control mb-2';
    attributeNameInput.placeholder = 'Nhập tên biến thể chính (VD: Kích thước)';
    attributeNameInput.required = true;
    attributeDiv.appendChild(attributeNameInput);

    // Checkbox để chọn biến thể chính có giá
    let priceCheckbox = document.createElement('input');
    priceCheckbox.type = 'checkbox';
    priceCheckbox.className = 'me-2';

    let priceCheckboxLabel = document.createElement('label');
    priceCheckboxLabel.innerText = 'Chọn biến thể này chứa giá';

    priceCheckbox.addEventListener('change', function() {
        if (priceCheckbox.checked) {
            if (currentPriceVariant) {
                clearPriceInputs(currentPriceVariant);
                currentPriceVariant.querySelector('input[type="checkbox"]').checked = false; // Bỏ chọn checkbox cũ
            }
            currentPriceVariant = attributeDiv; // Cập nhật biến thể chính có giá
            enablePriceInputs(attributeDiv);
        } else {
            clearPriceInputs(attributeDiv);
            currentPriceVariant = null;
        }
    });

    attributeDiv.appendChild(priceCheckbox);
    attributeDiv.appendChild(priceCheckboxLabel);

    // Nút thêm biến thể con
    let addSubAttributeBtn = document.createElement('button');
    addSubAttributeBtn.className = 'btn btn-secondary';
    addSubAttributeBtn.type = 'button';
    addSubAttributeBtn.innerText = 'Thêm biến thể con';

    // Nút xóa biến thể chính
    let removeAttributeBtn = document.createElement('button');
    removeAttributeBtn.className = 'btn btn-danger';
    removeAttributeBtn.type = 'button';
    removeAttributeBtn.innerText = 'Xóa biến thể chính';

    // Thêm các nút vào trong div actions
    let actionsDiv = document.createElement('div');
    actionsDiv.className = 'attribute-actions';
    actionsDiv.appendChild(addSubAttributeBtn);
    actionsDiv.appendChild(removeAttributeBtn);

    // Container chứa các biến thể con
    let subAttributeContainer = document.createElement('div');
    subAttributeContainer.className = 'subAttributeContainer';
    let subAttributeIndex = 0; // Đếm số lượng biến thể con

    // Sự kiện khi nhấn nút thêm biến thể con
    addSubAttributeBtn.addEventListener('click', function() {
        let subAttributeDiv = document.createElement('div');
        subAttributeDiv.className = 'subAttribute mb-2 d-flex align-items-center';

        // Input tên biến thể con
        let subAttributeInput = document.createElement('input');
        subAttributeInput.type = 'text';
        subAttributeInput.name = `attributes[${attributeIndex}][values][${subAttributeIndex}][value]`;
        subAttributeInput.className = 'form-control me-2';
        subAttributeInput.placeholder = 'Nhập tên biến thể con (VD: S, M, L)';
        subAttributeInput.required = true;

        // Input giá của biến thể con (bị ẩn theo mặc định)
        let priceInput = document.createElement('input');
        priceInput.type = 'number';
        priceInput.name = `attributes[${attributeIndex}][values][${subAttributeIndex}][price]`;
        priceInput.className = 'form-control me-2';
        priceInput.placeholder = 'Nhập giá';
        priceInput.style.display = 'none'; // Mặc định bị ẩn khi biến thể chính chưa được chọn

        // Nút xóa biến thể con
        let removeSubAttributeBtn = document.createElement('button');
        removeSubAttributeBtn.className = 'btn btn-danger';
        removeSubAttributeBtn.type = 'button';
        removeSubAttributeBtn.innerText = 'Xóa';

        removeSubAttributeBtn.addEventListener('click', function() {
            subAttributeDiv.remove();
        });

        subAttributeDiv.appendChild(subAttributeInput);
        subAttributeDiv.appendChild(priceInput);
        subAttributeDiv.appendChild(removeSubAttributeBtn);

        subAttributeContainer.appendChild(subAttributeDiv);

        // Kiểm tra nếu biến thể chính này được chọn làm biến thể có giá
        if (attributeDiv === currentPriceVariant) {
            priceInput.style.display = 'inline-block'; // Hiển thị input giá nếu biến thể chính đã được chọn
        }

        subAttributeIndex++; // Tăng số lượng biến thể con
    });

    // Sự kiện xóa biến thể chính
    removeAttributeBtn.addEventListener('click', function() {
        if (attributeDiv === currentPriceVariant) {
            currentPriceVariant = null; // Xóa biến thể chính hiện tại chứa giá
        }
        attributeDiv.remove();
    });

    attributeDiv.appendChild(subAttributeContainer);
    attributeDiv.appendChild(actionsDiv);

    document.getElementById('attributeContainer').appendChild(attributeDiv);
    attributeIndex++; // Tăng số lượng biến thể chính
});

// Hàm để kích hoạt các input giá của biến thể chính được chọn
function enablePriceInputs(attributeDiv) {
    attributeDiv.querySelectorAll('.subAttribute input[type="number"]').forEach(function(input) {
        input.style.display = 'inline-block'; // Hiển thị input giá
    });
}

// Hàm để xóa các giá trị đã nhập trong input giá của biến thể cũ
function clearPriceInputs(attributeDiv) {
    attributeDiv.querySelectorAll('.subAttribute input[type="number"]').forEach(function(input) {
        input.style.display = 'none'; // Ẩn input giá
        input.value = ''; // Xóa giá trị
    });
}

// Kiểm tra tên biến thể chính trước khi submit
document.getElementById('attributeForm').addEventListener('submit', function(e) {
    let invalid = false;

    // Kiểm tra tất cả các trường `name` của biến thể chính
    document.querySelectorAll('input[name^="attributes"][name$="[name]"]').forEach(function(input) {
        if (input.value.trim() === '') {
            invalid = true;
            input.classList.add('is-invalid'); // Thêm lớp hiển thị lỗi
        } else {
            input.classList.remove('is-invalid'); // Xóa lớp hiển thị lỗi nếu hợp lệ
        }
    });

    // Nếu có trường bị bỏ trống, không gửi form
    if (invalid) {
        e.preventDefault();
        alert('Bạn phải nhập tên cho tất cả các biến thể chính. Vui lòng kiểm tra lại.'); // Thông báo cho người dùng
    }
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
      .create( document.querySelector( '#description' ), {
          plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
          toolbar: [
  'undo', 'redo', '|', 'bold', 'italic', '|',
  'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
          ]
      } )
      .then( editor => {
          window.editor = editor;
      } )
      .catch( error => {
          console.error( error );
      } );
</script>
<!-- A friendly reminder to run on a server, remove this during the integration. -->
<script>
  window.onload = function() {
      if ( window.location.protocol === "file:" ) {
          alert( "This sample requires an HTTP server. Please serve this file with a web server." );
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
      categorySelect.addEventListener('change', function () {
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