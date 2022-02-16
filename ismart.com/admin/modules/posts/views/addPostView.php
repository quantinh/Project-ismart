<?php get_header(); 
 
 $data_cat = db_fetch_array("SELECT * FROM `tbl_posts_cat`");
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
                    <h3 id="index" class="fl-left">Thêm bài viết</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_error('post'); ?>
                        
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="post_title" id="title" value="<?php echo set_value('post_title') ?>">
                        <?php echo form_error('post_title'); ?>

                        <label for="slug">Slug ( Friendly_url )</label>
                        <input type="text" name="post_slug" id="slug" value="<?php echo set_value('post_slug'); ?>">
                        <?php echo form_error('post_slug'); ?>

                        <label for="desc">Nội dung bài viết</label>
                        <textarea name="post_content" id="desc" class="ckeditor" value="<?php echo set_value('post_content'); ?>"></textarea>
                        <?php echo form_error('post_content'); ?>

                        <label for="desc">Mô tả</label>
                        <textarea name="post_desc" id="desc" class="ckeditor" value="<?php echo set_value('post_desc'); ?>"></textarea>
                        <?php echo form_error('post_desc'); ?>
                    
                        <label>Hình ảnh</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image" src="public/images/<?php if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){ echo 'upload/posts/'.$_FILES['file']['name']; } else { echo 'avatar/img-thumb.png';}?>">
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

                        <button type="submit" name="btn-add-post" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- Lấy phần footer -->


