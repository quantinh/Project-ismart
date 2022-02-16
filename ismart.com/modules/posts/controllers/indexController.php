<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct()
{
    load_model('index');
    load('helper', 'format');
    load('lib', 'validation');
    load('lib', 'search');
    load('lib', 'pagging');
    load('lib','cart');
    load('lib', 'get_title');
}

#Hàn load trang index
function indexAction()
{
    load_view('index');
}

#Hàm load trang chi tiết blog
function detail_blogAction()
{
    load_view('detail_blog');
}

#Hàm phân trang bài viết bằng ajax
function pagination_postAction()
{
    #Kết quả đầu ra là một chuỗi html rỗng
    $result_post = '';
    #Truy vấn lấy ra các bài viết đã phê duyệt theo thứ tự(post_id) từ cao xuống thấp bài viết mới nhất từ admin
    $query = "SELECT * FROM `tbl_posts` WHERE `post_status` = 'Approved' ORDER BY `post_id` DESC";
    #Danh sách bài viết được lấy ra theo dạng mảng 
    $list_posts = db_fetch_array($query);
    #Phân trang
    #1)Tổng số bảng ghi có (bài viết) = 9
    $total_row = count($list_posts);
    #2)Số sản phẩm muốn hiển thị trên 1 trang
    $num_per_page = 6;
    #3)Số trang phân được 
    $num_page = ceil($total_row / $num_per_page);
    #4)Kiểm tra xem nếu có số trang từ url rồi, or cho số nguyên mặc định bắt đầu = 1
    if(isset($_POST['page'])) {
        $page = (int) $_POST['page'] ? (int) $_POST['page'] : 1;
        if($_POST['page'] == '<i class="fa fa-angle-left"></i>') {
            if($page < 1){
                $page = 1;
            } else {
                $page -= 1;
            }                }
        if($_POST['page'] == '<i class="fa fa-angle-right"></i>') {
            if($page = $num_page) {
                $page = $num_page;
            } else {
                $page += 1;
            }
        }
    } else {
        $page = 1;
    }
    #5)Tính chỉ số bắt đầu
    $start = ($page - 1) * $num_per_page;
    #6)Danh sách bài viết trich xuất ngẫu nhiên theo trang
    $list_posts_by_page = array_slice($list_posts, $start, $num_per_page);
    #Kết quả đầu ra bài viết dạng chuỗi html phân theo bài viết được lấy ra khi phân trang
    $result_post .= '<div class="section-detail">
                        <ul class="list-item">';
                        if (!empty($list_posts_by_page)) {
                            foreach($list_posts_by_page as $post) {
                                $result_post .= '
                                <li class="clearfix">
                                    <a href="?mod=posts&action=detail_blog&post_id='.$post['post_id'].'" title="" class="thumb fl-left">
                                        <img src="admin/'.$post['post_thumb'].'" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="?mod=posts&action=detail_blog&post_id='.$post['post_id'].'" title="" class="title">'.$post['post_title'].'</a>
                                        <span class="create-date">'.$post['create_date'].'</span>
                                        <p class="desc">'.$post['post_desc'].'</p>
                                    </div>
                                </li>';
                            }
                        }
    $result_post .=     '</ul>
                    </div>';
    if (!empty($list_posts_by_page)){
    $result_post .= '<div class="section" id="paging-wp">
                            <div class="section-detail">
                                <ul class="list-item clearfix">
                                    '.get_pagging_post($num_page, $page).'
                                </ul>
                            </div>
                        </div>';
    }
    #Kết quả đầu ra lưu dạng mảng cho data và trả về dạng json ajax xử lí hiển thị        
    $data = array(
        'result_post' => $result_post,
    );
    echo json_encode($data);
} 