<?php
/**
 * EW Social Widget
 */
if(!class_exists('WP_Widget_Ew_social')){
	class WP_Widget_Ew_social extends WP_Widget {
		function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Social Profiles','wpdance'),
				'desc' 		=> esc_html__('Display Social Profiles','wpdance'),
				'slug' 	  	=> 'ew_social',
				'class' 	=> 'widget_social',
			);
			$widget_ops 		= array('classname' => $widget_setting['class'], 'description' => $widget_setting['desc']);
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct($widget_setting['slug'], $widget_setting['name'], $widget_ops);
		}

		function widget( $args, $instance ) {
			extract($args);
			$title = isset($instance['title']) ? esc_attr(apply_filters( 'widget_title', $instance['title'] )) : '';
			$feedburner_id = isset($instance['feedburner_id']) ? str_replace(" ","",esc_attr($instance['feedburner_id'])) : '';
			$twitter_id = isset($instance['twitter_id']) ? str_replace(" ","",esc_attr($instance['twitter_id'])) : '';
			$facebook_id = isset($instance['facebook_id']) ? str_replace(" ","",esc_attr($instance['facebook_id'])) : '';
			$photobucket_url = isset($instance['photobucket_url']) ? str_replace(" ","",esc_attr($instance['photobucket_url'])) : '';		
			$flickr_id = isset($instance['flickr_id']) ? str_replace(" ","",esc_attr($instance['flickr_id'])) : '';			
			?>
			<?php echo $before_widget;?>
			<?php echo $before_title . $title . $after_title;?>
			<div class="social-icons">
				<div class="widget_desc social_desc">
					<?php echo $instance['desc']?>
				</div>
				<ul>
					<?php if( $facebook_id !== "" ): ?>
						<li class="icon-facebook"><a href="http://www.facebook.com/<?php echo $facebook_id; ?>" target="_blank" title="<?php _e('Become our fan', 'wpdance'); ?>" ><?php _e('Facebook', 'wpdance'); ?></a><span><?php _e('Become our fan', 'wpdance'); ?></span></li>				
					<?php endif; ?>
					<?php if( $twitter_id !== "" ): ?>
						<li class="icon-twitter"><a href="http://twitter.com/<?php echo $twitter_id; ?>" target="_blank" title="<?php _e('Follow us', 'wpdance'); ?>" ><?php _e('Twitter', 'wpdance'); ?></a><span><?php _e('Follow us', 'wpdance'); ?></span></li>
					<?php endif; ?>
					<?php if( $flickr_id !== "" ): ?>
						<li class="icon-flickr"><a href="http://www.flickr.com/photos/<?php echo $flickr_id;?>" target="_blank" title="<?php _e('See Us', 'wpdance'); ?>" ><?php _e('Flickr', 'wpdance'); ?></a><span><?php _e('See Us', 'wpdance'); ?></span></li>
					<?php endif; ?>
					<?php if( $photobucket_url !== "" ): ?>
						<li class="icon-photobucket"><a href="<?php echo $photobucket_url; ?>" target="_blank" title="<?php _e('See Us', 'wpdance'); ?>"  ><?php _e('Photobucket', 'wpdance'); ?></a><span><?php _e('See Us', 'wpdance'); ?></span></li>
					<?php endif; ?>
					<?php if( $feedburner_id !== "" ): ?>
						<li class="icon-rss"><a href="http://feeds.feedburner.com/<?php echo $feedburner_id; ?>" target="_blank" title="<?php _e('Get updates', 'wpdance'); ?>" ><?php _e('RSS', 'wpdance'); ?></a><span><?php _e('Get updates', 'wpdance'); ?></span></li>
					<?php endif; ?>
				</ul>
				<div class="clear"></div>
			</div>

			<?php
			echo $after_widget;
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['feedburner_id'] = $new_instance['feedburner_id'];
			$instance['twitter_id'] =  $new_instance['twitter_id'];
			$instance['facebook_id'] =  $new_instance['facebook_id'];
			$instance['photobucket_url'] =  $new_instance['photobucket_url'];		
			$instance['title'] =  $new_instance['title'];
			$instance['desc'] =  $new_instance['desc'];		
			$instance['flickr_id'] =  $new_instance['flickr_id'];			
			
			
			return $instance;
		}

		function form( $instance ) { 
			$instance = wp_parse_args( (array) $instance, array( 'title' => 'Find Us On', 'desc' => 'Social Connection','feedburner_id' => 'Feedburner ID', 'twitter_id' => 'Twitter ID', 'facebook_id' => 'Facebook ID', 'photobucket_url' => 'http://photobucket.com/','vimeo_id' => 'Vimeo ID','flickr_id' => 'Flickr Id' ) );
			$feedburner_id = esc_attr($instance['feedburner_id']);
			$twitter_id = esc_attr(format_to_edit($instance['twitter_id']));
			$facebook_id = esc_attr(format_to_edit($instance['facebook_id']));
			$photobucket_url = esc_attr(format_to_edit($instance['photobucket_url']));	
			$flickr_id = esc_attr(format_to_edit($instance['flickr_id']));	
				
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Enter your title','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('desc'); ?>"><?php _e('Enter your description','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('desc'); ?>" name="<?php echo $this->get_field_name('desc'); ?>" type="text" value="<?php echo $instance['desc']; ?>" /></p>
			
		
		
			<p><label for="<?php echo $this->get_field_id('feedburner_id'); ?>"><?php _e('Enter your Feedburner ID','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('feedburner_id'); ?>" name="<?php echo $this->get_field_name('feedburner_id'); ?>" type="text" value="<?php echo $feedburner_id; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Enter your Twitter ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $twitter_id; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('facebook_id'); ?>"><?php _e('Enter your Facebook ID','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('facebook_id'); ?>" name="<?php echo $this->get_field_name('facebook_id'); ?>" value="<?php echo $facebook_id; ?>" /></p>
			<p><label for="<?php echo $this->get_field_id('photobucket_url'); ?>"><?php _e('Enter your Photobucket URL','wpdance'); ?> : </label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('photobucket_url'); ?>" name="<?php echo $this->get_field_name('photobucket_url'); ?>" value="<?php echo $photobucket_url; ?>" /></p>		
			<p><label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php _e('Enter your Flickr ID','wpdance'); ?> : </label>
			<input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo $flickr_id; ?>" /></p>
			<?php }
	}
}

