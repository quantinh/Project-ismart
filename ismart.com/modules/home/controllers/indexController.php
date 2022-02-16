<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct() 
{
    load_model('index');
    load('helper', 'format');
    load('lib', 'validation');
    load('lib', 'search');
    load('lib', 'pagging');
    load('lib','cart');
}

#Hàm load trang index
function indexAction() 
{
    load_view('index');
}

#Hàm tìm kiếm sản phẩm
function search_productsAction()
{
    global $value;
    #Kiểm tra nhập ô tìm kiếm
    if (isset($_POST['sm_s'])) {
        #Kiếm tra đã nhấn tìm kiếm chưa nếu có load trang view tìm kiếm
        if (!empty($_POST['value'])) {
            $value = $_POST['value'];
            load_view('search_products', $value);
        #Ngược lại thì trả về trang chủ
        } else {
            load_view('index');
        }
    } else {
        load_view('index');
    }
}

#Hàm lọc tìm kiếm sản phẩm
function search_filterAction()
{
    load_view('search_products');
}

#load trang mua ngay 
function buy_nowAction() 
{
    #Kiểm tra xem có đã đăng nhập chưa?
    if($_SESSION['is_login']) {
        load_view('buy_now');
    #Nếu chưa login thì bắt người dùng phải đăng nhập 
    } else {
        redirect("dang-nhap.html");
    }
}

#load trang đặt hàng
function orderAction()
{
    global $error, $product_id, $fullname, $email, $phone, $address, $note, $payment;
    $product_id = $_GET['product_id'];
    if (isset($_POST['btn-order'])) {
        $error = array();
        #Kiểm tra họ tên
        if (empty($_POST['fullname'])) {
            $error['info'] = '(*) Không được để trống thông tin khách hàng !';
        } else {
            $fullname = $_POST['fullname'];
        }
        #Kiểm tra địa chỉ email
        if (empty($_POST['email'])) {
            $error['info'] = '(*) Không được để trống thông tin khách hàng !';
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = '(*) Email không đúng định dạng !';
            } else {
                $email = $_POST['email'];
            }
        }
        #Kiểm tra địa chỉ liên hệ
        if (empty($_POST['address'])) {
            $error['info'] = "(*) Không được để trống địa chỉ để liên lạc !";
        } else {
            $address = $_POST['address'];
        }
        #Kiểm tra số điện thoại
        if (empty($_POST['phone'])) {
            $error['info'] = '(*) Không được để trống thông tin khách hàng !';
        } else {
            if (!is_phone_number($_POST['phone'])) {
                $error['phone'] = '(*) Bạn cần nhập số điện thoại đúng định dạng !';
            } else {
                $phone = $_POST['phone'];
            }
        }
        #Kiểm tra có nội dung ghi chú thêm chưa?
        if (!empty($_POST['note'])) {
            $note = $_POST['note'];
        }
        #Kiểm tra phương thức thanh toán
        if (empty($_POST['payment-method'])) {
            $error['payment'] = 'Bạn cần chọn hình thức thanh toán !';
        } else {
            $payment = $_POST['payment-method'];
        }
        #Kiểm tra nếu ko tồn tại lỗi thì insert dl
        if (empty($error)) {
            $data_order = array(
                'order_code' => 'MKGP' . time(),
                'total_num' => 1,
                'total_price' => get_inf_product('product_price_new', $product_id),
                'order_status' => 'Đang vận chuyển',
                'customer_name' => $fullname,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'payment' => $payment,
                'note' => $note,
                'create_date' => date('d/m/Y H:i:s'),
            );
            #Thêm vào đơn hàng 
            insert_order($data_order);
            $data_customer = array(
                'customer_name' => $fullname,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'create_date' => date('d/m/Y H:i:s'),
            );
            $data_order_update = array(
                'customer_name' => $fullname,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
            );
            $num_customer = get_num_customer($phone);
            if ($num_customer > 0) {
                update_customer($data_customer, $phone);
                update_order_by_phone($data_order_update, $phone);
            } else {
                insert_customer($data_customer);
            }
            #Lấy sản phẩm theo đơn hàng
            $data_products_order = array(
                'order_code' => 'MKGP' . time(),
                'product_qty' => 1,
                'sub_total' => get_inf_product('product_price_new', $product_id),
                'product_id' => $product_id,
            );
            insert_product_order($data_products_order);
            $error['success'] = "Đặt hàng thành công !" . "<br>" . "<a href= 'trang-chu.html'>Trở về trang chủ</a>";
        }
        load_view('buy_now');
    }
}

