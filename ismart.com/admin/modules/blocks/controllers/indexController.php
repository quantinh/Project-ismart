<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('lib', 'pagging');
    load('lib', 'search');
}

#Hàm load index
function indexAction()
{
    load_view('indexWidget');
}

#Hàm Thêm khối mới
function addWidgetAction()
{
    global $error, $block_title, $block_code, $block_content, $add_blocks, $data;
    #Kiểm tra đã submit chưa ?
    if (isset($_POST['btn-add-block'])) {
        #Mảng báo lỗi
        $error = array();
        #Kiểm tra tên khối 
        if (empty($_POST['block_title'])) {
            $error['block_title'] = "(*) Bạn chưa nhập tên khối !";
        } else {
            $block_title = $_POST['block_title'];
        }
        #Kiểm tra mã khối
        if (empty($_POST['block_code'])) {
            $error['block_code'] = "(*) Bạn chưa nhập mã khối !";
        } else {
            $block_code = $_POST['block_code'];
        }
        #Kiểm tra nội dung khối
        if (empty($_POST['block_content'])) {
            $error['block_content'] = "(*) Bạn chưa nhập nội dung khối !";
        } else {
            $block_content = $_POST['block_content'];
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Người tạo bằng tên người lưu trữ trên hệ thống qua session
            $creator = $_SESSION['user_login'];
            // $creator = get_admin_info($_SESSION['user_login']);
            #Và chấp nhận lưu trữ các thông tin trang mới vào CSDL
            $data = array(
                'block_title' => $block_title,
                'block_code' => $block_code,
                'block_content' => $block_content,
                'creator' => $creator,
                'create_date' => date("d/m/Y"),
            );
            #Thêm trang mới với các dữ liệu trên
            $add_blocks = add_block($data);
            $error['block'] = "Thêm khối mới thành công !" . "<br>" . "<a href='?mod=blocks&controller=index&action=index'>Trở về danh sách khối</a>";
            // echo $add_pages;
            // show_array($data);
            // show_array($error);
        }
    }
    load_view('addWidget');
}

#Hàm cập nhập khối
function updateWidgetAction() 
{
    global $error, $block_title, $old_block_title, $block_code, $old_block_code, $block_content, $old_block_content, $data;
    $block_id = $_GET['block_id'];
    // show_array($_GET);
    if (isset($_POST['btn-update-block'])) {
        #Mảng chữa lỗi ?
        $error = array();
        #Kiểm tra tiêu đề của khối 
        if (empty($_POST['block_title'])) {
            $error['block_title'] = "(*) Bạn chưa điền tên khối !";
        } else {
            $old_block_title = get_inf_block('block_title', $block_id);
            if ($_POST['block_title'] == $old_block_title) {
                $data = array (
                    'block_title' => '',
                );
                update_block($data, $block_id);
            } 
            if(is_exists('tbl_blocks', 'block_title', $_POST['block_title'])) {
                $error['block_title'] = '(*) Tên khối đã tồn tại !';
            } else {
                $block_title = $_POST['block_title'];
            }
        }
        #Kiểm tra mã khối
        if (empty($_POST['block_code'])) {
            $error['block_code'] = "(*) Bạn chưa điền mã khối !";
        } else {
            $old_block_code = get_inf_block('block_code', $block_id);
            if ($_POST['block_code'] == $old_block_code){
                $data = array(
                    'block_code' => '',
                );
                update_block($data, $block_id);
            } 
            if(is_exists('tbl_blocks', 'block_code', $_POST['block_code'])) {
                $error['block_code'] = '(*) Mã khối này đã tồn tại !';
            } else {
                $block_code = $_POST['block_code'];
            }
        }
        #Kiểm tra nội dung khối
        if (empty($_POST['block_content'])) {
            $error['block_content'] = "(*) Bạn chưa điền nội dung khối !";
        } else {
            $old_block_content = get_inf_block('block_content', $block_id);
            $block_content = $_POST['block_content'];
        }
        #Kiểm tra có thay đổi ko nếu giống nhau thì cập nhập vào csdl, báo lỗi ko thay đổi
        if(($block_title == $old_block_title) && ($block_code == $old_block_code) && ($block_content == $old_block_content)) {
            $data = array(
                'block_title' => $old_block_title,
                'block_code' => $old_block_code,
                'block_content' => $block_content
            );
            update_block($data, $block_id);
            $error['block'] = "(*) khối chưa có thay đổi gì !";
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Và chấp nhận lưu trữ các thông tin member mới vào CSDL
            $data = array(
                'block_title' => $old_block_title,
                'block_code' => $old_block_code,
                'block_content' => $block_content
            );
            #Cập nhập cho admin đã  vào hệ thống
            update_block($data, $block_id);
            // show_array($data);
            $error['block'] = "Cập nhật khối thành công !" . "<br>" . "<a href='?mod=blocks&controller=index&action=index'>Trở về danh sách khối</a>";
        }
    }
    load_view('updateWidget');
}

#Hàm xóa khối
function deleteWidgetAction()
{
    #Lấy trang theo id xuống
    $block_id = (int) $_GET['block_id'];
    #Xóa dữ liệu và chuyển hướng
    delete_block($block_id);
    redirect('?mod=blocks&controller=index&action=index');
    load_view('indexWidget');
}

#Hàm tìm kiếm khối
function searchWidgetAction()
{
    global $error, $value, $list_blocks_all;
    if (isset($_GET['sm_s'])) {
        // show_array($_GET);
        if (!empty($_GET['value'])) {
            $value = $_GET['value'];
            // echo $value;
            #Tổng số lượng bảng ghi trên 1 trang
            // $num_per_page = 3;
            #Tổng sô bảng ghi lấy được
            $list_blocks_all = db_search_all_blocks($value);
            #Tổng số trang = hàm làm tròn (15/5) = 3
            // $total_row = count($list_pages_all);
            // $num_page = ceil($total_row / $num_per_page);
            load_view('searchWidget');
        } else {
            $error['error'] = '(*) Bạn cần nhập thông tin Khối cần tìm kiếm !';
            load_view('indexWidget');
        }
    }
}

#Hàm trả về kết quả tìm kiếm khối
function resultSearchAction()
{
    global $value;
    #Kiểm tra có giá trị thì get xuống 
    if(!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('searchWidget');
}   

#Hàm tác vụ của khối
function applyWidgetAction()
{
    if (isset($_POST['sm_action'])) {
        global $error;
        $error = array();
        if(!empty($_POST['checkItem'])) {
            $list_block_id = $_POST['checkItem'];
        }
        if (!empty($_POST['actions'])) {
            if ($_POST['actions'] == 1) {
                if (isset($_POST['checkItem'])) {
                    foreach ($list_block_id as $block_id) {
                        delete_block($block_id);
                    }
                    if(isset($_GET['value'])) {
                        load_view('searchWidget');
                    } else{
                        load_view('indexWidget');
                    }
                } else {
                    $error['select'] = "Bạn chưa lựa chọn khối cần xóa";
                    if(isset($_GET['value'])) {
                        load_view('searchWidget');
                    } else {
                        load_view('indexWidget');
                    }
                }
            }
        } else {
            $error['select'] = "Bạn chưa lựa chọn tác vụ";
            if(isset($_GET['value'])){
                load_view('searchWidget');
            } else {
                load_view('indexWidget');
            }
        }
    }
}
