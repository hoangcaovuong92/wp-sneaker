<?php
		global $smof_data;
		if( !isset($data) ){
			if( defined( 'DOING_AJAX' ) && isset($custom_datas) ){
				$data = $custom_datas;
			}
			else{
				$data = $smof_data;
			}
		}
		
		$quickshop_ready = false;
		$_actived = apply_filters( 'active_plugins', get_option( 'active_plugins' )  );
		if( in_array( "wd_quickshop/wd_quickshop.php", $_actived ) ){	
			$quickshop_ready = true;
		}
		
		$data = wd_array_atts(	array(
				'wd_logo' 							=> get_stylesheet_directory_uri(). '/images/logo.png'
				,'wd_icon' 							=> get_stylesheet_directory_uri(). '/images/favicon.ico'
				,'wd_text_logo' 					=> "Sneaker"
				,'wd_enable_banner_top_main_content' 	=> 1
				,'wd_banner_top_main_content' 			=> '<div style="text-align:center"><span style="color:#c30005">"IT \'S TIME CRAZY SHOPPING TIME"</span> with over <span>1000 GIFTS</span> and <span>FREE SHIPPING</span></div>'
				,'wd_paypal_image'					=> get_stylesheet_directory_uri(). '/images/media/icon_payment_paypal.png'
				,'wd_visa_image'					=> get_stylesheet_directory_uri(). '/images/media/icon_payment_visa.png'
				,'wd_master_card_image'				=> get_stylesheet_directory_uri(). '/images/media/icon_payment_master_card.png'
				,'wd_verified_visa_image'			=> get_stylesheet_directory_uri(). '/images/media/icon_verified_visa.png'
				,'wd_trusted_visa_image'			=> get_stylesheet_directory_uri(). '/images/media/icon_trusted_visa.png'
				,'wd_size1_width' 					=> 1200
				,'wd_size1_height' 					=> 450
				,'wd_size2_width' 					=> 960
				,'wd_size2_height' 					=> 300
				,'wd_size3_width' 					=> 480	
				,'wd_size3_height' 					=> 320
				,'wd_show_feedback_button' 			=> 1
				,'wd_feedback_button_image'			=> get_stylesheet_directory_uri(). '/images/feedback.png'
				,'wd_feedback_dialog_content' 		=> '[contact-form-7 id="4" title="Contact form 1"]'
				,'footer_text' 						=> '&copy; 2014 Sneaker Demo Store. Designed by <a href="http://wpdance.com/" title="WordPress Themes">WPDance.com</a>. WPDance is a member of <a href="http://www.emthemes.com/" title="Magento Themes">EMThemes</a>'	
				,'wd_show_first_footer_widget_area' => 1
				,'wd_show_body_end_widget_area'		=> 1
				,'wd_show_footer_menu' 				=> 1
				,'wd_show_end_footer_area' 			=> 1
				,'wd_preview_panel' 				=> 0
				,'wd_nicescroll' 					=> 0
				,'wd_sticky_menu' 					=> 1
				,'wd_effect_product'				=> 1
				,'wd_layout_styles' 				=> "wide"	
				,'wd_main_content_background'		=> "#ffffff"
				,'wd_body_end_background'			=> "#ffffff"
				,'wd_theme_color_primary' 			=> "#000000"
				,'wd_theme_color_secondary' 		=> "#c30005"
				,'wd_text_color' 					=> "#969696"
				,'wd_link_color' 					=> "#000000"
				,'wd_link_color_hover' 				=> "#c30005"
				,'wd_button_background' 			=> "#c30005"
				,'wd_button_background_hover' 		=> "#000000"
				,'wd_button_text' 					=> "#ffffff"
				,'wd_button_text_hover' 			=> "#ffffff"
				,'wd_heading_color' 				=> "#141414"
				,'wd_header_top_background' 		=> "#000000"
				,'wd_header_top_text_color' 		=> "#c8c8c8"	
				,'wd_header_top_text_hover' 		=> "#ffffff"
				,'wd_menu_background' 				=> "#dcdcdc"
				,'wd_menu_text_color' 				=> "#000000"
				,'wd_menu_text_color_hover' 		=> "#c30005"
				,'wd_sub_menu_background' 			=> "#ffffff"
				,'wd_sub_menu_border' 				=> "#cccccc"
				,'wd_sub_menu_text_color' 			=> "#969696"
				,'wd_sub_menu_text_color_hover' 	=> "#c30005"
				,'wd_phone_background' 				=> "#000000"
				,'wd_phone_text_color' 				=> "#ffffff"
				,'wd_phone_sub_text_color' 			=> "#aaaaaa"
				,'wd_testimonial_background' 		=> "#dcdcdc"
				,'wd_product_name_color' 			=> "#000000"
				,'wd_special_color' 				=> "#00387f"
				,'wd_border_color' 					=> "#dcdcdc"
				,'wd_border_color_hover' 			=> "#aaaaaa"
				,'wd_link_title_portfolio' 			=> "#969696"
				,'wd_link_title_portfolio_hover' 	=> "#000000"
				,'wd_background_button_portfolio' 	=> "#000000"
				,'wd_background_button_portfolio_hover' 	=> "#c30005"
				,'wd_border_portfolio_hover' 	=> "#000000"
				,'wd_button_cart_background' 		=> "#c8c8c8"
				,'wd_button_cart_background_hover' 	=> "#c30005"
				,'wd_button_cart_text' 				=> "#ffffff"
				,'wd_button_cart_text_hover' 		=> "#ffffff"
				,'wd_text_price_color' 				=> "#646464"
				,'wd_rating_color' 					=> "#c30005"
				,'wd_text_price_sale_color' 		=> "#c30005"
				,'wd_footer_background' 			=> "#eeeeee"
				,'wd_footer_subscriptions_background' 		=> "#eeeeee"
				,'wd_footer_end_background' 		=> "#000000"
				,'wd_footer_end_menu_text' 			=> "#ffffff"
				,'wd_footer_end_menu_text_hover' 	=> "#969696"
				,'wd_footer_end_text' 				=> "#646464"
				,'wd_feature_sale'					=> "#003782"
				,'wd_feature_sale_text_color'		=> "#ffffff"
				,'wd_feature_new'					=> "#f5d200"
				,'wd_feature_new_text_color'		=> "#ffffff"
				,'wd_feature_hot'					=> "#c8000a"
				,'wd_feature_hot_text_color'		=> "#ffffff"
				,'wd_button_slider_background'		=> '#1e1e1e'
				,'wd_button_slider_icon'			=> '#ffffff'
				,'wd_social_border'					=> '#969696'
				,'wd_social_text'					=> '#969696'
				,'wd_sidebar_title_background'		=> '#000000'
				,'wd_sidebar_title_color'			=> '#ffffff'
				,'wd_body_font_googlefont_enable' 	=> 1
				,'wd_body_font_family' 				=> "Arial"
				,'wd_body_font_googlefont' 			=> "Roboto"
				,'wd_body_second_font_googlefont_enable' 	=> 1
				,'wd_body_second_font_family' 				=> "Open Sans"
				,'wd_body_second_font_googlefont' 			=> "Roboto"
				,'wd_heading_font_googlefont_enable' 		=> 1
				,'wd_heading_fontfamily' 			=> "Open Sans"
				,'wd_heading_font_googlefont' 		=> "Share"
				,'wd_menu_font_googlefont_enable' 	=> 1
				,'wd_menu_fontfamily' 				=> "Open Sans"
				,'wd_menu_font_googlefont' 			=> "Share"
				,'wd_sub_menu_font_googlefont_enable' 	=> 1
				,'wd_sub_menu_fontfamily' 			=> "Open Sans"
				,'wd_sub_menu_font_googlefont' 		=> "Roboto"
				,'wd_price_font_googlefont_enable' 	=> 1
				,'wd_price_fontfamily' 				=> 'Open Sans'
				,'wd_price_font_googlefont' 		=> "Roboto"
				,'wd_menu_thumb_width' 				=> 16
				,'wd_menu_thumb_height' 			=> 16
				,'wd_menu_num_widget' 				=> 5
				,'wd_qs_button_label' 				=> __("Quickshop","wpdance")
				,'wd_qs_button_imgage' 				=> ""
				,'wd_quickshop_background' 			=> "#000000"
				,'wd_quickshop_text_color' 			=> "#ffffff"
				,'wd_quickshop_background_hover' 	=> "#c30005"
				,'wd_quickshop_text_color_hover' 	=> "#ffffff"
				,'wd_enable_advertisement' 			=> 0
				,'wd_advertisement_code' 			=> '<div class="wd-shipping"><a style="color:#00387f" class="shipping" href="#">Free shipping for over $200.00 orders</a><a style="color:#c30005" class="gifts" href="#">Gifts for over $100 orders </a></div>
														<ul class="menu-advertisment">
														<li><a href="#">$5 DVDs</a></li>
														<li><a href="#">$10 Blu-ray Discs</a></li>
														<li><a href="#">Preorders</a></li>
														<li><a class="wd-important" href="#">Deals</a></li>
														</ul>'
				,'wd_top_blog_code' 				=> ""
				,'wd_bottom_blog_code' 				=> ""
				,'wd_before_body_end_code' 			=> ""
				,'wd_google_analytic_code' 			=> ""
				
				,'wd_shop_slider_slide_speed_pc' 	=> "800"
				,'wd_shop_slider_slide_speed_mobile'=> "200"
				,'wd_shop_slider_scroll_per_page' 	=> 0
				,'wd_shop_slider_rewind_nav' 		=> 1
				,'wd_shop_slider_rewind_speed' 		=> "800"
				,'wd_shop_slider_auto_play' 		=> 0
				,'wd_shop_slider_stop_on_hover' 	=> 0
				,'wd_shop_slider_mouse_drag' 		=> 0
				,'wd_shop_slider_touch_drag' 		=> 1
				
				,'wd_prod_cat_column' 				=> 4
				,'wd_prod_cat_per_page' 			=> 12
				,'wd_prod_cat_layout' 				=> "0-1-1"
				,'wd_prod_cat_left_sidebar' 		=> "category-widget-area-left"
				,'wd_prod_cat_right_sidebar' 		=> "category-widget-area-right"
				,'wd_prod_cat_rating' 				=> 1
				,'wd_prod_cat_categories' 			=> 0
				,'wd_prod_cat_title' 				=> 1
				,'wd_prod_cat_sku' 					=> 0
				,'wd_prod_cat_disc_grid' 			=> 0
				,'wd_prod_cat_disc_list' 			=> 1
				,'wd_prod_cat_price' 				=> 1
				,'wd_prod_cat_add_to_cart' 			=> 1
				,'wd_prod_left_sidebar' 			=> "product-widget-area-left"
				,'wd_prod_right_sidebar' 			=> "product-widget-area-right"
				,'wd_prod_image' 					=> 1	
				,'wd_prod_cloudzoom' 				=> 1
				,'wd_prod_label' 					=> 1
				,'wd_prod_title' 					=> 1
				,'wd_prod_email_friend' 			=> 1
				,'wd_prod_sku' 						=> 1
				,'wd_prod_rating' 					=> 1
				,'wd_prod_review' 					=> 1
				,'wd_prod_availability' 			=> 1
				,'wd_prod_cart' 					=> 1
				,'wd_prod_price' 					=> 1
				,'wd_prod_shortdesc' 				=> 1
				,'wd_prod_meta' 					=> 1
				,'wd_prod_related' 					=> 1
				,'wd_prod_related_title' 			=> __('RELATED ITEMS','wpdance')
				,'wd_prod_upsell' 					=> 1
				,'wd_prod_upsell_title' 			=> __('YOU MAY ALSO LIKE','wpdance')
				,'wd_prod_share' 					=> 1
				,'wd_prod_share_title' 				=> __('Share thist','wpdance')
				,'wd_prod_ship_return' 				=> 1	
				,'wd_prod_ship_return_title' 		=> ""	
				,'wd_prod_ship_return_content' 		=> '<div class="wd-bottom-banner-left one_half">
														<a class="wd-effect-normal"><img title="banner" alt="banner" src="http://demo2.wpdance.com/imgs/wp_Sneaker/banner-bottom-product.jpg" />
														</a></div><div class="wd-bottom-banner-right one_half last">
														<a class="wd-effect-normal"><img title="banner" alt="banner" src="http://demo2.wpdance.com/imgs/wp_Sneaker/banner-bottom-product.jpg" /></a></div>'	
				,'wd_prod_tabs' 					=> 1	
				,'wd_prod_customtab' 				=> 1
				,'wd_prod_customtab_title' 			=> __('Custom Tab','wpdance')
				,'wd_prod_customtab_content' 		=> "custom contents go here"
				,'wd_prod_layout' 					=> "0-1-0"
				,'wd_blog_categories' 				=> 0
				,'wd_blog_author' 					=> 1
				,'wd_blog_time' 					=> 1
				,'wd_blog_comment_number' 			=> 1
				,'wd_blog_excerpt' 					=> 1			
				,'wd_blog_thumbnail' 				=> 1
				,'wd_blog_readmore' 				=> 1
				,'wd_blog_details_categories' 		=> 1
				,'wd_blog_details_author' 			=> 1
				,'wd_blog_details_time' 			=> 1
				,'wd_blog_details_tags' 			=> 1
				,'wd_blog_details_thumbnail' 		=> 1
				,'wd_blog_details_comment' 			=> 1
				,'wd_blog_details_socialsharing' 	=> 1
				,'wd_blog_details_authorbox' 		=> 1
				,'wd_blog_details_related' 			=> 1
				,'wd_blog_details_relatedlabel' 	=> __("Related Posts","wpdance")
				,'wd_blog_details_commentlist' 		=> 1
				,'wd_blog_details_commentlabel' 	=> __("Comment","wpdance")	
			),
			$data
		);	


	/*******   Primary   *******/
	$wd_theme_color_primary						= esc_attr( $data['wd_theme_color_primary'] );
	$wd_theme_color_secondary					= esc_attr( $data['wd_theme_color_secondary'] );
	$wd_text_color								= esc_attr( $data['wd_text_color'] );
	$wd_link_color								= esc_attr( $data['wd_link_color'] );
	$wd_link_color_hover						= esc_attr( $data['wd_link_color_hover'] );
	$wd_button_background						= esc_attr( $data['wd_button_background'] );
	$wd_button_text								= esc_attr( $data['wd_button_text'] );
	$wd_button_background_hover					= esc_attr( $data['wd_button_background_hover'] );
	$wd_button_text_hover						= esc_attr( $data['wd_button_text_hover'] );

	$wd_heading_color							= esc_attr( $data['wd_heading_color'] );
	// Font
	$font_body									= '"'.($data['wd_body_font_googlefont_enable'] == 1 ? esc_attr( $data['wd_body_font_family'] ) : esc_attr( $data['wd_body_font_googlefont'] )).'"'.' , Arial'; 										
	$font_body_second							= '"'.($data['wd_body_second_font_googlefont_enable'] == 1 ? esc_attr( $data['wd_body_second_font_family'] ) : esc_attr( $data['wd_body_second_font_googlefont'] )).'"'.' , sans-serif'; 										
	$font_menu									= '"'.($data['wd_menu_font_googlefont_enable'] == 1 ? esc_attr( $data['wd_menu_fontfamily'] ) : esc_attr( $data['wd_menu_font_googlefont'] )).'"'.' , sans-serif'; 								 		
	$font_sub_menu								= '"'.($data['wd_sub_menu_font_googlefont_enable'] == 1 ? esc_attr( $data['wd_sub_menu_fontfamily'] ) : esc_attr( $data['wd_sub_menu_font_googlefont'] )).'"'.' , sans-serif';									    
	$font_heading								= '"'.($data['wd_heading_font_googlefont_enable'] == 1 ? esc_attr( $data['wd_heading_fontfamily'] ) : esc_attr( $data['wd_heading_font_googlefont'] )).'"'.' , sans-serif'; 										
	$font_price									= '"'.($data['wd_price_font_googlefont_enable'] == 1 ? esc_attr( $data['wd_price_fontfamily'] ) : esc_attr( $data['wd_price_font_googlefont'] )).'"'.' , sans-serif';



	/*******   Header   *******/
	$wd_header_top_background					= esc_attr( $data['wd_header_top_background'] );
	$wd_header_top_text_color					= esc_attr( $data['wd_header_top_text_color'] );
	$wd_header_top_text_hover					= esc_attr( $data['wd_header_top_text_hover'] );
	
	$wd_menu_background							= esc_attr( $data['wd_menu_background'] );
	$wd_sub_menu_background						= esc_attr( $data['wd_sub_menu_background'] );
	$wd_sub_menu_border							= esc_attr( $data['wd_sub_menu_border'] );
	$wd_menu_text_color							= esc_attr( $data['wd_menu_text_color'] );
	$wd_menu_text_color_hover					= esc_attr( $data['wd_menu_text_color_hover'] );
	$wd_sub_menu_text_color						= esc_attr( $data['wd_sub_menu_text_color'] );
	$wd_sub_menu_text_color_hover				= esc_attr( $data['wd_sub_menu_text_color_hover'] );
	
	/******* Footer *******/
	$wd_footer_background						= esc_attr( $data['wd_footer_background'] );
	$wd_footer_subscriptions_background			= esc_attr( $data['wd_footer_subscriptions_background'] );
	$wd_footer_end_background					= esc_attr( $data['wd_footer_end_background'] );
	$wd_footer_end_menu_text					= esc_attr( $data['wd_footer_end_menu_text'] );
	$wd_footer_end_menu_text_hover				= esc_attr( $data['wd_footer_end_menu_text_hover'] );
	$wd_footer_end_text							= esc_attr( $data['wd_footer_end_text'] );

	$wd_button_cart_background					= esc_attr( $data['wd_button_cart_background'] );
	$wd_button_cart_background_hover			= esc_attr( $data['wd_button_cart_background_hover'] );
	$wd_button_cart_text						= esc_attr( $data['wd_button_cart_text'] );
	$wd_button_cart_text_hover					= esc_attr( $data['wd_button_cart_text_hover'] );
	
	if($quickshop_ready == true):
	$wd_quickshop_text_color					= isset($data['wd_quickshop_text_color'])?esc_attr( $data['wd_quickshop_text_color'] ):"#ffffff";
	$wd_quickshop_background					= isset($data['wd_quickshop_background'])?esc_attr( $data['wd_quickshop_background'] ):"#000000";
	$wd_quickshop_text_color_hover				= isset($data['wd_quickshop_text_color_hover'])?esc_attr( $data['wd_quickshop_text_color_hover'] ):"#ffffff";
	$wd_quickshop_background_hover				= isset($data['wd_quickshop_background_hover'])?esc_attr( $data['wd_quickshop_background_hover'] ):"#000000";
	endif;

	$wd_main_content_background					= esc_attr( $data['wd_main_content_background'] );
	$wd_body_end_background						= esc_attr( $data['wd_body_end_background'] );
	$wd_phone_background						= esc_attr( $data['wd_phone_background'] );
	$wd_phone_text_color						= esc_attr( $data['wd_phone_text_color'] );
	$wd_phone_sub_text_color					= esc_attr( $data['wd_phone_sub_text_color'] );
	$wd_link_title_portfolio					= esc_attr( $data['wd_link_title_portfolio'] );
	$wd_link_title_portfolio_hover				= esc_attr( $data['wd_link_title_portfolio_hover'] );
	$wd_background_button_portfolio				= esc_attr( $data['wd_background_button_portfolio'] );
	$wd_background_button_portfolio_hover		= esc_attr( $data['wd_background_button_portfolio_hover'] );
	$wd_border_portfolio_hover					= esc_attr( $data['wd_border_portfolio_hover'] );

	$wd_testimonial_background					= esc_attr( $data['wd_testimonial_background'] );
	$wd_product_name_color						= esc_attr( $data['wd_product_name_color'] );
	$wd_special_color							= esc_attr( $data['wd_special_color'] );


	$wd_text_price_color						= esc_attr( $data['wd_text_price_color'] );
	$wd_rating_color							= esc_attr( $data['wd_rating_color'] );
	$wd_text_price_sale_color					= esc_attr( $data['wd_text_price_sale_color'] );
	$wd_border_color							= esc_attr( $data['wd_border_color'] );
	$wd_border_color_hover						= esc_attr( $data['wd_border_color_hover'] );

	$wd_feature_sale							= esc_attr( $data['wd_feature_sale'] );
	$wd_feature_sale_text_color					= esc_attr( $data['wd_feature_sale_text_color'] );
	$wd_feature_new								= esc_attr( $data['wd_feature_new'] );
	$wd_feature_new_text_color					= esc_attr( $data['wd_feature_new_text_color'] );
	$wd_feature_hot								= esc_attr( $data['wd_feature_hot'] );
	$wd_feature_hot_text_color					= esc_attr( $data['wd_feature_hot_text_color'] );
	
	$wd_button_slider_background				= esc_attr( $data['wd_button_slider_background'] );
	$wd_button_slider_icon						= esc_attr( $data['wd_button_slider_icon'] );

	
	$wd_social_border							= esc_attr( $data['wd_social_border'] );
	$wd_social_text								= esc_attr( $data['wd_social_text'] );
	
	$wd_sidebar_title_background				= esc_attr( $data['wd_sidebar_title_background'] );
	$wd_sidebar_title_color						= esc_attr( $data['wd_sidebar_title_color'] );
	?>


	/*==============================================================*/
	/*                        PRIMARY                               */
	/*==============================================================*/
	
	/* ====================================================================================================*/
	/* ======================================= CUSTOM FONT ============================================== */
	/* ====================================================================================================*/
	body,input,
	html .page div.product .product_title,
	html .woocommerce div.product .product_title,
	html.woocommerce #content div.product .product_title,
	html .woocommerce-page div.product .product_title,
	html.woocommerce-page #content div.product .product_title,
	.woocommerce form .form-row#ship-to-different-address label.checkbox,.item-portfolio .post-title a,.wd-intro h2,.wd-intro h1{
		font-family:<?php echo $font_body; ?>;
		font-weight:400;
	}
	
	input[type="color"], input[type="email"],input[type="number"],input[type="password"],input[type="tel"],input[type="text"],select,textarea{
		font-family:<?php echo $font_body; ?>;
	}
	h1,h2,h3,h4,h5,h6,.woocommerce-page #content .cart-collaterals .coupon_wrapper label,.wd-title,.shortcode_wd_banner .shortcode_banner_simple_bullet,h3 a{
		font-family:<?php echo $font_heading; ?>;
		font-weight:600;
	}
	pre,blockquote,body code{
		font-family:<?php echo $font_body; ?>;
	}
	button.btn,a.btn{
		font-family:<?php echo $font_body; ?>;
	}
	#header .nav > .main-menu > ul.menu > li > a > span,#header .nav > .main-menu > div.menu > ul > li > a,.mobile-main-menu .menu > li > a{
		font-family:<?php echo $font_menu; ?>;
	}
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li a,#header .nav > .main-menu > ul.menu > li.wd-mega-menu a{
		font-family:<?php echo $font_sub_menu; ?>;
	}
	
	.widget-container .price .amount,.widget-container .amount,span.amount{
		font-family:<?php echo $font_price; ?>;
		font-weight:600;
		font-size:18px;
		line-height:22px;
	}
	
	.button span,button.button, a.button, input[type^=submit], html .woocommerce a.button, html .woocommerce button.button, html .woocommerce input.button, html .woocommerce #respond input#submit, .woocommerce #content input.button, html .woocommerce-page a.button, html .woocommerce-page button.button, .woocommerce-page input.button, html .woocommerce-page #respond input#submit, html .woocommerce-page #content input.button, html .woocommerce-page #content input.button, html .woocommerce #content table.cart input.button, html input.button,
	
	.wd_tini_account_wrapper .wd_tini_account_control > a,.regis-account-wrapper a,.shopping-cart .wd_tini_cart_control a,.mobile_cart_container,.cart_dropdown .total span.title,.cart_dropdown .go_to_shopping_cart a,#em_quickshop_handler #qs_inner2.qs_text_btn,ul.nav-tabs li a,.feature.shortcode .feature_title,.feature.shortcode .feature_title a,.feature.shortcode .feature_content_wrapper a.view_more,.footer-menu ul li a,.wd_mobile_account,html body #header .menu .woocommerce .products .product .list_add_to_cart a,ul.list-posts li .post-info-content .read-more,.widget_customrecent p.title > a,.widget_multitab  ul.tabs-post-list li p.title > a,.widget_recent_comments_custom ul li .comment-author a,.widget_recent_comments_custom ul li .detail .comment-meta a,.widget_multitab ul.tabs-comments-list li .detail .comment-meta span a,body .btn,body .accordion-heading a.accordion-toggle,html .progress .bar,.added_to_cart.wc-forward,
	html .woocommerce #content table.shop_table thead th, 
	html .woocommerce-page #content table.shop_table thead th,
	#content .woocommerce table.shop_table thead th,
	#content .woocommerce .cart-collaterals .cart_totals > table th,
	.woocommerce #content .cart-collaterals .cart_totals > table th,
	.woocommerce-page #content .cart-collaterals .cart_totals > table th,#entry-author-info #author-description .author-name [rel^=author],.related > .title,.related .owl-wrapper .related-item .title,body.woocommerce #content div.product .woocommerce-tabs ul.tabs li a,body .woocommerce div.product .woocommerce-tabs ul.tabs li a, body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a, body.woocommerce-page div.product .woocommerce-tabs ul.tabs li a,
	html .woocommerce div.product form.cart .variations label, 
	html .woocommerce #content div.product form.cart .variations label, 
	html .woocommerce-page div.product form.cart .variations label, 
	html .woocommerce-page #content div.product form.cart .variations label,
	html .page div.product form.cart .variations label,#comments .commentlist li .divcomment .divcomment-inner .reply a,
	html .woocommerce .after_checkout_form form.checkout_coupon .question_coupon, 
	html .woocommerce-page .after_checkout_form form.checkout_coupon .question_coupon,
	body.woocommerce-page form.checkout table.shop_table tfoot th,
	body .woocommerce table.shop_table tfoot th,#portfolio-galleries .portfolio-filter li a,.wd_button_loadmore_wrapper input.btn_load_more,.shortcode-recent-blogs-slider.single-item .view-more,
	
	.body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a,
	
	.body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a,
	
	#content div.product .summary.entry-summary .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce #content div.product .summary.entry-summary .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce-page #content div.product .summary.entry-summary .yith-wcwl-wishlistexistsbrowse a,
	
	#content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce #content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce-page #content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a,
	
	#content div.product .summary.entry-summary .add_to_wishlist ,
	.woocommerce #content div.product .summary.entry-summary .add_to_wishlist ,
	.woocommerce-page #content div.product .summary.entry-summary .add_to_wishlist,

	#content div.product .summary.entry-summary .add_to_wishlist.button ,
	.woocommerce #content div.product .summary.entry-summary .add_to_wishlist.button ,
	.woocommerce-page #content div.product .summary.entry-summary .add_to_wishlist.button,
	
	#content div.product .summary.entry-summary .compare.button,
	.woocommerce #content div.product .summary.entry-summary .compare.button,
	.woocommerce-page #content div.product .summary.entry-summary .compare.button,
	
	#content div.product .summary.entry-summary .compare,
	.woocommerce #content div.product .summary.entry-summary .compare,
	.woocommerce-page #content div.product .summary.entry-summary .compare,
	
	.body-wrapper .products .product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist,

	.body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button,
	
	#content .products .product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce #content.products .product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce-page #content .products .product .product-meta-wrapper .add_to_wishlist,

	#content .products .product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce #content .products .product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce-page #content .products .product .product-meta-wrapper .add_to_wishlist.button,
		
	.body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare.button,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare.button,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare.button,
	
	.body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare,
	
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li .yith-wcwl-add-to-wishlist a, #header .nav > .main-menu > ul.menu > li.wd-mega-menu .yith-wcwl-add-to-wishlist a,
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li .wd_compare_wrapper a, #header .nav > .main-menu > ul.menu > li.wd-mega-menu .wd_compare_wrapper a,table.compare-list tr.remove td > a,
	html body table.compare-list tr th,
	html .body-wrapper .woocommerce .products .product .onsale, html .woocommerce-page .body-wrapper .products .product .onsale,html .woocommerce .body-wrapper .products .product span.featured,html .woocommerce-page .body-wrapper .products .product span.featured,
	html .woocommerce .products .product span.featured,html .woocommerce .body-wrapper .products .product .product_label span.new, html .woocommerce-page .body-wrapper .products .product.product_label span.new,html .woocommerce .products .product .product_label span.new,
	#footer .first-footer-widget-area a, #footer .first-footer-widget-area a,.shortcode-recent-blogs-slider.single-item .view-more,
	ul.product_list_widget li a, html .woocommerce ul.product_list_widget li a, html .woocommerce-page ul.product_list_widget li a, ul.cart_list li a, html .woocommerce ul.cart_list li a, html .woocommerce-page ul.cart_list li a, .widget_popular ul li a, html .woocommerce .widget_popular ul li a, .widget_hot_product ul li a, html .woocommerce .widget_hot_product ul li a, .widget_top_rated_products ul.product_list_widget li > a, html .woocommerce .widget_top_rated_products ul.product_list_widget li > a, .widget_recent_reviews ul.product_list_widget li > a, html .woocommerce .widget_recent_reviews ul.product_list_widget li > a
	{
		font-family:<?php echo $font_body_second; ?>;
	}
	
	/* BOLD BODY FONT 2*/
	button.button, a.button, input[type^=submit], html .woocommerce a.button, html .woocommerce button.button, html .woocommerce input.button, html .woocommerce #respond input#submit, .woocommerce #content input.button, html .woocommerce-page a.button, html .woocommerce-page button.button, .woocommerce-page input.button, html .woocommerce-page #respond input#submit, html .woocommerce-page #content input.button, html .woocommerce-page #content input.button, html .woocommerce #content table.cart input.button, html input.button,

	html  div.product span.price,
	html  div.product p.price,
	html .body-wrapper .woocommerce .products .product .price, 
	html .woocommerce-page .body-wrapper .products .product .price,
	html .woocommerce div.product span.price, 
	html .woocommerce div.product p.price, 
	html .woocommerce #content div.product span.price, 
	html .woocommerce #content div.product p.price, 
	html .woocommerce-page div.product span.price, 
	html .woocommerce-page div.product p.price, 
	html .woocommerce-page #content div.product span.price, 
	html .woocommerce-page #content div.product p.price,
	html .products .product .price,
	html div.product .price del,
	html .body-wrapper .woocommerce .products .product .price del, 
	html .woocommerce-page .body-wrapper .products .product .price del,
	html .woocommerce div.product span.price del, 
	html .woocommerce div.product p.price del, 
	html .woocommerce #content div.product span.price del, 
	html .woocommerce #content div.product p.price del, 
	html .woocommerce-page div.product span.price del, 
	html .woocommerce-page div.product p.price del, 
	html .woocommerce-page #content div.product span.price del, 
	html .woocommerce-page #content div.product p.price del,
	html .home #content div.product p.price del,.shopping-cart,.added_to_cart.wc-forward,
	
	#em_quickshop_handler #qs_inner2.qs_text_btn,
	
	.feature.shortcode .feature_title,
	.feature.shortcode .feature_title a,
	.feature.shortcode .feature_content_wrapper a.view_more,
	.footer-menu ul li a,
	.widget_recent_post_slider .entry-title > a.read-more,.wd_mobile_account,ul.list-posts li .post-info-content .read-more,
	.widget_customrecent p.title > a,.widget_multitab  ul.tabs-post-list li p.title > a,
	.widget_recent_comments_custom ul li .comment-author a,.widget_recent_comments_custom ul li .detail .comment-meta a,
	.widget_multitab ul.tabs-comments-list li .detail .comment-meta span a,body .btn,body .accordion-heading a.accordion-toggle,html .progress .bar,
	html .woocommerce #content table.shop_table thead th, 
	html .woocommerce-page #content table.shop_table thead th,
	#content .woocommerce table.shop_table thead th,
	#header .nav > .main-menu > ul.menu > li.current_page_item > a > span, #header .nav > .main-menu > ul.menu > li.current-menu-item > a > span,.woocommerce .woocommerce-message a.button, .woocommerce-page .woocommerce-message a.button, .woocommerce-message a.button,.single-content .single-post .post-title .heading-title,#entry-author-info #author-description .author-name [rel^=author],.related > .title,.related .owl-wrapper .related-item .title,.short-description-title, body.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a, body .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a,body.woocommerce-page div.product ul.nav-tabs li.active a h2,body.woocommerce div.product ul.nav-tabs li.active a h2,#content .woocommerce table.my_account_orders td.order-actions a.button, .woocommerce #content table.my_account_orders td.order-actions a.button, .woocommerce-page #content table.my_account_orders td.order-actions a.button,#comments .commentlist li .divcomment .divcomment-inner .reply a,html .woocommerce .custom_category_shortcode .products li .product_upsells h4.heading-title,html .woocommerce .after_checkout_form form.checkout_coupon .question_coupon, 
	html .woocommerce-page .after_checkout_form form.checkout_coupon .question_coupon,body form.checkout #payment #place_order,.shortcode_wd_banner h3.banner-title,html .woocommerce-page .widget-container .button,html .woocommerce .widget-container .button,html .woocommerce-page .widget-container input[type^=submit],html .woocommerce .widget-container input[type^=submit],ul.special-category-widget-area li:first-child h3.widget-title.heading-title,.widget_multitab ul.nav-tabs li a,
	
	#content div.product .summary.entry-summary .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce #content div.product .summary.entry-summary .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce-page #content div.product .summary.entry-summary .yith-wcwl-wishlistexistsbrowse a,
	
	#content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce #content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce-page #content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a,
	
	#content div.product .summary.entry-summary .add_to_wishlist ,
	.woocommerce #content div.product .summary.entry-summary .add_to_wishlist ,
	.woocommerce-page #content div.product .summary.entry-summary .add_to_wishlist,

	#content div.product .summary.entry-summary .add_to_wishlist.button ,
	.woocommerce #content div.product .summary.entry-summary .add_to_wishlist.button ,
	.woocommerce-page #content div.product .summary.entry-summary .add_to_wishlist.button,
	
	#content div.product .summary.entry-summary .compare.button,
	.woocommerce #content div.product .summary.entry-summary .compare.button,
	.woocommerce-page #content div.product .summary.entry-summary .compare.button,
	
	#content div.product .summary.entry-summary .compare,
	.woocommerce #content div.product .summary.entry-summary .compare,
	.woocommerce-page #content div.product .summary.entry-summary .compare,
	
	.body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a,
	.body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a,
	
	
	.body-wrapper .products .product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist,

	.body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button,
	
	#content .products .product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce #content.products .product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce-page #content .products .product .product-meta-wrapper .add_to_wishlist,

	#content .products .product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce #content .products .product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce-page #content .products .product .product-meta-wrapper .add_to_wishlist.button,
	
	.body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare.button,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare.button,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare.button,
	.body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare,
	
	.mobile_cart_container,.wd_tini_account_wrapper .wd_tini_account_control > a,.shopping-cart .wd_tini_cart_control a,#collapse-login-regis h4.heading-title,.ft-col h3,#footer h3.widget-title,h2.title,h1.heading-title.page-title,ul.special-category-widget-area h3.widget-title.heading-title,#customer_login div.title > h3,.order-detail-title, .custom-detail-title,.addresses .title h3,html body table.compare-list tr th,h2.title,html .body-wrapper .woocommerce .products .product .onsale, html .woocommerce-page .body-wrapper .products .product .onsale,html .woocommerce .body-wrapper .products .product span.featured,html .woocommerce-page .body-wrapper .products .product span.featured,
	html .woocommerce .products .product span.featured,html .woocommerce .body-wrapper .products .product .product_label span.new, html .woocommerce-page .body-wrapper .products .product.product_label span.new,html .woocommerce .products .product .product_label span.new
	{
		font-weight:600;
	}
	#header .nav > .main-menu > ul.menu > li > a > span, #header .nav > .main-menu > ul.menu > li > a > span,
	body.woocommerce-page form.checkout table.shop_table tfoot th,
	body .woocommerce table.shop_table tfoot th,
	.shopping-cart .cart_item,#content .woocommerce .cart-collaterals .cart_totals > table th,
	.woocommerce #content .cart-collaterals .cart_totals > table th,.cart_totals  .cart-subtotal .amount,
	.woocommerce-page #content .cart-collaterals .cart_totals > table th,#content .woocommerce .cart-collaterals .cart_totals > table td strong span.amount, .woocommerce #content .cart-collaterals .cart_totals > table td strong span.amount, .woocommerce-page #content .cart-collaterals .cart_totals > table td strong span.amount,.woocommerce ul#shipping_method .amount, .woocommerce-page ul#shipping_method .amount,html .woocommerce div.product form.cart .variations label, 
	html .woocommerce #content div.product form.cart .variations label, 
	html .woocommerce-page div.product form.cart .variations label, 
	html .woocommerce-page #content div.product form.cart .variations label,
	html .page div.product form.cart .variations label,.shortcode_wd_banner .shortcode_banner_simple_bullet span.lb_small,.cart_dropdown .total span.title,.woocommerce .widget_shopping_cart .total strong, .woocommerce-page .widget_shopping_cart .total strong, .woocommerce-page.widget_shopping_cart .total strong, .woocommerce.widget_shopping_cart .total strong{
		font-weight:500;
	}
	
	.shortcode_wd_banner h4.banner-title.small,.shortcode_wd_banner h4.banner-sub-title,#portfolio-galleries .portfolio-filter li a,body .wd_banner_top_main_content .wd_banner_top_main_content_wrapper
	{
		font-weight:400;
	}
	
	ul.nav-tabs li a, .woocommerce .featured_product_wrapper .featured_product_wrapper_meta h3.heading-title,.heading-title-block h1, .heading-title-block h2,
	body.woocommerce #content div.product .woocommerce-tabs ul.tabs li a,body .woocommerce div.product .woocommerce-tabs ul.tabs li a, body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a, body.woocommerce-page div.product .woocommerce-tabs ul.tabs li a ,body.woocommerce-page div.product ul.nav-tabs li a h2,body.woocommerce div.product ul.nav-tabs li a h2,#portfolio-galleries .portfolio-filter li a,
	
	ul.product_list_widget li a,
	html .woocommerce ul.product_list_widget li a, 
	html .woocommerce-page ul.product_list_widget li a,

	ul.cart_list li a,
	html .woocommerce ul.cart_list li a, 
	html .woocommerce-page ul.cart_list li a,

	.widget_popular ul li  a,
	html .woocommerce .widget_popular ul li a,

	.widget_hot_product ul li  a,
	html .woocommerce .widget_hot_product ul li  a,

	.widget_top_rated_products ul.product_list_widget li > a,
	html .woocommerce .widget_top_rated_products ul.product_list_widget li > a,

	.widget_recent_reviews ul.product_list_widget li > a,
	html .woocommerce .widget_recent_reviews ul.product_list_widget li > a
	{
		font-weight:600;
	}
	
	/* ====================================================================================================*/
	/* ======================================= BACKGROUND COLOR ============================================== */
	/* ====================================================================================================*/
	.slideshow-wrapper.main-slideshow,.top-page,#main-module-container > #container,#main-module-container > #wd_container,#wd_body_end,#footer,.woocommerce .featured_product_wrapper .featured_product_wrapper_meta h3.heading-title, .nav > li > a:hover, .nav-tabs > .active > a, .nav-tabs > .active > a:hover,
	body.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a,body .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a, body.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a,body.woocommerce-page div.product ul.nav-tabs li.active a,body.woocommerce div.product ul.nav-tabs li.active a,
	body.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a:hover,body .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:hover, body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a:hover, body.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a:hover,body.woocommerce-page div.product ul.nav-tabs li.active a:hover,body.woocommerce div.product ul.nav-tabs li.active a:hover,
	body.woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover,body .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover, body.woocommerce-page div.product .woocommerce-tabs ul.tabs li a:hover,body.woocommerce-page div.product ul.nav-tabs li a:hover,body.woocommerce div.product ul.nav-tabs li a:hover,
	
	.woocommerce .featured_product_slider_wrapper .featured_product_slider_wrapper_meta .wd_title_shortcode h3,.heading-title-block h1,.heading-title-block h2,.woocommerce-page .featured_product_slider_wrapper .featured_product_slider_wrapper_meta .wd_title_shortcode h3,.woocommerce .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta .wd_title_shortcode h3, .woocommerce-page .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta .wd_title_shortcode h3,body .top-page.wd_wide,.heading-title-block h3,.heading-title-block h4,.heading-title-block h5,.heading-title-block h6,
	.wd_banner_top_main_content,.related .wd_title_related .heading-title,#customer_login .wd-title-account h2,#comments .wd_comment_title .heading-title,#respond .wd_respond_title .heading-title,#portfolio-galleries .portfolio-filter li.active a,#portfolio-galleries .portfolio-filter li:hover a,body .accordion-heading a,
	.featured_product_slider_wrapper > div.featured_product_slider_wrapper_inner.loading:before, .featured_product_slider_wrapper.shortcode_slider .fredsel_slider_wrapper_inner.loading:before, .featured_categories_slider_wrapper .featured_product_slider_wrapper_inner.loading:before, .widget_recent_post_slider .wd_recent_post_widget_wrapper.loading:before, .shortcode-recent-blogs-slider.loading:before,.shortcode-recent-blogs-slider .wd-blog-title .heading-title,
	ul.special-category-widget-area .widget_price_filter h3.widget-title.heading-title, ul.special-category-widget-area .widget_layered_nav h3.widget-title.heading-title, ul.special-category-widget-area .widget_wd_pc_color_nav h3.widget-title.heading-title,
	body #content .woocommerce .cart-collaterals .cross-sells .wd-cross-sells-title .heading-title,
	.woocommerce #content .cart-collaterals .cross-sells .wd-cross-sells-title .heading-title, 
	.woocommerce-page #content .cart-collaterals .cross-sells .wd-cross-sells-title .heading-title,
	html .woocommerce .custom_category_shortcode .wd-categories-title .heading-title,
	
	.slideshow-wrapper.main-slideshow > div > div
	{
		background-color:<?php echo $wd_main_content_background; ?>;
	}
	
	.body-wrapper #main_content .products.grid .product .product_item_wrapper a,
	.woocommerce .body-wrapper #main_content .products.grid .product .product_item_wrapper a,
	.woocommerce-page .body-wrapper #main_content .products.grid .product .product_item_wrapper a,
	html .woocommerce .related.products .products .product .product_item_wrapper, 
	html .woocommerce-page .related.products .products .product .product_item_wrapper,
	html .woocommerce .upsells.products .products .product .product_item_wrapper, 
	html .woocommerce-page .upsells.products .products .product .product_item_wrapper,
	html .woocommerce .cross-sells .products .product .product_item_wrapper, 
	html .woocommerce-page .cross-sells .products .product .product_item_wrapper,
	html body #container-main .woocommerce .style-2 .products .product .product_thumbnail_wrapper a,
	html body.woocommerce #container-main .style-2 .products .product .product_thumbnail_wrapper a, 
	html body.woocommerce-page #container-main .style-2 .products .product .product_thumbnail_wrapper a,
	
	.body-wrapper #main_content .products.grid .product .product_item_wrapper,
	.woocommerce .body-wrapper #main_content .products.grid .product .product_item_wrapper,
	.woocommerce-page .body-wrapper #main_content .products.grid .product .product_item_wrapper,
	
	.woocommerce .products .product_upsells ul li a,
	
	.woocommerce .custom_category_shortcode .products li.product .product_thumbnail_wrapper,
	
	ul.archive-product-subcategories > .product img,
	
	.woocommerce-page.columns-6 ul.products li.product.span4 .product_thumbnail_wrapper, .woocommerce.columns-6 ul.products li.product.span4 .product_thumbnail_wrapper,
	.woocommerce-page.columns-6 ul.products li.product.span6 .product_thumbnail_wrapper, .woocommerce.columns-6 ul.products li.product.span6 .product_thumbnail_wrapper,
	.woocommerce-page.columns-6 ul.products li.product.span8 .product_thumbnail_wrapper, .woocommerce.columns-6 ul.products li.product.span8 .product_thumbnail_wrapper
	{
		border-color:<?php echo $wd_main_content_background; ?>;
	}
	
	.header-container,.wd_tini_cart_wrapper.loading-cart:after{
		background:<?php echo $wd_header_top_background; ?>;
	}
	
	.shopping-cart .cart_dropdown .dropdown_body:before,.wd_tini_account_wrapper .form_wrapper:before{
		color:<?php echo $wd_header_top_background; ?>;
	}
	
	/* ====================================================================================================*/
	/* ======================================= CUSTOM COLOR ============================================== */
	/* ====================================================================================================*/
	
	body{
		color:<?php echo $wd_text_color; ?>;
	}
	
	h1,h3,h4,h5,h6{
		color:<?php echo $wd_heading_color; ?>;
	}
	
	.feature.shortcode .feature_content_wrapper:hover{
		border-color:<?php echo $wd_heading_color; ?>;
	}
	
	.feature.shortcode .feature_content_wrapper a.view_more .bg_view_more{
		background-color:<?php echo $wd_heading_color; ?>;
	}
	
	h3{
		color:<?php echo wd_calc_color($wd_heading_color,"#1e1e1e") ?>;
	}
	h4{
		color:<?php echo $wd_text_color; ?>;
	}
	h5,h6{
		color:<?php echo wd_calc_color($wd_heading_color,"#464646") ?>;
	}
	
	pre,body code,.woocommerce #reviews #comments ol.commentlist li .meta, .woocommerce-page #reviews #comments ol.commentlist li .meta,select{
		border-color:<?php echo $wd_border_color; ?>;
		color:<?php echo $wd_text_color; ?>;
	}
	
	textarea::-webkit-input-placeholder,
	textarea::-moz-placeholder,
	textarea:-moz-placeholder,
	textarea:-ms-input-placeholder,
	input::-webkit-input-placeholder,
	input::-moz-placeholder,
	input:-moz-placeholder,
	input:-ms-input-placeholder{
		color:<?php echo $wd_text_color; ?> !important;
	}
	
	pre:hover,body code:hover{
		background:<?php echo wd_calc_color($wd_border_color,"#191919") ?>;
	}
	
	ul li,ol li{
		color:<?php echo wd_calc_color($wd_text_color,"#969696",false) ?>;
	}
	
	ul li li,ol li li,blockquote,ul li .textwidget, ol li .textwidget{
		color:<?php echo $wd_text_color; ?>;
	}
	
	html .body-wrapper .woocommerce .products .product .onsale, html .woocommerce-page .body-wrapper .products .product .onsale,
	html .woocommerce .images span.onsale, 
	html .woocommerce-page .images span.onsale,
	html .pp_woocommerce .images span.onsale{
		background-color:<?php echo $wd_feature_sale; ?>;
		color:<?php echo $wd_feature_sale_text_color; ?>;
	}
	html .woocommerce #content .products .product span.featured, html .woocommerce-page #content .products .product span.featured, html .woocommerce .products .product span.featured{
		background-color:<?php echo $wd_feature_hot; ?>;
		color:<?php echo $wd_feature_hot_text_color; ?>;
	}
	html .woocommerce .body-wrapper .products .product .product_label span.new, 
	html .woocommerce-page .body-wrapper .products .product.product_label span.new,
	html .woocommerce .products .product .product_label span.new{
		background-color:<?php echo $wd_feature_new; ?>;
		color:<?php echo $wd_feature_new_text_color; ?>;
	}
	/************* SOCIAL *********************/
	.widget_social ul li a,.widget_social ul li a:before{
		border-color:<?php echo $wd_social_border; ?>;
		color:<?php echo $wd_social_text; ?>;
	}
	/************** HEADER ********************/
	.wd_tini_account_wrapper .wd_tini_account_control > a,.regis-account-wrapper a,.regis-account-wrapper,.shopping-cart .wd_tini_cart_control a,.wd_tini_cart_wrapper.loading-cart:before,#header .visible-phone.cart-drop-icon:before,#header .visible-phone.login-drop-icon:before,.wd_mobile_account a,.mobile_cart_container a,#header form[id^="searchform-"] .bg_search input[id^="searchsubmit-"],#header form[id^="searchform-"] .bg_search input[id^="s-"]{
		color:<?php echo $wd_header_top_text_color; ?>;
	}
	
	.wd_tini_account_wrapper .wd_tini_account_control > a:hover,.regis-account-wrapper a:hover,.shopping-cart:hover .wd_tini_cart_control a,#header .header_search:hover span,#header .shopping-cart-wrapper:hover .visible-phone.cart-drop-icon:before,#header .wd_tini_account_control:hover .visible-phone.login-drop-icon:before,.wd_mobile_account a:hover,.mobile_cart_container a:hover,#header form[id^="searchform-"] .bg_search input[id^="searchsubmit-"]:hover{
		color:<?php echo $wd_header_top_text_hover; ?>;
	}
	
	.shopping-cart .cart_dropdown ul.cart_list li a.remove{
		border-color:<?php echo $wd_border_color; ?>;
		background-color:<?php echo $wd_border_color; ?>;
	}
	.shopping-cart .cart_dropdown ul.cart_list li a.remove:hover{
		border-color:<?php echo $wd_header_top_background; ?>;
		background-color:<?php echo $wd_header_top_background; ?>;
	}
	
	.woocommerce table.cart a.remove:hover, .woocommerce-page table.cart a.remove:hover, .woocommerce #content table.cart a.remove:hover, .woocommerce-page #content table.cart a.remove:hover,#content .woocommerce table.cart a.remove:hover{
		color:#ffffff;
		background-color:<?php echo $wd_header_top_background; ?>;
		border-color:<?php echo $wd_header_top_background; ?>;
	}
	.comment-body p,.comment-body,
	#comments .commentlist li .divcomment .divcomment-inner .comment-author cite a,#comments .commentlist li .divcomment .divcomment-inner .comment-meta a,
	#footer .first-footer-widget-area a, #footer .first-footer-widget-area a, #footer .subscriptions-footer-widget-area a,
	div.product.wd_quickshop .entry-summary span.price del .amount,
	div.product.wd_quickshop .entry-summary p.price del .amount,
	html .woocommerce div.product .entry-summary span.price del .amount,
	html .woocommerce div.product .entry-summary p.price del .amount,
	html .woocommerce #content div.product .entry-summary span.price del .amount,
	html .woocommerce #content div.product .entry-summary p.price del .amount,
	html .woocommerce-page div.product .entry-summary span.price del .amount,
	html .woocommerce-page div.product .entry-summary p.price del.amount,
	html .woocommerce-page #content div.product .entry-summary span.price del .amount,
	html .woocommerce-page #content div.product .entry-summary p.price del .amount,
	html .page div.product .entry-summary span.price del .amount,
	div.product.wd_quickshop .entry-summary span.price del .amount,
	div.product.wd_quickshop .entry-summary span.price del,
	div.product.wd_quickshop .entry-summary p.price del,
	html .woocommerce div.product .entry-summary span.price del,
	html .woocommerce div.product .entry-summary p.price del,
	html .woocommerce #content div.product .entry-summary span.price del,
	html .woocommerce #content div.product .entry-summary p.price del,
	html .woocommerce-page div.product .entry-summary span.price del,
	html .woocommerce-page div.product .entry-summary p.price del,
	html .woocommerce-page #content div.product .entry-summary span.price del,
	html .woocommerce-page #content div.product .entry-summary p.price del,
	html .page div.product .entry-summary span.price del,

	
	body.woocommerce-page div.product ul.nav-tabs li a h2,body.woocommerce div.product ul.nav-tabs li a h2,
	.related .date-time,
	.woocommerce #content div.product p.stock, .woocommerce div.product p.stock, .woocommerce-page #content div.product p.stock, .woocommerce-page div.product p.stock,html .woocommerce-page #content div.product .add_new_review a,html .woocommerce div.product .add_new_review,
	.wd_product_categories a,div.product .tagcloud a,
	html .woocommerce .woocommerce-breadcrumb a, #crumbs a,
	.woocommerce ul#shipping_method label, .woocommerce-page ul#shipping_method label,
	.woocommerce #content table.shop_table tbody tr.cart_item .product-thumbnail.product-name a, 
	.woocommerce-page #content table.shop_table tbody tr.cart_item .product-thumbnail.product-name a,
	#content .woocommerce table.shop_table tbody tr.cart_item .product-thumbnail.product-name a,
	.price_slider_wrapper a,
	body .woocommerce form.login .lost_password,
	body.woocommerce-page form.login .lost_password,
	body .woocommerce form.login .lost_password a,
	body.woocommerce-page form.login .lost_password a,
	body .woocommerce form.checkout_coupon .lost_password,
	body.woocommerce-page form.checkout_coupon .lost_password,
	body .woocommerce form.register .lost_password,
	body.woocommerce-page form.register .lost_password,
	.cart_dropdown ul.cart_list li .cart_item_wrapper > a,ul.nav-tabs li a,ul.nav-tabs li:before,#footer ul.footer-contact li.contact-mobile,.wd_tini_account_wrapper .form_wrapper_footer > p > a,p.excerpt,.shortcode-recent-blogs > li .bottom-detail,ul.list-posts li  .short-content,.woocommerce .widget_price_filter .price_slider_amount .price_label,
	/* BỘ BLOG DATE,COUNT,COMMENT */
	ul.list-posts li .post-info-meta .author,ul.list-posts li .post-info-meta,
	/* ALL WIDGET UL UL LI A */
	.widget_categories ul li a,
	.widget_nav_menu div ul li a, 
	.widget_pages ul li a,
	.widget_product_categories ul li a,
	.widget_recent_entries ul li a,
	.widget_custom_pages ul li  a,
	/* PAGER */
	.page_navi .wp-pagenavi span, .page_navi .wp-pagenavi a, .page_navi > .nav-content > .pager span span,
	.page_navi > .nav-content a.first span span, .page_navi > .nav-content a.previous span span, .page_navi > .nav-content a.next span span, .page_navi > .nav-content a.last span span,
	body.woocommerce nav.woocommerce-pagination ul li span.current,
	body.woocommerce-page nav.woocommerce-pagination ul li span.current,
	body.woocommerce #content nav.woocommerce-pagination ul li span.current,
	body.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
	body.woocommerce nav.woocommerce-pagination ul li a:hover,
	body.woocommerce-page nav.woocommerce-pagination ul li a:hover,
	body.woocommerce #content nav.woocommerce-pagination ul li a:hover,
	body.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
	body.woocommerce nav.woocommerce-pagination ul li a:focus,
	body.woocommerce-page nav.woocommerce-pagination ul li a:focus,
	body.woocommerce #content nav.woocommerce-pagination ul li a:focus,
	body.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
	body.woocommerce nav.woocommerce-pagination ul li a.next,
	body.woocommerce-page nav.woocommerce-pagination ul li a.next,
	body.woocommerce #content nav.woocommerce-pagination ul li a.next,
	body.woocommerce nav.woocommerce-pagination ul li a, body.woocommerce-page nav.woocommerce-pagination ul li a, body.woocommerce #content nav.woocommerce-pagination ul li a, body.woocommerce-page #content nav.woocommerce-pagination ul li a, body.woocommerce nav.woocommerce-pagination ul li span, body.woocommerce-page nav.woocommerce-pagination ul li span, body.woocommerce #content nav.woocommerce-pagination ul li span, body.woocommerce-page #content nav.woocommerce-pagination ul li span,
	/* TEXT IN INPUT */
	#content .woocommerce .cart-collaterals .shipping_calculator select, .woocommerce #content .cart-collaterals .shipping_calculator select, .woocommerce-page #content .cart-collaterals .shipping_calculator select,
	/* END TEXT IN PUT */
	.woocommerce form .form-row#ship-to-different-address label.checkbox,.woocommerce #payment ul.payment_methods li label, .woocommerce-page #payment ul.payment_methods li label,
	#portfolio-galleries .portfolio-filter li a,.cart_dropdown .total span.title,.woocommerce .widget_shopping_cart .total strong, .woocommerce-page .widget_shopping_cart .total strong, .woocommerce-page.widget_shopping_cart .total strong, .woocommerce.widget_shopping_cart .total strong,.widget-container .wd-categories li a,.product_list_widget li .quantity,.widget_tag_cloud .tagcloud a,.widget_product_tag_cloud .tagcloud a,body.woocommerce .woocommerce-ordering select, body.woocommerce-page .woocommerce-ordering select,.widget_woothemes_features .feature-content,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li a, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a, .woocommerce-page div.product .woocommerce-tabs ul.tabs li a,.woocommerce .widget_layered_nav ul small.count, .woocommerce-page .widget_layered_nav ul small.count,.chosen-container-single .chosen-single,.subscribe-email input,.widget_recent_post_slider .entry-desc,.shortcode-recent-blogs-slider.single-item .view-more
	{
		color:<?php echo $wd_text_color; ?>;
	}
	
	/* FOR DESCRIPTION GRID LIST */
	html .woocommerce #main_content .products div[itemprop="description"], html body #main_content .products div[itemprop="description"], html body.woocommerce-page #main_content .products div[itemprop="description"],html .woocommerce #main_content .products div[itemprop="description"], html body #main_content .products div[itemprop="description"], html body.woocommerce-page #main_content .products div[itemprop="description"]{
		color:<?php echo $wd_text_color; ?>;
	}
	
	.price_slider_wrapper a:before{
		background-color:<?php echo $wd_text_color; ?>;
	}
	
	.wd-blog-ft .title a,.widget_recent_post_slider .entry-title > a{
		color:<?php echo wd_calc_color($wd_text_color ,"#303030") ?>;
	}
	
	html .woocommerce .products .product .heading-title a{
		color:<?php echo $wd_product_name_color; ?>;
	}
	
	.cart_dropdown ul.cart_list li .cart_item_wrapper > a:hover{
		color:<?php echo $wd_header_top_background; ?>;
	}
	.related > .title,
	#crumbs .current,#header .nav > .main-menu > ul.menu > li a.title,ul.list-posts li .post-title .heading-title,#footer a.block-control:before,
	/* FILLTER COLOR SIZE */
	.woocommerce .widget_layered_nav_filters ul li.chosen a, .woocommerce-page .widget_layered_nav_filters ul li.chosen a,.woocommerce .widget-container.widget_layered_nav ul li.chosen a, .woocommerce-page .widget_layered_nav ul li.chosen a,.woocommerce-page .widget_layered_nav ul li a:hover,.woocommerce .widget_layered_nav_filters ul li.chosen a, .woocommerce-page .widget_layered_nav_filters ul li a:hover,.woocommerce .widget-container.widget_layered_nav ul li.chosen a,
	
	/* PAGER */
	.page_navi .wp-pagenavi span:hover, .page_navi .wp-pagenavi a:hover,.page_navi > .nav-content > .pager:hover span span,.page_navi > .nav-content .next-phrase:hover,.page_navi > .nav-content .previous-phrase:hover,.page_navi > .nav-content a.first:hover span span,.page_navi > .nav-content a.previous:hover span span,.page_navi > .nav-content a.next:hover span span,.page_navi > .nav-content a.last:hover span span,.page_navi .wp-pagenavi span.current,.page_navi > .nav-content > .pager.current span span,
	body.woocommerce nav.woocommerce-pagination ul li span.current,
	body.woocommerce-page nav.woocommerce-pagination ul li span.current,
	body.woocommerce #content nav.woocommerce-pagination ul li span.current,
	body.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
	body.woocommerce nav.woocommerce-pagination ul li a:hover,
	body.woocommerce-page nav.woocommerce-pagination ul li a:hover,
	body.woocommerce #content nav.woocommerce-pagination ul li a:hover,
	body.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
	body.woocommerce nav.woocommerce-pagination ul li a:focus,
	body.woocommerce-page nav.woocommerce-pagination ul li a:focus,
	body.woocommerce #content nav.woocommerce-pagination ul li a:focus,
	body.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
	/* ALL CATEGORIES UL LI */
	.widget_categories ul li > a:hover,
	.widget_nav_menu ul li > a:hover,
	.widget_pages ul li > a:hover,
	.widget_custom_pages ul li > a:hover,
	.widget_product_categories ul li > a:hover,
	.widget_pages ul li.current_page_item > a,
	.widget_product_categories ul li.current-cat > a,
	.widget_nav_menu ul li.current_page_item > a,
	.widget_categories li.current-cat > a,
	.widget_custom_pages ul li.current_page_item > a,
	/* SPECIAL WIDGET AREA */
	ul.special-category-widget-area .widget_price_filter h3.widget-title.heading-title,ul.special-category-widget-area .widget_layered_nav h3.widget-title.heading-title,ul.special-category-widget-area .widget_wd_pc_color_nav h3.widget-title.heading-title,
	/* END SPECIAL */
	#customer_login h2,html .woocommerce #customer_login.col2-set .col-1 label,html .woocommerce-page #customer_login.col2-set .col-1 label,
	html .woocommerce #content table.shop_table thead th, 
	html .woocommerce-page #content table.shop_table thead th,
	#content .woocommerce table.shop_table thead th,
	.woocommerce #content table.shop_table tbody tr.cart_item .product-thumbnail.product-name a:hover, 
	.woocommerce-page #content table.shop_table tbody tr.cart_item .product-thumbnail.product-name a:hover,
	#content .woocommerce table.shop_table tbody tr.cart_item .product-thumbnail.product-name a:hover,
	.woocommerce #content table.shop_table tbody tr.cart_item td.product-subtotal .amount, 
	.woocommerce-page #content table.shop_table tbody tr.cart_item td.product-subtotal .amount,
	.woocommerce #content table.shop_table tbody tr.cart_item td.product-price .amount, 
	.woocommerce-page #content table.shop_table tbody tr.cart_item td.product-price .amount,
	#content .woocommerce  table.shop_table tbody tr.cart_item td.product-price .amount, 
	#content .woocommerce table.shop_table tbody tr.cart_item td.product-subtotal .amount,

	#content .woocommerce .cart-collaterals .shipping_calculator p, .woocommerce #content .cart-collaterals .shipping_calculator p, .woocommerce-page #content .cart-collaterals .shipping_calculator p,#content .woocommerce .cart-collaterals .cart_totals > table tr.total .amount,
	.woocommerce #content .cart-collaterals .cart_totals > table tr.total .amount,
	.woocommerce-page #content .cart-collaterals .cart_totals > table tr.total .amount,.woocommerce td.product-name dl.variation dt, .woocommerce-page td.product-name dl.variation dt,
	body #content .woocommerce .cart-collaterals .cross-sells h2, .woocommerce #content .cart-collaterals .cross-sells h2, .woocommerce-page #content .cart-collaterals .cross-sells h2,
	.wd_product_categories a:hover,div.product .tagcloud a:hover,html .woocommerce-page #content div.product .add_new_review a:hover,html .woocommerce div.product .add_new_review:hover,#entry-author-info #author-description .author-name [rel^=author],.short-description-title,.woocommerce .social_sharing.second .social_icon > div.pinterest span, .woocommerce-page .social_sharing.second .social_icon > div.pinterest span,.woocommerce .social_sharing.second .social_icon > div.mail span, .woocommerce-page .social_sharing.second .social_icon > div.mail span,.wd_product_categories span,.tagcloud .tag_heading,
	html .woocommerce div.product form.cart .single_add_to_cart_wrapper .quantity-text, html .woocommerce #content div.product form.cart .single_add_to_cart_wrapper .quantity-text, html .woocommerce-page div.product form.cart .single_add_to_cart_wrapper .quantity-text, html .woocommerce-page #content div.product form.cart .single_add_to_cart_wrapper .quantity-text, html .page div.product form.cart .single_add_to_cart_wrapper .quantity-text,body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover,body .woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover,body.woocommerce-page div.product ul.nav-tabs li.active a h2,body.woocommerce div.product ul.nav-tabs li.active a h2,body.woocommerce-page div.product ul.nav-tabs li:hover a h2,body.woocommerce div.product ul.nav-tabs li:hover a h2,.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active a,
	html .woocommerce div.product form.cart .variations label, 
	html .woocommerce #content div.product form.cart .variations label, 
	html .woocommerce-page div.product form.cart .variations label, 
	html .woocommerce-page #content div.product form.cart .variations label,
	html .page div.product form.cart .variations label ,#footer .first-footer-widget-area a:hover, #footer .first-footer-widget-area a:hover, #footer .subscriptions-footer-widget-area a:hover,
	#comments  .wd_comment_title .heading-title,#respond .wd_respond_title .heading-title,.related .wd_title_related .heading-title,#respond #commentform .label,
	.woocommerce form .form-row label, .woocommerce-page form .form-row label,body .woocommerce #collapse-login-regis form.login .lost_password:hover, body.woocommerce-page #collapse-login-regis form.login .lost_password:hover,html .woocommerce .after_checkout_form form.checkout_coupon .question_coupon, 
	html .woocommerce-page .after_checkout_form form.checkout_coupon .question_coupon,.woocommerce #payment ul.payment_methods li.active label, .woocommerce-page #payment ul.payment_methods li.active label,
	body .woocommerce table.shop_table tbody tr.checkout_table_item td.product-price, body.woocommerce-page table.shop_table tbody tr.checkout_table_item td.product-price,
	body .woocommerce table.shop_table tbody tr.checkout_table_item td.product-total, body.woocommerce-page table.shop_table tbody tr.checkout_table_item td.product-total,body div.pp_woocommerce .pp_nav,body div.pp_woocommerce .pp_description,
	.nav-tabs > .active > a, .nav-tabs > .active > a:hover,#portfolio-galleries .portfolio-filter li a:hover,#portfolio-galleries .portfolio-filter li.active a,.wpcf7,strong,.woocommerce .featured_product_wrapper .featured_product_wrapper_meta .heading-title,.heading-title-block h1,.heading-title-block h2,.comment .comment-author,.order_table_item .amount,#order_review .amount,
	#content .woocommerce .order_details tfoot td, .woocommerce #content .order_details tfoot td, .woocommerce-page #content .order_details tfoot td,.widget-container .wd-categories li a:hover,.widget_tag_cloud .tagcloud a:hover,.widget_product_tag_cloud .tagcloud a:hover,#content .woocommerce .cart-collaterals .cart_totals > table tr.total th, .woocommerce #content .cart-collaterals .cart_totals > table tr.total th, .woocommerce-page #content .cart-collaterals .cart_totals > table tr.total th,.widget-container.widget_recent_entries a:hover,
	body.woocommerce-page form.checkout table.shop_table tfoot .total th, body .woocommerce table.shop_table tfoot .total th,
	.woocommerce #content table.shop_table.wishlist_table tr td, .woocommerce-page #content table.shop_table.wishlist_table tr td, #content .woocommerce table.shop_table.wishlist_table tr td,#yith-wcwl-form h2,body .wd_banner_top_main_content .wd_banner_top_main_content_wrapper span,
	html .woocommerce .woocommerce-breadcrumb .brn_arrow:after,#crumbs .brn_arrow:after,
	/* ICON BLOG */
	html .woocommerce-page #content div.product .add_new_review:before,html .woocommerce div.product .add_new_review:before,.widget_customrecent  .author:before,.widget_multitab  ul.tabs-post-list li  .author:before,.widget_multitab .tabs-comments-list .author:before,.widget_recent_comments_custom .author:before,ul.list-posts li .post-info-meta .author:before,.single-content .post-info-meta .author:before,ul.list-posts li .post-info-meta .comments-count:before,.single-content .post-info-meta .comments-count:before,.single-content .post-info-meta .cat-links:after,
	/* BỘ RECEN BLOG VÀ TAB */
	.widget_customrecent  .comment-number:before,.widget_multitab  ul.tabs-post-list li  .comment-number:before,
	/* ALL BLOG DATE,COUNT COMMENT,.. */
	.shortcode-recent-blogs > li .bottom-detail .author:before,.shortcode-recent-blogs > li .bottom-detail .comments-count:before,ul.list-posts li .post-info-meta .cat-links:before,
	/* END BLOG DATE,COUNT COMMENT,.. */
	ul.nav-tabs li a:hover h2,ul.nav-tabs li.active a h2,ul.nav-tabs li a:hover,ul.nav-tabs li.active a,.feature.shortcode .feature_title a,#footer .widget_subscriptions .widget_title_wrapper h3,.wd-title,
	/* PRODUCT WIDGET LIST UL LI */
	ul.product_list_widget li a, html .woocommerce ul.product_list_widget li a, html .woocommerce-page ul.product_list_widget li a, ul.cart_list li a, html .woocommerce ul.cart_list li a, html .woocommerce-page ul.cart_list li a, .widget_popular ul li .title a, html .woocommerce .widget_popular ul li .title a, .widget_hot_product ul li .title a, html .woocommerce .widget_hot_product ul li .title a, .widget_top_rated_products ul.product_list_widget li > a, html .woocommerce .widget_top_rated_products ul.product_list_widget li > a, .widget_recent_reviews ul.product_list_widget li > a, html .woocommerce .widget_recent_reviews ul.product_list_widget li > a,.woocommerce-page .widget_layered_nav ul li a,
	.wd-title-icon:hover i.fa:before
	{
		color:<?php echo $wd_theme_color_primary; ?>;
	}
	
	.woocommerce > .featured_product_slider_wrapper .slider_control .prev:after,.featured_product_slider_wrapper .slider_control .prev:after,.woocommerce > .featured_categories_slider_wrapper .slider_control .prev:after ,.featured_categories_slider_wrapper .slider_control .prev:after,.woocommerce > .featured_product_slider_wrapper .slider_control .next:after,.featured_product_slider_wrapper .slider_control .next:after,.woocommerce > .featured_categories_slider_wrapper .slider_control .next:after,.featured_categories_slider_wrapper .slider_control .next:after,
	.woocommerce > .featured_product_slider_wrapper.shortcode_slider .slider_control .next:after,.featured_product_slider_wrapper.shortcode_slider .slider_control .next:after,
	.woocommerce > .featured_product_slider_wrapper.shortcode_slider .slider_control .prev:after,.featured_product_slider_wrapper.shortcode_slider .slider_control .prev:after,
	.rev_slider_wrapper .tp-leftarrow.default:after,body * .ls-nav-prev:after,.rev_slider_wrapper .tp-rightarrow.default:after,body * .ls-nav-next:after,
	body.woocommerce .upsell_wrapper .upsell_control > a#product_upsell_prev:after,.products-tabs-wrapper .related.products .related_control #product_related_prev:after,body.woocommerce .upsell_wrapper .upsell_control > a#product_upsell_next:after,.products-tabs-wrapper .related.products .related_control #product_related_next:after,.shortcode-recent-blogs-slider .prev:after,.shortcode-recent-blogs-slider .next:after,.related .related_post_slider a.prev:after,.related .portfolio_project_slider a.prev:after,.related .related_post_slider a.next:after,.related .portfolio_project_slider a.next:after{
		background-color:<?php echo $wd_button_slider_background; ?>;
	}
	
	.woocommerce > .featured_product_slider_wrapper .slider_control .prev:before,.featured_product_slider_wrapper .slider_control .prev:before,.woocommerce > .featured_categories_slider_wrapper .slider_control .prev:before ,.featured_categories_slider_wrapper .slider_control .prev:before,.woocommerce > .featured_product_slider_wrapper .slider_control .next:before,.featured_product_slider_wrapper .slider_control .next:before,.woocommerce > .featured_categories_slider_wrapper .slider_control .next:before,.featured_categories_slider_wrapper .slider_control .next:before,
	.woocommerce > .featured_product_slider_wrapper.shortcode_slider .slider_control .next:before,.featured_product_slider_wrapper.shortcode_slider .slider_control .next:before,
	.woocommerce > .featured_product_slider_wrapper.shortcode_slider .slider_control .prev:before,.featured_product_slider_wrapper.shortcode_slider .slider_control .prev:before,
	.rev_slider_wrapper .tp-leftarrow.default:before,body * .ls-nav-prev:before,.rev_slider_wrapper .tp-rightarrow.default:before,body * .ls-nav-next:before,body.woocommerce .upsell_wrapper .upsell_control > a#product_upsell_next:before,.products-tabs-wrapper .related.products .related_control #product_related_next:before,body.woocommerce .upsell_wrapper .upsell_control > a#product_upsell_prev:before,.products-tabs-wrapper .related.products .related_control #product_related_prev:before,.shortcode-recent-blogs-slider .prev:before,.shortcode-recent-blogs-slider .next:before,.related .related_post_slider a.prev:before,.related .portfolio_project_slider a.prev:before,.related .related_post_slider a.next:before,.related .portfolio_project_slider a.next:before{
		color:<?php echo $wd_button_slider_icon; ?>;
	}
	.woocommerce > .featured_product_slider_wrapper .slider_control .prev:after,.featured_product_slider_wrapper .slider_control .prev:after,.woocommerce > .featured_categories_slider_wrapper .slider_control .prev:after ,.featured_categories_slider_wrapper .slider_control .prev:after,.woocommerce > .featured_product_slider_wrapper .slider_control .next:after,.featured_product_slider_wrapper .slider_control .next:after,.woocommerce > .featured_categories_slider_wrapper .slider_control .next:after,.featured_categories_slider_wrapper .slider_control .next:after,
	.woocommerce > .featured_product_slider_wrapper.shortcode_slider .slider_control .next:after,.featured_product_slider_wrapper.shortcode_slider .slider_control .next:after,
	.woocommerce > .featured_product_slider_wrapper.shortcode_slider .slider_control .prev:after,.featured_product_slider_wrapper.shortcode_slider .slider_control .prev:after,
	.rev_slider_wrapper .tp-leftarrow.default:after,body * .ls-nav-prev:after,.rev_slider_wrapper .tp-rightarrow.default:after,body * .ls-nav-next:after,
	body.woocommerce .upsell_wrapper .upsell_control > a#product_upsell_prev:after,.products-tabs-wrapper .related.products .related_control #product_related_prev:after,body.woocommerce .upsell_wrapper .upsell_control > a#product_upsell_next:after,.products-tabs-wrapper .related.products .related_control #product_related_next:after,.shortcode-recent-blogs-slider .prev:after,.shortcode-recent-blogs-slider .next:after,.related .related_post_slider a.prev:after,.related .portfolio_project_slider a.prev:after,.related .related_post_slider a.next:after,.related .portfolio_project_slider a.next:after{
		opacity:0.2;filter:alpha(opacity=20) !important;
	}
	.woocommerce > .featured_product_slider_wrapper .slider_control .prev:hover:after,.featured_product_slider_wrapper .slider_control .prev:hover:after,.woocommerce > .featured_categories_slider_wrapper .slider_control .prev:hover:after ,.featured_categories_slider_wrapper .slider_control .prev:hover:after,.woocommerce > .featured_product_slider_wrapper .slider_control .next:hover:after,.featured_product_slider_wrapper .slider_control .next:hover:after,.woocommerce > .featured_categories_slider_wrapper .slider_control .next:hover:after,.featured_categories_slider_wrapper .slider_control .next:hover:after,
	.woocommerce > .featured_product_slider_wrapper.shortcode_slider .slider_control .next:hover:after,.featured_product_slider_wrapper.shortcode_slider .slider_control .next:hover:after,
	.woocommerce > .featured_product_slider_wrapper.shortcode_slider .slider_control .prev:hover:after,.featured_product_slider_wrapper.shortcode_slider .slider_control .prev:hover:after,
	.rev_slider_wrapper .tp-leftarrow.default:hover:after,body * .ls-nav-prev:hover:after,.rev_slider_wrapper .tp-rightarrow.default:hover:after,body * .ls-nav-next:hover:after,body.woocommerce .upsell_wrapper .upsell_control > a#product_upsell_prev:hover:after,.products-tabs-wrapper .related.products .related_control #product_related_prev:hover:after,body.woocommerce .upsell_wrapper .upsell_control > a#product_upsell_next:hover:after,.products-tabs-wrapper .related.products .related_control #product_related_next:hover:after,.shortcode-recent-blogs-slider .prev:hover:after,.shortcode-recent-blogs-slider .next:hover:after,.related .related_post_slider a.prev:hover:after,.related .portfolio_project_slider a.prev:hover:after,.related .related_post_slider a.next:hover:after,.related .portfolio_project_slider a.next:hover:after
	{
		opacity:1;filter:alpha(opacity=100)!important;
	}
	
	button.button, a.button, input[type^=submit], html .woocommerce a.button, html .woocommerce button.button, html .woocommerce input.button, html .woocommerce #respond input#submit, .woocommerce #content input.button, html .woocommerce-page a.button, html .woocommerce-page button.button, .woocommerce-page input.button, html .woocommerce-page #respond input#submit, html .woocommerce-page #content input.button, html .woocommerce-page #content input.button, html .woocommerce #content table.cart input.button, html input.button,
	
	html .cart_dropdown.drop_down_container a.button.checkout,.woocommerce .woocommerce-message a.button, .woocommerce-page .woocommerce-message a.button, .woocommerce-message a.button,#comments .commentlist li .divcomment .divcomment-inner .reply a,html .woocommerce #customer_login.col2-set .col-1 form.login input.button:hover, html .woocommerce-page #customer_login.col2-set .col-1 form.login input.button:hover,body .wd_logout.btn,#footer .widget_subscriptions button.button,.woocommerce #payment #place_order, .woocommerce-page #payment #place_order,table.compare-list tr.remove td > a{
		background-color:<?php echo $wd_button_background; ?>;
		color:<?php echo $wd_button_text ; ?>;
	}
	
	.woocommerce #content input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page #content input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover,.woocommerce .woocommerce-message a.button:hover, .woocommerce-page .woocommerce-message a.button:hover, .woocommerce-message a.button:hover,
	
	#comments .commentlist li .divcomment .divcomment-inner .reply a:hover,
	html .woocommerce #customer_login.col2-set .col-1 form.login input.button, html .woocommerce-page #customer_login.col2-set .col-1 form.login input.button,body .wd_logout.btn:hover,#footer .widget_subscriptions button.button:hover,.woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover,table.compare-list tr.remove td > a:hover
	{
		background-color:<?php echo $wd_button_background_hover ; ?>;
		color:<?php echo $wd_button_text_hover ; ?>;
	}
	
	.cart_dropdown .go_to_shopping_cart a{
		background-color:<?php echo $wd_theme_color_primary; ?>;
		color:<?php echo $wd_button_text_hover ; ?>;
	}
	.wd_button_loadmore_wrapper .btn_load_more:hover,.shortcode-recent-blogs-slider.single-item .view-more:hover{
		color:<?php echo wd_calc_color($wd_theme_color_primary,"#323232") ?>;
		border-color:<?php echo wd_calc_color($wd_theme_color_primary,"#323232") ?>;
	}
	
	/* BORDER FOR ALL WIDGET SIDERBAR */
	.widget-container > ul,.woocommerce .widget_layered_nav ul, .woocommerce-page .widget_layered_nav ul,.widget-container.widget_multitab #popular-tab,.widget-container #wp-calendar,
	.widget-container .features,body .widget-container .widget_shopping_cart_content,html .woocommerce .widget_shopping_cart .total,html .woocommerce-page .widget_shopping_cart .total,.widget_shopping_cart .total,.widget_shopping_cart .total,.widget-container #searchform,.widget-container form[id^="searchform-"] ,.widget-container.widget_text  .wid-text,
	.widget_price_filter > form,.widget-container .alphabet-products,.widget_product_tag_cloud .tagcloud,
	.widget_recent_post_slider .wd_recent_post_widget_wrapper,.widget_tag_cloud .tagcloud,.widget_flickr .wrap,.widget_social .social-icons,.widget_subscriptions input.subscribe_email,.widget_subscriptions .subscribe_widget,.widget-container .testimonials-list,.widget_nav_menu div,.widget-container,.widget_multitab .tab-content ul,.accordion-tabs.wd-widget-multitabs-accordion .accordion-inner,.woocommerce ul.special-category-widget-area > li,.woocommerce ul.special-category-widget-area > li:first-child,
	/* PAGER */
	.page_navi > .nav-content a.first span span, .page_navi > .nav-content a.previous span span, .page_navi > .nav-content a.next span span, .page_navi > .nav-content a.last span span,
	body.woocommerce nav.woocommerce-pagination ul li a,
	body.woocommerce-page nav.woocommerce-pagination ul li a,
	body.woocommerce #content nav.woocommerce-pagination ul li a,
	body.woocommerce-page #content nav.woocommerce-pagination ul li a,
	body.woocommerce nav.woocommerce-pagination ul li a.prev, body.woocommerce-page nav.woocommerce-pagination ul li a.prev, body.woocommerce #content nav.woocommerce-pagination ul li a.prev, body.woocommerce nav.woocommerce-pagination ul li a.next, body.woocommerce-page nav.woocommerce-pagination ul li a.next, body.woocommerce #content nav.woocommerce-pagination ul li a.next,
	body.woocommerce nav.woocommerce-pagination ul li span,
	body.woocommerce-page nav.woocommerce-pagination ul li span,
	body.woocommerce #content nav.woocommerce-pagination ul li span,
	body.woocommerce-page #content nav.woocommerce-pagination ul li span,
	.page_navi .wp-pagenavi a.previouspostslink,.page_navi .wp-pagenavi a.nextpostslink,
	.page_navi,body.woocommerce nav.woocommerce-pagination ul li a.next, body.woocommerce-page nav.woocommerce-pagination ul li a.next, body.woocommerce #content nav.woocommerce-pagination ul li a.next,
	body.woocommerce nav.woocommerce-pagination, 
	body.woocommerce-page nav.woocommerce-pagination, 
	body.woocommerce #content nav.woocommerce-pagination, 
	body.woocommerce-page #content nav.woocommerce-pagination,
	/* END PAGER */
	.tags_social,
	.track_order p.note,.lost_reset_password p.note,
	#customer_login h2,
	div.list_carousel .slider_control > a.prev,div.list_carousel .slider_control > a.next,
	body.page div.product div.images div.thumbnails a,
	body.woocommerce div.product div.images div.thumbnails a,
	body.woocommerce-page div.product div.images div.thumbnails a,
	body.woocommerce #content div.product div.images div.thumbnails a,
	body.woocommerce-page #content div.product div.images div.thumbnails a,
	body.page div.product div.images a.woocommerce-main-image img,
	body.woocommerce div.product div.images a.woocommerce-main-image img,
	body.woocommerce-page div.product div.images a.woocommerce-main-image img,
	body.woocommerce #content div.product div.images a.woocommerce-main-image img,
	body.woocommerce-page #content div.product div.images a.woocommerce-main-image img,
	body.woocommerce-page #content .shop_table.my_account_orders tbody tr td.order-number,
	body #content .woocommerce .shop_table.my_account_orders tbody tr td.order-actions,
	body.woocommerce-page #content .shop_table.my_account_orders tbody tr td.order-actions,.single-content .single-post,
	#content .woocommerce .order_details .order_table_item td, .woocommerce #content .order_details .order_table_item td, .woocommerce-page #content .order_details .order_table_item td,#content .woocommerce > #order_review table td, .woocommerce #content .woocommerce > #order_review table td, .woocommerce-page #content .woocommerce > #order_review table td,.shopping-cart .cart_dropdown,#content .woocommerce table.cart a.remove, .woocommerce-page #content table.cart a.remove, .woocommerce #content table.cart a.remove, .woocommerce-page #content table.cart a.remove,
	
	html body #container-main .woocommerce .style-3 .products .product .product_thumbnail_wrapper a,
	html body.woocommerce #container-main .style-3 .products .product .product_thumbnail_wrapper a, 
	html body.woocommerce-page #container-main .style-3 .products .product .product_thumbnail_wrapper a
	{
		border-color:<?php echo $wd_border_color ; ?>
	}
	
	body #content .woocommerce .shop_table.my_account_orders tbody tr.last td ,
	body.woocommerce-page #content .shop_table.my_account_orders tbody tr.last td{
		border-bottom-color:<?php echo $wd_border_color ; ?> !important;
	}
	
	html .woocommerce #content table.shop_table thead th, 
	html .woocommerce-page #content table.shop_table thead th,
	#content .woocommerce table.shop_table thead th,
	html .page div.product .product_title,
	html .woocommerce div.product .product_title,
	html.woocommerce #content div.product .product_title,
	html .woocommerce-page div.product .product_title,
	html.woocommerce-page #content div.product .product_title,
	html .woocommerce #content table.shop_table thead th, html .woocommerce-page #content table.shop_table thead th{
		border-bottom-color:<?php echo $wd_theme_color_primary; ?> !important;
	}
	
	#container .gridlist-toggle a#list,#container .gridlist-toggle a#grid,#comments .commentlist li .divcomment .divcomment-inner .comment-meta:before,
	
	/* CHECK OUT */
	body form.checkout .accordion-heading a.accordion-toggle.collapsed,body #accordion-checkout-details .accordion-heading a.accordion-toggle.collapsed,body.error404 .alert-info,.shopping-cart .cart_dropdown ul.cart_list li a.remove,html .woocommerce #reviews #comments ol.commentlist li .comment_container, 
	html .woocommerce-page #reviews #comments ol.commentlist li .comment_container,#content .woocommerce table.cart a.remove, .woocommerce-page #content table.cart a.remove, .woocommerce #content table.cart a.remove, .woocommerce-page #content table.cart a.remove,.woocommerce > .featured_product_slider_wrapper.shortcode_slider .slider_control .next,.featured_product_slider_wrapper.shortcode_slider .slider_control .next,.woocommerce > .featured_product_slider_wrapper.shortcode_slider .slider_control .prev,.featured_product_slider_wrapper.shortcode_slider .slider_control .prev,
	body * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a,#ls-global * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a,html * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a,.tp-bullets.simplebullets.round .bullet
	{
		background-color:<?php echo $wd_border_color ; ?>;
	}
	
	.woocommerce .social_sharing .social_icon > div a:hover img, .woocommerce-page .social_sharing .social_icon > div a:hover img,.woocommerce .social_sharing.second .social_icon > div.pinterest a:hover:before, .woocommerce-page .social_sharing.second .social_icon > div.pinterest a:hover:before,.woocommerce > .featured_product_slider_wrapper.shortcode_slider .slider_control .next:hover,.featured_product_slider_wrapper.shortcode_slider .slider_control .next:hover,.woocommerce > .featured_product_slider_wrapper.shortcode_slider .slider_control .prev:hover,.featured_product_slider_wrapper.shortcode_slider .slider_control .prev:hover{
		background-color:<?php echo $wd_border_color_hover ; ?>;
	}
	
	div.list_carousel .slider_control > a.next:before,div.list_carousel .slider_control > a.next:after,div.list_carousel .slider_control > a.prev:before,div.list_carousel .slider_control > a.prev:after{
		color:<?php echo $wd_border_color ; ?>;
	}
	
	.testimonial-item,#entry-author-info{
		background:<?php echo $wd_testimonial_background ; ?>;
	}
	
	/* PRODUCT */
	html .woocommerce .related.products .products .product:hover .product_item_wrapper, 
	html .woocommerce-page .related.products .products .product:hover .product_item_wrapper,
	html .woocommerce .upsells.products .products .product:hover .product_item_wrapper, 
	html .woocommerce-page .upsells.products .products .product:hover .product_item_wrapper,
	html .woocommerce .cross-sells .products .product:hover .product_item_wrapper, 
	html .woocommerce-page .cross-sells .products .product:hover .product_item_wrapper,
	.body-wrapper #main_content .products.grid .product:hover .product_item_wrapper,
	.woocommerce .body-wrapper #main_content .products.grid .product:hover .product_item_wrapper,
	.woocommerce-page .body-wrapper #main_content .products.grid .product:hover .product_item_wrapper,
	html body .woocommerce .products .product:hover .product_item_wrapper, 
	html .woocommerce-page .products .product:hover .product_item_wrapper,
	html body.woocommerce .products .product:hover .product_item_wrapper, 
	html .woocommerce-page .products .product:hover .product_item_wrapper,
	html body #container-main .woocommerce .style-2 .products .product .product_thumbnail_wrapper a:hover,
	html body.woocommerce #container-main .style-2 .products .product .product_thumbnail_wrapper a:hover, 
	html body.woocommerce-page #container-main .style-2 .products .product .product_thumbnail_wrapper a:hover,
	/* END PRODUCT */
	html .woocommerce .products .product .list_add_to_cart_wrapper, html .woocommerce-page .products .product .list_add_to_cart_wrapper,.shortcode-recent-blogs > li .bottom-detail,
	body #content .woocommerce .cart-collaterals .cross-sells h2, .woocommerce #content .cart-collaterals .cross-sells h2, .woocommerce-page #content .cart-collaterals .cross-sells h2,.related > .title,div.product .short-description,.woocommerce .social_sharing.second, .woocommerce-page .social_sharing.second,html .woocommerce .products .product.wd_product_feature, html .woocommerce-page .products .product.wd_product_feature,.woocommerce .products .product_upsells ul li a:hover,body .woocommerce #payment div.payment_box,body.woocommerce-page #payment div.payment_box,html .woocommerce .after_checkout_form form.checkout_coupon, 
	html .woocommerce-page .after_checkout_form form.checkout_coupon,
	body .woocommerce #payment ul.payment_methods,body.woocommerce-page #payment ul.payment_methods,
	body.woocommerce #content form.checkout table.shop_table td, body.woocommerce-page #content form.checkout table.shop_table td, body .woocommerce form.cart table.shop_table td,
	/* BORDER DEFALT */
	.wd_tini_account_wrapper .form_drop_down:before,
	#content .woocommerce .cart-collaterals .coupon_wrapper input#coupon_code, .woocommerce #content .cart-collaterals .coupon_wrapper input#coupon_code, .woocommerce-page #content .cart-collaterals .coupon_wrapper input#coupon_code,html .woocommerce #content table.shop_table thead th, 
	html .woocommerce-page #content table.shop_table thead th,
	#content .woocommerce table.shop_table thead th,
	.woocommerce #content table.shop_table tbody tr.cart_item td, 
	.woocommerce-page #content table.shop_table tbody tr.cart_item td,
	.woocommerce #content table.shop_table tbody tr.cart_item td:first-child, 
	.woocommerce-page #content table.shop_table tbody tr.cart_item td:first-child, 
	#content .woocommerce table.shop_table tbody tr.cart_item td:first-child,
	#content .woocommerce table.shop_table tbody tr.cart_item td,.woocommerce #content table.shop_table tbody td.actions, .woocommerce-page #content table.shop_table tbody td.actions, #content .woocommerce table.shop_table tbody td.actions,#portfolio-galleries .portfolio-filter,.wd-heading-title,ul.list-posts li .post-info-meta,
	.cart_dropdown ul.cart_list,html .woocommerce #main_content .products.list .product .product_thumbnail_wrapper:hover, html .woocommerce-page #main_content .products.list .product .product_thumbnail_wrapper a:hover
	{
		border-color:<?php echo wd_calc_color($wd_border_color,"#141414",false) ?>;
	}
	
	html .woocommerce #main_content .products.list .product .product_thumbnail_wrapper:hover, 
	html .woocommerce-page #main_content .products.list .product .product_thumbnail_wrapper:hover,.related > .title:before,
	
	body #main_content .products.grid,
	body.woocommerce  #main_content .products.grid,body #main_content .woocommerce .products.list,
	body.woocommerce-page #main_content .products.grid,body.woocommerce-page #main_content .products.list
	{
		border-color:<?php echo wd_calc_color($wd_border_color,"#141414",false) ?>;
	}
	
	#comments .commentlist li .divcomment .divcomment-inner .comment-meta:before,.heading-title-block:before,.featured_product_wrapper_meta .wd_title_shortcode:before,.shortcode-recent-blogs-slider .wd-blog-title:before,.tabbable .nav-tabs:before,.woocommerce .featured_product_slider_wrapper .featured_product_slider_wrapper_meta .wd_title_shortcode:before,.woocommerce-page .featured_product_slider_wrapper .featured_product_slider_wrapper_meta .wd_title_shortcode:before,.woocommerce .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta .wd_title_shortcode:before, .woocommerce-page .featured_categories_slider_wrapper .featured_product_slider_wrapper_meta .wd_title_shortcode:before,
	
	.related .wd_title_related:before,#customer_login .wd-title-account:before,#comments .wd_comment_title:before ,#respond .wd_respond_title:before,body .accordion-heading:before,
	body.woocommerce #content div.product .woocommerce-tabs ul.tabs:before,body .woocommerce div.product .woocommerce-tabs ul.tabs:before,body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs:before,body.woocommerce-page div.product .woocommerce-tabs ul.tabs:before,body.woocommerce-page div.product ul.nav-tabs:before,body.woocommerce div.product ul.nav-tabs:before,
	#portfolio-galleries .portfolio-filter:before,
	#portfolio-galleries .portfolio-filter li.active:after,
	#portfolio-galleries .portfolio-filter li.active:before,
	body #content .woocommerce .cart-collaterals .cross-sells .wd-cross-sells-title:before,
	.woocommerce #content .cart-collaterals .cross-sells .wd-cross-sells-title:before, 
	.woocommerce-page #content .cart-collaterals .cross-sells .wd-cross-sells-title:before,
	html .woocommerce .custom_category_shortcode .wd-categories-title:before
	{
		background-color:<?php echo wd_calc_color($wd_border_color,"#141414",false) ?>;
	}
	
	.tabbable > ul > li.active:after,.tabbable > ul > li.active:before,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active:after, .woocommerce div.product .woocommerce-tabs ul.tabs li.active:after, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active:after, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active:after,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active:before, .woocommerce div.product .woocommerce-tabs ul.tabs li.active:before, .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active:before, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active:before,
	body.woocommerce-page div.product ul.nav-tabs li.active:before, body.woocommerce div.product ul.nav-tabs li.active:before,
	body.woocommerce-page div.product ul.nav-tabs li.active:after, body.woocommerce div.product ul.nav-tabs li.active:after,
	#portfolio-galleries .portfolio-filter li.active:after,#portfolio-galleries .portfolio-filter li.active:before{
		background-color: <?php echo wd_calc_color($wd_border_color,"#141414",false) ?>;
		background-repeat: repeat-x;
		background-image: -webkit-linear-gradient(#fff 1%, <?php echo wd_calc_color($wd_border_color,"#141414",false) ?> 45%);
		background-image: -moz-linear-gradient(#fff 1%, <?php echo wd_calc_color($wd_border_color,"#141414",false) ?> 45%);
		background-image: -ms-linear-gradient(#fff 1%, <?php echo wd_calc_color($wd_border_color,"#141414",false) ?> 45%);
	}
	
	.tabbable .nav-tabs:before,body.woocommerce #content div.product .woocommerce-tabs ul.tabs:before,body .woocommerce div.product .woocommerce-tabs ul.tabs:before,body.woocommerce-page #content div.product .woocommerce-tabs ul.tabs:before,body.woocommerce-page div.product .woocommerce-tabs ul.tabs:before,body.woocommerce-page div.product ul.nav-tabs:before,body.woocommerce div.product ul.nav-tabs:before,
	#portfolio-galleries .portfolio-filter:before{
		background: -webkit-gradient(radial, center center, 0, center center, 460, from(<?php echo wd_calc_color($wd_border_color,"#141414",false) ?>), to(<?php echo $wd_main_content_background; ?>));
		background: -webkit-radial-gradient(circle, <?php echo wd_calc_color($wd_border_color,"#141414",false) ?>, <?php echo $wd_main_content_background; ?>);
		background: -moz-radial-gradient(circle,<?php echo wd_calc_color($wd_border_color,"#141414",false) ?>, <?php echo $wd_main_content_background; ?>);
		background: -ms-radial-gradient(circle, <?php echo wd_calc_color($wd_border_color,"#141414",false) ?>, <?php echo $wd_main_content_background; ?>);
	}
	
	.fa{
		color:<?php echo wd_calc_color($wd_border_color,"#141414",false) ?>;
	}
	.testimonial-item:hover .avartar,#container .gridlist-toggle a.active#grid:before,#container .gridlist-toggle a.active#list:before,#container .gridlist-toggle a#grid:hover:before,#container .gridlist-toggle a#list:hover:before,
	body.page div.product div.images div.thumbnails a:hover,
	body.woocommerce div.product div.images div.thumbnails a:hover,
	body.woocommerce-page div.product div.images div.thumbnails a:hover,
	body.woocommerce #content div.product div.images div.thumbnails a:hover,
	body.woocommerce-page #content div.product div.images div.thumbnails a:hover,
	/* PAGER */
	.page_navi > .nav-content a.first span span:hover, .page_navi > .nav-content a.previous span span:hover, .page_navi > .nav-content a.next span span:hover, .page_navi > .nav-content a.last span span:hover,body.woocommerce nav.woocommerce-pagination ul li a.next:hover,
	body.woocommerce-page nav.woocommerce-pagination ul li a.next:hover,
	body.woocommerce #content nav.woocommerce-pagination ul li a.next:hover,
	body.woocommerce nav.woocommerce-pagination ul li a.prev:hover,
	body.woocommerce-page nav.woocommerce-pagination ul li a.prev:hover,
	body.woocommerce #content nav.woocommerce-pagination ul li a.prev:hover,
	.page_navi .wp-pagenavi a.previouspostslink:hover,.page_navi .wp-pagenavi a.nextpostslink:hover,
	.featured_categories_slider_wrapper li a:hover img,
	#entry-author-info #author-description #author-avatar:hover img,
	#comments .commentlist li .divcomment .divcomment-inner .avarta:hover img,
	.woocommerce #content table.shop_table tbody tr.cart_item .wd_product_item a.remove:hover, 
	.woocommerce-page #content table.shop_table tbody tr.cart_item .wd_product_item a.remove:hover,
	#content .woocommerce table.cart a.remove:hover,
	
	html body #container-main .woocommerce .style-3 .products .product .product_thumbnail_wrapper a:hover,
	html body.woocommerce #container-main .style-3 .products .product .product_thumbnail_wrapper a:hover, 
	html body.woocommerce-page #container-main .style-3 .products .product .product_thumbnail_wrapper a:hover
	{
		border-color:<?php echo $wd_theme_color_primary; ?>;
	}
	
	/* COLOR BUTTON ADD TO CART */
	
	.woocommerce .products .product .product-meta-wrapper .list_add_to_cart a,
	.woocommerce-page .products .product .product-meta-wrapper .list_add_to_cart a,.wd_tini_account_wrapper #wp-submit,ul.list-posts li .post-info-content .read-more,.woocommerce .products .product .product-meta-wrapper .added_to_cart.wc-forward:hover,html .woocommerce-page .widget-container .button,html .woocommerce .widget-container .button,html .woocommerce-page .widget-container input[type^=submit],html .woocommerce .widget-container input[type^=submit],.woocommerce #content table.shop_table.wishlist_table tr td.product-add-to-cart a.button, .woocommerce-page #content table.shop_table.wishlist_table tr td.product-add-to-cart a.button, #content .woocommerce table.shop_table.wishlist_table tr td.product-add-to-cart a.button,.woocommerce table.compare-list .add-to-cart td a
	{
		background-color:<?php echo $wd_button_cart_background ; ?>;
		color:<?php echo $wd_button_cart_text  ; ?>;
	}
	
	.woocommerce .products .product .product-meta-wrapper .list_add_to_cart a:hover,
	.woocommerce-page .products .product .product-meta-wrapper .list_add_to_cart a:hover,
	.wd_tini_account_wrapper #wp-submit:hover,ul.list-posts li .post-info-content .read-more:hover,.woocommerce .products .product .product-meta-wrapper .added_to_cart.wc-forward,html .woocommerce-page .widget-container .button:hover,html .woocommerce .widget-container .button:hover,html .woocommerce-page .widget-container input[type^=submit]:hover,html .woocommerce .widget-container input[type^=submit]:hover,
	.woocommerce #content table.shop_table.wishlist_table tr td.product-add-to-cart a.button:hover, .woocommerce-page #content table.shop_table.wishlist_table tr td.product-add-to-cart a.button:hover, #content .woocommerce table.shop_table.wishlist_table tr td.product-add-to-cart a.button:hover,.woocommerce table.compare-list .add-to-cart td a:hover
	{
		color:<?php echo $wd_button_cart_text_hover ; ?>;
		background-color:<?php echo $wd_button_cart_background_hover ; ?>;
	}
	

	.woocommerce #content div.product .button.alt:hover, .woocommerce-page #content div.product .button.alt .button.alt:hover,
	.woocommerce  div.product .button.alt:hover, .woocommerce-page  div.product .button.alt .button.alt:hover,html div.product .button.alt:hover{
		background-color:<?php echo $wd_button_cart_background ; ?> !important;
		color:<?php echo $wd_button_cart_text  ; ?> !important;
	}
	
	.woocommerce #content div.product .button.alt, .woocommerce-page #content div.product .button.alt .button.alt,
	.woocommerce  div.product .button.alt, .woocommerce-page  div.product .button.alt .button.alt,html div.product .button.alt
	{
		color:<?php echo $wd_button_cart_text_hover ; ?> !important;
		background-color:<?php echo $wd_button_cart_background_hover ; ?> !important;
	}
	
	/* WISHLIST AND COMPARE */
	#content .products .product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce #content.products .product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce-page #content .products .product .product-meta-wrapper .add_to_wishlist,

	#content .products .product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce #content .products .product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce-page #content .products .product .product-meta-wrapper .add_to_wishlist.button,
	
	.body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist,

	.body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button,
	
	.body-wrapper .products .product .product-meta-wrapper .compare.button,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .compare.button,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .compare.button,
	
	.body-wrapper .products .product .product-meta-wrapper .compare,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .compare,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .compare,
	
	#content div.product .summary.entry-summary .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce #content div.product .summary.entry-summary .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce-page #content div.product .summary.entry-summary .yith-wcwl-wishlistexistsbrowse a,
	
	#content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce #content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce-page #content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a,
	
	#content div.product .summary.entry-summary .add_to_wishlist ,
	.woocommerce #content div.product .summary.entry-summary .add_to_wishlist ,
	.woocommerce-page #content div.product .summary.entry-summary .add_to_wishlist,

	#content div.product .summary.entry-summary .add_to_wishlist.button ,
	.woocommerce #content div.product .summary.entry-summary .add_to_wishlist.button ,
	.woocommerce-page #content div.product .summary.entry-summary .add_to_wishlist.button,
	
	#content div.product .summary.entry-summary .compare.button,
	.woocommerce #content div.product .summary.entry-summary .compare.button,
	.woocommerce-page #content div.product .summary.entry-summary .compare.button,
	
	#content div.product .summary.entry-summary .compare,
	.woocommerce #content div.product .summary.entry-summary .compare,
	.woocommerce-page #content div.product .summary.entry-summary .compare,
	
	.body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a,
	
	.body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a,
	
	.body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a:before,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a:before ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a:before,
	
	.body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a:before,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a:before,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a:before,
	
	.body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare.button:before,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare.button:before,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare.button:before,
	
	.body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare:before,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare:before,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare:before,
	
	.body-wrapper .products .product .product-meta-wrapper .add_to_wishlist:before ,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist:before ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist:before,

	.body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button:before ,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button:before ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button:before,
	
	.body-wrapper div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .add_to_wishlist:before,
	.woocommerce .body-wrapper div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .add_to_wishlist:before,
	.woocommerce-page .body-wrapper div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .add_to_wishlist:before,

	.body-wrapper div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .add_to_wishlist.button:before,
	.woocommerce .body-wrapper div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .add_to_wishlist.button:before,
	.woocommerce-page .body-wrapper div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .add_to_wishlist.button:before,
	
	#content div.product .summary.entry-summary .wd_compare_wrapper .compare:before,
	.woocommerce #content div.product .summary.entry-summary .wd_compare_wrapper .compare:before,
	.woocommerce-page #content div.product .summary.entry-summary .wd_compare_wrapper .compare:before,

	#content div.product .summary.entry-summary .compare.button:before,
	.woocommerce #content div.product .summary.entry-summary .compare.button:before,
	.woocommerce-page #content div.product .summary.entry-summary .compare.button:before
	{
		color:<?php echo $wd_button_cart_background ; ?> !important;
	}

	#content .products .product .product-meta-wrapper .add_to_wishlist:hover ,
	.woocommerce #content.products .product .product-meta-wrapper .add_to_wishlist:hover ,
	.woocommerce-page #content .products .product .product-meta-wrapper .add_to_wishlist:hover,

	#content .products .product .product-meta-wrapper .add_to_wishlist.button:hover ,
	.woocommerce #content .products .product .product-meta-wrapper .add_to_wishlist.button:hover ,
	.woocommerce-page #content .products .product .product-meta-wrapper .add_to_wishlist.button:hover,
	
	.body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button:hover ,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist:hover ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist:hover,

	.body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button:hover ,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button:hover ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button:hover,
	
	.body-wrapper .products .product .product-meta-wrapper .compare.button:hover
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .compare.button:hover,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .compare.button:hover,
	
	.body-wrapper .products .product .product-meta-wrapper .compare:hover,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .compare:hover,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .compare:hover,
	
	#content div.product .summary.entry-summary .yith-wcwl-wishlistexistsbrowse a:hover,
	.woocommerce #content div.product .summary.entry-summary .yith-wcwl-wishlistexistsbrowse a:hover,
	.woocommerce-page #content div.product .summary.entry-summary .yith-wcwl-wishlistexistsbrowse a:hover,
	
	#content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a:hover,
	.woocommerce #content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a:hover,
	.woocommerce-page #content div.product .summary.entry-summary .yith-wcwl-wishlistaddedbrowse a:hover,
	
	#content div.product .summary.entry-summary .add_to_wishlist:hover ,
	.woocommerce #content div.product .summary.entry-summary .add_to_wishlist:hover ,
	.woocommerce-page #content div.product .summary.entry-summary .add_to_wishlist:hover,

	#content div.product .summary.entry-summary .add_to_wishlist.button:hover ,
	.woocommerce #content div.product .summary.entry-summary .add_to_wishlist.button:hover ,
	.woocommerce-page #content div.product .summary.entry-summary .add_to_wishlist.button:hover,
	
	#content div.product .summary.entry-summary .compare.button:hover,
	.woocommerce #content div.product .summary.entry-summary .compare.button:hover,
	.woocommerce-page #content div.product .summary.entry-summary .compare.button:hover,
	
	#content div.product .summary.entry-summary .compare:hover,
	.woocommerce #content div.product .summary.entry-summary .compare:hover,
	.woocommerce-page #content div.product .summary.entry-summary .compare:hover,
	
	.body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a:hover,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a:hover,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a:hover,
	
	.body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a:hover,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a:hover,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a:hover
	{
		color:<?php echo $wd_theme_color_primary ; ?> !important;
	}
	.body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a:hover:before,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a:hover:before ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistexistsbrowse a:hover:before,
	
	.body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a:hover:before,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a:hover:before,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-wishlistaddedbrowse a:hover:before,
	
	.body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare.button:hover:before,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare.button:hover:before,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare.button:hover:before,
	
	.body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare:hover:before,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare:hover:before,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .wd_compare_wrapper .compare:hover:before,
	
	.body-wrapper .products .product .product-meta-wrapper .add_to_wishlist:hover:before ,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist:hover:before ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist:hover:before,

	.body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button:hover:before ,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button:hover:before ,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .add_to_wishlist.button:hover:before,
	
	.body-wrapper div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .add_to_wishlist:hover:before,
	.woocommerce .body-wrapper div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .add_to_wishlist:hover:before,
	.woocommerce-page .body-wrapper div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .add_to_wishlist:hover:before,

	.body-wrapper div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .add_to_wishlist.button:hover:before,
	.woocommerce .body-wrapper div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .add_to_wishlist.button:hover:before,
	.woocommerce-page .body-wrapper div.product .summary.entry-summary .yith-wcwl-add-to-wishlist .add_to_wishlist.button:hover:before,
	
	#content div.product .summary.entry-summary .wd_compare_wrapper .compare:hover:before,
	.woocommerce #content div.product .summary.entry-summary .wd_compare_wrapper .compare:hover:before,
	.woocommerce-page #content div.product .summary.entry-summary .wd_compare_wrapper .compare:hover:before,

	#content div.product .summary.entry-summary .compare.button:hover:before,
	.woocommerce #content div.product .summary.entry-summary .compare.button:hover:before,
	.woocommerce-page #content div.product .summary.entry-summary .compare.button:hover:before{
		color:<?php echo $wd_theme_color_secondary ; ?> !important;
	}
	
	.body-wrapper .products .product .product-meta-wrapper .yith-wcwl-add-to-wishlist:after,
	.woocommerce .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-add-to-wishlist:after,
	.woocommerce-page .body-wrapper .products .product .product-meta-wrapper .yith-wcwl-add-to-wishlist:after{
		background-color:<?php echo $wd_button_cart_background ; ?>;
	}
	
	/* END WISHLIST AND COMPARE */
	<?php if($quickshop_ready == true): ?>
	/* QUICK SHOP COLOR */
	#em_quickshop_handler #qs_inner2.qs_text_btn{
		color:<?php echo $wd_quickshop_text_color  ; ?>;
		background:<?php echo $wd_quickshop_background  ; ?>;
	}
	#em_quickshop_handler #qs_inner2.qs_text_btn:hover{
		color:<?php echo $wd_quickshop_text_color_hover  ; ?>;
		background:<?php echo $wd_quickshop_background_hover  ; ?>;
	}
	<?php endif; ?>
	
	ul.list-posts li .post-title .heading-title:hover,
	html .woocommerce .woocommerce-breadcrumb a:hover, #crumbs a:hover,
	body .woocommerce form.login .lost_password a:hover,
	body.woocommerce-page form.login .lost_password a:hover,
	body .woocommerce form.login .lost_password:hover,
	body.woocommerce-page form.login .lost_password:hover,
	body .woocommerce form.checkout_coupon .lost_password:hover,
	body.woocommerce-page form.checkout_coupon .lost_password:hover,
	body .woocommerce form.register .lost_password:hover,
	body.woocommerce-page form.register .lost_password:hover,
	h1.heading-title.page-title,h2,.testimonial-item a.title,.testimonial-item .job,.testimonial-item span.line,.widget_recent_post_slider .entry-title > a.read-more,#header .nav > .main-menu > ul.menu > li a.title:hover,body .author a,.comments-count .number,
	#customer_login div.title > h3,
	div.list_carousel .slider_control > a.next:hover:before,div.list_carousel .slider_control > a.next:hover:after,div.list_carousel .slider_control > a.prev:hover:before,div.list_carousel .slider_control > a.prev:hover:after,html div.product .availability span, .woocommerce div.product .availability span, body.woocommerce #content div.product .availability span, body.woocommerce-page #content div.product .availability span,#entry-author-info #author-description .author-name [rel^=author]:hover,
	/* BỘ BLOG DATE,COUNT,COMMENT */
	ul.list-posts li .post-info-meta .author a,ul.list-posts li .post-info-meta .comments-count .number,
	/* HOVER WIGET UL LI SIDEBAR */
	.widget_archive ul li > a:hover,
	.widget_meta ul li > a:hover,

	.widget_categories > ul > li > a:hover,
	.widget_nav_menu > ul > li > a:hover,
	.widget_pages > ul > li > a:hover,
	.widget_custom_pages > ul > li > a:hover,
	.widget_product_categories > ul > li > a:hover,
	.widget_pages > ul > li.current_page_item > a,
	.widget_product_categories > ul > li.current-cat > a,
	.widget_nav_menu > ul > li.current_page_item > a,
	.widget_categories > ul >.current-cat > a,
	.widget_custom_pages > ul > li.current_page_item > a,
	.widget-container #wp-calendar thead,#wp-calendar tbody tr td.today

	.widget_customrecent .author .name, .widget_customrecent .comment-number .number, .widget_multitab ul.tabs-post-list li .comment-number .number, .widget_multitab ul.tabs-post-list li .author .name,.widget_recent_comments_custom ul li .author .name,.widget_customrecent ul li .author .name,.tabs-comments-list li .author .name,.widget_tag_cloud .tagcloud a:hover,.widget_product_tag_cloud .tagcloud a:hover,
	
	/* PAGER */
	.page_navi > .nav-content a.first span span:hover, .page_navi > .nav-content a.previous span span:hover, .page_navi > .nav-content a.next span span:hover, .page_navi > .nav-content a.last span span:hover,body.woocommerce nav.woocommerce-pagination ul li a.next:hover,
	body.woocommerce-page nav.woocommerce-pagination ul li a.next:hover,
	body.woocommerce #content nav.woocommerce-pagination ul li a.next:hover,
	body.woocommerce nav.woocommerce-pagination ul li a.prev:hover,
	body.woocommerce-page nav.woocommerce-pagination ul li a.prev:hover,
	body.woocommerce #content nav.woocommerce-pagination ul li a.prev:hover,.page_navi .wp-pagenavi a.previouspostslink:hover,.page_navi .wp-pagenavi a.nextpostslink:hover,
	#content .woocommerce table.my_account_orders td.order-status,
	.woocommerce #content table.my_account_orders td.order-status,
	.woocommerce-page #content table.my_account_orders td.order-status,#comments .commentlist li .divcomment .divcomment-inner .comment-author cite a:hover,#comments .commentlist li .divcomment .divcomment-inner .comment-meta a:hover,
	/* END PAGE */
	#collapse-login-regis h4.heading-title,body .woocommerce #collapse-login-regis form.login .lost_password, body.woocommerce-page #collapse-login-regis form.login .lost_password,#footer .widget_recent_post_slider .entry-title > a.read-more,.widget_recent_post_slider .entry-title > a.read-more,.wishlist_table tr td.product-stock-status span.wishlist-in-stock, html body table.compare-list tr th,table.compare-list .stock td span,a.wp_learn_more
	{
		color:<?php echo $wd_theme_color_secondary; ?>;
	}
	
	#container .gridlist-toggle a#grid.active,#container .gridlist-toggle a#list.active,#container .gridlist-toggle a#list:hover,#container .gridlist-toggle a#grid:hover,.woocommerce .widget-container.widget_price_filter .price_slider_wrapper .ui-widget-content, .woocommerce-page .widget-container.widget_price_filter .price_slider_wrapper .ui-widget-content,html div.pp_woocommerce .pp_close:hover,body div.pp_woocommerce a.pp_expand:hover, body div.pp_woocommerce a.pp_contract:hover,#feedback a.feedback-button:hover,.widget_recent_post_slider .entry-title > a.read-more:after,.yith-woocompare-widget ul.products-list a.remove:hover,#cboxClose:hover,table.compare-list tr.remove td > a .remove:hover,
	
	body * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a:hover,#ls-global * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a:hover,html * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a:hover,.tp-bullets.simplebullets.round .bullet:hover,
	body * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a.ls-nav-active, #ls-global * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a.ls-nav-active, html * .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a.ls-nav-active,
	body .tp-bullets.simplebullets.round .bullet.selected,body .tp-bullets.simplebullets.navbar .bullet.selected,
	.feature.shortcode .feature_content_wrapper a.view_more:hover .bg_view_more
	{
		background-color:<?php echo $wd_theme_color_secondary; ?>;
	}
	
	/* MUST HAVE */
	#to-top.on a,#feedback a.feedback-button,
	
	/* AND MUST HAVE */
	body .owl-theme .owl-controls .owl-page span,
	#content .woocommerce .cart-collaterals .cart_totals h2 ,
	.woocommerce #content .cart-collaterals .cart_totals h2 ,
	.woocommerce-page #content .cart-collaterals .cart_totals h2,
	#content .woocommerce .cart-collaterals .coupon_wrapper label, .woocommerce #content .cart-collaterals .coupon_wrapper label, .woocommerce-page #content .cart-collaterals .coupon_wrapper label,
	#content .woocommerce  .cart-collaterals .shipping_calculator h2,
	.woocommerce #content .cart-collaterals .shipping_calculator h2,
	.woocommerce-page #content .cart-collaterals .shipping_calculator h2,
	html div.pp_woocommerce .pp_close,body div.pp_woocommerce a.pp_expand, body div.pp_woocommerce a.pp_contract,body div.pp_woocommerce .pp_previous:before,body div.pp_woocommerce .pp_next:before,
	.widget-container #wp-calendar caption,.alphabet-products ul li a:hover,body form.checkout .accordion-heading a.accordion-toggle.collapsed:hover,body #accordion-checkout-details .accordion-heading a.accordion-toggle.collapsed:hover,
	body form.checkout .accordion-heading a.accordion-toggle,body #accordion-checkout-details .accordion-heading a.accordion-toggle,#control-panel-main a#wd-control-close:hover
	body #control-panel-main .accordion-heading:hover,.yith-woocompare-widget ul.products-list a.remove,#cboxClose,table.compare-list tr.remove td > a .remove,
	
	.woocommerce #content table.shop_table tbody tr.cart_item .wd_product_item a.remove:hover, 
	.woocommerce-page #content table.shop_table tbody tr.cart_item .wd_product_item a.remove:hover,
	#content .woocommerce table.cart a.remove:hover,
	
	.wd-heading-line .heading-title-block:before,
	.featured_product_wrapper.style-3 .featured_product_wrapper_meta .wd_title_shortcode:before,.woocommerce .featured_product_slider_wrapper.style-3 .featured_product_slider_wrapper_meta .wd_title_shortcode:before,.woocommerce-page .featured_product_slider_wrapper.style-3 .featured_product_slider_wrapper_meta .wd_title_shortcode:before, .featured_product_slider_wrapper_meta .wd_title_shortcode:before
	{
		background-color:<?php echo $wd_theme_color_primary; ?>;
	}
	.left-sidebar-content h3.widget-title,.right-sidebar-content h3.widget-title{
		background-color:<?php echo $wd_sidebar_title_background; ?>;
		color:<?php echo $wd_sidebar_title_color; ?>
	}
	/* CUSTOM MENU MAIN */
	
	#header .header-middle,.header-middle-content .loading-cart:after{
		background-color:<?php echo $wd_menu_background  ; ?>;
	}
	#header .nav > .main-menu > ul.menu  > li.menu-item:after{
		color:<?php echo $wd_menu_background  ; ?>;
	}
	
	#header .nav > .main-menu > ul.menu > li > a > span,#header .nav > div.menu > ul > li > a,#header .nav > .main-menu > ul.menu > li.parent > a:after, #header .nav > div > ul > li.parent > a:after,#header .nav .main-menu > ul.menu > li.parent > span.menu-drop-icon:before,.header-middle-content .loading-cart:before{
		color:<?php echo $wd_menu_text_color  ; ?>;
	}
	
	
	.sticky-wrapper.is-sticky .header-middle .shopping-cart:hover .wd_tini_cart_control a{
		color:<?php echo $wd_menu_text_color_hover  ; ?> !important;
	}
	
	#header .nav > .main-menu > ul.menu > li:hover > a > span,#header .nav > div.menu > ul > li:hover > a,#header .nav > .main-menu > ul.menu > li.current_page_item > a > span, #header .nav > .main-menu > ul.menu > li.current-menu-item > a > span{
		color:<?php echo $wd_menu_text_color_hover  ; ?>;
	}
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu ul.sub-menu:after,#header .nav > .main-menu > ul.menu > li > ul {
		border-color:<?php echo $wd_sub_menu_border  ; ?>;
	}

	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li a,#header .nav > .main-menu > ul.menu div.categories a,.menu .textwidget a,a.link-sub:hover{
		color:<?php echo $wd_sub_menu_text_color  ; ?>;
	}
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu li a:hover, #header .nav > .main-menu > ul.menu div.categories a:hover, .menu .wd-categories a:hover, #header .nav > .main-menu > ul.menu > li.wd-fly-menu li > a:hover > span, #header .nav > .main-menu > ul.menu > li.wd-fly-menu li.current-menu-item > a > span, #header .nav > .main-menu > ul.menu > li.wd-fly-menu li.current_page_item > a > span,#header .nav .main-menu > ul.menu > li li.parent:hover > span.menu-drop-icon:after,#header .nav .main-menu > ul.menu > li li.current_page_item > span.menu-drop-icon:after,a.link-sub,.menu .textwidget a:hover{
		color:<?php echo $wd_sub_menu_text_color_hover  ; ?>;
	}
	#header .nav > .main-menu > ul.menu > li.wd-fly-menu ul.sub-menu:after{
		background-color:<?php echo $wd_sub_menu_background  ; ?>;
	}
	
	button.button,
	a.button,input[type^=submit],
	html .woocommerce a.button,
	html .woocommerce button.button,
	html .woocommerce input.button,
	html .woocommerce #respond input#submit, 
	.woocommerce #content input.button,
	html .woocommerce-page a.button,
	html .woocommerce-page button.button, 
	.woocommerce-page input.button,
	html .woocommerce-page #respond input#submit, 
	html .woocommerce-page #content input.button,
	html .woocommerce-page #content input.button, 
	html .woocommerce #content table.cart input.button,
	html input.button,body form.checkout #payment #place_order{
		background:<?php echo $wd_button_background; ?>;
		color:<?php echo $wd_button_text ; ?>;
	}
	button.button:hover, a.button, input[type^=submit]:hover, html .woocommerce a.button:hover, html .woocommerce button.button:hover, html .woocommerce input.button:hover, html .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, html .woocommerce-page a.button:hover, html .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, html .woocommerce-page #respond input#submit:hover, html .woocommerce-page #content input.button:hover, html input.button:hover, body form.checkout #payment #place_order:hover{
		background:<?php echo $wd_button_background_hover ; ?>;
		color:<?php echo $wd_button_text_hover ; ?>;
	}
	
	/* BORDER DEFALT */
	.wd_tini_account_wrapper .form_drop_down:after,
	input[type="color"], input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="text"],select,textarea,#footer .first-footer-widget-area > .container,
	.quantity .minus,
	body.woocommerce .quantity .minus,
	body.woocommerce-page .quantity .minus,
	body.woocommerce #content .quantity .minus,
	body.woocommerce-page #content .quantity .minus,
	body.page .quantity .minus,
	.quantity .plus,
	body.woocommerce .quantity .plus,
	body.woocommerce-page .quantity .plus,
	body.woocommerce #content .quantity .plus,
	body.woocommerce-page #content .quantity .plus,
	body.page .quantity .plus,
	.woocommerce #content table.shop_table tbody tr.cart_item td.product-quantity input.qty, .woocommerce-page #content table.shop_table tbody tr.cart_item .quantity input.qty, #content .woocommerce table.shop_table tbody tr.cart_item .quantity input.qty,
	div.product .quantity input.qty, body.woocommerce div.product .quantity input.qty, body.woocommerce-page div.product .quantity input.qty, body.woocommerce #content div.product .quantity input.qty, body.woocommerce-page #content div.product .quantity input.qty, #content .woocommerce div.product .quantity input.qty,
	.single-content .single-post .post-title .single-navigation a[rel^=prev],
	.single-content .single-post .post-title .single-navigation a[rel^=next],.single .navi-prev a,.single .navi-next a,.wd_button_loadmore_wrapper input.btn_load_more,.shortcode-recent-blogs-slider.single-item .view-more,
	.woocommerce #content table.shop_table.wishlist_table tr td, .woocommerce-page #content table.shop_table.wishlist_table tr td, #content .woocommerce table.shop_table.wishlist_table tr td,.yith-woocompare-widget ul.products-list a.remove,table.compare-list th, table.compare-list td{
		border-color:<?php echo $wd_border_color ; ?>;
	}
	
	input[type="color"]:hover, input[type="email"]:hover, input[type="number"]:hover, input[type="password"]:hover, input[type="tel"]:hover, input[type="text"]:hover,select:hover,textarea:hover, input[type="color"]:focus, input[type="email"]:focus, input[type="number"]:focus, input[type="password"]:focus, input[type="tel"]:focus,input[type="text"]:focus,select:focus,textarea:focus,#content .woocommerce .cart-collaterals .coupon_wrapper input#coupon_code:hover,.woocommerce #content .cart-collaterals .coupon_wrapper input#coupon_code:hover,.woocommerce-page #content .cart-collaterals .coupon_wrapper input#coupon_code:hover,#content .woocommerce .cart-collaterals .coupon_wrapper input#coupon_code:focus,.woocommerce #content .cart-collaterals .coupon_wrapper input#coupon_code:focus,.woocommerce-page #content .cart-collaterals .coupon_wrapper input#coupon_code:focus,.quantity input.qty:hover, body.woocommerce .quantity input.qty:hover, body.woocommerce-page .quantity input.qty:hover, body.woocommerce #content .quantity input.qty:hover, body.woocommerce-page #content .quantity input.qty:hover, body.page .quantity input.qty:hover,.single-content .single-post .post-title .single-navigation a[rel^=prev]:hover,
	.single-content .single-post .post-title .single-navigation a[rel^=next]:hover,.single .navi-prev:hover a,.yith-woocompare-widget ul.products-list a.remove:hover
	{
		border-color:<?php echo $wd_border_color_hover ; ?>;
	}
	a:hover,.widget_recent_post_slider .entry-title > a:hover{
		color:<?php echo $wd_link_color_hover  ; ?>;
	}
	
	/* ==========FOOTER=============== */
	#footer{
		background:<?php echo $wd_footer_background  ; ?>;
	}
	
	#footer .subscriptions-footer-widget-area ul.xoxo{
		background:<?php echo $wd_footer_subscriptions_background  ; ?>;
		border-color:<?php echo wd_calc_color($wd_footer_subscriptions_background,"#262626",false) ?>;
	}
	
	.wd_footer_end{
		background:<?php echo $wd_footer_end_background  ; ?>;
	}
	
	#footer .wd_footer_end > div #copy-right .copyright{
		color:<?php echo $wd_footer_end_text  ; ?>;
	}
	
	.footer-menu ul li a,#footer .wd_footer_end a{
		color:<?php echo $wd_footer_end_menu_text  ; ?>;
	}
	
	.footer-menu ul li a:hover,#footer .wd_footer_end a:hover{
		color:<?php echo $wd_footer_end_menu_text_hover  ; ?>;
	}
	
	
	/* LINK */
	a,.wd_tini_account_wrapper .form_wrapper_body label,.wd_tini_account_wrapper .form_wrapper_footer > p > a:hover,#footer  h3.widget-title,.ft-col h3{
		color:<?php echo $wd_link_color  ; ?>;
	}
	
	.shortcode-recent-blogs p.date-time,ul.list-posts li .time .entry-date,.widget_customrecent  .time,.widget_multitab  ul.tabs-post-list li .time,.widget_recent_comments_custom .time,.tabs-comments-list .time,.single-content .single-post .time .entry-date,
	html .woocommerce-message,
	html .woocommerce-info,
	html .woocommerce .woocommerce-message,
	html .woocommerce .woocommerce-info,
	html .woocommerce-page .woocommerce-message,
	html .woocommerce-page .woocommerce-info{
		color:<?php echo $wd_special_color  ; ?>;
	}
	
	html .woocommerce-message,
	html .woocommerce-info,
	html .woocommerce .woocommerce-message,
	html .woocommerce .woocommerce-info,
	html .woocommerce-page .woocommerce-message,
	html .woocommerce-page .woocommerce-info{
		border-color:<?php echo $wd_special_color  ; ?>;
	}
	
	html body .woocommerce-message:after,html .woocommerce .woocommerce-message:after,html .woocommerce-page .woocommerce-message:after,html body .woocommerce-info:after,html .woocommerce .woocommerce-info:after,html .woocommerce-page .woocommerce-info:after{
		background-color:<?php echo $wd_special_color  ; ?>;
	}
	
	#content .woocommerce .cart-collaterals .cart_totals .checkout-button, .woocommerce #content .cart-collaterals .cart_totals .checkout-button, .woocommerce-page #content .cart-collaterals .cart_totals .checkout-button{
		background-color:<?php echo $wd_special_color  ; ?> !important;
	}
	
	input,textarea,.woocommerce #payment div.payment_box, .woocommerce-page #payment div.payment_box{
		color:<?php echo $wd_text_color  ; ?>;
	}
	.widget_tag_cloud .tagcloud a:hover,.widget_product_tag_cloud .tagcloud a:hover{
		border-color:<?php echo $wd_theme_color_primary; ?>;
	}
	
	/* TAB CUSTOM COLOR */
	.widget_multitab ul.nav-tabs li.ui-state-active a
	{
		color:<?php echo $wd_theme_color_secondary; ?>;
	}
	
	/* PRICE */
	/* COLOR PRODUCT */
	.product_list_widget li span.price,
	html .products .product.sale .price,
	html div.product form.cart .group_table td.price del .amount, html .woocommerce div.product form.cart .group_table td.price del .amount, html .woocommerce #content div.product form.cart .group_table td.price del .amount, html .woocommerce-page div.product form.cart .group_table td.price del .amount, html .woocommerce-page #content div.product form.cart .group_table td.price del .amount,
	.shopping-cart .cart_dropdown ul.cart_list li .price del .amount,
	html div.product .price del,
	html .body-wrapper .woocommerce .products .product .price del, 
	html .woocommerce-page .body-wrapper .products .product .price del,
	html .woocommerce div.product span.price del, 
	html .woocommerce div.product p.price del, 
	html .woocommerce #content div.product span.price del, 
	html .woocommerce #content div.product p.price del, 
	html .woocommerce-page div.product span.price del, 
	html .woocommerce-page div.product p.price del, 
	html .woocommerce-page #content div.product span.price del, 
	html .woocommerce-page #content div.product p.price del,
	html .home #content div.product p.price del,
	.widget-container .price del,.widget-container .price del .amount,.widget-container del,.widget-container .price del .amount,
	html .body-wrapper .woocommerce .products .product .price, 
	html .woocommerce-page .body-wrapper .products .product .price,
	html .woocommerce div.product .summary.entry-summary span.price, 
	html .woocommerce div.product .summary.entry-summary p.price, 
	html .woocommerce #content div.product .summary.entry-summary span.price, 
	html .woocommerce #content div.product .summary.entry-summary p.price, 
	html .woocommerce-page div.product .summary.entry-summary span.price, 
	html .woocommerce-page div.product .summary.entry-summary p.price, 
	html .woocommerce-page #content div.product .summary.entry-summary span.price, 
	html .woocommerce-page #content div.product .summary.entry-summary p.price,
	
	html div.product .summary.entry-summary p.price, 
	
	html .woocommerce div.product .products .product span.price, 
	html .woocommerce div.product .products .product p.price, 
	html .woocommerce #content div.product .products .product span.price, 
	html .woocommerce #content div.product .products .product p.price, 
	html .woocommerce-page div.product .products .product span.price, 
	html .woocommerce-page div.product .products .product p.price, 
	html .woocommerce-page #content div.product .products .product span.price, 
	html .woocommerce-page #content div.product .products .product p.price,
	
	html .products .product .price,.cart_dropdown .total span,
	.widget-container .price > .amount,
	html .woocommerce ul.cart_list li > span.amount,
	html .woocommerce ul.product_list_widget li > span.amount,
	html .woocommerce-page ul.cart_list li > span.amount,
	html .woocommerce-page ul.product_list_widget li > span.amount,
	woocommerce ul.cart_list li .quantity  span.amount,
	html .woocommerce ul.product_list_widget li .quantity span.amount,
	.woocommerce-page #content .order_details tfoot td .amount,
	#content .woocommerce .order_details tfoot td .amount,
	body .woocommerce table.shop_table tfoot tr.total .amount,
	body.woocommerce-page table.shop_table tfoot tr.total .amount,
	html div.product.wd_quickshop form.cart .group_table td.price,.shopping-cart .cart_dropdown ul.cart_list li .price > .amount,
	
	html div.product form.cart .group_table td.price .amount, html .woocommerce div.product form.cart .group_table td.price .amount, html .woocommerce #content div.product form.cart .group_table td.price .amount, html .woocommerce-page div.product form.cart .group_table td.price .amount, html .woocommerce-page #content div.product form.cart .group_table td.price .amount,
	#content .woocommerce table.my_account_orders td.order-total .amount, .woocommerce #content table.my_account_orders td.order-total .amount, .woocommerce-page #content table.my_account_orders td.order-total .amount,.product_list_widget li,.widget_popular ul li, .widget_hot_product ul li, html .widget-container.woocommerce ul.product_list_widget li, html .woocommerce-page .widget-container ul.cart_list li, html .woocommerce-page .widget-container ul.product_list_widget li, html .woocommerce ul.cart_list li, html .woocommerce-page ul.cart_list li,table.compare-list tr.price td,table.compare-list tr.price td del
	{
		color:<?php echo $wd_text_price_color  ; ?>;
	}
	
	.widget-container .price > ins >.amount,
	.widget-container .price > ins ,
	html .woocommerce ul.cart_list li > ins > span.amount,
	html .woocommerce ul.product_list_widget li > ins > span.amount,
	html .woocommerce ul.product_list_widget li > ins,
	html .woocommerce-page ul.cart_list li > ins > span.amount,
	html .woocommerce-page ul.cart_list li > ins,
	html .woocommerce-page ul.product_list_widget li > ins > span.amount,
	.widget-container .price ins,.widget-container .price ins .amount,.widget-container ins,.widget-container .price ins .amount,
	.woocommerce .products .product .price ins .amount,.woocommerce-page .products .product .price ins .amount,
	html .pp_woocommerce .price ins, html .woocommerce .products .product .price ins, html .woocommerce-page .products .product .price ins, html .home .products .product .price ins,
	table.compare-list tr.price td ins
	{
		color:<?php echo $wd_text_price_sale_color  ; ?>;
	}
	/* RATING */
	#content .woocommerce table.my_account_orders td.order-actions a.button,
	.woocommerce #content table.my_account_orders td.order-actions a.button, 
	.woocommerce-page #content table.my_account_orders td.order-actions a.button,
	div.product div.summary .star-rating,
	body.woocommerce div.product div.summary .star-rating,
	body.woocommerce-page div.product div.summary .star-rating,
	body.woocommerce #content div.product div.summary .star-rating,
	body.woocommerce div.product div.summary .star-rating,
	body.woocommerce-page div.product div.summary .star-rating,
	body.woocommerce #content div.product div.summary .star-rating,
	body.woocommerce-page #content div.product div.summary .star-rating,
	body.page div.product div.summary .star-rating,.wd_quickshop .star-rating span,
	.woocommerce p.stars a:after, .woocommerce-page p.stars a:after{
		color:<?php echo $wd_rating_color  ; ?>;
	}
	
	.woocommerce .star-rating:before, .woocommerce-page .star-rating:before{
		color:<?php echo $wd_rating_color  ; ?> !important;
	}
	
	html .woocommerce .products .product .star-rating,.woocommerce .star-rating span, .woocommerce-page .star-rating span{
		color:<?php echo $wd_rating_color  ; ?>;
	}
	
	/* PORTFOLIO */
	#portfolio-container #portfolio-galleries-holder div.item-portfolio:hover .p-content{
		border-color:<?php echo $wd_border_portfolio_hover  ; ?>;
	}
	
	.item-portfolio .thumb-image-hover .icons a{
		background-color:<?php echo $wd_background_button_portfolio  ; ?>;
	}
	
	.item-portfolio .thumb-image-hover .icons a:hover{
		background-color:<?php echo $wd_background_button_portfolio_hover  ; ?>;
	}
	
	.item-portfolio .post-title a{
		color:<?php echo $wd_link_title_portfolio  ; ?>;
	}
	
	.item-portfolio .post-title a:hover
	{
		color:<?php echo $wd_link_title_portfolio_hover  ; ?>;
	}

	
	
