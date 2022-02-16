<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('helper', 'slug');
    load('lib', 'data_tree');
    load('lib', 'pagging');
    load('lib', 'status');
    load('lib', 'search');
}

#Hàm load index
function indexAction()
{
    load_view('menu');
}

#Hàm Thêm menu mới
function addMenuAction()
{
    global $error, $menu_title, $menu_url_static, $page_slug, $product_id, $menu_id, $menu_order, $add_menu, $data;
    #Kiểm tra đã submit chưa ?
    if (isset($_POST['btn-add-menu'])) {
        #Mảng báo lỗi
        $error = array();
        #Kiểm tra tiêu đề menu 
        if (empty($_POST['menu_title'])) {
            $error['menu_title'] = "(*) Bạn chưa nhập tên menu !";
        } else {
            if (is_exists('tbl_menus', 'menu_title', $_POST['menu_title'])) {
                $error['menu_title'] = '(*) Tên menu đã tồn tại';
            } else {
                $menu_title = $_POST['menu_title'];
            }
        }
        #Kiểm tra đường dẫn tĩnh
        if (empty($_POST['menu_url_static'])) {
            $error['menu_url_static'] = "(*) Bạn chưa nhập đường dẫn tĩnh !";
        } else {
            $menu_url_static = $_POST['menu_url_static'];
        }
        #Kiểm tra slug trang
        if (!empty($_POST['page_slug'])) {
            $page_slug = $_POST['page_slug'];
            $data['page_slug'] = $page_slug;
        }
        #Kiểm tra product theo id
        if (!empty($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
            $data['product_id'] = $product_id;
        }
        #Kiểm tra menu theo id
        if (!empty($_POST['menu_id'])) {
            $menu_id = $_POST['menu_id'];
            $data['menu_id'] = $menu_id;
        }
        #Kiểm tra số số thứ tự 
        if (empty($_POST['menu_order'])) {
            $error['menu_order'] = "(*) Bạn chưa nhập số thứ tự!";
        } else { 
            if(is_number($_POST['menu_order'])){
                $menu_order = $_POST['menu_order'];
            } else {
                $error['menu_order'] = "(*) Bạn cần nhập số thứ tự đúng định dạng !";
            }
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $data = array (
                    'menu_title' => $menu_title,
                    'menu_url_static' => $menu_url_static,
                    'menu_order' => $menu_order
                );
                #Thêm trang mới với các dữ liệu trên
                $add_menu = add_menu($data);
                $error['menu'] = "Thêm menu mới thành công !";
                // echo $add_menu;
                // show_array($data);
                // show_array($error);
            } else {
                $error['menu'] = "(*) Bạn không có quyền thực hiện chức năng này !"; 
            }
        }
    }
    load_view('menu');
}

