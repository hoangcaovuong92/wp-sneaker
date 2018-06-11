<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce, $woocommerce_loop;

do_action('wd_before_single_product_up_sell');
$upsells = $product->get_upsell_ids();

if ( sizeof( $upsells ) == 0 ) return;


$meta_query = $woocommerce->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->get_id() ),
	'meta_query'          => $meta_query
);


$products = new WP_Query( $args );

$woocommerce_loop['columns'] 	= $columns;

if ( $products->have_posts() ) : ?>

	<div class="upsells products">
		<?php $_random_id = 'upsell_product_wrapper_'.rand(); ?>
		<div class="upsell_wrapper" id="<?php echo $_random_id; ?>">
		
			<?php wd_woocommerce_product_loop_start_slide(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'product-slide' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php wd_woocommerce_product_loop_end_slide(); ?>

			<div class="upsell_control">
				<a id="product_upsell_prev" title="<?php _e('Previous','wpdance');?>" class="prev" href="#">&lt;</a>
				<a id="product_upsell_next" title="<?php _e('Next','wpdance');?>" class="next" href="#">&gt;</a>
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

do_action('wd_after_single_product_up_sell');
wp_reset_postdata();