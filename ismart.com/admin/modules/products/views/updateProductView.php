<?php get_header(); 

$list_parent_cat = db_fetch_array("SELECT * FROM `tbl_products_cat` WHERE `parent_id`= 0");
// $list_brands = db_fetch_array("SELECT DISTINCT `product_brand` FROM `tbl_products` WHERE `parent_cat`='{$parent_cat}'");
// $list_product_types = db_fetch_array("SELECT DISTINCT `product_type` FROM `tbl_products` WHERE `product_type`= '{$product_type}'");
$data_cat = db_fetch_array("SELECT * FROM `tbl_products_cat`");
$list_cat = data_tree($data_cat, 0);
// show_array($list_cat);

#Kiểm tra có giá trị product_id ko? nếu có lấy xuống
if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $parent_cat = get_inf_product('parent_cat', $product_id);
    // $brand = get_inf_product('product_brand', $product_id);
    // $product_type = get_inf_product('product_type', $product_id);
}

?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhập sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_error('product'); ?>
                        
                        <label for="title">Tên sản phẩm</label>
                        <input type="text" name="product_title" id="title" value="<?php echo get_inf_product('product_title', $product_id); ?>">
                        <?php echo form_error('product_title'); ?>

                        <label for="product_code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product-code" value="<?php echo get_inf_product('product_code', $product_id); ?>">
                        <?php echo form_error('product_code'); ?>

                        <label for="slug">Slug (Friendly_url)</label>
                        <input type="text" name="product_slug" id="slug" value="<?php echo get_inf_product('product_slug', $product_id); ?>">
                        <?php echo form_error('product_slug'); ?>

                        <label for="price">Giá sản phẩm (Mới)</label>
                        <input type="text" name="product_price_new" id="price" value="<?php echo get_inf_product('product_price_new', $product_id); ?>">
                        <?php echo form_error('product_price_new'); ?>

                        <label for="price">Giá cũ</label>
                        <input type="text" name="product_price_old" id="price" value="<?php echo get_inf_product('product_price_old', $product_id); ?>">
                        <?php echo form_error('product_price_old'); ?>

                        <label for="product_num">Số lượng</label>
                        <input type="number" name="product_num" id="qty_number" min="0" max="100" value="<?php echo get_inf_product('product_num', $product_id); ?>">
                        <?php echo form_error('product_num'); ?>

                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="product_desc" id="desc"><?php echo get_inf_product('product_desc', $product_id); ?></textarea>
                        <?php echo form_error('product_desc')?>

                        <label for="content">Chi tiết</label>
                        <textarea name="product_content" id="desc" class="ckeditor"><?php echo get_inf_product('product_content', $product_id); ?></textarea>
                        <?php echo form_error('product_content'); ?>
                    
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image" src="<?php echo get_inf_product('product_thumb', $product_id)?>">
                        </div>
                        <?php echo form_error('upload_image'); ?>

                        <label>Danh mục sản phẩm</label>
                        <select name="parent_cat">
                            <option value="">-- Chọn danh mục --</option>
                            <?php if(!empty($list_parent_cat)) foreach($list_parent_cat as $cat){ ?>
                            <option <?php if(!empty($parent_cat) && $parent_cat == $cat['cat_title']) echo "selected='selected'"; ?> value="<?php echo $cat['cat_title']?>"><?php echo $cat['cat_title']?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('parent_cat') ?>

                        <button type="submit" name="btn-update-product" id="btn-submit">Cập nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- Lấy phần footer -->


