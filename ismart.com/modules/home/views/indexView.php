<!-- Lấy phần header -->
<?php get_header();
#Lấy danh sách slider
$list_sliders =  db_fetch_array("SELECT * FROM `tbl_sliders`");

#Lấy danh sách sản phẩm
$list_products = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_status` = 'Approved' ORDER BY `product_id` DESC");

#Lấy danh sách danh mục 
$list_products_cat = db_fetch_array("SELECT * FROM `tbl_products_cat` WHERE `parent_id` = 0");

#Lấy danh sách các sản phẩm nổi bật có (giá cũ)
$list_products_highlight = get_list_product_highlight($list_products);
// show_array($list_products_highlights);
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <!-- Slider -->
            <div class="section" id="slider-wp">
                <?php if (!empty($list_sliders)) { ?>
                    <div class="section-detail">
                        <?php foreach ($list_sliders as $slider) { ?>
                            <div class="item">
                                <img src="admin/<?php echo $slider['slider_thumb'] ?>" alt="">
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
            <!-- Thanh toán  -->
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Sản phẩm nổi bật -->
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_products_highlight)) { ?>
                        <ul class="list-item">
                            <?php foreach ($list_products_highlight as $products_highlight) { ?>
                                <li>
                                    <a href="<?php echo $products_highlight['product_slug']; ?>-<?php echo $products_highlight['product_id'] ?>-i.html" title="" class="thumb">
                                        <img src="admin/<?php echo $products_highlight['product_thumb']; ?>">
                                    </a>
                                    <a href="<?php echo $products_highlight['product_slug']; ?>-<?php echo $products_highlight['product_id']; ?>-i.html" title="" class="product-name"><?php echo $products_highlight['product_title']; ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($products_highlight['product_price_new']); ?></span>
                                        <span class="old"><?php echo currency_format($products_highlight['product_price_old']); ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="gio-hang-<?php echo $products_highlight['product_id']; ?>-c.html" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="mua-ngay-<?php echo $products_highlight['product_id']; ?>-b.html" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <!-- Danh sách sản phẩm -->
            <?php if (!empty($list_products_cat)) { ?>
                <?php foreach ($list_products_cat as $product_cat) {
                    #Lấy danh sách sản phẩm theo danh mục và theo ngày tháng
                    $list_products_by_cat = db_fetch_array("SELECT * FROM `tbl_products` WHERE `parent_cat`= '{$product_cat['cat_title']}' ORDER BY `create_date` DESC");
                    #Lấy danh sách sản phẩm  theo danh mục có giá cũ 
                    $list_products_by_cat_highlight = get_list_product_highlight($list_products_by_cat);
                    // show_array($list_products_by_cat_highlight);
                    #Kiểm tra danh mục sản phẩm nổi bật
                    if (!empty($list_products_by_cat_highlight)) {
                        #Lọc ra chỉ 4 sản phẩm hiển thị
                        $list_products_by_cat_highlight_limit = array_slice($list_products_by_cat_highlight, 0, 4);
                    } else {
                        $list_products_by_cat_highlight_limit = $list_products_by_cat_highlight;
                    }
                    #Phân trang
                    #1)Tổng số bảng ghi có (sẩn phẩm) = 5
                    $total_row = count($list_products_by_cat);
                    // echo "Tổng số sản phẩm có của database: {$total_row} <br>";
                    #2)Số sản phẩm muốn hiển thị trên 1 trang
                    $num_per_page = 4;
                    #3)Số trang phân được 
                    $num_page = ceil($total_row / $num_per_page);
                    #4)Kiểm tra xem nếu có số trang từ url rồi, or cho số nguyên mặc định bắt đầu = 1
                    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                    // echo "Trang hiện tại: {$page} <br>";
                    #5)Tính chỉ số bắt đầu
                    $start = ($page - 1) * $num_per_page;
                    //echo "Xuất phát: {$start}";
                    #6)Danh sách sản phẩm theo trang
                    $list_product_by_page = array_slice($list_products_by_cat, $start, $num_per_page);
                    ?>
                    <div class="section" id="list-product-wp">
                        <div class="section-head">
                            <h3 class="section-title"><?php echo $product_cat['cat_title']; ?></h3>
                        </div>
                        <div id="<?php echo $product_cat['cat_id'] ?>">
                            <div class="section-detail">
                                <?php if (!empty($list_product_by_page)) { $error = array(); ?>
                                    <ul class="list-item clearfix">
                                        <?php foreach ($list_product_by_page as $product_by_cat) { ?>
                                            <li>
                                                <a href="<?php echo $product_by_cat['product_slug'] ?>-<?php echo $product_by_cat['product_id'] ?>-i.html" title="" class="thumb">
                                                    <img src="admin/<?php echo $product_by_cat['product_thumb'] ?>">
                                                </a>
                                                <a href="<?php echo $product_by_cat['product_slug'] ?>-<?php echo $product_by_cat['product_id'] ?>-i.html" title="" class="product-name"><?php echo $product_by_cat['product_title'] ?></a>
                                                <div class="price">
                                                    <span class="new"><?php echo currency_format($product_by_cat['product_price_new']) ?></span>
                                                    <span class="old"><?php echo currency_format($product_by_cat['product_price_old']) ?></span>
                                                </div>
                                                <div class="action clearfix">
                                                    <a href="gio-hang-<?php echo $product_by_cat['product_id'] ?>-c.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                                    <a href="mua-ngay-<?php echo $product_by_cat['product_id'] ?>-b.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                                </div>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                    <div class="pagging clearfix">
                                        <!-- Phân trang các sản phẩm trang chủ -->
                                        <?php echo get_pagging_home($num_page, $page, $product_cat['cat_id']); ?>
                                    </div>
                                <?php } else {
                                    $error['product_cat'] = 'Hiện tại sản phẩm chưa có tại cửa hàng !'; ?>
                                    <p class="error"><?php echo $error['product_cat'] ?></p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <!-- Lấy phần sidebar -->
        <?php get_sidebar('home'); ?>
    </div>
</div>
<!-- Lấy phần footer -->
<?php get_footer(); ?>