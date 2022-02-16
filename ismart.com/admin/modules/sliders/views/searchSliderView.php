<?php get_header();

//show_array($list_pages);

#Kiểm tra value không trống thì lấy xuống từ url gán cho $value
if(!empty($_GET['value'])){
    $value = $_GET['value'];
}

#Tổng số bản ghi lấy được
$list_sliders_all = db_search_all_sliders($value);

#Tổng số lượng bảng ghi trên 1 trang
$num_per_page = 4;

#Tổng số bảng ghi từ danh sách tất cả admin 
$total_row = count($list_sliders_all);

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

#Lấy danh sách admin theo trang 
$list_pages = db_search_sliders_by_page($value, $start, $num_per_page);

#Tổng bài viết đã phê duyệt
$total_approved = db_num_rows("SELECT * FROM `tbl_sliders` WHERE `slider_status` = 'Approved' AND `slider_title` LIKE '%$value%' OR `slider_status` LIKE '%$value%'");

#Tổng bài viết chờ xét duyệt
$total_waiting = db_num_rows("SELECT * FROM `tbl_sliders` WHERE `slider_status` = 'Waiting...' AND `slider_title` LIKE '%$value%' OR `slider_status` LIKE '%$value%'");

#Tổng bài viết đã xóa
$total_trash = db_num_rows("SELECT * FROM `tbl_sliders` WHERE `slider_status` = 'Trash' AND `slider_title` LIKE '%$value%' OR `slider_status` LIKE '%$value%'");

?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="list-product-page list-slider">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">           
            <div class="section" id="title-page">
                <div class="clearfix">
                    <a href="?mod=sliders&controller=index&action=addSlider" title="Thêm slider mới" id="add-new" class="fl-left">Thêm mới</a>
                    <h3 id="index" class="fl-left">Danh sách slider</h3>
                </div>
            </div>            
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <div class="filter-wp clearfix">
                        <ul class="post-status fl-left">
                            <li class="all"><a href="?mod=sliders&controller=index&action=index">Tất cả <span class="count">(<?php echo $total_row; ?>)</span></a> |</li>
                            <li class="publish"><a href="">Đã đăng <span class="count">(<?php echo $total_approved; ?>)</span></a> |</li>
                            <li class="pending"><a href="">Chờ xét duyệt <span class="count">(<?php echo $total_waiting; ?>)</span> |</a></li>
                            <li class="trash"><a href="">Thùng rác <span class="count">(<?php echo $total_trash; ?>)</span></a></li>
                        </ul>
                        <form method="GET" class="form-s fl-right">
                            <input type="hidden" name="mod" value="sliders">
                            <input type="hidden" name="controller" value="index">
                            <input type="hidden" name="action" value="searchSlider">
                            <input type="text" name="value" id="s" value="<?php echo set_value('value') ?>">
                            <input type="submit" name="sm_s" value="Tìm kiếm">
                            <?php echo form_error('error'); ?>
                        </form>
                    </div>
                    <form method="POST" action="?mod=sliders&controller=index&action=applySlider&slider_id=<?php echo $page_num;?>">    
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
                            <?php if (!empty($list_sliders)) { $error = array();?>
                                <table class="table list-table-wp">
                                    <thead>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="thead-text">STT</span></td>
                                            <td><span class="thead-text">Hình ảnh</span></td>
                                            <td><span class="thead-text">Tên Slider</span></td>
                                            <td><span class="thead-text">Link</span></td>
                                            <td><span class="thead-text">Thứ tự</span></td>
                                            <td><span class="thead-text">Trạng thái</span></td>
                                            <td><span class="thead-text">Người tạo</span></td>
                                            <td><span class="thead-text">Thời gian tạo</span></td>
                                            <td><span class="thead-text">Người sửa</span></td>
                                            <td><span class="thead-text">Thời gian sửa</span></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php  $temp = $start; foreach ($list_sliders as $slider) { $temp ++; ?>
                                            <tr>
                                                <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $slider['slider_id'] ?>"></td>
                                                <td><span class="tbody-text"><?php echo $temp ?></h3></span>
                                                <td>
                                                    <div class="tbody-thumb">
                                                        <a href="?mod=sliders&controller=index&action=updateSlider&slider_id=<?php echo $slider['slider_id'] ?>"><img src="<?php if(!empty($slider['slider_thumb'])){echo $slider['slider_thumb'];} else{ echo 'public/images/img-product.png';}?>" alt=""></a>
                                                    </div>
                                                </td>
                                                <td><a href="?mod=sliders&controller=index&action=updateSlider&slider_id=<?php echo $slider['slider_id']?>"><span class="tbody-text"><?php echo $slider['slider_title'] ?></span></a></td>
                                                <td class="clearfix">
                                                    <div class="tb-title fl-left">
                                                        <a href="?mod=sliders&controller=index&action=updateSlider&slider_id=<?php echo $slider['slider_link'] ?>" title=""><?php echo $slider['slider_link'] ?></a>
                                                    </div>
                                                    <ul class="list-operation fl-right">
                                                        <li><a href="?mod=sliders&controller=index&action=updateSlider&slider_id=<?php echo $slider['slider_id']?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                        <li><a href="?mod=sliders&controller=index&action=deleteSlider&slider_id=<?php echo $slider['slider_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                    </ul>
                                                </td>
                                                <td><span class="tbody-text"><?php echo $slider['num_order'] ?></span></td>
                                                <td><span class="tbody-text <?php echo text_color_status($slider['slider_status']) ?>"><?php echo $slider['slider_status']?></span></td>
                                                <td><span class="tbody-text"><?php echo $slider['creator'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $slider['create_date'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $slider['editor'] ?></span></td>
                                                <td><span class="tbody-text"><?php echo $slider['edit_date'] ?></span></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                            <td><span class="tfoot-text">STT</span></td>
                                            <td><span class="tfoot-text">Hình ảnh</span></td>
                                            <td><span class="tfoot-text">Tên Slider</span></td>
                                            <td><span class="tfoot-text">Link</span></td>
                                            <td><span class="tfoot-text">Thứ tự</span></td>
                                            <td><span class="tfoot-text">Trạng thái</span></td>
                                            <td><span class="tfoot-text">Người tạo</span></td>
                                            <td><span class="tfoot-text">Thời gian tạo</span></td>
                                            <td><span class="thead-text">Người sửa</span></td>
                                            <td><span class="thead-text">Thời gian sửa</span></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            <?php } else { $error['slider'] = "(*) Không có slider nào !"; ?>
                                <p class="error"><?php echo $error['slider'] ?></p>
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
                         <?php echo get_pagging($num_page, $page_num, "?mod=sliders&controller=index&action=index"); ?>    
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<!-- Lấy phần footer -->