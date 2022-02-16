<?php get_header(); 
 
 $data_cat = db_fetch_array("SELECT* FROM `tbl_products_cat`");
 $list_cat = data_tree($data_cat, 0);
 // show_array($list_cat);
?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm sản phẩm</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_error('product'); ?>
                        
                        <label for="title">Tên sản phẩm</label>
                        <input type="text" name="product_title" id="title" value="<?php echo set_value('product_title') ?>">
                        <?php echo form_error('product_title'); ?>

                        <label for="product_code">Mã sản phẩm</label>
                        <input type="text" name="product_code" id="product-code" value="<?php echo set_value('product_code') ?>">
                        <?php echo form_error('product_code'); ?>
                        
                        <label for="slug">Slug (Friendly_url)</label>
                        <input type="text" name="product_slug" id="slug" value="<?php echo set_value('product_slug'); ?>">
                        <?php echo form_error('product_slug'); ?>
                        
                        <label for="price">Giá sản phẩm (Mới)</label>
                        <input type="text" name="product_price_new" id="price" value="<?php echo set_value('product_price_new'); ?>">
                        <?php echo form_error('product_price_new'); ?>

                        <label for="price">Giá cũ</label>
                        <input type="text" name="product_price_old" id="price" value="<?php echo set_value('product_price_old'); ?>">
                        <?php echo form_error('product_price_old'); ?>

                        <label for="product_num">Số lượng</label>
                        <input type="number" name="product_num" id="qty_number" min="0" max="100" value="<?php echo set_value('product_num'); ?>">
                        <?php echo form_error('product_num'); ?>

                        <label for="desc">Mô tả ngắn</label>
                        <textarea name="product_desc" id="desc"><?php echo set_value('product_desc') ?></textarea>
                        <?php echo form_error('product_desc')?>

                        <label for="content">Chi tiết</label>
                        <textarea name="product_content" id="desc" class="ckeditor"><?php echo set_value('product_content'); ?></textarea>
                        <?php echo form_error('product_content'); ?>
                    
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image" src="public/images/<?php if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){ echo 'upload/products/'.$_FILES['file']['name']; } else { echo 'avatar/img-thumb.png'; }?>">
                        </div>
                        <?php echo form_error('upload_image'); ?>

                        <label>Danh mục cha</label>
                        <select name="parent_cat">
                            <option value="">---Chọn Danh mục---</option>
                            <?php if(!empty($list_cat)) foreach($list_cat as $cat) { ?>
                                <option <?php if(!empty($_POST['parent_cat']) && $_POST['parent_cat'] == $cat['cat_title']) echo "selected='selected'"; ?> value="<?php echo $cat['cat_title']?>"><?php echo str_repeat('--', $cat['level']).' '.$cat['cat_title']?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('parent_cat'); ?>

                        <button type="submit" name="btn-add-product" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- Lấy phần footer -->


