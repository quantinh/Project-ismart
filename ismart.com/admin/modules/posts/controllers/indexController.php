<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('helper', 'slug');
    load('helper', 'image');
    load('lib', 'data_tree');
    load('lib', 'pagging');
    load('lib', 'status');
    load('lib', 'search');
}

#Hàm load index
function indexAction()
{
    load_view('indexPost');
}

#Hàm Thêm bài viết mới
function addPostAction()
{
    global $error, $post_title, $post_slug, $post_content, $post_desc, $post_thumb, $add_post, $data;
    #Kiểm tra đã submit chưa ?
    if (isset($_POST['btn-add-post'])) {
        #Mảng báo lỗi
        $error = array();
        #Kiểm tra tiêu đề bài viết
        if (empty($_POST['post_title'])) {
            $error['post_title'] = "(*) Bạn chưa nhập tiêu đề !";
        } else { 
            $post_title = $_POST['post_title'];
        }
        #Kiểm tra link thân thiện
        if (empty($_POST['post_slug'])) {
            $error['post_slug'] = "(*) Bạn chưa nhập đường link thân thiện !";
        } else {
            $post_slug = create_slug($_POST['post_slug']);
        }
        #Kiểm tra nội dung bài viết
        if (empty($_POST['post_content'])) {
            $error['post_content'] = "(*) Bạn chưa nhập nội dung bài viết !";
        } else {
            $post_content = $_POST['post_content'];
        }
        #Kiểm tra mô tả bài viết
        if (empty($_POST['post_desc'])) {
            $error['post_desc'] = "(*) Bạn chưa nhập mô tả bài viết !";
        } else {
            $post_desc = $_POST['post_desc'];
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
                    $post_thumb = upload_image('public/images/upload/posts/', $type);
                }
                #Ngược lại nếu thất bại thì báo lỗi ảnh
            } else {
                $error['upload_image'] = "(*) Bạn chưa chọn tệp ảnh";
            }
        }
        #Kiểm tra danh mục cha
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "(*) Bạn chưa chọn danh mục bài viết !";
        } else {
            $parent_cat = $_POST['parent_cat'];
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Kiểm tra nếu admin 1 login thì bài viết được duyệt còn lại admin 2,... thì chưa đk duyệt
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $post_status = 'Approved';
            } else {
                $post_status = 'Waiting...';
            }
            $post_thumb = upload_image('public/images/upload/posts/', $type);
            #Người tạo được gán với giá trị của hàm lấy thông tin admin quản trị cấp 1 do hệ thống khi login lưu trữ
            $creator = get_admin_info($_SESSION['user_login']);
            #Và chấp nhận lưu trữ các thông tin member mới vào CSDL
            $data = array(
                'post_title' => $post_title,
                'post_slug' => $post_slug,
                'post_content' => $post_content,
                'post_desc' => $post_desc,
                'post_status' => $post_status,
                'post_thumb' => $post_thumb,
                'active' => 'không hoạt động',
                'create_date' => date('d/m/y h:m'),
                'parent_cat' => $parent_cat,
                'creator' => $creator,
            );
            #Thêm bài viết mới với các dữ liệu trên
            $add_post = add_post($data);
            $error['post'] = "Thêm bài viết mới thành công !" . "<br>" . "<a href='?mod=posts&controller=index&action=index'>Trở về danh sách bài viết</a>";
            // echo $add_post;
            // show_array($data);
            // show_array($error);
        }
    }
    load_view('addPost');
}

