<?php get_header(); ?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="add-cat-page slider-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">      
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm Slider</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_error('slider'); ?>
                        
                        <label for="title">Tên slider</label>
                        <input type="text" name="slider_title" id="title" value="<?php echo set_value('slider_title') ?>">
                        <?php echo form_error('slider_title'); ?>

                        <label for="link">Link</label>
                        <input type="text" name="slider_link" id="slug" value="<?php echo set_value('slider_link'); ?>">
                        <?php echo form_error('slider_link'); ?>

                        <label for="desc">Mô tả</label>
                        <textarea name="slider_desc" id="desc" class="ckeditor" value="<?php echo set_value('slider_desc'); ?>"></textarea>
                        <?php echo form_error('slider_desc'); ?>

                        <label for="num_order">Thứ tự</label>
                        <input type="text" name="num_order" id="num-order" value="<?php echo set_value('num_order'); ?>">
                        <?php echo form_error('num_order'); ?>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image" src="public/images/<?php if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){ echo 'upload/sliders/'.$_FILES['file']['name'];} else{ echo 'avatar/img-thumb.png';}?>">
                        </div>
                        <?php echo form_error('upload_image'); ?>
                        
                        <label>Trạng thái</label>
                        <select name="slider_status">
                            <option value="">-- Chọn trạng thái --</option>
                            <option <?php if(!empty($_POST['slider_status']) && $_POST['slider_status'] == 'Công khai') echo "selected='selected'"; ?> value="Công khai">Công khai</option>
                            <option <?php if(!empty($_POST['slider_status']) && $_POST['slider_status'] == 'Chờ duyệt') echo "selected='selected'"; ?> value="Chờ duyệt">Chờ duyệt</option>
                        </select>
                        <?php echo form_error('slider_status'); ?>

                        <button type="submit" name="btn-add-slider" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<!-- Lấy phần footer -->