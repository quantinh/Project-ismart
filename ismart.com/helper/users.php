<?php

#Hàm trả về True nếu đã login
function is_login() {
    if (isset($_SESSION['is_login']))
        return true;
    return false;
}

#Hàm trả về username của người login
function user_login() {
    if (!empty($_SESSION['user_login'])) {
        return $_SESSION['user_login'];
    }
    return false;
}

#Hàm lấy danh sách đơn hàng đã mua trong giỏ hàng
function get_list_buy_cart()
{
    if(isset($_SESSION['cart']['buy'])){
        return $_SESSION['cart']['buy'];
    }
    return false;
}

#Hàm lấy thông tin của đơn hàng trong giỏ hàng
function get_inf_cart()
{
    if(isset($_SESSION['cart'])){
        return $_SESSION['cart']['info'];
    }
    return false;
}

