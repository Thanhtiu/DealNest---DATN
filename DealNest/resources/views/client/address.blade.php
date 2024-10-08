@extends('layouts/client.app')
@section('content')
<style>
   

   .address-container {
    width: 100%;
    margin: 0 auto;
    background-color: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

h2 {
    margin-top: 0;
    margin-bottom: 20px;
    font-size: 28px;
    color: #333;
}

.address-card {
    padding: 15px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    margin-bottom: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    background-color: #f9f9f9;
}

.address-info p {
    margin: 0;
    padding: 5px 0;
    font-size: 15px;
}

.address-info p strong {
    font-size: 16px;
    color: #333;
}



.address-actions {
    margin-top: 10px;
    display: flex;
    gap: 10px;
}

button, .delete-btn, .set-default-btn {
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.update-btn {
    background-color: #007bff;
    color: white;
}

.update-btn:hover {
    background-color: #0056b3;
}

.delete-btn {
    background-color: #dc3545;
    color: white;
    text-decoration: none;
}

.delete-btn:hover {
    background-color: #c82333;
}

.set-default-btn {
    background-color: #6c757d;
    color: white;
    text-decoration: none;
}

.set-default-btn:hover {
    background-color: #5a6268;
}

.add-new-btn {
    background-color: #007bff;
    color: white;
    padding: 10px 20px;
    font-size: 14px;
    border-radius: 5px;
    margin-bottom: 15px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.add-new-btn:hover {
    background-color: #0056b3;
}

.modal-header {
    background-color: #f1f1f1;
    padding: 15px;
    border-bottom: 1px solid #ddd;
}

.modal-header .modal-title {
    font-size: 20px;
    font-weight: bold;
    color: #333;
}

.modal-body label {
    font-weight: bold;
    margin-bottom: 8px;
}

.modal-body input, .modal-body select {
    padding: 10px;
    margin-bottom: 15px;
    width: 100%;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.modal-footer button {
    padding: 10px 20px;
    font-size: 14px;
    border-radius: 5px;
}

.btn-close {
    background: none;
    border: none;
    font-size: 16px;
    cursor: pointer;
}

.btn-primary {
    background-color: #007bff;
    color: white;
    transition: background-color 0.3s ease;
}

.btn-primary:hover {
    background-color: #0056b3;
}
.default {
    font-size: 14px;
    font-weight: bold;
}

</style>
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('layouts.client.sidebar')
            </div>
            <div class="col-md-9">
                <div class="address-container">
                    <h2>Địa chỉ của tôi</h2>
                    <button class="add-new-btn mb-3" data-bs-toggle="modal" data-bs-target="#addAddressModal">+ Thêm địa
                        chỉ mới</button>
                    @foreach ($address as $item)
                    <div class="address-card">
                        <div class="address-info">
                            <p><strong>{{$item->user->full_name}}</strong> | {{$item->user->id}}</p>
                            <p>{{$item->string_address}}</p>
                            <p>{{$item->street}}</p>
                            @if($item->active === 1)
                            <p class="default">Mặc định</p>
                            @endif
                        </div>
                        <div class="address-actions">
                            <button class="update-btn" data-id="{{ $item->id }}" data-bs-toggle="modal"
                                data-bs-target="#updateAddressModal">Cập nhật</button>

                            <a href="{{ route('account.address.delete', ['id' => $item->id]) }}"
                                class="delete-btn">Xóa</a>

                            <a class="set-default-btn"
                                href="{{route('account.address.setDefault', ['id' => $item->id])}}">Thiết lập mặc định</a>
                        </div>

                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Modal -->
<!-- Modal for adding a new address -->
<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAddressModalLabel">Thêm địa chỉ mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new address -->
                <form id="addAddressForm" action="{{route('account.address.create')}}" method="POST">
                    @csrf
                    <div class="col-6 col-6-ml">
                        <label for="name" class="form-label">Tên người nhận</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="col-6">
                        <label for="phone" class="form-label">Số điện thoại người nhận</label>
                        <input type="text" class="form-control" id="phone" name="phone">
                    </div>

                    <div class="mb-3">
                        <label for="province" class="form-label">Tỉnh/Thành phố</label>
                        <select id="province" name="province" class="form-select" required>
                            <option value="">--Chọn tỉnh thành--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="huyen" class="form-label">Quận/Huyện</label>
                        <select id="huyen" name="district" class="form-select" required>
                            <option value="">--Chọn quận huyện--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="xa" class="form-label">Phường/Xã</label>
                        <select id="xa" name="ward" class="form-select" required>
                            <option value="">--Chọn phường xã--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="string_address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="string_address" readonly name="string_address">
                    </div>
                    <div class="mb-3">
                        <label for="street" class="form-label">Địa chỉ cụ thể</label>
                        <input type="text" class="form-control" id="street" name="street">
                    </div>
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Modal for updating an address -->
<div class="modal fade" id="updateAddressModal" tabindex="-1" aria-labelledby="updateAddressModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateAddressModalLabel">Cập nhật địa chỉ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for updating an address -->
                <form id="updateAddressForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="updateAddressId" name="address_id" value="">
                    <!-- Các trường input như tỉnh, huyện, xã và địa chỉ -->
                    <div class="col-6 col-6-ml">
                        <label for="update_name" class="form-label">Tên người nhận</label>
                        <input type="text" class="form-control" id="update_name" name="name">
                    </div>
                    <div class="col-6">
                        <label for="update_phone" class="form-label">Số điện thoại người nhận</label>
                        <input type="text" class="form-control" id="update_phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="updateProvince" class="form-label">Tỉnh/Thành phố</label>
                        <select id="updateProvince" name="province" class="form-select" required>
                            <option value="">--Chọn tỉnh thành--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="updateDistrict" class="form-label">Quận/Huyện</label>
                        <select id="updateDistrict" name="district" class="form-select" required>
                            <option value="">--Chọn quận huyện--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="updateWard" class="form-label">Phường/Xã</label>
                        <select id="updateWard" name="ward" class="form-select" required>
                            <option value="">--Chọn phường xã--</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="string_address" class="form-label">Địa chỉ</label>
                        <input type="text" class="form-control" id="update_string_address" readonly
                            name="string_address">
                    </div>
                    <div class="mb-3">
                        <label for="updateStreet" class="form-label">Địa chỉ cụ thể</label>
                        <input type="text" class="form-control" id="updateStreet" name="street">
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const deleteUrl = this.href;

                // Show confirmation using SweetAlert2
                Swal.fire({
                    title: 'Xóa địa chỉ',
                    text: 'Bạn có chắc chắn muốn xóa địa chỉ này? Bạn sẽ không thể phục hồi dữ liệu!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, xóa nó!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                    }
                });
            });
        });
    });
