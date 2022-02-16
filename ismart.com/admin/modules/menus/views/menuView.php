<?php get_header();

#Lấy danh sách trang từ csdl
$list_page = db_fetch_array("SELECT * FROM `tbl_pages`");

#lấy dữ liệu danh mục từ csdl
$data_product_cat = db_fetch_array("SELECT * FROM `tbl_products_cat`");
$list_product_cat_all = data_tree($data_product_cat, 0);

#lấy dữ liệu danh mục từ csdl
$data_post_cat = db_fetch_array("SELECT * FROM `tbl_posts_cat`");
$list_post_cat_all = data_tree($data_post_cat, 0);

#lấy dữ liệu menu từ csdl
$data_menu = db_fetch_array("SELECT * FROM `tbl_menus`");
$list_menu = db_fetch_array("SELECT * FROM `tbl_menus`");

?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="add-cat-page menu-page">
    <div class="section" id="title-page">
        <div class="clearfix">
            <a href="?mod=menus&controller=index&action=addMenu" title="Thêm menu" id="add-new" class="fl-left">Thêm mới</a>
            <h3 id="index" class="fl-left">Menu</h3>
        </div>
    </div>
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">
            <div class="section-detail clearfix">
                <div id="list-menu" class="fl-left">
                    <?php echo form_error('menu'); ?>
                        <form  method="POST" action="?mod=menus&controller=index&action=addMenu">
                            <div class="form-group">
                                <label for="menu_title">Tên menu</label>
                                <input type="text" name="menu_title" id="title" value="<?php echo set_value('menu_title'); ?>">
                            </div>
                            <p class='mess_error'><?php echo form_error('menu_title'); ?></p>

                            <div class="form-group">
                                <label for="url-static">Đường dẫn tĩnh</label>
                                <input type="text" name="menu_url_static" id="url-static" value="<?php echo set_value('menu_url_static'); ?>">
                                <p>Chuỗi đường dẫn tĩnh cho menu</p>
                            </div>
                            <p class='mess_error'><?php echo form_error('menu_url_static'); ?></p>
                            
                            <div class="form-group clearfix">
                                <label>Trang</label>
                                <?php if(!empty($list_page)) { ?>
                                    <select name="page_slug">
                                        <option value="0">-- Chọn --</option>
                                        <?php foreach($list_page as $page) { ?>
                                            <option <?php if(!empty($_POST['page_slug']) && $_POST['page_slug'] == $page['page_title'] ) echo "selected = 'selected'"; ?> value="<?php echo $page['page_title']; ?>"><?php echo $page['page_title']?></option>
                                        <?php } ?>
                                    </select>
                                <?php } ?>
                                <p>Trang liên kết đến menu</p>
                            </div>

                            <div class="form-group clearfix">
                                <label>Danh mục sản phẩm</label>
                                <?php if(!empty($list_product_cat_all)) { ?>
                                    <select name="product_id">
                                        <option value="0">-- Chọn --</option>
                                        <?php foreach($list_product_cat_all as $product_cat) { ?>
                                            <option <?php if(!empty($_POST['product_id']) && $_POST['product_id'] == $product_cat['cat_title']) echo "selected='selected'"; ?> value="<?php echo $product_cat['cat_title']?>"><?php echo str_repeat('--', $product_cat['level']).' '.$product_cat['cat_title']?></option>
                                        <?php } ?>
                                    </select>
                                <?php } ?>
                                <p>Danh mục sản phẩm liên kết đến menu</p>
                            </div>

                            <div class="form-group clearfix">
                                <label>Danh mục bài viết</label>
                                <?php if(!empty($list_post_cat_all)) { ?>
                                    <select name="post_id">
                                        <option value="0">-- Chọn --</option>
                                        <?php foreach($list_post_cat_all as $post_cat) { ?>
                                            <option <?php if(!empty($_POST['post_id']) && $_POST['post_id'] == $post_cat['cat_title']) echo "selected='selected'"; ?> value="<?php echo $post_cat['cat_id']?>"><?php echo str_repeat('--', $post_cat['level']).' '.$post_cat['cat_title']?></option>
                                        <?php } ?>
                                    </select>
                                <?php } ?>
                                <p>Danh mục bài viết liên kết đến menu</p>
                            </div>

                            <div class="form-group">
                                <label for="menu-order">Thứ tự</label>
                                <input type="number" name="menu_order" min="1" max="100" id="menu-order" value="<?php set_value('num_order'); ?>">
                            </div>
                            <?php echo form_error('menu_order'); ?>
                        
                            <div class="form-group">
                                <button type="submit" name="btn-add-menu" id="btn-save-list">Cập nhập</button>
                            </div>
                        </form>
                </div>

                <form method="POST" id="category-menu" class="fl-right" action="?mod=menus&controller=index&action=applyMenu">
                    <div class="actions">
                        <select name="actions">
                            <option value="0">Tác vụ</option>
                            <option <?php if(!empty($_POST['actions']) && $_POST['actions'] == 1 ) echo "selected = 'selected'" ?> value="1">Xóa vĩnh viễn</option>
                        </select>
                        <button type="submit" name="sm_action" id="sm-block-status">Áp dụng</button>
                        <?php echo form_error('actions'); ?>
                    </div>
                    <div class="table-responsive">
                        <table class="table list-table-wp">
                            <thead>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên menu</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Slug static</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                </tr>
                            </thead>
                            <?php if(!empty($list_menu)) { 
                                $error = array();
                                $order = 0;
                            ?>
                                <tbody>
                                    <?php foreach($list_menu as $menu) { $order ++; ?>
                                        <tr>
                                            <td><input type="checkbox" name="checkItem[]" class="checkItem" value="<?php echo $menu['menu_id'] ?>"></td>
                                            <td><span class="tbody-text"><?php echo $order; ?></span>
                                            <td>
                                                <div class="tb-title fl-left">
                                                    <a href="?mod=menus&controller=index&action=updateMenu&menu_id=<?php echo $menu['menu_id'] ?>" title=""><?php echo $menu['menu_title'] ?></a>
                                                </div>
                                                <ul class="list-operation fl-right">
                                                    <li><a href="?mod=menus&controller=index&action=updateMenu&menu_id=<?php echo $menu['menu_id'] ?>" title="Sửa" class="edit"><i class="fa fa-pencil" aria-hidden="true"></i></a></li>
                                                    <li><a href="?mod=menus&controller=index&action=deleteMenu&menu_id=<?php echo $menu['menu_id'] ?>" title="Xóa" class="delete"><i class="fa fa-trash" aria-hidden="true"></i></a></li>
                                                </ul>
                                            </td>
                                            <td style="text-align: center;"><span class="tbody-text"><?php echo $menu['menu_url_static'] ?></span></td>
                                            <td style="text-align: center;"><span class="tbody-text"><?php echo $menu['menu_order'] ?></span></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            <?php } else { $error['menu'] = "(*) Không tồn tại menu nào !"; ?>
                                <p class="error"><?php echo $error['menu'] ?></p>
                            <?php } ?>
                            <tfoot>
                                <tr>
                                    <td><input type="checkbox" name="checkAll" id="checkAll"></td>
                                    <td><span class="thead-text">STT</span></td>
                                    <td><span class="thead-text">Tên menu</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Slug static</span></td>
                                    <td style="text-align: center;"><span class="thead-text">Thứ tự</span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- Lấy phần footer -->

