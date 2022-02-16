<?php

#Hàm xử lí hiển thị dữ liêu dạng mảng khi cần thiết 
function show_array($data) {
    if (is_array($data)) {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}

