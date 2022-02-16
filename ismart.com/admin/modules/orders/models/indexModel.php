<?php

//=>Hàm xử lí cho updateOrderAction
#Hàm lấy thông tin theo đơn hàng
function get_inf_order($field, $order_id) 
{
    $result = db_fetch_row("SELECT `$field` FROM `tbl_orders` WHERE `order_id` = '{$order_id}'");
    #Cập nhập các thông tin trang vào CSDL
    if(!empty($result))
    return $result[$field];
}

//=>Hàm xử lí cho updatePageAction
#Hàm cập nhập khách hàng
function update_customer($data, $customer_id) 
{
    $result = db_update("tbl_customers", $data, "`customer_id`= '{$customer_id}'");
    #Cập nhập các thông tin trang vào CSDL
    if(!empty($result))
    return $result;
}

#Hàm lấy thông tin khách hàng theo id
function get_inf_customer($field, $customer_id) 
{
    $result = db_fetch_row("SELECT `$field` FROM `tbl_customers` WHERE `customer_id` = '{$customer_id}'");
    #Cập nhập các thông tin khách hàng theo id vào CSDL
    if(!empty($result))
    return $result[$field];
}

#Hàm lấy số lượng đơn đặt hàng theo khách hàng
function get_num_order_of_customer($phone){
    $num_order = db_num_rows("SELECT * FROM `tbl_orders` WHERE `phone` = {$phone}");
    return $num_order;
}

#Hàm lấy số lượng đặt hàng theo số điện thoại
function get_num_order_by_phone($phone){
    $num_order = db_num_rows("SELECT * FROM `tbl_orders` WHERE `phone` = '{$phone}'");
    if(!empty($num_order)){
        return  $num_order;
    }
}

#Hàm lấy danh sách sản phẩm theo đơn hàng
function get_list_product_order($order_code){
    $list_product_order = db_fetch_array("SELECT * FROM `tbl_products_order` WHERE `order_code` = '{$order_code}'");
    return $list_product_order;
}

#Hàm cập nhập thông tin cho đơn hàng  
function update_order($data, $order_id) 
{
    $result = db_update('tbl_orders', $data, "`order_id`='{$order_id}'");
     #Cập nhập các thông tin trang vào CSDL
    return $result;
}

//=>Hàm xử lí cho deleteAction
#Hàm xóa một đơn hàng
function delete_order($order_id) 
{
    $result = db_delete('tbl_orders',"`order_id` = '{$order_id}'");
    #Xóa một bảng ghi các thông tin đơn hàng trong CSDL
    return $result;
}

#Hàm lấy đơn hàng theo chỉ số trang
function get_orders($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_orders` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}

#Hàm lấy thông tin theo sản phẩm
function get_inf_product($field, $product_id) 
{
    $result = db_fetch_row("SELECT `$field` FROM `tbl_products` WHERE `product_id` = '{$product_id}'");
    #Cập nhập các thông tin trang vào CSDL
    if(!empty($result)){
        return $result[$field];
    }
}

#Hàm lấy thông tin đơn hàng theo số điện thoại
function get_info_order_by_phone($field, $phone){
    $result = db_fetch_row("SELECT `$field` FROM `tbl_orders` WHERE `phone` = '{$phone}'");
    if(!empty($result)){
        return  $result[$field];
    }
}

#Hàm xóa đơn hàng theo số điện thoại
function delete_orders_by_phone($phone) {
    $result = db_delete("tbl_orders", "`phone` = {$phone}");
    return $result;
}

#Hàm lây danh sách đơn hàng theo số điên thoại
function get_list_order_by_phone($phone){
    $info_order = db_fetch_array("SELECT * FROM `tbl_orders` WHERE `phone` = '{$phone}'");
    if(!empty($info_order)){
        return  $info_order;
    }
}

#Hàm lấy đơn hàng theo số điện thoại
function update_order_by_phone($data_order, $phone){
    $result = db_update('tbl_orders', $data_order, "`phone`='{$phone}'");
    #Cập nhập các thông tin trang vào CSDL
    return $result;
}

#Hàm xóa khách hàng 
function delete_customer($customer_id){
    $result = db_delete('tbl_customers', "`customer_id`='{$customer_id}'");
    #Cập nhập các thông tin trang vào CSDL
    return $result;
}

#Hàm lấy khách hàng theo chỉ số trang
function get_customers($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $result = db_fetch_array("SELECT * FROM `tbl_customers` {$where} LIMIT {$start}, {$num_per_page}");
    return $result;
}