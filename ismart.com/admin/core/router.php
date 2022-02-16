<?php

//Triệu tập gọi đến file xử lý thông qua request(yêu cầu)
$request_path = MODULESPATH . DIRECTORY_SEPARATOR . get_module() . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . get_controller().'Controller.php';

if (file_exists($request_path)) {
    require $request_path;
} else {
    echo "Không tìm thấy:$request_path ";
}

$action_name = get_action().'Action';

call_function(array('construct', $action_name));

//Admin luôn luôn xử lí chặn trên url để người dùng ko xâm nhập vào 
//Xử lí chặn lại khi người dùng chưa login mà lại cố tình muốn chuyển hướng trên url xâm nhập vào hệ thống để khai thác
//Nếu chưa login và chưa thực hiện được action login thì
if(!is_login() && get_action() != 'login')
    #chuyển hướng về trang login để bắt buộc người dùng phải login 
    redirect('?mod=users&action=login');


