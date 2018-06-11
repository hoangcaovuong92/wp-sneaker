<?php 
if(!class_exists('WP_Widget_Recent_Post_Slider')){
	class WP_Widget_Recent_Post_Slider extends WP_Widget {
		function __construct() {
	    	$widget_setting = array(
				'name' 		=> esc_html__('WD - Recent Posts [Slider]','wpdance'),
				'desc' 		=> esc_html__('This widget show recent posts by slider.','wpdance'),
				'slug' 	  	=> 'recent_post_slider',
				'class' 	=> '',
			);
			$widget_ops 		= array('classname' => $widget_setting['class'], 'description' => $widget_setting['desc']);
			$control_ops 		= array('width' => 400, 'height' => 350);
			parent::__construct($widget_setting['slug'], $widget_setting['name'], $widget_ops);
		}
	  
		function widget($args, $instance){
			global $wpdb; // call global for use in function
			
			
			$cache = wp_cache_get('recent_post_slider', 'widget');			
			
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
			if( class_exists('WP_Widget_Productaz') ){
				global $wp_widget_factory;
				remove_action( 'posts_where', array( $wp_widget_factory->widgets['WP_Widget_Productaz'], 'add_a2z_query_to_post_where'  ),11 );
			}
			wp_reset_query();	
			$num_count = count(query_posts("showposts={$_limit}&ignore_sticky_posts=1"));	
			echo '<div class="wd_recent_post_widget_wrapper loading">';
			if(have_posts())	{
				$id_widget = 'recent-'.rand(0,1000).time();
				echo '<div class="wd_recent_posts_'.$id_widget.'">';
				$i = 0;
				while(have_posts()) {the_post();global $post;
					?>
					<div class="item">
						<div class="detail">
							<div class="post_thumbnail">
								<a class="wd-effect" href="<?php the_permalink(); ?>">
								<?php if(has_post_thumbnail()){ ?>
									<?php the_post_thumbnail(array(240,115),array('title'=>get_the_title()));?>	
								<?php } else { ?>	
									<img alt="<?php the_title(); ?>" height="240" width="115" title="<?php the_title();?>" src="<?php echo get_template_directory_uri(); ?>/images/no-image-blog.gif"/>
								<?php } ?>
								</a>
							</div>
							<!--<div class="author"><?php //_e('POST BY','wpdance');?> <?php the_author_posts_link();?></div>-->
							<div class="entry-title">
								<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdance' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
									<?php echo esc_attr(get_the_title()); ?>
								</a>
								<p class="entry-desc">
									<?php echo the_excerpt_max_words(10,$post),'...';?>
								</p>
								<a class="read-more" href="<?php the_permalink(); ?>" ><?php _e('Read more','wpdance');?></a>
							</div>
							
						</div><!--detail -->
						
					</div>
				
					
				<?php }
				echo '</div>';
				echo '<div class="clearfix"></div>';
				echo '<div class="wd_recent_control"><a class="prev" title="prev" id="wd_recent_posts_prev_'.$id_widget.'" href="#">&lt;</a>';
				echo '<a class="next" title="next" id="wd_recent_posts_next_'.$id_widget.'" href="#" >&gt;</a> </div>';
			}
			echo '</div>';
?>			
			<script type="text/javascript" language="javascript">
		//<![CDATA[
			jQuery(document).ready(function() {
				var $_this = jQuery('.wd_recent_post_widget_wrapper');
				var owl = $_this.find('.wd_recent_posts_<?php echo $id_widget;?>').owlCarousel({
						items : 1
						,itemsCustom : false
						,itemsDesktop : [1199,1]
						,itemsDesktopSmall : [980,1]
						,itemsTablet: [768,1]
						,itemsTabletSmall: false
						,itemsMobile : [479,1]
						,slideSpeed : 300
						,navigation : false
						,pagination: false
						,paginationNumbers: false
						,mouseDrag: true
						,scrollPerPage: false
						,rewindNav: true
						,navigationText: ['']
						,afterInit: function(){
							$_this.addClass('loaded').removeClass('loading');
							if( typeof wd_update_next_prev_slider_button == 'function')
								wd_update_next_prev_slider_button($_this);
						}
						,afterUpdate: function(){
							if( typeof wd_update_next_prev_slider_button == 'function')
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
		//]]>	
		</script>
<?php		
			wp_reset_query();
			
			echo $after_widget; // close the container || obtained from $args
			$content = ob_get_clean();

			if ( isset( $args['widget_id'] ) ) $cache[$args['widget_id']] = $content;

			echo $content;

			wp_cache_set('recent_post_slider', $cache, 'widget');			
			
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