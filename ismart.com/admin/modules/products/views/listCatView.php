<?php get_header(); 

#lấy dữ liệu danh mục từ CSDL
$data_product_cat = db_fetch_array("SELECT * FROM `tbl_products_cat`");
// show_array($data_product_cat);

$list_product_cat_all = data_tree($data_product_cat, 0);

#Tổng số lượng bảng ghi trên 1 trang
$num_per_page = 10;

#Kiểm tra xem nếu có số trang từ url rồi ,or cho số nguyên mặc định bắt đầu = 1
$cat_num = isset($_GET['page_id']) ? (int) $_GET['page_id'] : 1;
// echo "Trang hiện tại: {$cat_num} <br>";

#Tính chỉ số bắt đầu
$start = ($cat_num - 1) * $num_per_page;
// echo "Xuất phát: {$start}";

#Tổng số bảng ghi
$order_num = $start;

$list_products_cat = array_slice($list_product_cat_all, $start, $num_per_page);

#Lấy danh sách danh mục theo trang
$list_num_page = db_num_page('tbl_products_cat', $num_per_page);

#Tổng số bảng ghi lấy từ database 
$total_row = db_num_rows("SELECT * FROM `tbl_products_cat`");

#Tổng số trang = hàm làm tròn (15/5) = 3
$num_page = ceil($total_row / $num_per_page);
//echo "Số trang: {$num_page} <br>";

#Tổng bài viết đã phê duyệt
$total_approved = db_num_rows("SELECT * FROM `tbl_products_cat` WHERE `cat_status` = 'Approved'");

#Tổng bài viết chờ xét duyệt
$total_waiting = db_num_rows("SELECT * FROM `tbl_products_cat` WHERE `cat_status` = 'Waiting...'");

#Tổng bài viết đã xóa
$total_trash = db_num_rows("SELECT * FROM `tbl_products_cat` WHERE `cat_status` = 'Trash'");

?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <a href="?mod=products&controller=productCat&action=addCat" title="" id="add-new" class="fl-left">Thêm mới</a>
                    <h3 id="index" class="fl-left">Danh mục sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=products&controller=productCat&action=index">Tất cả <span class="count">(<?php echo $total_row; ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=products&controller=productCat&action=index">Đã đăng <span class="count">(<?php echo $total_approved; ?>)</span></a> |</li>
                            <li class="pending"><a href="#">Chờ xét duyệt <span class="count">(<?php echo $total_waiting; ?>)</span> |</a></li>
                            <li class="trash"><a href="#">Thùng rác <span class="count">(<?php echo $total_trash; ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="products">
                            <input type="hidden" name="controller" value="productCat">
                            <input type="hidden" name="action" value="searchProductCat">
                            <input type="text" name="value" id="s" value="<?php echo set_value('value') ?>">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <?php echo form_error('error'); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=products&controller=productCat&action=applyProductCat&cat_id=<?php echo $cat_num;?>">    
                        <div class="actions">   
                            <div class="form-actions">
                                <select name="actions">
                                    <option value="0">Tác vụ</option>
                                    <option <?php if (!empty($_POST['actions']) && $_POST['actions'] == 1) {echo "selected='selected'";}?> value="1">Phê duyệt</option>
                                    <option <?php if (!empty($_POST['actions']) && $_POST['actions'] == 2) {echo "selected='selected'";}?> value="2">Chờ duyệt</option>
                                    <option <?php if (!empty($_POST['actions']) && $_POST['actions'] == 3) {echo "selected='selected'";}?> value="3">Bỏ vào thùng rác</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">
                                <?php echo form_error('select') ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <?php if (!empty($list_product_cat_all)) { 
                                $error = array(); 
                                $num_order = array();
                                $order = 0;
                                foreach($list_product_cat_all as $product_cat_all){
                                $order ++;
                                $num_order['num_order'] =  $order;
                                update_cat($num_order, $product_cat_all['cat_id']);
                            } ?>
                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Tiêu đề</span></td>
                                            <td><span class="thead-text">Thứ tự</span></td>
                                            <td><span class="thead-text">Trạng thái</span></td>
                                            <td><span class="thead-text">Người tạo</span></td>
                                            <td><span class="thead-text">Ngày tạo</span></td>
                                            <td><span class="thead-text">Người sửa</span></td>
                                            <td><span class="thead-text">Ngày sửa</span></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($list_products_cat as $product_cat) { ?>
                                            <tr>
                                            <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $product_cat['cat_id'] ?>"></td>
                                            <td><span class="tbody-text"><?php echo $product_cat['num_order'] ?></h3></span>
                                            <td class="clearfix">
                                                <div class="tb-title fl-left">
                                                    <a href="?mod=products&controller=productCat&action=updateCat&cat_id=<?php echo $product_cat['cat_title'] ?>" title=""><a href="" title=""><?php echo str_repeat('--', $product_cat['level']).' '.$product_cat['cat_title']?></a></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=products&controller=productCat&action=updateCat&cat_id=<?php echo $product_cat['cat_id']?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=products&controller=productCat&action=deleteCat&cat_id=<?php echo $product_cat['cat_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td><span class="tbody-text"><?php if($product_cat['parent_id'] == 0) { echo 0;} else { echo get_num_order($product_cat['parent_id'], $list_product_cat_all);}?></span></td>
                                            <td><span class="tbody-text <?php echo text_color_status($product_cat['cat_status']) ?>"><?php echo $product_cat['cat_status']?></span></td>
                                            <td><span class="tbody-text"><?php echo $product_cat['creator'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $product_cat['create_date'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $product_cat['editor'] ?></span></td>
                                            <td><span class="tbody-text"><?php echo $product_cat['edit_date'] ?></span></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="tfoot-text">STT</span></td>
                                            <td><span class="tfoot-text-text">Tiêu đề</span></td>
                                            <td><span class="tfoot-text">Thứ tự</span></td>
                                            <td><span class="tfoot-text">Trạng thái</span></td>
                                            <td><span class="tfoot-text">Người tạo</span></td>
                                            <td><span class="tfoot-text">Ngày tạo</span></td>
                                            <td><span class="tfoot-text">Người sửa</span></td>
                                            <td><span class="tfoot-text">Ngày sửa</span></td>
                                        </tr>
                                </tfoot>
                                </table>   
                            <?php } else { $error['product_cat'] = "(*) Không tồn tại danh mục sản phẩm nào !"; ?>
                                <p class="error"><?php echo $error['product_cat'] ?></p>
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
                        <?php echo get_pagging($num_page, $cat_num, "?mod=products&controller=productCat&action=index"); ?>    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- Lấy phần footer -->


