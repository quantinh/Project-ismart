<?php

//=>Hàm xử lí cho addBannerAction
#Hàm thêm banner mới
function add_banner($data) 
{
    $result = db_insert("tbl_banners", $data);
    #Thêm các thông tin trang mới vào CSDL
    return $result;
}

//=>Hàm xử lí cho updateBannerAction
#Hàm cập nhập banner 
function update_banner($data, $banner_id) 
{
    $result = db_update("tbl_banners", $data, "`banner_id`= '{$banner_id}'");
    #Cập nhập các thông tin trang vào CSDL
    return $result;
}

#Hàm lấy thông tin banner theo trang
function get_inf_banner($field, $banner_id) 
{
    $result = db_fetch_row("SELECT `$field` FROM `tbl_banners` WHERE `banner_id` = '{$banner_id}'");
    #Cập nhập các thông tin trang vào CSDL
    return $result[$field];
}

#Hàm lấy banner theo chỉ số trang 
function get_banners($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_banners` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}

//=>Hàm xử lí cho deleteAction
#Hàm xóa một banner bất kì
function delete_banner($banner_id) 
{
    $result = db_delete('tbl_banners',"`banner_id` = '{$banner_id}'");
    #Xóa một bảng ghi các thông tin trang trong CSDL
    return $result;
}
