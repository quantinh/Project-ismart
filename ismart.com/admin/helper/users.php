<?php

//Hàm trả về result khi login
function is_login()
{
    if (isset($_SESSION['is_login'])) {
        return true;
    }
    return false;
}

//Hàm trả về username của người login
function user_login()
{
    if (!empty($_SESSION['user_login'])) {
        return $_SESSION['user_login'];
    }
    return false;
}

//Hàm lấy thông tin admin
function get_admin_info($username)
{
    $result = db_fetch_row("SELECT * FROM `tbl_admins` WHERE `username` = '{$username}'");
    return $result['fullname'];
}

//Hàm lấy danh sách user từ CSDL
function get_list_user()
{
    $result = db_fetch_array("SELECT * FROM `tbl_admins`");
    return $result;
}

//Hàm kiểm tra xem thông tin username và trường ...
function info_user($field)
{
    $list_users = get_list_user();
    if (isset($_SESSION['is_login'])) {
        foreach ($list_users as $user) {
            //print_r($user);//kiểm tra xuất mảng
            if ($_SESSION['user_login'] == $user['username']) {
                if (array_key_exists($field, $user)) {
                    return $user[$field];
                }
            }
        }
    }
}

//Hàm lấy thông tin admin
function get_inf_account($data)
{
    $info = db_fetch_row("SELECT `$data` FROM `tbl_admins` WHERE `username` = '{$_SESSION['user_login']}'");
    if(!empty($info)) 
    return $info[$data];
}
