<?php
class WP_Widget_Recent_Comments_custom extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_comments_custom', 'description' => __( 'The most recent comments','wpdance' ) );
		parent::__construct('recent-comments-custom', __('WD - Recent Comments','wpdance'), $widget_ops);
		$this->alt_option_name = 'widget_recent_comments';

		if ( is_active_widget(false, false, $this->id_base) )
			add_action( 'wp_head', array(&$this, 'recent_comments_style') );

		add_action( 'comment_post', array(&$this, 'flush_widget_cache') );
		add_action( 'transition_comment_status', array(&$this, 'flush_widget_cache') );
	}

	function recent_comments_style() {
		if ( ! current_theme_supports( 'widgets' ) // Temp hack #14876
			|| ! apply_filters( 'show_recent_comments_widget_style', true, $this->id_base ) )
			return;
		?>
	<style type="text/css">.recentcomments a{display:inline !important;padding:0 !important;margin:0 !important;}</style>
<?php
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_comments', 'widget');
	}

	function widget( $args, $instance ) {
		global $comments, $comment;

		$cache = wp_cache_get('widget_recent_comments', 'widget');

		if ( ! is_array( $cache ) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

 		extract($args, EXTR_SKIP);
 		$output = '';
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Comments','wpdance' ) : $instance['title'], $instance, $this->id_base );

		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 5;
		$count=0;
		$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish' ) );
		echo  $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		echo '<ul id="recentcomments">';
		if ( $comments ) {
			$i = 0; //Custom
			foreach ( (array) $comments as $comment) {
			$count++;	
				//<!--Custom-->
				$GLOBALS['comment'] = $comment;
					switch ( $comment->comment_type ) :
						case '':
						$class = "";
						if($i == 0)
							$class .= "first ";
						if(++$i == count($comments))
							$class .= "last";
				?>
						<li <?php if($class) echo "class='$class'";?>>
							<!--<div class="avarta"><a href="<?php //comment_link() ; ?>"><?php //echo get_avatar( $comment, 70,get_bloginfo('template_url') . '/images/mycustomgravatar.png'  ); ?></a></div>-->
							<div class="detail">
								<span class="time"><i class="icon-calendar custom-icon"></i><?php the_time(get_option( 'date_format' )); ?></span>
								<div class="comment-author vcard">
									<?php printf( __( '%s', 'wpdance' ), sprintf( '<cite class="fn"><a href="%1$s" rel="external nofollow" class="url">%2$s</a></cite>', get_comment_author_url(),get_comment_author() ) ); ?>:
								</div><!-- .comment-author .vcard -->
								<blockquote class="comment-body"><?php echo  '"'.string_limit_words(get_comment_text(),10).'"'; ?></blockquote>
								<div class="comment-meta"><span><?php _e("in","wpdance")?> <a href="<?php echo esc_url(get_permalink( $comment->comment_post_ID ));?>"><?php echo esc_attr(get_the_title( $comment->comment_post_ID ));?></a></span></div>
								<span class="author"><?php _e("Post by ","wpdance")?><span class="name"><?php the_author(); ?></span></span>
							</div>
						</li>
					<?php
							break;
						case 'pingback'  :
						case 'trackback' :
							break;
					endswitch;		
					?>
				
				<!--Custom-->
				
				
				<?php
			}
 		}
		echo '</ul>';
		$output .= $after_widget;

		echo $output;
		$cache[$args['widget_id']] = $output;
		wp_cache_set('widget_recent_comments', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = esc_attr($new_instance['title']);
		$instance['number'] = absint( $new_instance['number'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_comments']) )
			delete_option('widget_recent_comments');

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Recent Comments', 'number' => 5) );
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','wpdance'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of comments to show','wpdance'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
<?php
	}
}
register_widget('WP_Widget_Recent_Comments_custom');
?>