<html>
    <head>
        <title>Admin Login</title>
        <link rel=icon href="public/images/reload/admin0.png" type="image/png"sizes="32x32" type="image/png">
        <link href="public/reset2.css" rel="stylesheet" type="text/css" />
        <link href="public/login.css" rel="stylesheet" type="text/css" />
        <link href="public/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    </head>

    <body>
        <div id="wrapper">
            <form method="POST" action="" id="form-login">
                <h1 class="form-heading">Admin</h1>
                <div class="form-group">
                    <i class="far fa-user"></i>
                    <input type="text" class="form-input" name="username" value="<?php echo set_value('username'); ?>" placeholder="Tên đăng nhập">
                </div>
                <?php echo form_error('username'); ?>

                <div class="form-group">
                    <i class="fas fa-key"></i>
                    <input type="password" class="form-input" name="password" placeholder="Mật khẩu">
                    <div id="eye">
                        <i class="fas fa-eye"></i>
                    </div>
                </div>
                <?php echo form_error('password'); ?>
                <?php echo form_error('account'); ?>
                <input id="remember_me" type="checkbox" name="remember_me" value="1"><label class="label_remember_me">Ghi nhớ đăng nhập</label></input>
                <input type="submit" name='btn-login' value="Đăng nhập" class="form-submit">
            </form>
        </div>
    <script src="public/js/main.js"></script>
    </body>
</div>