<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template.
 *
 * Override this template by copying it to yourtheme/woocommerce/taxonomy-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.1
 */
global $smof_data;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

woocommerce_get_template( 'archive-product.php' );
?>