</script>



<script>
    document.querySelectorAll('.update-btn').forEach(button => {
        button.addEventListener('click', function() {
            const addressId = this.getAttribute('data-id');
            document.getElementById('updateAddressId').value = addressId;
            const updateForm = document.getElementById('updateAddressForm');
            updateForm.action = `/tai-khoan-cua-toi/dia-chi/cap-nhat/${addressId}`;

            // Call API to fetch current address data
            fetch(`/tai-khoan-cua-toi/dia-chi/sua/${addressId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Fetched address data:', data);

                    // Fetch and update provinces, then districts, then wards
                    updateProvinces(data.province, () => {
                        updateDistricts(data.district, () => {
                            updateWards(data.ward);
                        });
                    });

                    // Set the address and street values
                    document.getElementById('update_string_address').value = data.string_address;
                    document.getElementById('updateStreet').value = data.street;
                    document.getElementById('update_name').value = data.name;
                    document.getElementById('update_phone').value = data.phone;

                })
                .catch(error => console.error('Error fetching address:', error));
        });
    });

    function updateProvinces(selectedProvinceId = null, callback = () => {}) {
        fetch('https://esgoo.net/api-tinhthanh/1/0.htm')
            .then(response => response.json())
            .then(data => {
                const provinces = data.data;
                const provinceSelect = document.getElementById('updateProvince');
                provinceSelect.innerHTML = '<option value="">--Chọn tỉnh thành--</option>';
                provinces.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.id;
                    option.text = province.name;
                    provinceSelect.appendChild(option);
                });
                if (selectedProvinceId) {
                    provinceSelect.value = selectedProvinceId;
                }
                callback(); // Ensure callback is executed after provinces are loaded
            })
            .catch(error => console.error('Error fetching provinces:', error));
    }

    function updateDistricts(selectedDistrictId = null, callback = () => {}) {
        const provinceId = document.getElementById('updateProvince').value;
        if (provinceId) {
            fetch(`https://esgoo.net/api-tinhthanh/2/${provinceId}.htm`)
                .then(response => response.json())
                .then(data => {
                    const districts = data.data;
                    const districtSelect = document.getElementById('updateDistrict');
                    districtSelect.innerHTML = '<option value="">--Chọn quận huyện--</option>';
                    districts.forEach(district => {
                        const option = document.createElement('option');
                        option.value = district.id;
                        option.text = district.name;
                        districtSelect.appendChild(option);
                    });
                    if (selectedDistrictId) {
                        districtSelect.value = selectedDistrictId;
                    }
                    callback(); // Ensure callback is executed after districts are loaded
                })
                .catch(error => console.error('Error fetching districts:', error));
        } else {
            // Clear districts and wards if no province is selected
            document.getElementById('updateDistrict').innerHTML = '<option value="">--Chọn quận huyện--</option>';
            document.getElementById('updateWard').innerHTML = '<option value="">--Chọn phường xã--</option>';
        }
    }

    function updateWards(selectedWardId = null) {
        const districtId = document.getElementById('updateDistrict').value;
        if (districtId) {
            fetch(`https://esgoo.net/api-tinhthanh/3/${districtId}.htm`)
                .then(response => response.json())
                .then(data => {
                    const wards = data.data;
                    const wardSelect = document.getElementById('updateWard');
                    wardSelect.innerHTML = '<option value="">--Chọn phường xã--</option>';
                    wards.forEach(ward => {
                        const option = document.createElement('option');
                        option.value = ward.id;
                        option.text = ward.name;
                        wardSelect.appendChild(option);
                    });
                    if (selectedWardId) {
                        wardSelect.value = selectedWardId;
                    }
                    updateStringAddress(); // Update the address when wards are updated
                })
                .catch(error => console.error('Error fetching wards:', error));
        } else {
            // Clear wards if no district is selected
            document.getElementById('updateWard').innerHTML = '<option value="">--Chọn phường xã--</option>';
        }
    }

    function updateStringAddress() {
        const province = document.getElementById('updateProvince').options[document.getElementById('updateProvince').selectedIndex]?.text || '';
        const district = document.getElementById('updateDistrict').options[document.getElementById('updateDistrict').selectedIndex]?.text || '';
        const ward = document.getElementById('updateWard').options[document.getElementById('updateWard').selectedIndex]?.text || '';

        const stringAddress = `${province}, ${district}, ${ward}`;
        document.getElementById('update_string_address').value = stringAddress;
    }

    // Event listeners for dropdown changes
    document.getElementById('updateProvince').addEventListener('change', function() {
        updateDistricts(() => {
            updateStringAddress();
        });
    });

    document.getElementById('updateDistrict').addEventListener('change', function() {
        updateWards();
    });

    document.getElementById('updateWard').addEventListener('change', function() {
        updateStringAddress();
    });

    // Initial fetch of provinces
    updateProvinces();
</script>

















<script>
    // Function to update the string_address input
    function updateAddress() {
        const provinceName = document.getElementById('province').selectedOptions[0]?.text || '';
        const districtName = document.getElementById('huyen').selectedOptions[0]?.text || '';
        const wardName = document.getElementById('xa').selectedOptions[0]?.text || '';

        // Concatenate the selected values
        const addressString = `${provinceName}, ${districtName}, ${wardName}`;

        // Set the value of the string_address input
        document.getElementById('string_address').value = addressString;
    }

    // Fetch provinces
    fetch('https://esgoo.net/api-tinhthanh/1/0.htm')
        .then(response => response.json())
        .then(data => {
            const datanew = data.data;
            const provinceSelect = document.getElementById('province');
            datanew.forEach(province => {
                const option = document.createElement('option');
                option.value = province.id;
                option.text = province.name;
                provinceSelect.add(option);
            });
        })
        .catch(error => console.error('Error fetching provinces:', error));

    // Handle province change
    document.getElementById('province').addEventListener('change', function() {
        const provinceId = this.value;

        if (provinceId) {
            fetch(`https://esgoo.net/api-tinhthanh/2/${provinceId}.htm`)
                .then(response => response.json())
                .then(data => {
                    const datanew = data.data;
                    const huyenSelect = document.getElementById('huyen');
                    huyenSelect.innerHTML = '<option value="">--Chọn quận huyện--</option>';
                    datanew.forEach(huyen => {
                        const option = document.createElement('option');
                        option.value = huyen.id;
                        option.text = huyen.name;
                        huyenSelect.add(option);
                    });

                    // Reset the ward dropdown and update the address input
                    document.getElementById('xa').innerHTML = '<option value="">--Chọn phường xã--</option>';
                    updateAddress();
                })
                .catch(error => console.error('Error fetching districts:', error));
        } else {
            document.getElementById('huyen').innerHTML = '<option value="">--Chọn quận huyện--</option>';
            document.getElementById('xa').innerHTML = '<option value="">--Chọn phường xã--</option>';
            updateAddress();
        }
    });

    // Handle district change
    document.getElementById('huyen').addEventListener('change', function() {
        const districtId = this.value;

        if (districtId) {
            fetch(`https://esgoo.net/api-tinhthanh/3/${districtId}.htm`)
                .then(response => response.json())
                .then(data => {
                    const datanew = data.data;
                    const wardSelect = document.getElementById('xa');
                    wardSelect.innerHTML = '<option value="">--Chọn phường xã--</option>';
                    datanew.forEach(ward => {
                        const option = document.createElement('option');
                        option.value = ward.id;
                        option.text = ward.name;
                        wardSelect.add(option);
                    });

                    // Update the address input
                    updateAddress();
                })
                .catch(error => console.error('Error fetching wards:', error));
        } else {
            document.getElementById('xa').innerHTML = '<option value="">--Chọn phường xã--</option>';
            updateAddress();
        }
    });

    // Handle ward change
    document.getElementById('xa').addEventListener('change', function() {
        updateAddress();
    });
</script>
@endsection