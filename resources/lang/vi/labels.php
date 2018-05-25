<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'     => 'Tất cả',
        'yes'     => 'Có',
        'no'      => 'Không',
        'custom'  => 'Tùy chỉnh',
        'actions' => 'Hành động',
        'active'  => 'Kích hoạt',
        'buttons' => [
            'save'   => 'Lưu',
            'update' => 'Thay đổi',
        ],
        'hide'              => 'Ẩn',
        'inactive'          => 'Không hoạt động',
        'none'              => 'None',
        'show'              => 'Hiển thị',
        'toggle_navigation' => 'Toggle Navigation',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create'     => 'Tạo vai trò',
                'edit'       => 'Thay đổi vai trò',
                'management' => 'Quản lý vai trò',

                'table' => [
                    'number_of_users' => 'Số người dùng',
                    'permissions'     => 'Quyền',
                    'role'            => 'Vai trò',
                    'sort'            => 'Sắp xếp',
                    'total'           => 'role total|roles total',
                ],
            ],

            'users' => [
                'active'              => 'Người dùng đang hoạt động',
                'all_permissions'     => 'Tất cả các quyền',
                'change_password'     => 'Thay đổi mật khẩu',
                'change_password_for' => 'Thay đổi mật khẩu cho :user',
                'create'              => 'Tạo người dùng',
                'deactivated'         => 'Người dùng không hoạt động',
                'deleted'             => 'Người dùng đã bị xóa',
                'edit'                => 'Thay đổi người dùng',
                'management'          => 'Quản lý người dùng',
                'no_permissions'      => 'Không có quyền',
                'no_roles'            => 'Không có vai trò.',
                'permissions'         => 'Quyền',

                'table' => [
                    'confirmed'      => 'Đã xác nhận',
                    'created'        => 'Tạo lúc',
                    'email'          => 'E-mail',
                    'id'             => 'ID',
                    'last_updated'   => 'Thay đổi lần cuối',
                    'name'           => 'Name',
                    'first_name'     => 'Tên',
                    'last_name'      => 'Họ',
                    'no_deactivated' => 'Không có người dùng không hoạt động',
                    'no_deleted'     => 'Không có người dùng đã bị xóa',
                    'roles'          => 'Vai trò',
                    'social' => 'Social',
                    'total'          => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Tổng quan',
                        'history'  => 'Lược sử',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Ảnh đại diện',
                            'confirmed'    => 'Đã xác nhận',
                            'created_at'   => 'Tạo lúc',
                            'deleted_at'   => 'Xóa lúc',
                            'email'        => 'E-mail',
                            'last_updated' => 'Thay đổi lần cuối',
                            'name'         => 'Tên đầy đủ',
                            'first_name'   => 'Tên',
                            'last_name'    => 'Họ',
                            'status'       => 'Trạng thái',
                        ],
                    ],
                ],

                'view' => 'Xem người dùng',
            ],
        ],

        'personnel' => [
            'personnel_management' => 'Quản lý nhân viên',
            'personnel_activities' => 'Nhân viên hoạt động',
            'manage' => 'Quản lý',
            'tab' => [
                'personnel_list' => 'Danh sách nhân viên',
                'business_activities' => 'Hoạt động kinh doanh',
                'form_download' => 'Biểu mẫu Download'
            ],
            'table' => [
                'user_id' => 'id',
                'username' => 'Tên',
                'image' => 'Ảnh',
                'personnel_code' => 'Mã nhân viên',
                'phone' => 'SĐT',
                'email_address' => 'Email',
                'person_in_charge' => 'Người phụ trách',
                'permission' => 'Phân quyền',
            ]
        ]
    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Đăng nhập',
            'login_button'       => 'Đăng nhập',
            'login_with'         => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button'    => 'Register',
            'remember_me'        => 'Lưu phiên đăng nhập',
        ],

        'contact' => [
            'box_title' => 'Contact Us',
            'button' => 'Send Information',
        ],

        'passwords' => [
            'forgot_password'                 => 'Quên mật khẩu?',
            'reset_password_box_title'        => 'Khôi phục mật khẩu',
            'reset_password_button'           => 'Khôi phục mật khẩu',
            'send_password_reset_link_button' => 'Gửi yêu cầu khôi phục mật khẩu',
        ],

        'macros' => [
            'country' => [
                'alpha'   => 'Country Alpha Codes',
                'alpha2'  => 'Country Alpha 2 Codes',
                'alpha3'  => 'Country Alpha 3 Codes',
                'numeric' => 'Country Numeric Codes',
            ],

            'macro_examples' => 'Macro Examples',

            'state' => [
                'mexico' => 'Mexico State List',
                'us'     => [
                    'us'       => 'US States',
                    'outlying' => 'US Outlying Territories',
                    'armed'    => 'US Armed Forces',
                ],
            ],

            'territories' => [
                'canada' => 'Canada Province & Territories List',
            ],

            'timezone' => 'Timezone',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Thay đổi mật khẩu',
            ],

            'profile' => [
                'avatar'             => 'Ảnh đại diện',
                'created_at'         => 'Tạo lúc',
                'edit_information'   => 'Thay đổi thông tin',
                'email'              => 'E-mail',
                'last_updated'       => 'Thay đổi lần cuối',
                'name'               => 'Tên đầy đủ',
                'first_name'         => 'Tên',
                'last_name'          => 'Họ',
                'update_information' => 'Thay đổi thông tin',
            ],
        ],

    ],
];
