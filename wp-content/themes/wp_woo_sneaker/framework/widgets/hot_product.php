<?php 
// Create widget tabs post
if(!class_exists('WP_Widget_Hot_Product')){
	class WP_Widget_Hot_Product extends WP_Widget {
		function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Hot Products','wpdance'),
				'desc' 		=> esc_html__('Show Hot Products','wpdance'),
				'slug' 	  	=> 'hot_product',
				'class' 	=> 'widget_hot_product woocommerce',
			);
			$widget_ops 		= array('classname' => $widget_setting['class'], 'description' => $widget_setting['desc']);
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct($widget_setting['slug'], $widget_setting['name'], $widget_ops);
		}

		function widget( $args, $instance ) {
			extract( $args );
			$title = apply_filters('widget_title', empty($instance['title_popular']) ? __('Hot Products','wpdance') : $instance['title_popular']);
			$num_popular = empty( $instance['num_popular'] ) ? 5 : absint($instance['num_popular']);
			
			$post_type = "product";
			
			$thumbnail_width = 60;
			$thumbnail_height = 60;

			$output = $before_widget;
			if ( $title )
				$output .= $before_title . $title . $after_title;
			
			echo $output;
			wp_reset_query();
			global $post;
			$popular=new wp_query(array('post_type' => 'product','posts_per_page' => $num_popular,'post_status'=>'publish','ignore_sticky_posts'=> 1, 'order' => 'DESC'));
	?>
			<?php if($popular->post_count>0){$i = 0;
			?>
			<ul class="product_list_widget">
				<?php while ($popular->have_posts()) : $popular->the_post();?>
				<li <?php echo ($i==0)?"class='first'":($i == count($popular)?"class='last'":""); ?>>

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
				$instance['title_popular'] = strip_tags($new_instance['title_popular']);
				$instance['num_popular'] = absint($new_instance['num_popular']);
				return $instance;
		}

		function form( $instance ) {
				//Defaults
				$instance = wp_parse_args( (array) $instance, array( 'title_popular' => 'Popular' , 'num_popular' => 5 ) );
				$title_popular = esc_attr( $instance['title_popular'] );
				$num_popular = absint( $instance['num_popular'] );

	?>
				<p><label for="<?php echo $this->get_field_id('title_popular'); ?>"><?php _e( 'Title for popular tab:','wpdance' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title_popular'); ?>" name="<?php echo $this->get_field_name('title_popular'); ?>" type="text" value="<?php echo $title_popular; ?>" /></p>

				<p><label for="<?php echo $this->get_field_id('num_popular'); ?>"><?php _e( 'The number of popular post','wpdance' ); ?>:</label>
				<input class="widefat" id="<?php echo $this->get_field_id('num_popular'); ?>" name="<?php echo $this->get_field_name('num_popular'); ?>" type="text" value="<?php echo $num_popular; ?>" /></p>
				

	<?php
		}
	}
}
?>