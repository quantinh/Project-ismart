<?php

#Lấy danh mục theo mod và action
function get_title($mod, $action)
{
    if($mod == 'products'){
        return 'Sản phẩm';
    }
    if($mod == 'posts'){
        return 'Blog';
    }
    if($mod == 'pages' && $action == 'about'){
        return 'Giới thiệu';
    }
    if($mod == 'pages' && $action == 'contact'){
        return 'Liên hệ';
    }
}