<?php

#Danh mục sản phẩm cấp 0(Lấy tất cả danh mục sản phẩn theo parent_id = 0)
$list_category_0 = db_fetch_array("SELECT * FROM `tbl_products_cat` WHERE `parent_id` = 0");
// show_array($list_category_0);

#Danh sách sản phẩm 
$list_products = db_fetch_array("SELECT * FROM `tbl_products` ORDER BY `product_sold` DESC");
// show_array($list_products);

#Danh sách sản phẩm bán chạy trích xuất 1 phần tử của mảng
$list_best_selling_product = array_slice($list_products, 0, 8);
// show_array($list_best_selling_product);

$list_banners = db_fetch_array("SELECT * FROM `tbl_banners`");
// show_array($list_banners);
?>
<!-- Sidebar trang chủ -->
<div class="sidebar fl-left">
            <!-- Danh mục sản phẩm -->
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <?php if(!empty($list_category_0)) { ?>
                        <ul class="list-item">
                            <?php foreach($list_category_0 as $category_0) {
                                #Lấy danh mục cấp 1 theo cat_id 
                                $list_category_1 = db_fetch_array("SELECT * FROM `tbl_products_cat` WHERE `parent_id` = '{$category_0['cat_id']}'"); ?>
                                <li>
                                    <a href="danh-muc/<?php echo $category_0['cat_slug']; ?>-<?php echo $category_0['cat_id']; ?>.html" title=""><?php echo $category_0['cat_title']; ?></a>
                                    <?php if(!empty($list_category_1)) { ?>
                                        <ul class="sub-menu">
                                            <?php foreach($list_category_1 as $category_1) {
                                                #Lấy danh mục cấp 2 theo cat_id 
                                                $list_category_2 = db_fetch_array("SELECT * FROM `tbl_products_cat` WHERE `parent_id` = '{$category_1['cat_id']}'"); ?>
                                                <li>
                                                    <a href="danh-muc/<?php echo $category_1['cat_slug']; ?>-<?php echo $category_1['cat_id']; ?>.html" title=""><?php echo $category_1['cat_title']; ?></a>
                                                    <?php if(!empty($list_category_2)) { ?>
                                                        <ul class="sub-menu">
                                                            <?php foreach($list_category_2 as $category_2) { ?>
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
            <!-- Sản phẩm nổi bật -->
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <?php if(!empty($list_best_selling_product)) { ?>
                        <ul class="list-item">
                            <?php foreach($list_best_selling_product as $best_selling_product) { ?>
                                <li class="clearfix">
                                    <a href="<?php echo $best_selling_product['product_slug']; ?>-<?php echo $best_selling_product['product_id']; ?>-i.html" title="" class="thumb fl-left">
                                        <img src="admin/<?php echo $best_selling_product['product_thumb']; ?>" alt="">
                                    </a>
                                    <div class="info fl-right">
                                        <a href="<?php echo $best_selling_product['product_slug']; ?>-<?php echo $best_selling_product['product_id']; ?>-i.html" title="" class="product-name"><?php echo $best_selling_product['product_title']; ?></a>
                                        <div class="price">
                                            <span class="new"><?php echo currency_format($best_selling_product['product_price_new']) ?></span>
                                            <span class="old"><?php echo currency_format($best_selling_product['product_price_old']) ?></span>
                                        </div>
                                        <a href="dat-hang-<?php echo $best_selling_product['product_id'] ?>-b.html" title="" class="buy-now">Mua ngay</a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <!-- Banner  -->
            <div class="section" id="banner-wp">
                <?php if(!empty($list_banners)) { ?>
                    <div class="section-detail">
                        <?php foreach($list_banners as $banner) { ?>
                            <a href="<?php echo $banner['banner_link']; ?>-<?php echo $banner['banner_id'] ?>-i.html" title="" class="thumb">
                                <img src="admin/<?php echo $banner['banner_thumb'] ?>" alt=""></br>
                            </a>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>