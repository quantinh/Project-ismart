<?php

//=>Hàm xử lí cho addAction
#Hàm thêm mới một bài viết
function add_post($data) 
{
    $result = db_insert("tbl_posts", $data);
    #Thêm các thông tin bài viết mới vào CSDL
    return $result;
}

//=>Hàm xử lí cho updatePostAction
#Hàm lấy thông tin theo bài viết
function get_inf_post($field, $post_id) 
{
    $result = db_fetch_row("SELECT `$field` FROM `tbl_posts` WHERE `post_id` = '{$post_id}'");
    #Cập nhập các thông tin trang vào CSDL
    return $result[$field];;
}

#Hàm cập nhập thông tin cho bài viết  
function update_post($data, $post_id) 
{
    $result = db_update('tbl_posts', $data, "`post_id`='{$post_id}'");
     #Cập nhập các thông tin trang vào CSDL
    return $result;
}

//=>Hàm xử lí cho deleteAction
#Hàm xóa một bài viết
function delete_post($post_id) 
{
    $result = db_delete('tbl_posts',"`post_id` = '{$post_id}'");
    #Xóa một bảng ghi các thông tin bài viết trong CSDL
    return $result;
}

#Hàm lấy bài viết theo chỉ số trang
function get_posts($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_posts` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}

//=>Hàm xử lí cho addCatAction
#Hàm thêm mới một danh mục
function add_cat($data) 
{
    $result = db_insert("tbl_posts_cat", $data);
    #Thêm các thông tin danh mục mới vào CSDL
    return $result;
}

#Hàm cập nhập danh mục
function update_cat($data, $cat_id){
    $result = db_update('tbl_posts_cat', $data, "`cat_id` = '{$cat_id}'");
    return $result;
}

#Hàm lấy thông tin theo danh mục
function get_inf_cat($field, $cat_id) 
{
    $result = db_fetch_row("SELECT `$field` FROM `tbl_posts_cat` WHERE `cat_id` = '{$cat_id}'");
    #Cập nhập các thông tin trang vào CSDL
    return $result[$field];;
}

//=>Hàm xử lí cho deleteCatAction
#Hàm xóa một danh mục bài viết
function delete_cat($cat_id) 
{
    $result = db_delete('tbl_posts_cat',"`cat_id` = '{$cat_id}'");
    #Xóa một bảng ghi các thông tin danh mục trong CSDL
    return $result;
}

#Hàm lấy danh mục theo chỉ số danh mục
function get_cats($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_posts_cat` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}