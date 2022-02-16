<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('helper', 'slug');
    load('helper', 'image');
    load('helper', 'format');
    load('lib', 'data_tree');
    load('lib', 'pagging');
    load('lib', 'status');
    load('lib', 'search');
}

#Hàm load index
function indexAction()
{
    load_view('indexProduct');
}

#Hàm Thêm sản phẩm mới
function addProductAction()
{
    global $error, $product_title, $product_code, $product_slug, $product_price_new, $product_price_old, $product_num, $product_content, $product_desc, $product_thumb, $product_brand, $product_type, $add_product, $data;
    #Kiểm tra đã submit chưa ?
    if (isset($_POST['btn-add-product'])) {
        #Mảng báo lỗi
        $error = array();
        #Kiểm tra tiêu đề sản phẩm
        if (empty($_POST['product_title'])) {
            $error['product_title'] = "(*) Bạn chưa nhập tên sản phẩm !";
        } else { 
            $product_title = $_POST['product_title'];
        }
        #Kiểm tra mã sản phẩm
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "(*) Bạn chưa nhập mã sản phẩm !";
        } else { 
            $product_code = $_POST['product_code'];
        }
        #Kiểm tra link thân thiện
        if (empty($_POST['product_slug'])) {
            $error['product_slug'] = "(*) Bạn chưa nhập đường link thân thiện !";
        } else {
            $product_slug = create_slug($_POST['product_slug']);
        }
        #Kiểm tra giá sản phẩm
        if (empty($_POST['product_price_new'])) {
            $error['product_price_new'] = "(*) Bạn chưa nhập giá sản phẩm !";
        } else { 
            if(is_number($_POST['product_price_new'])){
                $product_price_new = $_POST['product_price_new'];
            } else {
                $error['product_price_new'] = "(*) Bạn cần nhập mã sản phẩm đúng định dạng !";
            }
        }
        #Kiểm tra giá cũ 
        if (empty($_POST['product_price_old'])) {
            $error['product_price_old'] = "(*) Bạn chưa giá cũ !";
        } else { 
            if(is_number($_POST['product_price_old'])){
                $product_price_old = $_POST['product_price_old'];
            } else {
                $error['product_price_old'] = "(*) Bạn cần nhập giá cũ đúng định dạng !";
            }
        }
        #Kiểm tra số lượng
        if (empty($_POST['product_num'])) {
            $error['product_num'] = "(*) Bạn chưa nhập số lượng !";
        } else { 
            if(is_number($_POST['product_num'])){
                $product_num = $_POST['product_num'];
            } else {
                $error['product_num'] = "(*) Bạn cần nhập số lượng đúng định dạng !";
            }
        }
        #Kiểm tra mô tả sản phẩm
        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "(*) Bạn chưa nhập mô tả sản phẩm !";
        } else {
            $product_desc = $_POST['product_desc'];
        }
        #Kiểm tra chi tiết
        if (empty($_POST['product_content'])) {
            $error['product_content'] = "(*) Bạn chưa nhập chi tiết sản phẩm !";
        } else {
            $product_content = $_POST['product_content'];
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
                    $product_thumb = upload_image('public/images/upload/products/', $type);
                }
                #Ngược lại nếu thất bại thì báo lỗi ảnh
            } else {
                $error['upload_image'] = "(*) Bạn chưa chọn tệp ảnh !";
            }
        }
        #Kiểm tra danh mục sản phẩm
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "(*) Bạn chưa chọn danh mục sản phẩm !";
        } else {
            $parent_cat = $_POST['parent_cat'];
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Kiểm tra nếu admin 1 login thì sản phẩm được duyệt còn lại admin 2,... thì chưa đk duyệt
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $product_status = 'Approved';
            } else {
                $product_status = 'Waiting...';
            }
            $product_thumb = upload_image('public/images/upload/products/', $type);
            #Người tạo được gán với giá trị của hàm lấy thông tin admin quản trị cấp 1 do hệ thống khi login lưu trữ
            $creator = get_admin_info($_SESSION['user_login']);
            #Và chấp nhận lưu trữ các thông tin member mới vào CSDL
            $data = array(
                'product_title' => $product_title,
                'product_code' => $product_code,
                'product_slug' => $product_slug,
                'product_price_new' => $product_price_new,
                'product_price_old' => $product_price_old,
                'product_num' => $product_num,
                'product_desc' => $product_desc,
                'product_content' => $product_content,
                'product_thumb' => $product_thumb,
                'product_status' => $product_status,
                'parent_cat' => $parent_cat,
                // 'product_brand' => $product_brand,
                // 'product_type' => $product_type,
                'creator' => $creator,
                'create_date' => date('d/m/y h:m'),
            );
            #Thêm sản phẩm mới với các dữ liệu trên
            $add_product = add_product($data);
            $error['product'] = "Thêm sản phẩm mới thành công !" . "<br>" . "<a href='?mod=products&controller=index&action=index'>Trở về danh sách sản phẩm</a>";
            // echo $add_product;
            // show_array($data);
            // show_array($error);
        }
    }
    load_view('addProduct');
}

