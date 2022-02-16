<?php get_header(); 

#Kiểm tra có giá trị order_id ko ? nếu có lấy order theo id đó xuống từ url 
if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    $payment = get_inf_order('payment', $order_id);
    $status = get_inf_order('order_status', $order_id);
}

?>
<!-- Lấy phần header -->
<div id="main-content-wp" class="add-cat-page">
    <div class="wrap clearfix">
        <?php get_sidebar(); ?>
        <!-- Lấy phần sidebar -->
        <div id="content" class="fl-right">
            <div class="section" id="title-page">
                <div class="clearfix">
                    <h3 id="index" class="fl-left">Cập nhập đơn hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST" enctype="multipart/form-data">
                        <?php echo form_error('order'); ?>

                        <label for="customer_name">Tên khách hàng</label>
                        <input type="text" name="customer_name" id="code" readonly="readonly" value="<?php echo get_inf_order('customer_name', $order_id) ?>">
                        <?php echo form_error('customer_name'); ?>
                        
                        <label for="order_code">Mã đơn hàng</label>
                        <input type="text" name="order_code" id="code" readonly="readonly" value="<?php echo get_inf_order('order_code', $order_id) ?>">
                        <?php echo form_error('order_code'); ?>

                        <label for="total_num">Số sản phẩm</label>
                        <input type="text" name="total_num" id="total_num" value="<?php echo get_inf_order('total_num', $order_id) ?>">
                        <?php echo form_error('total_num'); ?>
                        
                        <label for="total_price">Tổng giá</label>
                        <input type="text" name="total_price" id="total_price" value="<?php echo get_inf_order('total_price', $order_id) ?>">
                        <?php echo form_error('total_price'); ?>
                       
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" value="<?php echo get_inf_order('address', $order_id) ?>">
                        <?php echo form_error('address'); ?>

                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" value="<?php echo get_inf_order('phone', $order_id) ?>">
                        <?php echo form_error('phone'); ?>

                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo get_inf_order('email', $order_id) ?>">
                        <?php echo form_error('email'); ?>
                    
                        <label>Hình thức thanh toán</label>
                        <select name="payment">
                            <option <?php if (!empty($payment) && $payment == 'Thanh toán tại nhà') echo "selected='selected'"; ?> value='1'>Thanh toán tại nhà</option>
                            <option <?php if (!empty($payment) && $payment == 'Thanh toán ngân hàng') echo "selected='selected'"; ?> value='2'>Thanh toán ngân hàng</option>
                        </select>
                        <?php echo form_error('payment'); ?>

                        <label>Tình trạng đơn hàng</label>
                        <select name="order_status">
                                <option <?php if (!empty($status) && $status == 'Thành công') echo "selected='selected'"; ?> value='1'>Thành công</option>
                                <option <?php if (!empty($status) && $status == 'Đang vận chuyển') echo "selected='selected'"; ?> value='2'>Đang vận chuyển</option>
                                <option <?php if (!empty($status) && $status == 'Hủy đơn hàng') echo "selected='selected'"; ?> value='3'>Hủy đơn hàng</option>                           
                        </select>
                        <?php echo form_error('order_status')?>

                        <button type="submit" name="btn-update-order" id="btn-submit">Cập nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- Lấy phần footer -->


