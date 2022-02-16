<?php
// Nhập các lớp PHPMailer vào không gian tên chung
// Các lớp này phải ở đầu tập lệnh của bạn, không phải bên trong một hàm
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Hàm gửi mail tự động
function send_mail($sent_to_email, $sent_to_fullname, $subject, $content, $options = array())
{
    //khởi tạo biến cấu hình tầm rộng để đồng nhất config lại với nhau
    global $config;
    //Cho cấu hình email đã config đầy đủ tại đây bằng với mảng config của email\$config['email'];
    $config_email = $config['email'];
    // Khởi tạo và truyền 'true' cho phép ngoại lệ
    $mail = new PHPMailer(true);
    try {
        //Cài đặt máy chủ
        $mail->SMTPDebug = 0; //Bật đầu ra gỡ lỗi dài dòng
        $mail->isSMTP(); //Gửi bằng SMTP
        $mail->Host = $config_email['smtp_host']; //Đặt máy chủ SMTP để gửi qua
        $mail->SMTPAuth = true; //Bật xác thực SMTP
        $mail->Username = $config_email['smtp_user']; //Tên người dùng SMTP
        $mail->Password = $config_email['smtp_pass']; //Mật khẩu SMTP
        $mail->SMTPSecure = $config_email['smtp_secure']; //Bật mã hóa TLS; Khuyến khích 'PHPMailer :: ENCRYPTION_SMTPS'
        $mail->Port = $config_email['smtp_port'];; //Cổng TCP để kết nối, sử dụng 465 cho 'PHPMailer :: ENCRYPTION_SMTPS' ở trên
        $mail->CharSet = 'UTF-8';

        //Người nhận
        $mail->setFrom($config_email['smtp_user'], $config_email['smtp_fullname']);
        $mail->addAddress($sent_to_email, $sent_to_fullname); //Thêm người nhận
        //$mail->addAddress('ellen@example.com');              //Tên là tùy chọn
        $mail->addReplyTo($config_email['smtp_user'], $config_email['smtp_fullname']);
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Phần đính kèm
        //$mail->addAttachment('haquantinh.jpg');             //Thêm tệp đính kèm
        //$mail->addAttachment('haquantinh.jpg', 'tinh.jpg'); //Tên tùy chọn
        //Nội dung
        $mail->isHTML(true); //Đặt định dạng email thành HTML
        $mail->Subject = $subject;
        $mail->Body = $content;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
        // echo 'Đã gửi thành công';
    } catch (Exception $e) {
        return 'Email không được gửi: Chi tiết lỗi'. $mail->ErrorInfo;
    }
}
