<?php

return [
    'shield_resource' => [
        'should_register_navigation' => 'Đăng ký điều hướng',
        'slug' => 'shield/roles',
        'navigation_sort' => 'Sắp xếp điều hướng',
        'navigation_badge' => 'Biểu tượng điều hướng',
        'navigation_group' => 'Nhóm điều hướng',
        'is_globally_searchable' => 'Có thể tìm kiếm toàn cầu',
        'show_model_path' => 'Hiển thị đường dẫn mô hình',
        'is_scoped_to_tenant' => 'Chỉ áp dụng cho tenant',
        'cluster' => 'Cụm',
    ],

    'super_admin' => [
        'enabled' => 'Kích hoạt',
        'name' => 'super_admin',
        'define_via_gate' => 'Định nghĩa qua cổng',
        'intercept_gate' => 'Intercept Gate',
    ],

    'panel_user' => [
        'enabled' => 'Kích hoạt',
        'name' => 'panel_user',
    ],

    'permission_prefixes' => [
        'resource' => [
            'view' => 'Xem',
            'view_any' => 'Xem bất kỳ',
            'create' => 'Tạo',
            'update' => 'Cập nhật',
            'restore' => 'Khôi phục',
            'restore_any' => 'Khôi phục bất kỳ',
            'replicate' => 'Sao chép',
            'reorder' => 'Sắp xếp lại',
            'delete' => 'Xóa',
            'delete_any' => 'Xóa bất kỳ',
            'force_delete' => 'Xóa vĩnh viễn',
            'force_delete_any' => 'Xóa vĩnh viễn bất kỳ',
        ],

        'page' => 'Trang',
        'widget' => 'Widget',
    ],
];
