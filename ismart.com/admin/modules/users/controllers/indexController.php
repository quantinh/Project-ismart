<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct()
{
    load_model('index');
    load('helper', 'image');
    load('lib', 'validation');
}

#Đăng nhập tài khoản quản trị viên chủ
function loginAction()
{
    // echo time();
    #Xuất ra thời gian ngày/giờ/phút/ giây của hiện tại
    // echo date("d/m/Y h:m:s");
    #Sử dụng global toàn cục để gọi những biến liên quan trên hệ thống mà ko bị giới hạn
    global $error, $username, $password;
    if (isset($_POST['btn-login'])) {
        $error = array();
        #Kiểm tra tên đăng nhập
        if (empty($_POST['username'])) {
            $error['username'] = "(*) Không được để trống tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "(*) Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        #Kiểm tra mật khẩu
        if (empty($_POST['password'])) {
            $error['password'] = "(*) không được để trống mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "(*) Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }
        #Kiểm tra có lỗi hay không? 
        if (empty($error)) {
            #Kiểm tra tên đăng nhập và mật khẩu có khớp với dữ liệu của hệ thống hay không?
            if (check_login($username, $password)) {
                #Nếu tồn tại thì Lưu trữ trên duyệt với cookie
                if (isset($_POST['remember_me'])) {
                    setcookie('is_login', true, time() + 3600);
                    setcookie('user_login', $username, time() + 3600);
                }
                #Và Lưu trữ phiên đăng nhập
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                #Chuyển hướng đi vào trong hệ thống
                redirect("?mod=users&controller=team&action=index");
            } else {
                #Ngược lại nếu không tồn tài tài khoản thì thông báo lỗi
                $error['account'] = "(*) Tên đăng nhập hoặc mật khẩu không tồn tại";
            }
        }
    }
    load_view('login');
}

#Hàm cập nhập thông tin tài khoản chủ 
function infoAccountAction()
{
    global $error, $fullname, $user, $email, $tel, $address, $avatar;
    #Kiểm tra đã submit chưa ?
    if (isset($_POST['btn-update'])) {
        #Mảng báo lỗi
        $error = array();
        #Mảng lưu thông tin quản trị viên 
        $data = array();
        #Kiểm tra tên người dùng
        if (!empty($_POST['fullname'])) {
            $fullname = $_POST['fullname'];
            $data['fullname'] = $fullname;
        }
        #Kiểm tra email
        if (!empty($_POST['email'])) {
            $email = $_POST['email'];
            is_email($email); 
            $data['email'] = $email;
        }
        #Kiểm tra số điện thoại
        if (!empty($_POST['tel'])) {
            $tel = $_POST['tel'];
            $data['tel'] = $tel;
        }
        #Kiểm tra địa chỉ liên hệ
        if (!empty($_POST['address'])) {
            $address = $_POST['address'];
            $data['address'] = $address;
        }
        #Kiểm tra file tải lên
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "(*) Kích thước hoặc kiểu ảnh không đúng";
            } else {
                $avatar_admin = info_user('avatar');
                if (!empty($avatar_admin)) {
                    delete_image($avatar_admin);
                    $avatar = upload_image('public/images/upload/admins/', $type);
                    $data['avatar'] = $avatar;
                } else {
                    $avatar = upload_image('public/images/upload/admins/', $type);
                    $data['avatar'] = $avatar;
                }
            }
        } else {
            $avatar = info_user('avatar');
            $data['avatar'] = $avatar;
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Thì tiếp tục kiểm tra xem có dữ liệu không ?
            if (!empty($data)) {
                $user = $_SESSION['user_login'];
                #Cập nhập cho admin đã login vào hệ thống
                update_info_accounts($data, $user);
                $error['account'] = 'Cập nhật tài khoản thành công !';
            } else {
                $error['account'] = '(*) Bạn cần nhập thông tin để cập nhật ?';
            }
        } else {
            // print_r($error);
            // show_array($data);
            // show_array($error);
        }
    }
    load_view('infoAccount');
}

#Đổi mật khẩu quản chị viên chủ
function changePassAction()
{
    global  $error, $pass_old, $pass_new, $confirm_pass;
    #Kiểm tra submit chưa ?
    if (isset($_POST['btn-submit'])) {
        #Mảng chứa lỗi
        $error = array();
        #Kiểm tra mật khẩu cũ có tồn tại chưa ?
        if (empty($_POST['pass-old'])) {
            $error['pass_old'] = "(*) Nhập mật khẩu cũ";
        } else {
            if (!is_password($_POST['pass-old'])) {
                $error['pass_old'] = "(*) Nhập mật khẩu không đúng định dạng";
            } else {
                if (!check_pass_old($_POST['pass-old'])) {
                    $error['pass_old'] = "(*) Mật khẩu này không tồn tại";
                } else {
                    $pass_old = $_POST['pass-old'];
                }
            }
        }
        #Kiểm tra mật khẩu mới
        if (empty($_POST['pass-new'])) {
            $error['pass_new'] = "(*) Nhập mật khẩu mới";
        } else {
            if (!is_password($_POST['pass-new'])) {
                $error['pass_new'] = "(*) Mật khẩu không đúng định dạng";
            } else {
                $pass_old = $_POST['pass-new'];
            }
        }
        #Xác nhận mật khẩu mới
        if (empty($_POST['confirm-pass'])) {
            $error['confirm_pass'] = "(*) Nhập lại mật khẩu mới";
        } else {
            if (!is_password($_POST['confirm-pass'])) {
                $error['confirm_pass'] = "(*) Mật khẩu không đúng định dạng";
            } else {
                $pass_old = $_POST['confirm-pass'];
            }
        }
        #Nếu mật khẩu mới khác xác nhập mật khẩu...
        if ($pass_new != $confirm_pass) {
            $error['confirm_pass'] = "(*) Mật khẩu xác nhận chưa trùng khớp";
        } else {
            $data['password'] = md5($confirm_pass);
        }
        #Kiểm tra có lỗi hay không?  
        if (empty($error)) {
            update_new_password($data, $pass_old);
            redirect("?mod=users&controller=index&action=login");
        }
    }
    load_view('changePass');
}

#Đăng xuất tài khoản 
function logoutAction()
{
    #Xóa cookie khỏi duyệt đã login và user
    setcookie('is_login', true, time() -3600);
    setcookie('user_login', true, time() -3600);
    #Xóa session khỏi hệ thống
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    #Thực hiện chuyển hướng khi xóa xong
    redirect("?mod=users&controller=index&action=login");
}


