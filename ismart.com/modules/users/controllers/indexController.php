<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct() 
{
    load_model('index');
    load('lib','validation');
    load('lib','email');
}

#Đăng kí tài khoản
function indexAction() 
{
    #Sử dụng global toàn cục để gọi những biến liên quan trên hệ thống mà ko bị giới hạn 
    global  $error, $fullname, $username, $password, $email, $tel;
    if (isset($_POST['btn-reg'])) {
        $error = array();
        #Kiểm tra họ và tên
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "(*)Không được để trống fullname";
        } else {
            $fullname = $_POST['fullname'];
        }
        #Kiểm tra tên đăng nhập
        if (empty($_POST['username'])) {
            $error['username'] = "(*)Không được để trống tên đăng nhập";
        } else {
            if (!(strlen($_POST['username']) >= 6 && strlen($_POST['username']) <= 32)) {
                $error['username'] = "Số lượng yêu cầu từ 6 đến 32 ký tự";
            } else {
                if (!is_username($_POST['username'])) {
                    $error['username'] = "(*)Tên đăng nhập không đúng định dạng";
                } else {
                    if (is_exists("tbl_users", "username", $_POST['username'])) {
                        $error['username'] = "(*)Tên đăng nhập đã tồn tại";
                    } else {
                        $username = $_POST['username'];
                    }
                }
            }
        }
        #Kiểm tra mật khẩu
        if (empty($_POST['password'])) {
            $error['password'] = "(*)không được để trống mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "(*)Mật khẩu không đúng định dạng";
            } else {    
                $password = md5($_POST['password']);
            }
        }
        #Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "(*)không được để trống email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "(*)Email không đúng định dạng";
            } else {
                if (is_exists("tbl_users", "email", $_POST['email'])) {
                    $error['email'] = "(*)Emai người dùng đã tồn tại";
                } else {
                    $email = $_POST['email'];
                }
            }
        }
        #Kiểm tra số điện thoại
        if (empty($_POST['tel'])) {
            $error['tel'] = "(*) Không được để trống số điện thoại liên hệ";
        } else {
            if (!is_phone_number($_POST['tel'])) {
                $error['tel'] = "(*) Số điện thoại không đúng định dạng";
            } else {
                $tel = $_POST['tel'];
            }
        }
        #Kết Luận
        if (empty($error)) {
            #Kiểm tra xem hai trường user và email có trùng hay không? 
            if(!user_exists($username, $email)){
                #Tạo một biến mã kích hoạt username + thời gian hiện tại
                $active_token = md5($username.time());
                #Ngày đăng kí tài khoản 
                $reg_date = time();
                #Yêu cầu thành công
                $subject = 'Kích hoạt đăng kí tài khoản thành công';
                #Tạo mảng data để lưu trữ tạm thời những thông tin
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'tel' => $tel,
                    'active_token' => $active_token,
                    'reg_date'=> $reg_date,
                    'active_token' => $active_token
                );
                #và sau đó thêm vào hệ thống CSDL
                add_user($data);
                #Link active
                $link_active = base_url("?mod=users&controller=index&action=active&active_token={$active_token}");
                #Nội dung kích hoạt của một chuỗi HTML 
                $content = "<p>Chào bạn {$fullname}</p>
                <p>Bạn vui lòng click vào đường link này để kích hoạt tài khoản trong vòng 24h: {$link_active}</p>
                <p>Nếu bạn không kích hoạt trong vòng 24h tài khoản sẽ tự hủy</p>
                <p>Nếu không phải bạn đăng kí tài khoản thì hãy bỏ qua email này</p>
                <p>Nhóm hỗ trợ ...</p>";
                #Gửi mail đến cho người dùng kích hoạt tài khoản
                send_mail($email, $fullname, $subject, $content);
                #Chuyển hướng khi đã thêm xong 
                redirect("kiem-tra-email.html");
            } else {
                #Thông báo lỗi tồn tại bảng ghi trển hệ thống ko cho phép trùng 
                $error['reg_account'] = "(*)Email hoặc tên đăng nhập đã tồn tại trên hệ thống"; 
            }
        }
    }
    load_view('index');
}

#Hàm kiểm tra email
function checkEmailAction() 
{
    load_view('checkEmail');
}

#Active(kích hoạt) tài khoản
function activeAction()
{
    $active_token = $_GET['active_token'];
    $link_login = base_url("dang-nhap.html");
    #Nếu chưa kích hoạt mã thì 
    if(check_active_token($active_token)){
        #Cho người dùng kích hoạt (click vào mã cập nhập lại = 1 trong db) 
        active_user($active_token);
        #Xử lí bằng hàm để active cho nó bằng 1
        echo "Bạn đã kích hoạt thành công, vui lòng click vào đây để đăng nhập <a href='{$link_login}'>Đăng nhập</a>";
    } else {
        #Ngược lại sẽ trả về thông báo 
        echo "Yêu cầu kích hoạt ko hợp lệ hoặc tài khoản đã được kích hoạt trước đó!, vui lòng click vào đây để đăng nhập <a href='{$link_login}'>Đăng nhập</a>";
    }
}

