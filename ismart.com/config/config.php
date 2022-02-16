<?php

//Mở đoạn mã để lưu session trên hệ thống web
session_start();
ob_start();

//Dựa vào mã của thời gian hiện tại để lấy ngược ra thời gian / ngày / giờ 
date_default_timezone_set("Asia/Ho_Chi_Minh");

/*
 * ---------------------------------------------------------
 * BASE URL
 * ---------------------------------------------------------
 * Cấu hình đường dẫn gốc của ứng dụng
 * Ví dụ: 
 * http://hocweb123.com đường dẫn chạy online 
 * http://localhost/yourproject.com đường dẫn dự án ở local
 * 
 */

$config['base_url'] = 'http://localhost:8181/Unt/Back-end/Exercises/Project-ISMART/ismart.com/';
$config['default_module'] = 'home';
$config['default_controller'] = 'index';
$config['default_action'] = 'index';












