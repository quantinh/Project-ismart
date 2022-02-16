<?php get_header();

#Lấy ra danh sách sản phẩm (điều kiện sản phầm đã được duyệt và theo thứ tự sản phẩm mới nhất)
$list_products = db_fetch_array("SELECT * FROM `tbl_products` WHERE `product_status` = 'Approved' ORDER BY `product_id` DESC");
// show_array($list_products);

#Lấy ra từng danh mục sản phẩm
$list_product_cat = db_fetch_array("SELECT * FROM `tbl_products_cat` WHERE `parent_id` = 0");
// show_array($list_product_cat);
?>
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="section" id="breadcrumb-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="san-pham.html" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="filter-wp fl-right">
                <p class="desc">Hiển thị <?php echo count($list_products) ?> sản phẩm</p>
                <div class="form-filter">
                    <form method="POST" action="" id="filter-arrange">
                        <select name="select">
                            <option value="">Sắp xếp</option>
                            <option <?php if (isset($_POST['select']) && $_POST['select'] == 1) echo "selected='selected'"; ?> value="1">Từ A-Z</option>
                            <option <?php if (isset($_POST['select']) && $_POST['select'] == 2) echo "selected='selected'"; ?> value="2">Từ Z-A</option>
                            <option <?php if (isset($_POST['select']) && $_POST['select'] == 3) echo "selected='selected'"; ?> value="3">Giá cao xuống thấp</option>
                            <option <?php if (isset($_POST['select']) && $_POST['select'] == 4) echo "selected='selected'"; ?> value="4">Giá thấp lên cao</option>
                        </select>
                        <button id="filter" type="submit" name="filter">Lọc</button>
                        <?php echo form_error('filter') ?>
                    </form>
                </div>
            </div>
            <?php if (!empty($list_product_cat)) { ?>
                <!-- Duyệt phân ra theo từng danh mục của sản phẩm -->
                <?php foreach ($list_product_cat as $product_cat) {
                    #Lọc sản phẩm 
                    if (isset($_POST['filter'])) {
                        if (!empty($_POST['select'])) {
                            if ($_POST['select'] == 1) {
                                $list_products_by_cat = get_product_by_parent_cat($product_cat['cat_title'], 'ORDER BY `product_title` ASC');
                            }
                            if ($_POST['select'] == 2) {
                                $list_products_by_cat = get_product_by_parent_cat($product_cat['cat_title'], 'ORDER BY `product_title` DESC');
                            }
                            if ($_POST['select'] == 3) {
                                $list_products_by_cat = get_product_by_parent_cat($product_cat['cat_title'], 'ORDER BY `product_price_new` DESC');
                            }
                            if ($_POST['select'] == 4) {
                                $list_products_by_cat = get_product_by_parent_cat($product_cat['cat_title'], 'ORDER BY `product_price_new` ASC');
                            }
                        } else {
                            $list_products_by_cat = get_product_by_parent_cat($product_cat['cat_title']);
                            $error['filter'] = 'Bạn chưa lựa chọn tác vụ';
                        }
                    } else {
                        $list_products_by_cat = get_product_by_parent_cat($product_cat['cat_title']);
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
                    // show_array($list_product_by_page);
                ?>
                    <div class="section" id="list-product-wp">
                        <div data-type="1">
                            <div class="section-head">
                                <h3 class="section-title"><?php echo $product_cat['cat_title'] ?></h3>
                            </div>
                            <!-- Lỗi thường gặp nhất ajax #+cat_id -->
                            <div id="<?php echo $product_cat['cat_id'] ?>">
                                <div class="section-detail">
                                    <?php if (!empty($list_product_by_page)) { $error = array(); ?>
                                        <ul data-type="1" class="list-item clearfix">
                                            <?php foreach ($list_product_by_page as $product_by_cat) { ?>
                                                <li>
                                                    <a href="<?php echo $product_by_cat['product_slug'] ?>-<?php echo $product_by_cat['product_id'] ?>-i.html" title="" class="thumb">
                                                        <img src="admin/<?php echo $product_by_cat['product_thumb'] ?>">
                                                    </a>
                                                    <a href="<?php echo $product_by_cat['product_slug'] ?>-<?php echo $product_by_cat['product_id'] ?>-i.html" title="" class="product-name"><?php echo $product_by_cat['product_title'] ?></a>
                                                    <div class="price">
                                                        <span class="new"><?php echo currency_format($product_by_cat['product_price_new']) ?></span>
                                                        <span class="old"><?php if (!empty($product_by_cat['product_price_old'])) echo currency_format($product_by_cat['product_price_old']) ?></span>
                                                    </div>
                                                    <div class="action clearfix">
                                                        <a href="gio-hang-<?php echo $product_by_cat['product_id'] ?>-c.html" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                                        <a href="dat-hang-<?php echo $product_by_cat['product_id'] ?>-b.html" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                                    </div>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                        <div class="section" id="paging-wp">
                                            <div class="section-detail" id="pagging-filter">
                                                <ul class="list-item clearfix">
                                                    <!-- Phân trang các sản phẩm -->
                                                    <?php echo get_pagging_product($num_page, $page, $product_cat['cat_id']); ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php } else {
                                        $error['product_cat'] = 'Hiện không tồn tại sản phẩm ' . $product_cat['cat_title'] . ' nào!'; ?>
                                        <p class="error"><?php echo  $error['product_cat'] ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php get_sidebar('product'); ?>
    </div>
</div>
<?php get_footer(); ?>