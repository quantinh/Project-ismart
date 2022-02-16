<html>
    <head>
        <title>Thiết lập mật khẩu mới</title>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/login.css" rel="stylesheet" type="text/css"/>
        <link rel=icon href="public/images/login.png" type="image/png"sizes="32x32" type="image/png">
    </head>

    <body>
        <div id="wp-form-login">
            <h1 class="page-title">MẬT KHẨU MỚI</h1>
            <form id="form-login" method="POST">
                <input type="password" name="password" id="password" value="" placeholder="Mật khẩu">
                <?php echo form_error('password'); ?>
                <input type="submit" name="btn-new-pass" id="btn-login" value="LƯU"/>
                <?php echo form_error('account'); ?>
            </form>
            <a id="lost-pass" href="<?php echo base_url('dang-nhap.html');?>">Đăng nhập</a>|
            <a id="lost-pass" href="<?php echo base_url('dang-ky.html');?>">Đăng ký</a>
        </div>
    </body>
</html>