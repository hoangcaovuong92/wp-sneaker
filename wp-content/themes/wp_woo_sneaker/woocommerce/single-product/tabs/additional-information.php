<?php
/**
 * Additional Information tab
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post, $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information', 'wpdance' ) );
?>

<h2><?php echo $heading; ?></h2>

<?php wc_display_product_attributes($product); ?>