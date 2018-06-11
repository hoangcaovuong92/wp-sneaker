<?php 
/**
*   Get class page layout
*
**/
if(!function_exists('wd_page_layout_class')){
	function wd_page_layout_class($layout_name, $echo = true){
		global $page_datas;
		$layout_class = "";
		switch($page_datas['page_layout']){
			case 'box':
				$layout_class = "wd_box";
				break;
			case 'wide':
					if(isset($page_datas[$layout_name])){
						$layout_class = 'wd_'.$page_datas[$layout_name];
					}
				break;
			default:
				$layout_class = "wd_wide";
		}
		if($echo){
			echo $layout_class;
		}
		else{
			return $layout_class;
		}
	}
}
/**
*	Combine a input array with defaut array
*
**/
if(!function_exists ('wd_valid_color')){
	function wd_valid_color( $color = '' ) {
		if( strlen(trim($color)) > 0 ) {
			$named = array('aliceblue', 'antiquewhite', 'aqua', 'aquamarine', 'azure', 'beige', 'bisque', 'black', 'blanchedalmond', 'blue', 'blueviolet', 'brown', 'burlywood', 'cadetblue', 'chartreuse', 'chocolate', 'coral', 'cornflowerblue', 'cornsilk', 'crimson', 'cyan', 'darkblue', 'darkcyan', 'darkgoldenrod', 'darkgray', 'darkgreen', 'darkkhaki', 'darkmagenta', 'darkolivegreen', 'darkorange', 'darkorchid', 'darkred', 'darksalmon', 'darkseagreen', 'darkslateblue', 'darkslategray', 'darkturquoise', 'darkviolet', 'deeppink', 'deepskyblue', 'dimgray', 'dodgerblue', 'firebrick', 'floralwhite', 'forestgreen', 'fuchsia', 'gainsboro', 'ghostwhite', 'gold', 'goldenrod', 'gray', 'green', 'greenyellow', 'honeydew', 'hotpink', 'indianred', 'indigo', 'ivory', 'khaki', 'lavender', 'lavenderblush', 'lawngreen', 'lemonchiffon', 'lightblue', 'lightcoral', 'lightcyan', 'lightgoldenrodyellow', 'lightgreen', 'lightgrey', 'lightpink', 'lightsalmon', 'lightseagreen', 'lightskyblue', 'lightslategray', 'lightsteelblue', 'lightyellow', 'lime', 'limegreen', 'linen', 'magenta', 'maroon', 'mediumaquamarine', 'mediumblue', 'mediumorchid', 'mediumpurple', 'mediumseagreen', 'mediumslateblue', 'mediumspringgreen', 'mediumturquoise', 'mediumvioletred', 'midnightblue', 'mintcream', 'mistyrose', 'moccasin', 'navajowhite', 'navy', 'oldlace', 'olive', 'olivedrab', 'orange', 'orangered', 'orchid', 'palegoldenrod', 'palegreen', 'paleturquoise', 'palevioletred', 'papayawhip', 'peachpuff', 'peru', 'pink', 'plum', 'powderblue', 'purple', 'red', 'rosybrown', 'royalblue', 'saddlebrown', 'salmon', 'sandybrown', 'seagreen', 'seashell', 'sienna', 'silver', 'skyblue', 'slateblue', 'slategray', 'snow', 'springgreen', 'steelblue', 'tan', 'teal', 'thistle', 'tomato', 'turquoise', 'violet', 'wheat', 'white', 'whitesmoke', 'yellow', 'yellowgreen');
			if (in_array(strtolower($color), $named)) {
				return true;
			}else{
				return preg_match('/^#[a-f0-9]{6}$/i', $color);			
			}
		}
		return false;
	}
}

/**
*	Combine a input array with defaut array
*
**/
if(!function_exists ('wd_array_atts')){
	function wd_array_atts($pairs, $atts) {
		$atts = (array)$atts;
		$out = array();
	   foreach($pairs as $name => $default) {
			if ( array_key_exists($name, $atts) ){
				if( strlen(trim($atts[$name])) > 0 ){
					$out[$name] = $atts[$name];
				}else{
					$out[$name] = $default;
				}
			}
			else{
				$out[$name] = $default;
			}	
		}
		return $out;
	}
}

if(!function_exists ('wd_array_atts_str')){
	function wd_array_atts_str($pairs, $atts) {
		$atts = (array)$atts;
		$out = array();
	   foreach($pairs as $name => $default) {
			if ( array_key_exists($name, $atts) ){
				if( strlen(trim($atts[$name])) > 0 ){
					$out[$name] = $atts[$name];
				}else{
					$out[$name] = $default;
				}
			}
			else{
				$out[$name] = $default;
			}	
		}
		return $out;
	}
}	

if(!function_exists ('wd_get_all_post_list')){
	function wd_get_all_post_list( $_post_type = "post" ){
		wp_reset_query();
		$args = array(
			'post_type'=> $_post_type
			,'posts_per_page'  => -1
		);
		$_post_lists = get_posts( $args );
		
		if( $_post_lists ){
			foreach ( $_post_lists as $post ) {
				setup_postdata($post);
				$ret_array[] = array(
					$post->ID
					,get_the_title($post->ID)
				);
			}
		}else{
			$ret_array = array();
		}
		wp_reset_query();	
		return $ret_array ;
		
	}
}	

