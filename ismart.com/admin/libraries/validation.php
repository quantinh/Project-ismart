<?php

#Hàm kiểm tra họ tên đầy đủ validation
function is_fullname($fullname)
{
    $partten = "/^[A-Za-z_\.]{6,32}$/";
    if (!preg_match($partten, $fullname, $matchs)) {
        return false;
    }
    return true;
}

#Hàm Kiểm tra định dạng username validation
function is_username($username)
{
    $partten = "/^[A-Za-z0-9_\.]{3,32}$/";
    if (!preg_match($partten, $username, $matchs)) {
        return false;
    }
    return true;
}

#Hàm Kiểm tra định dạng password validation
function is_password($password)
{
    $partten = "/^([\w_\.!@#$%^&*()]+){5,32}$/";
    if (!preg_match($partten, $password, $matchs)) {
        return false;
    }
    return true;
}

#Hàm Kiểm tra định dạng email validation
function is_email($email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    return true;
}

#Hàm kiểm tra số điện thoại validation
function is_phone_number($phone)
{
    $partten = "/^(09|03|07|08|05)+([0-9]{8})$/";
    if (!preg_match($partten, $phone, $matchs)) {
        return false;
    }
    return true;
}

#Hàm kiểm tra số lượng validation
function is_number($number) 
{
    $partten = "/^[0-9]*$/";
    if(preg_match($partten, $number, $matches)) {
        return true;
    }
    return false;
}

#Hàm kiểm tra định dạng ảnh validation
function is_image($file_type, $file_size)
{
#Các dạng đuôi file định dạng cho phép
    $type_allow = array('png', 'jpg', 'gif', 'jpeg');
    #Kiểm tra giá trị đuôi mở rộng có trùng với các giá trị trong mảng trên hay không ?
    #(nếu đuôi mở rộng chưa đúng định dạng thì chuyển thành đúng định dạng default là chữ thường) 
    #không trùng thì báo lỗi và ngược lại
    if (!in_array(strtolower($file_type), $type_allow)) {
        return false;
    } else {
        #Ngược lại nếu đúng định dạng thì continue check nếu quá dung lượng cho phép thì báo lỗi ngược lại thì cho phép
        if ($file_size > 29000000) {
            return false;
        }
    }
    return true;
}

#Kiểm tra bảng ghi đó có key và value tồn tại hay ko? 
function is_exists($table, $key, $value) 
{
    $check = db_num_rows("SELECT * FROM `{$table}` WHERE `{$key}` = '{$value}'");
    if ($check > 0) {
        return true;
    }
    return false;
}

#Hàm trả về kết quả các lỗi liên quan đến form validation
function form_error($label_field)
{
    global $error;
    if (!empty($error[$label_field])) {
        return "<p class='error'>{$error[$label_field]}</p>";
    }
}

#Hàm Thiết lập các giá trị validation
function set_value($label_field)
{
    global $$label_field;
    if (!empty($$label_field)) {
        return $$label_field;
    }
}

#Hàm kiểm tra phân quyền quản trị 
function check_role($username)
{
    $result = db_fetch_row("SELECT * FROM `tbl_admins` WHERE `username` = '{$username}'");
    if(!empty($result)) {
    return $result['role'];
    }
}

