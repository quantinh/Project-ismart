<?php

//=>Hàm xử lí cho addWidgetAction
#Hàm thêm khối mới
function add_block($data) 
{
    $result = db_insert("tbl_blocks", $data);
    #Thêm các thông tin khối vào CSDL
    return $result;
}

//=>Hàm xử lí cho updateWidgetAction
#Hàm cập nhập khối
function update_block($data, $block_id) 
{
    $result = db_update("tbl_blocks", $data, "`block_id`= '{$block_id}'");
    #Cập nhập các thông tin khối vào CSDL
    return $result;
}

#Hàm lấy thông tin theo khối
function get_inf_block($field, $block_id) 
{
    $result = db_fetch_row("SELECT `$field` FROM `tbl_blocks` WHERE `block_id` = '{$block_id}'");
    #Cập nhập các thông tin khối vào CSDL
    return $result[$field];
}

#Hàm lấy khối theo chỉ số trang 
function get_blocks($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_blocks` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}

//=>Hàm xử lí cho deleteAction
#Hàm xóa một khối bất kì
function delete_block($block_id) 
{
    $result = db_delete('tbl_blocks',"`block_id` = '{$block_id}'");
    #Xóa một bảng ghi các thông tin trang trong CSDL
    return $result;
}
