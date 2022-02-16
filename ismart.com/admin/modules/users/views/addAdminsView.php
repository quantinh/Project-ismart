<?php get_header();?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
       <?php get_sidebar('users');?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Thêm Admin</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_error('admin'); ?>
                        <label for="fullname">Họ và tên</label>
                        <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname') ?>">
                        <?php echo form_error('fullname'); ?>

                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" value="<?php echo set_value('username') ?>">
                        <?php echo form_error('username'); ?>

                        <label for="password">Mật khẩu</label>
                        <input type="password" name="password" id="password" value="<?php echo set_value('password') ?>">
                        <?php echo form_error('password'); ?>

                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo set_value('email') ?>">
                        <?php echo form_error('email'); ?>

                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="tel" id="tel" value="<?php echo set_value('tel') ?>">
                        <?php echo form_error('tel'); ?>

                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address" value="<?php echo set_value('address') ?>"></textarea>
                        <?php echo form_error('address'); ?>
                           
                        <label>Ảnh đại diện</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <input type="submit" name="btn-upload-thumb" value="Upload" id="btn-upload-thumb">
                            <img id="upload-image" src="public/images/<?php if(isset($_FILES['file']) && !empty($_FILES['file']['name'])){ echo 'upload/admins/'.$_FILES['file']['name'];} else{ echo 'avatar/img-thumb.png';}?>">
                        </div>
                        <?php echo form_error('upload_image'); ?>

                        <label>Phân quyền</label>
                        <select name="role">
                            <option value="">-- Chọn --</option>
                            <option <?php if (!empty($_POST['role']) && $_POST['role'] == '1') {echo "selected='selected'";}?> value="1">1</option>
                            <option <?php if (!empty($_POST['role']) && $_POST['role'] == '2') {echo "selected='selected'";}?> value="2">2</option>
                            <option <?php if (!empty($_POST['role']) && $_POST['role'] == '3') {echo "selected='selected'";}?> value="3">3</option>
                        </select>
                        <?php echo form_error('role'); ?>
                        
                        <br>
                        <button type="submit" name="btn-add-admin" id="btn-submit">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- Lấy phần footer -->
