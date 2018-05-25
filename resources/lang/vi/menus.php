<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'Quản lý truy cập',

            'roles' => [
                'all'        => 'Tất cả vai trò',
                'create'     => 'Tạo vai trò',
                'edit'       => 'Thay đổi vai trò',
                'management' => 'Quản lý vai trò',
                'main'       => 'Vai trò',
            ],

            'users' => [
                'all'             => 'Tất cả người dùng',
                'change-password' => 'Thay đổi mật khẩu',
                'create'          => 'Tạo người dùng',
                'deactivated'     => 'Người dùng không hoạt động',
                'deleted'         => 'Người dùng đã bị xóa',
                'edit'            => 'Thay đổi người dùng',
                'main'            => 'Người dùng',
                'view'            => 'Xem người dùng',
            ],
        ],

        'log-viewer' => [
            'main'      => 'Xem Log',
            'dashboard' => 'Tổng quan',
            'logs'      => 'Logs',
        ],

        'sidebar' => [
            'dashboard' => 'Tổng quan',
            'general'   => 'Chung',
            'system'    => 'Hệ thống',
        ],
    ],

    'language-picker' => [
        'language' => 'Language',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar'    => 'Arabic',
            'zh'    => 'Chinese Simplified',
            'zh-TW' => 'Chinese Traditional',
            'da'    => 'Danish',
            'de'    => 'German',
            'el'    => 'Greek',
            'en'    => 'English',
            'es'    => 'Spanish',
            'fr'    => 'French',
            'id'    => 'Indonesian',
            'it'    => 'Italian',
            'ja'    => 'Japanese',
            'nl'    => 'Dutch',
            'pt_BR' => 'Brazilian Portuguese',
            'ru'    => 'Russian',
            'sv'    => 'Swedish',
            'th'    => 'Thai',
            'tr'    => 'Turkish',
            'vi'    => 'Tiếng Việt',
        ],
    ],
];
