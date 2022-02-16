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
    load_view('indexSlider');
}

#Hàm Thêm slider mới
function addSliderAction()
{
    global $error, $slider_title, $slider_link, $slider_desc, $num_order, $add_sliders, $num_order, $data;
    #Kiểm tra đã submit chưa ?
    if (isset($_POST['btn-add-slider'])) {
        #Mảng báo lỗi
        $error = array();
        #Kiểm tra tên slider 
        if (empty($_POST['slider_title'])) {
            $error['slider_title'] = "(*) Bạn chưa nhập tên slider !";
        } else {
            $slider_title = $_POST['slider_title'];
        }
        #Kiểm tra link
        if (empty($_POST['slider_link'])) {
            $error['slider_link'] = "(*) Bạn chưa nhập đường link slider !";
        } else {
            $slider_link = create_slug($_POST['slider_link']);
        }
        #Kiểm tra mô tả slider
        if (empty($_POST['slider_desc'])) {
            $error['slider_desc'] = "(*) Bạn chưa nhập mô tả slider !";
        } else {
            $slider_desc = $_POST['slider_desc'];
        }
        #Kiểm tra số thứ tự slider
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
                    $slider_thumb = upload_image('public/images/upload/sliders/', $type);
                }
                #Ngược lại nếu thất bại thì báo lỗi ảnh
            } else {
                $error['upload_image'] = "(*) Bạn chưa chọn tệp ảnh";
            }
        }
        #Kiểm tra số trạng thái slider
        if (empty($_POST['slider_status'])) {
            $error['slider_status'] = "(*) Bạn chưa chọn trạng thái !";
        } else {
            $slider_status = $_POST['slider_status'];
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $slider_status = 'Approved';
            } else {
                $slider_status = 'Waiting...';
            }
            $slider_thumb = upload_image('public/images/upload/sliders/', $type);
            $creator = $_SESSION['user_login'];
            #Và chấp nhận lưu trữ các thông tin trang mới vào CSDL
            $data = array(
                'slider_title' => $slider_title,
                'slider_link' => $slider_link,
                'slider_desc' => $slider_desc,
                'num_order' => $num_order,
                'slider_thumb' => $slider_thumb,
                'slider_status' => $slider_status,
                'creator' => $creator,
                'create_date' => date("d/m/Y"),
            );
            #Thêm trang mới với các dữ liệu trên
            $add_sliders = add_slider($data);
            $error['slider'] = "Thêm slider mới thành công !" . "<br>" . "<a href='?mod=sliders&controller=index&action=index'>Trở về danh sách slider</a>";
            // echo $add_sliders;
            // show_array($data);
            // show_array($error);
        }
    }
    load_view('addSlider');
}

#Hàm cập nhập slider
function updateSliderAction() 
{
    global $error, $slider_title, $old_slider_title, $slider_link, $old_slider_link, $slider_desc, $old_slider_desc, $num_order, $old_num_order, $slider_status, $old_slider_status ,$data;
    $slider_id = $_GET['slider_id'];
    // show_array($_GET);
    if (isset($_POST['btn-update-slider'])) {
        $error = array();
        #Kiểm tra tên slider
        if (empty($_POST['slider_title'])) {
            $error['slider_title'] = "(*) Bạn chưa điền tên slider !";
        } else {
            $old_slider_title = get_inf_slider('slider_title', $slider_id);
            if ($_POST['slider_title'] == $old_slider_title) {
                $data = array (
                    'slider_title' => '',
                );
                update_slider($data, $slider_id);
            } 
            if(is_exists('tbl_sliders', 'slider_title', $_POST['slider_title'])) {
                $error['slider_title'] = '(*) Tên slider đã tồn tại !';
            } else {
                $slider_title = $_POST['slider_title'];
            }
        }
        #Kiểm tra link 
        if (empty($_POST['slider_link'])) {
            $error['slider_link'] = "(*) Bạn chưa điền link slider !";
        } else {
            $old_slider_link = get_inf_slider('slider_link', $slider_id);
            if ($_POST['slider_link'] == $old_slider_link){
                $data = array(
                    'slider_link' => '',
                );
                update_slider($data, $slider_id);
            } 
            if(is_exists('tbl_sliders', 'slider_link', $_POST['slider_link'])) {
                $error['slider_link'] = '(*) Link này đã tồn tại';
            } else {
                $slider_link = $_POST['slider_link'];
            }
        }
        #Kiểm tra mô tả slider
        if (empty($_POST['slider_desc'])) {
            $error['slider_desc'] = "(*) Bạn chưa mô tả slider !";
        } else {
            $old_slider_desc = get_inf_slider('slider_desc', $slider_id);
            $slider_desc = $_POST['slider_desc'];
        }
        #Kiểm tra số thứ tự 
        if (empty($_POST['num_order'])) {
            $error['num_order'] = "(*) Bạn chưa điền số thứ tự slider !";
        } else {
            $old_num_order = get_inf_slider('num_order', $slider_id);
            $num_order = $_POST['num_order'];
        }
        #Kiểm tra file tải lên
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "(*) Kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = get_inf_slider('slider_thumb', $slider_id);
                if(!empty($old_thumb)){
                    delete_image($old_thumb);
                    $slider_thumb = upload_image('public/images/upload/sliders/', $type); 
                } else {
                    $slider_thumb = upload_image('public/images/upload/sliders/', $type);
                }
            }
        } else {
            $slider_thumb = get_inf_slider('slider_thumb', $slider_id);
        }
        #Kiểm tra số trạng thái slider
        if (empty($_POST['slider_status'])) {
            $error['slider_status'] = "(*) Bạn chưa chọn trạng thái !";
        } else {
            $old_slider_status = get_inf_slider('slider_desc', $slider_id);
            $slider_status = $_POST['slider_status'];
        }
        #Kiểm tra có thay đổi ko nếu giống nhau thì cập nhập vào csdl, báo lỗi ko thay đổi
        if(($_POST['slider_title'] == $old_slider_title) && ($_POST['slider_link'] == $old_slider_link)  && ($_POST['slider_desc'] == $old_slider_desc) && ($_POST['num_order'] == $old_num_order) && ($_POST['slider_status'] == $old_slider_status) && !(isset($_FILES['file']) && !empty($_FILES['file']['name']))) {
            $data = array(
                'slider_title' => $old_slider_title,
                'slider_link' => $old_slider_link
            );
            update_slider($data, $slider_id);
            $error['slider'] = "(*) Slider chưa có thay đổi gì !";
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $slider_status = 'Approved';
            } else {
                $slider_status = 'Waiting...';
            }
            $editor = get_admin_info($_SESSION['user_login']);
            #Và chấp nhận lưu trữ các thông tin member mới vào CSDL
            $data = array(
                'slider_title'=> $slider_title,
                'slider_link'=> $slider_link,
                'slider_desc'=> $slider_desc,
                'num_order'=> $num_order,
                'slider_thumb' => $slider_thumb,
                'slider_status' => $slider_status,
                'editor' => $editor,
                'edit_date' => date('d/m/y h:m'),
            );
            #Cập nhập cho admin đã  vào hệ thống
            update_slider($data, $slider_id);
            // show_array($data);
            $error['slider'] = "Cập nhật slider thành công !" . "<br>" . "<a href='?mod=sliders&controller=index&action=index'>Trở về danh sách slider</a>";
        }
    }
    load_view('updateSlider');
}

