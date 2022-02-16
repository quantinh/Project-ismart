<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('helper', 'slug');
    load('helper', 'image');
    load('lib','data_tree');
    load('lib','get_num_order');
    load('lib', 'pagging');
    load('lib', 'status');
    load('lib', 'search');
}

#Hàm load index
function indexAction()
{
    load_view('listCat');
}

#Hàm Thêm danh mục sản phẩm mới
function addCatAction()
{
    global $error, $cat_title, $cat_slug, $cat_status, $parent_id, $add_cat, $data;
    #Kiểm tra đã submit chưa ?
    if (isset($_POST['btn-add-cat'])) {
        #Mảng báo lỗi
        $error = array();
        #Kiểm tra tiêu đề danh mục sản phẩm
        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "(*) Bạn chưa nhập tiêu đề !";
        } else {
            if(is_exists('tbl_products_cat', 'cat_title', $_POST['cat_title'])){
                $error['cat_title'] = "(*) Tiêu đề danh mục đã tồn tại !"; 
            } else { 
                $cat_title = $_POST['cat_title'];
            }
        }
        #Kiểm tra link thân thiện
        if (empty($_POST['cat_slug'])) {
            $error['cat_slug'] = "(*) Bạn chưa nhập đường link thân thiện !";
        } else {
            if(is_exists('tbl_products_cat','cat_slug', $_POST['cat_slug'])){
                $error['cat_slug'] = "(*) Link thân thiện đã tồn tại !";
            } else {
                $cat_slug = create_slug($_POST['cat_slug']);
            }
        }
        #Kiểm tra danh mục 
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        } else {
            $parent_id = $_POST['parent_id'];
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Kiểm tra nếu admin 1 login thì sản phẩm được duyệt còn lại admin 2,... thì chưa đk duyệt
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $cat_status = 'Approved';
            } else {
                $cat_status = 'Waiting...';
            }
            #Người tạo được gán với giá trị của hàm lấy thông tin admin quản trị cấp 1 do hệ thống khi login lưu trữ
            $creator = get_admin_info($_SESSION['user_login']);
            #Và chấp nhận lưu trữ các thông tin member mới vào CSDL
            $data = array(
                'cat_title' => $cat_title,
                'cat_slug' => $cat_slug,
                'cat_status' => $cat_status,
                'creator' => $creator,
                'create_date' => date('d/m/y h:m'),
                'parent_id' => $parent_id,
                // 'active' => 'không hoạt động',
            );
            #Thêm thành viên mới với các dữ liệu trên
            $add_cat = add_cat($data);
            $error['cat'] = "Thêm danh mục sản phẩm thành công !" . "<br>" . "<a href='?mod=products&controller=productCat&action=index'>Trở về danh sách các danh mục</a>";
            // echo $add_cat;
            // show_array($data);
            // show_array($error);
        }
    }
    load_view('addCat');
}

