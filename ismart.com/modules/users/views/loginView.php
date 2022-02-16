<html>
    <head>
        <title>Đăng nhập</title>
        <link href="public/reset.css" rel="stylesheet" type="text/css" />
        <link href="public/login.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link rel=icon href="public/images/login.png" type="image/png"sizes="32x32" type="image/png">
    </head>

    <body>
        <div id="wp-form-login">
            <h1 class="page-title">ĐĂNG NHẬP</h1>
            <form id="form-login" method="POST">
                <input type="text" name="username" id="username" value="<?php echo set_value('username');?>"placeholder="Tên đăng nhập">
                <?php echo form_error('username'); ?>

                <input type="password" name="password" id="password" value="" placeholder="Mật khẩu">
                <?php echo form_error('password'); ?>

                <input id="remember_me" type="checkbox" name="remember_me" value="1"><label>Ghi nhớ đăng nhập<label</input>

                <input type="submit" name="btn-login" id="btn-login" value="ĐĂNG NHẬP"/>
                <?php echo form_error('account'); ?>
            </form>
            <a href="lay-lai-mat-khau.html" id="reg-pass">Quên mật khẩu ?</a><br>
            <span class="no_reg">Chưa có tài khoản ?</span><a href="dang-ky.html" id="reg-pass">Đăng ký ngay</a><br>
            <a href="trang-chu.html" id="reg-pass"><i class="fa fa-angle-double-left"></i> Trở về trang chủ</a>
        </div>
    </body>