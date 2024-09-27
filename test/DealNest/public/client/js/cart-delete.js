$(document).ready(function() {
    // Configure global AJAX settings to include CSRF token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Handle click event to delete a cart item
    $(document).on('click', '.delete-cart-item', function(e) {
        e.preventDefault(); // Prevent the default link behavior

        var itemId = $(this).data('id');
        var row = $(this).closest('tr'); // Get the row containing the delete button

        $.ajax({
            url: '/cart/' + itemId,
            type: 'DELETE',
            success: function(response) {
                if (response.success) {
                    row.remove(); // Remove the row from the table
                    toastr.success(response.message, 'Thành công!');
                } else {
                    toastr.error(response.message, 'Lỗi!');
                }
            },
            error: function(xhr) {
                toastr.error('Có lỗi xảy ra, vui lòng thử lại.', 'Lỗi!');
            }
        });
    });
});