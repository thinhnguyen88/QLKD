<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in Exceptions thrown throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'roles' => [
                'already_exists'    => 'Tên vai trò đã tồn tại.',
                'cant_delete_admin' => 'Không thể xóa quyền quản trị.',
                'create_error'      => 'Có lỗi khi tạo vai trò này.',
                'delete_error'      => 'Có lỗi khi xóa vai trò này.',
                'has_users'         => 'Không thể xóa vai trò đang liên kết với người dùng.',
                'needs_permission'  => 'Phải lựa chọn ít nhất một quyền cho vai trò này.',
                'not_found'         => 'Vai trò này không tồn tại.',
                'update_error'      => 'Có lỗi khi thay đổi vai trò này.',
            ],

            'users' => [
                'already_confirmed'    => 'Người dùng này đã xác nhận.',
                'cant_confirm' => 'Có lỗi khi xác nhận người dùng.',
                'cant_deactivate_self'  => 'Không thể ngừng hoạt động chính mình.',
                'cant_delete_admin'  => 'Không thể xóa quản trị viên.',
                'cant_delete_self'      => 'Không thể xóa chính mình.',
                'cant_delete_own_session' => 'Không thể xóa piên sử dụng của chính mình.',
                'cant_restore'          => 'Người dùng này chưa bị xóa nên khổng thể khôi phục.',
                'cant_unconfirm_admin' => 'Không thể hủy xác nhận quản trị viên.',
                'cant_unconfirm_self' => 'Không thể hủy xác nhận chính mình.',
                'create_error'          => 'Có lỗi khi tạo người dùng này.',
                'delete_error'          => 'Có lỗi khi xóa người dùng này.',
                'delete_first'          => 'Phải xóa người dùng này trước khi thực hiện xóa hoàn toàn.',
                'email_error'           => 'E-Mail này thuộc về người dùng khác.',
                'mark_error'            => 'Có lỗi khi thay đổi người dùng này.',
                'not_confirmed'            => 'Người dùng này chưa được xác nhận.',
                'not_found'             => 'Người dùng này không tồn tại.',
                'restore_error'         => 'Có lỗi khi khôi phục người dùng này.',
                'role_needed_create'    => 'Phải chọn ít nhất một vai trò.',
                'role_needed'           => 'Phải chọn ít nhất một vai trò.',
                'session_wrong_driver'  => 'Your session driver must be set to database to use this feature.',
                'social_delete_error' => 'There was a problem removing the social account from the user.',
                'update_error'          => 'Có lỗi khi thay đổi người dùng này.',
                'update_password_error' => 'Có lỗi khi thay đổi mật khẩu người dùng này.',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'Your account is already confirmed.',
                'confirm'           => 'Confirm your account!',
                'created_confirm'   => 'Your account was successfully created. We have sent you an e-mail to confirm your account.',
                'created_pending'   => 'Your account was successfully created and is pending approval. An e-mail will be sent when your account is approved.',
                'mismatch'          => 'Your confirmation code does not match.',
                'not_found'         => 'That confirmation code does not exist.',
                'pending'            => 'Your account is currently pending approval.',
                'resend'            => 'Your account is not confirmed. Please click the confirmation link in your e-mail, or <a href="'.route('frontend.auth.account.confirm.resend', ':user_id').'">click here</a> to resend the confirmation e-mail.',
                'success'           => 'Your account has been successfully confirmed!',
                'resent'            => 'A new confirmation e-mail has been sent to the address on file.',
            ],

            'deactivated' => 'Tài khoản đã ngừng hoạt động.',
            'email_taken' => 'E-Mail này đã được sử dụng.',

            'password' => [
                'change_mismatch' => 'Mật khẩu cũ không đúng.',
                'reset_problem' => 'Có lỗi khi khôi phục mật khẩu. Vui lòng gửi lại yêu cầu khôi phục mật khẩu.',
            ],

            'registration_disabled' => 'Đăng ký đang tạm đóng.',
        ],
    ],
];
