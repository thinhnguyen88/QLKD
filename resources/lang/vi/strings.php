<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm'  => 'Bạn có chắc muốn xóa hoàn toàn người dùng này?',
                'if_confirmed_off'     => '(Nếu chưa xác nhận)',
                'restore_user_confirm' => 'Khôi phục người dùng lại trạng thái ban đầu?',
            ],
        ],

        'dashboard' => [
            'title'   => 'Trang chính',
            'welcome' => 'Chào mừng',
        ],

        'general' => [
            'all_rights_reserved' => 'All Rights Reserved.',
            'are_you_sure'        => 'Bạn có chắc muốn thực hiện?',
            'boilerplate_link'    => 'SLG',
            'continue'            => 'Tiếp tục',
            'member_since'        => 'Tham gia từ',
            'minutes'             => ' phút',
            'search_placeholder'  => 'Tìm kiếm...',
            'timeout'             => 'Bạn đã bị tự động đăng xuất vì không có hành động nào trong ',

            'see_all' => [
                'messages'      => 'Xem tất cả tin nhắn',
                'notifications' => 'Xem tất cả',
                'tasks'         => 'Xem tất cả việc',
            ],

            'status' => [
                'online'  => 'Trực tuyến',
                'offline' => 'Ngoại tuyến',
            ],

            'you_have' => [
                'messages'      => '{0} You don\'t have messages|{1} You have 1 message|[2,Inf] You have :number messages',
                'notifications' => '{0} You don\'t have notifications|{1} You have 1 notification|[2,Inf] You have :number notifications',
                'tasks'         => '{0} You don\'t have tasks|{1} You have 1 task|[2,Inf] You have :number tasks',
            ],
        ],

        'search' => [
            'empty'      => 'Vui lòng nhập từ khóa.',
            'incomplete' => 'You must write your own search logic for this system.',
            'title'      => 'Kết quả tìm kiếm',
            'results'    => 'Kết quả tìm kiếm cho :query',
        ],

        'welcome' => '<p>Chào mừng bạn!</p>',
    ],

    'emails' => [
        'auth' => [
            'account_confirmed' => 'Tài khoản của bạn đã được xác nhận.',
            'error'                   => 'Lỗi!',
            'greeting'                => 'Xin chào!',
            'regards'                 => 'Trân trọng,',
            'trouble_clicking_button' => 'If you’re having trouble clicking the ":action_text" button, copy and paste the URL below into your web browser:',
            'thank_you_for_using_app' => 'Thank you for using our application!',

            'password_reset_subject'    => 'Reset Password',
            'password_cause_of_email'   => 'You are receiving this email because we received a password reset request for your account.',
            'password_if_not_requested' => 'If you did not request a password reset, no further action is required.',
            'reset_password'            => 'Click here to reset your password',

            'click_to_confirm' => 'Click here to confirm your account:',
        ],

        'contact' => [
            'email_body_title' => 'You have a new contact form request: Below are the details:',
            'subject' => 'A new :app_name contact form submission!',
        ],
    ],

    'frontend' => [
        'test' => 'Test',

        'tests' => [
            'based_on' => [
                'permission' => 'Permission Based - ',
                'role'       => 'Role Based - ',
            ],

            'js_injected_from_controller' => 'Javascript Injected from a Controller',

            'using_blade_extensions' => 'Using Blade Extensions',

            'using_access_helper' => [
                'array_permissions'     => 'Using Access Helper with Array of Permission Names or ID\'s where the user does have to possess all.',
                'array_permissions_not' => 'Using Access Helper with Array of Permission Names or ID\'s where the user does not have to possess all.',
                'array_roles'           => 'Using Access Helper with Array of Role Names or ID\'s where the user does have to possess all.',
                'array_roles_not'       => 'Using Access Helper with Array of Role Names or ID\'s where the user does not have to possess all.',
                'permission_id'         => 'Using Access Helper with Permission ID',
                'permission_name'       => 'Using Access Helper with Permission Name',
                'role_id'               => 'Using Access Helper with Role ID',
                'role_name'             => 'Using Access Helper with Role Name',
            ],

            'view_console_it_works'          => 'View console, you should see \'it works!\' which is coming from FrontendController@index',
            'you_can_see_because'            => 'You can see this because you have the role of \':role\'!',
            'you_can_see_because_permission' => 'You can see this because you have the permission of \':permission\'!',
        ],

        'general' => [
            'joined'        => 'Joined',
        ],

        'user' => [
            'change_email_notice' => 'Nếu bạn thay đổi e-mail, bạn sẽ bị đăng xuất ra và xác nhận email mới.',
            'email_changed_notice' => 'Bạn phải xác nhận e-mail mới trước khi đăng nhập.',
            'profile_updated'  => 'Thay đổi hồ sơ thành công.',
            'password_updated' => 'Thay đổi mật khẩu thành công.',
        ],

        'welcome_to' => 'Chào mừng tới :place',
    ],
];