#Hàm cập nhập danh mục 
function updateCatAction() 
{
    global $error, $cat_id, $cat_title, $old_cat_title, $cat_slug, $old_cat_slug, $parent_id, $old_parent_id, $editor, $cat_status, $data;
    #kiểm tra đã lấy được id theo danh mục chưa?
    $cat_id = $_GET['cat_id'];
    //show_array($_GET);
    if (isset($_POST['btn-update-cat'])) {
        #Mảng chữa lỗi ?
        $error = array();
        #Kiểm tra tiêu đề của danh mục có giá trị chưa nếu chưa báo điền ?
        if (empty($_POST['cat_title'])) {
            $error['cat_title'] = "(*) Bạn chưa điền tiêu đề danh mục !";
        } else {
            #Lấy tiêu đề danh mục cũ theo id hiển thị 
            $old_cat_title = get_inf_cat('cat_title', $cat_id);
            #Nếu tiêu đề cũ giống với tiêu đề mới thì lưu vào $data hiển thị 
            if ($_POST['cat_title'] == $old_cat_title) {
                $data = array (
                    'cat_title' => '',
                );
                #Cập nhập dữ liệu $data vào csdl
                update_cat($data, $cat_id);
            } 
            #Kt có tồn tại csdl và tiêu đề danh mục trên csdl có trùng với tiêu đề điền hay ko nếu trùng báo lỗi ? 
            if(is_exists('tbl_products_cat', 'cat_title', $_POST['cat_title'])) {
                $error['cat_title'] = '(*) Tên danh mục đã tồn tại !';
            #Ngược lại nếu ko trùng thì gửi dl lên để cập nhập vào csdl 
            } else {
                $cat_title = $_POST['cat_title'];
            }
        }
        #Kiểm tra link thân thiện 
        if (empty($_POST['cat_slug'])) {
            $error['cat_slug'] = "(*) Bạn chưa điền link thân thiện !";
        } else {
            $old_cat_slug = get_inf_cat('cat_slug', $cat_id);
            if ($_POST['cat_slug'] == $old_cat_slug){
                $data = array(
                    'cat_slug' => '',
                );
                update_cat($data, $cat_id);
            } 
            if(is_exists('tbl_products_cat', 'cat_slug', $_POST['cat_slug'])) {
                $error['cat_slug'] = '(*) Link này đã tồn tại';
            } else {
                $cat_slug = create_slug($_POST['cat_slug']);
            }
        }
        #Kiểm tra danh mục
        if (empty($_POST['parent_id'])) {
            $parent_id = 0;
        } else {
            $old_parent_id = get_inf_cat('parent_id', $cat_id);
            $parent_id = $_POST['parent_id'];
        }
        #Kiểm tra có thay đổi ko nếu giống nhau thì cập nhập vào csdl, báo lỗi ko thay đổi
        if(($_POST['cat_title'] == $old_cat_title) && ($_POST['cat_slug'] == $old_cat_slug) && ($_POST['parent_id'] == $old_parent_id)) {
            $data = array(
                'cat_title' => $old_cat_title,
                'cat_slug' => $old_cat_slug
            );
            update_cat($data, $cat_id);
            $error['cat'] = "(*) Danh mục chưa có thay đổi gì !";
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            if(is_login() && check_role($_SESSION['user_login']) == 1){
                $cat_status = 'Approved';
            } else{
                $cat_status = 'Waiting...';
            }
            #Biên tập viên được gán bằng hàm lấy thông tin của các admin chủ cấp 1
            $editor = get_admin_info($_SESSION['user_login']);
            #Và chấp nhận lưu trữ các thông tin member mới vào CSDL
            $data = array(
                'cat_title'=> $cat_title,
                'cat_slug'=> $cat_slug,
                'editor'=> $editor,
                'edit_date'=> date('d/m/y h:m'),
                'parent_id' => $parent_id
            );
            #Cập nhập cho danh mục đã vào hệ thống
            update_cat($data, $cat_id);
            // show_array($data);
            $error['cat'] = "Cập nhật danh mục thành công !" . "<br>" . "<a href='?mod=products&controller=productCat&action=index'>Trở về danh sách danh mục</a>";
        }
    }
    load_view('updateCat');
}

#Hàm xóa danh mục
function deleteCatAction()
{
    #Lấy danh mục theo id xuống
    $cat_id = (int) $_GET['cat_id'];
    #Xóa dữ liệu và chuyển hướng
    delete_cat($cat_id);
    redirect('?mod=products&controller=productCat&action=index');
    load_view('listCat');
}

#Hàm tìm kiếm danh mục
function searchProductCatAction()
{
    global $error, $value, $list_products_cat_all;
    if (isset($_GET['sm_s'])) {
        // show_array($_GET);
        if (!empty($_GET['value'])) {
            $value = $_GET['value'];
            // echo $value;
            #Tổng số lượng bảng ghi trên 1 danh mục
            // $num_per_post = 3;
            #Tổng sô bảng ghi lấy được
            $list_products_cat_all = db_search_all_products_cat($value);
            $total_row = count($list_products_cat_all);
            #Tổng số danh mục = hàm làm tròn (15/5) = 3
            // $num_post = ceil($total_row / $num_per_post);
            load_view('searchProduct_cat');
        } else {
            $error['error'] = '(*) Bạn cần nhập thông tin danh mục cần tìm kiếm !';
            load_view('listCat');
        }
    }
}

