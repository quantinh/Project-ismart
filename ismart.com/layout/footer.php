<!-- Phần footer -->
<div id="footer-wp">
    <div id="foot-body">
        <div class="wp-inner clearfix">
            <div class="block" id="info-company">
                <h3 class="title">ISMART</h3>
                <p class="desc">ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng, chính sách ưu đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                <div id="payment">
                    <div class="thumb">
                        <img src="public/images/img-foot.png" alt="">
                    </div>
                </div>
            </div>
            <div class="block menu-ft" id="info-shop">
                <h3 class="title">Thông tin cửa hàng</h3>
                <ul class="list-item">
                    <li>
                        <p>k145 - Âu Cơ - Q.Liên Chiểu - Đà Nẵng</p>
                    </li>
                    <li>
                        <p>0377.953.849 - 0989.989.989</p>
                    </li>
                    <li>
                        <p>htinh7444@gmail.com</p>
                    </li>
                </ul>
            </div>
            <div class="block menu-ft policy" id="info-shop">
                <h3 class="title">Chính sách mua hàng</h3>
                <ul class="list-item">
                    <li>
                        <a href="#" title="">Quy định - chính sách</a>
                    </li>
                    <li>
                        <a href="#" title="">Chính sách bảo hành - đổi trả</a>
                    </li>
                    <li>
                        <a href="#" title="">Chính sách hội viện</a>
                    </li>
                    <li>
                        <a href="#" title="">Giao hàng - lắp đặt</a>
                    </li>
                </ul>
            </div>
            <div class="block" id="newfeed">
                <h3 class="title">Bảng tin</h3>
                <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                <div id="form-reg">
                    <form method="POST" action="dang-ky.html">
                        <input type="email" name="email" id="email" placeholder="Nhập email tại đây !">
                        <button type="submit" id="sm-reg">Đăng ký</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="foot-bot">
        <div class="wp-inner">
            <p id="copyright">©2021 Bản quyền Admin Theme by | Php Master</p>
        </div>
    </div>
</div>
</div>
<!-- Menu-respon -->
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
?>
<div id="menu-respon">
    <a href="trang-chu.html" title="" class="logo">ISMART</a>
    <div id="menu-respon-wp">
        <?php if(!empty($list_category_0)) { ?>
            <ul id="main-menu-respon">
                <li>
                    <a href="trang-chu.html" title>Trang chủ</a>
                </li>
                <?php foreach($list_category_0 as $category_0) {
                    #Lấy danh mục cấp 1 theo cat_id 
                    $list_category_1 = db_fetch_array("SELECT * FROM `tbl_products_cat` WHERE `parent_id` = '{$category_0['cat_id']}'"); ?>
                    <li>
                        <a href="danh-muc/<?php echo $category_0['cat_slug']; ?>-<?php echo $category_0['cat_id']; ?>.html" title><?php echo $category_0['cat_title']; ?></a>
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
                <li>
                    <a href="bai-viet.html" title>Blog</a>
                </li>
                <li>
                    <a href="lien-he.html" title>Liên hệ</a>
                </li>
            </ul>
        <?php } ?>
    </div>
</div>
<div id="btn-top"><img class="back_top" src="public/images/icon-to-top.png" alt="" /></div>
<div id="fb-root"></div>
<!-- Phần xử lí javascript -->
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
</body>

</html>