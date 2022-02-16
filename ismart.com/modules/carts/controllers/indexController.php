<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct()
{
    load('helper', 'format');
    load('lib', 'validation');
    load('lib', 'search');
    load('lib', 'pagging');
    load('lib','cart');
    load_model('index');
}

#Hàm load trang index
function indexAction()
{
    $data['list_buy'] = get_list_buy_cart();
    $data['num_order'] = get_num_order_cart();
    load_view('showCart', $data);
}

#Hàm thêm vào giỏ hàng
function add_cartAction()
{
    #Thêm vào giỏ hàng và chuyển hướng
    add_cart();
    redirect('gio-hang.html');
    load_view('showCart');
}

#Hàm xóa giỏ hàng
function delete_cartAction()
{
    #Lấy sản phẩm theo id xuống
    $product_id = (int) $_GET['product_id'];
    #Xóa dữ liệu và chuyển hướng
    delete_cart($product_id);
    redirect('gio-hang.html');
}

#Xóa tất cả trong giỏ hàng
function delete_allAction() 
{
    #Lấy sản phẩm theo id xuống
    $product_id = (int) $_GET['product_id'];
    #Xóa dữ liệu và chuyển hướng
    delete_cart($product_id);
    redirect('gio-hang.html');
}

#Hàm cập nhập giỏ hàng bằng ajax
function update_cartAction()
{
    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];
    //Lấy thông tin sản phẩm
    $item = get_inf_product($product_id);
    //Kiểm tra thử trong giỏ hàng có tồn tại key:$id hay chưa ?
    if(isset($_SESSION['cart']) && array_key_exists($product_id, $_SESSION['cart']['buy'])) {
        #cập nhật số lượng
        $_SESSION['cart']['buy'][$product_id]['qty'] = $qty;
        #Cập nhật số tiền thanh toán
        $sub_total = $qty * $item['product_price_new'];
        $_SESSION['cart']['buy'][$product_id]['sub_total'] = $sub_total;
        #Cập nhật thông tin giỏ hàng
        update_inf_cart();
        $inf_cart = get_inf_cart();
        #Lấy tổng giá trị trong giỏ hàng
        $total = get_total_cart();
        #Giá trị trả về
        $data = array(
            'sub_total'=> currency_format($sub_total),
            'total' => currency_format($total),
        );
        echo json_encode($data);
    }
}

#Hàm đặt sản phẩm
function orderAction()
{
    global $error, $product_id, $fullname, $email, $phone, $address, $note, $payment;
    #Kiểm tra xem có tồn tại thì lấy xuống 
    if(!empty($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
    }
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
            $error['payment'] = '(*) Bạn cần chọn hình thức thanh toán !';
        } else {
            $payment = $_POST['payment-method'];
        }
        #Kiểm tra nếu ko tồn tại lỗi thì insert dl
        if (empty($error)) {
            $data_order = array(
                'order_code' => 'MKGP' . time(),
                'total_num' => $_SESSION['cart']['info']['num_order'],
                'total_price' => $_SESSION['cart']['info']['total'],
                'order_status' => 'Đang vận chuyển',
                'customer_name' => $fullname,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'payment' => $payment,
                'note' => $note,
                'create_date' => date('d/m/Y H:i:s'),
            );
            #Thêm vào đăt hàng 
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
            #Lấy danh sách giỏ hàng 
            $list_buy = get_list_by_cart();
            foreach ($list_buy as $product){
                $data_products_order = array(
                    'order_code' => 'QTAD'.time(),
                    'product_qty' => $product['product_qty'],
                    'sub_total' => $product['sub_total'],
                    'product_id' => $product['product_id'],
                );
                #Thêm sản phẩm theo đơn hàng vào csdl
                add_product_order($data_products_order);
            }
            $error['success'] = "Đặt hàng thành công !" . "<br>" . "<a href= 'trang-chu.html'>Trở về trang chủ</a>";
            unset($_SESSION['cart']);
        }
    load_view('checkout');
    }
}

#Hàm thanh toán sản phẩm
function checkoutAction()
{
    #Kiểm tra xem có đã login chưa?
    if($_SESSION['is_login']) {
        #Nếu đã login kt xem có tồn tại giỏ hàng, thông tin và sản phẩm thì cho thanh toán và ngược lại thì hiển thị hiển thị giỏ hàng trống
        if(isset($_SESSION['cart']) && $_SESSION['cart']['info']['num_order'] > 0) {
            load_view('checkout');
        } else {
            load_view('showCart');
        }
    #Nếu chưa login thì bắt người dùng phải đăng nhập or đăng kí
    } else {
        redirect("dang-nhap.html");
    }
}
