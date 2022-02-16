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
    load_view('indexPage');
}

#Hàm Thêm trang mới
function addPageAction()
{
    global $error, $page_title, $page_slug, $page_content, $page_desc, $page_thumb, $category, $add_pages, $data;
    #Kiểm tra đã submit chưa ?
    if (isset($_POST['btn-add-page'])) {
        #Mảng báo lỗi
        $error = array();
        #Kiểm tra tiêu đề trang 
        if (empty($_POST['page_title'])) {
            $error['page_title'] = "(*) Bạn chưa nhập tiêu đề !";
        } else {
            $page_title = $_POST['page_title'];
        }
        #Kiểm tra link thân thiện
        if (empty($_POST['page_slug'])) {
            $error['page_slug'] = "(*) Bạn chưa nhập đường link thân thiện !";
        } else {
            $page_slug = create_slug($_POST['page_slug']);
        }
        #Kiểm tra mô tả trang
        if (empty($_POST['page_content'])) {
            $error['page_content'] = "(*) Bạn chưa nhập nội dung trang !";
        } else {
            $page_content = $_POST['page_content'];
        }
        #Kiểm tra mô tả trang
        if (empty($_POST['page_desc'])) {
            $error['page_desc'] = "(*) Bạn chưa nhập mô tả trang !";
        } else {
            $page_desc = $_POST['page_desc'];
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
                    $page_thumb = upload_image('public/images/upload/pages/', $type);
                }
                #Ngược lại nếu thất bại thì báo lỗi ảnh
            } else {
                $error['upload_image'] = "(*) Bạn chưa chọn tệp ảnh";
            }
        }
        #Kiểm tra danh mục trang
        if (empty($_POST['category'])) {
            $error['category'] = "(*) Bạn chưa chọn danh mục trang !";
        } else {
            $category = $_POST['category'];
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Kiểm tra nếu admin 1 login thì sản phẩm được duyệt còn lại admin 2,... thì chưa đk duyệt(chờ duyệt)
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $page_status = 'Approved';
            } else {
                $page_status = 'Waiting...';
            }
            $page_thumb = upload_image('public/images/upload/pages/', $type);
            #Người tạo bằng tên người lưu trữ trên hệ thống qua session
            $creator = $_SESSION['user_login'];
            // $creator = get_admin_info($_SESSION['user_login']);
            #Và chấp nhận lưu trữ các thông tin trang mới vào CSDL
            $data = array(
                'page_title' => $page_title,
                'page_slug' => $page_slug,
                'page_content' => $page_content,
                'page_desc' => $page_desc,
                'page_thumb' => $page_thumb,
                'category' => $category,
                'page_status' => $page_status,
                'creator' => $creator,
                'create_date' => date("d/m/Y"),
            );
            #Thêm trang mới với các dữ liệu trên
            $add_pages = add_page($data);
            $error['page'] = "Thêm trang mới thành công !" . "<br>" . "<a href='?mod=pages&controller=index&action=index'>Trở về danh sách trang</a>";
            // echo $add_pages;
            // show_array($data);
            // show_array($error);
        }
    }
    load_view('addPage');
}

