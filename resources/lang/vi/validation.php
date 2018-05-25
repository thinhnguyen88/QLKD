<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute phải được chấp nhấn.',
    'active_url'           => ':attribute khổng phải ỦL hợp lệ.',
    'after'                => ':attribute phải trước thời gian :date.',
    'after_or_equal'       => ':attribute phải trước hoặc bằng thời gian :date.',
    'alpha'                => ':attribute chỉ bao gồm chữ cái.',
    'alpha_dash'           => ':attribute chỉ bao gồm chữ cái, số, gạch ngang.',
    'alpha_num'            => ':attribute chỉ bao gồm chữ cái và số.',
    'array'                => ':attribute phải là một mảng.',
    'before'               => ':attribute phải sau thời gian :date.',
    'before_or_equal'      => ':attribute phải sau hoặc bằng thời gian :date.',
    'between'              => [
        'numeric' => ':attribute phải nằm giữa :min và :max.',
        'file'    => ':attribute phải nằm giữa :min và :max kilobytes.',
        'string'  => ':attribute phải nằm giữa :min và :max ký tự.',
        'array'   => ':attribute phải nằm giữa :min và :max items.',
    ],
    'boolean'              => ':attribute phải đung hoặc false.',
    'confirmed'            => ':attribute xác nhận không chính xác.',
    'date'                 => ':attribute không phải là thời gian hợp lệ.',
    'date_format'          => ':attribute không đúng định dạng :format.',
    'different'            => ':attribute và :other phải khác nhau.',
    'digits'               => ':attribute phải là :digits số.',
    'digits_between'       => ':attribute phải nằm giữa :min and :max số.',
    'dimensions'           => ':attribute có kích thước không hợp lệ.',
    'distinct'             => ':attribute có giá trị trùng lặp.',
    'email'                => ':attribute phải là email hợp lệ.',
    'exists'               => 'Giá trị đã chọn cho :attribute không hợp lệ.',
    'file'                 => ':attribute phải là một tệp.',
    'filled'               => ':attribute phải có giá trị.',
    'image'                => ':attribute phải là hình ảnh.',
    'in'                   => 'Giá trị đã chọn cho :attribute không hợp lệ.',
    'in_array'             => ':attribute không tồn tại trong :other.',
    'integer'              => ':attribute phải là số nguyên.',
    'ip'                   => ':attribute must be a valid IP address.',
    'ipv4'                 => ':attribute must be a valid IPv4 address.',
    'ipv6'                 => ':attribute must be a valid IPv6 address.',
    'json'                 => ':attribute must be a valid JSON string.',
    'max'                  => [
        'numeric' => ':attribute phải không lớn hơn :max.',
        'file'    => ':attribute phải không lớn hơn :max kilobytes.',
        'string'  => ':attribute phải không lớn hơn :max ký tự.',
        'array'   => ':attribute phải không có nhiều hơn :max items.',
    ],
    'mimes'                => ':attribute phải là tệp loại: :values.',
    'mimetypes'            => ':attribute phải là tệp loại: :values.',
    'min'                  => [
        'numeric' => ':attribute phải là ít nhất :min.',
        'file'    => ':attribute phải là ít nhất :min kilobytes.',
        'string'  => ':attribute phải là ít nhất :min characters.',
        'array'   => ':attribute phải có ít nhất :min items.',
    ],
    'not_in'               => 'Giá trị đã chọn cho :attribute không hợp lệ.',
    'numeric'              => ':attribute phải là số.',
    'present'              => ':attribute field must be present.',
    'regex'                => ':attribute format is invalid.',
    'required'             => ':attribute là trường bắt buộc nhập.',
    'required_if'          => ':attribute field is required when :other is :value.',
    'required_unless'      => ':attribute field is required unless :other is in :values.',
    'required_with'        => ':attribute field is required when :values is present.',
    'required_with_all'    => ':attribute field is required when :values is present.',
    'required_without'     => ':attribute field is required when :values is not present.',
    'required_without_all' => ':attribute field is required when none of :values are present.',
    'same'                 => ':attribute and :other must match.',
    'size'                 => [
        'numeric' => ':attribute phải là :size.',
        'file'    => ':attribute phải là :size kilobytes.',
        'string'  => ':attribute phải là :size ký tự.',
        'array'   => ':attribute phải chứa :size items.',
    ],
    'string'               => ':attribute phải là chuỗi.',
    'timezone'             => ':attribute must be a valid zone.',
    'unique'               => ':attribute đã tồn tại.',
    'uploaded'             => ':attribute lỗi tải lên.',
    'url'                  => ':attribute định dạng không hợp lệ.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [

        'backend' => [
            'access' => [
                'permissions' => [
                    'associated_roles' => 'Vài trò đã liên kết',
                    'dependencies'     => 'Phục thuộc',
                    'display_name'     => 'Tên hiển thị',
                    'group'            => 'Nhóm',
                    'group_sort'       => 'Sắp xếp nhóm',

                    'groups' => [
                        'name' => 'Tên nhóm',
                    ],

                    'name'       => 'Tên',
                    'first_name' => 'Tên',
                    'last_name'  => 'Họ',
                    'system'     => 'Hệ thống',
                ],

                'roles' => [
                    'associated_permissions' => 'Quyền đã liên kết',
                    'name'                   => 'Tên',
                    'sort'                   => 'Sắp xếp',
                ],

                'users' => [
                    'active'                  => 'Họat động',
                    'associated_roles'        => 'Vài trò đã liên kết',
                    'confirmed'               => 'Đã xác nhận',
                    'email'                   => 'E-mail',
                    'name'                    => 'Tên',
                    'last_name'               => 'Tên',
                    'first_name'              => 'Họ',
                    'other_permissions'       => 'Quyền khác',
                    'password'                => 'Mật khẩu',
                    'password_confirmation'   => 'Xác nhận mật khẩu',
                    'send_confirmation_email' => 'Gửi E-Mail xác nhận',
                ],
            ],
        ],

        'frontend' => [
            'email'                     => 'E-mail',
            'first_name'                => 'Tên',
            'last_name'                 => 'Họ',
            'name'                      => 'Tên đầy đủ',
            'password'                  => 'Mật khẩu',
            'password_confirmation'     => 'Xác nhận mật khẩu',
            'phone' => 'Phone',
            'message' => 'Message',
            'new_password'              => 'Mật khẩu mới',
            'new_password_confirmation' => 'Xác nhận mật khẩu mới',
            'old_password'              => 'Mật khẩu cũ',
        ],
    ],

];
