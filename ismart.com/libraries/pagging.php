<?php

#Hàm phân trang danh mục sản phẩm
function get_pagging_home($num_page, $page, $cat_id)
{
    $str_pagging = "<ul class='list-pagging fl-right' clearfix'>";
        $str_pagging .= "<li><a class = 'common_selector_home' cat-id = '$cat_id'><i class='fa fa-angle-left'></i></a></li>";
    for($i = 1; $i <= $num_page; $i++) {
       $active = "";
       if($page == $i) {
           $active = "class = 'active-num-page'";
       }
       $str_pagging .= "<li {$active}><a class = 'common_selector_home $active' cat-id = '$cat_id'>$i</a></li>";
    }
        $str_pagging .= "<li><a class = 'common_selector_home' cat-id = '$cat_id'><i class='fa fa-angle-right'></i></a></li>";
    $str_pagging .= "</ul>";
    return $str_pagging;
}

#Hàm phân trang danh sách sản phẩm
function get_pagging_product($num_page, $page, $cat_id)
{
    //Thẻ mở danh sách phân trang   
    $str_pagging = "<ul class='pagging fl-right' id='list-paging'>";
        //Nút prev theo cat_id 
        $str_pagging .= "<li><a class = 'num-page' cat-id = '$cat_id'><i class='fa fa-angle-left'></i></a></li>";
    //Sử dụng vòng lặp for để chạy qua từng phần tử và kiểm tra giá trị theo thứ tự tăng dần
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        //Nếu i của vòng lặp = chỉ số hiện tại của trang thì thêm class active cho số đó
        if ($i == $page) {
            $active = "class= 'active-num-page'";
        }
        //Và chỉ số hiện tại đk active cũng chính là số page_id trên url tương đương nhau
        $str_pagging .= "<li {$active}><a class = 'num-page $active' cat-id = '$cat_id'>$i</a></li>";
    }
       //Nút next theo cat_id
        $str_pagging .= "<li><a class = 'num-page' cat-id = '$cat_id'><i class='fa fa-angle-right'></i></a></li>";
    //Thẻ đóng danh sách phân trang
    $str_pagging .= "</ul>";
    return $str_pagging;
}

#Hàm phân trang danh mục sản phẩm
function get_pagging_cat($num_page, $page, $cat_id)
{
    $str_pagging = "<ul class='pagging fl-right' id='list-paging'>";
        $str_pagging .= "<li><a class = 'common_selector' cat-id = '$cat_id'><i class='fa fa-angle-left'></i></a></li>";
    for($i = 1; $i <= $num_page; $i++) {
       $active = "";
       if($page == $i) {
           $active = "class = 'active-num-page'";
       }
       $str_pagging .= "<li {$active}><a class = 'common_selector $active' cat-id = '$cat_id'>$i</a></li>";
    }
        $str_pagging .= "<li><a class = 'common_selector' cat-id = '$cat_id'><i class='fa fa-angle-right'></i></a></li>";
    $str_pagging .= "</ul>";
    return $str_pagging;
}

#Hàm phân trang danh sách bài viết
function get_pagging_post($num_page, $page)
{
    //Thẻ mở danh sách phân trang   
    $str_pagging = "<ul class='pagging fl-right' id='list-paging'>";
        $str_pagging .= "<li><a class = 'common_selector_post'><i class='fa fa-angle-left'></i></a></li>";
    //Sử dụng vòng lặp for để chạy qua từng phần tử và kiểm tra giá trị theo thứ tự tăng dần
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        //Nếu i của vòng lặp = chỉ số hiện tại của trang thì thêm class active cho số đó
        if ($i == $page) {
            $active = "class= 'active-num-page'";
        }
        //Và chỉ số hiện tại đk active cũng chính là số page_id trên url tương đương nhau
        $str_pagging .= "<li  {$active}><a class = 'common_selector_post $active'>$i</a></li>";
    }
        $str_pagging .= "<li><a class = 'common_selector_post'><i class='fa fa-angle-right'></i></a></li>";
    //Thẻ đóng danh sách phân trang
    $str_pagging .= "</ul>";
    return $str_pagging;
}

#Hàm lấy số trang phân trang tìm kiếm
function get_pagging_search($num_page, $page, $cat_id, $value)
{
    $str_pagging = "<ul class='pagging fl-right' id='list-paging'>";
    $str_pagging .= "<li><a class = 'common_selector_search' value='$value' cat-id = '$cat_id'><i class='fa fa-angle-left'></i></a></li>";
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($page == $i) {
            $active = "class= 'active-num-page'";
        }
        $str_pagging .= "<li {$active}><a class = 'common_selector_search $active' value='$value' cat-id = '$cat_id'>$i</a></li>";
    }
    $str_pagging .= "<li><a class = 'common_selector_search' value='$value' cat-id = '$cat_id'><i class='fa fa-angle-right'></i></a></li>";
    $str_pagging .= "</ul>";
    return $str_pagging;
}

#lấy số trang theo bảng ghi 
function db_num_page($tbl, $record)
{
    global $conn;
    #Truy vấn số bảng ghi 
    $sql = "SELECT * FROM $tbl";
    #lấy số bảng ghi 
    $num_rows = db_num_rows($sql);
    #Số trang
    $num_page = ceil($num_rows / $record);
    #Danh sách số thứ tự trang 1, 2, 3, 4....
    $list_num_page = array();
    for ($i = 1; $i <= $num_page; $i++) {
        $list_num_page[] = $i;
    }
    return $list_num_page;
}



