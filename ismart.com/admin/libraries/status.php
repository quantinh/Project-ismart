<?php 

#Hàm đổi màu trạng thái 
function text_color_status($status) 
{
    if(!empty($status) && $status == 'Approved' || $status == 'Thành công' ) {
        echo 'text-primary';
    } else if(!empty($status) && $status == 'Waiting...' || $status == 'Đang vận chuyển') {
        echo 'text-success';
    } else {
        echo 'text-danger';
    } 
}

#Hàm hiển thị trạng thái thanh toán
function show_payment($data)
{
    if($data == 1){
        $data = 'Thanh toán tại nhà';
        return $data;
    } else if($data == 2){
        $data = 'Thanh toán tại ngân hàng';
        return $data;
    }
}

#Hàm hiển thị trạng thái 
function show_status($data)
{
    if($data == 1){
        $data = 'Chờ duyệt';
        return $data;
    } else if($data == 2){
        $data = 'Đang vận chuyển';
        return $data;
    } else {
        $data = 'Thành công';
        return $data;
    }
}