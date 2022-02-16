<?php get_header(); 

#Tổng số lượng bảng ghi trên 1 trang
$num_per_page = 5;

#Kiểm tra xem nếu có số bài viết từ url rồi ,or cho số nguyên mặc định bắt đầu = 1
$page_num = isset($_GET['page_id']) ? (int) $_GET['page_id'] : 1;
// echo "Trang hiện tại: {$product_num} <br>";

#Tính chỉ số bắt đầu
$start = ($page_num - 1) * $num_per_page;
// echo "Xuất phát: {$start}";

#Chỉ số bắt đầu
$order_num = $start;

#Lấy danh sách bài viết theo chỉ số
$list_products = get_products($start, $num_per_page);

#Lấy danh sách trang
$list_num_product = db_num_page('tbl_products', $num_per_page);

#Tổng số bảng ghi lấy từ database 
$total_row = db_num_rows("SELECT * FROM `tbl_products`");

#Tổng số trang = hàm làm tròn (15/5) = 3
$num_page = ceil($total_row / $num_per_page);
//echo "Số trang: {$num_page} <br>";

#Tổng bài viết đã phê duyệt
$total_approved = db_num_rows("SELECT * FROM `tbl_products` WHERE `product_status` = 'Approved'");

#Tổng bài viết chờ xét duyệt
$total_waiting = db_num_rows("SELECT * FROM `tbl_products` WHERE `product_status` = 'Waiting...'");

#Tổng bài viết đã xóa
$total_trash = db_num_rows("SELECT * FROM `tbl_products` WHERE `product_status` = 'Trash'");

?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="list-product-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <a href="?mod=products&controller=index&action=addProduct" title="" id="add-new" class="fl-left">Thêm mới</a>
                    <h3 id="index" class="fl-left">Danh sách sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=products&controller=index&action=index">Tất cả <span class="count">(<?php echo $total_row; ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=products&controller=index&action=index">Đã đăng <span class="count">(<?php echo $total_approved; ?>)</span></a> |</li>
                            <li class="pending"><a href="#">Chờ xét duyệt <span class="count">(<?php echo $total_waiting; ?>)</span> |</a></li>
                            <li class="trash"><a href="#">Thùng rác <span class="count">(<?php echo $total_trash; ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="products">
                            <input type="hidden" name="controller" value="index">
                            <input type="hidden" name="action" value="searchProduct">
                            <input type="text" name="value" id="s" value="<?php echo set_value('value') ?>">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <?php echo form_error('error'); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=products&controller=index&action=applyProduct&product_id=<?php echo $page_num;?>">    
                        <div class="actions">   
                            <div class="form-actions">
                                <select name="actions">
                                    <option value="0">Tác vụ</option>
                                    <option <?php if (!empty($_POST['actions']) && $_POST['actions'] == 1) {echo "selected='selected'";}?> value="1">Công khai</option>
                                    <option <?php if (!empty($_POST['actions']) && $_POST['actions'] == 2) {echo "selected='selected'";}?> value="2">Chờ duyệt</option>
                                    <option <?php if (!empty($_POST['actions']) && $_POST['actions'] == 3) {echo "selected='selected'";}?> value="3">Bỏ vào thùng rác</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">
                                <?php echo form_error('select') ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table list-table-wp">
                                <thead>
                                    <tr>
                                        <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                        <td><span class="thead-text">STT</span></td>
                                        <td><span class="thead-text">Mã sản phẩm</span></td>
                                        <td><span class="thead-text">Hình ảnh</span></td>
                                        <td><span class="thead-text">Tên sản phẩm</span></td>
                                        <td><span class="thead-text">Giá mới</span></td>
                                        <td><span class="thead-text">Giá cũ</span></td>
                                        <td><span class="thead-text">Danh mục</span></td>
                                        <td><span class="thead-text">Kho hàng</span></td>
                                        <td><span class="thead-text">Đã bán</span></td>
                                        <td><span class="thead-text">Trạng thái</span></td>
                                        <td><span class="thead-text">Người tạo</span></td>
                                        <td><span class="thead-text">Thời gian</span></td>
                                    </tr>
                                </thead>
                                <?php if (!empty($list_products)) { 
                                    $error = array(); 
                                    $order = 0;
                                ?>
                                    <tbody>
                                        <?php foreach ($list_products as $product) {
                                            $data = array();
                                            $order ++;
                                            $sum_product_sold = get_sum_sold_product($product['product_id']);
                                            $data['product_sold'] =  $sum_product_sold;
                                            update_product($data, $product['product_id']);
                                        ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $product['product_id'] ?>"></td>
                                                <td><span class="tbody-text"><?php echo $order ?></h3></span>
                                                <td><span class="tbody-text"><?php echo $product['product_code'] ?></h3></span>
                                                <td>
                                                    <div class="tbody-thumb">
                                                        <a href="?mod=products&controller=index&action=updateProduct&product_id=<?php echo $product['product_id'] ?>"><img src="<?php if(!empty($product['product_thumb'])){echo $product['product_thumb'];} else{ echo 'public/images/avatar/img-product.png';}?>" alt=""></a>
                                                    </div>
                                                </td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=products&controller=index&action=updateProduct&product_id=<?php echo $product['product_id'] ?>" title=""><?php echo $product['product_title'] ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=products&controller=index&action=updateProduct&product_id=<?php echo $product['product_id']?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=products&controller=index&action=deleteProduct&product_id=<?php echo $product['product_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo currency_format($product['product_price_new']) ?></span></td>
                                                <td><span class="tbody-text"><?php if(!empty($product['product_price_old'])) echo currency_format($product['product_price_old']) ?></span></td>
                                                <td><span class="tbody-text"><?php echo $product['parent_cat'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $product['product_num'] ?></span></td>
                                                <td><span class="tbody-text"><?php if(!empty($product['product_sold'])) {echo $product['product_sold'];} else { echo 0; }?></span></td>
                                                <td><span class="tbody-text <?php echo text_color_status($product['product_status']) ?>"><?php echo $product['product_status'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $product['creator'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $product['create_date'] ?></span></td>
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                    </tbody>
                                <?php } else { $error['product'] = "(*) Không tồn tại sản phẩm nào !"; ?>
                                    <p class="error"><?php echo $error['product'] ?></p>
                                <?php } ?>
                                <tfoot>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="tfoot-text">STT</span></td>
                                            <td><span class="tfoot-text">Mã sản phẩm</span></td>
                                            <td><span class="tfoot-text">Hình ảnh</span></td>
                                            <td><span class="tfoot-text">Tên sản phẩm</span></td>
                                            <td><span class="tfoot-text">Giá mới</span></td>
                                            <td><span class="tfoot-text">Gía cũ</span></td>
                                            <td><span class="tfoot-text">Danh mục</span></td>
                                            <td><span class="tfoot-text">Kho hàng</span></td>
                                            <td><span class="tfoot-text">Đã bán</span></td>
                                            <td><span class="tfoot-text">Trạng thái</span></td>
                                            <td><span class="tfoot-text">Ngày tạo</span></td>
                                            <td><span class="tfoot-text">Thời gian</span></td>
                                        </tr>
                                </tfoot>
                            </table>   
                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                        <!-- Hiển thị số trang được lấy từ hàm xử lí bên pagging.php -->
                        <?php echo get_pagging($num_page, $page_num, "?mod=products&controller=index&action=index"); ?>    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- Lấy phần footer -->


