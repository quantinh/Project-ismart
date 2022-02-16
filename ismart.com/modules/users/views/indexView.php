<html>
    <head>
        <title>Đăng ký tài khoản</title>
        <link href="public/reset.css" rel="stylesheet" type="text/css" />
        <link href="public/sign_up.css" rel="stylesheet" type="text/css"/>
        <link rel=icon href="public/images/login.png" type="image/png"sizes="32x32" type="image/png">
    </head>

    <body>
        <div id="wp-form-reg">
            <h1 class="page-title">ĐĂNG KÝ TÀI KHOẢN</h1>
            <form id="form_reg" method="POST">
                
                <input type="text" name="fullname" id="fullname" placeholder="Họ và tên">
                <p class="error"><?php echo form_error('fullname'); ?></p>
                
                <input type="text" name="username" id="username" placeholder="Tên đăng nhập">
                <p class="error"><?php echo form_error('username'); ?></p>
                
                <input type="password" name="password" id="password" placeholder="Mật khẩu">
                <p class="error"><?php echo form_error('password'); ?></p>

                <input type="email" name="email" id="email" placeholder="Email">
                <p class="error"><?php echo form_error('email'); ?></p>
                
                <input type="number" name="tel" id="tel" placeholder="Số điện thoại">
                <p class="error"><?php echo form_error('tel'); ?></p>

                <select name="gender" id="gender">
                    <option value="">Chọn giới tính</option>
                    <option value="male">Nam</option>
                    <option value="female">Nữ</option>
                </select>
                <p class="error"><?php echo form_error('gender'); ?></p>

                <input id="btn_reg" type="submit" name="btn-reg" value="Đăng ký"/>
                <p class="error"><?php echo form_error('reg_account'); ?></p>
            </form>
            <a id="lost-pass" href="dang-nhap.html" id="lost-pass">Đăng nhập</a>
        </div>
    </body>
</html>