if(!function_exists ('show_page_slider')){
	function show_page_slider(){
		global $page_datas;
		$revolution_exists = ( class_exists('RevSlider') && class_exists('UniteFunctionsRev') );
		$layerslider_exists = (class_exists('LayerSlider') && class_exists('LS_Sliders'));
		switch ($page_datas['page_slider']) {
			case 'revolution':
				if( $revolution_exists )
					RevSliderOutput::putSlider($page_datas['page_revolution'],"");
				break;
			case 'layerslider':
				if($layerslider_exists)
					layerslider($page_datas['page_layerslider']);
				break;	
			case 'product' :
				show_prod_slider($page_datas['product_tag'],$page_datas['product_slider_title'],$page_datas['product_slider_columns']);
				break;							
			case 'none' :
				break;							
			default:
			   break;
		}	
	}
}


if( !function_exists('wd_woocommerce_product_loop_start_slide') ){
	function wd_woocommerce_product_loop_start_slide($echo = true){
		ob_start();
		wc_get_template( 'loop/loop-start-slide.php' );
		if ( $echo )
			echo ob_get_clean();
		else
			return ob_get_clean();
	}
}

if( !function_exists('wd_woocommerce_product_loop_end_slide') ){
	function wd_woocommerce_product_loop_end_slide($echo = true){
		ob_start();
		wc_get_template( 'loop/loop-end-slide.php' );
		if ( $echo )
			echo ob_get_clean();
		else
			return ob_get_clean();
	}
}

if( !function_exists('wd_hex2rgb') ){
	function wd_hex2rgb($Hex){
		if (substr($Hex,0,1) == "#")
			$Hex = substr($Hex,1);
		$R = substr($Hex,0,2);
		$G = substr($Hex,2,2);
		$B = substr($Hex,4,2);

		$R = hexdec($R);
		$G = hexdec($G);
		$B = hexdec($B);

		$RGB['R'] = $R;
		$RGB['G'] = $G;
		$RGB['B'] = $B;

		return $RGB;
	}
}
if( !function_exists('wd_rgb2hex') ){
	function wd_rgb2hex($rgb) {
	   $hex = "#";
	   $hex .= str_pad(dechex($rgb['R']), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb['G']), 2, "0", STR_PAD_LEFT);
	   $hex .= str_pad(dechex($rgb['B']), 2, "0", STR_PAD_LEFT);

	   return $hex; // returns the hex value including the number sign (#)
	}
}
if( !function_exists('wd_calc_color') ){
	function wd_calc_color($firstColor, $secondColor, $add = true){
		if( strrpos($firstColor,'#') !== false && strrpos($secondColor,'#') !== false ){ // Is Hex
			$rgb_first_color = wd_hex2rgb($firstColor);
			$rgb_second_color = wd_hex2rgb($secondColor);
			if( $add ){
				$rgb_first_color['R'] += $rgb_second_color['R'];
				$rgb_first_color['G'] += $rgb_second_color['G'];
				$rgb_first_color['B'] += $rgb_second_color['B'];
			}
			else{
				$rgb_first_color['R'] -= $rgb_second_color['R'];
				$rgb_first_color['G'] -= $rgb_second_color['G'];
				$rgb_first_color['B'] -= $rgb_second_color['B'];
			}
			return wd_rgb2hex($rgb_first_color);
		}
		else{
			return $firstColor;
		}
		
	}
}

/** Save Of Options - Save Dynamic css **/
add_action('of_save_options_after','wd_update_dynamic_css',10000);
if( !function_exists('wd_update_dynamic_css') ){
	function wd_update_dynamic_css( $data = array() ){
		//wrong input type
		if( !is_array($data) ){
			return -1;
		}
		if(is_array($data['data'])){
			$data = $data['data'];	
		}
		else{
			return -1;
		}
	
		$upload_dir = wp_upload_dir();
		$filename = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ','',THEME_NAME)) .'.css';
		ob_start();
		include get_template_directory() . '/framework/functions/custom_style.php';
		$dynamic_css = ob_get_contents();
		ob_get_clean();
		
		global $wp_filesystem;
		if( empty( $wp_filesystem ) ) {
			require_once( ABSPATH .'/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		if( $wp_filesystem ) {
			$wp_filesystem->put_contents(
				$filename,
				$dynamic_css,
				FS_CHMOD_FILE // predefined mode settings for WP files
			);
		}
	}
}

if( !function_exists('wd_add_dynamic_css_header') ){
	function wd_add_dynamic_css_header($is_iframe = false){
		global $wp_filesystem;
		ob_start();
		include_once get_template_directory() . '/framework/functions/custom_style.php';
		$dynamic_css = ob_get_contents();
		ob_get_clean();
		if( empty( $wp_filesystem ) ) {
			require_once( ABSPATH .'/wp-admin/includes/file.php' );
			WP_Filesystem();
		}
		if( $wp_filesystem ) {
			$upload_dir = wp_upload_dir();
			$filename = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ','',THEME_NAME)) .'.css';
			$file_status = $wp_filesystem->get_contents( $filename );
			if( !trim( $file_status ) ) { 
				echo '<style type="text/css">';
				echo $dynamic_css;
				echo '</style>';
			}
			else{
				if( $is_iframe ){
					$filename = trailingslashit($upload_dir['baseurl']) . strtolower(str_replace(' ','',THEME_NAME)) . '.css';
					echo '<link rel="stylesheet" type="text/css" media="all" href="'. $filename .'" />';
				}
			}
		}
		else{
			echo '<style type="text/css">';
			echo $dynamic_css;
			echo '</style>';
		}
	}
}

?>