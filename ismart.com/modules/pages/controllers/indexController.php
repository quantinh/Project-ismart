<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct() 
{
    load_model('index');
    load('helper', 'format');
    load('lib', 'validation');
}

#load trang index
function indexAction() 
{
    if(isset($_GET['menu_id']) && !empty($_GET['menu_id'])){
        $menu_id = $_GET['menu_id'];
        $menu_title = get_inf_menu('menu_title', $menu_id);
        if($menu_title == 'Giới thiệu'){
            load_view('about');
        }
        if($menu_title == 'Liên hệ'){
            load_view('contact');
        }
    }
}

#load trang giới thiệu
function aboutAction() 
{
    load_view('about');
}

#load trang liên hệ
function contactAction() 
{
    load_view('contact');
}