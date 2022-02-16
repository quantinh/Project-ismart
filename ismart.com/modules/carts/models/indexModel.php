<?php

#Hàm Lấy sản phẩm theo id
function get_inf_product($product_id){
    $info_product_id = db_fetch_row("SELECT * FROM `tbl_products` WHERE `product_id` = '{$product_id}'");
    if(!empty($info_product_id)){
        return  $info_product_id;
    }
}

#Hàm lấy tổng cộng hóa đơn sản phẩm trong giỏ hàng
function get_total_cart() {
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total'];
    }
    return false;
}

#Hàm Thêm mới đơn hàng
function insert_order($data){
    db_insert('tbl_orders', $data);
}

#Hàm Cập nhập đơn hàng theo số điên thoại
function update_order_by_phone($data_order, $phone){
    db_update('tbl_orders', $data_order, "`phone`='{$phone}'");
}

#Hàm Thêm mới customer
function insert_customer($data){
    db_insert('tbl_customers', $data);
}

#Hàm Lấy số khách hàng
function get_num_customer($phone){
    $num_customer = db_num_rows("SELECT* FROM `tbl_customers` WHERE `phone` = '{$phone}'");
    if(!empty($num_customer)){
        return  $num_customer;
    }
}

#Hàm Cập nhập khách hàng 
function update_customer($data_customer, $phone){
    db_update("tbl_customers", $data_customer,"`phone` = {$phone}");
}

#Hàm thêm sản phẩm theo đơn hàng
function add_product_order($data){
    db_insert('tbl_products_order',$data);
}

#Hàm cập nhập sản phẩm 
function update_product($data, $product_id){
    db_update('tbl_products', $data, "`product_id` = '{$product_id}'");
}

?>