#Hàm cập nhập sản phẩm 
function updateProductAction() 
{
    global $error, $product_id, $product_title, $product_code, $old_product_code, $old_title, $product_slug, $old_slug, $product_price_new, $old_price_new, $product_price_old, $old_price_old, $product_num, $old_product_num, $product_content, $old_product_content, $product_desc, $old_product_desc, $product_brand , $old_product_brand, $product_type, $old_product_type, $product_thumb, $old_thumb, $parent_cat, $old_parent_cat, $data;
    #kiểm tra đã lấy được id theo sản phẩm chưa?
    $product_id = $_GET['product_id'];
    // show_array($_GET);
    if (isset($_POST['btn-update-product'])) {
        #Mảng chữa lỗi ?
        $error = array();
        #Kiểm tra tiêu đề của sản phẩm có giá trị chưa nếu chưa báo điền ?
        if (empty($_POST['product_title'])) {
            $error['product_title'] = "(*) Bạn chưa điền tên sản phẩm !";
        } else {
            #Lấy tiêu đề sản phẩm cũ theo id hiển thị 
            $old_title = get_inf_product('product_title', $product_id);
            #Nếu tiêu đề cũ giống với tiêu đề mới thì lưu vào $data hiển thị 
            if ($_POST['product_title'] == $old_title) {
                $data = array (
                    'product_title' => '',
                );
                #Cập nhập dữ liệu $data vào csdl
                update_product($data, $product_id);
            } 
            #Kt có tồn tại csdl và tiêu đề sản phẩm trên csdl có trùng với tiêu đề điền hay ko nếu trùng báo lỗi ? 
            if(is_exists('tbl_products', 'product_title', $_POST['product_title'])) {
                $error['product_title'] = '(*) Tên sản phẩm đã tồn tại !';
            #Ngược lại nếu ko trùng thì gửi dl lên để cập nhập vào csdl 
            } else {
                $product_title = $_POST['product_title'];
            }
        }
        #Kiểm tra mã sản phẩm
        if (empty($_POST['product_code'])) {
            $error['product_code'] = "(*) Bạn chưa nhập mã sản phẩm !";
        } else {
            $old_product_code = get_inf_product('product_code', $product_id);
            if ($_POST['product_code'] == $old_product_code){
                $data = array(
                    'product_code' => '',
                );
                update_product($data, $product_id);
            } 
            if(is_exists('tbl_products', 'product_code', $_POST['product_code'])) {
                $error['product_code'] = '(*) Mã sản phẩm này đã tồn tại';
            } else {
                $product_code = $_POST['product_code'];
            }
        }
        #Kiểm tra link thân thiện 
        if (empty($_POST['product_slug'])) {
            $error['product_slug'] = "(*) Bạn chưa điền link thân thiện !";
        } else {
            $old_slug = get_inf_product('product_slug', $product_id);
            if ($_POST['product_slug'] == $old_slug){
                $data = array(
                    'product_slug' => '',
                );
                update_product($data, $product_id);
            } 
            if(is_exists('tbl_products', 'product_slug', $_POST['product_slug'])) {
                $error['product_slug'] = '(*) Link này đã tồn tại';
            } else {
                $product_slug = create_slug($_POST['product_slug']);
            }
        }
        #Kiểm tra giá mới sản phẩm
        if (empty($_POST['product_price_new'])) {
            $error['product_price_new'] = "(*) Bạn chưa nhập giá sản phẩm (mới) !";
        } else {
            $old_price_new = get_inf_product('product_price_new', $product_id);
            if(is_number($_POST['product_price_new'])){
                $product_price_new = $_POST['product_price_new'];
            } else {
                $error['product_price_new'] = "(*) Bạn cần nhập giá sản phẩm đúng định dạng !";
            }
        }
        #Kiểm tra giá mới sản phẩm cũ
        if (!empty($_POST['product_price_old'])) {
            $old_price_old = get_inf_product('product_price_old', $product_id);
            if(is_number($_POST['product_price_old'])){
                $product_price_old = $_POST['product_price_old'];
            } else {
                $error['product_price_old'] = "(*) Bạn cần nhập giá cũ sản phẩm đúng định dạng !";
            }
        }
        #Kiểm tra số lượng sản phẩm
        if (empty($_POST['product_num'])) {
            $error['product_num'] = "(*) Bạn chưa điền số lượng sản phẩm !";
        } else {
            $old_product_num = get_inf_product('product_num', $product_id);
            if(is_number($_POST['product_num'])){
                $product_num = $_POST['product_num'];
            } else {
                $error['product_num'] = "(*) Bạn cần nhập số lượng sản phẩm đúng định dạng !";
            }
        }
        #Kiểm tra nội dung sản phẩm
        if (empty($_POST['product_content'])) {
            $error['product_content'] = "(*) Bạn chưa điền nội dung sản phẩm !";
        } else {
            $old_product_content = get_inf_product('product_content', $product_id);
            $product_content = $_POST['product_content'];
        }
        #Kiểm tra mô tả sản phẩm
        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "(*) Bạn chưa điền mô tả sản phẩm !";
        } else {
            $old_product_desc = get_inf_product('product_desc', $product_id);
            $product_desc = $_POST['product_desc'];
        }
        #Kiểm tra danh mục sản phẩm
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "(*) Bạn chưa chọn danh mục sản phẩm !";
        } else {
            $old_parent_cat = get_inf_product('parent_cat', $product_id);
            $parent_cat = $_POST['parent_cat'];
        }
        #Kiểm tra file tải lên
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "(*) Kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = get_inf_product('product_thumb', $product_id);
                if(!empty($old_thumb)){
                    delete_image($old_thumb);
                    $product_thumb = upload_image('public/images/upload/products/', $type); 
                } else {
                    $product_thumb = upload_image('public/images/upload/products/', $type);
                }
            }
        } else {
            $product_thumb = get_inf_product('product_thumb', $product_id);
        }
        #Kiểm tra có thay đổi ko nếu giống nhau thì cập nhập vào csdl, báo lỗi ko thay đổi
        if(($_POST['product_title'] == $old_title) && ($_POST['product_slug'] == $old_slug)  && ($_POST['product_price_new'] == $old_price_new) && ($_POST['product_price_old'] == $old_price_old) && ($_POST['product_content'] == $old_product_content) && ($_POST['product_desc'] == $old_product_desc) && ($_POST['parent_cat'] == $old_parent_cat) && !(isset($_FILES['file']) && !empty($_FILES['file']['name']))) {
            $data = array(
                'product_title' => $old_title,
                'product_code' => $old_product_code,
                'product_slug' => $old_slug,
            );
            update_product($data, $product_id);
            $error['product'] = "(*) Sản phẩm chưa có thay đổi gì !";
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Kiểm tra nếu admin 1 login thì sản phẩm được duyệt còn lại admin 2,... thì chưa đk duyệt
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $product_status = 'Approved';
            } else {
                $product_status = 'Waiting...';
            }
            #Người tạo được gán với giá trị của hàm lấy thông tin admin quản trị cấp 1 do hệ thống khi login lưu trữ
            $editor = get_admin_info($_SESSION['user_login']);
            #Và chấp nhận lưu trữ các thông tin post mới vào CSDL
            $data = array(
                'product_title'=> $product_title,
                'product_slug'=> $product_slug,
                'product_code'=> $product_code,
                'product_price_new'=> $product_price_new,
                'product_price_old'=> $product_price_old,
                'product_num'=> $product_num,
                'product_content' => $product_content,
                'product_desc'=> $product_desc,
                'product_brand'=> $product_brand,
                'product_type' => $product_type,
                'product_thumb' => $product_thumb,
                'product_status' => $product_status,
                'editor' => $editor,
                'edit_date' => date('d/m/y h:m'),
                'parent_cat'=> $parent_cat,
            );
            #Cập nhập cho sản phẩm đã vào hệ thống
            update_product($data, $product_id);
            // show_array($data);
            $error['product'] = "Cập nhật sản phẩm thành công !" . "<br>" . "<a href='?mod=products&controller=index&action=index'>Trở về danh sách sản phẩm</a>";
        }
    }
    load_view('updateProduct');
}

