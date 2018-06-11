<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop,$smof_data;//$category_prod_datas;


// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );


// Ensure visibility
if ( ! $product->is_visible() )
	return;
	
	
// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
/*$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
*/
	
?>
<div <?php post_class(); ?>>
	<div class="product_item_wrapper">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
			<div class="product_thumbnail_wrapper">

				<a href="<?php the_permalink(); ?>">
				
					<?php
						/**
						 * woocommerce_before_shop_loop_item_title hook
						 *
						 * @hooked woocommerce_show_product_loop_sale_flash - 10
						 * @hooked woocommerce_template_loop_product_thumbnail - 10
						 */
						 
						do_action( 'woocommerce_before_shop_loop_item_title' );
					?>
				</a>
					<!--<h3><?php the_title(); ?></h3>-->
					
					<?php
						/**
						 * woocommerce_after_shop_loop_item_title hook
						 *
						 * @hooked woocommerce_template_loop_price - 10
						 */
						do_action( 'woocommerce_after_shop_loop_item_title' );
					?>
					
				
				
			</div>
			
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>
</div>