<?php get_header();

#Tổng số lượng bảng ghi trên 1 trang
$num_per_page = 4;

#Kiểm tra xem nếu có số trang từ url rồi ,or cho số nguyên mặc định bắt đầu = 1
$page_num = isset($_GET['page_id']) ? (int) $_GET['page_id'] : 1;
//echo "Trang hiện tại: {$page_num} <br>";

#Tính chỉ số bắt đầu
$start = ($page_num - 1) * $num_per_page;
//echo "Xuất phát: {$start}";

#Tổng số bảng ghi
$order_num = $start;

$list_admins = get_admins($start, $num_per_page);

#Lấy danh sách trang
$list_num_page = db_num_page('tbl_admins', $num_per_page);

#Tổng số bảng ghi lấy từ database 
$total_row = db_num_rows("SELECT * FROM `tbl_admins`");

#Tổng số trang = hàm làm tròn (15/5) = 3
$num_page = ceil($total_row / $num_per_page);
//echo "Số trang: {$num_page} <br>";

#Tổng bài viết đã phê duyệt
$total_approved = db_num_rows("SELECT * FROM `tbl_admins` WHERE `admin_status` = 'Approved'");

#Tổng bài viết chờ xét duyệt
$total_waiting = db_num_rows("SELECT * FROM `tbl_admins` WHERE `admin_status` = 'Waiting...'");

#Tổng bài viết đã xóa
$total_trash = db_num_rows("SELECT * FROM `tbl_admins` WHERE `admin_status` = 'Trash'");

?>
<!-- lấy phần header -->
<div id="main-content-wp" class="list-post-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=users&controller=team&action=addAdmin" title="" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Nhóm quản trị viên</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar('users');?>
        <!-- lấy phần sidebar -->
        <div id="content" class="fl-right">
            <div class="section" id="detail-page">
                <div class="section-detail">
                        <div class="filter-wp clearfix">
                            <ul class="post-status fl-left">
                                <li class="all"><a href="">Tất cả<span class="count">(<?php echo $total_row; ?>)</span></a> |</li>
                                <li class="publish"><a href="">Đã phê duyệt<span class="count">(<?php echo $total_approved; ?>)</span></a> |</li>
                                <li class="pending"><a href="">Chờ xét duyệt<span class="count">(<?php echo $total_waiting; ?>)</span></a></li>
                                <li class="trash"><a href="">Thùng rác<span class="count">(<?php echo $total_trash; ?>)</span></a></li>
                            </ul>
                            <form method="GET" class="form-s fl-right" action="">
                                <input type="hidden" name="mod" value="users">
                                <input type="hidden" name="controller" value="team">
                                <input type="hidden" name="action" value="searchAdmin">
                                <input type="text" name="value" id="s" value="<?php echo set_value('value') ?>">
                                <input type="submit" name="sm_s" value="Tìm kiếm">
                                <?php echo form_error('error'); ?>
                            </form>
                        </div>
                        <form method="POST" action="?mod=users&controller=team&action=applyAdmin&page_id=<?php echo $page_num;?>">    
                            <div class="actions">
                                <div class="form-actions">
                                    <select name="action">
                                        <option value="0">Tác vụ</option>
                                        <option <?php if (!empty($_POST['action']) && $_POST['action'] == 1) {echo "selected='selected'";}?> value="1">Phê duyệt</option>
                                        <option <?php if (!empty($_POST['action']) && $_POST['action'] == 2) {echo "selected='selected'";}?> value="2">Chờ duyệt</option>
                                        <option <?php if (!empty($_POST['action']) && $_POST['action'] == 3) {echo "selected='selected'";}?> value="3">Bỏ vào thùng rác</option>
                                    </select>
                                    <input type="submit" name="sm_action" value="Áp dụng">
                                    <?php echo form_error('select') ?>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <?php if (!empty($list_admins)) { $error = array();?>
                                    <table class="table list-table-wp">
                                        <thead>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">STT</span></td>
                                                <td><span class="thead-text">Ảnh đại diện</span></td>
                                                <td><span class="thead-text">Tên người dùng</span></td>
                                                <td><span class="thead-text">Họ và tên</span></td>
                                                <td><span class="thead-text">Email</span></td>
                                                <td><span class="thead-text">Số điện thoại</span></td>
                                                <td><span class="thead-text">Địa chỉ</span></td>
                                                <td><span class="thead-text">Trạng thái</span></td>
                                                <td><span class="thead-text">Hoạt động</span></td>
                                                <td><span class="thead-text">Ngày đăng kí</span></td>
                                                <td><span class="thead-text">Phân quyền</span></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  $temp = $start; foreach ($list_admins as $admin) { $temp ++; ?>
                                                <tr>
                                                    <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $admin['admin_id'] ?>"></td>
                                                    <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                                    <td>
                                                    <div class="tbody-thumb">
                                                        <a href="<?php if (!empty($admin['avatar'])) { echo $admin['avatar']; } else { echo 'public/images/avatar/img-thumb.png'; }?>"><img src="<?php if (!empty($admin['avatar'])) { echo $admin['avatar']; } else { echo 'public/images/avatar/img-thumb.png'; }?>" alt=""></a>
                                                    </div>
                                                    </td>
                                                    <td class="clearfix">
                                                        <div class="tb-title fl-left">
                                                            <a href="?mod=users&controller=team&action=updateAdmin&admin_id=<?php echo $admin['admin_id']?>" title="cập nhập"><?php echo $admin['username']?></a>
                                                        </div>
                                                        <ul class="list-operation fl-right">
                                                            <li><a href="?mod=users&controller=team&action=updateAdmin&admin_id=<?php echo $admin['admin_id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                            <li><a href="?mod=users&controller=team&action=deleteAdmin&admin_id=<?php echo $admin['admin_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                        </ul>
                                                    </td>
                                                    <td><span class="tbody-text"><?php echo $admin['fullname'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $admin['email'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $admin['tel'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $admin['address'] ?></span></td>
                                                    <td><span class="tbody-text <?php echo text_color_status($admin['admin_status']) ?>"><?php echo $admin['admin_status']?></span></td>
                                                    <td><span class="tbody-text"><?php echo $admin['active'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $admin['reg_date'] ?></span></td>
                                                    <td><span class="tbody-text"><?php echo $admin['role'] ?></span></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                                <td><span class="thead-text">STT</span></td>
                                                <td><span class="thead-text">Ảnh đại diện</span></td>
                                                <td><span class="thead-text">Tên người dùng</span></td>
                                                <td><span class="thead-text">Họ và tên</span></td>
                                                <td><span class="thead-text">Email</span></td>
                                                <td><span class="thead-text">Số điện thoại</span></td>
                                                <td><span class="thead-text">Địa chỉ</span></td>
                                                <td><span class="thead-text">Trạng thái</span></td>
                                                <td><span class="thead-text">Hoạt động</span></td>
                                                <td><span class="thead-text">Ngày đăng kí</span></td>
                                                <td><span class="thead-text">Phân quyền</span></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                <?php } else { $error['admin'] = "(*) Không có admin nào !"; ?>
                                    <p class="error"><?php echo $error['admin'] ?></p>
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
                        <?php echo get_pagging($num_page, $page_num, "?mod=users&controller=team&action=index"); ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- lấy phần footer -->

