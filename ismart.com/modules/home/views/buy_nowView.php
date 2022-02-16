<!-- Lấy phần header -->
<?php get_header();

#Lấy sản phẩm theo id xuống
global $product_id;
if(isset($_GET['product_id'])) {
    $product_id = (int)$_GET['product_id'];
}
// show_array($product_id);
?>
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="trang-chu.html" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="thanh-toan.html" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form method="POST" action="dat-hang-<?php echo $product_id?>-or.html" name="form-checkout">
        <div id="wrapper" class="wp-inner clearfix">
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <?php echo form_error('success')?>
                <?php echo form_error('info')?>
                <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname" value="<?php echo set_value('fullname'); ?>">
                        </div>

                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value="<?php echo set_value('email'); ?>">
                        </div>
                    </div>

                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" value="<?php echo set_value('address'); ?>">
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" value="<?php echo set_value('tel'); ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note" row="10" cols="75" placeholder="Ghi rõ địa chỉ số nhà Xã/Phường, Quận/Huyện, Tỉnh/Thành phố !"><?php set_value('note') ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Sản phẩm</td>
                                <td>Tổng</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="cart-item">
                                <td class="product-name"><?php echo get_inf_product('product_title', $product_id) ?><strong class="product-quantity">x <?php echo get_inf_product('product_qty', $product_id) ?></strong></td>
                                <td class="product-total"><?php echo currency_format(get_inf_product('product_price_new', $product_id)) ?></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng đơn hàng:</td>
                                <td><strong class="total-price"><?php echo currency_format(get_inf_product('product_price_new', $product_id)) ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- Method-payment -->
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <li>
                                <input type="radio" id="direct-payment" name="payment-method" value="direct-payment">
                                <label for="direct-payment">Thanh toán tại cửa hàng</label>
                            </li>
                            <li>
                                <input type="radio" id="payment-home" name="payment-method" value="payment-home">
                                <label for="payment-home">Thanh toán tại nhà</label>
                            </li>
                            <?php echo form_error('payment') ?>
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" name="btn-order" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- Lấy phần footer -->
<?php get_footer(); ?>