<?php
/**
 * The template for displaying Content.
 *
 * @package WordPress
 * @subpackage Sneaker
 * @since WD_Responsive
 */
?>
<?php
	global $smof_data;
?>
<ul class="list-posts">
	<?php	
	$count=0;
	if(have_posts()) : while(have_posts()) : the_post(); global $post;$count++;global $wp_query;$_sub_class="";
			if($count == 1) 
				$_sub_class =  " first";
			if($count == $wp_query->post_count) 
				$_sub_class = " last" 
		?>
		<li <?php post_class("home-features-item".$_sub_class);?>>
			
			<div class="post-title">
			
					<a class="post-title heading-title" href="<?php the_permalink() ; ?>"><h2 class="heading-title"><?php the_title(); ?></h2></a>
					<?php edit_post_link( __( 'Edit', 'wpdance' ), '<span class="wd-edit-link hidden-phone">', '</span>' ); ?>
					<div class="clear"></div>
						
			</div>
				
			<div class="post-info-thumbnail">
				<?php if( $smof_data['wd_blog_thumbnail'] == 1 ) : ?>
					<div class="thumbnail "><!--<?php //if( $archive_page_config['show_thumb_phone'] != 1 ) echo " hidden-phone";?>-->
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
										} else { ?>
											<img alt="<?php the_title(); ?>" title="<?php the_title();?>" src="<?php echo get_template_directory_uri(); ?>/images/no-image-blog.gif"/>
									<?php	}										
									?>	
									<div class="thumbnail-shadow"></div>									
									</a>
									
								</div>
								<?php
							}
						?>	
					</div>
					
				<?php endif;?>
				
			</div><!-- end post info -->	
			
			<div class="post-info-content">
			
				<!-- time -->
				<?php if( $smof_data['wd_blog_time'] == 1 ) : ?>
						<div class="time"> <?php //if( $archive_page_config['show_time_phone'] != 1 ) echo " hidden-phone";?>
							<span class="entry-date"><?php echo get_the_date('M d, Y') ?></span><br/>
						</div>
				<?php endif;?>
				<!-- end time -->
			
				<?php if( $smof_data['wd_blog_excerpt'] == 1 ) : ?>
					<p class="short-content"><?php /*the_content();*/the_excerpt_max_words(70,$post); ?></p> <?php //if( $smof_data['wd_blog_excerpt'] != 1 ) echo " hidden-phone";?>
				<?php endif; ?>	
				
				<?php wp_link_pages(); ?>

				<div class="post-info-meta">
					<?php if( $smof_data['wd_blog_author'] == 1 ) : ?>
						<div class="author">	<?php // if( $archive_page_config['show_author_post_link_phone'] != 1 ) echo " hidden-phone";?>
							<?php _e("Posted by","wpdance"); ?>
							<?php the_author_posts_link(); ?> 
						</div>
					<?php endif;?>
					
					<?php if( $smof_data['wd_blog_comment_number'] == 1 ) : ?>
						<span class="comments-count"> <?php //if( $archive_page_config['show_comment_count_phone'] != 1 ) echo " hidden-phone";?>
							<span class="number"><?php $comments_count = wp_count_comments($post->ID); if($comments_count->approved < 10 && $comments_count->approved > 0) echo '0'; echo $comments_count->approved; ?></span><?php _e(' comment(s)','wpdance'); ?>
						</span>
					<?php endif;?>	
					
					<?php if ( is_object_in_taxonomy( get_post_type(), 'category' ) && $smof_data['wd_blog_categories'] == 1 ) : // Hide category text when not supported ?>
					
					<!-- categories -->
					<?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( __( ', ', 'wpdance' ) );
							if ( $categories_list ):
						?>
						<span class="cat-links"><?php //if( $archive_page_config['show_category_phone'] != 1 ) echo " hidden-phone";?> <?php _e("Categories:","wpdance"); ?>
							<?php printf( __( '<span class="%1$s"></span> %2$s', 'wpdance' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );?>
						</span>
						<?php endif; // End if categories ?>
					<?php endif; // End if is_object_in_taxonomy( get_post_type(), 'category' ) ?>
					<!-- end categories -->
					
					<!-- read more --->
					<?php if( $smof_data['wd_blog_readmore'] == 1 ) : ?>
					<a title="Readmore" class="read-more"  href="<?php the_permalink() ; ?>"><span><span><?php _e('Read more','wpdance'); ?></span></span></a>	
					<?php //if( $smof_data['wd_blog_readmore'] != 1 ) echo " hidden-phone";?>
					<?php endif;?>	
					<!-- end read more -->
					
				</div>							
				
			</div><!-- end post ... -->
		</li>
	<?php						
	endwhile;
	else : echo "<div class=\"alpha omega\"><div class=\"alert alert-error alpha omega\">Sorry. There are no posts to display</div></div>";
	endif;	
	?>	
</ul>