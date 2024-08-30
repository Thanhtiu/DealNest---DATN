<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopee - Become a Seller</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .header-wrapper {
            background-color: #fff;
            padding: 10px;
        }
        h2 {
            display: block;
    font-size: 1.5em;
    margin-block-start: 0.83em;
    margin-block-end: 0.83em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
    unicode-bidi: isolate;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

        .card {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 900px;
            height: 700px;
        }

        .progress-bar {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .progress-bar .step {
            width: 15%;
            text-align: center;
        }

        .progress-bar .step.active {
            color: #ff3333;
        }

        .progress-bar .line {
            flex-grow: 1;
            height: 2px;
            background-color: #ccc;
        }

        .progress-bar .line.active {
            background-color: #ff3333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .button-wrapper {
            display: flex;
            justify-content: space-between;
        }

        .button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
        }

        .button-primary {
            background-color: #ff3333;
            color: #fff;
        }

        .button-secondary {
            background-color: #ccc;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="header-wrapper">
        <h2>Đăng ký trở thành Người bán DealNest</h2>
    </div>
    <div class="container">
        <div class="card">
            <div class="progress-bar">
                <div class="step active">Thông tin Shop</div>
                <div class="line active"></div>
                <div class="step">Cài đặt vận chuyển</div>
                <div class="line"></div>
                <div class="step">Thông tin thuế</div>
                <div class="line"></div>
                <div class="step">Thông tin định danh</div>
                <div class="line"></div>
                <div class="step">Hoàn tất</div>
            </div>
            <form action="{{route('seller.register.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="shop-name">Tên Shop*</label>
                    <input type="text" id="shop-name" placeholder="Tên Shop" value="" name="store_name">
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ cửa hàng*</label>
                    <!-- Dropdown select elements in a row -->
                    <div class="row">
                        <!-- Province select -->
                        <div class="col-md-4">
                            <select id="province" name="province" class="form-control" required>
                                <option value="">Chọn tỉnh thành</option>
                            </select>
                        </div>
                        <!-- District select -->
                        <div class="col-md-4">
                            <select id="huyen" name="district" class="form-control" required>
                                <option value="">Chọn huyện</option>
                            </select>
                        </div>
                        <!-- Ward select -->
                        <div class="col-md-4">
                            <select id="xa" name="ward" class="form-control" required>
                                <option value="">Chọn xã</option>
                            </select>
                        </div>
                    </div>
                
                    <div class="form-group" style="margin-top: 15px;">
                        <label for="email">Địa chỉ hiện tại của bạn là*</label>
                        <input type="text" name="string_address" id="string_address" readonly>
                    </div>
                    <div class="form-group" style="margin-top: 15px;">
                        <label for="street">Đường cụ thể</label>
                        <input type="text" name="street" id="street">
                    </div>
                
                <div class="form-group">
                    <label for="email">Email*</label>
                    <input type="email" id="email" placeholder="Email" value="{{ old('email', $user->email ?? '') }}" name="store_email">
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label for="store_phone">Số điện thoại*</label>
                    <input type="tel" id="store_phone" placeholder="Số điện thoại" value="{{old ('phone', $user->phone ?? '')}}" name="store_phone">
                </div>
                <div class="button-wrapper">
                    <button type="submit" class="button button-primary">Tiếp theo</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg"> <!-- Added modal-lg class for larger modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Địa Chỉ Lấy Hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="full-name">Họ tên*</label>
                        <input type="text" id="full-name" class="form-control" placeholder="Họ tên">
                    </div>
                    <div class="form-group">
                        <label for="modal-phone">Số điện thoại*</label>
                        <input type="tel" id="modal-phone" class="form-control" placeholder="Số điện thoại">
                    </div>
                    <div class="form-group">
                        <label for="modal-address">Địa chỉ*</label>
                        <textarea id="modal-address" class="form-control" placeholder="Địa chỉ"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-success">Lưu Địa Chỉ</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script>
    // Function to update the string_address input
    function updateAddress() {
        const provinceName = document.getElementById('province').selectedOptions[0].text;
        const districtName = document.getElementById('huyen').selectedOptions[0].text;
        const wardName = document.getElementById('xa').selectedOptions[0].text;
        
        // Concatenate the selected values
        const addressString = `${provinceName} , ${districtName} , ${wardName}`;
        
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
        .catch(error => console.error('Error:', error));

    // Handle province change
    document.getElementById('province').addEventListener('change', function() {
        const provinceId = this.value;

        if (provinceId) {
            fetch(`https://esgoo.net/api-tinhthanh/2/${provinceId}.htm`)
                .then(response => response.json())
                .then(data => {
                    const datanew = data.data;
                    const huyenSelect = document.getElementById('huyen');
                    huyenSelect.innerHTML = '<option value="">--Chọn huyện--</option>';
                    datanew.forEach(huyen => {
                        const option = document.createElement('option');
                        option.value = huyen.id;
                        option.text = huyen.name;
                        huyenSelect.add(option);
                    });
                    
                    // Reset the ward dropdown and update the address input
                    document.getElementById('xa').innerHTML = '<option value="">--Chọn xã--</option>';
                    updateAddress();
                })
                .catch(error => console.error('Error:', error));
        } else {
            document.getElementById('huyen').innerHTML = '<option value="">--Chọn huyện--</option>';
            document.getElementById('xa').innerHTML = '<option value="">--Chọn xã--</option>';
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
                    wardSelect.innerHTML = '<option value="">--Chọn xã--</option>';
                    datanew.forEach(ward => {
                        const option = document.createElement('option');
                        option.value = ward.id;
                        option.text = ward.name;
                        wardSelect.add(option);
                    });
                    
                    // Update the address input
                    updateAddress();
                })
                .catch(error => console.error('Error:', error));
        } else {
            document.getElementById('xa').innerHTML = '<option value="">--Chọn xã--</option>';
            updateAddress();
        }
    });

    // Handle ward change
    document.getElementById('xa').addEventListener('change', function() {
        updateAddress();
    });
</script>



</body>
</html>