#Hàm phân trang tìm kiếm sản phẩm
function pagination_searchAction()
{
    if (isset($_POST['cat_id'])) {
        $cat_id = $_POST['cat_id'];
        $cat = db_fetch_assoc("SELECT `cat_title` FROM `tbl_products_cat` WHERE `cat_id` = '{$cat_id}'");
    }
    if (isset($_POST['value'])) {
        $value = $_POST['value'];
    }
    $result_search = '';
    $query = "SELECT * FROM `tbl_products` WHERE `parent_cat` = '{$cat['cat_title']}' AND (CONVERT(`product_title` USING utf8) LIKE '%$value %' OR  CONVERT(`product_code` USING utf8) LIKE '%$value %') ";
    #Lọc theo sắp xếp 
    if (isset($_POST['select']) && !empty($_POST['select'])) {
        $select = $_POST['select'];
        if ($select == 1) {
            $query .= 'ORDER BY `product_title` ASC ';
        }
        if ($select == 2) {
            $query .= 'ORDER BY `product_title` DESC ';
        }
        if ($select == 3) {
            $query .= 'ORDER BY `product_price_new` DESC ';
        }
        if ($select == 4) {
            $query .= 'ORDER BY `product_price_new` ASC ';
        }
    }
    $list_search = db_fetch_array($query);
    #Phân trang
    #1)Tổng số bảng ghi có (sẩn phẩm) = 5
    $total_row = count($list_search);
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
    $start = ($page - 1) * $num_per_page;
    $list_product_by_page = array_slice($list_search, $start, $num_per_page);
    $result_search .= '
        <div class="section-detail">
            <ul class="list-item clearfix">';
            if (!empty($list_product_by_page)) {
                foreach ($list_product_by_page as $product_by_cat) {
                    $result_search .= '
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
            }
    $result_search .= '</ul>
        </div>';
    if (!empty($list_product_by_page)) {
        $result_search .= '<div class="section" id="paging-wp">
                                <div class="section-detail">
                                    <ul class="list-item clearfix">
                                    ' . get_pagging_search($num_page, $page, $cat_id, $value) . '
                                </div>
                            </div>';
    }
    $data = array(
        'result_search' => $result_search,
    );
    echo json_encode($data);
}

#Hàm phân trang sản phẩm trang chủ
function pagination_homeAction()
{
    #Kiểm tra nếu tồn tại cat_id thì lấy xuống
    if(isset($_POST['cat_id'])) {
        $cat_id = (int)$_POST['cat_id'];
        $cat = db_fetch_assoc("SELECT `cat_title` FROM `tbl_products_cat` WHERE `cat_id` = '{$cat_id}'");
    }
    $output = '';
    $query = "SELECT* FROM `tbl_products` WHERE `product_status` = 'Approved' AND (`parent_cat` = '{$cat['cat_title']}' OR `product_brand` = '{$cat['cat_title']}' OR `product_type` = '{$cat['cat_title']}') ";
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
    $start = ($page - 1) * $num_per_page;
    $list_product_by_page = array_slice($list_products_by_cat, $start, $num_per_page);
    $output .= '
        <div class="section-detail">
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
            }
$output .= '</ul>
        </div>';
    if (!empty($list_product_by_page)) {
        $output .= '<div class="pagging clearfix">
                        ' . get_pagging_home($num_page, $page, $cat_id) . '
                    </div>';
    }
    $data = array(
        'output' => $output,
    );
    echo json_encode($data);
}