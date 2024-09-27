document.addEventListener('DOMContentLoaded', function() {
    // const uploadButtons = document.querySelectorAll('.file-upload-browse');
    
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
  
    // Category and Subcategory select functionality
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
  
      categorySelect.addEventListener('change', function () {
        const categoryId = this.value;
        populateSubCategories(categoryId);
      });
    }
  
    const checkboxContainer = document.querySelector('.checkbox-container');
  const attributeInputs = document.querySelector('.attribute-inputs');
  
  checkboxContainer.addEventListener('change', function(event) {
    if (event.target.type === 'checkbox') {
      const checkbox = event.target;
      const attributeId = checkbox.dataset.id;  
      const attributeName = checkbox.dataset.name;  
  
      if (checkbox.checked) {
        if (!document.querySelector(`.attribute-input-group[data-id="${attributeId}"]`)) {
          const attributeDiv = document.createElement('div');
          attributeDiv.className = 'attribute-input-group';
          attributeDiv.dataset.id = attributeId;
          attributeDiv.innerHTML = `
            <label>${attributeName}:</label>
            <input type="text" name="attributes[${attributeId}][]" placeholder="Nhập giá trị ${attributeName}" class="form-control">
            <button type="button" class="btn btn-primary btn-add-value">Thêm</button>
          `;
          attributeInputs.appendChild(attributeDiv);
  
          // Add event listener for 'Add' button
          attributeDiv.querySelector('.btn-add-value').addEventListener('click', function() {
            const inputGroup = document.createElement('div');
            inputGroup.className = 'input-group mt-2';
  
            const input = document.createElement('input');
            input.type = 'text';
            input.name = `attributes[${attributeId}][]`;
            input.className = 'form-control';
            input.placeholder = `Nhập giá trị ${attributeName}`;
            
            const deleteButton = document.createElement('button');
            deleteButton.type = 'button';
            deleteButton.textContent = 'Xóa';
            deleteButton.className = 'btn btn-danger btn-delete-value';
  
            deleteButton.addEventListener('click', function() {
              inputGroup.remove();
            });
  
            inputGroup.appendChild(input);
            inputGroup.appendChild(deleteButton);
  
            attributeDiv.insertBefore(inputGroup, this);
          });
        }
      } else {
        const attributeGroup = document.querySelector(`.attribute-input-group[data-id="${attributeId}"]`);
        if (attributeGroup) {
          attributeGroup.remove();
        }
      }
    }
  });
  
  
  
  attributeInputs.addEventListener('click', function(event) {
    if (event.target.classList.contains('btn-delete-value')) {
      event.target.previousElementSibling.remove(); 
      event.target.remove(); 
    }
  });
  
  });