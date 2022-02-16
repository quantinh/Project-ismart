//Cập nhập giỏ hàng bằng ajax
$(document).ready(function () {
    $(".num-order").change(function () {
        var product_id = $(this).attr("data-id");//Tạo biến lấy giá trị từ selector
        var qty = $(this).val();//Tạo biến lấy giá trị từ selector
        var data = { product_id: product_id, qty: qty };//Tạo biến lấy dữ liệu 
        // console.log(data);
        // alert(num_order);//Xuất hiển thị dữ liệu
        // console.log(qty);
        $.ajax({
            url: '?mod=carts&controller=index&action=update_cart',//Trang xử lí mặc định trang hiện tại
            type: 'POST',//$_POST hoặc $_GET, mặc định GET
            data: data,//Dữ liệu truyền lên server
            dataType: 'json',// trả về dạng html,text, script hoặc json
            success: function (data) {
                $("#sub-total-" + product_id).text(data.sub_total);
                $("#total-price span").text(data.total);
            // console.log(data);
            },
            error: function (xhr, ajaxOptions, throwError) {//Phương thức lỗi
                alert(xhr.statusText);//Dòng hiển thị thông tin
                alert(throwError);//Chi tiết lỗi
            },
        });
    });
});

//Phân trang sản phẩm bằng ajax
$(document).ready(function() {
    function get_data(cat_id, page) {
        var arrange = $("#filter-arrange").find(":selected").val();
        var data = {page: page, cat_id: cat_id, arrange: arrange};
        // console.log(data);
        // console.log(arrange);
        $.ajax({
            url: '?mod=products&controller=index&action=product',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data) {
                $('#' + cat_id).html(data.output);
                // console.log(data);
            },
            error: function (xhr, ajaxOptions, throwError) {//Phương thức lỗi
                alert(xhr.statusText);//Dòng hiển thị thông tin
                alert(throwError);//Chi tiết lỗi
            },
        });
    };
    $(document).on("click", ".num-page", function () {
        var cat_id = $(this).attr('cat-id');
        var page = $(this).text();
        get_data(cat_id, page);
    });
});

//Phân trang chủ sản phẩm bằng ajax
$(document).ready(function() {
    function get_data(cat_id, page) {
        var data = {page: page, cat_id: cat_id};
        console.log(data);
        $.ajax({
            url: '?mod=home&controller=index&action=pagination_home',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data) {
                $('#' + cat_id).html(data.output);
                // console.log(data);
            },
            error: function (xhr, ajaxOptions, throwError) {//Phương thức lỗi
                alert(xhr.statusText);//Dòng hiển thị thông tin
                alert(throwError);//Chi tiết lỗi
            },
        });
    };
    $(document).on("click", ".common_selector_home", function () {
        var cat_id = $(this).attr('cat-id');
        var page = $(this).text();
        get_data(cat_id, page);
    });
});

//Phân trang bài viết bằng ajax
$(document).ready(function () {
    function get_data(page){
        var data = {page: page};
        console.log(data);
        $.ajax({
            url: '?mod=posts&controller=index&action=pagination_post',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                $('#result_post').html(data.result_post);
                // console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.statusText);
                alert(thrownError);
            },
        });
    };
    $(document).on("click", ".common_selector_post", function () {
        var page = $(this).text();
        get_data(page);
    });
});

//Phân trang tìm kiếm sản phẩm bằng ajax
$(document).ready(function () {
    function get_data(page_num, cat_id, value){
        var select = $("#filter-arrange").find(":selected").val();
        var data = {page_num: page_num, cat_id: cat_id, value: value, select: select};
        console.log(data);
        $.ajax({
            url: '?mod=home&controller=index&action=pagination_search',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                $('#'+cat_id).html(data.result_search);
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            },
        });
    };
    $(document).on("click", ".common_selector_search", function () {
        var cat_id = $(this).attr('cat-id');
        var page_num = $(this).text();
        var select = $(this).text();
        var value = $(this).attr('value');
        get_data(page_num, cat_id, value, select);
    });
});

// Phân trang danh mục sản phẩm bằng ajax
$(document).ready(function () {
    function get_data(page) {
        function get_filter(class_name) {
            var filter = [];
            $('.' + class_name + ':checked').each(function () {
                filter.push($(this).val());
            });
            return filter;
        }
        var price = get_filter('filter-price'); 
        var brand = get_filter('filter-brand'); 
        var cat_id = $('h3#cat-title').attr('cat-id');
        var arrange = $("#filter-arrange").find(":selected").val();
        var data = {page: page, cat_id: cat_id, price: price, brand: brand, arrange: arrange };
        // console.log(data);
        $.ajax({
            url: '?mod=products&controller=index&action=pagination_cat',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function (data) {
                $('#result-product-cat').html(data.output);
                $('span#num-page').text(data.num_page);
                $('#num-filter').text(data.num_filter);
                console.log(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.statusText);
                alert(thrownError);
            },
        });
    }
    $(document).on("click", ".common_selector", function () {
        var page = $(this).text();
        get_data(page);
    });
});