<?php
add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sidebars
		$of_sidebars 	= array();
		global $default_sidebars;
		if($default_sidebars){
			foreach( $default_sidebars as $key => $_sidebar ){
				$of_sidebars[$_sidebar['id']] = $_sidebar['name'];
			}
		}

		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}
		
		//default value for logo and favor icon
		$df_logo_images_uri = get_stylesheet_directory_uri(). '/images/logo.png'; 
		$df_icon_images_uri = get_stylesheet_directory_uri(). '/images/favicon.ico'; 
		
		$df_visa_images_uri = get_stylesheet_directory_uri(). '/images/media/icon_payment_visa.png';
		$df_mastercard_images_uri = get_stylesheet_directory_uri(). '/images/media/icon_payment_master_card.png'; 		
		$df_verified_images_uri = get_stylesheet_directory_uri(). '/images/media/icon_verified_visa.png'; 		
		$df_trusted_images_uri = get_stylesheet_directory_uri(). '/images/media/icon_trusted_visa.png'; 		
		$df_paypal_images_uri = get_stylesheet_directory_uri(). '/images/media/icon_payment_paypal.png';
		
		//Feedback button
		$df_feedback_button_images_uri = get_stylesheet_directory_uri(). '/images/feedback.png';

		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		$default_font_size = array(	
			"10px"
			,"11px"
			,"12px"
			,"13px"
			,"14px"
			,"15px"
			,"16px"
			,"17px"
			,"18px"
			,"19px"
			,"20px"
			,"21px"
			,"22px"
			,"23px"
			,"24px"
			,"25px"
			,"26px"
			,"27px"
			,"28px"
			,"29px"
			,"30px"		
			,"31px"
			,"32px"
			,"33px"
			,"34px"
			,"35px"
			,"36px"
			,"37px"
			,"38px"
			,"39px"	
			,"40px"	
			,"41px"
			,"42px"
			,"43px"
			,"44px"
			,"45px"
			,"46px"
			,"47px"
			,"48px"
			,"49px"	
			,"50px"		
		);
		
		$faces = array('Arial'=>'Arial',
					'Open Sans'=>'Open Sans',
					'Open Sans'=>'Open Sans',
					'Verdana'=>'Verdana, Geneva',
					'Trebuchet'=>'Trebuchet',
					'Georgia' =>'Georgia',
					'Times New Roman'=>'Times New Roman',
					'Tahoma, Geneva'=>'Tahoma, Geneva',
					'Palatino'=>'Palatino',
					'Helvetica'=>'Helvetica' );
										
		$url =  ADMIN_DIR . 'assets/images/';	

		$default_font_size = array_combine($default_font_size, $default_font_size);
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

/***************** TODO : GENERAL ****************/					


global $of_options,$wd_google_fonts;

$of_options = array();
					
$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);						
$of_options[] = array( 	"name" 		=> "Config Logo of Theme"
						,"desc" 	=> ""
						,"id" 		=> ""
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Config Logo of Theme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Logo image"
						,"desc" 	=> "Change your logo."
						,"id" 		=> "wd_logo"
						,"std"		=> $df_logo_images_uri
						,"type" 	=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Favor icon image"
						,"desc" 	=> "Accept ICO files"
						,"id" 		=> "wd_icon"
						,"std" 		=> $df_icon_images_uri
						,"type" 		=> "media"
				);
				
$of_options[] = array( 	"name" 		=> "Text Logo"
						,"desc" 	=> "Text Logo"
						,"id" 		=> "wd_text_logo"
						,"std" 		=> "Sneaker Theme"
						,"type" 	=> "text"
				);
$of_options[] = array( 	"name" 		=> "Banner Top Main Content Area"
						,"desc" 	=> ""
						,"id" 		=> ""
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Banner Top Main Content Area</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Banner Top Main Content"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_banner_top_main_content"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> "yes"
						,"off"		=> "no"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Banner Top Main Content"
						,"desc" 	=> "You can use the following shortcodes in your text: [wp-link] [theme-link] [loginout-link] [blog-title] [blog-link] [the-year]"
						,"id" 		=> "wd_banner_top_main_content"
						,"std" 		=> '<div style="text-align:center"><span style="color:#c30005">"IT \'S TIME CRAZY SHOPPING TIME"</span> with over <span>1000 GIFTS</span> and <span>FREE SHIPPING</span></div>'
						,"fold"		=> "wd_enable_banner_top_main_content"
						,"type" 	=> "textarea"
				);							
				
$of_options[] = array( 	"name" 		=> "Custom Image Size"
						,"desc" 	=> ""
						,"id" 		=> "introduction_custom_img_size"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Custom Image Size</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);								
				
			
$of_options[] = array( 	"name" 		=> "Size #1"
						,"desc" 	=> "Size #1 width.<br/>Min: 5, max: 1200, step: 5, default value: 1200"
						,"id" 		=> "wd_size1_width"
						,"std" 		=> "1200"
						,"min" 		=> "5"
						,"step"		=> "5"
						,"max" 		=> "1200"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Size #1 height.<br/>Min: 5, max: 1200, step: 5, default value: 450"
						,"id" 		=> "wd_size1_height"
						,"std" 		=> "450"
						,"min" 		=> "5"
						,"step"		=> "5"
						,"max" 		=> "1200"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> "Size #2"
						,"desc" 	=> "Size #2 width.<br /> Min: 5, max: 1200, step: 5, default value: 960"
						,"id" 		=> "wd_size2_width"
						,"std" 		=> "960"
						,"min" 		=> "5"
						,"step"		=> "5"
						,"max" 		=> "1200"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Size #2 height.<br /> Min: 5, max: 1200, step: 5, default value: 300"
						,"id" 		=> "wd_size2_height"
						,"std" 		=> "300"
						,"min" 		=> "5"
						,"step"		=> "5"
						,"max" 		=> "1200"
						,"type" 	=> "sliderui" 
				);


$of_options[] = array( 	"name" 		=> "Size #3"
						,"desc" 	=> "Size #3 width.<br /> Min: 5, max: 1200, step: 5, default value: 480"
						,"id" 		=> "wd_size3_width"
						,"std" 		=> "480"
						,"min" 		=> "5"
						,"step"		=> "5"
						,"max" 		=> "1200"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Size #3 height.<br /> Min: 5, max: 1200, step: 5, default value: 320"
						,"id" 		=> "wd_size3_height"
						,"std" 		=> "320"
						,"min" 		=> "5"
						,"step"		=> "5"
						,"max" 		=> "1200"
						,"type" 	=> "sliderui" 
				);				


$of_options[] = array( 	"name" 		=> "Right Sidebar Feedback Section"
						,"desc" 	=> ""
						,"id" 		=> "introduction_right_sidebar"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Right Sidebar Feedback Section</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);				
		
$of_options[] = array( 	"name" 		=> "Show Feedback Button"
						,"desc" 	=> "Show/Hide Feedback Button on Right"
						,"id" 		=> "wd_show_feedback_button"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);	

