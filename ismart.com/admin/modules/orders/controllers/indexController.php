<?php

#Hàm khởi tạo load những thư viện cần thiết cho các action 
function construct()
{
    load_model('index');
    load('lib', 'validation');
    load('helper', 'slug');
    load('lib', 'pagging');
    load('lib', 'status');
    load('lib', 'search');
    load('helper', 'format');
}

#Hàm load index
function indexAction()
{
    load_view('indexOrder');
}

#Hàm load chi tiết đơn hàng
function detailOrderAction()
{
    load_view('detailOrder');
}

#Hàm Thêm tình trạng đơn Hàng
function statusOrderAction()
{
    $order_id = $_GET['order_id'];
    $order_status = get_inf_order('order_status', $order_id);
    if (isset($_POST['sm_status'])) {
        global $error, $order_status, $data;
        $error = array();
        if (!empty($_POST['order_status'])) {
            if($_POST['order_status'] == 1) {
                if ($order_status == 'Thành công') {
                    $error['transport'] = '(*) Bạn cần thay đổi trạng thái đơn hàng !';
                } else { 
                    $data = array (
                        'order_status' => 'Thành công',
                    );
                update_order($data, $order_id);
                    $error['transport'] = 'Cập nhập trạng thái đơn hàng thành công !';
                }
            } else if($_POST['order_status'] == 2) {
                if ($order_status == 'Đang vận chuyển') {
                    $error['transport'] = '(*) Bạn cần thay đổi trạng thái đơn hàng !';
                } else { 
                    $data = array (
                        'order_status' => 'Đang vận chuyển',
                    );
                update_order($data, $order_id);
                    $error['transport'] = 'Cập nhập trạng thái đơn hàng thành công !';
                }
            } else if($_POST['order_status'] == 3) {
                if ($order_status == 'Hủy đơn hàng') {
                    $error['transport'] = '(*) Bạn cần thay đổi trạng thái đơn hàng !';
                } else { 
                    $data = array (
                        'order_status' => 'Hủy đơn hàng',
                    );
                update_order($data, $order_id);
                    $error['transport'] = 'Cập nhập trạng thái đơn hàng thành công !';
                }
            } 
        }       
    }
    load_view('detailOrder');
}

#Hàm cập nhập đơn hàng
function updateOrderAction() 
{
    global $error, $customer_name, $old_customer_name, $order_code, $old_order_code, $total_num, $old_total_num, $total_price, $old_total_price, $address, $old_address, $email, $old_email, $phone, $old_phone, $payment, $old_payment, $order_status, $old_order_status, $data;
    #kiểm tra đã lấy được id theo đặt hàng chưa?
    if(isset($_GET['order_id'])){
        $order_id = $_GET['order_id'];
    }
    // show_array($_GET);
    if (isset($_POST['btn-update-order'])) {
        #Mảng chữa lỗi ?
        $error = array();
        #Kiểm tra mã đơn hàng
        #Kiểm tra tên khách hàng
        if (empty($_POST['customer_name'])) {
            $error['customer_name'] = "(*) Bạn chưa điền tên khách hàng !";
        } else {
            $old_customer_name = get_inf_order('customer_name', $order_id);
            $customer_name = $_POST['customer_name'];
        }
        if (empty($_POST['order_code'])) {
            $error['order_title'] = "(*) Bạn chưa mã đơn hàng !";
        } else {
            $old_order_code = get_inf_order('order_code', $order_id);
            $order_code = $_POST['order_code'];
        }
        #Kiểm tra tổng số sản phẩm
        if (empty($_POST['total_num'])) {
            $error['total_num'] = "(*) Bạn chưa điền tổng số sản phẩm !";
        } else {
            $old_total_num = get_inf_order('total_num', $order_id);
            if(is_number($_POST['total_num'])) {
                $total_num = $_POST['total_num'];
            } else {
                $error['total_num'] = "(*) Bạn cần nhập sản phẩm đúng định dạng !";
            }
        }
        #Kiểm tra tổng đơn hàng
        if (empty($_POST['total_price'])) {
            $error['total_price'] = "(*) Bạn chưa điền tổng đơn hàng !";
        } else {
            $old_total_price = get_inf_order('total_price', $order_id);
            if(is_number($_POST['total_price'])) {
                $total_price = $_POST['total_price'];
            } else {
                $error['total_price'] = "(*) Bạn cần nhập tổng đơn hàng đúng định dạng !";
            }
        }
        #Kiểm tra địa chỉ
        if (empty($_POST['address'])) {
            $error['address'] = "(*) Bạn chưa điền địa chỉ !";
        } else {
            $old_address = get_inf_order('address', $order_id);
            $address = $_POST['address'];
        }
        #Kiểm tra số điện thoại
        if (empty($_POST['phone'])) {
            $error['phone'] = "(*) Bạn chưa điền số điện thoại !";
        } else {
            $old_phone = get_inf_order('phone', $order_id);
            $phone = $_POST['phone'];
        }
        #Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "(*) Bạn chưa điền email !";
        } else {
            $old_email = get_inf_order('email', $order_id);
            $email = $_POST['email'];
        }
        #Kiểm tra thanh toán
        if (empty($_POST['payment'])) {
            $error['payment'] = "(*) Bạn chưa chọn thanh toán!";
        } else {
            $old_payment = get_inf_order('payment', $order_id);
            $payment = show_payment($_POST['payment']);
        }
        #Kiểm tra trạng thái đơn hàng
        if (empty($_POST['order_status'])) {
            $error['order_status'] = "(*) Bạn chưa chọn trạng thái !";
        } else {
            $old_order_status = get_inf_order('order_status', $order_id);
            $order_status = show_status($_POST['order_status']);
        }
        #Kiểm tra có thay đổi ko nếu giống nhau thì cập nhập vào csdl, báo lỗi ko thay đổi
        if(($order_code == $old_order_code) && ($customer_name == $old_customer_name) && ($total_num == $old_total_num) && ($total_price == $old_total_price) && ($address == $old_address) && ($email == $old_email) && ($phone == $old_phone) && ($payment == $old_payment) && ($order_status == $old_order_status)) {
            $data = array(
                'order_code' => $order_code,
                'customer_name' => $customer_name
            );
            update_order($data, $order_id);
            $error['order'] = '(*) Đơn hàng chưa có thay đổi gì!';
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Và chấp nhận lưu trữ các thông tin member mới vào CSDL
            $data = array(
                'customer_name' => $customer_name,
                'total_price' => $total_price,
                'order_status' => $order_status,
                'payment' => $payment,
                'edit_date' => date('d/m/y h:m'),
                'address' => $address,
                'email' => $email,
                'phone' => $phone,
                'total_num' => $total_num,
            );
            update_order($data, $order_id);
            // show_array($data);
            $error['order'] = "Cập nhật đơn hàng thành công !" . "<br>" . "<a href='?mod=orders&controller=index&action=index'>Trở về danh sách bán hàng</a>";
        }
    }
    load_view('updateOrder');
}