#Hàm cập nhập bài viết 
function updatePostAction() 
{
    global $error,$post_id, $post_title, $old_title, $post_slug, $old_slug, $post_content, $old_content, $post_desc, $old_desc, $post_thumb, $old_thumb, $parent_cat, $old_parent_cat, $data;
    #kiểm tra đã lấy được id theo bài viết chưa?
    $post_id = $_GET['post_id'];
    // show_array($_GET);
    if (isset($_POST['btn-update-post'])) {
        #Mảng chữa lỗi ?
        $error = array();
        #Kiểm tra tiêu đề của bài viết có giá trị chưa nếu chưa báo điền ?
        if (empty($_POST['post_title'])) {
            $error['post_title'] = "(*) Bạn chưa điền tiêu đề bài viết !";
        } else {
            #Lấy tiêu đề bài viết cũ theo id hiển thị 
            $old_title = get_inf_post('post_title', $post_id);
            #Nếu tiêu đề cũ giống với tiêu đề mới thì lưu vào $data hiển thị 
            if ($_POST['post_title'] == $old_title) {
                $data = array (
                    'post_title' => '',
                );
                #Cập nhập dữ liệu $data vào csdl
                update_post($data, $post_id);
            } 
            #Kt có tồn tại csdl và tiêu đề bài viết trên csdl có trùng với tiêu đề điền hay ko nếu trùng báo lỗi ? 
            if(is_exists('tbl_posts', 'post_title', $_POST['post_title'])) {
                $error['post_title'] = '(*) Tên bài viết đã tồn tại !';
            #Ngược lại nếu ko trùng thì gửi dl lên để cập nhập vào csdl 
            } else {
                $post_title = $_POST['post_title'];
            }
        }
        #Kiểm tra link thân thiện 
        if (empty($_POST['post_slug'])) {
            $error['post_slug'] = "(*) Bạn chưa điền link thân thiện !";
        } else {
            $old_slug = get_inf_post('post_slug', $post_id);
            if ($_POST['post_slug'] == $old_slug){
                $data = array(
                    'post_slug' => '',
                );
                update_post($data, $post_id);
            } 
            if(is_exists('tbl_posts', 'post_slug', $_POST['post_slug'])) {
                $error['post_slug'] = '(*) Link này đã tồn tại';
            } else {
                $post_slug = create_slug($_POST['post_slug']);
            }
        }
        #Kiểm tra nội dung bài viết
        if (empty($_POST['post_content'])) {
            $error['post_content'] = "(*) Bạn chưa điền nội dung bài viết !";
        } else {
            $old_content = get_inf_post('post_content', $post_id);
            $post_content = $_POST['post_content'];
        }
        #Kiểm tra mô tả bài viết
        if (empty($_POST['post_desc'])) {
            $error['post_desc'] = "(*) Bạn chưa điền mô tả bài viết !";
        } else {
            $old_desc = get_inf_post('post_desc', $post_id);
            $post_desc = $_POST['post_desc'];
        }
        #Kiểm tra danh mục bài viết
        if (empty($_POST['parent_cat'])) {
            $error['parent_cat'] = "(*) Bạn chưa chọn danh mục bài viết !";
        } else {
            $old_parent_cat = get_inf_post('parent_cat', $post_id);
            $parent_cat = $_POST['parent_cat'];
        }
        #Kiểm tra file tải lên
        if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
            $type = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $size = $_FILES['file']['size'];
            if (!is_image($type, $size)) {
                $error['upload_image'] = "(*) Kích thước hoặc kiểu ảnh không đúng";
            } else {
                $old_thumb = get_inf_post('post_thumb', $post_id);
                if(!empty($old_thumb)){
                    delete_image($old_thumb);
                    $post_thumb = upload_image('public/images/upload/posts/', $type); 
                } else {
                    $post_thumb = upload_image('public/images/upload/posts/', $type);
                }
            }
        } else {
            $post_thumb = get_inf_post('post_thumb', $post_id);
        }
        #Kiểm tra có thay đổi ko nếu giống nhau thì cập nhập vào csdl, báo lỗi ko thay đổi
        if(($_POST['post_title'] == $old_title) && ($_POST['post_slug'] == $old_slug)  && ($_POST['post_content'] == $old_content) && ($_POST['post_desc'] == $old_desc) && ($_POST['parent_cat'] == $old_parent_cat) && !(isset($_FILES['file']) && !empty($_FILES['file']['name']))) {
            $data = array(
                'post_title' => $old_title,
                'post_slug' => $old_slug,
                'post_content' => $old_content,
                'post_desc' => $old_desc
            );
            update_post($data, $post_id);
            $error['post'] = "(*) bài viết chưa có thay đổi gì !";
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Kiểm tra nếu admin 1 login thì bài viết được duyệt còn lại admin 2,... thì chưa đk duyệt
            if (is_login() && check_role($_SESSION['user_login']) == 1) {
                $post_status = 'Approved';
            } else {
                $post_status = 'Waiting...';
            }
            #Người tạo được gán với giá trị của hàm lấy thông tin admin quản trị cấp 1 do hệ thống khi login lưu trữ
            $editor = get_admin_info($_SESSION['user_login']);
            #Và chấp nhận lưu trữ các thông tin post mới vào CSDL
            $data = array(
                'post_title'=> $post_title,
                'post_slug'=> $post_slug,
                'post_content' => $post_content,
                'post_desc'=> $post_desc,
                'post_thumb' => $post_thumb,
                'post_status' => $post_status,
                'editor' => $editor,
                'edit_date' => date('d/m/y h:m'),
                'parent_cat'=> $parent_cat,
            );
            #Cập nhập cho bài viết đã vào hệ thống
            update_post($data, $post_id);
            // show_array($data);
            $error['post'] = "Cập nhật bài viết thành công !" . "<br>" . "<a href='?mod=posts&controller=index&action=index'>Trở về danh sách bài viết</a>";
        }
    }
    load_view('updatePost');
}

