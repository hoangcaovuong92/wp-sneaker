<?php
/**
 * Review order table
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<table class="shop_table woocommerce-checkout-review-order-table">
	<thead>
		<tr>
			<th class="product-name"><?php _e( 'Item', 'wpdance' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'wpdance' ); ?></th>
			<th class="product-total"><?php _e( 'Total', 'wpdance' ); ?></th>
		</tr>
	</thead>
	<tfoot>
		<tr class="cart-subtotal">
			<th><?php _e( 'Cart Total', 'wpdance' ); ?></th>
			<td colspan="2"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="discount cart-discount coupon-<?php echo esc_attr( $code ); ?>">
				<th><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td colspan="2"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action('woocommerce_review_order_before_shipping'); ?>
			<?php wc_cart_totals_shipping_html(); ?>
			<?php do_action('woocommerce_review_order_after_shipping'); ?>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>

			<tr class="fee fee-<?php echo $fee->id ?>">
				<th><?php echo esc_html( $fee->name ); ?></th>
				<td colspan="2"><?php
					wc_cart_totals_fee_html( $fee );
				?></td>
			</tr>

		<?php endforeach; ?>

		<?php
			// Show the tax row if showing prices exlcusive of tax only
			if ( WC()->cart->tax_display_cart == 'excl' ) {
				if ( get_option( 'woocommerce_tax_total_display' ) === 'itemized' ){
					foreach ( WC()->cart->get_tax_totals() as $code => $tax ) {
						echo '<tr class="tax-rate tax-rate-' . $code . '">
							<th>' . esc_html( $tax->label ) . '</th>
							<td colspan="2">' . wp_kses_post( $tax->formatted_amount ) . '</td>
						</tr>';
					}
				}
				else{
					echo '<tr class="tax-total">
						<th>'. esc_html( WC()->countries->tax_or_vat() ).'</th>
						<td colspan="2">'. wc_price( WC()->cart->get_taxes_total() ). '</td>
					</tr>';
				}
			}
		?>

		<?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

		<tr class="total">
			<th><?php _e( 'Order Total', 'wpdance' ); ?></th>
			<td colspan="2">
				<?php wc_cart_totals_order_total_html(); ?>
			</td>
		</tr>

		<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>

	</tfoot>
	<tbody>
		<?php
			do_action( 'woocommerce_review_order_before_cart_contents' );

			if (sizeof(WC()->cart->get_cart())>0) :
				$number_item = count(WC()->cart->get_cart());
				$showed_item = 0;
				foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
					$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$showed_item++;
					if($number_item>1){
						$class_row = ($showed_item==1)?" first":(($showed_item==$number_item)?" last":"");
					}
					else{
						$class_row = " first last";
					}
					$class_row .= " checkout_table_item";
					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) :
						$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						echo '
							<tr class="' . esc_attr( apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ) . $class_row . '">
								<td class="product-name">' .
									'<div class="wd-product-name"><div class="wd_product_item"><a href="'.get_permalink( $cart_item['product_id'] ).'">'
										.$_product->get_image().
									'</a>'.
									'</div><p class="wd_product_title">'.apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) .
									'<span class="wd_product_number">'.apply_filters( 'woocommerce_checkout_cart_item_quantity', '<strong class="product-quantity">&times; ' . $cart_item['quantity'] . '</strong>', $cart_item, $cart_item_key ) .'</span></p>'.
									
									wc_get_formatted_cart_item_data($cart_item) .
								'</div></td>
								<td class="product-price">'.$product_price.'</td>
								<td class="product-total">' . apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ) . '</td>
							</tr>';
					endif;
				endforeach;
			endif;
			
			do_action( 'woocommerce_review_order_after_cart_contents' );
		?>
	</tbody>
</table>
