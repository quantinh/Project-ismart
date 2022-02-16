<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'pagging');
    load('lib', 'search');
    load('lib', 'status');
    load('helper', 'image');
    load('helper', 'format');
    load('helper', 'slug');
}

#Hàm load index
function indexAction()
{
    #Nếu lấy được giá trị tìm kiếm xuống thì load trang search
    if(isset($_GET['value'])){
        load_view('searchAdmins');
    } else {
        #Gía trị được lấy từ hàm và đưa vào mảng dữ liệu $data
        $data['list_admins'] = get_list_admins();
        #Gía trị được được lấy từ  hàm lấy số bảng ghi từ CSDL và đưa vào mảng dữ liệu $data
        $data['num_rows'] = get_num_rows('tbl_admins');
        load_view('teamIndex', $data);
    }
}

#Hàm Thêm tài khoản quản trị viên mới
function addAdminAction()
{
    global $error, $fullname, $username, $password, $email, $tel, $address, $admin_status, $creator, $role, $add_admin;
    #Kiểm tra đã submit chưa ?
    if (isset($_POST['btn-add-admin'])) {
        #Mảng báo lỗi
        $error = array();
        #Kiểm tra họ và tên
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "(*) Không được để trống fullname";
        } else {
            $fullname = $_POST['fullname'];
        }
        #Kiểm tra tên người dùng
        if (empty($_POST['username'])) {
            $error['username'] = "(*) Không được để trống tên đăng nhập";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "(*) Tên đăng nhập không đúng định dạng";
            } else {
                if (db_num_rows("SELECT * FROM `tbl_admins` WHERE `username` = '{$_POST['username']}'") >= 1) {
                    $error['username'] = "(*)Tên đăng nhập đã tồn tại";
                } else {
                    $username = $_POST['username'];
                }
            }
        }
        #Kiểm tra mật khẩu
        if (empty($_POST['password'])) {
            $error['password'] = "(*) Không được để trống password";
        } else {
            if (!(strlen($_POST['password']) >= 6 && strlen($_POST['password']) <= 32)) {
                $error['password'] = "(*) Mật khẩu từ 6 đến 32 ký tự";
            } else {
                if (!is_password($_POST['password'])) {
                    $error['password'] = "(*) Mật khẩu không đúng định dạng";
                } else {
                    $password = md5($_POST['password']);
                }
            }
        }
        #Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "(*) Không được để trống email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "(*) Email không đúng định dạng";
            } else {
                if (db_num_rows("SELECT * FROM `tbl_admins` WHERE `email` = '{$_POST['email']}'") >= 1) {
                    $error['email'] = "(*) Email đã tồn tại";
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
        #Kiểm tra địa chỉ liên hệ
        if (empty($_POST['address'])) {
            $error['address'] = "(*) Không được để trống địa chỉ để liên lạc";
        } else {
            $address = $_POST['address'];
        }
        #Kiểm tra file tải lên
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "(*) Kích thước hoặc kiểu ảnh không đúng";
            }
        } else {
            $error['upload_image'] = "(*) Bạn chưa tải tệp ảnh lên";
        }
        #Kiểm tra đã tải tệp ảnh lên chưa ?
        if (isset($_POST['btn-upload-thumb'])) {
            #Kiểm tra file và tên file có tồn tại chưa ?
            if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
                #Tên file . đuôi mở rộng
                $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                #Kích thước file
                $size = $_FILES['file']['size'];
                #Kiểm tra định dạng file đúng chưa nếu chưa báo lỗi và ngược lại upload theo đường dẫn gốc ?
                if (!is_image($type, $size)) {
                    $error['upload_image'] = "(*) Kích thước hoặc kiểu tệp không đúng";
                } else {
                    $avatar = upload_image('public/images/upload/admins/', $type);
                }
                #Ngược lại nếu thất bại thì báo lỗi ảnh
            } else {
                $error['upload_image'] = "(*) Bạn chưa chọn tệp ảnh";
            }
        }
        #kiểm tra phân cấp quyền quản trị
        if (empty($_POST['role'])) {
            $error['role'] = "(*) Bạn chưa chọn cấp quyền";
        } else {
            $role = $_POST['role'];
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Kiểm tra nếu không tồn tại admin với 2 thông tin tên người dùng và email thì cho tạo và lưu ngày/tháng/năm
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $admin_status = 'Approved';
            } else {
                $admin_status = 'Waiting...';
            }
            $avatar = upload_image('public/images/upload/admins/', $type);
            #Người tạo được gán với giá trị của hàm lấy thông tin admin quản trị cấp 1 do hệ thống khi login lưu trữ
            $creator = get_admin_info($_SESSION['user_login']);
            #Và chấp nhận lưu trữ các thông tin member mới vào CSDL
            $data = array(
                'fullname' => $fullname,
                'username' => $username,
                'password' => md5($password),
                'email' => $email,
                'tel' => $tel,
                'address' => $address,
                'avatar' => $avatar,
                'role' => $role,
                'admin_status' => $admin_status,
                'active' => 'không hoạt động',
                'reg_date' => date("d/m/Y"),
                'creator' => $creator,
            );
            #Thêm thành viên mới với các dữ liệu trên
            $add_admin = add_admin($data);
            $error['admin'] = "Thêm Admin mới thành công !" . "<br>" . "<a href='?mod=users&controller=team&action=index'>Trở về danh sách nhóm quản trị viên</a>";
            // echo $add_admin;
            // show_array($data);
            // show_array($error);
        }
    }
    load_view('addAdmins');
}