#Hàm xóa bài viết
function deletePostAction()
{
    #Lấy bài viết theo id xuống
    $post_id = (int) $_GET['post_id'];
    #Xóa dữ liệu và chuyển hướng
    delete_post($post_id);
    redirect('?mod=posts&controller=index&action=index');
    load_view('indexPost');
}

#Hàm tìm kiếm bài viết
function searchPostAction()
{
    global $error, $value, $list_posts_all, $num_post;
    if (isset($_GET['sm_s'])) {
        // show_array($_GET);
        if (!empty($_GET['value'])) {
            $value = $_GET['value'];
            // echo $value;
            #Tổng số lượng bảng ghi trên 1 bài viết
            $num_per_post = 3;
            #Tổng sô bảng ghi lấy được
            $list_posts_all = db_search_all_posts($value);
            $total_row = count($list_posts_all);
            #Tổng số bài viết = hàm làm tròn (15/5) = 3
            $num_post = ceil($total_row / $num_per_post);
            load_view('searchPost');
        } else {
            $error['error'] = '(*) Bạn cần nhập thông tin bài viết cần tìm kiếm !';
            load_view('indexPost');
        }
    }
}

#Hàm trả về kết quả tìm kiếm bài viết
function resultSearchAction()
{
    global $value;
    if(!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('searchPost');
}   

#Hàm tác vụ của bài viết
function applyPostAction()
{
    if (isset($_POST['sm_action'])) {
        global $error, $data;
        #Kiểm tra đã login chưa và kiểm tra xem role có = 1 không nếu = 1 thì cho thực thi những dk dưới
        if (is_login() && check_role($_SESSION['user_login']) == 1) {
            $error = array();
            #Nếu tồn tại giá trị phần tử thì gán bằng biến danh sách post theo id
            if (!empty($_POST['checkItem'])) {
                $list_post_id = $_POST['checkItem'];
            }
            #Nếu tồn tại giá trị action thì 
            if (!empty($_POST['actions'])) {
                #kiểm tra xem actions có actions phê duyệt hay không ? 
                if ($_POST['actions'] == 1) {
                    #Kiểm tra checkItem tồn tại thì cấp nhập giá trị cho $data
                    if (isset($_POST['checkItem'])) {
                        #Nếu có thì cập nhập cho $data trạng thái Approved
                        $data = array(
                            'post_status' => 'Approved',
                        );
                        #Duyệt các phần tử id post và cập nhập vào hệ thống csdl
                        foreach ($list_post_id as $post_id) {
                            update_post($data, $post_id);
                        // show_array($list_post_id);
                        }
                        #Neus tồn tại giá trị thì lấy xuống và load tìm kiếm
                        if (isset($_GET['value'])) {
                            load_view('searchPost');
                        #Ngược lại thì tiếp tục kiểm tra lấy giá trị xuống và load bài viết 
                        } else {
                            load_view('indexPost');
                        }
                    #Và nếu không tồn tại thì báo lối
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn bài viết cần áp dụng";
                        #Và tiếp tục kiểm tra có giá trị hay không nếu có load view và ngược lại
                        if (isset($_GET['value'])) {
                            load_view('searchPost');
                        } else {
                            load_view('indexPost');
                        }
                    }
                }
                #kiểm tra xem actions có actions chờ phê duyệt hay không ? 
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'post_status' => 'Waiting...',
                        );
                        foreach ($list_post_id as $post_id) {
                            update_post($data, $post_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchPost');
                        } else {
                            load_view('indexPost');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn bài viết cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('searchPost');
                        } else {
                            load_view('indexPost');
                        }
                    }
                }
                #kiểm tra xem actions có actions bỏ vào thùng rác hay không ? 
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'post_status' => 'Trash',
                        );
                        foreach ($list_post_id as $post_id) {
                            update_post($data, $post_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchPost');
                        } else {
                            load_view('indexPost');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn bài viết cần xóa";
                        if (isset($_GET['value'])) {
                            load_view('searchPost');
                        } else {
                            load_view('indexPost');
                        }
                    }
                }
            } else {
                $error['select'] = '(*) Bạn chưa lựa chọn tác vụ !';
                if (isset($_GET['value'])) {
                    load_view('searchPost');
                } else {
                    load_view('indexPost');
                }
            }
        #Ngược lại nếu chưa login và ko có role = 1 thì báo lỗi tiếp tục kt và get xuống
        } else {
            $error['select'] = "(*) Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('searchPost');
            } else {
                load_view('indexPost');
            }
        }
    }
}