/**************************************** RESPONSIVE *****************************************/	

/* MENU */
	@media only screen and (max-device-width: 767px), only screen and (max-width: 767px){
		body #header .nav .main-menu > ul.menu > li .one_half, body #header .nav .main-menu > ul.menu > li .one_third, body #header .nav .main-menu > ul.menu > li .two_third, body #header .nav .main-menu > ul.menu > li .one_fourth, body #header .nav .main-menu > ul.menu > li .three_fourth, body #header .nav .main-menu > ul.menu > li .one_fifth, body #header .nav .main-menu > ul.menu > li .two_fifth, body #header .nav .main-menu > ul.menu > li .three_fifth, body #header .nav .main-menu > ul.menu > li .four_fifth, body #header .nav .main-menu > ul.menu > li .one_sixth, body #header .nav .main-menu > ul.menu > li .three_sixth, body #header .nav .main-menu > ul.menu > li .one_sixth, body #header .nav .main-menu > ul.menu > li .five_sixth{
			border-color:<?php echo $wd_border_color; ?>;
		}
		.phone-header,.phone-header .toggle-menu-wrapper{
			background-color:<?php echo $wd_phone_background; ?>;
		}
		.mobile-main-menu .menu  li > ul li a{
			color:<?php echo $wd_phone_sub_text_color; ?>;
		}
		
		.mobile-main-menu .menu > li > ul > li > a:hover,.mobile-main-menu .menu > li > ul > li.current-menu-item > a{
			color:<?php echo $wd_theme_color_secondary; ?>;
		}
		
		.mobile-main-menu .menu > li > ul > li > ul li a:hover,.mobile-main-menu .menu > li > ul > li > ul li.current-menu-item > a {
			color:<?php echo $wd_phone_text_color; ?>;
		}
		
		.mobile-main-menu .menu li a{
			color:<?php echo $wd_phone_text_color; ?>;
		}
		#header .header-container > .logo{
			background-color:<?php echo $wd_theme_color_primary; ?>;
		}
	}

