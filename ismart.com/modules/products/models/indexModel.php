<?php

#Hàm lấy thông  tin sản phẩm theo id
function get_inf_product($field, $product_id){
    $info_product_id = db_fetch_row("SELECT `$field` FROM `tbl_products` WHERE `product_id` = '{$product_id}'");
    if(!empty($info_product_id)){
        return  $info_product_id[$field];
    }
}

#Hàm lấy sản phẩm theo danh mục cha
function get_product_by_parent_cat($parent_cat, $order_by = ''){
    $list_product_by_parent_cat = db_fetch_array("SELECT* FROM `tbl_products` WHERE `product_status` = 'Approved' AND (`parent_cat` = '{$parent_cat}' OR `product_brand` = '{$parent_cat}' OR `product_type` = '{$parent_cat}') $order_by");
    return $list_product_by_parent_cat;
} 

#Hàm lấy sản phẩm theo danh mục 
function get_product_by_parent_cat_unset($product_id, $parent_cat, $order_by = ''){
    $list_product_by_parent_cat = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_id` != '{$product_id}' AND `parent_cat` = '{$parent_cat}' OR `product_brand` = '{$parent_cat}' OR `product_type` = '{$parent_cat}' $order_by");
    return $list_product_by_parent_cat;
} 

#Hàm lấy sản phẩm theo cat id
function get_products_by_cat_id($cat_id){
    $cat = db_fetch_assoc("SELECT `cat_title` FROM `tbl_products_cat` WHERE `cat_id` = '{$cat_id}'");
    $data = db_fetch_array("SELECT* FROM `tbl_products` WHERE `parent_cat` = '{$cat['product_title']}' OR `product_brand` = '{$cat['product_title']}' OR `product_type` = '{$cat['product_title']}'");
    if(!empty($data)){
        return $data;
    }
}

#Hàm lấy danh sách lọc theo danh mục 
function get_list_cat_filter($value){
    $sql = "SELECT DISTINCT `parent_cat` FROM `tbl_products` WHERE `product_title` LIKE '%$value %' OR `product_code` LIKE '% $value %'";
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm lấy danh sách sản phẩm lọc theo danh mục
function get_list_product_filter_by_cat($data, $cat){
    $result = array();
    if(!empty($data)){
        foreach($data as $item){
            if($item['parent_cat'] == $cat || $item['product_brand'] == $cat || $item['product_type'] == $cat){
                $result[] = $item;
            }
        }
        if(!empty($result)){
            return $result;
        }
    }  
}

