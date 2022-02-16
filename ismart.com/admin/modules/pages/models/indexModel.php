<?php

//=>Hàm xử lí cho addPageAction
#Hàm thêm trang mới
function add_page($data) 
{
    $result = db_insert("tbl_pages", $data);
    #Thêm các thông tin trang mới vào CSDL
    return $result;
}

//=>Hàm xử lí cho updatePageAction
#Hàm cập nhập trang 
function update_page($data, $page_id) 
{
    $result = db_update("tbl_pages", $data, "`page_id`= '{$page_id}'");
    #Cập nhập các thông tin trang vào CSDL
    return $result;
}

#Hàm lấy thông tin theo trang
function get_inf_page($field, $page_id) 
{
    $result = db_fetch_row("SELECT `$field` FROM `tbl_pages` WHERE `page_id` = '{$page_id}'");
    #Cập nhập các thông tin trang vào CSDL
    return $result[$field];
}

#Hàm lấy trang theo chỉ số trang 
function get_pages($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_pages` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}

//=>Hàm xử lí cho deleteAction
#Hàm xóa một trang bất kì
function delete_page($page_id) 
{
    $result = db_delete('tbl_pages',"`page_id` = '{$page_id}'");
    #Xóa một bảng ghi các thông tin trang trong CSDL
    return $result;
}