@media 
only screen and (max-width: 1024px){

	html body.woocommerce .featured_product_slider_wrapper.style-1 .products .product .product_item_wrapper,
	html body.woocommerce-page .featured_product_slider_wrapper.style-1 .products .product  .product_item_wrapper,
	html body .woocommerce .featured_product_slider_wrapper.style-1 .products .product .product_item_wrapper{
		border-color:<?php echo $wd_border_color; ?>;
	}
	.feature.shortcode .feature_content_wrapper{
		border-color:<?php echo $wd_heading_color; ?>;
	}
	
}
<?php if((int)$data["wd_effect_product"] == 0): ?>	
/* DISPLAY EFFECT OPACITY */	
@media 
only screen and (max-width: 4000px) and (min-width: 1025px) {
	#main-module-container .products .product a .product-image-back{
		display:none !important;
	}
	#main-module-container .products .product a:hover .product-image-front{
		opacity:1;
		filter:alpha(opacity=100);
	}
}
.ie body .woocommerce .products .product a:hover .product-image-back ,.ie body .woocommerce-page .products .product a:hover .product-image-back,
.ie body.woocommerce .products .product a:hover .product-image-back ,.ie body.woocommerce-page .products .product a:hover .product-image-back   {display:none !important;z-index:0 !important}
/* END */
<?php endif; ?>