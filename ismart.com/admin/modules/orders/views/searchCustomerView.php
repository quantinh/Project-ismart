<?php get_header(); 

//show_array($list_pages);

#Kiểm tra value không trống thì lấy xuống từ url gán cho $value
if(!empty($_GET['value'])){
    $value = $_GET['value'];
}

#Tổng số bản ghi lấy được
$list_customers_all = db_search_all_customers($value);

#Tổng số lượng bảng ghi trên 1 trang
$num_per_page = 4;

#Tổng số bảng ghi từ danh sách tất cả đơn hàng
$total_row = count($list_customers_all);

#Tổng số trang = hàm làm tròn (15/5) = 3
$num_page = ceil($total_row / $num_per_page);
//echo "Số trang: {$num_page} <br>";

#Kiểm tra xem nếu có số trang từ url rồi ,or cho số nguyên mặc định bắt đầu = 1
$page_num = isset($_GET['page_id']) ? (int) $_GET['page_id'] : 1;
//echo "Trang hiện tại: {$page} <br>";

#Tính chỉ số bắt đầu
$start = ($page_num - 1) * $num_per_page;
//echo "Xuất phát: {$start}";

#Tổng số bảng ghi
$order_num = $start;

#Lấy danh sách đơn đặt hàng theo trang 
$list_customers = db_search_customers_by_page($value, $start, $num_per_page);

#Tổng bài viết đã phê duyệt
$total_approved = db_num_rows("SELECT * FROM `tbl_customers`");

#Tổng bài viết chờ xét duyệt
$total_waiting = db_num_rows("SELECT * FROM `tbl_customers`");

#Tổng bài viết đã xóa
$total_trash = db_num_rows("SELECT * FROM `tbl_customers`");
?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Danh sách khách hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=orders&controller=customer&action=index">Tất cả <span class="count">(<?php echo $total_row; ?>)</span></a> |</li>
                            <li class="publish"><a href="?mod=orders&controller=customer&action=index">Đã đăng <span class="count">(<?php echo $total_approved; ?>)</span></a> |</li>
                            <li class="pending"><a href="#">Chờ xét duyệt <span class="count">(<?php echo $total_waiting; ?>)</span> |</a></li>
                            <li class="trash"><a href="#">Thùng rác <span class="count">(<?php echo $total_trash; ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="orders">
                            <input type="hidden" name="controller" value="customer">
                            <input type="hidden" name="action" value="searchCustomer">
                            <input type="text" name="value" id="s" value="<?php echo set_value('value') ?>">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <?php echo form_error('error'); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=orders&controller=customer&action=applyCustomer&customer_id=<?php echo $page_num;?>">    
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
                        <div class="table-responsive">
                            <?php if (!empty($list_customers)) { $error = array();?>
                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Họ và tên</span></td>
                                            <td><span class="thead-text">Số điện thoại</span></td>
                                            <td><span class="thead-text">Email</span></td>
                                            <td><span class="thead-text">Địa chỉ</span></td>
                                            <td><span class="thead-text">Đơn hàng</span></td>
                                            <td><span class="thead-text">Thời gian</span></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  $temp = $start; foreach ($list_customers as $customer) { $temp ++; ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $Customer['customer_id'] ?>"></td>
                                                <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=orders&controller=customer&action=updateCustomer&customer_id=<?php echo $customer['customer_id'] ?>" title=""><?php echo $customer['customer_name'] ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=orders&controller=customer&action=updateCustomer&customer_id=<?php echo $customer['customer_id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=orders&controller=customer&action=deleteCustomer&customer_id=<?php echo $customer['customer_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $customer['phone'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $customer['email'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $customer['address'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $num_order ?></span></td>
                                                <td><span class="tbody-text"><?php echo $customer['create_date'] ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="tfoot-text">STT</span></td>
                                            <td><span class="tfoot-text">Họ và tên</span></td>
                                            <td><span class="tfoot-text">Số số điện</span></td>
                                            <td><span class="tfoot-text">Email</span></td>
                                            <td><span class="tfoot-text">Địa chỉ</span></td>
                                            <td><span class="tfoot-text">Đơn hàng</span></td>
                                            <td><span class="tfoot-text">Thời gian</span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            <?php } else { $error['customer'] = "(*) Không có khách hàng nào !"; ?>
                                <p class="error"><?php echo $error['customer'] ?></p>
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
                         <?php echo get_pagging($num_page, $page_num, "?mod=orders&controller=customer&action=index"); ?>    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- Lấy phần footer -->


