<!-- Lấy phần header -->
<?php get_header();

#Lấy gí trị xuống
global $value, $list_cat_all_search;
if(isset($_GET['value'])) {
    if(!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
}

#Lấy danh sách tất cả các danh mục tìm kiếm đk
$list_cat_all_search = get_list_cat_all_search($value);

#Lấy danh sách tất cả các sản phẩm tìm kiếm được
$list_all_products_search = db_search_all_products($value);

?>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="section" id="breadcrumb-wp">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="tim-kiem.html" title="">Tìm kiếm sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="filter-wp fl-right">
                <p class="desc">Hiển thị trên <?php echo count($list_all_products_search) ?> sản phẩm</p>
                <div class="form-filter">
                    <form method="POST" action="loc-<?php echo $value ?>.html" id="filter-arrange">
                        <select name="select">
                            <option value="">Sắp xếp</option>
                            <option <?php if (isset($_POST['select']) && $_POST['select'] == 1) echo "selected='selected'"; ?> value="1">Từ A-Z</option>
                            <option <?php if (isset($_POST['select']) && $_POST['select'] == 2) echo "selected='selected'"; ?> value="2">Từ Z-A</option>
                            <option <?php if (isset($_POST['select']) && $_POST['select'] == 3) echo "selected='selected'"; ?> value="3">Giá cao xuống thấp</option>
                            <option <?php if (isset($_POST['select']) && $_POST['select'] == 4) echo "selected='selected'"; ?> value="4">Giá thấp lên cao</option>
                        </select>
                        <button id="filter" type="submit" name="filter">Lọc</button>
                        <?php echo form_error('filter'); ?>
                    </form>
                </div>
            </div>
            <?php if(!empty($list_cat_all_search)) { ?>
                <?php foreach ($list_cat_all_search as $product_cat) { 
                    $cat_id = get_cat_id_by_cat($product_cat['parent_cat']);
                    if (isset($_POST['filter'])) { $error = array();
                        if (!empty($_POST['select'])) {
                            if ($_POST['select'] == 1) {
                                $list_products_by_cat = get_list_all_products_search_by_cat($product_cat['parent_cat'], $value, 'ORDER BY `product_title` ASC');
                            }
                            if ($_POST['select'] == 2) {
                                $list_products_by_cat = get_list_all_products_search_by_cat($product_cat['parent_cat'], $value, 'ORDER BY `product_title` DESC');
                            }
                            if ($_POST['select'] == 3) {
                                $list_products_by_cat = get_list_all_products_search_by_cat($product_cat['parent_cat'], $value, 'ORDER BY `product_price_new` DESC');
                            }
                            if ($_POST['select'] == 4) {
                                $list_products_by_cat = get_list_all_products_search_by_cat($product_cat['parent_cat'], $value, 'ORDER BY `product_price_new` ASC');
                            }
                        } else {
                            $list_products_by_cat = get_list_all_products_search_by_cat($product_cat['parent_cat'], $value);
                            $error['filter'] = '(*) Bạn chưa lựa chọn tác vụ !';
                        }
                    } else {
                        $list_products_by_cat = get_list_all_products_search_by_cat($product_cat['parent_cat'], $value);
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
                        <div class="section-head">
                            <h3 class="section-title"><?php echo $product_cat['parent_cat'] ?></h3>
                        </div>
                        <div id="<?php echo $cat_id ?>">
                            <div class="section-detail">
                                <?php if(!empty($list_product_by_page)){ $error = array(); ?>
                                    <ul class="list-item clearfix">
                                        <?php foreach($list_product_by_page as $product_by_cat) { ?>
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
                                <?php } else { $error['product_cat'] = 'Hiện tại sản phẩm chưa có tại cửa hàng !';?>
                                    <p class="error"><?php echo  $error['product_cat'] ?></p>
                                <?php } ?>
                            </div>
                            <div class="section" id="paging-wp">
                                <div class="section-detail">
                                    <ul class="list-item clearfix">
                                        <!-- Hiển thị số trang được lấy từ hàm xử lí bên pagging.php -->
                                        <?php echo get_pagging_search($num_page, $page, $cat_id, $value); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { $error['product_cat'] = 'Hiện tại sản phẩm chưa có tại cửa hàng !';?>
                <p class="error"><?php echo  $error['product_cat'] ?></p>
            <?php } ?>
        </div>
        <!-- Lấy phần sidebar -->
        <?php get_sidebar('home'); ?>
    </div>
</div>
<!-- Lấy phần footer -->
<?php get_footer(); ?>