$of_options[] = array( 	"name" 		=> "Feedback Button Image"
						,"desc" 	=> "Change your Feedback button image."
						,"id" 		=> "wd_feedback_button_image"
						,"std"		=> $df_feedback_button_images_uri
						,"fold"		=> "wd_show_feedback_button"
						,"type" 	=> "upload"
				);
		
$of_options[] = array( 	"name" 		=> "Feedback Dialog Content"
						,"desc" 	=> 'You can use the contact form 7 shortcode : [contact-form-7 id="Your form ID" title="Your title"]'
						,"id" 		=> "wd_feedback_dialog_content"
						,"std" 		=> '[contact-form-7 id="4" title="Contact form 1"]'
						,"fold"		=> "wd_show_feedback_button"
						,"type" 	=> "textarea"
						
				);		
				

/***************** TODO : STYLE ****************/					
				
$of_options[] = array( 	"name" 		=> "Styling Options"
						,"type" 	=> "heading"
				);
		
$of_options[] = array( 	"name" 		=> "Preview Panel"
						,"desc" 	=> "Preview Panel allow you to view,change style on frontend"
						,"id" 		=> "wd_preview_panel"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);
			
$of_options[] = array( 	"name" 		=> "Enable NiceScroll"
						,"desc" 	=> "Enable Nice Scroll Bar on the right browsers"
						,"id" 		=> "wd_nicescroll"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Enable Sticky Menu"
						,"desc" 	=> "Enable Sticky Menu on top pages"
						,"id" 		=> "wd_sticky_menu"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Enable Effect Product Images"
						,"desc" 	=> "Enable Effect Product Images"
						,"id" 		=> "wd_effect_product"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Layout Style"
						,"desc" 	=> ""
						,"id" 		=> "wd_layout_styles"
						,"std" 		=> "wide"
						,"type" 	=> "select"
						,"options"	=> array("wide","box")
				);				
				