#Hàm xóa slider
function deleteSliderAction()
{
    #Lấy slider theo id xuống
    $slider_id = (int) $_GET['slider_id'];
    #Xóa dữ liệu và chuyển hướng
    delete_slider($slider_id);
    redirect('?mod=sliders&controller=index&action=index');
    load_view('indexSlider');
}

#Hàm tìm kiếm slider
function searchSliderAction()
{
    global $error, $value, $list_sliders_all;
    if (isset($_GET['sm_s'])) {
        // show_array($_GET);
        if (!empty($_GET['value'])) {
            $value = $_GET['value'];
            // echo $value;
            #Tổng số lượng bảng ghi trên 1 trang
            // $num_per_page = 3;
            #Tổng sô bảng ghi lấy được
            $list_sliders_all = db_search_all_sliders($value);
            #Tổng số trang = hàm làm tròn (15/5) = 3
            // $total_row = count($list_sliders_all);
            // $num_page = ceil($total_row / $num_per_page);
            load_view('searchSlider');
        } else {
            $error['error'] = '(*) Bạn cần nhập thông tin slider cần tìm kiếm !';
            load_view('indexSlider');
        }
    }
}

#Hàm trả về kết quả tìm kiếm slider
function resultSearchAction()
{
    global $value;
    #Kiểm tra có giá trị thì get xuống 
    if(!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('searchSlider');
}   

#Hàm tác vụ của slider
function applySliderAction()
{
    if (isset($_POST['sm_action'])) {
        global $error, $data;
        if (is_login() && check_role($_SESSION['user_login']) == 1) {
            $error = array();
            if (!empty($_POST['checkItem'])) {
                $list_slider_id = $_POST['checkItem'];
            }
            if (!empty($_POST['actions'])) {
                if ($_POST['actions'] == 1) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'slider_status' => 'Approved',
                        );
                        foreach ($list_slider_id as $slider_id) {
                            update_slider($data, $slider_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchSlider');
                        } else {
                            load_view('indexSlider');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn slider cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('searchSlider');
                        } else {
                            load_view('indexSlider');
                        }
                    }
                }
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'Slider_status' => 'Waiting...',
                        );
                        foreach ($list_slider_id as $slider_id) {
                            update_slider($data, $slider_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchSlider');
                        } else {
                            load_view('indexSlider');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn slider cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('searchSlider');
                        } else {
                            load_view('indexSlider');
                        }
                    }
                }
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'slider_status' => 'Trash',
                        );
                        foreach ($list_slider_id as $slider_id) {
                            update_slider($data, $slider_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchSlider');
                        } else {
                            load_view('indexSlider');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn slider cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('searchSlider');
                        } else {
                            load_view('indexSlider');
                        }
                    }
                }
            } else {
                $error['select'] = '(*) Bạn chưa lựa chọn tác vụ !';
                if (isset($_GET['value'])) {
                    load_view('searchSlider');
                } else {
                    load_view('indexSlider');
                }
            }
        } else {
            $error['select'] = "(*) Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('searchSlider');
            } else {
                load_view('indexSlider');
            }
        }
    }
}