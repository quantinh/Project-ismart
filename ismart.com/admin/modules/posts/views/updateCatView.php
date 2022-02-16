<?php get_header(); 

$data_cat = db_fetch_array("SELECT * FROM `tbl_posts_cat`");
$list_cat = data_tree($data_cat, 0);
// show_array($list_cat);

#Kiểm tra cat theo id có tồn tại ko và lấy xuống ?
if(isset($_GET['cat_id'])){
    $cat_id = $_GET['cat_id'];
    $parent_id = get_inf_cat('parent_id', $cat_id);
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
                    <h3 id="index" class="fl-left">Cập nhập danh mục</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_error('cat'); ?>
                        
                        <label for="title">Tiêu đề</label>
                        <input type="text" name="cat_title" id="title" value="<?php echo get_inf_cat('cat_title', $cat_id) ?>">
                        <?php echo form_error('cat_title'); ?>

                        <label for="slug">Slug ( Friendly_url )</label>
                        <input type="text" name="cat_slug" id="slug" value="<?php echo get_inf_cat('cat_slug', $cat_id); ?>">
                        <?php echo form_error('cat_slug'); ?>
                    
                        <label>Danh mục cha</label>
                        <select name="parent_id">
                            <option <?php if(!empty($_POST['parent_id']) && $_POST['parent_id'] == 0) echo "selected='selected'"; ?> value="0">Danh mục cha</option>
                            <?php if(!empty($list_cat)) foreach($list_cat as $cat){ ?>
                            <option <?php if(!empty($_POST['parent_id']) && $_POST['parent_id'] == $cat['cat_id']) echo "selected='selected'"; ?> value="<?php echo $cat['cat_id']?>"><?php echo str_repeat('--', $cat['level']).' '.$cat['cat_title']?></option>
                            <?php } ?>
                        </select>
                        <?php echo form_error('parent_id'); ?>

                        <button type="submit" name="btn-update-cat" id="btn-submit">Cập nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- Lấy phần footer -->