#Đăng nhập tài khoản 
function loginAction() 
{
    #Sử dụng global toàn cục để gọi những biến liên quan trên hệ thống mà ko bị giới hạn 
    global $error, $username, $password;
    if (isset($_POST['btn-login'])) {
        $error = array(); 
        #Kiểm tra tên đăng nhập
        if (empty($_POST['username'])) {
            $error['username'] = "(*)Không được để trống tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "(*)Tên đăng nhập không đúng định dạng";
            } else {
                $username = $_POST['username'];
            }
        }
        #Kiểm tra mật khẩu
        if (empty($_POST['password'])) {
            $error['password'] = "(*)không được để trống mật khẩu";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "(*)Mật khẩu không đúng định dạng";
            } else {
                $password = md5($_POST['password']);
            }
        }
        #Kết Luận
        if (empty($error)) {
            #Kiểm tra tài khoản đăng nhập nếu tồn tại trên CSDL trùng là $username, $password thì cho vào hệ thống 
            if (check_login($username, $password)) {
                #Nếu tồn tại thì Lưu trữ trên duyệt với cookie
                if (isset($_POST['remember_me'])) {
                    setcookie('is_login', true, time() + 3600);
                    setcookie('user_login', $username, time() + 3600);
                }
                #Lưu trữ phiên đăng nhập
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                #Chuyển hướng đi vào trong hệ thống
                redirect("trang-chu.html");
            } else {
                #Thông báo lỗi về tài khoản 
                $error['account'] = "(*)Tên đăng nhập hoặc mật khẩu không tồn tại";
            }
        }
    }
    load_view('login');
}

#Đăng xuất tài khoản
function logoutAction() 
{
    #Xóa cookie khỏi duyệt đã login và user
    setcookie('is_login', true, time() -3600);
    setcookie('user_login', true, time() -3600);
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("dang-nhap.html");
}

#Khôi phục mật khẩu
function resetAction() 
{
    #Sử dụng global toàn cục để gọi những biến liên quan trên hệ thống mà ko bị giới hạn 
    global $error, $password, $email;
    #Lấy mã khôi phục mật khẩu từ url xuống
    $reset_token = $_GET['reset_token'];
    #Nếu mã ko trống 
    if(!empty($reset_token)){
        if(check_reset_token($reset_token)){
            if (isset($_POST['btn-new-pass'])) {
                $error = array(); 
                #Kiểm tra mật khẩu
                if (empty($_POST['password'])) {
                    $error['password'] = "không được để trống mật khẩu";
                } else {
                    if (!is_password($_POST['password'])) {
                        $error['password'] = "Mật khẩu không đúng định dạng";
                    }else{    
                        $password = md5($_POST['password']);
                    }
                }
                #Kết Luận
                if (empty($error)) {
                    #Ngày khôi phục
                    $reset_date = time();
                    $data = array(
                        'password' => $password,
                        'reset_date' => $reset_date,
                        'reset_token' =>"",
                    );
                    #Cập nhập mật khẩu mới cho người dùng
                    update_pass($data, $reset_token);
                    #Chuyển hướng khi đã đổi xong 
                    redirect("doi-mat-khau-thanh-cong.html");
                }
            }
            load_view('newPass');
        } else {
            echo "Yêu cầu lấy lại mật khẩu hợp lệ";
        }
    } else {
        if (isset($_POST['btn-reset'])) {
            $error = array(); 
            #Kiểm tra email
            if (empty($_POST['email'])) {
                $error['email'] = "không được để trống email";
            } else {
                if (!is_email($_POST['email'])) {
                    $error['email'] = "Email không đúng định dạng";
                } else {
                    $email = $_POST['email'];
                }
            }
            #Kết Luận
            if (empty($error)) {
                #Kiểm tra tài khoản đăng nhập nếu tồn tại trên CSDL trùng là $username, $password thì cho vào hệ thống 
                if (check_email($email)) {
                    // echo"Email có tồn tại";
                    $reset_token = md5($email.time());
                    $data = array(
                        'reset_token' => $reset_token
                    );
                    #Cập nhập mã khôi phục tài khoản cho người dùng bị mất
                    update_reset_token($data, $email);
                    #Link khôi phục
                    $link_reset = base_url("?mod=users&controller=index&action=reset&reset_token={$reset_token}");
                    #Nội dung khôi phục lại mật khẩu của một chuỗi HTML 
                    $content = "<p>Chào bạn</p>
                    <p>Bạn vui lòng click vào đường link sau để khôi phục lại mật khẩu: {$link_reset}</p>
                    <p>Nếu không phải yêu cầu của bạn thì hãy bỏ qua email này</p>
                    <p>TeamSupport</p>";
                    #Gửi link khôi phục vào email người dùng
                    send_mail($email, '', 'Khôi phục mật khẩu', $content);
                } else {
                    #Thông báo lỗi về tài khoản
                    $error['account'] = "Địa chỉ email không tồn tại trên hệ thống";
                }
            }
        }
        load_view('reset');
    }
}

#Đổi mật khẩu thành công
function resetSuccessAction() 
{
    load_view('resetSuccess');
}