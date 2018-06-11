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
 * @subpackage Sneaker
 * @since WD_Responsive
 */

get_header(); ?>
		<?php wd_show_breadcrumbs(); ?>
		<div id="container">
			<div id="content" class="container single-blog">
				<h1 class="heading-title page-title blog-title"><?php _e("blog","wpdance"); ?></h1>	
				<div id="main" class="span18">
					<div class="main-content alpha omega">
						<div class="single-content">
							<?php	
								if(have_posts()) : while(have_posts()) : the_post(); 
								global $post,$smof_data;
								$sticky = (is_sticky())?" sticky":"";
								?>
									<div <?php post_class("single-post".$sticky);?>>
										<?php echo stripslashes($smof_data['wd_top_blog_code']);?>
													
										<?php edit_post_link( __( 'Edit', 'wpdance' ), '<span class="wd-edit-link hidden-phone">', '</span>' ); ?>	
										
										
										
										<div class="post-title">
											<h1 class="heading-title"><?php the_title(); ?></h1>
											<div class="single-navigation clearfix">
												<?php previous_post_link('%link', __('Previous', 'wpdance')); ?>
												<?php next_post_link('%link', __('Next', 'wpdance')); ?>
											</div>
										</div>
										<?php if ( (int) $smof_data['wd_blog_details_thumbnail'] == 1 ): ?>
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
																			the_post_thumbnail('blog_thumb',array('class' => 'thumbnail-blog'));
																			//the_post_thumbnail('blog_thumb',array('class' => 'thumbnail-effect-2'));
																		} 			
																	?>	
																	</a>
																	
																</div>
																<?php
															}
														?>	
											</div>
										<?php endif; ?>
										
										<div class="post-info-content">
										
											<?php if( absint($smof_data['wd_blog_details_time']) == 1 ) : ?>
													<div class="time">
														<span class="entry-date"><?php echo get_the_date('d M, Y') ?></span>
													</div>
											<?php endif; ?>	
											
											<div class="short-content"><?php the_content(); ?></div>
											
												<?php wp_link_pages(); ?>
																																		
										</div>
										
										
									
									<?php echo stripslashes($smof_data['wd_bottom_blog_code']);?>
									</div>
									<div class="clear"></div>
									<div class="post-info-meta">												
											
										<?php if( absint($smof_data['wd_blog_details_author']) == 1 ) : ?>
											<div class="author">	
												<?php _e('Post by','wpdance'); ?>  
												<?php the_author_posts_link(); ?> 
											</div>
										<?php endif; ?>												
												
										<?php if( absint($smof_data['wd_blog_details_comment']) == 1 ) : ?>
											<span class="comments-count">
												<?php $comments_count = wp_count_comments($post->ID); if($comments_count->approved < 10 && $comments_count->approved > 0) echo '0'; echo $comments_count->approved;?>
												<?php _e('comment(s)','wpdance'); ?>
											</span>
										<?php endif; ?>
										
										<!--Category List-->
										<?php if( $smof_data['wd_blog_details_categories'] == 1 ) : ?>
											<?php if ( is_object_in_taxonomy( get_post_type(), 'category' ) ) : // Hide category text when not supported ?>
											<?php
												/* translators: used between list items, there is a space after the comma */
												$categories_list = get_the_category_list( __( ', ', 'wpdance' ) );
													if ( $categories_list ):
													?>
													<span class="cat-links">
														<?php printf( __( '<span class="%1$s heading-title">'.__( ' Categories:', 'wpdance' ).'</span> %2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );?>
													</span>
													<?php endif; // End if categories ?>
											<?php endif; // End if is_object_in_taxonomy( get_post_type(), 'category' ) ?>	
													
										<?php endif;?>
										
									</div>
									
									<div class="tags_social">
										<?php if( absint($smof_data['wd_blog_details_tags']) == 1 ) : ?>
											<?php if ( is_object_in_taxonomy( get_post_type(), 'post_tag' ) ) : // Hide tag text when not supported ?>
											<?php
												/* translators: used between list items, there is a space after the comma */
												$tags_list = get_the_tag_list( '', __( ',', 'wpdance' ) );
												if ( $tags_list ):
												?>
													<div class="tags">
														<span class="tag-title"><?php _e('Tags:','wpdance');?></span>
														<span class="tag-links">
															<?php printf( __( '<span class="%1$s"></span> %2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
															$show_sep = true; ?>
														</span>
													</div>
												<?php endif; // End if $tags_list ?>
											<?php endif; // End if is_object_in_taxonomy( get_post_type(), 'post_tag' ) ?>
										<?php endif; ?>	
										<?php if( absint($smof_data['wd_blog_details_socialsharing']) == 1 ) : ?>
											<div class="share-list">
												<a class="facebook" title="<?php _e('Share This','wpdance');?>" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title()) ?>" target="_blank"></a>
												<a class="twitter" title="<?php _e('Twitter This','wpdance');?>" href="http://twitter.com/home?status=Share<?php the_permalink(); ?>" target="_blank"></a>
												<a class="pin" title="<?php _e('Pin This','wpdance');?>" target="_blank" data-pin-config="above" href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>" data-pin-do="buttonPin" ></a>	
												<a class="plus" title="<?php _e('Plus This','wpdance');?>" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title()) ?>"></a>
											</div>
										<?php endif;?>
									</div>
									<?php if( absint($smof_data['wd_blog_details_authorbox']) == 1 ) : ?>
										<div id="entry-author-info">
											<div class="author-inner">
												
												<div id="author-description">
													<div id="author-avatar" class="image-style">
														<div class="thumbnail">
															<?php echo get_avatar( get_the_author_meta( 'user_email' ), 96,get_bloginfo('template_url') . '/images/mycustomgravatar.png' ); ?>
														</div>
													</div><!-- #author-avatar -->		
													<div class="author-desc">		
														<span class="author-name"><?php the_author_posts_link();?></span>
														<?php the_author_meta( 'description' ); ?>
														<span class="view-all-author-posts">
															<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
																<?php _e("View all posts by",'wpdance');echo " ";the_author_meta( 'display_name' ); ?>
															</a>
														</span>
													</div>
												</div><!-- #author-description -->
											</div><!-- #author-inner -->
										</div><!-- #entry-author-info -->
									<?php endif; ?>	
									
									<?php if( absint($smof_data['wd_blog_details_related']) == 1 ) : ?>
										<?php 
											get_template_part( 'templates/related_posts' );
										?>
									<?php endif;?>
									
									<?php comments_template( '', true );?>
									
								<?php						
								endwhile;
								endif;	
								wp_reset_query();
							?>	
						</div>
					</div>
				</div>
							
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
				
			</div><!-- #content -->
			
		</div><!-- #container -->
<?php get_footer(); ?>