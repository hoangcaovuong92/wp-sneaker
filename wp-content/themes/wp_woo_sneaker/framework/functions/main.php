<?php 

	/* MENU PHONE */
	
	add_action( 'wd_before_header', 'wd_mobile_header_open_div', 1 );
	
	add_action( 'wd_before_header', 'wd_print_toggle_menu', 2 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_menu_control', 3 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_bar_wrapper', 4 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_menu_search', 5 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_logo', 6 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_menu_cart', 7 );	
	
	add_action( 'wd_before_header', 'wd_mobile_header_menu_user', 8 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_close_div', 9 );
	
	add_action( 'wd_before_header', 'wd_mobile_header_close_div', 10 );
	
	
	function wd_print_toggle_menu(){
	?>		
	
	<div class="toggle-menu-wrapper visible-phone">
		<div class="toggle-menu-control-close"><span></span></div>
		<?php
		if ( has_nav_menu( 'mobile' ) ){
			wp_nav_menu( array( 'container_class' => 'mobile-main-menu toggle-menu','theme_location' => 'mobile' ) ); 
		}
		else{
			wp_nav_menu( array( 'container_class' => 'mobile-main-menu toggle-menu','theme_location' => 'primary' ) ); 
		}
		?>
	</div>
	
	<?php
	}	
	
	if(!function_exists ('wd_mobile_header_bar_wrapper')){
		function wd_mobile_header_bar_wrapper(){
			global $wd_mega_menu_config_arr;
	?>	
		<div class="phone-header-bar-wrapper visible-phone">
		<div class="toggle-menu-control-open"><?php if( isset($wd_mega_menu_config_arr) && isset($wd_mega_menu_config_arr['menu_text']) && strlen( trim($wd_mega_menu_config_arr['menu_text']) ) > 0 ){ echo $wd_mega_menu_config_arr['menu_text']; } ?></div>
	<?php
		}
	}	
	
	if(!function_exists ('wd_mobile_header_open_div')){
		function wd_mobile_header_open_div(){
	?>	
		<div class="phone-header visible-phone">
	<?php
		}
	}	

	if(!function_exists ('wd_mobile_header_menu_control')){
		function wd_mobile_header_menu_control(){
			global $wd_mega_menu_config_arr;
	?>			
		
	<?php		
		}
	}	

	if(!function_exists ('wd_mobile_header_menu_user')){
		function wd_mobile_header_menu_user(){
			$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
			$myaccount_page_url = "#";
			if ( $myaccount_page_id ) {
				$myaccount_page_url = esc_url( get_permalink( $myaccount_page_id ) );
			}	
			//echo "<a id='mobile-user-menu' href='{$myaccount_page_url}' title='" . __("Login/Register","wpdance") . "'></a>";
	?>
			<div class="wd_mobile_account">
				<?php if(!is_user_logged_in()):?>
					
					<a class="sign-in-form-control" href="<?php echo $myaccount_page_url;?>" title="<?php _e('Log in/Sign up','wpdance');?>">
						<span><?php _e('Log in / Sign up','wpdance');?></span>
					</a>
					<span class="visible-phone login-drop-icon"></span>			
				<?php else:?>		
					<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','wpdance'); ?>">
						<?php _e('My Account','wpdance'); ?>
					</a>	
				<?php endif;?>
			</div>
	<?php
		}
	}	

	if(!function_exists ('wd_mobile_header_menu_cart')){
		function wd_mobile_header_menu_cart(){
	?>	
		<div class="mobile_cart_container visible-phone">
			<div class="mobile_cart">
			<?php
				if( in_array( "woocommerce/woocommerce.php", apply_filters( 'active_plugins', get_option( 'active_plugins' )  ) ) ){
				$_cart_size_id = "cart_size_value_head-".rand(); 
				?>
				<span class="cart_size">
					<a href="<?php echo esc_url( wc_get_cart_url() );?>" title="<?php _e('View your shopping bag','wpdance');?>">
						<span class="ic-bag"></span>
					<span class="cart_size_value_head" id="<?php echo $_cart_size_id; ?>">
						<?php _e('Cart','wpdance');?>
						<span class="cart_item">
						(<span class="num_item"><?php echo WC()->cart->cart_contents_count;?></span>
						<?php
						if(WC()->cart->cart_contents_count >= 2 ){
							_e(' items','wpdance');
						}
						else{
							_e(' item','wpdance');
						}
						?>)
						</span>
					</span>
					</a>
				</span>
				<?php } ?>
			</div>
		</div>	
	<?php					
		}
	}		

	if(!function_exists ('wd_mobile_header_menu_search')){
		function wd_mobile_header_menu_search(){
			if( in_array( "woocommerce/woocommerce.php", apply_filters( 'active_plugins', get_option( 'active_plugins' )  ) ) ){
				get_product_search_form();
			}else{
				get_search_form();
			}
			
		}
	}

	if(!function_exists ('wd_mobile_header_logo')){
		function wd_mobile_header_logo(){
			theme_logo();
		}
	}
	
	if(!function_exists ('wd_mobile_header_close_div')){
		function wd_mobile_header_close_div(){
	?>	
	<div style="clear:both"></div>
	</div>
	<?php
		}
	}		
	/* END MENU PHONE */
	
	add_action( 'wd_header_init', 'wd_print_header_head', 10 );
	if(!function_exists ('wd_print_header_head')){
		function wd_print_header_head(){
	?>	
			<div class="yith-woocompare-open hidden"><a href="javascript: void(0)"></a></div>
			<div class="header-top hidden-phone">
				<div class="header-top-container">
					<!-- LOGO -->
					<div class="header-logo">						 
							<?php theme_logo();?>
					</div>
					<div class="header-top-content left-header-top-content">
							<?php echo wd_tini_account();//TODO : account form goes here?>
					</div>
					
					<div class="header-top-content right-header-top-content">
						<div class="shopping-cart shopping-cart-wrapper">
							<?php echo wd_tini_cart();?>
						</div>
						
						<div class="phone_quick_menu_1 visible-phone">
							<div class="mobile_my_account">
								<?php if ( is_user_logged_in() ) { ?>
									<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('My Account','wpdance'); ?>"><?php _e('My Account','wpdance'); ?></a>
								<?php }
								else { ?>
									<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>" title="<?php _e('Login / Register','wpdance'); ?>"><?php _e('Login / Register','wpdance'); ?></a>
								<?php } ?>
							</div>
						</div>
						<div class="mobile_cart_container visible-phone">
							<div class="mobile_cart">
							<?php
								global $woocommerce;
								if( isset($woocommerce) && isset($woocommerce->cart) ){
									$cart_url = esc_url( wc_get_cart_url() );
									$cart_label = __("View Cart","wpdance");
									echo "<a href='{$cart_url}' title='View Cart'>{$cart_label}</a>";
								}

							?>
							</div>
							<div class="mobile_cart_number">0</div>
						</div>
						
						<div class="header_search"><?php get_search_form(); ?></div>
						
					</div>
					<div style="clear:both"></div>
				</div>
				<div style="clear:both"></div>
			</div><!-- end header top -->
			<div style="clear:both"></div>
			
		<?php	
		}	
	}
	
	add_action( 'wd_header_init', 'wd_print_header_body', 20 );
	if(!function_exists ('wd_print_header_body')){
		function wd_print_header_body(){
		global $smof_data, $page_datas;
	?>	
			<div class="header-middle hidden-phone">
				<div class="header-middle-content">
					
					<div class="nav">
						<?php 
							if ( has_nav_menu( 'primary' ) ) {
								wp_nav_menu( array( 'container_class' => 'main-menu pc-menu wd-mega-menu-wrapper','theme_location' => 'primary','walker' => new WD_Walker_Nav_Menu() ) );
							}else{
								wp_nav_menu( array( 'container_class' => 'main-menu pc-menu wd-mega-menu-wrapper','theme_location' => 'primary' ) );
							}
						?>
					</div>
					<div class="shopping-cart shopping-cart-wrapper"><?php echo wd_tini_cart();?></div>
				</div>
			</div><!-- end .header-middle -->	
			<?php wp_reset_query();?>			
			<script type="text/javascript">
                var _enable_sticky_menu = <?php echo (int) $smof_data['wd_sticky_menu']; ?>;
				var _sticky_menu_class = '<?php echo ( isset($page_datas) && ($page_datas['page_layout']=='box' || ($page_datas['page_layout']=="wide" && $page_datas['header_layout']=="box")))?"wd_box":""; ?>';
		    </script>
	<?php	
		}	
	}

	add_action( 'wd_header_init', 'wd_print_header_footer', 30 );
	if(!function_exists ('wd_print_header_footer')){
		function wd_print_header_footer(){
	?>	
			
		<?php 
			global $page_datas;
				wp_reset_query();
				if(isset($page_datas) && $page_datas['hide_new_product'] == 0) : ?>
			<div class="header-bottom">
				<div class="header-bottom-content container">
					<div class="new_product container">
						<?php $new_product=new wp_query(array('post_type'=>'product','ignore_sticky_posts'=> 1,'posts_per_page' => 1 , 'orderby' => 'DESC', 'meta_value' => 1));?>
						<?php if($new_product->have_posts()){?>
						<div class="new_product_content">
							<?php while($new_product->have_posts ()){$new_product->the_post();global $post;?>	
										<div class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
										<div class="readmore"><a href="<?php the_permalink(); ?>"><?php _e('View Detail','wpdance'); ?></a></div>
							<?php }?>
						</div>
						<?php }?>
						<?php wp_reset_query(); ?>
					</div>
				</div>
			</div><!-- end .header-bottom -->
			<script type="text/javascript">
				var header_bottom_height = jQuery(".header-bottom").outerHeight();
				jQuery(".header-bottom").css("bottom","-"+header_bottom_height+"px");
				//jQuery(".main-slideshow").attr('style','min-height:' + header_bottom_height + ';other-styles');
				//jQuery(".main-slideshow").css("min-height",header_bottom_height + "px");
			</script>
		<?php endif; ?>	
		<div style="clear:both"></div>
	<?php		
		}	
	}	
	
	
	add_action( 'wd_bofore_main_container', 'wd_print_inline_script', 10 );
	if(!function_exists ('wd_print_inline_script')){
		function wd_print_inline_script(){
	?>	
		<script type="text/javascript">
			<?php if( defined('ICL_LANGUAGE_CODE') ): ?>
				_ajax_uri = '<?php echo admin_url('admin-ajax.php?lang='.ICL_LANGUAGE_CODE, 'relative');?>';
			<?php else: ?>
				_ajax_uri = '<?php echo admin_url('admin-ajax.php', 'relative');?>';
			<?php endif; ?>
			_on_phone = <?php echo WD_IS_MOBILE === true ? 1 : 0 ;?>;
			_on_tablet = <?php echo WD_IS_TABLET === true ? 1 : 0 ;?>;
			//if(navigator.userAgent.indexOf(\"Mac OS X\") != -1)
			//	console.log(navigator.userAgent);
			<?php 
				global $smof_data;
				if(isset($smof_data['wd_nicescroll']) && $smof_data['wd_nicescroll'] == 1) :
			?>
			var obj_nice_scroll = jQuery("html").niceScroll({cursorcolor:"#000"});
			jQuery("#"+obj_nice_scroll.id).find("div:first").css({"width":"6px"});
			<?php endif; ?>
			jQuery('.menu li').each(function(){
				if(jQuery(this).children('.sub-menu').length > 0) jQuery(this).addClass('parent');
			});
		</script>
	<?php
		}
	}
	add_action( 'wd_bofore_main_container', 'wd_banner_top_main_content', 15 );
	if(!function_exists ('wd_banner_top_main_content')) {
		function wd_banner_top_main_content(){
			global $page_datas, $smof_data;
			if(isset($smof_data['wd_enable_banner_top_main_content']) && (int) $smof_data['wd_enable_banner_top_main_content']==0)
				return;
			if( isset($page_datas['hide_banner']) && $page_datas['hide_banner'] == 1 )
				return;
			if(isset($smof_data['wd_banner_top_main_content']) && $smof_data['wd_banner_top_main_content']!=""){
			?>
				<div class="wd_banner_top_main_content <?php wd_page_layout_class('header_layout'); ?>">
					<div class="wd_banner_top_main_content_wrapper">
						<?php echo do_shortcode(stripslashes($smof_data['wd_banner_top_main_content'])); ?>
					</div>
				</div>
			<?php 
			}
		}
	}
	
	//add_action( 'wd_bofore_main_container', 'wd_print_ads_block', 20 );
	if(!function_exists ('wd_print_ads_block')){
		function wd_print_ads_block(){
			global $page_datas;
	?>	
			<div class="header_ads_wrapper">
				<?php 
					if( !is_home() && !is_front_page() ){
						if( !is_page() ){
							printHeaderAds();
						}else{
							if( isset($page_datas['hide_ads']) && absint($page_datas['hide_ads']) == 0 )
								printHeaderAds();
						}
						
					}
						
				?>
			</div>
	<?php
		}
	}	
	
	
	add_action( 'wd_before_body_end', 'wd_before_body_end_widget_area', 10 );
	if(!function_exists ('wd_before_body_end_widget_area')){
		function wd_before_body_end_widget_area(){
			global $smof_data;
			if( isset($smof_data['wd_show_body_end_widget_area']) && (int) $smof_data['wd_show_body_end_widget_area'] == 0){
				return;
			}
	?>
		<div id="wd_body_end" class="body-end <?php wd_page_layout_class('footer_layout'); ?>">
				<div class="body-end-widget-area container">
					<?php
						if ( is_active_sidebar( 'body-end-widget-area' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'body-end-widget-area' ); ?>
							</ul>
						<?php endif; ?>						
				</div><!-- end #footer-first-area -->
		</div>	
	
		<?php wp_reset_query();?>
	
	<?php
		}
	}	

	add_action( 'wd_footer_init', 'wd_footer_init_widget_area_1', 10 );
	if(!function_exists ('wd_footer_init_widget_area_1')){
		function wd_footer_init_widget_area_1(){
			global $smof_data;
			if( isset($smof_data['wd_show_first_footer_widget_area']) && (int) $smof_data['wd_show_first_footer_widget_area'] == 0){
				return;
			}
	?>	
	
		<?php //if( !wp_is_mobile() ): ?>
			<div class="first-footer-widget-area">
				<div class="container">
					<div class="first-footer-widget-area-1 span17">
						<div class="container">
							<?php if ( is_active_sidebar( 'first-footer-widget-area-1' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'first-footer-widget-area-1' ); ?>
								</ul>
							<?php endif; ?>
						</div>
					</div>
					
					<div class="first-footer-widget-area-2 span7">
						<div class="container">
							<?php if ( is_active_sidebar( 'first-footer-widget-area-2' ) ) : ?>
								<ul class="xoxo">
									<?php dynamic_sidebar( 'first-footer-widget-area-2' ); ?>
								</ul>
							<?php endif; ?>
						</div>
					</div><!-- end #footer-first-area -->				
					
				</div>
			</div>
			<?php wp_reset_query();?>
		<?php //endif; ?>	
		
	<?php
		}
	}
	

	add_action( 'wd_footer_init', 'wd_footer_init_widget_area_3', 30 );
	if(!function_exists ('wd_footer_init_widget_area_3')){
		function wd_footer_init_widget_area_3(){
			global $smof_data;
			if( isset($smof_data['wd_show_third_footer_widget_area']) && (int) $smof_data['wd_show_third_footer_widget_area'] == 0){
				return;
			}
	?>	
	
			<div class="subscriptions-footer-widget-area">
				<div class="container">
					<?php
						if ( is_active_sidebar( 'subscriptions-footer-widget-area' ) ) : ?>
							<ul class="xoxo">
								<?php dynamic_sidebar( 'subscriptions-footer-widget-area' ); ?>
							</ul>
					<?php endif; ?>								
				</div>
			</div>
			<?php wp_reset_query();?>	
		
	<?php
		}
	}

	add_action( 'wd_footer_init', 'wd_footer_init_widget_area_4', 40 );
	if(!function_exists ('wd_footer_init_widget_area_4')){
		function wd_footer_init_widget_area_4(){
			global $smof_data;
			if( isset($smof_data['wd_show_footer_menu']) && isset($smof_data['wd_show_end_footer_area']) && (int) $smof_data['wd_show_footer_menu'] == 0 && (int) $smof_data['wd_show_end_footer_area'] == 0){
				return;
			}
	?>	
			<div class="wd_footer_end">
				<div class="container">
					<?php if ( has_nav_menu( 'footer' ) ): 
							if( isset($smof_data['wd_show_footer_menu']) && (int) $smof_data['wd_show_footer_menu'] == 1):
						?>
							<div class="footer-nav span24">
								<?php 
									wp_nav_menu( array( 'container_class' => 'footer-menu','theme_location' => 'footer' ) );
								?>
							</div>
					<?php endif;
						endif; ?>
					<?php if( isset($smof_data['wd_show_end_footer_area']) && (int) $smof_data['wd_show_end_footer_area'] == 1): ?>
					<div id="copy-right" class="copy-right span24">
						<div class="copyright">
							<?php global $smof_data;?>
							<?php echo stripslashes($smof_data['footer_text']); ?>
						</div>
					</div>
					<div class="payment span24">
							<?php if( strlen(trim($smof_data['wd_paypal_image'])) > 0 ){ ?>
							<a href="#"><img alt="paypal" title ="paypal" src="<?php echo $smof_data['wd_paypal_image']; ?>" /></a>
							<?php } ?>
							<?php if( strlen(trim($smof_data['wd_visa_image'])) > 0 ){ ?>
							<a href="#"><img alt="visa" title ="visa" src="<?php echo $smof_data['wd_visa_image']; ?>" /></a>
							<?php } ?>
							<?php if( strlen(trim($smof_data['wd_master_card_image'])) > 0 ){ ?>
							<a href="#"><img alt="master card" title="master card" src="<?php echo $smof_data['wd_master_card_image']; ?>" /></a>
							<?php } ?>
							<?php if( strlen(trim($smof_data['wd_verified_visa_image'])) > 0 ){ ?>
							<a href="#"><img alt="verified by visa" title="verified by visa" src="<?php echo $smof_data['wd_verified_visa_image']; ?>" /></a>
							<?php } ?>
							<?php if( strlen(trim($smof_data['wd_trusted_visa_image'])) > 0 ){ ?>
							<a href="#"><img alt="trusted by visa" title="trusted by visa" src="<?php echo $smof_data['wd_trusted_visa_image']; ?>" /></a>
							<?php } ?>
						</div>
					<?php endif; ?>
				</div>
			</div>	
				<?php wp_reset_query();?>
	
	<?php
		}
	}

	add_action( 'wd_before_footer_end', 'wd_before_body_end_content', 10 );
	if(!function_exists ('wd_before_body_end_content')){
		function wd_before_body_end_content(){
		global $smof_data;
	?>	
		<?php $_content = stripslashes($smof_data['wd_feedback_dialog_content']); ?>
		
		
		
		<?php if( strlen($_content) > 0 ):?>
			<?php if( isset( $smof_data['wd_show_feedback_button'] ) && (int)$smof_data['wd_show_feedback_button']==1): ?>
			<?php $df_feedback_button_images_uri = get_stylesheet_directory_uri(). '/images/feedback.png'; 
				$style_inline_feedback_button = "style='background-image: url(".$df_feedback_button_images_uri."); background-repeat: no-repeat;'";
				if(isset($smof_data['wd_feedback_button_image']) && strlen($smof_data['wd_feedback_button_image']) > 0)
					$style_inline_feedback_button = "style='background-image: url(".$smof_data['wd_feedback_button_image']."); background-repeat: no-repeat;'";
			?>
				<div id="feedback" class="hidden-phone">
					<a <?php echo $style_inline_feedback_button; ?> class="feedback-button wd-prettyPhoto" href="#<?php if (strlen($_content) > 0) {  ?>wd_contact_content<?php } ?>" ></a>
				</div>
			<?php endif; ?>
			<div class="contact_form hidden-phone hidden" >
				<div class="contact_form_inner" style="overflow:hidden;" id="wd_contact_content"><?php echo do_shortcode($_content);?></div>
			</div>
		<?php endif;?>
		
		<?php if(!wp_is_mobile()): ?>
		<div id="to-top" class="scroll-button">
			<a class="scroll-button" href="javascript:void(0)" title="<?php _e('Back to Top','wpdance');?>"></a>
		</div>
		<?php endif; 
		}
	}
	
	
	
?>