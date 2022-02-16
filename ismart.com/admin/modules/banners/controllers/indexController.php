<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('helper', 'slug');
    load('helper', 'image');
    load('lib', 'pagging');
    load('lib', 'status');
    load('lib', 'search');
}

#Hàm load index
function indexAction()
{
    load_view('indexBanner');
}

#Hàm Thêm Banner mới
function addBannerAction()
{
    global $error, $banner_title, $banner_link, $banner_desc, $num_order, $add_banners, $num_order, $data;
    #Kiểm tra đã submit chưa ?
    if (isset($_POST['btn-add-banner'])) {
        #Mảng báo lỗi
        $error = array();
        #Kiểm tra tên banner 
        if (empty($_POST['banner_title'])) {
            $error['banner_title'] = "(*) Bạn chưa nhập tên banner !";
        } else {
            $banner_title = $_POST['banner_title'];
        }
        #Kiểm tra link
        if (empty($_POST['banner_link'])) {
            $error['banner_link'] = "(*) Bạn chưa nhập đường link banner !";
        } else {
            $banner_link = create_slug($_POST['banner_link']);
        }
        #Kiểm tra mô tả banner
        if (empty($_POST['banner_desc'])) {
            $error['banner_desc'] = "(*) Bạn chưa nhập mô tả banner !";
        } else {
            $banner_desc = $_POST['banner_desc'];
        }
        #Kiểm tra số thứ tự banner
        if (empty($_POST['num_order'])) {
            $error['num_order'] = "(*) Bạn chưa nhập số thứ tự !";
        } else {
            $num_order = $_POST['num_order'];
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
                    $banner_thumb = upload_image('public/images/upload/banners/', $type);
                }
                #Ngược lại nếu thất bại thì báo lỗi ảnh
            } else {
                $error['upload_image'] = "(*) Bạn chưa chọn tệp ảnh";
            }
        }
        #Kiểm tra số trạng thái banner
        if (empty($_POST['banner_status'])) {
            $error['banner_status'] = "(*) Bạn chưa chọn trạng thái !";
        } else {
            $banner_status = $_POST['banner_status'];
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $banner_status = 'Approved';
            } else {
                $banner_status = 'Waiting...';
            }
            $banner_thumb = upload_image('public/images/upload/banners/', $type);
            $creator = $_SESSION['user_login'];
            #Và chấp nhận lưu trữ các thông tin trang mới vào CSDL
            $data = array(
                'banner_title' => $banner_title,
                'banner_link' => $banner_link,
                'banner_desc' => $banner_desc,
                'num_order' => $num_order,
                'banner_thumb' => $banner_thumb,
                'banner_status' => $banner_status,
                'creator' => $creator,
                'create_date' => date("d/m/Y"),
            );
            #Thêm trang mới với các dữ liệu trên
            $add_banners = add_banner($data);
            $error['banner'] = "Thêm banner mới thành công !" . "<br>" . "<a href='?mod=banners&controller=index&action=index'>Trở về danh sách banner</a>";
            // echo $add_banners;
            // show_array($data);
            // show_array($error);
        }
    }
    load_view('addBanner');
}

