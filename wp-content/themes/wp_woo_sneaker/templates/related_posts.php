<?php
	global $smof_data;
?>
<div class="related">
	<div class="wd_title_related"><h3 class="heading-title"><?php echo stripslashes(esc_attr($smof_data['wd_blog_details_relatedlabel'])); ?></h3></div>
	<div class="related_post_slider">
		<div class="slides">
		<?php
			$_cat_list = get_the_category($post->ID);
			$_cat_list_arr = array();
			foreach($_cat_list as $_cat_item){
				array_push($_cat_list_arr,$_cat_item->term_id);
			}
			$_list_cat_id = implode($_cat_list_arr,",");
			if( !empty( $_cat_list  ))
				$arg=array(
					'post_type' => $post->post_type,
					'cat' => $_list_cat_id,
					'post__not_in' => array($post->ID),
					'posts_per_page' => 4
				);
			else
				$arg=array(
				'post_type' => $post->post_type,
				'post__not_in' => array($post->ID),
				'posts_per_page' => 4
			);
			wp_reset_query();
			$related = new wp_query($arg);$cout = 0;
			if($related->have_posts()) : while($related->have_posts()) : $related->the_post();global $post;$cout++;
				$thumb=get_post_thumbnail_id($post->ID);
				$thumburl=wp_get_attachment_image_src($thumb,'full');
				?>
					<div class="related-item <?php if($cout==1) echo " first";if($cout==$related->post_count) echo " last";?>">
						<div>
							<a class="thumbnail" href="<?php the_permalink(); ?>">
								<?php 
									if ( has_post_thumbnail() ) {
										the_post_thumbnail('blog_thumb',array('class' => 'thumbnail-blog'));
										//the_post_thumbnail( 'related_thumb',array('title' => get_the_title(),'alt' => get_the_title(),'class' => 'thumbnail-effect-1') );
										//the_post_thumbnail( 'related_thumb',array('title' => get_the_title(),'alt' => get_the_title(),'class' => 'thumbnail-effect-2') );
									} 							
								?>
								<div class="thumbnail-shadow"></div>
							</a>
							
							<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							<p class="date-time"><?php the_time(get_option('date_format')); ?></p>
						</div>
					</div>
				<?php
			endwhile;
			else:
				echo "<li class=\"span12 related-404\"><div class=\"alert alert-warning\">". __("Sorry,no post found!","wpdance") ."</div></li>";
			endif;
			
			wp_reset_query();
		?>
		</div>
		<div class="slider_control">
			<a title="prev" class="prev" href="#">&lt;</a>
			<a title="next" class="next" href="#">&gt;</a>
		</div>
	</div>
</div>
<script type="text/javascript">
	
	jQuery(document).ready(function() {
		var $_this = jQuery('.related_post_slider');
		var slide_speed = <?php echo (wp_is_mobile())?200:800; ?>;
		if( navigator.platform === 'iPod' ){
			slide_speed = 0;
		}
		var owl = $_this.find('.slides').owlCarousel({
				items : 3
				,itemsCustom : [[0, 1], [361, 2], [579, 3], [767, 3], [1200, 4], [1600, 5]]
				,slideSpeed : slide_speed
				,navigation : false
				,pagination: false
				,paginationNumbers: true
				,mouseDrag: false
				,scrollPerPage: false
				,rewindNav: true
				,navigationText: ['']
				,responsiveBaseWidth: $_this
				,afterInit: function(){
					if( typeof wd_update_next_prev_slider_button == "function" )
						wd_update_next_prev_slider_button($_this);
				}
				,afterUpdate: function(){
					if( typeof wd_update_next_prev_slider_button == "function" )
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
</script>