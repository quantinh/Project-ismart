<?php

//=>Hàm xử lí cho addSliderAction
#Hàm thêm trang mới
function add_slider($data) 
{
    $result = db_insert("tbl_sliders", $data);
    #Thêm các thông tin trang mới vào CSDL
    return $result;
}

//=>Hàm xử lí cho updateSliderAction
#Hàm cập nhập trang 
function update_slider($data, $slider_id) 
{
    $result = db_update("tbl_sliders", $data, "`slider_id`= '{$slider_id}'");
    #Cập nhập các thông tin trang vào CSDL
    return $result;
}

#Hàm lấy thông tin slider theo trang
function get_inf_slider($field, $slider_id) 
{
    $result = db_fetch_row("SELECT `$field` FROM `tbl_sliders` WHERE `slider_id` = '{$slider_id}'");
    #Cập nhập các thông tin trang vào CSDL
    return $result[$field];
}

#Hàm lấy slider theo chỉ số trang 
function get_sliders($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_sliders` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}

//=>Hàm xử lí cho deleteAction
#Hàm xóa một trang bất kì
function delete_slider($slider_id) 
{
    $result = db_delete('tbl_sliders',"`slider_id` = '{$slider_id}'");
    #Xóa một bảng ghi các thông tin trang trong CSDL
    return $result;
}
