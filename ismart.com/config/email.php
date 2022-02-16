<?php
/*
 * --------------------------------
 * EMAIL
 * --------------------------------
 * Trong phần này chúng ta khai báo các thông số để cấu hình
 * gửi mail bằng php
 * --------------------------------
 * GIẢI THÍCH BIẾN
 * --------------------------------
 * protocol: Giao thức gửi mail
 * smtp_host: Host gửi mail
 * smtp_port: Cổng
 * smtp_user: Tên đăng nhập tài khoản gửi mail
 * smtp_pass: Password tài khoản gửi mail
 * smtp_port: Cổng
 * mailtype: Định dạng nội dung mail
 * charset: Mã ký tự nội dung mail(UTF-8)
 */
#Cấu hình gửi mail tự động
$config['email'] = Array(
    'protocol' => 'smtp',
    'smtp_host' => 'smtp.gmail.com',
    'smtp_port' => 587,
    'smtp_user' => 'nhuanminh2610@gmail.com',
    'smtp_fullname' => 'Nhuận Minh',
    'smtp_pass' => 'Nhuanminh1026',
    'smtp_secure' => 'tls',
    'smtp_timeout' => '7',
    'mailtype' => 'html',
    'charset' => 'UTF-8'
);



