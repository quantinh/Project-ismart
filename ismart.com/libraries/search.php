<?php 

#Hàm tìm kiếm tất cả các danh sách danh mục 
function get_list_cat_all_search($value){
    $sql = "SELECT DISTINCT `parent_cat` FROM `tbl_products` WHERE `product_title` LIKE '%$value %' OR  `product_code` LIKE '%$value %'";
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm tất cả các sản phẩm
function db_search_all_products($value, $order_by=''){
    $sql = "SELECT * FROM `tbl_products` WHERE `product_title` LIKE '%$value %' OR `product_code` LIKE '%$value %' $order_by ";
    $result = db_fetch_array($sql);
    return $result;
}

#Lấy danh sách sản phẩm theo danh mục
function get_list_all_products_search_by_cat($parent_cat, $value, $order_by =''){
    $sql = "SELECT * FROM `tbl_products` WHERE `parent_cat` = '{$parent_cat}' AND `product_title` LIKE '%$value %' OR `product_code` LIKE '%$value %' $order_by ";
    $result = db_fetch_array($sql);
    return $result;
}