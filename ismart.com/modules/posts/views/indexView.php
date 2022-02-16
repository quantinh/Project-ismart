<?php get_header();

#Số bản ghi/trang
$num_per_page = 6;
$list_num_page = db_num_page('tbl_posts', $num_per_page);
#Tổng số bản ghi
#1)Tổng số bảng ghi có (bài viết) = 5
$total_row = db_num_rows("SELECT * FROM  `tbl_posts`");
#Phân trang
#2)Số bài viết muốn hiển thị trên 1 trang
$num_per_page = 6;
#3)Số trang phân được 
$num_page = ceil($total_row / $num_per_page);
// echo "Số trang phân được: {$num_page} <br>";
#4)Kiểm tra xem nếu có số trang từ url rồi, or cho số nguyên mặc định bắt đầu = 1
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
// echo "Trang hiện tại: {$page} <br>";
#5)Tính chỉ số bắt đầu
$start = ($page - 1) * $num_per_page;
#chỉ số bắt đầu của trang
// $page_num = (int) 1;
// echo "Số trang phân được: {$num_page} <br>";
$order_num = $start;
#6)Danh sách bài viết theo trang
$list_posts = get_posts($start, $num_per_page);
?>
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="section" id="breadcrumb-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="bai-viet.html" title="">Bài viết</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Bài viết liên quan</h3>
                </div>
                <div id="result_post">
                    <div class="section-detail">
                        <?php if (!empty($list_posts)) { $error = array();?>
                            <ul class="list-item">
                                <?php foreach ($list_posts as $post) { ?> 
                                    <li class="clearfix">
                                        <a href="bai-viet/<?php echo $post['post_slug']?>-<?php echo $post['post_id']?>.html" title="" class="thumb fl-left">
                                            <img src="admin/<?php echo $post['post_thumb'] ?>" alt="">
                                        </a>
                                        <div class="info fl-right">
                                            <a href="bai-viet/<?php echo $post['post_slug']?>-<?php echo $post['post_id']?>.html" title="" class="title"><?php echo $post['post_title'] ?></a>
                                            <span class="create-date"><?php echo $post['create_date'] ?></span>
                                            <p class="desc"><?php echo $post['post_content'] ?></p>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } else { $error['post'] = "Hiện tại không có bài viết nào!";?>
                            <p class="error"><?php echo  $error['post'] ?> </p>
                        <?php } ?>
                    </div>
                    <div class="section" id="paging-wp">
                        <div class="section-detail">
                            <ul class="list-item clearfix" id="paging-post">
                                <!-- Phân trang các bài viết -->
                                <?php echo get_pagging_post($num_page, $page); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php get_sidebar('post');?>
    </div>
</div>
<?php
get_footer();
?>




