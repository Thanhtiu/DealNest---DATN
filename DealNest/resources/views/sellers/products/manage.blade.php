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
            <label for="categorySelect" class="form-label">Thể loại</label>
            <select class="form-select" id="categorySelect">
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
                <form>
                  <div class="row">
                    <!-- Select Thể loại con -->
                    <div class="form-group">
                      <label for="subCategorySelect" class="form-label">Thể loại con</label>
                      <select class="form-select" id="subCategorySelect">
                        <option value="">Chọn thể loại con</option>
                        <!-- Thể loại con sẽ được thêm tự động bởi JavaScript -->
                      </select>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="form-group">
              <label for="exampleInputName1">Giá</label>
              <input type="text" class="form-control" id="exampleInputName1" placeholder="Giá">
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
            <label for="exampleTextarea1">Mô tả</label>
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
            <label for="exampleFormControlSelect1">Số lượng</label>
            <input type="text" class="form-control">
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
        <div class="container mt-4">
          <div class="row">
            <div class="form-group col-6">
              <label>Màu sắc</label>
              <div id="colorContainer">
                <div class="form-group d-flex align-items-center">
                  <input type="text" class="form-control me-2" placeholder="Nhập màu sắc">
                  <button type="button" class="btn btn-primary" onclick="addColor()">Thêm</button>
                </div>
              </div>
            </div>
            <div class="form-group col-6">
              <label>Kích cỡ</label>
              <div id="sizeContainer">
                <div class="form-group d-flex align-items-center">
                  <input type="text" class="form-control me-2" placeholder="Nhập kích cỡ">
                  <button type="button" class="btn btn-primary" onclick="addSize()">Thêm</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        
      </div>
    </div>
  </div>
</div>
@endsection
<script>
  document.addEventListener('DOMContentLoaded', function() {
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



  function addColor() {
    const colorContainer = document.getElementById('colorContainer');
    const newColorInput = document.createElement('div');
    newColorInput.className = 'form-group d-flex align-items-center mt-2';
    newColorInput.innerHTML = `
      <input type="text" class="form-control me-2" placeholder="Nhập màu sắc">
      <button type="button" class="btn btn-danger" onclick="removeElement(this)">Xóa</button>
    `;
    colorContainer.appendChild(newColorInput);
  }

  function addSize() {
    const sizeContainer = document.getElementById('sizeContainer');
    const newSizeInput = document.createElement('div');
    newSizeInput.className = 'form-group d-flex align-items-center mt-2';
    newSizeInput.innerHTML = `
      <input type="text" class="form-control me-2" placeholder="Nhập kích cỡ">
      <button type="button" class="btn btn-danger" onclick="removeElement(this)">Xóa</button>
    `;
    sizeContainer.appendChild(newSizeInput);
  }

  function removeElement(button) {
    button.parentElement.remove();
  }
</script>