#Hàm cập nhập trang 
function updateMenuAction() 
{
    global $error, $menu_title, $old_menu_title, $menu_url_static, $old_menu_url_static, $page_slug, $old_page_slug, $product_id, $old_product_id, $menu_id, $old_menu_id, $menu_order, $old_menu_order, $data;
    #kiểm tra đã lấy được id theo trang chưa?
    $menu_id = $_GET['menu_id'];
    // show_array($_GET);
    if (isset($_POST['btn-update-menu'])) {
        #Mảng chữa lỗi ?
        $error = array();
        if (empty($_POST['menu_title'])) {
            $error['menu_title'] = "(*) Bạn chưa điền tên menu !";
        } else {
            $old_menu_title = get_inf_menu('menu_title', $menu_id);
            if ($_POST['menu_title'] == $old_menu_title) {
                $data = array (
                    'menu_title' => '',
                );
                update_menu($data, $menu_id);
            } 
            if(is_exists('tbl_menus', 'menu_title', $_POST['menu_title'])) {
                $error['menu_title'] = '(*) Tên menu đã tồn tại !';
            } else {
                $menu_title = $_POST['menu_title'];
            }
        }
        if (empty($_POST['menu_url_static'])) {
            $error['menu_url_static'] = "(*) Bạn chưa điền đường dẫn tĩnh !";
        } else {
            $old_menu_url_static = get_inf_menu('menu_url_static', $menu_id);
            if ($_POST['menu_url_static'] == $old_menu_url_static){
                $data = array(
                    'menu_url_static' => '',
                );
                update_menu($data, $menu_id);
            } 
            if(is_exists('tbl_menus', 'menu_url_static', $_POST['menu_url_static'])) {
                $error['menu_url_static'] = '(*) Link này đã tồn tại';
            } else {
                $menu_url_static = $_POST['menu_url_static'];
            }
        }
        if (empty($_POST['page_slug'])) {
            $error['page_slug'] = "(*) Bạn chưa page slug !";
        } else {
            $old_page_slug = get_inf_menu('page_slug', $menu_id);
            $page_slug = $_POST['page_slug'];
        }
        if (empty($_POST['product_id'])) {
            $error['product_id'] = "(*) Bạn chưa chọn danh mục sản phẩm theo id !";
        } else {
            $old_product_id = get_inf_menu('product_id', $menu_id);
            $product_id = $_POST['product_id'];
        }
        if (empty($_POST['menu_id'])) {
            $error['menu_id'] = "(*) Bạn chưa chọn danh mục menu theo id !";
        } else {
            $old_menu_id = get_inf_menu('menu_id', $menu_id);
            $menu_id = $_POST['menu_id'];
        }
        // if (empty($_POST['menu_order'])) {
        //     $error['menu_order'] = "(*) Bạn chưa nhập số thứ tự !";
        // } else {
        //     $old_menu_order = get_inf_menu('menu_order', $menu_id);
        //     $menu_order = $_POST['menu_order'];
        // }
        if (empty($_POST['menu_order'])) {
            $error['menu_order'] = "(*) Bạn chưa điền số thứ tự !";
        } else {
            if(is_number($_POST['menu_order'])){
                $menu_order = $_POST['menu_order'];
                // $data['menu_order'] = $menu_order;
                $old_menu_order = get_inf_menu('menu_order', $menu_id);
            } else{
                $error['menu_order'] = '(*) Số thứ tự chưa đúng định dạng';
            }   
        }
        if (empty($error)) {
            #Kiểm tra có thay đổi ko nếu giống nhau thì cập nhập vào csdl, báo lỗi ko thay đổi
            if(($menu_title == $old_menu_title) && ($menu_url_static == $old_menu_url_static) && ($page_slug == $old_page_slug) && ($product_id == $old_product_id)  && ($menu_id == $old_menu_id) && ($menu_order == $old_menu_order)) {
                $data = array(
                    'menu_title' => $old_menu_title,
                    'menu_url_static' => $menu_url_static,
                    'menu_order'=>$menu_order
                );
                update_menu($data, $menu_id);
                $error['menu'] = "(*) Menu chưa có thay đổi gì !";
            }
            #Và chấp nhận lưu trữ các thông tin member mới vào CSDL
            $data = array(
                'menu_title'=> $menu_title,
                'menu_url_static'=> $menu_url_static,
                'page_slug'=> $page_slug,
                'product_id'=> $product_id,
                'menu_id'=> $menu_id,
                'menu_order'=> $menu_order,
            );
            #Cập nhập cho admin đã  vào hệ thống
            update_menu($data, $menu_id);
            // show_array($data);
            $error['menu'] = "Cập nhật menu thành công !" . "<br>" . "<a href='?mod=menus&controller=index&action=index'>Trở về danh sách trang</a>";
        }
    }
    load_view('updateMenu');
}

#Hàm xóa trang
function deleteMenuAction()
{
    #Lấy trang theo id xuống
    $menu_id = (int) $_GET['menu_id'];
    #Xóa dữ liệu và chuyển hướng
    delete_menu($menu_id);
    redirect('?mod=menus&controller=index&action=index');
    load_view('menu');
}

#Hàm tác vụ của menu
function applyMenuAction()
{
    if (isset($_POST['sm_action'])) {
        global $error;
        if (is_login() && check_role($_SESSION['user_login']) == 1) {
            $error = array();
            if (!empty($_POST['checkItem'])) {
                $list_menu_id = $_POST['checkItem'];
            }
            if (!empty($_POST['actions'])) {
                if ($_POST['actions'] == 1) {
                    if (isset($_POST['checkItem'])) {
                        foreach ($list_menu_id as $menu_id) {
                            delete_menu($menu_id);
                            }
                            load_view('menu');
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn menu cần áp dụng";
                        load_view('menu');
                    }
                }
            } else {
                $error['select'] = '(*) Bạn chưa lựa chọn tác vụ !';
                load_view('menu');
            }
        } else {
            $error['select'] = "(*) Bạn không có quyền thực hiện thao tác này!";
            load_view('menu');
        }
    }
}



