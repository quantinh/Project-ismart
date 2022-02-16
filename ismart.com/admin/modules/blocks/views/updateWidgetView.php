<?php get_header(); 

#Kiểm tra có giá trị block_id ko? nếu có lấy xuống
if(isset($_GET['block_id'])){
    $block_id = $_GET['block_id'];
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
                    <h3 id="index" class="fl-left">Cập nhập khối</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <?php echo form_error('block'); ?>
                        
                        <label for="title">Tên khối</label>
                        <input type="text" name="block_title" id="title" value="<?php echo get_inf_block('block_title', $block_id); ?>">
                        <?php echo form_error('block_title'); ?>

                        <label for="block">Mã khối</label>
                        <input type="text" name="block_code" id="slug" value="<?php echo get_inf_block('block_code', $block_id); ?>">
                        <?php echo form_error('block_code'); ?>

                        <label for="desc">Nội dung khối</label>
                        <textarea name="block_content" id="desc" class="ckeditor"><?php echo get_inf_block('block_content', $block_id); ?></textarea>
                        <?php echo form_error('block_content'); ?>
                        
                        <button type="submit" name="btn-update-block" id="btn-submit">Cập nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
<!-- Lấy phần footer -->