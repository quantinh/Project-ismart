<?php get_header(); ?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">      
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm trang mới</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_error('page'); ?>
                        
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="page_title" id="title" value="<?php echo set_value('page_title') ?>">
                        <?php echo form_error('page_title'); ?>

                        <label for="slug">Slug ( Friendly_url )</label>
                        <input type="text" name="page_slug" id="slug" value="<?php echo set_value('page_slug'); ?>">
                        <?php echo form_error('page_slug'); ?>

                        <label for="desc">Nội dung bài viết</label>
                        <textarea name="page_content" id="desc" class="ckeditor" value="<?php echo set_value('page_content'); ?>"></textarea>
                        <?php echo form_error('page_content'); ?>

                        <label for="desc">Mô tả bài viết</label>
                        <textarea name="page_desc" id="desc" class="ckeditor" value="<?php echo set_value('page_desc'); ?>"></textarea>
                        <?php echo form_error('page_desc'); ?>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image" src="public/images/<?php if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){ echo 'upload/pages/'.$_FILES['file']['name'];} else { echo 'avatar/img-thumb.png';}?>">
                        </div>
                        <?php echo form_error('upload_image'); ?>
                        
                        <label for="category">Danh mục</label>
                        <select name="category">
                            <option value="">Danh mục</option>
                            <option <?php if(!empty($_POST['category']) && $_POST['category'] == 'Trang chủ') echo "selected='selected'"; ?> value="Trang chủ">Trang chủ</option>
                            <option <?php if(!empty($_POST['category']) && $_POST['category'] == 'Sản phẩm') echo "selected='selected'"; ?> value="Sản phẩm">Sản phẩm</option>
                            <option <?php if(!empty($_POST['category']) && $_POST['category'] == 'Blog') echo "selected='selected'"; ?> value="Blog">Blog</option>
                            <option <?php if(!empty($_POST['category']) && $_POST['category'] == 'Giới thiệu') echo "selected='selected'"; ?> value="Giới thiệu">Giới thiệu</option>
                            <option <?php if(!empty($_POST['category']) && $_POST['category'] == 'Liên hệ') echo "selected='selected'"; ?> value="Liên hệ">Liên hệ</option>
                        </select>
                        <?php echo form_error('category'); ?>

                        <button type="submit" name="btn-add-page" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<!-- Lấy phần footer -->