<?php get_header();

$mod = $_GET['mod'];
$action = $_GET['action'];
$page_id = db_fetch_assoc("SELECT `post_id` FROM `tbl_posts` ");

#Lấy id theo post xuống
if(!empty($_GET['post_id'])){
    $post_id = (int)$_GET['post_id'];
}
?>
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="section" id="breadcrumb-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="bai-viet.html" title="">Chi tiết bài viết</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo get_inf_post('post_title', $post_id)?></h3>
                </div>
                <div class="section-detail">
                    <span class="create-date"><?php echo get_inf_post('create_date', $post_id)?></span>
                    <div class="detail">
                        <p><strong><?php echo get_inf_post('post_desc', $post_id)?></strong></p>
                        <p style="text-align: center;">
                            <img src="admin/<?php echo get_inf_post('post_thumb', $post_id) ?>" alt="">
                        </p>
                        <?php echo get_inf_post('post_content', $post_id)?>
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <?php get_sidebar('post'); ?>
    </div>
</div>
<?php
get_footer();
?>