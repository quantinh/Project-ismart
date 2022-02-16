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

#Hàm Kiểm tra định dạng  username validation
function is_username($username) 
{
    $partten = "/^[A-Za-z0-9_\.]{3,32}$/";
    if(!preg_match($partten, $username, $matchs))
        return false;
    return true;
}

#Hàm Kiểm tra định dạng password validation
function is_password($password) 
{
    $partten = "/^([\w_\.!@#$%^&*()]+){5,32}$/";
    if(!preg_match($partten, $password, $matchs))
        return false;
    return true;
}

#Hàm Kiểm tra định dạng email validation
function is_email($email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
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

#Kiểm tra bảng ghi đó có key và value tồn tại hay ko? 
function is_exists($table, $key, $value) 
{
    $check = db_num_rows("SELECT * FROM `{$table}` WHERE `{$key}` = '{$value}'");
    if ($check > 0) {
        return true;
    }
    return false;
}

#Hàm xuất các lỗi liên quan đến form
function form_error($label_field) 
{
    global $error;
    if(!empty($error[$label_field]))
        return "<p class='error'>{$error[$label_field]}</p>";
}

#lấy set giá trị
function set_value($label_field) 
{
    global $$label_field;
    if(!empty($$label_field)) {
        return $$label_field;
    }
}

