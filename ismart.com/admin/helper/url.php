<?php

#Hàm xử lí cấu hình định nghĩa url friendly 
function base_url($url = "") {
    global $config;
    return $config['base_url'].$url;
}

#Hàm xử lí chuyển hướng   
function redirect($url = "") {
    global $config;
    $path = $config['base_url'].$url;
    header("Location: {$path}");
}

