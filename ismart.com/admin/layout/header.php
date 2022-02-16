<!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap-CSS -->
        <link href="public/css/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/css/bootstrap/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/reset.css" rel="stylesheet" type="text/css"/>
        <!-- Font-Awesome -->
        <link href="public/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="public/style.css" rel="stylesheet" type="text/css"/>
        <link href="public/responsive.css" rel="stylesheet" type="text/css"/>
         <!-- Jquery-Ckeditor-Bootstrap -->
        <script src="public/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="public/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="public/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="public/js/main.js" type="text/javascript"></script>
        <!-- Icon-Load -->
        <link rel=icon href="public/images/reload/admin0.png" type="image/png"sizes="32x32" type="image/png">
        <title>Managers Ismart</title>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div class="wp-inner clearfix">
                        <a href="?mod=users&controller=team&action=index" title="logo" id="logo" class="fl-left">ADMIN</a>
                        <ul id="main-menu" class="fl-left">
                            <li>
                                <a href="?mod=pages&controller=index&action=index" title="Trang">Trang</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=pages&controller=index&action=addPage" title="Thêm mới">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=pages&controller=index&action=index" title="Danh sách trang">Danh sách trang</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=posts&controller=index&action=index" title="Bài viết">Bài viết</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=posts&controller=index&action=addPost" title="Thêm mới">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=posts&controller=postCat&action=index" title="Danh mục bài viết">Danh mục bài viết</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=posts&controller=index&action=index" title="Danh sách bài viết">Danh sách bài viết</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=products&controller=index&action=index" title="Sản phẩm">Sản phẩm</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=products&controller=index&action=addProduct" title="Thêm mới">Thêm mới</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=products&controller=productCat&action=index" title="Danh mục sản phẩm">Danh mục sản phẩm</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=products&controller=index&action=index" title="Danh sách sản phẩm">Danh sách sản phẩm</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=orders&controller=index&action=index" title="Bán hàng">Bán hàng</a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="?mod=orders&controller=index&action=index" title="Danh sách đơn hàng">Danh sách đơn hàng</a> 
                                    </li>
                                    <li>
                                        <a href="?mod=orders&controller=customer&action=index" title="Danh sách khách hàng">Danh sách khách hàng</a> 
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="?mod=menus&controller=index&action=index" title="Menu">Menu</a>
                            </li>
                        </ul>
                        <div id="dropdown-user" class="dropdown dropdown-extended fl-right">
                            <button class="dropdown-toggle clearfix" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <div id="thumb-circle" class="fl-left">
                                    <img src="<?php echo get_inf_account('avatar'); ?>">
                                </div>
                                <h3 id="account" class="fl-right"><?php echo get_inf_account('fullname'); ?></h3>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="?mod=users&action=infoAccount" title="Thông tin cá nhân">Thông tin tài khoản</a></li>
                                <li><a href="?mod=users&action=logout" title="Thoát">Thoát</a></li>
                            </ul>
                        </div>
                    </div>
                </div>