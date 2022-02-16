<?php get_header(); 

#Tổng số lượng bảng ghi trên 1 trang
$num_per_page = 6;

#Kiểm tra xem nếu có số trang từ url rồi ,or cho số nguyên mặc định bắt đầu = 1
$page_num = isset($_GET['page_id']) ? (int) $_GET['page_id'] : 1;
// echo "Trang hiện tại: {$page_num} <br>";

#Tính chỉ số bắt đầu
$start = ($page_num - 1) * $num_per_page;
// echo "Xuất phát: {$start}";

#Tổng số bảng ghi
$order_num = $start;

$list_blocks = get_blocks($start, $num_per_page);

#Lấy danh sách trang
$list_num_block = db_num_page('tbl_blocks', $num_per_page);

#Tổng số bảng ghi lấy từ database 
$total_row = db_num_rows("SELECT * FROM `tbl_blocks`");

#Tổng số trang = hàm làm tròn (15/5) = 3
$num_page = ceil($total_row / $num_per_page);
//echo "Số trang: {$num_page} <br>";
?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="list-post-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">           
            <div class="section" id="title-page">
                <div class="clearfix">
                    <a href="?mod=blocks&controller=index&action=addWidget" title="Thêm trang mới" id="add-new" class="fl-left">Thêm mới</a>
                    <h3 id="index" class="fl-left">Danh sách khối</h3>
                </div>
            </div>            
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=blocks&controller=index&action=index">Tất cả <span class="count">(<?php echo $total_row; ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="blocks">
                            <input type="hidden" name="controller" value="index">
                            <input type="hidden" name="action" value="searchWidget">
                            <input type="text" name="value" id="s" value="<?php echo set_value('value') ?>">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <?php echo form_error('error'); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=blocks&controller=index&action=applyWidget&block_id=<?php echo $page_num;?>">    
                        <div class="actions">   
                            <div class="form-actions">
                                <select name="actions">
                                    <option value="0">Tác vụ</option>
                                    <option <?php if (!empty($_POST['actions']) && $_POST['actions'] == 1) { echo "selected='selected'";}?> value="1">Xóa</option>
                                </select>
                                <input type="submit" name="sm_action" value="Áp dụng">
                                <?php echo form_error('select') ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <?php if (!empty($list_blocks)) { $error = array();?>
                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Tên khối</span></td>
                                            <td><span class="thead-text">Mã khối</span></td>
                                            <td><span class="thead-text">Người tạo</span></td>
                                            <td><span class="thead-text">Thời gian</span></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $temp = $start; foreach ($list_blocks as $block) { $temp ++; ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $block['block_id'] ?>"></td>
                                                <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=blocks&controller=index&action=updateWidget&block_id=<?php echo $block['block_id'] ?>" title=""><?php echo $block['block_title'] ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=blocks&controller=index&action=updateWidget&block_id=<?php echo $block['block_id']?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=blocks&controller=index&action=deleteWidget&block_id=<?php echo $block['block_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $block['block_code'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $block['creator'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $block['create_date'] ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="tfoot-text">STT</span></td>
                                            <td><span class="tfoot-text">Tên khối</span></td>
                                            <td><span class="tfoot-text">Mã khối</span></td>
                                            <td><span class="tfoot-text">Người tạo</span></td>
                                            <td><span class="tfoot-text">Thời gian</span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            <?php } else { $error['block'] = "(*) Không có khối nào !"; ?>
                                <p class="error"><?php echo $error['block'] ?></p>
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
                         <?php echo get_pagging($num_page, $page_num, "?mod=blocks&controller=index&action=index"); ?>    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<!-- Lấy phần footer -->