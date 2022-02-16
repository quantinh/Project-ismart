<?php

//=>Hàm xử lí cho loginAction
#Hàm kiểm tra đã đăng nhập với tài khoản và mật khẩu đã cho trên database chưa?
function check_login($username, $password)
{
    $check_user = db_num_rows("SELECT * FROM `tbl_admins` WHERE `username` = '{$username} ' AND `password` = '{$password}'");
    echo $check_user;
    #Nếu số bảng ghi > 0 nghĩa là tồn tại trên hệ thống thì cho login vào ngược lại trả ra lỗi
    if ($check_user > 0) {
        return true;
    }

    return false;
}

//=>Hàm xử lí cho infoAction
#Hàm cập nhập thông tin tài khoản admin chủ sở hữu
function update_info_accounts($data, $user){
	db_update('tbl_admins', $data, "`username` = '{$user}'");
}

//=>Hàm xử lí cho changePassAction
#Hàm kiểm tra password cũ
function check_pass_old($pass_old)
{
    #Mã hóa mật khẩu cũ khi truyền vào
    $pass_old = md5($pass_old);
    #Hàm db_num_rows() sẽ trả về số hàng trong tập hợp kết quả truyền vào đk(mật khẩu cũ bằng = mk mới )
    $result = db_num_rows("SELECT * FROM `tbl_admins` WHERE `password` = '{$pass_old}'");
    if ($result == 1) {
        return true;
    }
    return false;
}

#Hàm cập nhập mật khẩu mới
function update_new_password($data, $pass_old)
{
    #Mã hóa mật khẩu cũ khi truyền vào
    $pass_old = md5($pass_old);
    #Cập nhập bảng ghi trong csdl từ kết quả mật khẩu cũ truyền vào
    db_update('tbl_admins', $data, "`password` = '{$pass_old}'");
}

//=>Hàm xử lí cho indexAction
#Hàm Lấy danh sách người dùng
function get_list_admins($role = "")
{
    #Kiểm tra phân quyền có tồn tại giá trị hay không ?
    if (!empty($role)) {
        $result = db_fetch_array("SELECT * FROM `tbl_admins` WHERE `role` = '{$role}'");
        #Kiểm tra xem đã lây được giá trị từ CSDL hay không nếu lấy đk thì trả dl ?
        if (!empty($result)) {
            return $result;
        }
    } else {
        #Nếu không lấy đk dl thì tiếp tục truy xuất lấy 1 danh sách từ CDSL
        return db_fetch_array("SELECT * FROM `tbl_admins`");
    }
}

#Hàm lấy một số bảng ghi từ CSDL
function get_num_rows($table)
{
    #Lấy một số bảng ghi từ CSDL và trả về kết quả dl bảng ghi
    $result = db_num_rows("SELECT * FROM `{$table}`");
    return $result;
}

//=>Hàm xử lí cho applyAction
#Hàm cập nhập thông tin cho quản trị viên các cấp 
function update_admin($data, $admin_id) 
{
    $result = db_update('tbl_admins', $data, "`admin_id`='{$admin_id}'");
    return $result;
}

#Hàm lấy admin theo chỉ số trang 
function get_admins($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT* FROM `tbl_admins` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}

#Hàm thêm mới một thành viên quản trị
function add_admin($data) 
{
    $result = db_insert("tbl_admins", $data);
    #Thêm các thông tin quản trị viên mới vào CSDL
    return $result;
}

//=>Hàm xử lí cho deleteAction
#Hàm xóa một thành viên quản trị
function delete_admin($admin_id) 
{
    $result = db_delete('tbl_admins',"`admin_id` = '{$admin_id}'");
    #Xóa một bảng ghi các thông tin quản trị viên trong CSDL
    return $result;
}

//=>Hàm xử lí cho updateAction
#Hàm lấy thông tin của các quản trị viên như biên dịch viên,...
function get_inf_admins($field, $admin_id) 
{
    $result = db_fetch_row("SELECT `$field` FROM `tbl_admins` WHERE `admin_id` = '{$admin_id}'");
    return $result[$field];
}

