<?php get_header(); 

#Tổng số lượng bảng ghi trên 1 trang
$num_per_page = 6;

#Kiểm tra xem nếu có số bài viết từ url rồi ,or cho số nguyên mặc định bắt đầu = 1
$page_num = isset($_GET['page_id']) ? (int) $_GET['page_id'] : 1;
// echo "Trang hiện tại: {$page_num} <br>";

#Tính chỉ số bắt đầu
$start = ($page_num - 1) * $num_per_page;
// echo "Xuất phát: {$start}";

#Tổng số bảng ghi
$order_num = $start;

#Lấy danh sách bài viết theo chỉ số
$list_orders = get_orders($start, $num_per_page);

#Lấy danh sách đặt hàng
$list_num_post = db_num_page('tbl_orders', $num_per_page);

#Tổng số bảng ghi lấy từ database 
$total_row = db_num_rows("SELECT * FROM `tbl_orders`");

#Tổng số trang = hàm làm tròn (15/5) = 3
$num_page = ceil($total_row / $num_per_page);
//echo "Số trang: {$num_page} <br>";

#Tổng đơn hàng đã đặt thành công
$total_approved = db_num_rows("SELECT * FROM `tbl_orders` WHERE `order_status` = 'Thành công'");

#Tổng đơn hàng đang trong quá trình vận chuyển
$total_waiting = db_num_rows("SELECT * FROM `tbl_orders` WHERE `order_status` = 'Đang vận chuyển'");

#Tổng đơn hàng hủy
$total_trash = db_num_rows("SELECT * FROM `tbl_orders` WHERE `order_status` = 'Hủy đơn hàng'");

?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=orders&controller=index&action=index">Tất cả <span class="count">(<?php echo $total_row; ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=orders&controller=index&action=index">Đã đăng <span class="count">(<?php echo $total_approved; ?>)</span></a> |</li>
                            <li class="pending"><a href="#">Đang vận chuyển <span class="count">(<?php echo $total_waiting; ?>)</span> |</a></li>
                            <li class="trash"><a href="#">Hủy đơn hàng <span class="count">(<?php echo $total_trash; ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="orders">
                            <input type="hidden" name="controller" value="index">
                            <input type="hidden" name="action" value="searchOrder">
                            <input type="text" name="value" id="s" value="<?php echo set_value('value') ?>">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <?php echo form_error('error'); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=orders&controller=index&action=applyOrder&order_id=<?php echo $page_num;?>">    
                        <div class="actions">   
                            <div class="form-actions">
                                <select name="actions">
                                    <option value="0">Tác vụ</option>
                                    <option <?php if (!empty($_POST['actions']) && $_POST['actions'] == 1) {echo "selected='selected'";}?> value="1">Thành công</option>
                                    <option <?php if (!empty($_POST['actions']) && $_POST['actions'] == 2) {echo "selected='selected'";}?> value="2">Đang vận chuyển</option>
                                    <option <?php if (!empty($_POST['actions']) && $_POST['actions'] == 3) {echo "selected='selected'";}?> value="3">Hủy đơn hàng</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">
                                <?php echo form_error('select') ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <?php if (!empty($list_orders)) { $error = array();?>
                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Mã đơn hàng</span></td>
                                            <td><span class="thead-text">Họ và tên</span></td>
                                            <td><span class="thead-text">Số sản phẩm</span></td>
                                            <td><span class="thead-text">Tổng giá</span></td>
                                            <td><span class="thead-text">Trạng thái</span></td>
                                            <td><span class="thead-text">Thời gian</span></td>
                                            <td><span class="thead-text">Chi tiết</span></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  $temp = $start; foreach ($list_orders as $order) { $temp ++; ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $order['order_id'] ?>"></td>
                                                <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                                <td><span class="tbody-text"><?php echo $order['order_code'] ?></h3></span>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=orders&controller=index&action=updateOrder&order_id=<?php echo $order['order_id'] ?>" title=""><?php echo $order['customer_name'] ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=orders&controller=index&action=updateOrder&order_id=<?php echo $order['order_id']?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=orders&controller=index&action=deleteOrder&order_id=<?php echo $order['order_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $order['total_num'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo currency_format($order['total_price']) ?></span></td>
                                                <td><span class="tbody-text <?php echo text_color_status($order['order_status']) ?>"><?php echo $order['order_status']?></span></td>
                                                <td><span class="tbody-text"><?php echo $order['create_date'] ?></span></td>
                                                <td><a href="?mod=orders&controller=index&action=detailOrder&order_id=<?php echo $order['order_id'] ?>" title="" class="tbody-text">Chi tiết</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="tfoot-text">STT</span></td>
                                            <td><span class="tfoot-text">Mã đơn hàng</span></td>
                                            <td><span class="tfoot-text">Họ và tên</span></td>
                                            <td><span class="tfoot-text">Số sản phẩm</span></td>
                                            <td><span class="tfoot-text">Tổng giá</span></td>
                                            <td><span class="tfoot-text">Trạng thái</span></td>
                                            <td><span class="tfoot-text">Thời gian</span></td>
                                            <td><span class="tfoot-text">Chi tiết</span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            <?php } else { $error['order'] = "(*) Không có đơn đặt hàng nào !"; ?>
                                <p class="error"><?php echo $error['order'] ?></p>
                            <?php } ?>
                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="paging-wp">
                <div class="section-detail clearfix">
                    <p id="desc" class="fl-left">Chọn vào checkbox để lựa chọn tất cả</p>
                    <ul id="list-paging" class="fl-right">
                         <!-- Hiển thị số đặt hàng được lấy từ hàm xử lí bên pagging.php -->
                         <?php echo get_pagging($num_page, $page_num, "?mod=orders&controller=index&action=index"); ?>    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- Lấy phần footer -->


