<?php get_header(); 

#Kiểm tra có giá trị page_id ko? nếu có lấy xuống
if(isset($_GET['page_id'])){
    $page_id = $_GET['page_id'];
    $category = get_inf_page('category', $page_id);
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
                    <h3 id="index" class="fl-left">Cập nhập trang</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <?php echo form_error('page'); ?>

                        <label for="title">Tiêu đề</label>
                        <input type="text" name="page_title" id="title" value="<?php echo get_inf_page('page_title', $page_id);?>">
                        <?php echo form_error('page_title'); ?>

                        <label for="slug">Slug ( Friendly_url )</label>
                        <input type="text" name="page_slug" id="slug" value="<?php echo get_inf_page('page_slug', $page_id);?>">
                        <?php echo form_error('page_slug'); ?>

                        <label for="desc">Nội dung bài viết</label>
                        <textarea name="page_content" id="desc" class="ckeditor"><?php echo get_inf_page('page_content', $page_id);?></textarea>
                        <?php echo form_error('page_content'); ?>

                        <label for="desc">Mô tả bài viết</label>
                        <textarea name="page_desc" id="desc" class="ckeditor"><?php echo get_inf_page('page_desc', $page_id);?></textarea>
                        <?php echo form_error('page_desc'); ?>

                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image" src="<?php echo get_inf_page('page_thumb', $page_id)?>">
                        </div>
                        <?php echo form_error('upload_image'); ?>

                        <label for="category">Danh mục</label>
                        <select name = "category">
                            <option value="">Danh mục</option>
                            <option <?php if(isset($category) && $category == 'Trang chủ') echo "selected='selected'"; ?> value="Trang chủ">Trang chủ</option>
                            <option <?php if(isset($category) && $category == 'Sản phẩm') echo "selected='selected'"; ?> value="Sản phẩm">Sản phẩm</option>
                            <option <?php if(isset($category) && $category == 'Blog') echo "selected='selected'"; ?> value="Blog">Blog</option>
                            <option <?php if(isset($category) && $category == 'Giới thiệu') echo "selected='selected'"; ?> value="Giới thiệu">Giới thiệu</option>
                            <option <?php if(isset($category) && $category == 'Liên hệ') echo "selected='selected'"; ?> value="Liên hệ">Liên hệ</option>
                        </select>
                        <?php echo form_error('category')?>
                        
                        <button type="submit" name="btn-update-page" id="btn-submit">Cập nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<!-- Lấy phần footer -->