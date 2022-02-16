<?php

#Hàm kiểm tra xem có (username) người dùng có tồn tại trong Database hay ko ?
function user_exists($username, $email) {
    $check_user = db_num_rows("SELECT * FROM `tbl_users` WHERE `email` = '{$email}' OR `username` = '{$username}'");
    echo $check_user;
    #Nếu tồn tại ít nhất 1 bảng ghi trên hệ thống thì báo lỗi là đã tồn tại "tk trong hệ thống"
    if($check_user > 0)
        return true;
    return false;
}

#Hàm thêm user vào Database
function add_user($data) {
    return db_insert('tbl_users', $data);
}

#Hàm Lấy danh sách người dùng
function get_list_users() {
    $result = db_fetch_array("SELECT * FROM `tbl_users`");
    return $result;
}

#Hàm lấy ds người dùng theo user_id 
function get_users_by_id($id) {
    $item = db_fetch_row("SELECT * FROM `tbl_users` WHERE `user_id` = {$id}");
    return $item;
}

#Hàm kiểm tra người dùng đã kích hoạt mã chưa ?
function check_active_token($active_token){
    #Kiểm tra với điều kiện là đã có mã kích hoạt(active_token) và (is_active) có giá trị = 0(khi chưa click, kích hoạt) chưa?
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `active_token` = '{$active_token}' AND `is_active`= '0'");
    #Nếu tồn tại ít nhất 1 bảng ghi trên hệ thống thì báo lỗi 
    if($check > 0)
        return true;
    return false;
}

#Hàm người dùng kích hoạt với tham số truyền vào là mã(token)
function active_user($active_token){
    #Cập nhập bảng ghi có giá trị =1 khi người dùng kích hoạt mã (active_token) 
    return db_update('tbl_users', array('is_active'=> 1), "`active_token` = '{$active_token}'");
}

#Hàm kiểm tra đã đăng nhập với tài khoản và mật khẩu đã cho trên database chưa?
function check_login($username, $password) {
    $check_user = db_num_rows("SELECT * FROM `tbl_users` WHERE `username` = '{$username} ' AND `password` = '{$password}'");
    echo $check_user;
    #Nếu số bảng ghi > 0 nghĩa là tồn tại trên hệ thống thì cho login vào ngược lại trả ra lỗi
        if ($check_user > 0) 
            return true;
    return false;
}

#Hàm kiểm tra xem thông tin username và trường ... 
function info_user($label = 'id') {
    $user_login = $_SESSION['user_login'];
    $user = db_fetch_array("SELECT * FROM `tbl_users` WHERE `username` = '{$user_login}'");
     return $user[$label];
}
 
#Hàm kiểm tra email đã tồn tại trên Database hay chưa ?
function check_email($email){
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `email` = '{$email}'");
    #Nếu tồn tại ít nhất 1 bảng ghi trên hệ thống thì báo lỗi là đã tồn tại "tk trong hệ thống"
    if($check > 0)
        return true;
    return false;
}

#Hàm cập nhập mã khôi phục tài khoản
function update_reset_token($data, $email){
    db_update('tbl_users', $data, "`email` = '{$email}'");
}

#Hàm kiểm tra mã khôi phục mật khẩu có tồn tại hay ko nếu thay đổi mã trên url thì báo ko tồn tại
function check_reset_token($reset_token){
    $check = db_num_rows("SELECT * FROM `tbl_users` WHERE `reset_token` = '{$reset_token}'");
    #Nếu tồn tại ít nhất 1 bảng ghi trên hệ thống thì báo lỗi là đã tồn tại "tk trong hệ thống"
    if($check > 0)
        return true;
    return false;
}

#Hàm cập nhập mật khẩu mới cho bảng mật khẩu cũ trên Database
function update_pass($data, $reset_token){
    db_update('tbl_users', $data, "`reset_token` = '{$reset_token}'");
}