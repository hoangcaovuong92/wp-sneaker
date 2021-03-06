<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop,$smof_data;

do_action('wd_before_single_product_related');
if( !isset($posts_per_page) || $posts_per_page < 10 ){
	$posts_per_page = 10;
}
$related = wc_get_related_products($product->get_id(), $posts_per_page);

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'no_found_rows' 		=> 1,
	'posts_per_page'        => $posts_per_page,
	'orderby' 				=> $orderby,
	'post__in' 				=> $related,
	'post__not_in'			=> array($product->get_id())
) );
	

$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>



	<div class="related products">
		<?php $_random_id = 'related_product_wrapper_'.rand(); ?>
		<div class="related_wrapper" id="<?php echo $_random_id; ?>">
	
			<?php wd_woocommerce_product_loop_start_slide(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product-slide' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php wd_woocommerce_product_loop_end_slide(); ?>
		
			<div class="related_control">
					<a id="product_related_prev" title="<?php _e('Previous','wpdance');?>" class="prev" href="#">&lt;</a>
					<a id="product_related_next" title="<?php _e('Next','wpdance');?>" class="next" href="#">&gt;</a>
	    	</div>
		</div>
	
		<?php
			$_post_count = count($products->posts);
			$_post_count = $_post_count > 5 ? 5 : $_post_count;
		?>
		
		<script type="text/javascript" language="javascript">
		(function($) {
			"use strict";			
			jQuery(document).ready(function() {
				var $_this = jQuery('#<?php echo $_random_id ?>');
				var slide_speed = <?php echo (wp_is_mobile())?200:800; ?>;
				if( navigator.platform === 'iPod' ){
					slide_speed = 0;
				}
				var owl = $_this.find('.products').owlCarousel({
						items : <?php echo $_post_count;?>
						,itemsCustom : [[0, 1], [361, 2], [579, 3], [767, 4], [1200, <?php echo $_post_count;?>], [1600, <?php echo $_post_count;?>]]
						,slideSpeed : slide_speed
						,navigation : false
						,pagination: false
						,paginationNumbers: true
						,mouseDrag: false
						,scrollPerPage: false
						,rewindNav: true
						,navigationText: ['']
						,responsiveBaseWidth: $_this
						,afterUpdate: function(){
							wd_update_next_prev_slider_button($_this);
						}
						,afterInit: function(){
							wd_update_next_prev_slider_button($_this);
						}
					});
					$_this.on('click', '.next', function(e){
						e.preventDefault();
						owl.trigger('owl.next');
					});

					$_this.on('click', '.prev', function(e){
						e.preventDefault();
						owl.trigger('owl.prev');
					});
				
			});
		})(jQuery);		
		
		
		</script>			
		
	</div>


	
<?php endif;

do_action('wd_after_single_product_related');
wp_reset_postdata();
