<?php get_header(); 

#Tổng số lượng bảng ghi trên 1 trang
$num_per_page = 5;

#Kiểm tra xem nếu có số bài viết từ url rồi ,or cho số nguyên mặc định bắt đầu = 1
$page_num = isset($_GET['page_id']) ? (int) $_GET['page_id'] : 1;
// echo "Trang hiện tại: {$product_num} <br>";

#Tính chỉ số bắt đầu
$start = ($page_num - 1) * $num_per_page;
// echo "Xuất phát: {$start}";

#Tổng số bảng ghi
$order_num = $start;

#Mảng chứa tổng danh sách các phần tử table
$list_all_medias = array();
$list_all_medias['admins'] = db_fetch_array('SELECT * FROM `tbl_admins`');
$list_all_medias['products'] = db_fetch_array('SELECT * FROM `tbl_products`');
$list_all_medias['posts'] = db_fetch_array('SELECT * FROM `tbl_posts`');
$list_all_medias['sliders'] = db_fetch_array('SELECT * FROM `tbl_sliders`');
$list_all_medias['banners'] = db_fetch_array('SELECT * FROM `tbl_banners`');

#Lấy danh sách trang
$list_num_slider = db_num_page('tbl_sliders', $num_per_page);

$list_total = count($list_all_medias['admins']) + count($list_all_medias['posts']) + count($list_all_medias['products']) + count($list_all_medias['sliders']) + count($list_all_medias['banners']);
// show_array($list_all_medias);
// echo $list_total;
#Tổng số trang = hàm làm tròn (15/5) = 3
$num_page = ceil($list_total / $num_per_page);
//echo "Số trang: {$num_page} <br>";
?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách media</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=medias&controller=index&action=index">Tất cả <span class="count">(<?php echo $list_total; ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="medias">
                            <input type="hidden" name="controller" value="index">
                            <input type="hidden" name="action" value="searchMedia">
                            <input type="text" name="value" id="s" value="<?php echo set_value('value') ?>">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <?php echo form_error('error'); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=medias&controller=index&action=applyMedia&page_id=<?php echo $page_num;?>">    
                        <div class="actions">   
                            <div class="form-actions">
                                <select name="actions">
                                    <option value="0">Tác vụ</option>
                                    <option <?php if (!empty($_POST['actions']) && $_POST['actions'] == 1) {echo "selected='selected'";}?> value="1">Xóa</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">
                                <?php echo form_error('select') ?>
                            </div>
                        </div>
                        <div class="table-responsive" id="table-scroller">
                            <?php if (!empty($list_all_medias)) { $error = array();?>
                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Hình ảnh</span></td>
                                            <td><span class="thead-text">Tên file</span></td>
                                            <td><span class="thead-text">Người tạo</span></td>
                                            <td><span class="thead-text">Ngày tạo</span></td>
                                            <td><span class="thead-text">Người sửa</span></td>
                                            <td><span class="thead-text">Ngày sửa</span></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><h3 class="tbody-text text-color">All admins</h3></td></tr>
                                        <!-- Phần danh sách admin -->
                                        <?php $order_admins = $start; foreach ($list_all_medias['admins'] as $list_admins) { $order_admins ++; ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $list_admins['admin_id'] ?>"></td>
                                                <td><span class="tbody-text"><?php echo $order_admins; ?></h3></span>
                                                <td>
                                                    <div class="tbody-thumb">
                                                        <a href="<?php echo $list_admins['avatar'];?>"><img src="<?php echo $list_admins['avatar'] ?>" alt=""></a>
                                                    </div>
                                                </td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=users&controller=team&action=updateAdmin&admin_id=<?php echo $list_admins['admin_id']?>"><?php echo basename($list_admins['avatar']) ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=users&controller=team&action=updateAdmin&admin_id=<?php echo $list_admins['admin_id'] ?>" title="Sửa" class="edit"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=users&controller=team&action=deleteAdmin&admin_id=<?php echo $list_admins['admin_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $list_admins['creator'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_admins['reg_date'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_admins['editor'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_admins['edit_date'] ?></span></td>
                                            </tr>
                                        <?php } ?>
                                        <tr><td><h3 class="tbody-text text-color">All products</h3></td></tr>
                                        <!-- Phần danh sách sản phẩm -->
                                        <?php $order_products = $order_admins; foreach ($list_all_medias['products'] as $list_products) { $order_products ++; ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $list_products['product_id'] ?>"></td>
                                                <td><span class="tbody-text"><?php echo $order_products; ?></h3></span>
                                                <td>
                                                    <div class="tbody-thumb">
                                                        <a href="<?php echo $list_products['product_thumb'];?>"><img src="<?php echo $list_products['product_thumb'] ?>" alt=""></a>
                                                    </div>
                                                </td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=products&controller=index&action=updateProduct&product_id=<?php echo $list_products['product_id'] ?>" title=""><?php echo basename($list_products['product_thumb']) ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=products&controller=index&action=updateProduct&product_id=<?php echo $list_products['product_id']?>" title="Sửa" class="edit"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=products&controller=index&action=deleteProduct&product_id=<?php echo $list_products['product_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $list_products['creator'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_products['create_date'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_products['editor'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_products['edit_date'] ?></span></td>
                                            </tr>
                                        <?php } ?>
                                        <tr><td><h3 class="tbody-text text-color">All posts</h3></td></tr>
                                        <!-- Phần danh sách bài viết -->
                                        <?php $order_posts = $order_products; foreach ($list_all_medias['posts'] as $list_posts) { $order_posts ++; ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $list_posts['post_id'] ?>"></td>
                                                <td><span class="tbody-text"><?php echo $order_posts; ?></h3></span>
                                                <td>    
                                                    <div class="tbody-thumb">
                                                        <a href="<?php echo $list_posts['post_thumb'] ?>"><img src="<?php echo $list_posts['post_thumb'] ?>" alt=""></a>
                                                    </div>
                                                </td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=posts&controller=index&action=updatePost&post_id=<?php echo $list_posts['post_id'] ?>" title=""><?php echo basename($list_posts['post_thumb']) ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=posts&controller=index&action=updatePost&post_id=<?php echo $list_posts['post_id']?>" title="Sửa" class="edit"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=posts&controller=index&action=deletePost&post_id=<?php echo $list_posts['post_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $list_posts['creator'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_posts['create_date'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_posts['editor'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_posts['edit_date'] ?></span></td>
                                            </tr>
                                        <?php } ?>
                                        <tr><td><h3 class="tbody-text text-color">All sliders</h3></td></tr>
                                        <!-- Phần danh sách slider -->
                                        <?php $order_sliders = $order_posts;  foreach ($list_all_medias['sliders'] as $list_sliders) { $order_sliders ++; ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $list_sliders['slider_id'] ?>"></td>
                                                <td><span class="tbody-text"><?php echo $order_sliders; ?></h3></span>
                                                <td>
                                                    <div class="tbody-thumb">
                                                        <a href="?mod=sliders&controller=index&action=updateSlider&slider_id=<?php echo $list_sliders['slider_id'] ?>"><img src="<?php if(!empty($list_sliders['slider_thumb'])){echo $list_sliders['slider_thumb'];} else{ echo 'public/images/img-product.png';}?>" alt=""></a>
                                                    </div>
                                                </td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=sliders&controller=index&action=updateSlider&slider_id=<?php echo $list_sliders['slider_id']?>"><span class="tbody-text"><?php echo basename($list_sliders['slider_thumb']) ?></span></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=sliders&controller=index&action=updateSlider&slider_id=<?php echo $list_sliders['slider_id']?>" title="Sửa" class="edit"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=sliders&controller=index&action=deleteSlider&slider_id=<?php echo $list_sliders['slider_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $list_sliders['creator'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_sliders['create_date'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_sliders['editor'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_sliders['edit_date'] ?></span></td>
                                            </tr>
                                        <?php } ?>
                                        <tr><td><h3 class="tbody-text text-color">All banners</h3></td></tr>
                                        <!-- Phần danh sách banner -->
                                        <?php $order_banners = $order_sliders;  foreach ($list_all_medias['banners'] as $list_banners) { $order_banners ++; ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $list_banners['banner_id'] ?>"></td>
                                                <td><span class="tbody-text"><?php echo $order_banners; ?></h3></span>
                                                <td>
                                                    <div class="tbody-thumb">
                                                        <a href="?mod=banners&controller=index&action=updateBanner&banner_id=<?php echo $list_banners['banner_id'] ?>"><img src="<?php if(!empty($list_banners['banner_thumb'])){echo $list_banners['banner_thumb'];} else{ echo 'public/images/avatar/img-product.png';}?>" alt=""></a>
                                                    </div>
                                                </td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=banners&controller=index&action=updateBanner&banner_id=<?php echo $list_banners['banner_id']?>"><span class="tbody-text"><?php echo basename($list_banners['banner_thumb']) ?></span></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=banners&controller=index&action=updateBanner&banner_id=<?php echo $list_banners['banner_id']?>" title="Sửa" class="edit"><i class="fa fa-edit" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=banners&controller=index&action=deleteBanner&banner_id=<?php echo $list_banners['banner_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $list_sliders['creator'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_sliders['create_date'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_sliders['editor'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $list_sliders['edit_date'] ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="tfoot-text">STT</span></td>
                                            <td><span class="tfoot-text">Hình ảnh</span></td>
                                            <td><span class="tfoot-text">Tên file</span></td>
                                            <td><span class="tfoot-text">Người tạo</span></td>
                                            <td><span class="tfoot-text">Ngày tạo</span></td>
                                            <td><span class="tfoot-text">Người sửa</span></td>
                                            <td><span class="tfoot-text">Ngày sửa</span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            <?php } else { $error['media'] = "(*) Không có media nào !"; ?>
                                <p class="error"><?php echo $error['media'] ?></p>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                        <!-- Hiển thị số trang được lấy từ hàm xử lí bên pagging.php -->   
                       <?php echo get_pagging($num_page, $page_num, "?mod=medias&controller=index&action=index"); ?>    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<!-- Lấy phần footer -->