#Hàm cập nhập trang 
function updatePageAction() 
{
    global $error, $page_title, $old_title, $page_slug, $old_slug, $page_desc, $old_desc, $page_thumb, $old_thumb, $page_content, $old_content, $category, $old_category, $data;
    #kiểm tra đã lấy được id theo trang chưa?
    $page_id = $_GET['page_id'];
    // show_array($_GET);
    if (isset($_POST['btn-update-page'])) {
        #Mảng chữa lỗi ?
        $error = array();
        #Kiểm tra tiêu đề của trang có giá trị chưa nếu chưa báo điền ?
        if (empty($_POST['page_title'])) {
            $error['page_title'] = "(*) Bạn chưa điền tiêu đề trang !";
        } else {
            #Lấy tiêu đề trang cũ theo id hiển thị 
            $old_title = get_inf_page('page_title', $page_id);
            #Nếu tiêu đề cũ giống với tiêu đề mới thì lưu vào $data hiển thị 
            if ($_POST['page_title'] == $old_title) {
                $data = array (
                    'page_title' => '',
                );
                #Cập nhập dữ liệu $data vào csdl
                update_page($data, $page_id);
            } 
            #Kt có tồn tại csdl và tiêu đề trang trên csdl có trùng với tiêu đề điền hay ko nếu trùng báo lỗi ? 
            if(is_exists('tbl_pages', 'page_title', $_POST['page_title'])) {
                $error['page_title'] = '(*) Tên trang đã tồn tại !';
            #Ngược lại nếu ko trùng thì gửi dl lên để cập nhập vào csdl 
            } else {
                $page_title = $_POST['page_title'];
            }
        }
        #Kiểm tra link thân thiện 
        if (empty($_POST['page_slug'])) {
            $error['page_slug'] = "(*) Bạn chưa điền link thân thiện !";
        } else {
            $old_slug = get_inf_page('page_slug', $page_id);
            if ($_POST['page_slug'] == $old_slug){
                $data = array(
                    'page_slug' => '',
                );
                update_page($data, $page_id);
            } 
            if(is_exists('tbl_pages', 'page_slug', $_POST['page_slug'])) {
                $error['page_slug'] = '(*) Link này đã tồn tại';
            } else {
                $page_slug = $_POST['page_slug'];
            }
        }
        #Kiểm tra nội dung trang
         if (empty($_POST['page_content'])) {
            $error['page_content'] = "(*) Bạn chưa điền nội dung trang !";
        } else {
            $old_content = get_inf_page('page_content', $page_id);
            $page_content = $_POST['page_content'];
        }
        #Kiểm tra mô tả trang
        if (empty($_POST['page_desc'])) {
            $error['page_desc'] = "(*) Bạn chưa điền mô tả trang !";
        } else {
            $old_desc = get_inf_page('page_desc', $page_id);
            $page_desc = $_POST['page_desc'];
        }
        #Kiểm tra file tải lên
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "(*) Kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = get_inf_page('page_thumb', $page_id);
                if(!empty($old_thumb)){
                    delete_image($old_thumb);
                    $page_thumb = upload_image('public/images/upload/pages/', $type); 
                } else {
                    $page_thumb = upload_image('public/images/upload/pages/', $type);
                }
            }
        } else {
            $page_thumb = get_inf_page('page_thumb', $page_id);
        }
        #Kiểm tra danh mục trang
        if (empty($_POST['category'])) {
            $error['category'] = "(*) Bạn chưa chọn danh mục trang !";
        } else {
            $old_category = get_inf_page('category', $page_id);
            $category = $_POST['category'];
        }
        #Kiểm tra có thay đổi ko nếu giống nhau thì cập nhập vào csdl, báo lỗi ko thay đổi
        if(($page_title == $old_title) && ($page_slug == $old_slug) && ($page_content == $old_content) && ($page_desc == $old_desc) && !(isset($_FILES['file']) && !empty($_FILES['file']['name'])) && ($category == $old_category)) {
            $data = array(
                'page_title' => $old_title,
                'page_slug' => $old_slug
            );
            update_page($data, $page_id);
            $error['page'] = "(*) Trang chưa có thay đổi gì !";
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Và chấp nhận lưu trữ các thông tin member mới vào CSDL
            $data = array(
                'page_title'=> $page_title,
                'page_slug'=> $page_slug,
                'page_content'=> $page_content,
                'page_desc'=> $page_desc,
                'page_thumb' => $page_thumb,
                'category'=> $category,
            );
            #Cập nhập cho admin đã  vào hệ thống
            update_page($data, $page_id);
            // show_array($data);
            $error['page'] = "Cập nhật trang thành công !" . "<br>" . "<a href='?mod=pages&controller=index&action=index'>Trở về danh sách trang</a>";
        }
    }
    load_view('updatePage');
}

#Hàm xóa trang
function deletePageAction()
{
    #Lấy trang theo id xuống
    $page_id = (int) $_GET['page_id'];
    #Xóa dữ liệu và chuyển hướng
    delete_page($page_id);
    redirect('?mod=pages&controller=index&action=index');
    load_view('indexPage');
}

