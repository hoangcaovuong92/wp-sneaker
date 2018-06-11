<?php
/**
 * @package WordPress
 * @subpackage Sneaker
 * @since WD_Responsive
 */
 
	if( !function_exists('wd_woocommerce_product_loop_start_slide') ){
		function wd_woocommerce_product_loop_start_slide($echo = true){
			ob_start();
			wc_get_template( 'loop/loop-start-slide.php' );
			if ( $echo )
				echo ob_get_clean();
			else
				return ob_get_clean();
		}
	}
	
	if( !function_exists('wd_woocommerce_product_loop_end_slide') ){
		function wd_woocommerce_product_loop_end_slide($echo = true){
			ob_start();
			wc_get_template( 'loop/loop-end-slide.php' );
			if ( $echo )
				echo ob_get_clean();
			else
				return ob_get_clean();
		}
	}
	

	if(!function_exists('wd_custom_product_function')){
		function wd_custom_product_function($atts){
			extract(shortcode_atts(array(
				'style' 			=> 1,
				'id' 				=> 0,
				'sku' 				=> '',
				'title' 			=> '',
				'show_add_to_cart' => 1,
				'show_sku' 		=> 1,
				'show_rating' 		=> 1,
				'show_label' 		=> 1
			),$atts));
			
			if (empty($atts)) return;
				
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
		
			wp_reset_query(); 
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => 1,
				'no_found_rows' => 1,
				'post_status' => 'publish',
			);

			if(isset($atts['sku'])){
				$args['meta_query'][] = array(
					'key' => '_sku',
					'value' => $atts['sku'],
					'compare' => '='
				);
			}

			if(isset($atts['id'])){
				$args['p'] = $atts['id'];
			}

			ob_start();	
			$products = new WP_Query( $args );
			$style = ($style == "")?1:$style;
			if ( $products->have_posts() ) : ?>
				<div class="custom-product-shortcode <?php echo 'style-'.$style; ?>">
				<?php woocommerce_product_loop_start(); ?>

					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
						
						<?php		
						//start product-content.Copy from core code
							
						global $product, $woocommerce_loop;
						$old_loop = $woocommerce_loop;
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
						$classes = array();
						if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
							$classes[] = 'first';
						if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
							$classes[] = 'last';
							
						?>
						<li <?php post_class( $classes ); ?>>

							<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
							<div class="product_item_wrapper">
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

										<?php
											/**
											 * woocommerce_after_shop_loop_item_title hook
											 *
											 * @hooked woocommerce_template_loop_price - 10
											 */
											do_action( 'woocommerce_after_shop_loop_item_title' );
										?>

									</a>
								
								</div>
								
								<?php //do_action( 'woocommerce_after_shop_loop_item' ); ?>
								
								<div class="product-meta-wrapper">
									<?php 
										if((int)$show_rating)
											woocommerce_template_loop_rating();
									?>
									<h3 class="heading-title promotion-title"><?php echo $title; ?></h3>
									<h3 class="heading-title product-title"><a href="<?php echo get_permalink(); ?>"><?php the_title();?></a></h3>
									<?php
										if((int)$show_sku)
											add_sku_to_product_list();
										woocommerce_template_loop_price();
										if((int)$show_add_to_cart){
											if( function_exists('wd_list_template_loop_add_to_cart'))
												wd_list_template_loop_add_to_cart();
										}
										if( function_exists('wd_add_wishlist_button_to_product_list'))
											wd_add_wishlist_button_to_product_list();
										if( function_exists('wd_add_compare_button_to_product_list'))
											wd_add_compare_button_to_product_list();
									?>
								</div>
							</div>
							
						</li>
						
						<?php //end of copy ?>
						
					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>
				</div>
			<?php endif;
			?>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('.custom-product-shortcode .products').addClass('no_quickshop');
				});
			</script>
			<?php
			$woocommerce_loop = $old_loop;
			wp_reset_postdata();
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			//add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';
		}
	}
	add_shortcode('custom_product','wd_custom_product_function');
	
	
	
	if(!function_exists('wd_custom_products_function')){
		function wd_custom_products_function($atts){
			extract(shortcode_atts(array(
				'style' 					=> 1,
				'ids' 						=> 0,
				'skus' 					=> '',
				'show_add_to_cart' 		=> 1,
				'show_sku' 				=> 1,
				'show_rating' 				=> 1,
				'show_label' 				=> 1,
				'show_categories' 			=> 0
			),$atts));
			
			if (empty($atts)) return;
			
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			
			global $woocommerce_loop;
			wp_reset_query(); 
			
			if(!(int)$show_add_to_cart)
				remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			if(!(int)$show_sku)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
			if(!(int)$show_rating)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );
			if(!(int)$show_categories)
				remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
			
			extract(shortcode_atts(array(
				'columns' 	=> '4',
				'orderby'   => 'title',
				'order'     => 'asc'
				), $atts));

			$args = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'orderby' => $orderby,
				'order' => $order,
				'posts_per_page' => -1,
				'meta_query' => array(
					array(
						'key' 		=> '_visibility',
						'value' 	=> array('catalog', 'visible'),
						'compare' 	=> 'IN'
					)
				)
			);

			if( isset($atts['skus']) ){
				$skus = explode(',', $atts['skus']);
				$skus = array_map('trim', $skus);
				$args['meta_query'][] = array(
					'key' 		=> '_sku',
					'value' 	=> $skus,
					'compare' 	=> 'IN'
				);
			}

			if(isset($atts['ids']) && trim($atts['ids'])!=""){
				$ids = explode(',', $atts['ids']);
				$ids = array_map('trim', $ids);
				$args['post__in'] = $ids;
			}

			ob_start();
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$products = new WP_Query( $args );
			$style = ($style == "")?1:$style;
			$woocommerce_loop['columns'] = $columns;
			if ( $products->have_posts() ) : ?>
				<div class="custom-products-shortcode <?php echo 'style-'.$style; ?>">
				<?php woocommerce_product_loop_start(); ?>

					<?php while ( $products->have_posts() ) : $products->the_post(); ?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>
				</div>
			<?php endif;
			?>
			<script type="text/javascript">
				jQuery(document).ready(function() {
					//jQuery('.custom-products-shortcode .products').addClass('no_quickshop');
				});
			</script>
			<?php 
			wp_reset_postdata();
			add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			add_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns;
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';			
			
		}
	}	
	
	
	add_shortcode('custom_products','wd_custom_products_function');

	
	/*
	*	columns : 3 or 4
	*	per_page : 4 to 12
	*	title : ""
	*	desc : ""
	*	show nav thumb : 1
	* 	show thumb : 1
	*	show title : 1
	* 	show sku : 1
	*	show price
	*	show label
	* 	item slide : 1
	*/
	

	
	if(!function_exists('wd_featured_product_slider_function')){
		function wd_featured_product_slider_function($atts){
			wp_reset_query(); 
			extract(shortcode_atts(array(
				'columns' 			=> 4,
				'style' 			=> 1,
				'per_page' 		=> 8,
				'title' 			=> '',
				'desc' 			=> '',
				'product_cats'		=> '',
				'show_nav' 		=> 1,
				'show_page_nav' 	=> 0,
				'show_image' 		=> 1,
				'show_title' 		=> 1,
				'show_sku' 		=> 0,
				'show_price' 		=> 1,
				'show_rating' 		=> 1,
				'show_label' 		=> 1	,
				'show_categories'	=> 0	,
				'show_add_to_cart' => 1
			),$atts));
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
		
			global $woocommerce_loop;
			if(!(int)$show_image)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			
			remove_action( 'woocommerce_after_shop_loop_item', 'add_short_content',5 );
			if(!(int)$show_categories)
				remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
			if(!(int)$show_title)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_product_title', 3 );
			if(!(int)$show_sku)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
			if(!(int)$show_price)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			if(!(int)$show_rating)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );	
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );		
			if(!(int)$show_add_to_cart)
				remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
				
			$args = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $per_page,
				'meta_query' => array(
					array(
						'key' => '_visibility',
						'value' => array('catalog', 'visible'),
						'compare' => 'IN'
					),
					array(
						'key' => '_featured',
						'value' => 'yes'
					)
				)
			);
			
			if( strlen(trim($product_cats)) > 0){
				$args['tax_query'] = array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> explode(',', esc_attr($product_cats) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				);
			}

			ob_start();
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$products = new WP_Query( $args );

			$woocommerce_loop['columns'] = $columns;
			$style = ($style == "")?1:$style;
			if ( $products->have_posts() ) : ?>
				<?php $_random_id = 'featured_product_slider_wrapper_'.rand(); ?>
				<div class="featured_product_slider_wrapper <?php echo 'style-'.$style; ?>" id="<?php echo $_random_id;?>">
					<div class="featured_product_slider_wrapper_meta"> 
						<?php
							if(strlen(trim($title)) >0)
								echo "<div class='wd_title_shortcode'><h3 class='heading-title slider-title'>{$title}</h3></div>";
							if(strlen(trim($desc)) >0)	
								echo "<p class='slider-desc-wrapper'>{$desc}</p>";
						?>
					</div>
					<div class="featured_product_slider_wrapper_inner loading">
						
						<?php wd_woocommerce_product_loop_start_slide(); ?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php wc_get_template_part( 'content', 'product-slide' ); ?>

							<?php endwhile; // end of the loop. ?>
						<?php wd_woocommerce_product_loop_end_slide(); ?>
						
						<?php if($show_nav):?>
						<div class="slider_control">
							<a title="prev" id="<?php echo $_random_id;?>_prev" class="prev" href="#">&lt;</a>
							<a title="next" id="<?php echo $_random_id;?>_next" class="next" href="#">&gt;</a>
						</div>
						<?php endif;?>
						
					</div>
				</div>
				<?php global $smof_data; ?>
				<script type='text/javascript'>
				//<![CDATA[
					jQuery(document).ready(function() {
						"use strict";
						// Using custom configuration
						jQuery('.slideshow-wrapper #<?php echo $_random_id; ?> div.products').addClass('no_quickshop');
						jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner').imagesLoaded(function(){
						var $_this = jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner');
						var has_pagination = <?php echo (int)$show_page_nav; ?>;
						has_pagination = ( has_pagination == 1);
						<?php if( wp_is_mobile() ){ ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_mobile'])?(int)$smof_data['wd_shop_slider_slide_speed_mobile']:200; ?>;
						<?php } else { ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_pc'])?(int)$smof_data['wd_shop_slider_slide_speed_pc']:800; ?>;
						<?php } ?>
						var scroll_per_page = <?php echo isset($smof_data['wd_shop_slider_scroll_per_page'])?$smof_data['wd_shop_slider_scroll_per_page']:0; ?>;
						scroll_per_page = ( scroll_per_page == 1 );
						var rewind_nav = <?php echo isset($smof_data['wd_shop_slider_rewind_nav'])?$smof_data['wd_shop_slider_rewind_nav']:1; ?>;
						rewind_nav = ( rewind_nav == 1 );
						var rewind_speed = <?php echo isset($smof_data['wd_shop_slider_rewind_speed'])?(int)$smof_data['wd_shop_slider_rewind_speed']:800; ?>;
						var auto_play = <?php echo isset($smof_data['wd_shop_slider_auto_play'])?$smof_data['wd_shop_slider_auto_play']:0; ?>;
						auto_play = ( auto_play == 1 );
						var stop_on_hover = <?php echo isset($smof_data['wd_shop_slider_stop_on_hover'])?$smof_data['wd_shop_slider_stop_on_hover']:0; ?>;
						stop_on_hover = ( stop_on_hover == 1 );
						var mouse_drag = <?php echo isset($smof_data['wd_shop_slider_mouse_drag'])?$smof_data['wd_shop_slider_mouse_drag']:0; ?>;
						mouse_drag = ( mouse_drag == 1 );
						var touch_drag = <?php echo isset($smof_data['wd_shop_slider_touch_drag'])?$smof_data['wd_shop_slider_touch_drag']:1; ?>;
						touch_drag = ( touch_drag == 1 );
						
						var responsive_refresh_rate = <?php echo (wp_is_mobile())?400:200; ?>;
						if( navigator.platform === 'iPod' ){
							slide_speed = 0;
							responsive_refresh_rate = 1000;
						}
						var owl = $_this.find('.products').owlCarousel({
								items : <?php echo $columns;?>,
								itemsCustom : [[0, 1], [361, 2], [620, 3], [780, 4], [930, <?php echo $columns;?>], [1600, <?php echo $columns;?>]],
								slideSpeed : slide_speed,
								navigation : false,
								pagination: has_pagination,
								paginationNumbers: true,
								scrollPerPage: scroll_per_page,
								rewindNav: rewind_nav,
								rewindSpeed: rewind_speed,
								autoPlay: auto_play,
								stopOnHover: stop_on_hover,
								mouseDrag: mouse_drag,
								touchDrag: touch_drag,
								navigationText: [''],
								responsiveBaseWidth: $_this,
								responsiveRefreshRate: responsive_refresh_rate,
								afterInit: function(){
									$_this.addClass('loaded').removeClass('loading');
									wd_update_next_prev_slider_button($_this);
								},
								afterUpdate: function(){
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
					});
				//]]>	
				</script>
				
			<?php endif;

			wp_reset_postdata();

			
			
			//add all the hook removed
			add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
			add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
			add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
			add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
			add_action( 'woocommerce_after_shop_loop_item', 'add_short_content', 5 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );		
			add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			//end
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns;
			
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';		
			
		}
	}		
	add_shortcode('featured_product_slider','wd_featured_product_slider_function');
	
	
	/* featured product no slider*/
		if(!function_exists('wd_featured_product_function')){
		function wd_featured_product_function($atts){
			wp_reset_query(); 
			extract(shortcode_atts(array(
				'columns' 					=> 4,
				'style' 					=> 1,
				'per_page' 				=> 8,
				'title' 					=> '',
				'desc' 					=> '',
				'product_cats'  			=> '',
				'show_image' 				=> 1,
				'show_title' 				=> 1,
				'show_sku' 				=> 1,
				'show_price' 				=> 1,
				'show_rating' 				=> 1,
				'show_label' 				=> 1	,
				'show_categories'			=> 1	,
				'show_short_content' 		=> 1,
				'show_add_to_cart' 		=> 1,
				'show_load_more' 			=> 0
			),$atts));
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			global $woocommerce_loop;
			if(!(int)$show_image)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			
			remove_action( 'woocommerce_after_shop_loop_item', 'add_short_content',5 );
			if(!(int)$show_categories)
				remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
			if(!(int)$show_title)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_product_title', 3 );
			if(!(int)$show_sku)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
				
			if(!(int)$show_price)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			if(!(int)$show_rating)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );					
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );		
			if(!(int)$show_add_to_cart)
				remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			
			$args = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $per_page,
				'meta_query' => array(
					array(
						'key' => '_visibility',
						'value' => array('catalog', 'visible'),
						'compare' => 'IN'
					),
					array(
						'key' => '_featured',
						'value' => 'yes'
					)
				)
			);
			
			if( strlen(trim($product_cats)) > 0){
				$args['tax_query'] = array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> explode(',', esc_attr($product_cats) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				);
			}

			
			ob_start();
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$products = new WP_Query( $args );

			$woocommerce_loop['columns'] = $columns;
			$style = ($style == "")?1:$style;
			if ( $products->have_posts() ) : ?>
				<?php 
				$_random_id = 'featured_product_wrapper_'.rand(); 
				?>
				<div class="featured_product_wrapper <?php echo 'style-'.$style; ?>" id="<?php echo $_random_id;?>">
					<div class="featured_product_wrapper_meta"> 
						<?php
							if(strlen(trim($title)) >0)
								echo "<div class='wd_title_shortcode'><h3 class='heading-title'>{$title}</h3></div>";
							if(strlen(trim($desc)) >0)	
								echo "<p class='desc-wrapper'>{$desc}</p>";
						?>
					</div>
					<div class="featured_product_wrapper_inner">
					
						<?php woocommerce_product_loop_start(); ?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>
						<?php woocommerce_product_loop_end(); ?>
						
						
					</div>
					<?php if( (int)$show_load_more && $products->max_num_pages > 1 ){ 
						wd_product_shortcode_show_load_more_button('featured',$_random_id,$atts);
					} ?>
				</div>
			<?php endif;

			wp_reset_postdata();

			
			
			//add all the hook removed
			add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
			add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
			add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
			add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );		
			add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			//end
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns;
			?>
				<script type="text/javascript">
					
					jQuery(document).ready(function(){
						var _random_id = "<?php echo $_random_id; ?>";
						var columns = "<?php echo $columns; ?>";
						var li_class = "span6";
						if(columns!=""){
							li_class = "span"+(24/parseInt(columns));
						}
						jQuery("#"+_random_id).find("ul.products li").removeClass("span24 span12 span8 span6 span4");
						jQuery("#"+_random_id).find("ul.products li").addClass(li_class);
					});

				</script>
			<?php
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';		
			
		}
	}		
	add_shortcode('featured_product','wd_featured_product_function');
	/* featured product no slider*/

	if(!function_exists('wd_featured_by_category_function')){
		function wd_featured_by_category_function($cat_slug = '',$per_page = 1){
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			wp_reset_query(); 
			$args = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $per_page,
				'meta_query' => array(
					array(
						'key' => '_visibility',
						'value' => array('catalog', 'visible'),
						'compare' => 'IN'
					),
					array(
						'key' => '_featured',
						'value' => 'yes'
					)
				),
				'tax_query' 			=> array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> array( esc_attr($cat_slug) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				)
			);
			wp_reset_query(); 
			$products = new WP_Query( $args );
			if( $products->have_posts() ){
				global $post;
				$products->the_post();
				$product = wc_get_product( $post->ID );
				return $product;
			}
			return NULL;
		}
	}
			
	
	
	

	if(!function_exists('wd_custom_products_category_function')){
		function wd_custom_products_category_function($atts){
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			global $woocommerce, $woocommerce_loop;
			if ( empty( $atts ) ) return;
			extract( shortcode_atts( array(
				'per_page' 		=> 4,
				'columns'		=> 3,
				'title'			=> '',
				'orderby'   	=> 'title',
				'order'     	=> 'desc',
				'product_cat'	=> '',
				'show_upsell' 	=> 1,
				'show_image' 	=> 1,
				'show_title' 	=> 1,
				'show_sku' 		=> 1,
				'show_price'	=> 1,
				'show_rating' 	=> 1,
				'show_label' 	=> 1,
				'show_categories' 	=> 1,
				'show_add_to_cart' => 1
				), $atts ) );
			remove_action( 'woocommerce_after_shop_loop_item', 'add_short_content', 5 );
			if(!(int)$show_image)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			if(!(int)$show_categories)
				remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
			if(!(int)$show_title)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_product_title', 3 );
			if(!(int)$show_sku)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
				
			if(!(int)$show_price)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			if(!(int)$show_rating)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );		
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			if(!(int)$show_add_to_cart)
				remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
				
		
			if ( ! $product_cat ) return;
			wp_reset_query(); 
			global $featured_datas;
			$_featured_prod = wd_featured_by_category_function($product_cat,1);

			if(isset($_featured_prod)){
				//$_featured_prod->get_upsells( );
				$featured_datas = array(
					'id' => $_featured_prod->get_id(),
					'show_upsell' => $show_upsell,
					'show_image' => $show_image,
					'show_title' => $show_title,
					'show_sku' => $show_sku,
					'show_price' => $show_price,
					'show_rating' => $show_rating,
					'show_label' => $show_label
					
				);
				$per_page = $per_page;
			}else{
				$featured_datas = array(
					'id' => '',
					'show_upsell' => $show_upsell,
					'show_image' => $show_image,
					'show_title' => $show_title,
					'show_sku' => $show_sku,
					'show_price' => $show_price,
					'show_rating' => $show_rating,
					'show_label' => $show_label
					
				);			
				$per_page = $per_page + 1;
			}

			
			// Default ordering args
			$ordering_args = $woocommerce->query->get_catalog_ordering_args( $orderby, $order );

			$args = array(
				'post_type'				=> 'product',
				'post__not_in' 			=> array($featured_datas['id']),
				'post_status' 			=> 'publish',
				'ignore_sticky_posts'	=> 1,
				'orderby' 				=> $ordering_args['orderby'],
				'order' 				=> $ordering_args['order'],
				'posts_per_page' 		=> $per_page,
				'tax_query' 			=> array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> array( esc_attr($product_cat) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				)
				
			);

			if ( isset( $ordering_args['meta_key'] ) ) {
				$args['meta_key'] = $ordering_args['meta_key'];
			}

			ob_start();
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$products = new WP_Query( $args );
			$woocommerce_loop['columns'] = $columns;
			$_count = 0;
			$per_page = isset($products->post_count)?$products->post_count:$per_page;
			
			if( strlen($title) <= 0 ){
				$_prod_cat = get_term_by('slug', esc_attr($product_cat), 'product_cat');
				if( isset($_prod_cat) && is_object($_prod_cat) ){
					$title = $_prod_cat->name;
				}
			}
			
			if ( $products->have_posts() ) : ?>
			
			<div class="custom_category_shortcode">
			
			<?php
				remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );			
				remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );			
				add_action( 'woocommerce_before_shop_loop_item_title', 'custom_product_thumbnail', 10 );
			?>
			
				<div class="wd-categories-title"><h3 class="heading-title custom-category-title"><?php echo $title;?></h3></div>
				<?php woocommerce_product_loop_start(); ?>

					<?php while ( $products->have_posts() ) : ?>

					<?php
						global $product;
						$products->the_post();
						if( isset($_featured_prod) && $_count == 0 ){
							get_template_part( 'content', 'product-featured' );
						}
						if( $_count == 0){
							echo "<li>
									<div class='wd-custom-product-category-right-wrapper'>
										<ul>";
						}
						if( function_exists('wc_get_template_part') ){
							wc_get_template_part( 'content', 'product' );
						}
						$_count++;
						if( $_count == $per_page ){
							echo "</ul>
									</div>
										</li>";
						}
					?>
						
					<?php endwhile; // end of the loop. ?>

				<?php woocommerce_product_loop_end(); ?>

			</div>	
				
			<?php endif;

			wp_reset_postdata();

			//add all the hook removed
			add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
			add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
			add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
			add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );			
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );	
			add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			//end			
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns ;
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';		
		
		}
	}	
	add_shortcode('custom_products_category','wd_custom_products_category_function');




	function wd_order_by_rating_post_clauses( $args ) {

		global $wpdb;

		$args['where'] .= " AND $wpdb->commentmeta.meta_key = 'rating' ";

		$args['join'] .= "
			LEFT JOIN $wpdb->comments ON($wpdb->posts.ID = $wpdb->comments.comment_post_ID)
			LEFT JOIN $wpdb->commentmeta ON($wpdb->comments.comment_ID = $wpdb->commentmeta.comment_id)
		";

		$args['orderby'] = "$wpdb->commentmeta.meta_value DESC";

		$args['groupby'] = "$wpdb->posts.ID";

		return $args;
	}	
	

	/*
	*	columns : 3 or 4
	*	style : 1 or 2 or 3
	*	per_page : 4 to 12
	*	title : ""
	*	desc : ""
	*	product_tag : tag of prods
	*	show nav thumb : 1
	* 	show thumb : 1
	*	show title : 1
	* 	show sku : 1
	*	show price
	*	show label
	* 	item slide : 1
	*/
	

	
	if(!function_exists('wd_popular_product_slider_function')){
		function wd_popular_product_slider_function($atts){
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			global $woocommerce_loop, $woocommerce;
			extract(shortcode_atts(array(
				'columns' 			=> 4,
				'style' 			=> 1,
				'per_page' 		=> 8,
				'title' 			=> '',
				'desc' 			=> '',
				'product_tag' 		=> '',
				'product_cats'		=> '',
				'show_nav' 		=> 1,
				'show_page_nav' 	=> 0,
				'show_image' 		=> 1,
				'show_title' 		=> 1,
				'show_sku' 		=> 0,
				'show_price' 		=> 1,
				'show_rating' 		=> 1,
				'show_label' 		=> 1
                ,'show_categories' 	=> 0		,
				'show_add_to_cart' => '1'				
			),$atts));
			
			if(!(int)$show_image)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			
			remove_action ('woocommerce_after_shop_loop_item','add_short_content',5);
			if(!(int)$show_categories)
				remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
			if(!(int)$show_title)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_product_title', 3 );
			if(!(int)$show_sku)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
			if(!(int)$show_price)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			if(!(int)$show_rating)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );						
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );				
			if(!(int)$show_add_to_cart)
				remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
				
			wp_reset_query(); 
			
			$args = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $per_page,
				'orderby' => 'date',
				'order' => 'desc',				
			);
			
			if( strlen(trim($product_cats)) > 0){
				$args['tax_query'] = array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> explode(',', esc_attr($product_cats) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				);
			}
		
			
			if( strlen($product_tag) > 0 && strcmp('all-product-tags',$product_tag) != 0 ){
				$args = array_merge($args, array('product_tag' => $product_tag));
			}
			
			ob_start();

	  	add_filter( 'posts_clauses', 'wd_order_by_rating_post_clauses' );

		$products = new WP_Query( $args );

		remove_filter( 'posts_clauses', 'wd_order_by_rating_post_clauses' );
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$woocommerce_loop['columns'] = $columns;
			$style = ($style == "")?1:$style;
			if ( $products->have_posts() ) : ?>
				<?php $_random_id = 'featured_product_slider_wrapper_'.rand(); ?>
				<div class="featured_product_slider_wrapper <?php echo 'style-'.$style; ?>" id="<?php echo $_random_id;?>">
					<div class="featured_product_slider_wrapper_meta"> 
						<?php
							if(strlen(trim($title)) >0)
								echo "<div class='wd_title_shortcode'><h3 class='heading-title slider-title'>{$title}</h3></div>";
							if(strlen(trim($desc)) >0)	
								echo "<p class='slider-desc-wrapper'>{$desc}</p>";
						?>
					</div>
					<div class="featured_product_slider_wrapper_inner loading">
						
						<?php wd_woocommerce_product_loop_start_slide(); ?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php wc_get_template_part( 'content', 'product-slide' ); ?>

							<?php endwhile; // end of the loop. ?>
						<?php wd_woocommerce_product_loop_end_slide(); ?>
						
						<?php if($show_nav):?>
						<div class="slider_control">
							<a title="prev" id="<?php echo $_random_id;?>_prev" class="prev" href="#">&lt;</a>
							<a title="next" id="<?php echo $_random_id;?>_next" class="next" href="#">&gt;</a>
						</div>
						<?php endif;?>
						
					</div>
				</div>
				<?php global $smof_data; ?>
				<script type='text/javascript'>
				//<![CDATA[
					jQuery(document).ready(function() {
						"use strict";
						// Using custom configuration
						jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner').imagesLoaded(function(){
						var $_this = jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner');
						var has_pagination = <?php echo (int)$show_page_nav; ?>;
						has_pagination = ( has_pagination == 1);
						<?php if( wp_is_mobile() ){ ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_mobile'])?(int)$smof_data['wd_shop_slider_slide_speed_mobile']:200; ?>;
						<?php } else { ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_pc'])?(int)$smof_data['wd_shop_slider_slide_speed_pc']:800; ?>;
						<?php } ?>
						var scroll_per_page = <?php echo isset($smof_data['wd_shop_slider_scroll_per_page'])?$smof_data['wd_shop_slider_scroll_per_page']:0; ?>;
						scroll_per_page = ( scroll_per_page == 1 );
						var rewind_nav = <?php echo isset($smof_data['wd_shop_slider_rewind_nav'])?$smof_data['wd_shop_slider_rewind_nav']:1; ?>;
						rewind_nav = ( rewind_nav == 1 );
						var rewind_speed = <?php echo isset($smof_data['wd_shop_slider_rewind_speed'])?(int)$smof_data['wd_shop_slider_rewind_speed']:800; ?>;
						var auto_play = <?php echo isset($smof_data['wd_shop_slider_auto_play'])?$smof_data['wd_shop_slider_auto_play']:0; ?>;
						auto_play = ( auto_play == 1 );
						var stop_on_hover = <?php echo isset($smof_data['wd_shop_slider_stop_on_hover'])?$smof_data['wd_shop_slider_stop_on_hover']:0; ?>;
						stop_on_hover = ( stop_on_hover == 1 );
						var mouse_drag = <?php echo isset($smof_data['wd_shop_slider_mouse_drag'])?$smof_data['wd_shop_slider_mouse_drag']:0; ?>;
						mouse_drag = ( mouse_drag == 1 );
						var touch_drag = <?php echo isset($smof_data['wd_shop_slider_touch_drag'])?$smof_data['wd_shop_slider_touch_drag']:1; ?>;
						touch_drag = ( touch_drag == 1 );
						var responsive_refresh_rate = <?php echo (wp_is_mobile())?400:200; ?>;
						if( navigator.platform === 'iPod' ){
							slide_speed = 0;
							responsive_refresh_rate = 1000;
						}
						var owl = $_this.find('.products').owlCarousel({
								items : <?php echo $columns;?>,
								itemsCustom : [[0, 1], [361, 2], [620, 3], [780, 4], [930, <?php echo $columns;?>], [1600, <?php echo $columns;?>]],
								slideSpeed : slide_speed,
								navigation : false,
								pagination: has_pagination,
								paginationNumbers: true,
								scrollPerPage: scroll_per_page,
								rewindNav: rewind_nav,
								rewindSpeed: rewind_speed,
								autoPlay: auto_play,
								stopOnHover: stop_on_hover,
								mouseDrag: mouse_drag,
								touchDrag: touch_drag,
								navigationText: [''],
								responsiveBaseWidth: $_this,
								responsiveRefreshRate: responsive_refresh_rate,
								afterInit: function(){
									$_this.addClass('loaded').removeClass('loading');
									wd_update_next_prev_slider_button($_this);
								},
								afterUpdate: function(){
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
					});
				//]]>	
				</script>
				
			<?php endif;

			wp_reset_postdata();

			
			
			//add all the hook removed
			add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
			add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
			add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
			add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			//end
			
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns ;
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';		
			
		}
	}		
	add_shortcode('popular_product_slider','wd_popular_product_slider_function');

	
	/*
	*	columns : 3 or 4
	*	style : 1 or 2 or 3
	*	per_page : 4 to 12
	*	title : ""
	*	desc : ""
	*	product_tag : tag of prods
	*	show_image : 1
	* 	show thumb : 1
	*	show_title : 1
	* 	show_sku : 0
	*	show_price: 1
	*	show_rating: 1
	* 	show_label : 1
	* 	show_categories : 0
	* 	show_add_to_cart : 1
	*/
	

	
	if(!function_exists('wd_popular_product_function')){
		function wd_popular_product_function($atts){
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			global $woocommerce_loop, $woocommerce;
			extract(shortcode_atts(array(
				'columns' 					=> 4,
				'style' 					=> 1,
				'per_page' 				=> 8,
				'title' 					=> '',
				'desc' 					=> '',
				'product_tag' 				=> '',
				'product_cats'				=> '',
				'show_image' 				=> 1,
				'show_title' 				=> 1,
				'show_sku' 				=> 0,
				'show_price' 				=> 1,
				'show_rating' 				=> 1,
				'show_label' 				=> 1
                ,'show_categories' 			=> 0		,
				'show_add_to_cart' 		=> 1							,
				'show_load_more'	 		=> 0							
			),$atts));
			
			if(!(int)$show_image)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			
			remove_action ('woocommerce_after_shop_loop_item','add_short_content',5);
			if(!(int)$show_categories)
				remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
			if(!(int)$show_title)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_product_title', 3 );
			if(!(int)$show_sku)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
			if(!(int)$show_price)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			if(!(int)$show_rating)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );						
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );				
			if(!(int)$show_add_to_cart)
				remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
				
			wp_reset_query(); 
			
			$args = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $per_page,
				'orderby' => 'date',
				'order' => 'desc',				
			);
			
			if( strlen(trim($product_cats)) > 0){
				$args['tax_query'] = array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> explode(',', esc_attr($product_cats) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				);
			}
		
			
			if( strlen($product_tag) > 0 && strcmp('all-product-tags',$product_tag) != 0 ){
				$args = array_merge($args, array('product_tag' => $product_tag));
			}
			
			ob_start();

	  	add_filter( 'posts_clauses', 'wd_order_by_rating_post_clauses' );

		$products = new WP_Query( $args );

		remove_filter( 'posts_clauses', 'wd_order_by_rating_post_clauses' );
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$woocommerce_loop['columns'] = $columns;
			$style = ($style == "")?1:$style;
			if ( $products->have_posts() ) : ?>
				<?php 
				$_random_id = 'featured_product_slider_wrapper_'.rand(); 
				?>
				<div class="featured_product_wrapper <?php echo 'style-'.$style; ?>" id="<?php echo $_random_id;?>">
					<div class="featured_product_wrapper_meta"> 
						<?php
							if(strlen(trim($title)) >0)
								echo "<div class='wd_title_shortcode'><h3 class='heading-title slider-title'>{$title}</h3></div>";
							if(strlen(trim($desc)) >0)	
								echo "<p class='slider-desc-wrapper'>{$desc}</p>";
						?>
					</div>
					<div class="featured_product_wrapper_inner">
						
						<?php woocommerce_product_loop_start(); ?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>
						<?php woocommerce_product_loop_end(); ?>
						<?php if( (int)$show_load_more && $products->max_num_pages > 1 ){
							wd_product_shortcode_show_load_more_button('popular',$_random_id,$atts);
						} ?>
					</div>
				</div>
				
			<?php endif;

			wp_reset_postdata();

			
			
			//add all the hook removed
			add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
			add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
			add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
			add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			//end
			
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns ;
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';		
			
		}
	}		
	add_shortcode('popular_product','wd_popular_product_function');


		/*
	*	columns : 3 or 4
	*	style : 1 or 2 or 3
	*	per_page : 4 to 12
	*	title : ""
	*	desc : ""
	*	product_tag : tag of prods
	*	show nav thumb : 1
	* 	show thumb : 1
	*	show title : 1
	* 	show sku : 1
	*	show price
	*	show label
	* 	item slide : 1
	*/
	

	
	if(!function_exists('wd_best_selling_product_slider_function')){
		function wd_best_selling_product_slider_function($atts){
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			global $woocommerce_loop, $woocommerce;
			extract(shortcode_atts(array(
				'columns' 			=> 4,
				'style' 			=> 1,
				'per_page' 			=> 8,
				'title' 			=> '',
				'desc' 				=> '',
				'product_cats'		=> '',
				'show_nav' 			=> 1,
				'show_page_nav' 	=> 0,
				'show_image' 		=> 1,
				'show_title' 		=> 1,
				'show_sku' 			=> 0,
				'show_price' 		=> 1,
				'show_rating' 		=> 1,
				'show_label' 		=> 1		,
				'show_categories' 	=> 0		,
				'show_add_to_cart' 	=> '1'				
			),$atts));
			
			if(!(int)$show_image)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			
			remove_action( 'woocommerce_after_shop_loop_item', 'add_short_content', 5 );
			if(!(int)$show_categories)
				remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
			if(!(int)$show_title)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_product_title', 3 );
			if(!(int)$show_sku)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
			if(!(int)$show_price)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			if(!(int)$show_rating)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );				
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );
			if(!(int)$show_add_to_cart)
				remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
				
			$args = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $per_page,
				'order' => 'desc',		
				'meta_key' 		 => 'total_sales',
				'orderby' 		 => 'meta_value_num',				
			);
			
			if( strlen(trim($product_cats)) > 0){
				$args['tax_query'] = array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> explode(',', esc_attr($product_cats) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				);
			}
		
			wp_reset_query(); 
			
			/*if( strlen($product_tag) > 0 && strcmp('all-product-tags',$product_tag) != 0 ){
				$args = array_merge($args, array('product_tag' => $product_tag));
			}*/
			
			ob_start();
			
			$products = new WP_Query( $args );
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];	
			$woocommerce_loop['columns'] = $columns;
			$style = ($style == "")?1:$style;
			if ( $products->have_posts() ) : ?>
				<?php $_random_id = 'featured_product_slider_wrapper_'.rand(); ?>
				<div class="featured_product_slider_wrapper <?php echo 'style-'.$style; ?>" id="<?php echo $_random_id;?>">
					<div class="featured_product_slider_wrapper_meta"> 
						<?php
							if(strlen(trim($title)) >0)
								echo "<div class='wd_title_shortcode'><h3 class='heading-title slider-title'>{$title}</h3></div>";
							if(strlen(trim($desc)) >0)	
								echo "<p class='slider-desc-wrapper'>{$desc}</p>";
						?>
					</div>
					<div class="featured_product_slider_wrapper_inner loading">
						
						<?php wd_woocommerce_product_loop_start_slide(); ?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php wc_get_template_part( 'content', 'product-slide' ); ?>

							<?php endwhile; // end of the loop. ?>
						<?php wd_woocommerce_product_loop_end_slide(); ?>
						
						<?php if($show_nav):?>
						<div class="slider_control">
							<a title="prev" id="<?php echo $_random_id;?>_prev" class="prev" href="#">&lt;</a>
							<a title="next" id="<?php echo $_random_id;?>_next" class="next" href="#">&gt;</a>
						</div>
						<?php endif;?>
						
					</div>
				</div>
				<?php global $smof_data; ?>
				<script type='text/javascript'>
				//<![CDATA[
					jQuery(document).ready(function() {
						"use strict";
						// Using custom configuration
						jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner').imagesLoaded(function(){
						var $_this = jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner');
						var has_pagination = <?php echo (int)$show_page_nav; ?>;
						has_pagination = ( has_pagination == 1);
						<?php if( wp_is_mobile() ){ ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_mobile'])?(int)$smof_data['wd_shop_slider_slide_speed_mobile']:200; ?>;
						<?php } else { ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_pc'])?(int)$smof_data['wd_shop_slider_slide_speed_pc']:800; ?>;
						<?php } ?>
						var scroll_per_page = <?php echo isset($smof_data['wd_shop_slider_scroll_per_page'])?$smof_data['wd_shop_slider_scroll_per_page']:0; ?>;
						scroll_per_page = ( scroll_per_page == 1 );
						var rewind_nav = <?php echo isset($smof_data['wd_shop_slider_rewind_nav'])?$smof_data['wd_shop_slider_rewind_nav']:1; ?>;
						rewind_nav = ( rewind_nav == 1 );
						var rewind_speed = <?php echo isset($smof_data['wd_shop_slider_rewind_speed'])?(int)$smof_data['wd_shop_slider_rewind_speed']:800; ?>;
						var auto_play = <?php echo isset($smof_data['wd_shop_slider_auto_play'])?$smof_data['wd_shop_slider_auto_play']:0; ?>;
						auto_play = ( auto_play == 1 );
						var stop_on_hover = <?php echo isset($smof_data['wd_shop_slider_stop_on_hover'])?$smof_data['wd_shop_slider_stop_on_hover']:0; ?>;
						stop_on_hover = ( stop_on_hover == 1 );
						var mouse_drag = <?php echo isset($smof_data['wd_shop_slider_mouse_drag'])?$smof_data['wd_shop_slider_mouse_drag']:0; ?>;
						mouse_drag = ( mouse_drag == 1 );
						var touch_drag = <?php echo isset($smof_data['wd_shop_slider_touch_drag'])?$smof_data['wd_shop_slider_touch_drag']:1; ?>;
						touch_drag = ( touch_drag == 1 );
						var responsive_refresh_rate = <?php echo (wp_is_mobile())?400:200; ?>;
						if( navigator.platform === 'iPod' ){
							slide_speed = 0;
							responsive_refresh_rate = 1000;
						}
						var owl = $_this.find('.products').owlCarousel({
								items : <?php echo $columns;?>,
								itemsCustom : [[0, 1], [361, 2], [620, 3], [780, 4], [930, <?php echo $columns;?>], [1600, <?php echo $columns;?>]],
								slideSpeed : slide_speed,
								navigation : false,
								pagination: has_pagination,
								paginationNumbers: true,
								scrollPerPage: scroll_per_page,
								rewindNav: rewind_nav,
								rewindSpeed: rewind_speed,
								autoPlay: auto_play,
								stopOnHover: stop_on_hover,
								mouseDrag: mouse_drag,
								touchDrag: touch_drag,
								navigationText: [''],
								responsiveBaseWidth: $_this,
								responsiveRefreshRate: responsive_refresh_rate,
								afterInit: function(){
									$_this.addClass('loaded').removeClass('loading');
									wd_update_next_prev_slider_button($_this);
								},
								afterUpdate: function(){
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
					});
				//]]>	
				</script>
				
			<?php endif;

			wp_reset_postdata();

			
			
			//add all the hook removed
			add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
			add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
			add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
			add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );	
			add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			//end
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns;
			
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';		
			
		}
	}		
	add_shortcode('best_selling_product_slider','wd_best_selling_product_slider_function');
	
	if(!function_exists('wd_best_selling_product_function')){
		function wd_best_selling_product_function($atts){
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			global $woocommerce_loop, $woocommerce;
			extract(shortcode_atts(array(
				'columns' 					=> 4,
				'style' 					=> 1,
				'per_page' 				=> 8,
				'title' 					=> '',
				'desc' 					=> '',
				'product_cats'				=> '',
				'show_image' 				=> 1,
				'show_title' 				=> 1,
				'show_sku' 				=> 0,
				'show_price' 				=> 1,
				'show_rating' 				=> 1,
				'show_label' 				=> 1		,
				'show_categories' 			=> 0		,
				'show_add_to_cart' 		=> 1							,
				'show_load_more' 			=> 0							
			),$atts));
			
			if(!(int)$show_image)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
				
			remove_action( 'woocommerce_after_shop_loop_item', 'add_short_content', 5 );
			if(!(int)$show_categories)
				remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
			if(!(int)$show_title)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_product_title', 3 );
			if(!(int)$show_sku)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
			if(!(int)$show_price)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			if(!(int)$show_rating)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );				
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );
			if(!(int)$show_add_to_cart)
				remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
				
			$args = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $per_page,
				'order' => 'desc',		
				'meta_key' 		 => 'total_sales',
				'orderby' 		 => 'meta_value_num',				
			);
			
			if( strlen(trim($product_cats)) > 0){
				$args['tax_query'] = array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> explode(',', esc_attr($product_cats) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				);
			}
		
			wp_reset_query(); 
			
			
			ob_start();
			
			$products = new WP_Query( $args );
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];	
			$woocommerce_loop['columns'] = $columns;
			$style = ($style == "")?1:$style;
			if ( $products->have_posts() ) : ?>
				<?php 
				$_random_id = 'featured_product_wrapper_'.rand(); 
				?>
				<div class="featured_product_wrapper <?php echo 'style-'.$style; ?>" id="<?php echo $_random_id;?>">
					<div class="featured_product_wrapper_meta"> 
						<?php
							if(strlen(trim($title)) >0)
								echo "<div class='wd_title_shortcode'><h3 class='heading-title title'>{$title}</h3></div>";
							if(strlen(trim($desc)) >0)	
								echo "<p class='desc-wrapper'>{$desc}</p>";
						?>
					</div>
					<div class="featured_product_wrapper_inner">
						
						<?php woocommerce_product_loop_start(); ?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>
						<?php woocommerce_product_loop_end(); ?>
						<?php if( (int)$show_load_more && $products->max_num_pages > 1 ){
							wd_product_shortcode_show_load_more_button('best_selling',$_random_id,$atts);
						} ?>
					</div>
				</div>
				
			<?php endif;

			wp_reset_postdata();

			
			
			//add all the hook removed
			add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
			add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
			add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
			add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );	
			add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			//end
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns;
			
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';		
			
		}
	}		
	add_shortcode('best_selling_product','wd_best_selling_product_function');
	
	
	
	if(!function_exists('wd_best_selling_product_by_category_slider_function')){
		function wd_best_selling_product_by_category_slider_function($atts){
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			global $woocommerce_loop, $woocommerce;
			extract(shortcode_atts(array(
				'columns' 			=> 4,
				'style' 			=> 1,
				'per_page' 		=> 8,
				'title' 			=> '',
				'desc' 			=> '',
				'product_tag' 		=> '',
				'show_nav' 		=> 1,
				'show_page_nav' 	=> 0,
				'show_image' 		=> 1,
				'show_title' 		=> 1,
				'show_sku' 		=> 0,
				'show_price' 		=> 1,
				'show_rating' 		=> 1,
				'show_label' 		=> 1		,
				'show_categories' 	=> 0,
				'cat_slug'			=> ''			
			),$atts));
			
			if($cat_slug=='' && has_term( $cat_slug, 'product_cat', 'product' )){
				echo 'cxc';
				return;
			}
			
			if(!(int)$show_image)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			
			remove_action( 'woocommerce_after_shop_loop_item', 'add_short_content', 5 );
			if(!(int)$show_categories)
				remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
			if(!(int)$show_title)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_product_title', 3 );
			if(!(int)$show_sku)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
			if(!(int)$show_price)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			if(!(int)$show_rating)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );					
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );
			$args = array(
				'post_type'		=> 'product',
				'post_status' 	 => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $per_page,
				'order' 		 => 'desc',		
				'meta_key' 		 => 'total_sales',
				'orderby' 		 => 'meta_value_num',
				'tax_query' 			=> array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> array( esc_attr($cat_slug) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				)
			);
		
			wp_reset_query(); 
			
			if( strlen($product_tag) > 0 && strcmp('all-product-tags',$product_tag) != 0 ){
				$args = array_merge($args, array('product_tag' => $product_tag));
			}
			
			ob_start();

			$products = new WP_Query( $args );
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];	
			$woocommerce_loop['columns'] = $columns;
			$style = ($style == "")?1:$style;
			if ( $products->have_posts() ) : ?>
				<?php $_random_id = 'featured_product_slider_wrapper_'.rand(); ?>
				<div class="featured_product_slider_wrapper <?php echo 'style-'.$style; ?>" id="<?php echo $_random_id;?>">
					<div class="featured_product_slider_wrapper_meta"> 
						<?php
							if(strlen(trim($title)) >0)
								echo "<div class='wd_title_shortcode'><h3 class='heading-title slider-title'>{$title}</h3></div>";
							if(strlen(trim($desc)) >0)	
								echo "<p class='slider-desc-wrapper'>{$desc}</p>";
						?>
					</div>
					<div class="featured_product_slider_wrapper_inner loading">
						
						<?php wd_woocommerce_product_loop_start_slide(); ?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php wc_get_template_part( 'content', 'product-slide' ); ?>

							<?php endwhile; // end of the loop. ?>
						<?php wd_woocommerce_product_loop_end_slide(); ?>
						
						<?php if($show_nav):?>
						<div class="slider_control">
							<a title="prev" id="<?php echo $_random_id;?>_prev" class="prev" href="#">&lt;</a>
							<a title="next" id="<?php echo $_random_id;?>_next" class="next" href="#">&gt;</a>
						</div>
						<?php endif;?>
						
					</div>
				</div>
				<?php global $smof_data; ?>
				<script type='text/javascript'>
				//<![CDATA[
					jQuery(document).ready(function() {
						"use strict";
						// Using custom configuration
						jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner').imagesLoaded(function(){
						var $_this = jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner');
						var has_pagination = <?php echo (int)$show_page_nav; ?>;
						has_pagination = ( has_pagination == 1);
						<?php if( wp_is_mobile() ){ ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_mobile'])?(int)$smof_data['wd_shop_slider_slide_speed_mobile']:200; ?>;
						<?php } else { ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_pc'])?(int)$smof_data['wd_shop_slider_slide_speed_pc']:800; ?>;
						<?php } ?>
						var scroll_per_page = <?php echo isset($smof_data['wd_shop_slider_scroll_per_page'])?$smof_data['wd_shop_slider_scroll_per_page']:0; ?>;
						scroll_per_page = ( scroll_per_page == 1 );
						var rewind_nav = <?php echo isset($smof_data['wd_shop_slider_rewind_nav'])?$smof_data['wd_shop_slider_rewind_nav']:1; ?>;
						rewind_nav = ( rewind_nav == 1 );
						var rewind_speed = <?php echo isset($smof_data['wd_shop_slider_rewind_speed'])?(int)$smof_data['wd_shop_slider_rewind_speed']:800; ?>;
						var auto_play = <?php echo isset($smof_data['wd_shop_slider_auto_play'])?$smof_data['wd_shop_slider_auto_play']:0; ?>;
						auto_play = ( auto_play == 1 );
						var stop_on_hover = <?php echo isset($smof_data['wd_shop_slider_stop_on_hover'])?$smof_data['wd_shop_slider_stop_on_hover']:0; ?>;
						stop_on_hover = ( stop_on_hover == 1 );
						var mouse_drag = <?php echo isset($smof_data['wd_shop_slider_mouse_drag'])?$smof_data['wd_shop_slider_mouse_drag']:0; ?>;
						mouse_drag = ( mouse_drag == 1 );
						var touch_drag = <?php echo isset($smof_data['wd_shop_slider_touch_drag'])?$smof_data['wd_shop_slider_touch_drag']:1; ?>;
						touch_drag = ( touch_drag == 1 );
						var responsive_refresh_rate = <?php echo (wp_is_mobile())?400:200; ?>;
						if( navigator.platform === 'iPod' ){
							slide_speed = 0;
							responsive_refresh_rate = 1000;
						}
						var owl = $_this.find('.products').owlCarousel({
								items : <?php echo $columns;?>,
								itemsCustom : [[0, 1], [361, 2], [620, 3], [780, 4], [930, <?php echo $columns;?>], [1600, <?php echo $columns;?>]],
								slideSpeed : slide_speed,
								navigation : false,
								pagination: has_pagination,
								paginationNumbers: true,
								scrollPerPage: scroll_per_page,
								rewindNav: rewind_nav,
								rewindSpeed: rewind_speed,
								autoPlay: auto_play,
								stopOnHover: stop_on_hover,
								mouseDrag: mouse_drag,
								touchDrag: touch_drag,
								navigationText: [''],
								responsiveBaseWidth: $_this,
								responsiveRefreshRate: responsive_refresh_rate,
								afterInit: function(){
									$_this.addClass('loaded').removeClass('loading');
									wd_update_next_prev_slider_button($_this);
								},
								afterUpdate: function(){
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
					});
				//]]>	
				</script>
				
			<?php endif;

			wp_reset_postdata();

			
			
			//add all the hook removed
			add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
			add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
			add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
			add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );			
			//end
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns;
			
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';		
			
		}
	}		
	add_shortcode('best_selling_product_by_category_slider','wd_best_selling_product_by_category_slider_function');
	
	/***** Recent Product *****/
	if(!function_exists('wd_recent_product_function')){
		function wd_recent_product_function($atts){
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			global $woocommerce_loop, $woocommerce;
			extract(shortcode_atts(array(
				'columns' 			=> 4,
				'style' 			=> 1,
				'per_page' 		=> 8,
				'title' 			=> '',
				'desc' 			=> '',
				'product_tag' 		=> '',
				'product_cats' 	=> '',
				'show_image' 		=> 1,
				'show_title' 		=> 1,
				'show_sku' 		=> 0,
				'show_price' 		=> 1,
				'show_rating' 		=> 1,
				'show_label' 		=> 1
                ,'show_categories' 	=> 0		,
				'show_add_to_cart'	=> 1		,
				'show_load_more'	=> 0		
			),$atts));
			
			if(!(int)$show_image)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			
			remove_action( 'woocommerce_after_shop_loop_item', 'add_short_content', 5 );
			if(!(int)$show_categories)
				remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
			if(!(int)$show_title)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_product_title', 3 );
			if(!(int)$show_sku)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
				
			if(!(int)$show_price)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			if(!(int)$show_rating)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );				
			if(!(int)$show_add_to_cart)
				remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			
			$args = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $per_page,
				'orderby' => 'date',
				'order' => 'desc',				
			);
			
			if( strlen(trim($product_cats)) > 0){
				$args['tax_query'] = array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> explode(',', esc_attr($product_cats) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				);
			}
		
			wp_reset_query(); 
			
			if( strlen(trim($product_tag)) > 0 ){
				$args = array_merge($args, array('product_tag' => $product_tag));
			}
			
			ob_start();

			$products = new WP_Query( $args );
			
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$woocommerce_loop['columns'] = $columns;
			$style = ($style == "")?1:$style;
			if ( $products->have_posts() ) : ?>
				<?php $_random_id = 'featured_product_wrapper_'.rand(); ?>
				<div class="featured_product_wrapper <?php echo 'style-'.$style; ?>" id="<?php echo $_random_id;?>">
					<div class="featured_product_wrapper_meta"> 
						<?php
							if(strlen(trim($title)) >0)
								echo "<div class='wd_title_shortcode'><h3 class='heading-title title'>{$title}</h3></div>";
							if(strlen(trim($desc)) >0)	
								echo "<p class='desc-wrapper'>{$desc}</p>";
						?>
					</div>
					<div class="featured_product_wrapper_inner">
						
						<?php woocommerce_product_loop_start(); ?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>
						<?php woocommerce_product_loop_end(); ?>
						<?php if( (int)$show_load_more && $products->max_num_pages > 1 ){
							wd_product_shortcode_show_load_more_button('recent',$_random_id,$atts);
						} ?>
					</div>
				</div>
			<?php endif;

			wp_reset_postdata();

			//add all the hook removed
			add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
			add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
			add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
			add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );	
			add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			//end
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns;
			
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';		
			
		}
	}		
	add_shortcode('recent_product','wd_recent_product_function');
	
	
	/***** Recent Product Slider *****/
	
	if(!function_exists('wd_recent_product_slider_function')){
		function wd_recent_product_slider_function($atts){
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			global $woocommerce_loop, $woocommerce;
			extract(shortcode_atts(array(
				'columns' 			=> 4,
				'style' 			=> 1,
				'per_page' 		=> 8,
				'title' 			=> '',
				'desc' 			=> '',
				'product_tag' 		=> '',
				'product_cats' 	=> '',
				'show_nav' 		=> 1,
				'show_page_nav' 	=> 0,
				'show_image' 		=> 1,
				'show_title' 		=> 1,
				'show_sku' 		=> 0,
				'show_price' 		=> 1,
				'show_rating' 		=> 1,
				'show_label' 		=> 1
                ,'show_categories' 	=> 0		,
				'show_add_to_cart'	=> 1		
			),$atts));
			
			if(!(int)$show_image)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			
			remove_action( 'woocommerce_after_shop_loop_item', 'add_short_content', 5 );
			if(!(int)$show_categories)
				remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
			if(!(int)$show_title)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_product_title', 3 );
			if(!(int)$show_sku)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
				
			if(!(int)$show_price)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			if(!(int)$show_rating)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );				
			if(!(int)$show_add_to_cart)
				remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			
			$args = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $per_page,
				'orderby' => 'date',
				'order' => 'desc',				
			);
			
			if( strlen(trim($product_cats)) > 0){
				$args['tax_query'] = array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> explode(',', esc_attr($product_cats) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				);
			}
		
			wp_reset_query(); 
			
			if( strlen(trim($product_tag)) > 0 ){
				$args = array_merge($args, array('product_tag' => $product_tag));
			}
			
			ob_start();

			$products = new WP_Query( $args );
			
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$woocommerce_loop['columns'] = $columns;
			$style = ($style == "")?1:$style;
			if ( $products->have_posts() ) : ?>
				<?php $_random_id = 'featured_product_slider_wrapper_'.rand(); ?>
				<div class="featured_product_slider_wrapper <?php echo 'style-'.$style; ?>" id="<?php echo $_random_id;?>">
					<div class="featured_product_slider_wrapper_meta"> 
						<?php
							if(strlen(trim($title)) >0)
								echo "<div class='wd_title_shortcode'><h3 class='heading-title slider-title'>{$title}</h3></div>";
							if(strlen(trim($desc)) >0)	
								echo "<p class='slider-desc-wrapper'>{$desc}</p>";
						?>
					</div>
					<div class="featured_product_slider_wrapper_inner loading">
						
						<?php wd_woocommerce_product_loop_start_slide(); ?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php wc_get_template_part( 'content', 'product-slide' ); ?>

							<?php endwhile; // end of the loop. ?>
						<?php wd_woocommerce_product_loop_end_slide(); ?>
						
						<?php if($show_nav):?>
						<div class="slider_control">
							<a title="prev" id="<?php echo $_random_id;?>_prev" class="prev" href="#">&lt;</a>
							<a title="next" id="<?php echo $_random_id;?>_next" class="next" href="#">&gt;</a>
						</div>
						<?php endif;?>
						
					</div>
				</div>
				<?php global $smof_data; ?>
				<script type='text/javascript'>
				//<![CDATA[
					jQuery(document).ready(function() {
						"use strict";
						// Using custom configuration
						jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner').imagesLoaded(function(){
						var $_this = jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner');
						var has_pagination = <?php echo (int)$show_page_nav; ?>;
						has_pagination = ( has_pagination == 1);
						<?php if( wp_is_mobile() ){ ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_mobile'])?(int)$smof_data['wd_shop_slider_slide_speed_mobile']:200; ?>;
						<?php } else { ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_pc'])?(int)$smof_data['wd_shop_slider_slide_speed_pc']:800; ?>;
						<?php } ?>
						var scroll_per_page = <?php echo isset($smof_data['wd_shop_slider_scroll_per_page'])?$smof_data['wd_shop_slider_scroll_per_page']:0; ?>;
						scroll_per_page = ( scroll_per_page == 1 );
						var rewind_nav = <?php echo isset($smof_data['wd_shop_slider_rewind_nav'])?$smof_data['wd_shop_slider_rewind_nav']:1; ?>;
						rewind_nav = ( rewind_nav == 1 );
						var rewind_speed = <?php echo isset($smof_data['wd_shop_slider_rewind_speed'])?(int)$smof_data['wd_shop_slider_rewind_speed']:800; ?>;
						var auto_play = <?php echo isset($smof_data['wd_shop_slider_auto_play'])?$smof_data['wd_shop_slider_auto_play']:0; ?>;
						auto_play = ( auto_play == 1 );
						var stop_on_hover = <?php echo isset($smof_data['wd_shop_slider_stop_on_hover'])?$smof_data['wd_shop_slider_stop_on_hover']:0; ?>;
						stop_on_hover = ( stop_on_hover == 1 );
						var mouse_drag = <?php echo isset($smof_data['wd_shop_slider_mouse_drag'])?$smof_data['wd_shop_slider_mouse_drag']:0; ?>;
						mouse_drag = ( mouse_drag == 1 );
						var touch_drag = <?php echo isset($smof_data['wd_shop_slider_touch_drag'])?$smof_data['wd_shop_slider_touch_drag']:1; ?>;
						touch_drag = ( touch_drag == 1 );
						var responsive_refresh_rate = <?php echo (wp_is_mobile())?400:200; ?>;
						if( navigator.platform === 'iPod' ){
							slide_speed = 0;
							responsive_refresh_rate = 1000;
						}
						var owl = $_this.find('.products').owlCarousel({
								items : <?php echo $columns;?>,
								itemsCustom : [[0, 1], [361, 2], [620, 3], [780, 4], [930, <?php echo $columns;?>], [1600, <?php echo $columns;?>]],
								slideSpeed : slide_speed,
								navigation : false,
								pagination: has_pagination,
								paginationNumbers: true,
								scrollPerPage: scroll_per_page,
								rewindNav: rewind_nav,
								rewindSpeed: rewind_speed,
								autoPlay: auto_play,
								stopOnHover: stop_on_hover,
								mouseDrag: mouse_drag,
								touchDrag: touch_drag,
								navigationText: [''],
								responsiveBaseWidth: $_this,
								responsiveRefreshRate: responsive_refresh_rate,
								afterInit: function(){
									$_this.addClass('loaded').removeClass('loading');
									wd_update_next_prev_slider_button($_this);
								},
								afterUpdate: function(){
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
					});
				//]]>	
				</script>
				
			<?php endif;

			wp_reset_postdata();

			
			
			//add all the hook removed
			add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
			add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
			add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
			add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );	
			add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			//end
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns;
			
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';		
			
		}
	}		
	add_shortcode('recent_product_slider','wd_recent_product_slider_function');
	
	if(!function_exists('wd_custom_categories_function')){
		function wd_custom_categories_function($atts){
			extract(shortcode_atts(array(
				'number' => 0,
				'columns' 			=> 4,
				'parent' 			=> '',
				'ids' 				=> '',
				'hide_empty' 		=> '0',
				'show_nav' 		=> 1,
				'show_item_title'	=> 0,
				'title'			=> '',
				'desc'				=> ''
			),$atts));
			
			if (empty($atts)) return;
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			global $woocommerce_loop;
			$args = array(
				'orderby'     => 'name',
				'order'      => 'ASC',
				'hide_empty' => $hide_empty,
				'include'    => explode(',',$ids),
				'pad_counts' => true,
				'child_of'   => '',
				'parent'	  => $parent
			);
			
			$product_categories = get_terms( 'product_cat', $args );
			foreach ( $product_categories as $key => $category ) {
				if ( $category->count == 0 ) {
					unset( $product_categories[ $key ] );
				}
			}
			if( $number != 0 && $number !=""){
				$product_categories = array_slice( $product_categories, 0, $number );
			}
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$woocommerce_loop['columns'] = $columns;
			
			ob_start();
			$woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';
			?>
			
			<?php $_random_id = 'featured_categories_slider_wrapper_'.rand(); ?>
				<div class="featured_categories_slider_wrapper" id="<?php echo $_random_id; ?>">
					<div class="featured_product_slider_wrapper_meta"> 
						<?php
							if(strlen(trim($title)) >0)
								echo "<div class='wd_title_shortcode'><h3 class='heading-title slider-title'>{$title}</h3></div>";
							if(strlen(trim($desc)) >0)	
								echo "<p class='slider-desc-wrapper'>{$desc}</p>";
						?>
					</div>
					<div class="featured_product_slider_wrapper_inner loading">
						<?php //echo do_shortcode('[product_categories number="'.$number.'"]'); 
							if ( $product_categories ) {
								wd_woocommerce_product_loop_start_slide();
								foreach ( $product_categories as $category ) {
									wc_get_template( 'content-product_cat_slide.php', array(
										'category' => $category
									) );
								}
								wd_woocommerce_product_loop_end_slide();
							}
							woocommerce_reset_loop();
						?>
						<?php if($show_nav):?>
						<div class="slider_control">
							<a title="prev" id="<?php echo $_random_id;?>_prev" class="prev" href="#">&lt;</a>
							<a title="next" id="<?php echo $_random_id;?>_next" class="next" href="#">&gt;</a>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php global $smof_data; ?>
				<script type='text/javascript'>
				//<![CDATA[
					var _columns = <?php echo $columns; ?>;
					var _random_id = '#<?php echo $_random_id; ?>';
					
					/* Config show_item_title option */
					var _show_item_title = <?php echo $show_item_title; ?>;
					if(!_show_item_title){
						jQuery(_random_id + " div.products div.product h3").remove();
					}
					
					jQuery(document).ready(function() {
						"use strict";
						// Using custom configuration
						jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner').imagesLoaded(function(){
						var $_this = jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner');
						<?php if( wp_is_mobile() ){ ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_mobile'])?(int)$smof_data['wd_shop_slider_slide_speed_mobile']:200; ?>;
						<?php } else { ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_pc'])?(int)$smof_data['wd_shop_slider_slide_speed_pc']:800; ?>;
						<?php } ?>
						var scroll_per_page = <?php echo isset($smof_data['wd_shop_slider_scroll_per_page'])?$smof_data['wd_shop_slider_scroll_per_page']:0; ?>;
						scroll_per_page = ( scroll_per_page == 1 );
						var rewind_nav = <?php echo isset($smof_data['wd_shop_slider_rewind_nav'])?$smof_data['wd_shop_slider_rewind_nav']:1; ?>;
						rewind_nav = ( rewind_nav == 1 );
						var rewind_speed = <?php echo isset($smof_data['wd_shop_slider_rewind_speed'])?(int)$smof_data['wd_shop_slider_rewind_speed']:800; ?>;
						var auto_play = <?php echo isset($smof_data['wd_shop_slider_auto_play'])?$smof_data['wd_shop_slider_auto_play']:0; ?>;
						auto_play = ( auto_play == 1 );
						var stop_on_hover = <?php echo isset($smof_data['wd_shop_slider_stop_on_hover'])?$smof_data['wd_shop_slider_stop_on_hover']:0; ?>;
						stop_on_hover = ( stop_on_hover == 1 );
						var mouse_drag = <?php echo isset($smof_data['wd_shop_slider_mouse_drag'])?$smof_data['wd_shop_slider_mouse_drag']:0; ?>;
						mouse_drag = ( mouse_drag == 1 );
						var touch_drag = <?php echo isset($smof_data['wd_shop_slider_touch_drag'])?$smof_data['wd_shop_slider_touch_drag']:1; ?>;
						touch_drag = ( touch_drag == 1 );
						var responsive_refresh_rate = <?php echo (wp_is_mobile())?400:200; ?>;
						if( navigator.platform === 'iPod' ){
							slide_speed = 0;
							responsive_refresh_rate = 1000;
						}
						var owl = $_this.find('.products').owlCarousel({
								items : <?php echo $columns;?>,
								itemsCustom : [[0, 1], [361, 2], [579, 3], [767, 3], [930, <?php echo $columns;?>], [1600, <?php echo $columns;?>]],
								slideSpeed : slide_speed,
								navigation : false,
								pagination: false,
								paginationNumbers: true,
								scrollPerPage: scroll_per_page,
								rewindNav: rewind_nav,
								rewindSpeed: rewind_speed,
								autoPlay: auto_play,
								stopOnHover: stop_on_hover,
								mouseDrag: mouse_drag,
								touchDrag: touch_drag,
								navigationText: [''],
								responsiveBaseWidth: $_this,
								responsiveRefreshRate: responsive_refresh_rate,
								afterInit: function(){
									$_this.addClass('loaded').removeClass('loading');
									wd_update_next_prev_slider_button($_this);
								},
								afterUpdate: function(){
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
					});
				//]]>	
				</script>
			<?php
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns;
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';			
			
		}
	}	
	
	
	add_shortcode('product_categories_slider','wd_custom_categories_function');
	
	
	if(!function_exists('wd_sale_product_slider_function')){
		function wd_sale_product_slider_function($atts){
			wp_reset_query(); 
			extract(shortcode_atts(array(
				'columns' 			=> 4,
				'style' 			=> 1,
				'per_page' 		=> 8,
				'title' 			=> '',
				'desc' 			=> '',
				'product_cats'		=> '',
				'show_nav' 		=> 1,
				'show_page_nav' 	=> 0,
				'show_image' 		=> 1,
				'show_title' 		=> 1,
				'show_sku' 		=> 0,
				'show_price' 		=> 1,
				'show_rating' 		=> 1,
				'show_label' 		=> 1	,
				'show_categories'	=> 0	,
				'show_add_to_cart' => '1'
			),$atts));
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			global $woocommerce_loop;
			if(!(int)$show_image)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			
			remove_action( 'woocommerce_after_shop_loop_item', 'add_short_content', 5 );
			if(!(int)$show_categories)
				remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
			if(!(int)$show_title)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_product_title', 3 );
			if(!(int)$show_sku)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
			if(!(int)$show_price)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			if(!(int)$show_rating)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );						
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );		
			if(!(int)$show_add_to_cart)
				remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			
			$args = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $per_page,
				'meta_query' => array(
					array(
						'key' => '_visibility',
						'value' => array('catalog', 'visible'),
						'compare' => 'IN'
					),
					array(
						'key' => '_sale_price',
						'value' =>  0,
						'compare'   => '>',
						'type'      => 'NUMERIC'
					)
				)
			);
			
			if( strlen(trim($product_cats)) > 0){
				$args['tax_query'] = array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> explode(',', esc_attr($product_cats) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				);
			}

			ob_start();
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$products = new WP_Query( $args );

			$woocommerce_loop['columns'] = $columns;
			$style = ($style == "")?1:$style;
			if ( $products->have_posts() ) : ?>
				<?php $_random_id = 'featured_product_slider_wrapper_'.rand(); ?>
				<div class="featured_product_slider_wrapper <?php echo 'style-'.$style; ?>" id="<?php echo $_random_id;?>">
					<div class="featured_product_slider_wrapper_meta"> 
						<?php
							if(strlen(trim($title)) >0)
								echo "<div class='wd_title_shortcode'><h3 class='heading-title slider-title'>{$title}</h3></div>";
							if(strlen(trim($desc)) >0)	
								echo "<p class='slider-desc-wrapper'>{$desc}</p>";
						?>
					</div>
					<div class="featured_product_slider_wrapper_inner loading">
						
						<?php wd_woocommerce_product_loop_start_slide(); ?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php wc_get_template_part( 'content', 'product-slide' ); ?>

							<?php endwhile; // end of the loop. ?>
						<?php wd_woocommerce_product_loop_end_slide(); ?>
						
						<?php if($show_nav):?>
						<div class="slider_control">
							<a title="prev" id="<?php echo $_random_id;?>_prev" class="prev" href="#">&lt;</a>
							<a title="next" id="<?php echo $_random_id;?>_next" class="next" href="#">&gt;</a>
						</div>
						<?php endif;?>
						
					</div>
				</div>
				<?php global $smof_data; ?>
				<script type='text/javascript'>
				//<![CDATA[
					jQuery(document).ready(function() {
						"use strict";
						// Using custom configuration
						jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner').imagesLoaded(function(){
						var $_this = jQuery('#<?php echo $_random_id?> > .featured_product_slider_wrapper_inner');
						var has_pagination = <?php echo (int)$show_page_nav; ?>;
						has_pagination = ( has_pagination == 1);
						<?php if( wp_is_mobile() ){ ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_mobile'])?(int)$smof_data['wd_shop_slider_slide_speed_mobile']:200; ?>;
						<?php } else { ?>
							var slide_speed = <?php echo isset($smof_data['wd_shop_slider_slide_speed_pc'])?(int)$smof_data['wd_shop_slider_slide_speed_pc']:800; ?>;
						<?php } ?>
						var scroll_per_page = <?php echo isset($smof_data['wd_shop_slider_scroll_per_page'])?$smof_data['wd_shop_slider_scroll_per_page']:0; ?>;
						scroll_per_page = ( scroll_per_page == 1 );
						var rewind_nav = <?php echo isset($smof_data['wd_shop_slider_rewind_nav'])?$smof_data['wd_shop_slider_rewind_nav']:1; ?>;
						rewind_nav = ( rewind_nav == 1 );
						var rewind_speed = <?php echo isset($smof_data['wd_shop_slider_rewind_speed'])?(int)$smof_data['wd_shop_slider_rewind_speed']:800; ?>;
						var auto_play = <?php echo isset($smof_data['wd_shop_slider_auto_play'])?$smof_data['wd_shop_slider_auto_play']:0; ?>;
						auto_play = ( auto_play == 1 );
						var stop_on_hover = <?php echo isset($smof_data['wd_shop_slider_stop_on_hover'])?$smof_data['wd_shop_slider_stop_on_hover']:0; ?>;
						stop_on_hover = ( stop_on_hover == 1 );
						var mouse_drag = <?php echo isset($smof_data['wd_shop_slider_mouse_drag'])?$smof_data['wd_shop_slider_mouse_drag']:0; ?>;
						mouse_drag = ( mouse_drag == 1 );
						var touch_drag = <?php echo isset($smof_data['wd_shop_slider_touch_drag'])?$smof_data['wd_shop_slider_touch_drag']:1; ?>;
						touch_drag = ( touch_drag == 1 );
						var responsive_refresh_rate = <?php echo (wp_is_mobile())?400:200; ?>;
						if( navigator.platform === 'iPod' ){
							slide_speed = 0;
							responsive_refresh_rate = 1000;
						}
						var owl = $_this.find('.products').owlCarousel({
								items : <?php echo $columns;?>,
								itemsCustom : [[0, 1], [361, 2], [620, 3], [780, 4], [930, <?php echo $columns;?>], [1600, <?php echo $columns;?>]],
								slideSpeed : slide_speed,
								navigation : false,
								pagination: has_pagination,
								paginationNumbers: true,
								scrollPerPage: scroll_per_page,
								rewindNav: rewind_nav,
								rewindSpeed: rewind_speed,
								autoPlay: auto_play,
								stopOnHover: stop_on_hover,
								mouseDrag: mouse_drag,
								touchDrag: touch_drag,
								navigationText: [''],
								responsiveBaseWidth: $_this,
								responsiveRefreshRate: responsive_refresh_rate,
								afterInit: function(){
									$_this.addClass('loaded').removeClass('loading');
									wd_update_next_prev_slider_button($_this);
								},
								afterUpdate: function(){
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
					});
				//]]>	
				</script>
				
			<?php endif;

			wp_reset_postdata();

			
			
			//add all the hook removed
			add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
			add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
			add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
			add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
			add_action( 'woocommerce_after_shop_loop_item', 'add_short_content', 5 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );		
			add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			//end
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns;
			
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';		
			
		}
	}		
	add_shortcode('sale_product_slider','wd_sale_product_slider_function');
	
	if(!function_exists('wd_sale_product_function')){
		function wd_sale_product_function($atts){
			wp_reset_query(); 
			extract(shortcode_atts(array(
				'columns' 					=> 4,
				'style' 					=> 1,
				'per_page' 				=> 8,
				'title' 					=> '',
				'desc' 					=> '',
				'product_cats'				=> '',
				'show_image' 				=> 1,
				'show_title' 				=> 1,
				'show_sku' 				=> 0,
				'show_price' 				=> 1,
				'show_rating' 				=> 1,
				'show_label' 				=> 1	,
				'show_categories'			=> 0	,
				'show_add_to_cart' 		=> 1,
				'show_load_more' 			=> 0
			),$atts));
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			global $woocommerce_loop;
			if(!(int)$show_image)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
			
			remove_action( 'woocommerce_after_shop_loop_item', 'add_short_content', 5 );
			if(!(int)$show_categories)
				remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
			if(!(int)$show_title)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_product_title', 3 );
			if(!(int)$show_sku)
				remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
			if(!(int)$show_price)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			if(!(int)$show_rating)
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );						
			if(!(int)$show_label)
				remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );		
			if(!(int)$show_add_to_cart)
				remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			
			$args = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $per_page,
				'meta_query' => array(
					array(
						'key' => '_visibility',
						'value' => array('catalog', 'visible'),
						'compare' => 'IN'
					),
					array(
						'key' => '_sale_price',
						'value' =>  0,
						'compare'   => '>',
						'type'      => 'NUMERIC'
					)
				)
			);
			
			if( strlen(trim($product_cats)) > 0){
				$args['tax_query'] = array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> explode(',', esc_attr($product_cats) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN'
					)
				);
			}

			ob_start();
			$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];
			$products = new WP_Query( $args );

			$woocommerce_loop['columns'] = $columns;
			$style = ($style == "")?1:$style;
			if ( $products->have_posts() ) : ?>
				<?php
				$_random_id = 'featured_product_slider_wrapper_'.rand(); 
				?>
				<div class="featured_product_wrapper <?php echo 'style-'.$style; ?>" id="<?php echo $_random_id;?>">
					<div class="featured_product_wrapper_meta"> 
						<?php
							if(strlen(trim($title)) >0)
								echo "<div class='wd_title_shortcode'><h3 class='heading-title'>{$title}</h3></div>";
							if(strlen(trim($desc)) >0)	
								echo "<p class='desc-wrapper'>{$desc}</p>";
						?>
					</div>
					<div class="featured_product_wrapper_inner">
						
						<?php woocommerce_product_loop_start(); ?>

							<?php while ( $products->have_posts() ) : $products->the_post(); ?>

								<?php wc_get_template_part( 'content', 'product' ); ?>

							<?php endwhile; // end of the loop. ?>
						<?php woocommerce_product_loop_end(); ?>
						<?php if( (int)$show_load_more && $products->max_num_pages > 1 ){
							wd_product_shortcode_show_load_more_button('sale',$_random_id,$atts);
						} ?>
					</div>
				</div>
				
			<?php endif;

			wp_reset_postdata();

			//add all the hook removed
			add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
			add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
			add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
			add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
			add_action( 'woocommerce_after_shop_loop_item', 'add_short_content', 5 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
			
			add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );		
			add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
			//end
			$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns;
			
			return '<div class="woocommerce">' . ob_get_clean() . '</div>';		
			
		}
	}		
	add_shortcode('sale_product','wd_sale_product_function');
	
	if(!function_exists('wd_product_shortcode_show_load_more_button')){
		function wd_product_shortcode_show_load_more_button($product_type='', $_random_id, $atts){
		?>
		<div class="wd_button_loadmore_wrapper">
			<input class="btn_load_more" type="button" value="<?php _e('Load more','wpdance'); ?>" data-paged="2" >
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				var atts = <?php echo json_encode($atts); ?>;
				atts.product_type = '<?php echo $product_type; ?>';
				atts.paged = jQuery('#<?php echo $_random_id; ?> .btn_load_more').attr('data-paged');
				jQuery('#<?php echo $_random_id; ?> .btn_load_more').bind('click',function(){
					if( !jQuery(this).hasClass("loading") ){
						jQuery('#<?php echo $_random_id; ?>').wd_product_shortcode_load_more(atts);
					}
				});
			});
		</script>
		<?php
		}
	}
	
	if(!function_exists('wd_product_shortcode_load_more')){
		function wd_product_shortcode_load_more(){
			if( isset($_POST, $_POST['atts']) ){
				
				wp_reset_query(); 
				extract($_POST['atts']);
				global $woocommerce_loop;
				if( isset($show_image) && !(int)$show_image )
					remove_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );
				
				remove_action( 'woocommerce_after_shop_loop_item', 'add_short_content',5 );
				if( isset($show_categories) && !(int)$show_categories )
					remove_action( 'woocommerce_after_shop_loop_item', 'get_product_categories', 2 );
				if( isset($show_title) && !(int)$show_title )
					remove_action( 'woocommerce_after_shop_loop_item', 'add_product_title', 3 );
				if( isset($show_sku) && !(int)$show_sku )
					remove_action( 'woocommerce_after_shop_loop_item', 'add_sku_to_product_list', 4 );
					
				if( isset($show_price) && !(int)$show_price )
					remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
				if( isset($show_rating) && !(int)$show_rating )
					remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );					
				if( isset($show_label) && !(int)$show_label )
					remove_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );		
				if( isset($show_add_to_cart) && !(int)$show_add_to_cart )
					remove_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
				
				if( !isset($per_page) )
					$per_page = 4;
				$args = array(
					'post_type'	=> 'product',
					'post_status' => 'publish',
					'ignore_sticky_posts'	=> 1,
					'posts_per_page' => $per_page,
					'paged' => $paged,
					'meta_query' => array(
						array(
							'key' => '_visibility',
							'value' => array('catalog', 'visible'),
							'compare' => 'IN'
						)
					)
				);
				if( isset($product_type) ){
					switch($product_type){
						case 'sale':
							$args['meta_query'][] = array(
								'key' 			=> '_sale_price',
								'value' 		=>  0,
								'compare'   	=> '>',
								'type'      	=> 'NUMERIC'
							);
							break;
						case 'featured':
							$args['meta_query'][] = array(
								'key' 			=> '_featured',
								'value' 		=> 'yes'
							);
							break;
						case 'recent':
							$args['orderby'] = 'date';
							$args['order'] = 'desc';
							break;
						case 'best_selling':
							$args['order'] = 'desc';
							$args['meta_key'] = 'total_sales';
							$args['orderby'] = 'meta_value_num';
							break;
					}
				}
				
				if( isset($product_cats) && strlen(trim($product_cats)) > 0){
					$args['tax_query'] = array(
						array(
							'taxonomy' 		=> 'product_cat',
							'terms' 		=> explode(',', esc_attr($product_cats) ),
							'field' 		=> 'slug',
							'operator' 		=> 'IN'
						)
					);
				}
				
				if( isset($product_tag) && strlen($product_tag) > 0 && strcmp('all-product-tags',$product_tag) != 0 ){
					$args = array_merge($args, array('product_tag' => $product_tag));
				}

				//ob_start();
				$_old_woocommerce_loop_columns = $woocommerce_loop['columns'];
				if( isset($product_type) && $product_type=='popular' )
					add_filter( 'posts_clauses', 'wd_order_by_rating_post_clauses' );
				$products = new WP_Query( $args );
				if( isset($product_type) && $product_type=='popular' )
					remove_filter( 'posts_clauses', 'wd_order_by_rating_post_clauses' );
				if( isset( $columns ) )
					$woocommerce_loop['columns'] = $columns;
				
				if ( $products->have_posts() ): ?>

						<?php while ( $products->have_posts() ) : $products->the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; ?>
					
				<?php endif;
				if($products->max_num_pages == $paged || !$products->have_posts()){
					?>
						<span class="hidden wd_flag_end_page" ></span>
					<?php
				}
				wp_reset_postdata();
				
				add_action ('woocommerce_after_shop_loop_item','open_div_style',1);
				add_action ('woocommerce_after_shop_loop_item','get_product_categories',2);
				add_action ('woocommerce_after_shop_loop_item','add_product_title',3);
				add_action ('woocommerce_after_shop_loop_item','add_sku_to_product_list',4);
				add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 7 );
				add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 1 );			
				
				add_action( 'woocommerce_before_shop_loop_item_title', 'add_label_to_product_list', 5 );	
				
				add_action( 'woocommerce_before_shop_loop_item_title', 'wd_template_loop_product_thumbnail', 10 );		
				add_action( 'woocommerce_after_shop_loop_item', 'wd_list_template_loop_add_to_cart',9999 );
				$woocommerce_loop['columns'] = $_old_woocommerce_loop_columns;
				echo ob_get_clean();
				die();
			}
			else{
				echo "";
				die();
			}
			
		}
	}
	
	add_action("wp_ajax_wd_product_shortcode_load_more", "wd_product_shortcode_load_more");
	add_action("wp_ajax_nopriv_wd_product_shortcode_load_more", "wd_product_shortcode_load_more");
	
?>