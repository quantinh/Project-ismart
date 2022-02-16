<?php

#Lấy danh sách phân trang bài viết
function get_posts($start = 1, $num_per_page = 10, $where = ''){
    if(!empty($where)){
        $where = "WHERE {$where}";
    }
    $list_posts = db_fetch_array("SELECT* FROM `tbl_posts` WHERE `post_status` = 'Approved' ORDER BY `post_id` DESC {$where} LIMIT {$start}, {$num_per_page}");
    return $list_posts;
} 

#Lấy thông tin bài viết
function get_inf_post($field, $post_id){
    $info_post_id = db_fetch_row("SELECT `$field` FROM `tbl_posts` WHERE `post_id` = '{$post_id}'");
    if(!empty($info_post_id[$field]))
    return $info_post_id[$field];
}

#Lấy thông tin menu
function get_inf_menu($field, $menu_id){
    $info_menu_id = db_fetch_row("SELECT `$field` FROM `tbl_menus` WHERE `menu_id` = '{$menu_id}'");
    return  $info_menu_id[$field];
}
