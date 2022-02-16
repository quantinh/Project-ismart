<?php get_header();

#Nếu tồn tại giá trị admin_id trong mảng $_GET
if(isset($_GET['admin_id'])){
    #Thì sẽ gán bằng giá trị lấy xuống từ $_GET 
    $admin_id = $_GET['admin_id'];
    #Phân quyền sẽ là theo giá trị được lấy xuống và admin_id của người đó
    $role = get_inf_admins('role', $admin_id);
    #Avatar cũng tương tự là avatar của thành viên đó và admin_id 
    $avatar = get_inf_admins('avatar', $admin_id);
}
?>
<!-- lấy phần header -->
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar('users'); ?>
        <!-- lấy phần sidebar -->
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhập Admin</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php echo form_error('admin')?>
                        <label for="fullname">Họ và tên</label>
                        <input type="text" name="fullname" id="fullname" value="<?php echo get_inf_admins('fullname', $admin_id) ?>">
                        <?php echo form_error('fullname') ?>

                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="username" placeholder="<?php echo get_inf_admins('username', $admin_id) ?>" readonly="readonly">
                        <?php echo form_error('username') ?>

                        <label for="password">Mật khẩu</label>
                        <input type="text" name="password" id="password" readonly="readonly">
                        <?php echo form_error('password') ?>

                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo get_inf_admins('email', $admin_id) ?>">
                        <?php echo form_error('email') ?>
                    
                        <label for="tel">Số điện thoại</label>
                        <input type="tel" name="tel" id="tel" value="<?php echo get_inf_admins('tel', $admin_id) ?>">

                        <label for="address">Địa chỉ</label>
                        <textarea name="address" id="address"><?php echo get_inf_admins('address', $admin_id) ?></textarea>
                        
                        <label for="role">Ảnh đại diện</label>
                        <div id="uploadFile">
                            <input type="file" name="file" id="upload-thumb" onchange="show_upload_image()">
                            <img id="upload-image" src="<?php if (!empty($avatar)) {echo $avatar;} else {echo 'public/images/upload/avatar/img-thumb.png';}?>">
                        </div>
                        <?php echo form_error('upload_image') ?>

                        <label>Phân quyền</label>
                        <select name="role">
                            <option value="">-- Chọn --</option>
                            <option <?php if (isset($role) && $role == '1') {echo "selected='selected'";}?> value="1">1</option>
                            <option <?php if (isset($role) && $role == '2') {echo "selected='selected'";}?> value="2">2</option>
                            <option <?php if (isset($role) && $role == '3') {echo "selected='selected'";}?> value="3">3</option>
                        </select>
                        <?php echo form_error('role'); ?>

                        <button type="submit" name="btn-update" id="btn-update">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- lấy phần footer -->