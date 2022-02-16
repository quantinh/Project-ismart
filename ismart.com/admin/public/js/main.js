$(document).ready(function () {

    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true);
    $('#content').css('min-height', height);

    //Click vào class eye 
    $('#eye').click(function () {
        // thêm vào class open vào cha 
        $(this).toggleClass('open');
        // thay đổi class mắt ko gạch thành mắt 1 gạch vào thằng con
        $(this).children('i').toggleClass('fa-eye-slash fa-eye');
        // Nếu có class open thì xuất ra text->pass
        if ($(this).hasClass('open')) {
            // alert('type text');
            // Gọi đến thằng bên trên(prev) và thay đổi thuộc tính type="text"
            $(this).prev().attr('type', 'text')
        } else {
            //Thao tác ngược lại gọi đến thằng bên trên(prev) và thay đổi thuộc tính type="password"
            $(this).prev().attr('type', 'password')
        }
    });

    //Check all
    $('input[name="checkAll"]').click(function () {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    });

    //Event sidebar menu
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function () {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').slideUp();
            $(this).parent('li').find('.sub-menu').slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        } else {
            $('.sub-menu').slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
    });

    //Onchange upload_images
    show_upload_image = function () {
        var upload_image = document.getElementById("upload-thumb")
        if (upload_image.files && upload_image.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#upload-image').attr('src', e.target.result)
            };
            reader.readAsDataURL(upload_image.files[0]);
        }
    }

    //Onchange upload_multi_images 
    show_upload_multi_image = function () {
        var upload_image = document.getElementById("upload-thumb");
        if (upload_image.files) {
            let str_class_img = "";
            for (var i = 0; i < upload_image.files.length; i++) {
                str_class_img += "<img class='fl-left' id='upload-image-" + i + "'>";
                $('div#slider-thumb').html(str_class_img);
                let selector_img = "#upload-image-" + i;
                var reader = new FileReader();
                reader.onload = function (e) {
                    $(selector_img).attr('src', e.target.result);
                    console.log(selector_img);
                };
                reader.readAsDataURL(upload_image.files[i]);
            }
        }
    }
});
