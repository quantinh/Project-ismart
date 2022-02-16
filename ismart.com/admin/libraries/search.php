<?php

#Hàm tìm kiếm tất cả quản trị viên trong hệ thống
function db_search_all_admins($value)
{
    #Sử dụng truy vấn điều kiện WHERE LIKE tìm kiếm với hai trường username và fullname phải có từ khóa trong %...%
    $sql = "SELECT * FROM `tbl_admins` WHERE `username` LIKE '%$value%' OR `fullname` LIKE '%$value%'";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm các thành viên quản trị theo trang 
function db_search_admins_by_page($value, $start = 1, $num_per_page = 10){
    #Lấy ra 1 bảng ghi với điều kiện WHERE LIKE tìm kiếm với hai trường username và fullname phải có từ khóa trong %...% và giới hạn tại chỉ số bắt đầu của trang đó và tổng số bản ghi trong 1 trang
    $sql = "SELECT * FROM `tbl_admins` WHERE `username` LIKE '%$value%' OR `fullname` LIKE '%$value%' LIMIT {$start}, {$num_per_page}";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm tất cả các trang trong hệ thống
function db_search_all_pages($value)
{
    #Sử dụng truy vấn điều kiện WHERE LIKE tìm kiếm với hai trường page_title và category phải có từ khóa trong %...%
    $sql = "SELECT * FROM `tbl_pages` WHERE `page_title` LIKE '%$value%' OR `category` LIKE '%$value%'";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm các trang theo trang 
function db_search_pages_by_page($value, $start = 1, $num_per_page = 10){
    #Lấy ra 1 bảng ghi với điều kiện WHERE LIKE tìm kiếm với hai trường page_title phải có từ khóa trong %...% và giới hạn tại chỉ số bắt đầu của trang đó và tổng số bản ghi trong 1 trang
    $sql = "SELECT * FROM `tbl_pages` WHERE `page_title` LIKE '%$value%' LIMIT {$start}, {$num_per_page}";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm tất cả các bài viết trong hệ thống
function db_search_all_posts($value)
{
    #Sử dụng truy vấn điều kiện WHERE LIKE tìm kiếm với hai trường post_title và parent_cat phải có từ khóa trong %...%
    $sql = "SELECT * FROM `tbl_posts` WHERE `post_title` LIKE '%$value%' OR `parent_cat` LIKE '%$value%'";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm các bài viết theo trang 
function db_search_posts_by_page($value, $start = 1, $num_per_page = 10){
    #Lấy ra 1 bảng ghi với điều kiện WHERE LIKE tìm kiếm với hai trường post_title phải có từ khóa trong %...% và giới hạn tại chỉ số bắt đầu của trang đó và tổng số bản ghi trong 1 trang
    $sql = "SELECT * FROM `tbl_posts` WHERE `post_title` LIKE '%$value%' LIMIT {$start}, {$num_per_page}";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm tất cả các danh mục bài viết trong hệ thống
function db_search_all_posts_cat($value)
{
    #Sử dụng truy vấn điều kiện WHERE LIKE tìm kiếm với hai trường cat_title và phải có từ khóa trong %...%
    $sql = "SELECT * FROM `tbl_posts_cat` WHERE `cat_title` LIKE '%$value%'";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm các danh mục bài viết theo trang
function db_search_posts_cat_by_page($value, $start = 1, $num_per_page = 10){
    #Lấy ra 1 bảng ghi với điều kiện WHERE LIKE tìm kiếm với hai trường cat_title phải có từ khóa trong %...% và giới hạn tại chỉ số bắt đầu của trang đó và tổng số bản ghi trong 1 trang
    $sql = "SELECT * FROM `tbl_posts_cat` WHERE `cat_title` LIKE '%$value%' LIMIT {$start}, {$num_per_page}";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm tất cả các sản phẩm trong hệ thống
function db_search_all_products($value, $order_by='')
{
    #Sử dụng truy vấn điều kiện WHERE LIKE tìm kiếm với hai trường product_title và product_code phải có từ khóa trong %...%
    $sql = "SELECT * FROM `tbl_products` WHERE `product_title` LIKE '%$value%' OR `product_code` LIKE '%$value%' $order_by ";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm sản phẩm theo theo trang
function db_search_products_by_page($value, $start = 1, $num_per_page = 10){
    #Lấy ra 1 bảng ghi với điều kiện WHERE LIKE tìm kiếm với hai trường product_title phải có từ khóa trong %...% và giới hạn tại chỉ số bắt đầu của trang đó và tổng số bản ghi trong 1 trang
    $sql = "SELECT * FROM `tbl_products` WHERE `product_title` LIKE '%$value%' LIMIT {$start}, {$num_per_page}";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm tất cả các danh mục sản phẩm trong hệ thống
function db_search_all_products_cat($value)
{
    #Sử dụng truy vấn điều kiện WHERE LIKE tìm kiếm với hai trường cat_title phải có từ khóa trong %...%
    $sql = "SELECT * FROM `tbl_products_cat` WHERE `cat_title` LIKE '%$value%'";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm danh mục sản phẩm theo theo trang
function db_search_products_cat_by_page($value, $start = 1, $num_per_page = 10){
    #Lấy ra 1 bảng ghi với điều kiện WHERE LIKE tìm kiếm với hai trường cat_title phải có từ khóa trong %...% và giới hạn tại chỉ số bắt đầu của trang đó và tổng số bản ghi trong 1 trang
    $sql = "SELECT * FROM `tbl_products_cat` WHERE `cat_title` LIKE '%$value%' LIMIT {$start}, {$num_per_page}";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm tất cả các đơn hàng trong hệ thống
function db_search_all_orders($value)
{
    #Sử dụng truy vấn điều kiện WHERE LIKE tìm kiếm với hai trường order_code và customer_name phải có từ khóa trong %...%
    $sql = "SELECT * FROM `tbl_orders` WHERE `order_code` LIKE '%$value%' OR `customer_name` LIKE '%$value%'";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm các đơn hàng theo trang 
function db_search_orders_by_page($value, $start = 1, $num_per_page = 10){
    #Lấy ra 1 bảng ghi với điều kiện WHERE LIKE tìm kiếm với hai trường page_title phải có từ khóa trong %...% và giới hạn tại chỉ số bắt đầu của trang đó và tổng số bản ghi trong 1 trang
    $sql = "SELECT * FROM `tbl_orders` WHERE `customer_name` LIKE '%$value%' LIMIT {$start}, {$num_per_page}";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm tất cả các khách hàng trong hệ thống
function db_search_all_customers($value)
{
    #Sử dụng truy vấn điều kiện WHERE LIKE tìm kiếm với hai trường customer_name và phone phải có từ khóa trong %...%
    $sql = "SELECT * FROM `tbl_customers` WHERE `customer_name` LIKE '%$value%' OR `phone` LIKE '%$value%'";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm các khách hàng theo trang 
function db_search_customers_by_page($value, $start = 1, $num_per_page = 10){
    #Lấy ra 1 bảng ghi với điều kiện WHERE LIKE tìm kiếm với hai trường customer_name phải có từ khóa trong %...% và giới hạn tại chỉ số bắt đầu của trang đó và tổng số bản ghi trong 1 trang
    $sql = "SELECT * FROM `tbl_customers` WHERE `customer_name` LIKE '%$value%' LIMIT {$start}, {$num_per_page}";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}


#Hàm tìm kiếm tất cả các khối trong hệ thống
function db_search_all_blocks($value)
{
    #Sử dụng truy vấn điều kiện WHERE LIKE tìm kiếm với hai trường block_title và block_code phải có từ khóa trong %...%
    $sql = "SELECT * FROM `tbl_blocks` WHERE `block_title` LIKE '%$value%' OR `block_code` LIKE '%$value%'";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm các khối theo trang 
function db_search_blocks_by_page($value, $start = 1, $num_per_page = 10){
    #Lấy ra 1 bảng ghi với điều kiện WHERE LIKE tìm kiếm với hai trường block_title phải có từ khóa trong %...% và giới hạn tại chỉ số bắt đầu của trang đó và tổng số bản ghi trong 1 trang
    $sql = "SELECT * FROM `tbl_blocks` WHERE `block_title` LIKE '%$value%' LIMIT {$start}, {$num_per_page}";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm tất cả các slider trong hệ thống
function db_search_all_sliders($value)
{
    #Sử dụng truy vấn điều kiện WHERE LIKE tìm kiếm với hai trường slider_title phải có từ khóa trong %...%
    $sql = "SELECT * FROM `tbl_sliders` WHERE `slider_title` LIKE '%$value%' LIKE '%$value%'";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm các slider theo trang 
function db_search_sliders_by_page($value, $start = 1, $num_per_page = 10)
{
    #Lấy ra 1 bảng ghi với điều kiện WHERE LIKE tìm kiếm với hai trường slider_title phải có từ khóa trong %...% và giới hạn tại chỉ số bắt đầu của trang đó và tổng số bản ghi trong 1 trang
    $sql = "SELECT * FROM `tbl_sliders` WHERE `slider_title` LIKE '%$value%' LIMIT {$start}, {$num_per_page}";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm tất cả các banner trong hệ thống
function db_search_all_banners($value)
{
    #Sử dụng truy vấn điều kiện WHERE LIKE tìm kiếm với hai trường banner_title phải có từ khóa trong %...%
    $sql = "SELECT * FROM `tbl_banners` WHERE `banner_title` LIKE '%$value%' LIKE '%$value%'";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm các banner theo trang 
function db_search_banners_by_page($value, $start = 1, $num_per_page = 10)
{
    #Lấy ra 1 bảng ghi với điều kiện WHERE LIKE tìm kiếm với hai trường banner_title phải có từ khóa trong %...% và giới hạn tại chỉ số bắt đầu của trang đó và tổng số bản ghi trong 1 trang
    $sql = "SELECT * FROM `tbl_banners` WHERE `banner_title` LIKE '%$value%' LIMIT {$start}, {$num_per_page}";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}

#Hàm tìm kiếm tất cả media 
function db_search_all_medias($value)
{
    #Sử dụng truy vấn điều kiện WHERE LIKE tìm kiếm với hai trường phải có từ khóa trong %...%
    $sql = "SELECT * FROM `tbl_admins` WHERE `avatar` LIKE '%$value%' LIKE '%$value%'"
    ."SELECT * FROM `tbl_products` WHERE `product_thumb` LIKE '%$value%' LIKE '%$value%'"
    ."SELECT * FROM `tbl_posts` WHERE `post_thumb` LIKE '%$value%' LIKE '%$value%'"
    ."SELECT * FROM `tbl_sliders` WHERE `slider_thumb` LIKE '%$value%' LIKE '%$value%'";
    #Lấy ra 1 bảng ghi với hai trường trên và trả về kết quả
    $result = db_fetch_array($sql);
    return $result;
}










