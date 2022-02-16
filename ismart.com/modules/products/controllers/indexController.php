<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct()
{
    load_model('index');
    load('helper', 'format');
    load('lib','pagging');
    load('lib', 'validation');
    load('lib', 'get_title');
}

#Hàm load trang index
function indexAction()
{
    load_view('index');
}

#Hàm load danh mục sản phẩm
function cat_productAction()
{
    load_view('cat_product');
}

#Hàm load chi tiết sản phẩm
function detail_productAction()
{
    load_view('detail_product');
}

#Hàm phân trang sản phẩm bằng ajax
function productAction()
{
    #Kiểm tra nếu tồn tại cat_id thì lấy xuống
    if(isset($_POST['cat_id'])) {
        $cat_id = (int)$_POST['cat_id'];
        $cat = db_fetch_assoc("SELECT `cat_title` FROM `tbl_products_cat` WHERE `cat_id` = '{$cat_id}'");
    }
    $output = '';
    $query = "SELECT* FROM `tbl_products` WHERE `product_status` = 'Approved' AND (`parent_cat` = '{$cat['cat_title']}' OR `product_brand` = '{$cat['cat_title']}' OR `product_type` = '{$cat['cat_title']}') ";
    #Lọc và sắp xếp
    if(isset($_POST['arrange']) && !empty($_POST['arrange'])) {
        $arrange = $_POST['arrange'];
        if($arrange == 1){
            $query .= 'ORDER BY `product_title` ASC ';
        }
        if($arrange == 2){
            $query .= 'ORDER BY `product_title` DESC ';
        }
        if($arrange == 3){
            $query .= 'ORDER BY `product_price_new` DESC ';
        }
        if($arrange == 4){
            $query .= 'ORDER BY `product_price_new` ASC ';
        }
    }
    $list_products_by_cat = db_fetch_array($query);
    #Phân trang
    #1)Tổng số bảng ghi có (sẩn phẩm) = 5
    $total_row = count($list_products_by_cat);
    #2)Số sản phẩm muốn hiển thị trên 1 trang
    $num_per_page = 4;
    #3)Số trang phân được 
    $num_page = ceil($total_row / $num_per_page);
    #4)Kiểm tra xem nếu có số trang từ url rồi, or cho số nguyên mặc định bắt đầu = 1
    if (isset($_POST['page']) && !empty($_POST['page'])) {
        $page = (int) $_POST['page'] ? (int) $_POST['page'] : 1;
        if ($_POST['page'] == '<i class="fa fa-angle-left"></i>') {
            if ($page < 1) {
                $page = 1;
            } else {
                $page -= 1;
            }
        }
        if ($_POST['page'] == '<i class="fa fa-angle-right"></i>') {
            if ($page = $num_page) {
                $page = $num_page;
            } else {
                $page += 1;
            }
        }
    } else {
        $page = 1;
    }
    #5)Tính chỉ số bắt đầu
    $start = ($page - 1) * $num_per_page;
    #6)Danh sách sản phẩm theo trang
    $list_product_by_page = array_slice($list_products_by_cat, $start, $num_per_page);
    $output .= '<div class="section-detail">     
                    <ul class="list-item clearfix">';
                    if (!empty($list_product_by_page)) {
                        foreach ($list_product_by_page as $product_by_cat) {
                            $output .= '
                            <li>
                                <a href="?mod=products&action=detail_product&product_id=' . $product_by_cat['product_id'] . '" title="" class="thumb">
                                    <img src="admin/' . $product_by_cat['product_thumb'] . '">
                                </a>
                                <a href="?mod=products&action=detail_product&product_id=' . $product_by_cat['product_id'] . '" title="" class="product-name">' . $product_by_cat['product_title'] . '</a>
                                <div class="price">
                                    <span class="new">' . currency_format($product_by_cat['product_price_new']) . '</span>
                                    <span class="old">' . currency_format($product_by_cat['product_price_old']) . '</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="?mod=carts&action=add_cart&product_id=' . $product_by_cat['product_id'] . '" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="?mod=home&action=buy_now&product_id=' . $product_by_cat['product_id'] . '" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>';
                        }
                    } else {
                        $output .= "<p class='error'>Hiện không tồn tại sản phẩm nào !</p>";
                    }
    $output .=      '</ul>
                </div>';
    if(!empty($list_product_by_page)) {
        $output .= '<div class="section" id="paging-wp">
                        <div class="section-detail" id="pagging-filter">
                            <ul class="list-item clearfix">
                                ' .get_pagging_product($num_page, $page, $cat_id). '
                            </ul>
                        </div>
                    </div>';
    }   
    $data = array(
        'output' => $output,
    );
    echo json_encode($data);
}