#Hàm cập nhập thông tin quản trị viên mới
function updateAdminAction()
{
    global $error, $fullname, $email, $tel, $address, $avatar, $admin_status, $role;
    if (isset($_GET['admin_id'])) {
        #kiểm tra đã bấm cập nhập chưa?
        $admin_id = $_GET['admin_id'];
        // show_array($_GET);
    }
    if (isset($_POST['btn-update'])) {
        #Mảng chữa lỗi ?
        $error = array();
        #Kiểm tra họ và tên
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "(*) Không được để trống fullname";
        } else {
            $fullname = $_POST['fullname'];
        }
        #Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "(*) Không được để trống email";
        } else {
            $email = $_POST['email'];
        }
        #Kiểm tra số điện thoại
        if (!empty($_POST['tel'])) {
            $tel = $_POST['tel'];
        }
        #Kiểm tra địa chỉ liên hệ
        if (!empty($_POST['address'])) {
            $address = $_POST['address'];
        }
        #Kiểm tra file tải lên
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "(*) Kích thước hoặc kiểu ảnh không đúng";
            } else {
                $avatar_admin = get_inf_admins('avatar', $admin_id);
                if (!empty($avatar_admin)) {
                    delete_image($avatar_admin);
                    $avatar = upload_image('public/images/upload/admins/', $type);
                } else {
                    $avatar = upload_image('public/images/upload/admins/', $type);
                }
            }
        } else {
            $avatar = get_inf_admins('avatar', $admin_id);
        }
        #kiểm tra phân cấp quyền quản trị
        if (empty($_POST['role'])) {
            $error['role'] = "(*) Bạn chưa chọn cấp quyền";
        } else {
            $role = $_POST['role'];
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Gán trạng thái chờ đợi
            $admin_status = 'Waiting...';
            #Biên tập viên được gán bằng hàm lấy thông tin của các admin chủ cấp 1
            $editor = get_admin_info($_SESSION['user_login']);
            #Và chấp nhận lưu trữ các thông tin member mới vào CSDL
            $data = array(
                'fullname' => $fullname,
                'email' => $email,
                'tel' => $tel,
                'address' => $address,
                'avatar' => $avatar,
                'admin_status' => $admin_status,
                'role' => $role,
                'active' => $editor,
                'edit_date' => date("d/m/Y h:m:s"),
            );
            #Cập nhập cho admin đã  vào hệ thống
            update_admin($data, $admin_id);
            $error['admin'] = "Cập nhật Admin thành công !" . "<br>" . "<a href='?mod=users&controller=team&action=index'>Trở về danh sách Admin</a>";
            // show_array($data);
        }
    }
    load_view('updateAdmin');
}

#Hàm xóa tài khoản quản trị viên
function deleteAdminAction()
{
    #Lấy admin theo id xuống
    $admin_id = (int) $_GET['admin_id'];
    #Xóa dữ liệu và chuyển hướng
    delete_admin($admin_id);
    redirect('?mod=users&controller=team&action=index');
    load_view('teamIndex');
}

