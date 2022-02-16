<?php get_header(); 

#Kiểm tra có giá trị banner_id ko? nếu có lấy xuống
if(isset($_GET['banner_id'])){
    $banner_id = $_GET['banner_id'];
    $banner_status = get_inf_banner('banner_status', $banner_id);
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
                    <h3 id="index" class="fl-left">Cập nhập banner</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_error('banner'); ?>

                        <label for="title">Tên banner</label>
                        <input type="text" name="banner_title" id="title" value="<?php echo get_inf_banner('banner_title', $banner_id); ?>">
                        <?php echo form_error('banner_title'); ?>

                        <label for="link">Link</label>
                        <input type="text" name="banner_link" id="slug" value="<?php echo get_inf_banner('banner_link', $banner_id); ?>">
                        <?php echo form_error('banner_link'); ?>

                        <label for="desc">Mô tả</label>
                        <textarea name="banner_desc" id="desc" class="ckeditor"><?php echo get_inf_banner('banner_desc', $banner_id); ?></textarea>
                        <?php echo form_error('banner_desc'); ?>

                        <label for="num_order">Thứ tự</label>
                        <input type="text" name="num_order" id="num-order" value="<?php echo get_inf_banner('num_order', $banner_id); ?>">
                        <?php echo form_error('num_order'); ?>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image" src="<?php echo get_inf_banner('banner_thumb', $banner_id)?>">
                        </div>
                        <?php echo form_error('upload_image'); ?>
                        
                        <label>Trạng thái</label>
                        <select name="banner_status">
                            <option value="">-- Chọn trạng thái --</option>
                            <option <?php if(isset($banner_status) && $banner_status == 'Công khai') echo "selected='selected'"; ?> value="Công khai">Công khai</option>
                            <option <?php if(isset($banner_status) && $banner_status == 'Chờ duyệt') echo "selected='selected'"; ?> value="Chờ duyệt">Chờ duyệt</option>
                        </select>
                        <?php echo form_error('banner_status'); ?>
                        
                        <button type="submit" name="btn-update-banner" id="btn-submit">Cập nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<!-- Lấy phần footer -->