#Hàm xóa sản phẩm
function deleteProductAction()
{
    #Lấy sản phẩm theo id xuống
    $product_id = (int) $_GET['product_id'];
    #Xóa dữ liệu và chuyển hướng
    delete_product($product_id);
    redirect('?mod=products&controller=index&action=index');
    load_view('indexProduct');
}

#Hàm tìm kiếm sản phẩm
function searchProductAction()
{
    global $error, $value;
    if (isset($_GET['sm_s'])) {
        // show_array($_GET);
        if (!empty($_GET['value'])) {
            $value = $_GET['value'];
            // echo $value;
            #Tổng số lượng bảng ghi trên 1 sản phẩm
            // $num_per_product = 3;
            #Tổng sô bảng ghi lấy được
            // $list_products_all = db_search_all_products($value);
            // $total_row = count($list_products_all);
            #Tổng số sản phẩm = hàm làm tròn (15/5) = 3
            // $num_product = ceil($total_row / $num_per_post);
            load_view('searchProduct');
        } else {
            $error['error'] = '(*) Bạn cần nhập thông tin sản phẩm cần tìm kiếm !';
            load_view('indexProduct');
        }
    }
}

#Hàm trả về kết quả tìm kiếm sản phẩm
function resultSearchAction()
{
    global $value;
    if(!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('searchProduct');
}   

#Hàm tác vụ của sản phẩm
function applyProductAction()
{
    if (isset($_POST['sm_action'])) {
        global $error, $data;
        #Kiểm tra đã login chưa và kiểm tra xem role có = 1 không nếu = 1 thì cho thực thi những dk dưới
        if (is_login() && check_role($_SESSION['user_login']) == 1) {
            $error = array();
            #Nếu tồn tại giá trị phần tử thì gán bằng biến danh sách post theo id
            if (!empty($_POST['checkItem'])) {
                $list_product_id = $_POST['checkItem'];
            }
            #Nếu tồn tại giá trị action thì 
            if (!empty($_POST['actions'])) {
                #kiểm tra xem actions có actions phê duyệt hay không ? 
                if ($_POST['actions'] == 1) {
                    #Kiểm tra checkItem tồn tại thì cấp nhập giá trị cho $data
                    if (isset($_POST['checkItem'])) {
                        #Nếu có thì cập nhập cho $data trạng thái Approved
                        $data = array(
                            'product_status' => 'Approved',
                        );
                        #Duyệt các phần tử id post và cập nhập vào hệ thống csdl
                        foreach ($list_product_id as $product_id) {
                            update_product($data, $product_id);
                        // show_array($list_product_id);
                        }
                        #Neus tồn tại giá trị thì lấy xuống và load tìm kiếm
                        if (isset($_GET['value'])) {
                            load_view('searchProduct');
                        #Ngược lại thì tiếp tục kiểm tra lấy giá trị xuống và load sản phẩm 
                        } else {
                            load_view('indexProduct');
                        }
                    #Và nếu không tồn tại thì báo lối
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn sản phẩm cần áp dụng";
                        #Và tiếp tục kiểm tra có giá trị hay không nếu có load view và ngược lại
                        if (isset($_GET['value'])) {
                            load_view('searchProduct');
                        } else {
                            load_view('indexProduct');
                        }
                    }
                }
                #kiểm tra xem actions có actions chờ phê duyệt hay không ? 
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'product_status' => 'Waiting...',
                        );
                        foreach ($list_product_id as $product_id) {
                            update_product($data, $product_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchProduct');
                        } else {
                            load_view('indexProduct');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn sản phẩm cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('searchProduct');
                        } else {
                            load_view('indexProduct');
                        }
                    }
                }
                #kiểm tra xem actions có actions bỏ vào thùng rác hay không ? 
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'product_status' => 'Trash',
                        );
                        foreach ($list_product_id as $product_id) {
                            update_product($data, $product_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchProduct');
                        } else {
                            load_view('indexProduct');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn sản phẩm cần xóa";
                        if (isset($_GET['value'])) {
                            load_view('searchProduct');
                        } else {
                            load_view('indexProduct');
                        }
                    }
                }
            } else {
                $error['select'] = '(*) Bạn chưa lựa chọn tác vụ !';
                if (isset($_GET['value'])) {
                    load_view('searchProduct');
                } else {
                    load_view('indexProduct');
                }
            }
        #Ngược lại nếu chưa login và ko có role = 1 thì báo lỗi tiếp tục kt và get xuống
        } else {
            $error['select'] = "(*) Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('searchProduct');
            } else {
                load_view('indexProduct');
            }
        }
    }
}




