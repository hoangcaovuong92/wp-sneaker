<?php 
// Create widget tabs post
if(!class_exists('WP_Widget_Best_Selling_Product')){
	class WP_Widget_Best_Selling_Product extends WP_Widget {
		function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Best Selling Products','wpdance'),
				'desc' 		=> esc_html__('Show Best Selling Products','wpdance'),
				'slug' 	  	=> 'best_selling_product',
				'class' 	=> 'widget_best_selling_product woocommerce',
			);
			$widget_ops 		= array('classname' => $widget_setting['class'], 'description' => $widget_setting['desc']);
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct($widget_setting['slug'], $widget_setting['name'], $widget_ops);
		}

		function widget( $args, $instance ) {
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "woocommerce/woocommerce.php", $_actived ) ) {
				return;
			}
			
			extract( $args );
			$title = apply_filters('widget_title', empty($instance['title_best_selling']) ? __('Best Selling Products','wpdance') : $instance['title_best_selling']);
			$num_best_selling = empty( $instance['num_best_selling'] ) ? 5 : absint($instance['num_best_selling']);
			
			$post_type = "product";
			
			$thumbnail_width = 60;
			$thumbnail_height = 60;

			$output = $before_widget;
			if ( $title )
				$output .= $before_title . $title . $after_title;
			
			echo $output;
			wp_reset_query();
			global $post;
			$args_query = array(
				'post_type'	=> 'product',
				'post_status' => 'publish',
				'ignore_sticky_posts'	=> 1,
				'posts_per_page' => $num_best_selling,
				'order' => 'desc',		
				'meta_key' 		 => 'total_sales',
				'orderby' 		 => 'meta_value_num',				
				'meta_query' => array(
					array(
						'key' => '_visibility',
						'value' => array('catalog', 'visible'),
						'compare' => 'IN'
					)
				)
			);
		
			$best_selling=new wp_query($args_query);
	?>
			<?php if($best_selling->post_count>0){$i = 0;
			?>
			<ul class="product_list_widget">
				<?php while ($best_selling->have_posts()) : $best_selling->the_post();?>
				<li <?php echo ($i==0)?"class='first'":($i == count($best_selling)?"class='last'":""); ?>>

						<a class="thumbnail" href="<?php echo get_permalink($post->ID); ?>">
							<?php  
								if ( has_post_thumbnail() ) {
									the_post_thumbnail('prod_tini_thumb',array('title' => esc_attr(get_the_title()),'alt' => esc_attr(get_the_title()) ));
								} 
							?>
							<?php echo esc_attr(get_the_title($post->ID)); ?>
						</a>		
					
						<?php if(function_exists('wd_template_single_rating')) wd_template_single_rating(); ?>
						<?php woocommerce_template_loop_price(); ?>
				</li>
				<?php $i++; endwhile;?>
			</ul>
			<?php }?>
			<?php wp_reset_query(); ?>
			
	<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
				$instance = $old_instance;
				$instance['title_best_selling'] = strip_tags($new_instance['title_best_selling']);
				$instance['num_best_selling'] = absint($new_instance['num_best_selling']);
				return $instance;
		}

		function form( $instance ) {
				//Defaults
				$instance = wp_parse_args( (array) $instance, array( 'title_best_selling' => 'Best Selling' , 'num_best_selling' => 5 ) );
				$title_best_selling = esc_attr( $instance['title_best_selling'] );
				$num_best_selling = absint( $instance['num_best_selling'] );

	?>
				<p><label for="<?php echo $this->get_field_id('title_best_selling'); ?>"><?php _e( 'Title for best selling tab:','wpdance' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title_best_selling'); ?>" name="<?php echo $this->get_field_name('title_best_selling'); ?>" type="text" value="<?php echo $title_best_selling; ?>" /></p>

				<p><label for="<?php echo $this->get_field_id('num_best_selling'); ?>"><?php _e( 'The number of best selling post','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo $this->get_field_id('num_best_selling'); ?>" name="<?php echo $this->get_field_name('num_best_selling'); ?>" type="text" value="<?php echo $num_best_selling; ?>" /></p>
				

	<?php
		}
	}
}
?>