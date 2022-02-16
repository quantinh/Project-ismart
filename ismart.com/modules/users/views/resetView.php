<html>
    <head>
        <title>Khôi phục mật khẩu</title>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <link href="public/login.css" rel="stylesheet" type="text/css"/>
        <link rel=icon href="public/images/login.png" type="image/png"sizes="32x32" type="image/png">
    </head>

    <body>
        <div id="wp-form-login">
            <h1 class="page-title">KHÔI PHỤC MẬT KHẨU</h1>
            <form id="form-login" method="POST">
                <input type="text" name="email" id="username" value="<?php echo set_value('email');?>"placeholder="Email">
                <?php echo form_error('email'); ?>
                <input type="submit" name="btn-reset" id="btn-login" value="GỬI YÊU CẦU"/>
                <?php echo form_error('account'); ?>
            </form>
            <a id="lost-pass" href="<?php echo base_url('dang-nhap.html');?>">Đăng nhập</a>|
            <a id="lost-pass" href="<?php echo base_url('dang-ky.html');?>">Đăng ký</a>
        </div>
    </body>