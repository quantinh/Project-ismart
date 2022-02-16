<?php

#Danh mục sản phẩm cấp 0(Lấy tất cả danh mục sản phẩn theo parent_id = 0)
$list_category_0 = db_fetch_array("SELECT * FROM `tbl_products_cat` WHERE `parent_id` = 0");
// show_array($list_category_0);

#Danh sách sản phẩm 
$list_products = db_fetch_array("SELECT * FROM `tbl_products` ORDER BY `product_sold` DESC");
// show_array($list_products);

#Danh sách sản phẩm bán chạy
$list_best_selling_product = array_slice($list_products, 0, 8);
// show_array($list_best_selling_product);

$list_banners = db_fetch_array("SELECT * FROM `tbl_banners` WHERE `banner_id` = 1");
// show_array($list_banners);
?>
<!-- Sidebar sản phẩm -->
<div class="sidebar fl-left">
    <!-- Danh mục sản phẩm -->
    <div class="section" id="category-product-wp">
        <div class="section-head">
            <h3 class="section-title">Danh mục sản phẩm</h3>
        </div>
        <div class="section-detail">
            <?php if (!empty($list_category_0)) { ?>
                <ul class="list-item">
                    <?php foreach ($list_category_0 as $category_0) {
                        #Lấy danh mục cấp 1 theo cat_id 
                        $list_category_1 = db_fetch_array("SELECT * FROM `tbl_products_cat` WHERE `parent_id` = '{$category_0['cat_id']}'"); ?>
                        <li>
                            <a href="danh-muc/<?php echo $category_0['cat_slug']; ?>-<?php echo $category_0['cat_id']; ?>.html" title=""><?php echo $category_0['cat_title']; ?></a>
                            <?php if (!empty($list_category_1)) { ?>
                                <ul class="sub-menu">
                                    <?php foreach ($list_category_1 as $category_1) {
                                        #Lấy danh mục cấp 2 theo cat_id 
                                        $list_category_2 = db_fetch_array("SELECT * FROM `tbl_products_cat` WHERE `parent_id` = '{$category_1['cat_id']}'"); ?>
                                        <li>
                                            <a href="danh-muc/<?php echo $category_1['cat_slug']; ?>-<?php echo $category_1['cat_id']; ?>.html" title=""><?php echo $category_1['cat_title']; ?></a>
                                            <?php if (!empty($list_category_2)) { ?>
                                                <ul class="sub-menu">
                                                    <?php foreach ($list_category_2 as $category_2) { ?>
                                                        <li>
                                                            <a href="danh-muc/<?php echo $category_2['cat_slug']; ?>-<?php echo $category_2['cat_id']; ?>.html" title=""><?php echo $category_2['cat_title']; ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>
                                        </li>
                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </div>
    </div>
    <!-- Bộ lọc giá -->
    <div class="section" id="filter-product-wp">
        <div class="section-head">
            <h3 class="section-title">Bộ lọc</h3>
        </div>
        <div class="section-detail">
            <form method="POST" action="" id="filter-product">
                <!-- Giá -->
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Giá</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="radio" name="r-price" value="0"></td>
                            <td>Tất cả</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" value="1"></td>
                            <td>Dưới 500.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" value="2"></td>
                            <td>500.000đ - 1.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" value="3"></td>
                            <td>1.000.000đ - 5.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" value="4"></td>
                            <td>5.000.000đ - 10.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="r-price" value="5"></td>
                            <td>Trên 10.000.000đ</td>
                        </tr>
                    </tbody>
                </table>
                <!-- Nhãn hiệu  -->
                <?php if (!empty($_GET['cat_id'])) {
                    $cat_id =  $_GET['cat_id'];
                    $list_brands = db_fetch_array("SELECT `cat_title` FROM `tbl_products_cat` WHERE `parent_id`='{$cat_id}'");
                } ?>
                <table>
                    <?php if (!empty($list_brands)) { ?>
                        <thead>
                            <tr>
                                <td colspan="2">Hãng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list_brands as $brand) { ?>
                                <tr>
                                    <td><input class="common_selector filter-brand" type="radio" name="r-brand" value="<?php echo $brand['cat_title']; ?>"></td>
                                    <td><?php echo $brand['cat_title']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } ?>
                </table>
                <input id="filter" type="submit" name="btn-submit" value="Lọc">
            </form>
        </div>
    </div>
    <!-- Banner -->
    <div class="section" id="banner-wp">
        <?php if (!empty($list_banners)) { ?>
            <div class="section-detail">
                <?php foreach ($list_banners as $banner) { ?>
                    <a href="<?php echo $banner['banner_link']; ?>-<?php echo $banner['banner_id'] ?>-i.html" title="" class="thumb">
                        <img src="admin/<?php echo $banner['banner_thumb'] ?>" alt=""></br>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</div>