#Hàm trả về kết quả tìm kiếm danh mục
function resultSearchAction()
{
    global $value;
    if(!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('searchProduct_cat');
}   

#Hàm tác vụ của danh mục
function applyProductCatAction()
{
    if (isset($_POST['sm_action'])) {
        global $error, $data;
        #Kiểm tra đã login chưa và kiểm tra xem role có = 1 không nếu = 1 thì cho thực thi những dk dưới
        if (is_login() && check_role($_SESSION['user_login']) == 1) {
            $error = array();
            #Nếu tồn tại giá trị phần tử thì gán bằng biến danh sách post theo id
            if (!empty($_POST['checkItem'])) {
                $list_product_cat_id = $_POST['checkItem'];
            }
            #Nếu tồn tại giá trị action thì 
            if (!empty($_POST['actions'])) {
                #kiểm tra xem actions có actions phê duyệt hay không ? 
                if ($_POST['actions'] == 1) {
                    #Kiểm tra checkItem tồn tại thì cấp nhập giá trị cho $data
                    if (isset($_POST['checkItem'])) {
                        #Nếu có thì cập nhập cho $data trạng thái Approved
                        $data = array(
                            'cat_status' => 'Approved',
                        );
                        #Duyệt các phần tử id post và cập nhập vào hệ thống csdl
                        foreach ($list_product_cat_id as $cat_id) {
                            update_cat($data, $cat_id);
                        // show_array($list_post_cat_id);
                        }
                        #Nếu tồn tại giá trị thì lấy xuống và load tìm kiếm
                        if (isset($_GET['value'])) {
                            load_view('searchProduct_cat');
                        #Ngược lại thì tiếp tục kiểm tra lấy giá trị xuống và load danh mục 
                        } else {
                            load_view('listCat');
                        }
                    #Và nếu không tồn tại thì báo lối
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn danh mục cần áp dụng";
                        #Và tiếp tục kiểm tra có giá trị hay không nếu có load view và ngược lại
                        if (isset($_GET['value'])) {
                            load_view('searchProduct_cat');
                        } else {
                            load_view('listCat');
                        }
                    }
                }
                #kiểm tra xem actions có actions chờ phê duyệt hay không ? 
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'cat_status' => 'Waiting...',
                        );
                        foreach ($list_product_cat_id as $cat_id) {
                            update_cat($data, $cat_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchPost_cat');
                        } else {
                            load_view('listCat');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn danh mục cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('searchProduct_cat');
                        } else {
                            load_view('listCat');
                        }
                    }
                }
                #kiểm tra xem actions có actions bỏ vào thùng rác hay không ? 
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'cat_status' => 'Trash',
                        );
                        foreach ($list_product_cat_id as $cat_id) {
                            update_cat($data, $cat_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchProduct_cat');
                        } else {
                            load_view('listCat');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn danh mục cần xóa";
                        if (isset($_GET['value'])) {
                            load_view('searchProduct_cat');
                        } else {
                            load_view('listCat');
                        }
                    }
                }
            } else {
                $error['select'] = '(*) Bạn chưa lựa chọn tác vụ !';
                if (isset($_GET['value'])) {
                    load_view('searchProduct_cat');
                } else {
                    load_view('listCat');
                }
            }
        #Ngược lại nếu chưa login và ko có role = 1 thì báo lỗi tiếp tục kt và get xuống
        } else {
            $error['select'] = "(*) Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('searchProduct_cat');
            } else {
                load_view('listCat');
            }
        }
    }
}

