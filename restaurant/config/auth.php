<?php
    //Authentication hay còn được gọi là xác thực là hành động nhằm thiếp lập hoặc chứng thực một cái gì đó đáng tin cậy
    //Authentication là quá trình xác minh nhận dạng của người dùng
return [

    // 'guards' => [
    //     'web' => [
    //         'driver' => 'session',
    //         'provider' => 'users',
    //     ],

    //     'api' => [
    //         'driver' => 'token',
    //         'provider' => 'users',
    //     ],
    //     'admin' => [
    //         'driver' => 'session',
    //         'provider' => 'admin',
    //     ],
    // ],
    /*
    |--------------------------------------------------------------------------
    | Default Authentication Driver
    |--------------------------------------------------------------------------
    |
    | This option controls the authentication driver that will be utilized.
    | This driver manages the retrieval and authentication of the users
    | attempting to get access to protected areas of your application.
    |
    | Supported: "database", "eloquent"
    |
    */
    
    'driver' => 'eloquent',
    /* Thiết lập này xác định cách thông tin người dùng được lấy ra và xác thực
        eloquent : laravel sẽ làm việc với bạn qua model
        database : laravel sẽ làm việc trực tiếp với database ko thông qua model
    */
    /*
    |--------------------------------------------------------------------------
    | Authentication Model
    |--------------------------------------------------------------------------
    |
    | When using the "Eloquent" authentication driver, we need to know which
    | Eloquent model should be used to retrieve your users. Of course, it
    | is often just the "User" model but you may use whatever you like.
    |
    */

    'model' => App\Models\User::class,
    // 'providers' => [
    //     'users' => [
    //         'driver' => 'eloquent',
    //         'model' => App\User::class,
    //     ],

    //     'admin' => [
    //         'driver' => 'eloquent',
    //         'model' => App\Admin::class,
    //     ],
    // ],
    // Thiết lập này cho Laravel biết model nào được sử dụng để lưu trữ thông tin người dùng theo mặc định thì nó được đặt cho app\User
    /*
    |--------------------------------------------------------------------------
    | Authentication Table
    |--------------------------------------------------------------------------
    |
    | When using the "Database" authentication driver, we need to know which
    | table should be used to retrieve your users. We have chosen a basic
    | default value but you may easily change it to any table you like.
    |
    */

    'table' => 'users',
    //Thiết lập này xác định bảng nào trong cơ sở dữ liệu được sử dụng để lưu trữ thông tin người dùng. Theo mặc định nó sẽ được đặt cho bảng users

    /*
    |--------------------------------------------------------------------------
    | Password Reset Settings
    |--------------------------------------------------------------------------
    |
    | Here you may set the options for resetting passwords including the view
    | that is your password reset e-mail. You can also set the name of the
    | table that maintains all of the reset tokens for your application.
    |
    | The expire time is the number of minutes that the reset token should be
    | considered valid. This security feature keeps tokens short-lived so
    | they have less time to be guessed. You may change this as needed.
    |
    */

    'password' => [
        'email' => 'emails.password',
        'table' => 'password_resets',
        'expire' => 60,
    ],

    // 'passwords' => [
    //     'users' => [
    //         'provider' => 'users',
    //         'email' => 'auth.emails.password',
    //         'table' => 'password_resets',
    //         'expire' => 60,
    //     ],
    //     'admin' => [
    //         'provider' => 'admin',
    //         'email' => 'auth.emails.password',
    //         'table' => 'password_resets',
    //         'expire' => 60,
    //     ],
    // ],
    //Laravel sử dụng một số cơ chế cần thiết để quản lý và xử lý các yêu cầu khôi phục mật khẩu. Thiết lập này xác định view chứa nội dung email được gửi tới người dùng, bảng trong cơ sở dữ liệu được dùng để quản lý yêu cầu khôi phục mật khẩu và thời hạn (tính theo phút) mà yêu cầu khôi phục có hiệu lực.
];