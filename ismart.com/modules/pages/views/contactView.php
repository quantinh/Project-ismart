<!-- Lấy phần header -->
<?php get_header();

#Lấy id theo danh mục liên hệ
$page_id = db_fetch_assoc("SELECT `page_id` FROM `tbl_pages` WHERE `category` = 'Liên hệ'");

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
                        <a href="lien-he.html" title="">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title"><?php echo get_inf_page('page_title', $page_id['page_id']); ?></h3>
                </div>
                <div class="section-detail">
                    <span class="create-date"><?php echo get_inf_page('create_date', $page_id['page_id']); ?></span>
                    <div class="detail">
                        <p><strong><?php echo get_inf_page('page_desc', $page_id['page_id']); ?></strong></p>
                        <p style="text-align: center;"><img src="admin/<?php echo get_inf_page('page_thumb', $page_id['page_id']); ?>" alt=""></p>
                        <?php echo get_inf_page('page_content', $page_id['page_id']); ?>
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
        <?php get_sidebar('page'); ?>
    </div>
</div>
<?php get_footer(); ?>
<!-- Lấy phần footer -->