#Hàm tìm kiếm trang
function searchPageAction()
{
    global $error, $value, $list_pages_all;
    if (isset($_GET['sm_s'])) {
        // show_array($_GET);
        if (!empty($_GET['value'])) {
            $value = $_GET['value'];
            // echo $value;
            #Tổng số lượng bảng ghi trên 1 trang
            // $num_per_page = 3;
            #Tổng sô bảng ghi lấy được
            $list_pages_all = db_search_all_pages($value);
            #Tổng số trang = hàm làm tròn (15/5) = 3
            // $total_row = count($list_pages_all);
            // $num_page = ceil($total_row / $num_per_page);
            load_view('searchPage');
        } else {
            $error['error'] = '(*) Bạn cần nhập thông tin Trang cần tìm kiếm !';
            load_view('indexPage');
        }
    }
}

#Hàm trả về kết quả tìm kiếm trang
function resultSearchAction()
{
    global $value;
    #Kiểm tra có giá trị thì get xuống 
    if(!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('searchPage');
}   

#Hàm tác vụ của trang
function applyPageAction()
{
    if (isset($_POST['sm_action'])) {
        global $error, $data;
        #Kiểm tra đã login chưa và kiểm tra xem role có = 1 không nếu = 1 thì cho thực thi những dk dưới
        if (is_login() && check_role($_SESSION['user_login']) == 1) {
            $error = array();
            #Nếu tồn tại giá trị phần tử thì gán bằng biến danh sách page theo id
            if (!empty($_POST['checkItem'])) {
                $list_page_id = $_POST['checkItem'];
            }
            #Nếu tồn tại giá trị action thì 
            if (!empty($_POST['actions'])) {
                #kiểm tra xem actions có actions phê duyệt hay không ? 
                if ($_POST['actions'] == 1) {
                    #Kiểm tra checkItem tồn tại thì cấp nhập giá trị cho $data
                    if (isset($_POST['checkItem'])) {
                        #Nếu có thì cập nhập cho $data trạng thái Approved
                        $data = array(
                            'page_status' => 'Approved',
                        );
                        #Duyệt các phần tử id page và cập nhập vào hệ thống csdl
                        foreach ($list_page_id as $page_id) {
                            update_page($data, $page_id);
                        // show_array($list_page_id);
                        }
                        #Neus tồn tại giá trị thì lấy xuống và load tìm kiếm
                        if (isset($_GET['value'])) {
                            load_view('searchPage');
                        #Ngược lại thì tiếp tục kiểm tra lấy giá trị xuống và load trang 
                        } else {
                            load_view('indexPage');
                        }
                    #Và nếu không tồn tại thì báo lối
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn trang cần áp dụng";
                        #Và tiếp tục kiểm tra có giá trị hay không nếu có load view và ngược lại
                        if (isset($_GET['value'])) {
                            load_view('searchPage');
                        } else {
                            load_view('indexPage');
                        }
                    }
                }
                #kiểm tra xem actions có actions chờ phê duyệt hay không ? 
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'page_status' => 'Waiting...',
                        );
                        foreach ($list_page_id as $page_id) {
                            update_page($data, $page_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchPage');
                        } else {
                            load_view('indexPage');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn trang cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('searchPage');
                        } else {
                            load_view('indexPage');
                        }
                    }
                }
                #kiểm tra xem actions có actions bỏ vào thùng rác hay không ? 
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'page_status' => 'Trash',
                        );
                        foreach ($list_page_id as $page_id) {
                            update_page($data, $page_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchPage');
                        } else {
                            load_view('indexPage');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn trang cần xóa";
                        if (isset($_GET['value'])) {
                            load_view('searchPage');
                        } else {
                            load_view('indexPage');
                        }
                    }
                }
            } else {
                $error['select'] = '(*) Bạn chưa lựa chọn tác vụ !';
                if (isset($_GET['value'])) {
                    load_view('searchPage');
                } else {
                    load_view('indexPage');
                }
            }
        #Ngược lại nếu chưa login và ko có role = 1 thì báo lỗi tiếp tục kt và get xuống
        } else {
            $error['select'] = "(*) Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('searchPage');
            } else {
                load_view('indexPage');
            }
        }
    }
}