$of_options[] = array( 	"name" 		=> "Theme Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_them_color"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Theme Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);					
				
		
$of_options[] = array( 	"name" 		=> "Theme Primary Scheme Color"
						,"desc" 	=> "Background color of Feedback,Calendar header, Logo. 
										Hover Color of Link text, Category title, Shopping cart text, Remove button in cart table"
						,"id" 		=> "wd_theme_color_primary"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Theme Secondary Scheme Color"
						,"desc" 	=> "Color of Theme Secondary.
										Background Hover Color of Submit button in shop table, Search button, link in Navigation tab.
										Border color of Logout button, Reply button"
						,"id" 		=> "wd_theme_color_secondary"
						,"std" 		=> "#c30005"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Main Content Background"
						,"desc" 	=> "Color of Main Content Background."
						,"id" 		=> "wd_main_content_background"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
									

$of_options[] = array( 	"name" 		=> "Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_text_color"
						,"std" 		=> "#969696"
						,"type" 	=> "color"
				);

$of_options[] = array( 	"name" 		=> "Link Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_link_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);		

$of_options[] = array( 	"name" 		=> "Link Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_link_color_hover"
						,"std" 		=> "#c30005"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Button Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_background"
						,"std" 		=> "#c30005"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Button Background Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_background_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Button Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_text"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Button Text Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_text_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Heading Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_heading_color"
						,"std" 		=> "#141414"
						,"type" 	=> "color"
				);		
				
/* ***********************************************************************************************/					
$of_options[] = array( 	"name" 		=> "Top Header Background"
						,"desc" 	=> ""
						,"id" 		=> "wd_header_top_background"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Top Header Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_header_top_text_color"
						,"std" 		=> "#c8c8c8"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Top Header Text Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_header_top_text_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
/* ***********************************************************************************************/					

$of_options[] = array( 	"name" 		=> "Menu Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_menu"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Menu Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);					
				
$of_options[] = array( 	"name" 		=> "Background menu header"
						,"desc" 	=> ""
						,"id" 		=> "wd_menu_background"
						,"std" 		=> "#dcdcdc"
						,"type" 	=> "color"
				);				

		
$of_options[] = array( 	"name" 		=> "Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_menu_text_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Text Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_menu_text_color_hover"
						,"std" 		=> "#c30005"
						,"type" 	=> "color"
				);

/* ***********************************************************************************************/
				
$of_options[] = array( 	"name" 		=> "Sub Menu Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_submenu"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Sub Menu Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);									
		
$of_options[] = array( 	"name" 		=> "Sub Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_sub_menu_text_color"
						,"std" 		=> "#969696"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Sub Text Hover Color "
						,"desc" 	=> ""
						,"id" 		=> "wd_sub_menu_text_color_hover"
						,"std" 		=> "#c30005"
						,"type" 	=> "color"
				);

$of_options[] = array( 	"name" 		=> "Sub Border"
						,"desc" 	=> ""
						,"id" 		=> "wd_sub_menu_border"
						,"std" 		=> "#cccccc"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Sub Menu Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_sub_menu_background"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);					

/* ***********************************************************************************************/
$of_options[] = array( 	"name" 		=> "Phone Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_cart"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Phone Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	

				
$of_options[] = array( 	"name" 		=> "Phone Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_phone_background"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Phone Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_phone_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	
$of_options[] = array( 	"name" 		=> "Phone Sub Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_phone_sub_text_color"
						,"std" 		=> "#aaaaaa"
						,"type" 	=> "color"
				);					


/* ***********************************************************************************************/

$of_options[] = array( 	"name" 		=> "Primary Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_cart"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Primary Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$of_options[] = array( 	"name" 		=> "Title SideBar Backgound Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_sidebar_title_background"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);	
				
$of_options[] = array( 	"name" 		=> "Title SideBar Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_sidebar_title_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Testimonial Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_testimonial_background"
						,"std" 		=> "#dcdcdc"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Special Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_special_color"
						,"std" 		=> "#00387f"
						,"type" 	=> "color"
				);
				
			
$of_options[] = array( 	"name" 		=> "Border Color"
						,"desc" 	=> "Table border, Product border Hover Color, input border,... "
						,"id" 		=> "wd_border_color"
						,"std" 		=> "#dcdcdc"
						,"type" 	=> "color"
				);	
				
$of_options[] = array( 	"name" 		=> "Border Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_border_color_hover"
						,"std" 		=> "#aaaaaa"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Social Border Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_social_border"
						,"std" 		=> "#969696"
						,"type" 	=> "color"
				);	
				
$of_options[] = array( 	"name" 		=> "Social Border Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_social_text"
						,"std" 		=> "#969696"
						,"type" 	=> "color"
				);
				
/* ***********************************************************************************************/

$of_options[] = array( 	"name" 		=> "Portfolio Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_cart"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Portfolio Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
				
$of_options[] = array( 	"name" 		=> "Portfolio Link Title Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_link_title_portfolio"
						,"std" 		=> "#969696"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Portfolio Link Title Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_link_title_portfolio_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				
				
$of_options[] = array( 	"name" 		=> "Portfolio Button Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_background_button_portfolio"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Portfolio Button Background Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_background_button_portfolio_hover"
						,"std" 		=> "#c30005"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Portfolio Border Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_border_portfolio_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				

/* ************************************ Quickshop *************************************************/
if ( in_array( 'wd_quickshop/wd_quickshop.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	$of_options[] = array( 	"name" 		=> "Quickshop Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_quickshop"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Quickshop Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
	$of_options[] = array( 	"name" 		=> "Quickshop Background Color"
							,"desc" 	=> ""
							,"id" 		=> "wd_quickshop_background"
							,"std" 		=> "#000000"
							,"type" 	=> "color"
					);	
	$of_options[] = array( 	"name" 		=> "Quickshop Text Color"
							,"desc" 	=> ""
							,"id" 		=> "wd_quickshop_text_color"
							,"std" 		=> "#ffffff"
							,"type" 	=> "color"
					);
	$of_options[] = array( 	"name" 		=> "Quickshop Background Color Hover"
							,"desc" 	=> ""
							,"id" 		=> "wd_quickshop_background_hover"
							,"std" 		=> "#c30005"
							,"type" 	=> "color"
					);	
	$of_options[] = array( 	"name" 		=> "Quickshop Text Color Hover"
							,"desc" 	=> ""
							,"id" 		=> "wd_quickshop_text_color_hover"
							,"std" 		=> "#ffffff"
							,"type" 	=> "color"
					);
}

/* ***********************************************************************************************/

$of_options[] = array( 	"name" 		=> "Product Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_cart"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Product Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	

$of_options[] = array( 	"name" 		=> "Product Name Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_product_name_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Button Cart Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_cart_background"
						,"std" 		=> "#c8c8c8"
						,"type" 	=> "color"
				);	
$of_options[] = array( 	"name" 		=> "Button Cart Background Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_cart_background_hover"
						,"std" 		=> "#c30005"
						,"type" 	=> "color"
				);		
$of_options[] = array( 	"name" 		=> "Button Cart Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_cart_text"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Button Cart Text Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_cart_text_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);				

$of_options[] = array( 	"name" 		=> "Text Price Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_text_price_color"
						,"std" 		=> "#646464"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Rating Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_rating_color"
						,"std" 		=> "#c30005"
						,"type" 	=> "color"
				);	
				
$of_options[] = array( 	"name" 		=> "Text Price Sale Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_text_price_sale_color"
						,"std" 		=> "#c30005"
						,"type" 	=> "color"
				);	

$of_options[] = array( 	"name" 		=> "Feature Sale Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_feature_sale"
						,"std" 		=> "#003782"
						,"type" 	=> "color"
				);	
				
$of_options[] = array( 	"name" 		=> "Feature Sale Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_feature_sale_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	

$of_options[] = array( 	"name" 		=> "Feature New Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_feature_new"
						,"std" 		=> "#f5d200"
						,"type" 	=> "color"
				);	
				
$of_options[] = array( 	"name" 		=> "Feature New Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_feature_new_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

$of_options[] = array( 	"name" 		=> "Feature Hot Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_feature_hot"
						,"std" 		=> "#c8000a"
						,"type" 	=> "color"
				);	
				
$of_options[] = array( 	"name" 		=> "Feature Hot Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_feature_hot_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Button Slider Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_slider_background"
						,"std" 		=> "#1e1e1e"
						,"type" 	=> "color"
				);	
				
$of_options[] = array( 	"name" 		=> "Button Slider Icon Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_slider_icon"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	
				
$of_options[] = array( 	"name" 		=> "Button Slider Icon Color Hover"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_slider_icon_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				
		
/* ****************************************************************************************************************/
$of_options[] = array( 	"name" 		=> "Footer Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_footer_color_scheme"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Footer Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Body End Background Color"
						,"desc" 	=> "Color of Body End Background Color."
						,"id" 		=> "wd_body_end_background"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Footer Area Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_background"
						,"std" 		=> "#eeeeee"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Subscriptions Footer Area Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_subscriptions_background"
						,"std" 		=> "#eeeeee"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "End Footer Area Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_end_background"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "End Footer Area Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_end_text"
						,"std" 		=> "#646464"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "End Footer Area Menu Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_end_menu_text"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "End Footer Area Menu Text Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_end_menu_text_hover"
						,"std" 		=> "#969696"
						,"type" 	=> "color"
				);
			
		
/***************** TODO : TYPO ****************/		

$of_options[] = array( 	"name" 		=> "Typography"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-typography.gif"
				);
		
$of_options[] = array( 	"name" 		=> "Body Font"
						,"desc" 	=> ""
						,"id" 		=> "introduction_bodyfont"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Body Font Options.</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);				
					
$of_options[] = array( 	"name" 		=> "Body font with Google font"
						,"desc" 	=> "Using google font for your body font"
						,"id" 		=> "wd_body_font_googlefont_enable"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on" 		=> "Family Font"
						,"off" 		=> "Google Font"
						,"type" 	=> "switchs"
				);
					
$of_options[] = array( 	"name" 		=> "Body Font"
						,"desc" 	=> "Specify the body font properties.Using in case google font disabled"
						,"id" 		=> "wd_body_font_family"
						,"position"	=> "left"
						,"fold"		=> "wd_body_font_googlefont_enable"
						,"std" 		=> "Arial"
						,"type" 	=> "select"
						,"options"	=> $faces
				);					
									
					
$of_options[] = array( 	"name" 		=> "Body Google Font"
						,"desc" 	=> "This font going to overwrite the default font."
						,"id" 		=> "wd_body_font_googlefont"
						,"position"	=> "right"
						,"std" 		=> "Roboto"
						,"type" 	=> "select_google_font"
						,"fold"		=> "wd_body_font_googlefont_enable"
						,"preview" 	=> array(
										"text" => "This is my body font preview!"
										,"size" => "30px"
						)
						,"options" 	=> $wd_google_fonts
				);		

/*Body second font*/
$of_options[] = array( 	"name" 		=> "Body Second Font"
						,"desc" 	=> ""
						,"id" 		=> "introduction_bodysecondfont"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Body Second Font Options.</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);				
					
$of_options[] = array( 	"name" 		=> "Body second font with Google font"
						,"desc" 	=> "Using google font for your body second font"
						,"id" 		=> "wd_body_second_font_googlefont_enable"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on" 		=> "Family Font"
						,"off" 		=> "Google Font"
						,"type" 	=> "switchs"
				);
					
$of_options[] = array( 	"name" 		=> "Body Second Font"
						,"desc" 	=> "Specify the body second font properties.Using in case google font disabled"
						,"id" 		=> "wd_body_second_font_family"
						,"position"	=> "left"
						,"fold"		=> "wd_body_second_font_googlefont_enable"
						,"std" 		=> "Open Sans"
						,"type" 	=> "select"
						,"options"	=> $faces
				);					
									
					
$of_options[] = array( 	"name" 		=> "Body Second Google Font"
						,"desc" 	=> "This font going to overwrite the default font."
						,"id" 		=> "wd_body_second_font_googlefont"
						,"position"	=> "right"
						,"std" 		=> "Roboto"
						,"type" 	=> "select_google_font"
						,"fold"		=> "wd_body_second_font_googlefont_enable"
						,"preview" 	=> array(
										"text" => "This is my body second font preview!"
										,"size" => "30px"
						)
						,"options" 	=> $wd_google_fonts
				);		
				
				
/*Heading font*/
					
$of_options[] = array( 	"name" 		=> "Heading Font"
						,"desc" 	=> ""
						,"id" 		=> "introduction_headingfont"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Heading Font Options.</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);						
					
$of_options[] = array( 	"name" 		=> "Heading font with Google font"
						,"desc" 	=> "Using google font for your heading font"
						,"id" 		=> "wd_heading_font_googlefont_enable"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on" 		=> "Family Font"
						,"off" 		=> "Google Font"
						,"type" 	=> "switchs"
				);
					
$of_options[] = array( 	"name" 		=> "Heading Font"
						,"desc" 	=> "Specify the body font properties.Using in case google font disabled"
						,"id" 		=> "wd_heading_fontfamily"
						,"position"	=> "left"
						,"fold"		=> "wd_heading_font_googlefont_enable"
						,"std" 		=> "Open Sans"
						,"type" 	=> "select"
						,"options"	=> $faces
				);					
					
$of_options[] = array( 	"name" 		=> "Heading Google Font"
						,"desc" 	=> "This font going to overwrite the default font."
						,"id" 		=> "wd_heading_font_googlefont"
						,"std" 		=> "Share"
						,"position"	=> "right"
						,"type" 	=> "select_google_font"
						,"fold"		=> "wd_heading_font_googlefont_enable"
						,"preview" 	=> array(
										"text" => "This is my heading font preview!"
										,"size" => "30px"
						)
						,"options" 	=> $wd_google_fonts
				);	

			
/*Menu font*/			
$of_options[] = array( 	"name" 		=> "Menu Font"
						,"desc" 	=> ""
						,"id" 		=> "introduction_menufont"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Menu Font Options.</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$of_options[] = array( 	"name" 		=> "Menu font with Google font"
						,"desc" 	=> "Using google font for your top menu font"
						,"id" 		=> "wd_menu_font_googlefont_enable"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on" 		=> "Family Font"
						,"off" 		=> "Google Font"
						,"type" 	=> "switchs"
				);
					
$of_options[] = array( 	"name" 		=> "Menu Font"
						,"desc" 	=> "Specify the menu font properties.Using in case google font disabled"
						,"id" 		=> "wd_menu_fontfamily"
						,"position"	=> "left"
						,"fold"		=> "wd_menu_font_googlefont_enable"
						,"std" 		=> "Open Sans"
						,"type" 	=> "select"
						,"options"	=> $faces
				);					
					
$of_options[] = array( 	"name" 		=> "Menu Google Font Select"
						,"desc" 	=> "This font going to overwrite the default font."
						,"id" 		=> "wd_menu_font_googlefont"
						,"std" 		=> "Share"
						,"position"	=> "right"
						,"type" 	=> "select_google_font"
						,"fold"		=> "wd_menu_font_googlefont_enable"
						,"preview" 	=> array(
										"text" => "This is my menu font preview!"
										,"size" => "30px"
						)
						,"options" 	=> $wd_google_fonts
				);	
/*Submenu font*/
$of_options[] = array( 	"name" 		=> "Sub Menu Font"
						,"desc" 	=> ""
						,"id" 		=> "introduction_submenufont"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Sub Menu Font Options.</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Sub Menu Font with Google font"
						,"desc" 	=> "Using google font for your sub menu font"
						,"id" 		=> "wd_sub_menu_font_googlefont_enable"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on" 		=> "Family Font"
						,"off" 		=> "Google Font"
						,"type" 	=> "switchs"
				);
					
$of_options[] = array( 	"name" 		=> "Sub Menu Default Font"
						,"desc" 	=> "Specify the Sub menu font properties.Using in case google font disabled"
						,"id" 		=> "wd_sub_menu_fontfamily"
						,"std" 		=> "Open Sans"
						,"position"	=> "right"
						,"type" 	=> "select_google_font"
						,"fold"		=> "wd_menu_font_googlefont_enable"
						,"preview" 	=> array(
										"text" => "This is my menu font preview!"
										,"size" => "30px"
						)
						,"options" 	=> $wd_google_fonts
				);					
					
$of_options[] = array( 	"name" 		=> "Sub Menu Google Font Select"
						,"desc" 	=> "This font going to overwrite the default font."
						,"id" 		=> "wd_sub_menu_font_googlefont"
						,"std" 		=> "Roboto"
						,"position"	=> "right"
						,"type" 	=> "select_google_font"
						,"fold"		=> "wd_sub_menu_font_googlefont_enable"
						,"preview" 	=> array(
										"text" => "This is my Sub menu font preview!"
										,"size" => "30px"
						)
						,"options" 	=> $wd_google_fonts
				);	
/*Price font*/				
$of_options[] = array( 	"name" 		=> "Price Font"
						,"desc" 	=> ""
						,"id" 		=> "introduction_pricefont"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Price Font Options.</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Price Font with Google font"
						,"desc" 	=> "Using google font for your price font"
						,"id" 		=> "wd_price_font_googlefont_enable"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on" 		=> "Family Font"
						,"off" 		=> "Google Font"
						,"type" 	=> "switchs"
				);
					
$of_options[] = array( 	"name" 		=> "Price Default Font"
						,"desc" 	=> "Specify the price font properties.Using in case google font disabled"
						,"id" 		=> "wd_price_fontfamily"
						,"std" 		=> 'Open Sans'
						,"position"	=> "left"
						,"fold"		=> "wd_price_font_googlefont_enable"
						,"type" 	=> "select"
						,"options"	=> $faces
				);					
					
$of_options[] = array( 	"name" 		=> "Price Google Font Select"
						,"desc" 	=> "This font going to overwrite the default font."
						,"id" 		=> "wd_price_font_googlefont"
						,"std" 		=> "Roboto"
						,"position"	=> "right"
						,"type" 	=> "select_google_font"
						,"fold"		=> "wd_price_font_googlefont_enable"
						,"preview" 	=> array(
										"text" => "This is my price font preview!"
										,"size" => "30px"
						)
						,"options" 	=> $wd_google_fonts
				);	
				
// $of_options[] = array( 	"name" 		=> "Menu Font Size"
						// ,"desc" 	=> "Specify the menu font size properties."
						// ,"id" 		=> "wd_menu_fontsize"
						// ,"std" 		=> "12px"
						// ,"type" 	=> "select"
						// ,"options"	=>	$default_font_size
				// );	  
 /**************************** TODO : FOOTER **************************************/							
$of_options[] = array( 	"name" 		=> "Footer Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Copyright Section"
						,"desc" 	=> ""
						,"id" 		=> "introduction_custom_copyright"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Copyright Section</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);				
				
$of_options[] = array( 	"name" 		=> "Footer Copyright"
						,"desc" 	=> "You can use the following shortcodes in your footer text: [wp-link] [theme-link] [loginout-link] [blog-title] [blog-link] [the-year]"
						,"id" 		=> "footer_text"
						,"std" 		=> '&copy; 2014 Sneaker Demo Store. Designed by <a href="http://wpdance.com/" title="WordPress Themes">WPDance.com</a>. WPDance is a member of <a href="http://www.emthemes.com/" title="Magento Themes">EMThemes</a>'
						,"type" 	=> "textarea"
				);

$of_options[] = array( 	"name" 		=> "Show Body End Widget Area"
						,"desc" 	=> "Show/Hide Body End Widget Area"
						,"id" 		=> "wd_show_body_end_widget_area"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Show First Footer Widget Area"
						,"desc" 	=> "Show/Hide First Footer Widget Area"
						,"id" 		=> "wd_show_first_footer_widget_area"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Show Footer Menu"
						,"desc" 	=> "Show/Hide Footer Menu"
						,"id" 		=> "wd_show_footer_menu"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);	
$of_options[] = array( 	"name" 		=> "Show End Footer Area"
						,"desc" 	=> "Show/Hide End Footer Area (Copyright)"
						,"id" 		=> "wd_show_end_footer_area"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);	

$of_options[] = array( 	"name" 		=> "Paypal image"
						,"desc" 	=> "Change your Paypal image."
						,"id" 		=> "wd_paypal_image"
						,"std"		=> $df_paypal_images_uri
						,"type" 	=> "upload"
				);				
$of_options[] = array( 	"name" 		=> "Visa image"
						,"desc" 	=> "Change your Visa image."
						,"id" 		=> "wd_visa_image"
						,"std"		=> $df_visa_images_uri
						,"type" 	=> "upload"
				);
$of_options[] = array( 	"name" 		=> "Master Card image"
						,"desc" 	=> "Change your Master Card image."
						,"id" 		=> "wd_master_card_image"
						,"std"		=> $df_mastercard_images_uri
						,"type" 	=> "upload"
				);
$of_options[] = array( 	"name" 		=> "Verified Visa image"
						,"desc" 	=> "Change your Verified Visa image."
						,"id" 		=> "wd_verified_visa_image"
						,"std"		=> $df_verified_images_uri
						,"type" 	=> "upload"
				);
$of_options[] = array( 	"name" 		=> "Trusted Visa image"
						,"desc" 	=> "Change your Trusted Visa image."
						,"id" 		=> "wd_trusted_visa_image"
						,"std"		=> $df_trusted_images_uri
						,"type" 	=> "upload"
				);				
				

/***************** TODO : Mega Menu ****************/		

$of_options[] = array( 	"name" 		=> "Mega Menu"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "slider-control.png"
				);
					

$of_options[] = array( 	"name" 		=> "Menu Thumbnail Size"
						,"desc" 	=> "Thumbnail width.<br /> Min: 5, max: 48, step: 1, default value: 16"
						,"id" 		=> "wd_menu_thumb_width"
						,"std" 		=> "16"
						,"min" 		=> "5"
						,"step"		=> "1"
						,"max" 		=> "48"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height.<br /> Min: 5, max: 48, step: 1, default value: 16"
						,"id" 		=> "wd_menu_thumb_height"
						,"std" 		=> "16"
						,"min" 		=> "5"
						,"step"		=> "1"
						,"max" 		=> "48"
						,"type" 	=> "sliderui" 
				);		

$of_options[] = array( 	"name" 		=> "Mega Menu Widget Area"
						,"desc" 	=> "Number Widget Area Available.<br /> Min: 1, max: 30, step: 1, default value: 5"
						,"id" 		=> "wd_menu_num_widget"
						,"std" 		=> "5"
						,"min" 		=> "1"
						,"step"		=> "1"
						,"max" 		=> "30"
						,"type" 	=> "sliderui" 
				);				


/***************** TODO : Quickshop ****************/		

/**
 * Check if WD Quickshop is active
 **/

if ( in_array( 'wd_quickshop/wd_quickshop.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	$df_qs_images_uri = get_stylesheet_directory_uri(). '/images/quickshop.png'; 

	$of_options[] = array( 	"name" 		=> "Quickshop Options"
							,"type" 	=> "heading"
							,"icon"		=> ADMIN_IMAGES . "icon-settings.png"
					);		

	$of_options[] = array( 	"name" 		=> "Button Label"
							,"desc" 	=> "Change button label"
							,"id" 		=> "wd_qs_button_label"
							,"std" 		=> __("Quickshop","wpdance")
							,"type" 	=> "text"
					);	

	$of_options[] = array( 	"name" 		=> "Button image"
							,"desc" 	=> "Change your button image.Leave blank to use button label"
							,"id" 		=> "wd_qs_button_imgage"
							,"std"		=> ""
							,"type" 	=> "upload"
					);	
	
	$of_options[] = array( 	"name" 		=> "Product Title"
							,"desc" 	=> "Show/hide product title"
							,"id" 		=> "wd_qs_product_title"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Label"
							,"desc" 	=> "Show/hide product label"
							,"id" 		=> "wd_qs_product_label"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Availability"
							,"desc" 	=> "Show/hide product availability"
							,"id" 		=> "wd_qs_product_availability"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product SKU"
							,"desc" 	=> "Show/hide product sku"
							,"id" 		=> "wd_qs_product_sku"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Rating"
							,"desc" 	=> "Show/hide product rating"
							,"id" 		=> "wd_qs_product_rating"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Short Description"
							,"desc" 	=> "Show/hide product short description"
							,"id" 		=> "wd_qs_product_short_description"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Add To Cart"
							,"desc" 	=> "Show/hide product add to cart"
							,"id" 		=> "wd_qs_product_add_to_cart"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
}

		
				
/***************** TODO : Advertisement ****************/		

$of_options[] = array( 	"name" 		=> "Advertisement"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-edit.png"
				);
				
$of_options[] = array( 	"name" 		=> "Enable Advertisement"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_advertisement"
						,"std" 		=> 0
						,"folds"	=> 1
						,"on"		=> "yes"
						,"off"		=> "no"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Advertisement Code"
						,"desc" 	=> "Input Html/Js Advertisement Code."
						,"id" 		=> "wd_advertisement_code"
						,"std" 		=> '<div class="wd-shipping"><a style="color:#00387f" class="shipping" href="#">Free shipping for over $200.00 orders</a><a style="color:#c30005" class="gifts" href="#">Gifts for over $100 orders </a></div>
<ul class="menu-advertisment">
										<li><a href="#">$5 DVDs</a></li>
										<li><a href="#">$10 Blu-ray Discs</a></li>
										<li><a href="#">Preorders</a></li>
										<li><a class="wd-important" href="#">Deals</a></li>
										</ul>'
						,"fold"		=> "wd_enable_advertisement"
						,"type" 	=> "textarea"
				);	
				
				
				
/***************** TODO : Integration ****************/	
			
$of_options[] = array( 	"name" 		=> "Integration"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-add.png"
				);			
	
$of_options[] = array( 	"name" 		=> "Top Blog Details Codes"
						,"desc" 	=> "Quickly add some html/css to top of blog details by adding it to this block."
						,"id" 		=> "wd_top_blog_code"
						,"std" 		=> ""
						,"type" 	=> "textarea"
				);
				
$of_options[] = array( 	"name" 		=> "Bottom Blog Details Codes"
						,"desc" 	=> "Quickly add some html/css to bottom of blog details by adding it to this block."
						,"id" 		=> "wd_bottom_blog_code"
						,"std" 		=> ""
						,"type" 	=> "textarea"
				);

$of_options[] = array( 	"name" 		=> "Before Body End Code"
						,"desc" 	=> "Quickly add some html/css adding it to this block."
						,"id" 		=> "wd_before_body_end_code"
						,"std" 		=> ""
						,"type" 	=> "textarea"
				);				
	
$of_options[] = array( 	"name" 		=> "Google Analytic Code"
						,"desc" 	=> "Quickly add some html/css adding it to this block."
						,"id" 		=> "wd_google_analytic_code"
						,"std" 		=> ""
						,"type" 	=> "textarea"
				);	
/*	
$of_options[] = array( 	"name" 		=> "Custom CSS"
						,"desc" 	=> "Quickly add some CSS to your theme by adding it to this block."
						,"id" 		=> "wd_custom_css"
						,"std" 		=> ""
						,"type" 	=> "textarea"
				);
*/	
/***************** TODO : Shop Shortcode Slider Options ****************/	
$of_options[] = array( 	"name" 		=> "Shop Shortcode Slider"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "slider-control.png"
				);	
$of_options[] = array( 	"name" 		=> "Slide Speed on PC"
						,"desc" 	=> "In ms, default is 800"
						,"id" 		=> "wd_shop_slider_slide_speed_pc"
						,"std" 		=> "800"
						,"type" 	=> "text"
					);
$of_options[] = array( 	"name" 		=> "Slide Speed on Mobile"
						,"desc" 	=> "In ms, default is 200"
						,"id" 		=> "wd_shop_slider_slide_speed_mobile"
						,"std" 		=> "200"
						,"type" 	=> "text"
					);
$of_options[] = array( 	"name" 		=> "Scroll Per Page"
						,"desc" 	=> "Enable/Disable scroll per page"
						,"id" 		=> "wd_shop_slider_scroll_per_page"
						,"std" 		=> 0
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Rewind Navigation"
						,"desc" 	=> "Enable/Disable Slide to First Item"
						,"id" 		=> "wd_shop_slider_rewind_nav"
						,"std" 		=> 1
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Rewind Speed"
						,"desc" 	=> "In ms, default is 800"
						,"id" 		=> "wd_shop_slider_rewind_speed"
						,"std" 		=> "800"
						,"fold" 	=> "wd_shop_slider_rewind_nav"
						,"type" 	=> "text"
					);
$of_options[] = array( 	"name" 		=> "Auto Play"
						,"desc" 	=> "Enable/Disable Auto Play"
						,"id" 		=> "wd_shop_slider_auto_play"
						,"std" 		=> 0
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Stop on hover"
						,"desc" 	=> "Enable/Disable Stop autoplay on mouse hover"
						,"id" 		=> "wd_shop_slider_stop_on_hover"
						,"std" 		=> 0
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"fold" 	=> "wd_shop_slider_auto_play"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Mouse Drag"
						,"desc" 	=> "Enable/Disable Mouse Drag"
						,"id" 		=> "wd_shop_slider_mouse_drag"
						,"std" 		=> 0
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Touch Drag"
						,"desc" 	=> "Enable/Disable Touch Drag"
						,"id" 		=> "wd_shop_slider_touch_drag"
						,"std" 		=> 1
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);
					
								
/***************** TODO : Product Category Options ****************/							
$of_options[] = array( 	"name" 		=> "Product Category"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
$of_options[] = array( 	"name" 		=> "Category Columns"
						,"id" 		=> "wd_prod_cat_column"
						,"std" 		=> "4"
						,"type" 	=> "select"
						,"mod"		=> "mini"
						,"options" 	=> array(2,3,4,6)
				);
$of_options[] = array( 	"name" 		=> "The Number Of Products Per Page"
                        ,"desc" 	=> "Set the number of products per page"
                        ,"id" 		=> "wd_prod_cat_per_page"
                        ,"std" 		=> 12
                        ,"type" 	=> "text"
        );				

$of_options[] = array( 	"name" 		=> "Category Layout"
						,"desc" 	=> "Select main content and sidebar alignment. Choose between 1, 2 column layout."
						,"id" 		=> "wd_prod_cat_layout"
						,"std" 		=> "0-1-1"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> $url . '1col.png'
							,'0-1-1' 	=> $url . '2cr.png'
							,'1-1-0' 	=> $url . '2cl.png'
							,'1-1-1' 	=> $url . '3cm.png'
						)
				);								

$of_options[] = array( 	"name" 		=> "Left Sidebar"
						,"id" 		=> "wd_prod_cat_left_sidebar"
						,"std" 		=> "category-widget-area-left"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);

$of_options[] = array( 	"name" 		=> "Right Sidebar"
						,"id" 		=> "wd_prod_cat_right_sidebar"
						,"std" 		=> "category-widget-area-right"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);
$of_options[] = array( 	"name" 		=> "Product Rating"
						,"desc" 	=> "Show/hide Product Rating"
						,"id" 		=> "wd_prod_cat_rating"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Categories"
						,"desc" 	=> "Show/hide Product Categories"
						,"id" 		=> "wd_prod_cat_categories"
						,"std" 		=> 0
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Title"
						,"desc" 	=> "Show/hide Product Title"
						,"id" 		=> "wd_prod_cat_title"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Sku"
						,"desc" 	=> "Show/hide Product Sku"
						,"id" 		=> "wd_prod_cat_sku"
						,"std" 		=> 0
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Product Discription on Grid Mode"
						,"desc" 	=> "Show/hide Discription on Grid Mode"
						,"id" 		=> "wd_prod_cat_disc_grid"
						,"std" 		=> 0
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
				
			
				
$of_options[] = array( 	"name" 		=> "Product Discription on List Mode"
						,"desc" 	=> "Show/hide Product Discription on List Mode"
						,"id" 		=> "wd_prod_cat_disc_list"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Product Price"
						,"desc" 	=> "Show/hide Product Price"
						,"id" 		=> "wd_prod_cat_price"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Add To Cart"
						,"desc" 	=> "Show/hide Product Add To Cart Button"
						,"id" 		=> "wd_prod_cat_add_to_cart"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
				
/***************** TODO : Product Details Options ****************/	
$of_options[] = array( 	"name" 		=> "Product Details"
						,"type" 		=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);	

$of_options[] = array( 	"name" 		=> "Product Layout"
						,"desc" 	=> "Select main content and sidebar alignment. Choose between 1, 2 column layout."
						,"id" 		=> "wd_prod_layout"
						,"std" 		=> "0-1-1"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> $url . '1col.png'
							,'0-1-1' 	=> $url . '2cr.png'
							,'1-1-0' 	=> $url . '2cl.png'
							,'1-1-1' 	=> $url . '3cm.png'
						)
				);				

$of_options[] = array( 	"name" 		=> "Left Sidebar"
						,"id" 		=> "wd_prod_left_sidebar"
						,"std" 		=> "product-widget-area-left"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);	
$of_options[] = array( 	"name" 		=> "Right Sidebar"
						,"id" 		=> "wd_prod_right_sidebar"
						,"std" 		=> "product-widget-area-right"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);				

$of_options[] = array( 	"name" 		=> "Product Image"
						,"desc" 	=> "Show/hide Product Image"
						,"id" 		=> "wd_prod_image"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Cloud-zoom"
						,"desc" 	=> "Show/hide Product Cloud-zoom"
						,"id" 		=> "wd_prod_cloudzoom"
						,"std" 		=> 1
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);	

$of_options[] = array( 	"name" 		=> "Product Label"
						,"desc" 	=> "Show/hide Product Label"
						,"id" 		=> "wd_prod_label"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
	

$of_options[] = array( 	"name" 		=> "Product Title"
						,"desc" 	=> "Show/hide Product Title"
						,"id" 		=> "wd_prod_title"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Email to Friend"
						,"desc" 	=> "Show/hide Email to Friend"
						,"id" 		=> "wd_prod_email_friend"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);	

$of_options[] = array( 	"name" 		=> "Product Sku"
						,"desc" 	=> "Show/hide Product Sku"
						,"id" 		=> "wd_prod_sku"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Rating"
						,"desc" 	=> "Show/hide Product Rating"
						,"id" 		=> "wd_prod_rating"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);			
$of_options[] = array( 	"name" 		=> "Product Review"
						,"desc" 	=> "Show/hide Product Review"
						,"id" 		=> "wd_prod_review"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
	

$of_options[] = array( 	"name" 		=> "Product Availability"
						,"desc" 	=> "Show/hide Product Availability"
						,"id" 		=> "wd_prod_availability"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
	

$of_options[] = array( 	"name" 		=> "Product AddToCart Button"
						,"desc" 	=> "Show/hide Product AddToCart Button"
						,"id" 		=> "wd_prod_cart"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);


$of_options[] = array( 	"name" 		=> "Product Price"
						,"desc" 	=> "Show/hide Product Price"
						,"id" 		=> "wd_prod_price"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);


$of_options[] = array( 	"name" 		=> "Product Short Desc"
						,"desc" 	=> "Show/hide Product Short Desc"
						,"id" 		=> "wd_prod_shortdesc"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);



$of_options[] = array( 	"name" 		=> "Product Meta(Tags,Categories) "
						,"desc" 	=> "Show/hide Product Meta(Tags,Categories) "
						,"id" 		=> "wd_prod_meta"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
	

$of_options[] = array( 	"name" 		=> "Product Related Products"
						,"desc" 	=> "Show/hide Product Related Products"
						,"id" 		=> "wd_prod_related"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);
	
$of_options[] = array( 	"name" 		=> "Related Product Title"
						,"id" 		=> "wd_prod_related_title"
						,"std" 		=> __('RELATED ITEMS','wpdance')
						,"fold" 	=> "wd_prod_related"
						,"type" 	=> "text"
				);			
/*				
$of_options[] = array( 	"name" 		=> "Related Product Number"
						,"desc" 	=> "Number of related products"
						,"id" 		=> "wd_prod_related_num"
						,"std" 		=> 6
						,"fold" 	=> "wd_prod_related"
						,"type" 	=> "select"
						,"mod"		=> "mini"
						,"options" 	=> array(3,4,5,6,7,8,9)
				);	*/		
$of_options[] = array( 	"name" 		=> "Product Upsell"
						,"desc" 	=> "Show/hide Product Upsell"
						,"id" 		=> "wd_prod_upsell"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);			
$of_options[] = array( 	"name" 		=> "Upsell Product Title"
						,"id" 		=> "wd_prod_upsell_title"
						,"std" 		=> __('YOU MAY ALSO LIKE','wpdance')
						,"fold" 	=> "wd_prod_upsell"
						,"type" 	=> "text"
				);			
			
$of_options[] = array( 	"name" 		=> "Product Share"
						,"desc" 	=> "Show/hide Product Social Sharing"
						,"id" 		=> "wd_prod_share"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Share"
						,"id" 		=> "wd_prod_share_title"
						,"std" 		=> __('Share thist','wpdance')
						,"fold" 	=> "wd_prod_share"
						,"type" 	=> "text"
				);	
/*
$of_options[] = array( 	"name" 		=> "Product Sharing Code"
						,"id" 		=> "wd_prod_share_code"
						,"std" 		=> "Share This"
						,"fold" 	=> "wd_prod_share"
						,"type" 	=> "textarea"
				);
*/
$of_options[] = array( 	"name" 		=> "Ship & Return Box"
						,"desc" 	=> "Show/hide Ship & Return Box"
						,"id" 		=> "wd_prod_ship_return"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds" 	=> 1
						,"type" 	=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Show Ship & Return Box Title"
						,"id" 		=> "wd_prod_ship_return_title"
						,"std" 		=> ""
						,"fold" 	=> "wd_prod_ship_return"
						,"type" 	=> "text"
				);

$of_options[] = array( 	"name" 		=> "Show Ship & Return Box Content"
						,"id" 		=> "wd_prod_ship_return_content"
						,"std" 		=> '<div class="wd-bottom-banner-left one_half">
										<a class="wd-effect-normal"><img title="banner" alt="banner" src="http://demo2.wpdance.com/imgs/wp_Sneaker/banner-bottom-product.jpg" />
										</a></div><div class="wd-bottom-banner-right one_half last">
										<a class="wd-effect-normal"><img title="banner" alt="banner" src="http://demo2.wpdance.com/imgs/wp_Sneaker/banner-bottom-product.jpg" /></a></div>'
						,"fold" 	=> "wd_prod_ship_return"
						,"type" 	=> "textarea"
				);
								
$of_options[] = array( 	"name" 		=> "Product Tabs"
						,"desc" 	=> "Show/hide Product Tabs"
						,"id" 		=> "wd_prod_tabs"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);	
	
$of_options[] = array( 	"name" 		=> "Product Custom Tab"
						,"desc" 	=> "Show/hide Product Custom Tab"
						,"id" 		=> "wd_prod_customtab"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"fold"		=> "wd_prod_tabs"
						,"type" 	=> "switch"
				);			
		
$of_options[] = array( 	"name" 		=> "Product Custom Tab Title"
						,"id" 		=> "wd_prod_customtab_title"
						,"std" 		=> __('Custom Tab','wpdance')
						,"fold" 	=> "wd_prod_customtab"
						,"type" 	=> "text"
				);

$of_options[] = array( 	"name" 		=> "Product Custom Tab Content"
						,"id" 		=> "wd_prod_customtab_content"
						,"std" 		=> "custom contents goes here"
						,"fold" 	=> "wd_prod_customtab"
						,"type" 	=> "textarea"
				);		



/***************** TODO : Blog Options ****************/	
$of_options[] = array( 	"name" 		=> "Blog Options"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> "Blog Categories"
						,"desc" 	=> "Show/hide Categories"
						,"id" 		=> "wd_blog_categories"
						,"std" 		=> 0
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
				
$of_options[] = array( 	"name" 		=> "Blog Author"
						,"desc" 	=> "Show/hide Author"
						,"id" 		=> "wd_blog_author"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		

$of_options[] = array( 	"name" 		=> "Blog Time"
						,"desc" 	=> "Show/hide Time"
						,"id" 		=> "wd_blog_time"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);	
/*	
$of_options[] = array( 	"name" 		=> "Blog Tags"
						,"desc" 	=> "Show/hide Tags"
						,"id" 		=> "wd_blog_tags"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);	
*/	
			

				
$of_options[] = array( 	"name" 		=> "Blog Comment Number"
						,"desc" 	=> "Show/hide Comment Number"
						,"id" 		=> "wd_blog_comment_number"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Excerpt"
						,"desc" 	=> "Show/hide Excerpt"
						,"id" 		=> "wd_blog_excerpt"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Thumbnail"
						,"desc" 	=> "Show/hide Thumbnail"
						,"id" 		=> "wd_blog_thumbnail"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Read More"
						,"desc" 	=> "Show/hide Read More"
						,"id" 		=> "wd_blog_readmore"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);							

/***************** TODO : Blog Details ****************/
	
$of_options[] = array( 	"name" 		=> "Blog Details"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> "Blog Categories"
						,"desc" 	=> "Show/hide Categories"
						,"id" 		=> "wd_blog_details_categories"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
				
$of_options[] = array( 	"name" 		=> "Blog Author"
						,"desc" 	=> "Show/hide Author"
						,"id" 		=> "wd_blog_details_author"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		

$of_options[] = array( 	"name" 		=> "Blog Time"
						,"desc" 	=> "Show/hide Time"
						,"id" 		=> "wd_blog_details_time"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Tags"
						,"desc" 	=> "Show/hide Tags"
						,"id" 		=> "wd_blog_details_tags"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);
$of_options[] = array( 	"name" 		=> "Blog Thumbnail"
						,"desc" 	=> "Show/hide Thumbnail"
						,"id" 		=> "wd_blog_details_thumbnail"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);							
$of_options[] = array( 	"name" 		=> "Blog Comment"
						,"desc" 	=> "Show/hide Comment"
						,"id" 		=> "wd_blog_details_comment"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Social Sharing"
						,"desc" 	=> "Show/hide Social Sharing"
						,"id" 		=> "wd_blog_details_socialsharing"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Author Box"
						,"desc" 	=> "Show/hide Author Box"
						,"id" 		=> "wd_blog_details_authorbox"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Related Posts"
						,"desc" 	=> "Show/hide Related Posts"
						,"id" 		=> "wd_blog_details_related"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);			

$of_options[] = array( 	"name" 		=> "Blog Related Label"
						,"desc" 	=> "Related Label"
						,"id" 		=> "wd_blog_details_relatedlabel"
						,"std" 		=> __("Related Posts","wpdance")
						,"fold"		=> "wd_blog_details_related"
						,"type" 	=> "text"		
					);					
$of_options[] = array( 	"name" 		=> "Blog Comment List"
						,"desc" 	=> "Show/hide Comment List"
						,"id" 		=> "wd_blog_details_commentlist"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);						
				
$of_options[] = array( 	"name" 		=> "Blog Comment List Label"
						,"desc" 	=> "Comment List Label"
						,"id" 		=> "wd_blog_details_commentlabel"
						,"std" 		=> __("Comment","wpdance")
						,"fold"		=> "wd_blog_details_commentlist"
						,"type" 	=> "text"		
					);					
/***************** TODO : Backup Options ****************/

$of_options[] = array( 	"name" 		=> "Backup Options"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-backup.png"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options"
						,"id" 		=> "of_backup"
						,"std" 		=> ""
						,"type" 	=> "backup"
						,"desc" 	=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.'
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data"
						,"id" 		=> "of_transfer"
						,"std" 		=> ""
						,"type" 	=> "transfer"
						,"desc" 	=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".'
				);
				
/***************** TODO : Documentation ****************/				
				
$of_options[] = array( 	"name" 		=> "Documentation"
						,"type" 		=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-docs.png"
				);
				
$of_options[] = array( 	"name" 		=> "Docs #1"
						,"desc" 		=> ""
						,"id" 		=> "introduction"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Welcome to the Options Framework demo.</h3>
							This is a slightly modified version of the original options framework by Devin Price with a couple of aesthetical improvements on the interface and some cool additional features. If you want to learn how to setup these options or just need general help on using it feel free to visit my blog at <a href=\"http://aquagraphite.com/2011/09/29/slightly-modded-options-framework/\">AquaGraphite.com</a>"
						,"icon" 		=> true
						,"type" 		=> "info"
				);	

$of_options[] = array( 	"name" 		=> "Docs #2"
						,"desc" 		=> ""
						,"id" 		=> "introduction"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Welcome to the Options Framework demo.</h3>
							This is a slightly modified version of the original options framework by Devin Price with a couple of aesthetical improvements on the interface and some cool additional features. If you want to learn how to setup these options or just need general help on using it feel free to visit my blog at <a href=\"http://aquagraphite.com/2011/09/29/slightly-modded-options-framework/\">AquaGraphite.com</a>"
						,"icon" 		=> true
						,"type" 		=> "info"
				);	


$of_options[] = array( 	"name" 		=> "Docs #3"
						,"desc" 		=> ""
						,"id" 		=> "introduction"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Welcome to the Options Framework demo.</h3>
							This is a slightly modified version of the original options framework by Devin Price with a couple of aesthetical improvements on the interface and some cool additional features. If you want to learn how to setup these options or just need general help on using it feel free to visit my blog at <a href=\"http://aquagraphite.com/2011/09/29/slightly-modded-options-framework/\">AquaGraphite.com</a>"
						,"icon" 		=> true
						,"type" 		=> "info"
				);	

$of_options[] = array( 	"name" 		=> "Docs #4"
						,"desc" 		=> ""
						,"id" 		=> "introduction"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Welcome to the Options Framework demo.</h3>
							This is a slightly modified version of the original options framework by Devin Price with a couple of aesthetical improvements on the interface and some cool additional features. If you want to learn how to setup these options or just need general help on using it feel free to visit my blog at <a href=\"http://aquagraphite.com/2011/09/29/slightly-modded-options-framework/\">AquaGraphite.com</a>"
						,"icon" 		=> true
						,"type" 		=> "info"
				);					
				
	}//End function: of_options()
}//End chack if function exists: of_options()

function get_google_font(){
	//$url = "https://www.googleapis.com/webfonts/v1/webfonts?sort=alpha";
	$url = "https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyAP4SsyBZEIrh0kc_cO9s90__r2oCJ8Rds&sort=alpha";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_REFERER, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	$result = curl_exec($ch);
	curl_close($ch);
	return ($result);
}
?>
