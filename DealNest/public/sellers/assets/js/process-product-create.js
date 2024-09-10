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

    
    const checkboxContainer = document.querySelector('.checkbox-container');
const attributeInputs = document.querySelector('.attribute-inputs');

checkboxContainer.addEventListener('change', function(event) {
  if (event.target.type === 'checkbox') {
    const checkbox = event.target;
    const attributeId = checkbox.dataset.id;  // Lấy ID của thuộc tính
    const attributeName = checkbox.dataset.name;  // Lấy tên thuộc tính

    if (checkbox.checked) {
      // Tạo nhóm input mới cho thuộc tính
      const attributeDiv = document.createElement('div');
      attributeDiv.className = 'attribute-input-group';
      attributeDiv.innerHTML = `
        <label>${attributeName}:</label>
        <input type="text" name="attributes[${attributeId}][]" placeholder="Nhập giá trị ${attributeName}" class="form-control">
        <button type="button" class="btn btn-primary btn-add-value">Thêm</button>
      `;
      attributeInputs.appendChild(attributeDiv);

      // Thêm sự kiện cho nút 'Thêm'
      attributeDiv.querySelector('.btn-add-value').addEventListener('click', function() {
        const input = document.createElement('input');
        input.type = 'text';
        input.name = `attributes[${attributeId}][]`;
        input.className = 'form-control';
        input.placeholder = `Nhập giá trị ${attributeName}`;
        
        // Tạo nút Xóa
        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.textContent = 'Xóa';
        deleteButton.className = 'btn btn-danger btn-delete-value';
        
        // Thêm sự kiện cho nút Xóa
        deleteButton.addEventListener('click', function() {
          input.remove();
          deleteButton.remove();
        });

        // Thêm input và nút xóa vào nhóm thuộc tính
        attributeDiv.insertBefore(input, this);
        attributeDiv.insertBefore(deleteButton, this);
      });
    } else {
      // Xóa nhóm input nếu checkbox bị bỏ chọn
      const attributeGroups = document.querySelectorAll('.attribute-input-group');
      attributeGroups.forEach(group => {
        if (group.querySelector('label').textContent === `${attributeName}:`) {
          group.remove();
        }
      });
    }
  }
});


  });
