<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Tatttoo
 * @since WD_Responsive
 */

get_header(); ?>
	<!--<div class="top-page">-->
		<?php //dimox_breadcrumbs();?>
	<!--</div>-->
	<?php wd_show_breadcrumbs(); ?>
	<div id="container" class="single-template single-portfolio layout-full">
		<div id="content" class="container">
			<h1 class="heading-title page-title blog-title"><?php _e("Portfolio","wpdance"); ?></h1>
			<div id="container-main" class="span18">
				<div class="main-content alpha omega">
					<div class="single-content">
						<?php	
							if(have_posts()) : while(have_posts()) : the_post(); global $post,$smof_data;
								$thumb = esc_html(get_post_thumbnail_id($post->ID));
								$post_title = esc_html(get_the_title($post->ID));
								$post_url =  esc_url(get_permalink($post->ID));
								$url_video = esc_url(get_post_meta($post->ID,THEME_SLUG.'video_portfolio',true));
								$proj_link = esc_url(get_post_meta($post->ID,THEME_SLUG.'proj_link',true));
								if(	strlen(trim($proj_link)) < 0 ){
									$proj_link = $post_url;
								}

								if( strlen( trim($url_video) ) > 0 ){
									$rand_id = rand().time();
									$slider_start_li = array(	'id' => $rand_id,
																'alt' => $post_title,
																'title' => $post_title
															);
									if(strstr($url_video,'youtube.com') || strstr($url_video,'youtu.be')){
										$thumb_url = array(get_thumbnail_video_src($url_video , 850 ,340));
										$item_class = "thumb-video youtube-fancy";
									}
									if(strstr($url_video,'vimeo.com')){
										$thumb_url = array(wp_parse_thumbnail_vimeo(wp_parse_vimeo_link($url_video), 850, 340));	
										$item_class = "thumb-video vimeo-fancy";
									}
									if( $thumb ){
										$thumb_url = wp_get_attachment_image_src($thumb,'full');
									}
									$light_box_url = $url_video;
								}else{
									$thumb_url = wp_get_attachment_image_src($thumb,'full');
									$item_class = "thumb-image";
									$light_box_url = esc_url($thumb_url[0]);
								}								
								
								$portfolio_slider = get_post_meta($post->ID,THEME_SLUG.'_portfolio_slider',true);
								$portfolio_slider = unserialize($portfolio_slider);
								$slider_thumb = false;
								if( is_array($portfolio_slider) && count($portfolio_slider) > 0 ){
									$slider_thumb = true;
								}
							?>	
								<div <?php post_class('single-post');?>>
									<?php echo stripslashes($smof_data['wd_top_blog_code']);?>
									
									<div class="post-title">
										<h1 class="heading-title"><?php the_title(); ?></h1>
										<div class="navi span24">
										<div class="alpha omega">
											<div class="navi-next"><?php next_post_link('%link', 'Next'); ?></div>
											<div class="navi-prev"><?php previous_post_link('%link', 'Previous'); ?> </div>
										</div>
										</div>
									</div>
									
									<div class="thumbnail">
										<?php 
											$video_url = get_post_meta( $post->ID, THEME_SLUG.'url_video', true);
											if( $video_url!= ''){
												echo get_embbed_video( $video_url, 280, 246 );
											}
											else{
												?>
												<div class="image">
													<a class="thumb-image" href="<?php the_permalink() ; ?>">
													<?php 
														if ( has_post_thumbnail() ) {
															the_post_thumbnail('prod_medium_thumb',array('class' => 'thumbnail-blog'));
															//the_post_thumbnail('blog_thumb',array('class' => 'thumbnail-effect-2'));
														} 			
													?>	
													</a>
																
												</div>
												<?php
											}
										?>	
									</div>									
									
									<div class="post-info-content">
									
										<div class="time">
											<span class="entry-date"><?php echo get_the_date('d M, Y') ?></span>
										</div>
										
										<div class="short-content"><?php the_content(); ?></div>
										
										<?php wp_link_pages(); ?>	
										
									</div>
									<?php echo stripslashes($smof_data['wd_bottom_blog_code']);?>
									
								</div>	
								<div class="clear"></div>
								
								<div class="post-info-meta">												
										
									<div class="author">
										<?php _e("Post by","wpdance"); ?>
										<?php the_author_posts_link(); ?> 
									</div>
												
									<span class="views-count">
										<?php //ppbv_display_product(true); ?>
									</span>
												
									<!--Category List-->
									<?php
										/* translators: used between list items, there is a space after the comma */
										$cat_post =  wp_get_post_terms(get_the_ID(),'wd-portfolio-category'); 
										$categories = '';
										if(is_array($cat_post)){
										foreach($cat_post as $cat){
											//$temp  = '<a href="'.get_term_link($cat->slug,$cat->taxonomy).'">'.$cat->name.'</a>'. ', ';
												$temp  = '<a href="'.get_category_link($cat->term_id).'">'.$cat->name.'</a>'. ', ';
												$categories .= $temp ;
											}      
										}
										$categories = substr($categories,0,-2) .''  ;
																	  
												
										?>
									<span class="cat-links">
										<?php printf( __( '%2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories );?>
									</span>
												
									<span class="comments-count">
										<?php $comments_count = wp_count_comments($post->ID); if($comments_count->approved < 10 && $comments_count->approved > 0) echo '0'; echo $comments_count->approved;?> 
										<?php _e("comment(s)","wpdance"); ?>
									</span>
												
											
								</div>								
								
								
								<?php
								/* translators: used between list items, there is a space after the comma */
								$tags_list = get_the_tag_list( '', __( '', 'wpdance' ) );
								if ( $tags_list ):
								?>
								<div class="tags_social">
									<div class="tags">
										<span class="tag-title"><?php _e('Tags','wpdance');?></span>
										<span class="tag-links">
											<?php printf( __( '<span class="%1$s"></span> %2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
													$show_sep = true; ?>
										</span>
									</div>
								</div>
								<?php endif; // End if $tags_list ?>	
									
									
									
									
									<div class="related-portfolio  related">
										<div class="wd_title_related"><h3 class="heading-title"><?php _e("Related Posts",'wpdance'); ?></h3></div>
										<div class="portfolio_project_slider">
											<div class="slides">
											<?php
												$gallery_ids = array();
												$galleries = wp_get_post_terms($post->ID,'gallery');
												if(!is_array($galleries))
													$galleries = array();
												foreach($galleries as $gallery){
													if( $gallery->count > 0 ){
														array_push( $gallery_ids,$gallery->term_id );
													}	
												}
												if(!empty($galleries) && count($gallery_ids) > 0 )
													$args = array(
														'post_type'=>$post->post_type,
															'tax_query' => array(
															array(
																'taxonomy' => 'gallery',
																'field' => 'id',
																'terms' => $gallery_ids
															)
														),
														'post__not_in'=>array($post->ID),
														'posts_per_page'=> get_option('posts_per_page'),//get_option(THEME_SLUG.'num_post_related', 10)
													);
												else
													$args = array(
													'post_type'=>$post->post_type,
													'post__not_in'=>array($post->ID),
													'posts_per_page'=> get_option('posts_per_page'),//get_option(THEME_SLUG.'num_post_related', 10)
												);
												wp_reset_query();
												$related=new wp_query($args);$cout=0;
												if($related->have_posts()) : while($related->have_posts()) : $related->the_post();global $post;$cout++;
													$thumb = (int)get_post_thumbnail_id($post->ID);
													$thumb_url = wp_get_attachment_image_src($thumb,'related_portfolio');
													if(!$thumb_url[0]){ //truong hop slider
														$portfolio_slider = get_post_meta($post->ID,THEME_SLUG.'_portfolio_slider',true);
														$portfolio_slider = unserialize($portfolio_slider);
														if($portfolio_slider)
															$thumb_url = wp_get_attachment_image_src( $portfolio_slider[0]['thumb_id'], 'related_portfolio', false );
													}
													
													?>
														<div class="related-item <?php if($cout==1) echo " first";if($cout==$related->post_count) echo " last";?>">
															<div>
																<a class="thumbnail" href="<?php the_permalink(); ?>">
																	<?php 
																		if ( has_post_thumbnail() ) {
																			the_post_thumbnail('blog_thumb',array('class' => 'thumbnail-blog'));
																		} 							
																	?>
																	<div class="thumbnail-shadow"></div>
																</a>
																<!--<a class="thumbnail" href="<?php the_permalink(); ?>">
																	<?php if($thumb_url[0]){ ?>
																		<img alt="<?php echo $post_title?>" title="<?php echo $post_title;?>" class="opacity_0" src="<?php echo  esc_url($thumb_url[0]);?>"/>
																	<?php } else { ?>	
																		<img alt="<?php the_title(); ?>" title="<?php the_title();?>" src="<?php echo get_template_directory_uri(); ?>/images/no-product-830x332.gif"/>
																	<?php } ?>
																	<div class="thumbnail-shadow"></div>
																</a>-->
																<a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
																<p class="date-time"><?php the_time(get_option('date_format')); ?></p>
															</div>
														</div>
													<?php
												endwhile;
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
									
								
								<?php echo stripslashes(get_option(THEME_SLUG.'code_to_bottom_post'));?>	
							<?php						
							endwhile;
							endif;	
							wp_reset_query();
						?>	
					</div>	
				</div>				
			</div><!-- #content -->
			<div id="right-sidebar" class="span6">
					<div class="right-sidebar-content alpha omega">
					<?php
						if ( is_active_sidebar( 'blog-widget-area-right' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'blog-widget-area-right' ); ?>
							</ul>
					<?php endif; ?>
					</div>
				</div><!-- end right sidebar -->
		</div>	
									<script type="text/javascript">
										jQuery(document).ready(function() {
										
											var $_this = jQuery('.related-portfolio .portfolio_project_slider');
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
		</div><!-- #container -->
<?php get_footer(); ?>