#Hàm xóa bán hàng
function deleteOrderAction()
{
    #Lấy bán hàng theo id xuống
    $order_id = (int) $_GET['order_id'];
    #Xóa dữ liệu và chuyển hướng
    delete_order($order_id);
    redirect('?mod=orders&controller=index&action=index');
    load_view('indexOrder');
}

#Hàm tìm kiếm đơn hàng
function searchOrderAction()
{
    global $error, $value;
    if (isset($_GET['sm_s'])) {
        // show_array($_GET);
        if (!empty($_GET['value'])) {
            $value = $_GET['value'];
            // echo $value;
            #Tổng số lượng bảng ghi trên 1 bán hàng
            $num_per_order = 3;
            #Tổng sô bảng ghi lấy được
            $list_orders_all = db_search_all_orders($value);
            #Tổng số đơn hàng = hàm làm tròn (15/5) = 3
            $total_row = count($list_orders_all);
            // $num_Order = ceil($total_row / $num_per_Order);
            load_view('searchOrder');
        } else {
            $error['error'] = '(*) Bạn cần nhập thông tin bán hàng cần tìm kiếm !';
            load_view('indexOrder');
        }
    }
}

#Hàm trả về kết quả tìm kiếm đơn hàng
function resultSearchAction()
{
    global $value;
    #Kiểm tra có giá trị thì get xuống 
    if(!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('searchOrder');
}   

#Hàm tác vụ các đơn hàng
function applyOrderAction()
{
    if (isset($_POST['sm_action'])) {
        global $error, $data;
        if (is_login() && check_role($_SESSION['user_login']) == 1) {
            $error = array();
            if (!empty($_POST['checkItem'])) {
                $list_order_id = $_POST['checkItem'];
            }
            if (!empty($_POST['actions'])) {
                if ($_POST['actions'] == 1) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'order_status' => 'Thành công',
                        );
                        foreach ($list_order_id as $order_id) {
                            update_order($data, $order_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchOrder');
                        } else {
                            load_view('indexOrder');
                        }
                    #Và nếu không tồn tại thì báo lối
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn đơn hàng cần áp dụng";
                        #Và tiếp tục kiểm tra có giá trị hay không nếu có load view và ngược lại
                        if (isset($_GET['value'])) {
                            load_view('searchOrder');
                        } else {
                            load_view('indexOrder');
                        }
                    }
                }
                #kiểm tra xem actions có actions chờ phê duyệt hay không ? 
                if ($_POST['actions'] == 2) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'Order_status' => 'Đang vận chuyển',
                        );
                        foreach ($list_order_id as $order_id) {
                            update_Order($data, $order_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchOrder');
                        } else {
                            load_view('indexOrder');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn đơn hàng cần áp dụng";
                        if (isset($_GET['value'])) {
                            load_view('searchOrder');
                        } else {
                            load_view('indexOrder');
                        }
                    }
                }
                #kiểm tra xem actions có actions bỏ vào thùng rác hay không ? 
                if ($_POST['actions'] == 3) {
                    if (isset($_POST['checkItem'])) {
                        $data = array(
                            'Order_status' => 'Hủy đơn hàng',
                        );
                        foreach ($list_order_id as $order_id) {
                            update_Order($data, $order_id);
                        }
                        if (isset($_GET['value'])) {
                            load_view('searchOrder');
                        } else {
                            load_view('indexOrder');
                        }
                    } else {
                        $error['select'] = "(*) Bạn chưa lựa chọn đơn hàng cần xóa";
                        if (isset($_GET['value'])) {
                            load_view('searchOrder');
                        } else {
                            load_view('indexOrder');
                        }
                    }
                }
            } else {
                $error['select'] = '(*) Bạn chưa lựa chọn tác vụ !';
                if (isset($_GET['value'])) {
                    load_view('searchOrder');
                } else {
                    load_view('indexOrder');
                }
            }
        #Ngược lại nếu chưa login và ko có role = 1 thì báo lỗi tiếp tục kt và get xuống
        } else {
            $error['select'] = "(*) Bạn không có quyền thực hiện thao tác này!";
            if (isset($_GET['value'])) {
                load_view('searchOrder');
            } else {
                load_view('indexOrder');
            }
        }
    }
}






