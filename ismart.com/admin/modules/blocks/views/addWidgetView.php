<?php get_header(); ?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">      
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm khối mới</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <?php echo form_error('block'); ?>
                        
                        <label for="title">Tên khối</label>
                        <input type="text" name="block_title" id="title" value="<?php echo set_value('block_title') ?>">
                        <?php echo form_error('block_title'); ?>

                        <label for="block">Mã khối</label>
                        <input type="text" name="block_code" id="slug" value="<?php echo set_value('block_code'); ?>">
                        <?php echo form_error('block_code'); ?>

                        <label for="desc">Nội dung khối</label>
                        <textarea name="block_content" id="desc" class="ckeditor" value="<?php echo set_value('block_content'); ?>"></textarea>
                        <?php echo form_error('block_content'); ?>
                        
                        <button type="submit" name="btn-add-block" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<!-- Lấy phần footer -->