#Hàm phân trang danh mục theo sản phẩm
function pagination_catAction()
{
    if (isset($_POST['cat_id'])) {
        $cat_id = $_POST['cat_id'];
        $cat = db_fetch_assoc("SELECT `cat_title` FROM `tbl_products_cat` WHERE `cat_id` = '{$cat_id}'");
    }
    $output = '';
    $query = "SELECT * FROM `tbl_products` WHERE `product_status` = 'Approved' AND (`parent_cat` = '{$cat['cat_title']}' OR `product_brand` = '{$cat['cat_title']}' OR `product_type` = '{$cat['cat_title']}') ";
    #Lọc sản phẩm theo giá
    if (isset($_POST['price'])) {
        $price = implode('', $_POST['price']);
        if ($price == 1) {
            $query .= 'AND `product_price_new` < 500000 ';
        }
        if ($price == 2) {
            $query .= 'AND `product_price_new`  >= 500000 AND `product_price_new` < 1000000 ';
        }
        if ($price == 3) {
            $query .= 'AND `product_price_new`  >= 1000000 AND `product_price_new` < 5000000 ';
        }
        if ($price == 4) {
            $query .= 'AND `product_price_new`  >= 5000000 AND `product_price_new` < 10000000 ';
        }
        if ($price == 5) {
            $query .= 'AND `product_price_new`  >= 10000000 ';
        }
    }
    #Lọc theo nhãn hiệu
    if (isset($_POST['product_brand']) && !empty($_POST['product_brand'])) {
        $brand = implode(',', $_POST['product_brand']);
        $query .= "AND (`parent_cat` IN('{$brand}') OR `product_brand` IN('{$brand}') OR `product_type` IN('{$brand}')) ";
    }
    #Lọc theo sắp xếp
    if (isset($_POST['arrange']) && !empty($_POST['arrange'])) {
        $arrange = $_POST['arrange'];
        if ($arrange == 1) {
            $query .= 'ORDER BY `product_title` ASC ';
        }
        if ($arrange == 2) {
            $query .= 'ORDER BY `product_title` DESC ';
        }
        if ($arrange == 3) {
            $query .= 'ORDER BY `product_price_new` DESC ';
        }
        if ($arrange == 4) {
            $query .= 'ORDER BY `product_price_new` ASC ';
        }
    }
    $list_products_by_cat = db_fetch_array($query);
    #Phân trang
    #1)Tổng số bảng ghi có (sẩn phẩm) = 5
    $total_row = count($list_products_by_cat);
    #2)Số sản phẩm muốn hiển thị trên 1 trang
    $num_per_page = 12;
    #3)Số trang phân được 
    $num_page = ceil($total_row / $num_per_page);
    #4)Kiểm tra xem nếu có số trang từ url rồi, or cho số nguyên mặc định bắt đầu = 1
    if (isset($_POST['page']) && !empty($_POST['page'])) {
        $page = (int) $_POST['page'] ? (int) $_POST['page'] : 1;
        if ($_POST['page'] == '<i class="fa fa-angle-left"></i>') {
            if ($page < 1) {
                $page = 1;
            } else {
                $page -= 1;
            }
        }
        if ($_POST['page'] == '<i class="fa fa-angle-right"></i>') {
            if ($page = $num_page) {
                $page = $num_page;
            } else {
                $page += 1;
            }
        }
    } else {
        $page = 1;
    }
    #5)Tính chỉ số bắt đầu
    $start = ($page - 1) * $num_per_page;
    $list_product_by_page = array_slice($list_products_by_cat, $start, $num_per_page);
    $output .= '<div class="section-detail">     
                    <ul class="list-item clearfix">';
                    if (!empty($list_product_by_page)) {
                        foreach ($list_product_by_page as $product_by_cat) {
                            $output .= '
                            <li>
                                <a href="?mod=products&action=detail_product&product_id=' . $product_by_cat['product_id'] . '" title="" class="thumb">
                                    <img src="admin/' . $product_by_cat['product_thumb'] . '">
                                </a>
                                <a href="?mod=products&action=detail_product&product_id=' . $product_by_cat['product_id'] . '" title="" class="product-name">' . $product_by_cat['product_title'] . '</a>
                                <div class="price">
                                    <span class="new">' . currency_format($product_by_cat['product_price_new']) . '</span>
                                    <span class="old">' . currency_format($product_by_cat['product_price_old']) . '</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="?mod=carts&action=add_cart&product_id=' . $product_by_cat['product_id'] . '" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="?mod=home&action=buy_now&product_id=' . $product_by_cat['product_id'] . '" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>';
                        }
                    } else {
                        $output .= "<p class='error'>Không tồn tại sản phẩm nào!</p>";
                    }
    $output .=      '</ul>
                </div>';
    if(!empty($list_product_by_page)) {
        $output .= '<div class="section" id="paging-wp">
                        <div class="section-detail" id="pagging-filter">
                            <ul class="list-item clearfix">
                                ' . get_pagging_cat($num_page, $page, $cat_id). '
                            </ul>
                        </div>
                    </div>';
    }      
    $data = array(
        'output' => $output,
        'num_page' => $num_page,
        'num_filter'=> $total_row,
    );
    echo json_encode($data);
}


