<?php 
if(!class_exists('WP_Widget_Customrecent')){
	class WP_Widget_Customrecent extends WP_Widget {
		function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Recent Posts','wpdance'),
				'desc' 		=> esc_html__('This widget show recent post in each category you select.','wpdance'),
				'slug' 	  	=> 'customrecent',
				'class' 	=> '',
			);
			$widget_ops 		= array('classname' => $widget_setting['class'], 'description' => $widget_setting['desc']);
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct($widget_setting['slug'], $widget_setting['name'], $widget_ops);
		}
	  
		function widget($args, $instance){
			global $wpdb; // call global for use in function
			
			$cache = wp_cache_get('customrecent', 'widget');			
			
			if ( ! is_array( $cache ) )
				$cache = array();

			if ( isset( $cache[$args['widget_id']] ) ) {
				echo $cache[$args['widget_id']];
				return;
			}

			ob_start();			
			
			extract($args); // gives us the default settings of widgets
			
			$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent','wpdance') : $instance['title']);
			
			$link = empty( $instance['link'] ) ? '#' : esc_url($instance['link']);
			$link = ( isset($link) && strlen($link) > 0 ) ? $link : "#" ;
			
			$_limit = absint($instance['limit']) == 0 ? 5 : absint($instance['limit']);
			
			echo $before_widget; // echos the container for the widget || obtained from $args
			if($title){
				echo $before_title . $title . $after_title;
			}
			
			wp_reset_query();
			wp_reset_postdata();	
			rewind_posts();			
			
			$num_count = count(query_posts("showposts={$_limit}&ignore_sticky_posts=1&post_type=post"));	
			if(have_posts())	{
				$id_widget = 'recent-'.rand(0,1000);
				echo '<ul>';
				$i = 0;
				while(have_posts()) {the_post();global $post;
					?>
					<li <?php if($i==0) echo "class='first'";else if($i == $num_count - 1) echo "class='last'";?>>
						<!--<div class="image">
							<a class="thumbnail" href="<?php //the_permalink(); ?>">
								<?php 
									//if ( has_post_thumbnail() ) {
									//	the_post_thumbnail('prod_tini_thumb_2',array('title' => esc_attr(get_the_title()),'alt' => esc_attr(get_the_title()) ));
									//} 
								?>
							</a>
							<span class="shadow"></span>
						</div>-->
						<div class="content">
							<span class="time"><i class="icon-calendar custom-icon"></i><?php the_time(get_option( 'date_format' )); ?></span>
							<p class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
							<p class="excerpt"><?php the_excerpt_max_words(20); ?></p>
							<span class="wpt-author-time">
								<span class="author"><?php _e("Post by ","wpdance")?><span class="name"><?php the_author(); ?></span></span>
								<span class="comment-number"><span class="number"><?php $comments_count = wp_count_comments($post->ID); if($comments_count->approved < 10 && $comments_count->approved > 0) echo '0'; echo $comments_count->approved; ?></span><?php _e(" comment(s)","wpdance")?></span>
							</span>
						</div>
					</li>
				
					
				<?php $i++; }
				echo '</ul>';
			}
			wp_reset_query();
			
			echo $after_widget; // close the container || obtained from $args
			$content = ob_get_clean();

			if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

			echo $content;

			wp_cache_set('customrecent', $cache, 'widget');			
			
		}

		
		function update($new_instance, $old_instance) {
			return $new_instance;
		}

		
		function form($instance) {        

			//Defaults
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'From Our Blog','link'=>'#','limit'=>4) );
			$title = esc_attr( $instance['title'] );
			$limit = absint( $instance['limit'] );
			$link = esc_url( $instance['link'] );
			?>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title','wpdance' ); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

			<p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e( 'Title Link','wpdance' ); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" /></p>			
			
			<p><label for="<?php echo $this->get_field_id('limit'); ?>"><?php _e( 'Limit','wpdance' ); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo $limit; ?>" /></p>
			
	<?php
		   
		}
	}
}
?>