<?php

//=>Hàm xử lí cho addMenuAction
#Hàm thêm menu
function add_menu($data) 
{
    $result = db_insert("tbl_menus", $data);
    #Thêm các thông tin trang mới vào CSDL
    return $result;
}

//=>Hàm xử lí cho updateMenuAction
#Hàm cập nhập trang 
function update_menu($data, $menu_id) 
{
    $result = db_update("tbl_menus", $data, "`menu_id`= '{$menu_id}'");
    #Cập nhập các thông tin trang vào CSDL
    return $result;
}

#Hàm lấy thông tin theo trang
function get_inf_menu($field, $menu_id) 
{
    $result = db_fetch_row("SELECT `$field` FROM `tbl_menus` WHERE `menu_id` = '{$menu_id}'");
    #Cập nhập các thông tin trang vào CSDL
    if(!empty($result)){
    return $result[$field];
    }
}

#Hàm lấy trang theo chỉ số trang 
function get_pages($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_menus` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}

//=>Hàm xử lí cho deleteAction
#Hàm xóa một trang bất kì 
function delete_menu($menu_id) 
{
    $result = db_delete('tbl_menus',"`menu_id` = '{$menu_id}'");
    #Xóa một bảng ghi các thông tin trang trong CSDL
    return $result;
}