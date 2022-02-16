<?php

#Hàm lấy danh sách các sản phẩm nổi bật 
function get_list_product_highlight($list_products)
{
    $result = array();
    if(!empty($list_products)) {
        foreach($list_products as $item){
            if(!empty($item['product_price_old'])){
            $result[] = $item;
            }
        }
        return $result;
    }
}

#Hàm lấy sản phẩm theo danh mục cha
function get_product_by_parent_cat($parent_cat, $order_by = '')
{
    $result = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_status` = 'Approved' AND (`parent_cat` = '{$parent_cat}' OR `product_brand` = '{$parent_cat}' OR `product_type` = '{$parent_cat}') $order_by");
    return $result;
}

#Hàm lấy thông tin theo sản phẩm
function get_inf_product($field, $product_id) 
{
    #Cập nhập các thông tin sản phẩm vào CSDL
    $result = db_fetch_row("SELECT `$field` FROM `tbl_products` WHERE `product_id` = '{$product_id}'");
    if(!empty($result))
    return $result[$field];
}

#Hàm lấy danh mục theo id
function get_cat_id_by_cat($cat)
{
    $result = db_fetch_assoc("SELECT `cat_id` FROM `tbl_products_cat` WHERE `cat_title` = '{$cat}'");
    if(!empty($result['cat_id']))
    return $result['cat_id'];
}

#Thêm đơn hàng mới
function insert_order($data){
    db_insert('tbl_orders', $data);
}

#Cập nhập đơn hàng mới
function update_order_by_phone($data_order, $phone){
    db_update('tbl_orders', $data_order, "`phone`='{$phone}'");
}

#Thêm mới khách hàng
function insert_customer($data){
    db_insert('tbl_customers', $data);
}

#Cập nhập khách hàng 
function update_customer($data_customer, $phone){
    db_update("tbl_customers", $data_customer,"`phone` = {$phone}");
}

#Lấy số lượng khách hàng
function get_num_customer($phone){
    $num_customer = db_num_rows("SELECT* FROM `tbl_customers` WHERE `phone` = '{$phone}'");
    if(!empty($num_customer)){
        return  $num_customer;
    }
}

#Thêm đơn hàng đơn hàng theo sản phẩm
function insert_product_order($data){
    db_insert('tbl_products_order',$data);
}




