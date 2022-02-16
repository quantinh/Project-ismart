<?php

//=>Hàm xử lí cho indexAction
#Hàm lấy tổng số sản phẩm đã bán
function get_sum_sold_product($product_id) {
    $sum_product_sold = db_fetch_assoc("SELECT SUM(`product_qty`) FROM `tbl_products_order` WHERE `product_id` = '{$product_id}'");
    if(!empty($sum_product_sold)){
        return $sum_product_sold['SUM(`product_qty`)'];
    } else {
        return 0;
    }
}

//=>Hàm xử lí cho addAction
#Hàm thêm mới một sản phẩm
function add_product($data) 
{
    $result = db_insert("tbl_products", $data);
    #Thêm các thông tin sản phẩm mới vào CSDL
    return $result;
}

//=>Hàm xử lí cho updateProductAction
#Hàm lấy thông tin theo sản phẩm
function get_inf_product($field, $product_id) 
{
    $result = db_fetch_row("SELECT `$field` FROM `tbl_products` WHERE `product_id` = '{$product_id}'");
    #Cập nhập các thông tin sản phẩm vào CSDL
    return $result[$field];
}

#Hàm cập nhập thông tin cho sản phẩm  
function update_product($data, $product_id) 
{
    $result = db_update('tbl_products', $data, "`product_id`='{$product_id}'");
     #Cập nhập các thông tin sản phẩm vào CSDL
    return $result;
}

//=>Hàm xử lí cho deleteAction
#Hàm xóa một sản phẩm
function delete_product($product_id) 
{
    $result = db_delete('tbl_products',"`product_id` = '{$product_id}'");
    #Xóa một bảng ghi các thông tin sản phẩm trong CSDL
    return $result;
}

#Hàm lấy sản phẩm theo chỉ số sản phẩm
function get_products($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_products` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}

//=>Hàm xử lí cho addCatAction
#Hàm thêm mới một danh mục
function add_cat($data) 
{
    $result = db_insert("tbl_products_cat", $data);
    #Thêm các thông tin danh mục mới vào CSDL
    return $result;
}

#Hàm cập nhập danh mục
function update_cat($data, $cat_id){
    $result = db_update('tbl_products_cat', $data, "`cat_id` = '{$cat_id}'");
    return $result;
}

#Hàm lấy thông tin theo danh mục
function get_inf_cat($field, $cat_id) 
{
    $result = db_fetch_row("SELECT `$field` FROM `tbl_products_cat` WHERE `cat_id` = '{$cat_id}'");
    #Cập nhập các thông tin sản phẩm vào CSDL
    return $result[$field];
}

//=>Hàm xử lí cho deleteCatAction
#Hàm xóa một danh mục sản phẩm
function delete_cat($cat_id) 
{
    $result = db_delete('tbl_products_cat',"`cat_id` = '{$cat_id}'");
    #Xóa một bảng ghi các thông tin danh mục trong CSDL
    return $result;
}

#Hàm lấy danh mục theo chỉ số danh mục
function get_cats($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_products_cat` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}