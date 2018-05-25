<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'roles' => [
            'created' => 'Vai trò đã đươc tạo.',
            'deleted' => 'Vai trò đã được xóa.',
            'updated' => 'Vai trò đã được thay đổi.',
        ],

        'users' => [
            'cant_resend_confirmation' => 'The application is currently set to manually approve users.',
            'confirmation_email'  => 'A new confirmation e-mail has been sent to the address on file.',
            'confirmed'              => 'The user was successfully confirmed.',
            'created'             => 'Người dùng đã được tạo.',
            'deleted'             => 'Người dùng đã được xóa.',
            'deleted_permanently' => 'Người dùng đã được xóa hoàn toàn.',
            'restored'            => 'Người dùng đã được khôi phục.',
            'session_cleared'      => "Phiên sử dụng của người dùng đã được xóa.",
            'social_deleted' => 'Social Account Successfully Removed',
            'unconfirmed' => 'The user was successfully un-confirmed',
            'updated'             => 'Người dùng đã được thay đổi.',
            'updated_password'    => "Mật khẩu người dùng đã được thay đổi.",
        ],
    ],

    'frontend' => [
        'contact' => [
            'sent' => 'Your information was successfully sent. We will respond back to the e-mail provided as soon as we can.',
        ],
    ],
];