#====================================================================================================================================#
#Một số hàm phụ hỗ trợ khi cần thiết v.v...
#Hàm lấy user theo username
function get_admin_by_username($username)
{
    $item = db_fetch_row("SELECT * FROM `tbl_admins` WHERE `username` = '{$username}'");
    if (!empty($item)) {
        return $item;
    }
}

#Hàm cập nhập user_login
function update_info_account($username, $data)
{
    db_update('tbl_admins', $data, "`username`=  '{$username}'");
}

#Hàm kiểm tra xem có (username) người dùng có tồn tại trong Database hay ko ?
function user_exists($username, $email)
{
    $check_user = db_num_rows("SELECT * FROM `tbl_admins` WHERE `email` = '{$email}' OR `username` = '{$username}'");
    echo $check_user;
    #Nếu tồn tại ít nhất 1 bảng ghi trên hệ thống thì báo lỗi là đã tồn tại "tk trong hệ thống"
    if ($check_user > 0) {
        return true;
    }
    return false;
}

#Hàm thêm user vào Database
function add_user($data)
{
    return db_insert('tbl_admins', $data);
}

#Hàm lấy danh sách người dùng theo user_id
function get_users_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_admins` WHERE `user_id` = {$id}");
    return $item;
}

#Hàm kiểm tra người dùng đã kích hoạt mã chưa ?
function check_active_token($active_token)
{
    #Kiểm tra với điều kiện là đã có mã kích hoạt(active_token) và (is_active) có giá trị = 0(khi chưa click, kích hoạt) chưa?
    $check = db_num_rows("SELECT * FROM `tbl_admins` WHERE `active_token` = '{$active_token}' AND `is_active`= '0'");
    #Nếu tồn tại ít nhất 1 bảng ghi trên hệ thống thì báo lỗi
    if ($check > 0) {
        return true;
    }

    return false;
}

#Hàm người dùng kích hoạt với tham số truyền vào là mã(token)
function active_user($active_token)
{
    #Cập nhập bảng ghi có giá trị =1 khi người dùng kích hoạt mã (active_token)
    return db_update('tbl_admins', array('is_active' => 1), "`active_token` = '{$active_token}'");
}

#Hàm kiểm tra email đã tồn tại trên Database hay chưa ?
function check_email($email)
{
    $check = db_num_rows("SELECT * FROM `tbl_admins` WHERE `email` = '{$email}'");
    #Nếu tồn tại ít nhất 1 bảng ghi trên hệ thống thì báo lỗi là đã tồn tại "tk trong hệ thống"
    if ($check > 0) {
        return true;
    }
    return false;
}

#Hàm cập nhập mã khôi phục tài khoản
function update_reset_token($data, $email)
{
    db_update('tbl_admins', $data, "`email` = '{$email}'");
}

#Hàm kiểm tra mã khôi phục mật khẩu có tồn tại hay ko nếu thay đổi mã trên url thì báo ko tồn tại
function check_reset_token($reset_token)
{
    $check = db_num_rows("SELECT * FROM `tbl_admins` WHERE `reset_token` = '{$reset_token}'");
    #Nếu tồn tại ít nhất 1 bảng ghi trên hệ thống thì báo lỗi là đã tồn tại "tk trong hệ thống"
    if ($check > 0) {
        return true;
    }

    return false;
}

#Hàm cập nhập mật khẩu mới cho bảng mật khẩu cũ trên Database
function update_pass($data, $reset_token)
{
    db_update('tbl_admins', $data, "`reset_token` = '{$reset_token}'");
}

#Hàm kiểm tra quản trị viên đã tồn tại trước đó trên hệ thống chưa ?
function admin_exists($username, $email)
{
    #Lấy một bảng ghi trong CSDL để đối chiếu với thông tin người dùng 
    $result = db_num_rows("SELECT * FROM `tbl_admins` WHERE `username` = '{$username}' OR `email` = '{$email}'");
    #Nếu một trong hai thông tin giống thì trả kq
    if ($result == 1) {
        return true;
    }
    return false;
}




