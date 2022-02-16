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
}

#Hàm load index
function indexAction()
{
    load_view('indexCustomer');
}

#Hàm cập nhập khách hàng
function updateCustomerAction() 
{
    global $error, $customer_name, $old_customer_name, $address, $old_address, $email, $old_email,$phone, $old_phone, $payment, $old_payment,$order_status, $old_order_status, $phone_id, $data;
    if(isset($_GET['customer_id'])) {
        $customer_id = $_GET['customer_id'];
    }
    if (isset($_POST['btn-update-customer'])) {
        #Mảng chữa lỗi ?
        $error = array();
        #Kiểm tra tên khách hàng
        if (empty($_POST['customer_name'])) {
            $error['customer_name'] = "(*) Bạn chưa điền họ tên khách hàng !";
        } else {
            $old_customer_name = get_inf_customer('customer_name', $customer_id);
             #Nếu tiêu đề cũ giống với tiêu đề mới thì lưu vào $data hiển thị 
            if ($_POST['customer_name'] == $old_customer_name) {
                $data = array (
                    'customer_name' => '',
                );
                update_customer($data, $customer_id);
            } 
            if(is_exists('tbl_customers', 'customer_name', $_POST['customer_name'])) {
                $error['customer_name'] = '(*) Tên khách hàng đã tồn tại !';
            } else {
                $customer_name = $_POST['customer_name'];
            }
        }
        #Kiểm tra địa chỉ
        if (empty($_POST['address'])) {
            $error['address'] = "(*) Bạn chưa điền địa chỉ khách hàng !";
        } else {
            $old_address = get_inf_customer('address', $phone_id);
            $address = $_POST['address'];
        } 
        #Kiểm tra email
        if (empty($_POST['email'])) {
            $error['email'] = "(*) Bạn chưa điền email !";
        } else {
            $old_email = get_inf_customer('email', $phone_id);
            $email = $_POST['email'];
        }
        #Kiểm tra số điện thoại
        if (empty($_POST['phone'])) {
            $error['phone'] = "(*) Bạn chưa điền số điện thoại !";
        } else {
            $old_phone = get_inf_customer('phone', $phone_id);
            $phone = $_POST['phone'];
        }
        #Kiểm tra có thay đổi ko nếu giống nhau thì cập nhập vào csdl, báo lỗi ko thay đổi
        if(($customer_name == $old_customer_name) && ($address == $old_address) && ($email == $old_email) && ($phone == $old_phone)) {
            $data = array(
                'customer_name' => $customer_name,
                'phone' => $phone
            );
            update_customer($data, $customer_id);
            $error['customer'] = '(*) Đơn hàng chưa có thay đổi gì!';
        }
        #Kiểm tra nếu không tồn tại lỗi
        if (empty($error)) {
            #Và chấp nhận lưu trữ các thông tin member mới vào CSDL
            $data = array(
                'customer_name' => $customer_name,
                'address' => $address,
                'email' => $email,
                'phone' => $phone,
            );
            update_customer($data, $customer_id);
            // show_array($data);
            $error['customer'] = "Cập nhật khách hàng thành công !" . "<br>" . "<a href='?mod=Orders&controller=customer&action=index'>Trở về danh sách khách hàng</a>";
        }
    }
    load_view('updateCustomer');
}

#Hàm xóa khách hàng
function deleteCustomerAction()
{
    $phone = (int)$_GET['phone'];
    $list_order_by_phone = get_list_order_by_phone($phone);
    delete_orders_by_phone($phone);
    delete_customers($phone);
    foreach($list_order_by_phone as $order){
        delete_product_order($order['order_code']);
    }
    load_view('indexCustomer');
}

#Hàm tìm kiếm khách hàng
function searchCustomerAction()
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
            #Tổng số bán hàng = hàm làm tròn (15/5) = 3
            $total_row = count($list_orders_all);
            $num_order = ceil($total_row / $num_per_order);
            load_view('searchCustomer');
        } else {
            $error['error'] = '(*) Bạn cần nhập thông tin khách hàng cần tìm kiếm !';
            load_view('indexCustomer');
        }
    }
}

#Hàm trả về kết quả tìm kiếm khách hàng
function resultSearchAction()
{
    global $value;
    #Kiểm tra có giá trị thì get xuống 
    if(!empty($_GET['value'])) {
        $value = $_GET['value'];
    }
    load_view('searchCustomer');
}   

#Hàm tác vụ của khách hàng
function applyCustomerAction()
{
    if (isset($_POST['sm_action'])) {
        global $error;
        $error = array();
        if(!empty($_POST['checkItem'])) {
            $list_customer_phone = $_POST['checkItem'];
        }
        if (!empty($_POST['actions'])) {
            if ($_POST['actions'] == 1) {
                if (isset($_POST['checkItem'])) {
                    foreach ($list_customer_phone as $customer_phone) {
                        $list_order_by_phone = get_list_order_by_phone($customer_phone);
                        delete_orders_by_phone($customer_phone);
                        delete_customers($customer_phone);
                        foreach($list_order_by_phone as $order){
                            delete_product_order($order['order_code']);
                        }
                    }
                    if(isset($_GET['value'])) {
                        load_view('search_customers');
                    } else {
                        load_view('customerIndex');
                    }
                } else {
                    $error['select'] = "Bạn chưa lựa chọn khách hàng cần xóa";
                    if(isset($_GET['value'])) {
                        load_view('search_customers');
                    } else {
                        load_view('customerIndex');
                    }
                }
            }
        } else {
            $error['select'] = "Bạn chưa lựa chọn tác vụ";
            if(isset($_GET['value'])){
                load_view('searchCustomers');
            } else {
                load_view('indexCustomer');
            }
        }
    }
}
           











