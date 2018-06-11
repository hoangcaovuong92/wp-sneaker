<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product;

if ( ! $product->is_purchasable() ) return;
?>

<?php
	// Availability
	$availability = $product->get_availability();

	if ($availability['availability']) :
		echo apply_filters( 'woocommerce_stock_html', '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
    endif;
?>

<?php if ( $product->is_in_stock() ) : ?>
	<?php
	global $smof_data;
	if( $smof_data['wd_prod_price'] )
		add_action( 'woocommerce_before_add_to_cart_button', 'woocommerce_template_single_price', 1 );
	?>
	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<form class="cart product_detail" method="post" enctype='multipart/form-data'>
		<?php do_action('woocommerce_before_add_to_cart_button'); ?>
		<div class="clear"></div>
		<div class="single_add_to_cart_wrapper">
			<span class="quantity-text"><?php _e('Qty','wpdance'); ?></span>
			<?php
				if ( ! $product->is_sold_individually() )
					woocommerce_quantity_input( array(
						'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
						'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
					) );
			?>
			
					
			<?php do_action('woocommerce_after_add_to_cart_button'); ?>
			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />
			<button type="submit" class="single_add_to_cart_button button alt "><?php echo apply_filters('single_add_to_cart_text', __( 'Add to cart', 'wpdance' ), $product->get_type()); ?></button>
		</div>
		<div class="clear"></div>
	</form>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>
	<?php remove_action( 'woocommerce_before_add_to_cart_button', 'woocommerce_template_single_price', 1 ); ?>
<?php endif; ?>