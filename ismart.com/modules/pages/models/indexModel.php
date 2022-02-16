<?php

#Hàm lấy thông tin menu
function get_inf_menu($field, $menu_id){
    $result = db_fetch_row("SELECT `$field` FROM `tbl_menus` WHERE `menu_id` = '{$menu_id}'");
    return  $result[$field];
}

#Hàm lấy thông tin trang 
function get_inf_page($field, $page_id){
    $result = db_fetch_row("SELECT `$field` FROM `tbl_pages` WHERE `page_id` = '{$page_id}'");
    if(!empty($result[$field])) 
    return  $result[$field];
}

?>