#Hàm tìm kiếm admin bất kì quản trị viên 
function searchAdminAction()
{
    global $error, $value, $num_page;
    if (isset($_GET['sm_s'])) {
        // show_array($_GET);
        if (!empty($_GET['value'])) {
            $value = $_GET['value'];
            // echo $value;
            #Tổng số lượng bảng ghi trên 1 trang
            $num_per_page = 3;
            #Tổng sô bảng ghi lấy được
            $list_admins_all = db_search_all_admins($value);
            $total_row = count($list_admins_all);
            #Tổng số trang = hàm làm tròn (15/5) = 3
            $num_page = ceil($total_row / $num_per_page);
            load_view('searchAdmins');
        } else {
            $error['error'] = '(*) Bạn cần nhập thông tin Admin cần tìm kiếm !';
            load_view('teamIndex');
        }
    }
}

#Hàm trả về kết quả tìm kiếm quản trị viên
function resultSearchAction()
{
    global $value;
    #Kiểm tra giá trị lấy xuống
    if(!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('searchAdmins');
}

#Hàm tác vụ của quản trị viên
function applyAdminAction()
{
    if (isset($_POST['sm_action'])) {
        global $error, $data;
        #Kiểm tra đã login chưa và kiểm tra xem role có = 1 không nếu = 1 thì cho thực thi những dk dưới
        if (is_login() && check_role($_SESSION['user_login']) == 1) {
            $error = array();
            #Nếu tồn tại giá trị phần tử thì gán bằng biến danh sách admin theo id
            if (!empty($_POST['checkItem'])) {
                $list_admin_id = $_POST['checkItem'];
            }
            #Nếu tồn tại giá trị action thì 
            if (!empty($_POST['action'])) {
                #kiểm tra xem action có action phê duyệt hay không ? 
                if ($_POST['action'] == 1) {
                    #Kiểm tra checkItem tồn tại thì cấp nhập giá trị cho $data
                    if (isset($_POST['checkItem'])) {
                        #Nếu có thì cập nhập cho $data trạng thái Approved
                        $data = array(
                            'admin_status' => 'Approved',
                        );
                        #Duyệt các phần tử id admin và cập nhập vào hệ thống csdl
                        foreach ($list_admin_id as $admin_id) {
                            update_admin($data, $admin_id);
                        // show_array($list_admin_id);
                        }
                        #Nếu tồn tại value thì lấy xuống và load tìm kiếm
                        if (isset($_GET['value'])) {
                            load_view('searchAdmins');
                        #Ngược lại thì tiếp tục kiểm tra lấy giá trị xuống và load trang 
                        } else {
                            load_view('teamIndex');
                        }
                    #Và nếu không tồn tại thì báo lối
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn Admin cần áp dụng";
                        #Và tiếp tục kiểm tra có giá trị hay không nếu có load view và ngược lại
                        if (isset($_GET['value'])) {
                            load_view('searchAdmins');
                        } else {
                            load_view('teamIndex');
                        }
                    }
                }
                #kiểm tra xem action có action chờ phê duyệt hay không ? 
                if ($_POST['action'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'admin_status' => 'Waiting...',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_admin($data, $admin_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchAdmins');
                        } else {
                            load_view('teamIndex');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn Admin cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('searchAdmins');
                        } else {
                            load_view('teamIndex');
                        }
                    }
                }
                #kiểm tra xem action có action bỏ vào thùng rác hay không ? 
                if ($_POST['action'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'admin_status' => 'Trash',
                        );
                        foreach ($list_admin_id as $admin_id) {
                            update_admin($data, $admin_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchAdmins');
                        } else {
                            load_view('teamIndex');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn Admin cần xóa";
                        if (isset($_GET['value'])) {
                            load_view('searchAdmins');
                        } else {
                            load_view('teamIndex');
                        }
                    }
                }
            } else {
                $error['select'] = '(*) Bạn chưa lựa chọn tác vụ !';
                if (isset($_GET['value'])) {
                    load_view('searchAdmins');
                } else {
                    load_view('teamIndex');
                }
            }
        #Ngược lại nếu chưa login và ko có role = 1 thì báo lỗi tiếp tục kt và get xuống
        } else {
            $error['select'] = "Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('searchAdmins');
            } else {
                load_view('teamIndex');
            }
        }
    }
}