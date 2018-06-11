<?php
add_image_size('testimonial',115,115);
	if(!function_exists('testimonial')){
		function testimonial($atts,$content){
			extract(shortcode_atts(array(
				'style'				=> 'style1'
				,'slug'				=>		''
				,'id'				=>		0
			),$atts));
			
			$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
			if ( !in_array( "testimonials-by-woothemes/woothemes-testimonials.php", $_actived ) ) {
				return;
			}
			
			global $post;
			$count = 0;
			if( absint($id) > 0 ){
				$_feature = woothemes_get_testimonials( array('id' => $id,'limit' => 1, 'size' => 50 ));
			}elseif( strlen(trim($slug)) > 0 ){
				$_feature = get_page_by_path($slug, OBJECT, 'testimonial');
				if( !is_null($_feature) ){
					$_feature = woothemes_get_testimonials( array('id' => $_feature->ID,'limit' => 1, 'size' => 50 ));
				}else{
					return;
				}
			}else{
				return;
				//invalid input params.
			}
			
			if( !is_array($_feature) || count($_feature) <= 0 ){
				return;
			}else{
				global $post;
				$_feature = $_feature[0];
				$post = $_feature;
				setup_postdata( $post ); 
				
			}
			//print_r($_feature);exit;
			ob_start();
					?>
						<div class="testimonial-item testimonial">
							<div class="avartar">
								<a href="<?php echo $_feature->url; ?>"><?php the_post_thumbnail('woo_shortcode');?></a>
							</div>							
							<div class="detail">
								<div class="testimonial-content"><?php echo do_shortcode(get_the_content());?></div>
								<a class="title" href="<?php echo $_feature->url; ?>"><?php the_title();?></a> <span class="line">-</span> 
								<span class="job"> <?php echo get_post_meta($post->ID,'_byline',true);?></span>
							</div>						
						</div>			
			<?php
			$output = ob_get_contents();
			ob_end_clean();
			rewind_posts();
			wp_reset_query();
			return $output;
		}
	}
	add_shortcode('testimonial','testimonial');
?>