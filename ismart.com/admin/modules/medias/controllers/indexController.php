<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct()
{
    load_model('index');
    load('helper', 'image');
    load('lib','validation');
    load('lib', 'pagging');
    load('lib', 'search');
}

#Hàm load index
function indexAction()
{
    load_view('media');
}

#Hàm tìm kiếm Media
function searchMediaAction()
{
    global $error, $value, $list_medias_all;
    if (isset($_GET['sm_s'])) {
        // show_array($_GET);
        if (!empty($_GET['value'])) {
            $value = $_GET['value'];
            // echo $value;
            #Tổng số lượng bảng ghi trên 1 trang
            // $num_per_page = 3;
            #Tổng sô bảng ghi lấy được
            $list_medias_all = db_search_all_medias($value);
            #Tổng số trang = hàm làm tròn (15/5) = 3
            // $total_row = count($list_Medias_all);
            // $num_page = ceil($total_row / $num_per_page);
            load_view('searchMedia');
        } else {
            $error['error'] = '(*) Bạn cần nhập thông tin media cần tìm kiếm !';
            load_view('media');
        }
    }
}

#Hàm trả về kết quả tìm kiếm Media
function resultSearchAction()
{
    global $value;
    #Kiểm tra có giá trị thì get xuống 
    if(!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('searchMedia');
}   

#Hàm tác vụ của Media
function applyMediaAction()
{
    if (isset($_POST['sm_action'])) {
        global $error;
        $error = array();
        if(!empty($_POST['checkItem'])) {
            $list_media_id = $_POST['checkItem'];
        }
        if (!empty($_POST['actions'])) {
            if ($_POST['actions'] == 1) {
                if (isset($_POST['checkItem'])) {
                    foreach ($list_media_id as $media_id) {
                        delete_media($media_id);
                    }
                    if(isset($_GET['value'])) {
                        load_view('searchMedia');
                    } else{
                        load_view('media');
                    }
                } else {
                    $error['select'] = "Bạn chưa lựa chọn media cần xóa";
                    if(isset($_GET['value'])) {
                        load_view('searchMedia');
                    } else{
                        load_view('media');
                    }
                }
            }
        } else {
            $error['select'] = "Bạn chưa lựa chọn tác vụ";
            if(isset($_GET['value'])) {
                load_view('searchMedia');
            } else{
                load_view('media');
            }
        }
    }
}