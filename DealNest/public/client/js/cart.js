$(document).ready(function() {
    // Cấu hình global cho AJAX để bao gồm CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Xử lý sự kiện click để xóa một mục trong giỏ hàng
    $(document).on('click', '.delete-cart-item', function(e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết

        var itemId = $(this).data('id');
        var row = $(this).closest('tr'); // Lấy dòng chứa nút xóa

        $.ajax({
            url: '/cart/' + itemId,
            type: 'DELETE',
            success: function(response) {
                if (response.success) {
                    row.remove(); // Xóa dòng khỏi bảng
                } else {
                    alert('Có lỗi xảy ra!');
                }
            },
            error: function(xhr) {
                alert('Có lỗi xảy ra!');
            }
        });
    });
});