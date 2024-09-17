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


          <!-- Cover Image Upload Section -->
          <div class="form-group">
            <label class="form-label">* Thêm hình ảnh</label>
            <div class="file-upload-container">
              <label for="img" class="file-upload-info" id="fileUploadInfo">Thêm hình ảnh (0/5)</label>
              <input type="file" id="img" name="img[]" class="file-upload-default" multiple>
              <img id="coverImagePreview" src="#" alt="Cover Image Preview" style="display: none; margin-top: 10px;" />
            </div>
            <p class="mt-2 text-muted">
              • Tải lên hình ảnh 1:1. Ảnh bìa sẽ được hiển thị tại các trang Kết quả tìm kiếm, Gợi ý hôm nay,...
            </p>
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
                    <div class="form-group col-12">
                      <label>Thuộc tính sản phẩm</label>
                      <div class="checkbox-container">
                        @foreach($attribute as $item)
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="attribute-{{$item->id}}"
                            data-id="{{$item->id}}" data-name="{{$item->name}}" name="attributes[{{$item->id}}][]"
                            value="{{$item->id}}">
                          <label class="form-check-label" for="attribute-{{$item->id}}">
                            {{$item->name}}
                          </label>
                        </div>
                        @endforeach
                      </div>
                    </div>
                    <div class="attribute-inputs col-12">
                      <!-- Inputs for attributes will be dynamically generated here -->
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

    document.getElementById('img').addEventListener('change', function() {
        var fileInput = this;
        var fileCount = fileInput.files.length;
        var fileUploadInfo = document.getElementById('fileUploadInfo');
        fileUploadInfo.textContent = `Thêm hình ảnh (${fileCount}/5)`;
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

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const checkboxContainer = document.querySelector('.checkbox-container');
    const attributeInputs = document.querySelector('.attribute-inputs');

    checkboxContainer.addEventListener('change', function(event) {
        if (event.target.type === 'checkbox') {
            const checkbox = event.target;
            const attributeId = checkbox.dataset.id;
            const attributeName = checkbox.dataset.name;
            const attributeDivId = `attribute-group-${attributeId}`;

            let attributeDiv = document.getElementById(attributeDivId);

            if (checkbox.checked) {
                if (!attributeDiv) {
                    attributeDiv = document.createElement('div');
                    attributeDiv.id = attributeDivId;
                    attributeDiv.className = 'attribute-input-group';
                    attributeDiv.innerHTML = `
                        <label>${attributeName}:</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nhập giá trị ${attributeName}" name="attributes[${attributeId}][]">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary btn-add-value" type="button">Thêm</button>
                            </div>
                        </div>
                    `;
                    attributeInputs.appendChild(attributeDiv);

                    setupInputListeners(attributeDiv);
                }
            } else {
                if (attributeDiv) {
                    attributeDiv.remove();
                }
            }
        }
    });

    function setupInputListeners(parentDiv) {
        parentDiv.querySelector('.btn-add-value').addEventListener('click', function () {
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mb-3';
            inputGroup.innerHTML = `
                <input type="text" class="form-control" placeholder="Nhập giá trị" name="attributes[${parentDiv.id.replace('attribute-group-', '')}][]">
                <div class="input-group-append">
                    <button class="btn btn-danger btn-remove-value" type="button">Xóa</button>
                </div>
            `;

            parentDiv.appendChild(inputGroup);

            inputGroup.querySelector('.btn-remove-value').addEventListener('click', function () {
                inputGroup.remove();
            });
        });
    }
});

</script>