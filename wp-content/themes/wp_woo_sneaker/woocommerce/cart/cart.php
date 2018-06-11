<?php
/**
 * Cart Page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<form action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
			<th class="product-thumbnail first"><?php _e( 'Items', 'wpdance' ); ?></th>
			<th class="product-price"><?php _e( 'Price', 'wpdance' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'wpdance' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'wpdance' ); ?></th>
			<th class="product-remove last"><?php _e( '', 'wpdance' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
		if ( sizeof( WC()->cart->get_cart() ) > 0 ) {
		
			$showed_item = 0;
			$number_item = count(WC()->cart->get_cart());
		
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				
				$showed_item++;
				if($number_item>1){
					$class_row = ($showed_item==1)?" first":(($showed_item==$number_item)?" last":"");
				}
				else{
					$class_row = " first last";
				}
				
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					?>
					<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); echo $class_row ?>">

						<!-- The thumbnail -->
						<td class="product-thumbnail product-name">
							<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
								echo '<div class="wd_product_item">';
								if ( ! $_product->is_visible() ) {
									echo $thumbnail;
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $_product->get_permalink( $cart_item ) ), $thumbnail );
								}
							
								echo '</div>';
								echo '<div class="product-title">';
								if ( ! $_product->is_visible() ) {
									echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
								} else {
									echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s </a>', esc_url( $_product->get_permalink( $cart_item ) ), $_product->get_title() ), $cart_item, $cart_item_key );
								}

								// Meta data
								echo wc_get_formatted_cart_item_data($cart_item);

                   				// Backorder notification
                   				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
                   					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'wpdance' ) . '</p>';
							
								echo '<p class="wd_product_number">'.apply_filters( 'woocommerce_checkout_item_quantity', '<strong class="product-quantity">&times; ' . $cart_item['quantity'] . '</strong>', $cart_item, $cart_item_key ).'</p>';
								//echo '<p class="wd_product_excerpt">'.substr(get_the_excerpt($_product->get_id()),0,60).'</p>';
								echo '</div>';
							?>
						

						<!-- Product Name -->
								
						</td>

						<!-- Product price -->
						<td class="product-price">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							?>
						</td>

						<!-- Quantity inputs -->
						<td class="product-quantity">
							<?php
								if ( $_product->is_sold_individually() ) {
									$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
								} else {

									$product_quantity = woocommerce_quantity_input( array(
										'input_name'  => "cart[{$cart_item_key}][qty]",
										'input_value' => $cart_item['quantity'],
										'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
										'min_value'   => '0'
									), $_product, false );
								}

								echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
							?>
						</td>

						<!-- Product subtotal -->
						<td class="product-subtotal">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
							?>
						</td>
						
						<td class="remove-product">
						<?php 
							//Remove from cart link
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( wc_get_cart_remove_url($cart_item_key) ), __( 'Remove this item', 'wpdance' ) ), $cart_item_key );
							echo '<span class="remove_text">'.__('Remove','wpdance').'</span>';
						?>
						</td>			
						
					</tr>
					<?php
				}
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
		<tr>
			<td colspan="6" class="actions">

			<input type="submit" class="button wd_update_button_invisible" name="update_cart" value="<?php _e( 'Update Cart', 'wpdance' ); ?>" /> 
			
			<?php do_action('woocommerce_cart_actions'); ?>

			<?php wp_nonce_field( 'woocommerce-cart' ); ?>	
			
			</td>
		</tr>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>

</form>

<div class="cart-collaterals">

	<?php woocommerce_shipping_calculator(); ?>	
	
	<form action="<?php echo esc_url( wc_get_cart_url()); ?>" method="post">	
		<div class="coupon_wrapper">
		
				<?php if ( WC()->cart->coupons_enabled() ) { ?>
					<div class="coupon">

						<label for="coupon_code"><?php _e( 'discount coupon', 'wpdance' ); ?></label> 
						<div class="content_coupon">
							<p><?php _e( 'Enter your coupon code if you have one', 'wpdance' ); ?></p>
							<input name="coupon_code" class="input-text" id="coupon_code" value="" /> 
							<input type="submit" class="button" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'wpdance' ); ?>" />
						</div>

						<?php do_action('woocommerce_cart_coupon'); ?>

					</div>
				<?php } ?>

		</div>
	</form>
	
	
	<?php woocommerce_cart_totals(); ?>

	<?php do_action('woocommerce_cart_collaterals'); ?>
	
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>