#Hàm cập nhập banner
function updateBannerAction() 
{
    global $error, $banner_title, $old_banner_title, $banner_link, $old_banner_link, $banner_desc, $old_banner_desc, $num_order, $old_num_order, $banner_status, $old_banner_status ,$data;
    $banner_id = $_GET['banner_id'];
    // show_array($_GET);
    if (isset($_POST['btn-update-banner'])) {
        $error = array();
        #Kiểm tra tên banner
        if (empty($_POST['banner_title'])) {
            $error['banner_title'] = "(*) Bạn chưa điền tên banner !";
        } else {
            $old_banner_title = get_inf_banner('banner_title', $banner_id);
            if ($_POST['banner_title'] == $old_banner_title) {
                $data = array (
                    'banner_title' => '',
                );
                update_banner($data, $banner_id);
            } 
            if(is_exists('tbl_banners', 'banner_title', $_POST['banner_title'])) {
                $error['banner_title'] = '(*) Tên banner đã tồn tại !';
            } else {
                $banner_title = $_POST['banner_title'];
            }
        }
        #Kiểm tra link 
        if (empty($_POST['banner_link'])) {
            $error['banner_link'] = "(*) Bạn chưa điền link banner !";
        } else {
            $old_banner_link = get_inf_banner('banner_link', $banner_id);
            if ($_POST['banner_link'] == $old_banner_link){
                $data = array(
                    'banner_link' => '',
                );
                update_banner($data, $banner_id);
            } 
            if(is_exists('tbl_banners', 'banner_link', $_POST['banner_link'])) {
                $error['banner_link'] = '(*) Link này đã tồn tại';
            } else {
                $banner_link = $_POST['banner_link'];
            }
        }
        #Kiểm tra mô tả banner
        if (empty($_POST['banner_desc'])) {
            $error['banner_desc'] = "(*) Bạn chưa mô tả banner !";
        } else {
            $old_banner_desc = get_inf_banner('banner_desc', $banner_id);
            $banner_desc = $_POST['banner_desc'];
        }
        #Kiểm tra số thứ tự 
        if (empty($_POST['num_order'])) {
            $error['num_order'] = "(*) Bạn chưa điền số thứ tự banner !";
        } else {
            $old_num_order = get_inf_banner('num_order', $banner_id);
            $num_order = $_POST['num_order'];
        }
        #Kiểm tra file tải lên
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "(*) Kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = get_inf_banner('banner_thumb', $banner_id);
                if(!empty($old_thumb)){
                    delete_image($old_thumb);
                    $banner_thumb = upload_image('public/images/upload/banners/', $type); 
                } else {
                    $banner_thumb = upload_image('public/images/upload/banners/', $type);
                }
            }
        } else {
            $banner_thumb = get_inf_banner('banner_thumb', $banner_id);
        }
        #Kiểm tra số trạng thái banner
        if (empty($_POST['banner_status'])) {
            $error['banner_status'] = "(*) Bạn chưa chọn trạng thái !";
        } else {
            $old_banner_status = get_inf_banner('banner_desc', $banner_id);
            $banner_status = $_POST['banner_status'];
        }
        #Kiểm tra có thay đổi ko nếu giống nhau thì cập nhập vào csdl, báo lỗi ko thay đổi
        if(($_POST['banner_title'] == $old_banner_title) && ($_POST['banner_link'] == $old_banner_link)  && ($_POST['banner_desc'] == $old_banner_desc) && ($_POST['num_order'] == $old_num_order) && ($_POST['banner_status'] == $old_banner_status) && !(isset($_FILES['file']) && !empty($_FILES['file']['name']))) {
            $data = array(
                'banner_title' => $old_banner_title,
                'banner_link' => $old_banner_link
            );
            update_banner($data, $banner_id);
            $error['banner'] = "(*) banner chưa có thay đổi gì !";
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $banner_status = 'Approved';
            } else {
                $banner_status = 'Waiting...';
            }
            $editor = get_admin_info($_SESSION['user_login']);
            #Và chấp nhận lưu trữ các thông tin member mới vào CSDL
            $data = array(
                'banner_title'=> $banner_title,
                'banner_link'=> $banner_link,
                'banner_desc'=> $banner_desc,
                'num_order'=> $num_order,
                'banner_thumb' => $banner_thumb,
                'banner_status' => $banner_status,
                'editor' => $editor,
                'edit_date' => date('d/m/y h:m'),
            );
            #Cập nhập cho admin đã  vào hệ thống
            update_banner($data, $banner_id);
            // show_array($data);
            $error['banner'] = "Cập nhật banner thành công !" . "<br>" . "<a href='?mod=banners&controller=index&action=index'>Trở về danh sách banner</a>";
        }
    }
    load_view('updateBanner');
}

#Hàm xóa banner
function deleteBannerAction()
{
    #Lấy banner theo id xuống
    $banner_id = (int) $_GET['banner_id'];
    #Xóa dữ liệu và chuyển hướng
    delete_banner($banner_id);
    redirect('?mod=banners&controller=index&action=index');
    load_view('indexBanner');
}

#Hàm tìm kiếm banner
function searchBannerAction()
{
    global $error, $value, $list_banners_all;
    if (isset($_GET['sm_s'])) {
        // show_array($_GET);
        if (!empty($_GET['value'])) {
            $value = $_GET['value'];
            // echo $value;
            #Tổng số lượng bảng ghi trên 1 trang
            // $num_per_page = 3;
            #Tổng sô bảng ghi lấy được
            $list_banners_all = db_search_all_banners($value);
            #Tổng số trang = hàm làm tròn (15/5) = 3
            // $total_row = count($list_banners_all);
            // $num_page = ceil($total_row / $num_per_page);
            load_view('searchBanner');
        } else {
            $error['error'] = '(*) Bạn cần nhập thông tin banner cần tìm kiếm !';
            load_view('indexBanner');
        }
    }
}

#Hàm trả về kết quả tìm kiếm Banner
function resultSearchAction()
{
    global $value;
    #Kiểm tra có giá trị thì get xuống 
    if(!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('searchBanner');
}   

#Hàm tác vụ của Banner
function applyBannerAction()
{
    if (isset($_POST['sm_action'])) {
        global $error, $data;
        if (is_login() && check_role($_SESSION['user_login']) == 1) {
            $error = array();
            if (!empty($_POST['checkItem'])) {
                $list_banner_id = $_POST['checkItem'];
            }
            if (!empty($_POST['actions'])) {
                if ($_POST['actions'] == 1) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'banner_status' => 'Approved',
                        );
                        foreach ($list_banner_id as $banner_id) {
                            update_banner($data, $banner_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchBanner');
                        } else {
                            load_view('indexBanner');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn banner cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('searchBanner');
                        } else {
                            load_view('indexBanner');
                        }
                    }
                }
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'Banner_status' => 'Waiting...',
                        );
                        foreach ($list_banner_id as $banner_id) {
                            update_banner($data, $banner_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchBanner');
                        } else {
                            load_view('indexBanner');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn banner cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('searchBanner');
                        } else {
                            load_view('indexBanner');
                        }
                    }
                }
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'banner_status' => 'Trash',
                        );
                        foreach ($list_banner_id as $banner_id) {
                            update_banner($data, $banner_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchBanner');
                        } else {
                            load_view('indexBanner');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn banner cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('searchBanner');
                        } else {
                            load_view('indexBanner');
                        }
                    }
                }
            } else {
                $error['select'] = '(*) Bạn chưa lựa chọn tác vụ !';
                if (isset($_GET['value'])) {
                    load_view('searchBanner');
                } else {
                    load_view('indexBanner');
                }
            }
        } else {
            $error['select'] = "(*) Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('searchBanner');
            } else {
                load_view('indexBanner');
            }
        }
    }
}