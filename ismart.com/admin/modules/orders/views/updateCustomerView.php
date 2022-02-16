<?php get_header(); 

#Kiểm tra có giá trị customer_id ko ? nếu có lấy xuống
if(isset($_GET['customer_id'])){
    $customer_id = $_GET['customer_id'];
    // show_array($_GET);
    // $num_order = get_inf_customer('num_order', $customer_id);
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
                    <h3 id="index" class="fl-left">Cập nhập khách hàng</h3>
                </div>
            </div>
            <div class="section" id="detail-page">
                <div class="section-detail">
                    <form method="POST">
                        <?php echo form_error('customer'); ?>

                        <label for="customer_name">Tên khách hàng</label>
                        <input type="text" name="customer_name" id="customer_name" value="<?php echo get_inf_customer('customer_name', $customer_id) ?>">
                        <?php echo form_error('customer_name'); ?>
                        
                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" value="<?php echo get_inf_customer('phone', $customer_id); ?>">
                        <?php echo form_error('phone'); ?>
 
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo get_inf_customer('email', $customer_id); ?>">
                        <?php echo form_error('email'); ?>
                       
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" value="<?php echo get_inf_customer('address', $customer_id); ?>">
                        <?php echo form_error('address'); ?>

                        <label for="num_order">Số đơn hàng</label>
                        <input type="text" name="num_order" id="address" value="<?php echo get_inf_customer('num_order', $customer_id); ?>">
                        <?php echo form_error('num_order'); ?>

                        <button type="submit" name="btn-update-customer" id="btn-submit">Cập nhập</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
<!-- Lấy phần footer -->


