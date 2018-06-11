<?php 
if(!function_exists ('button')){
	function button($atts,$content){
		extract(shortcode_atts(array(
			'size'			=>	'default',
			'color'			=>	'#ffffff',
			'custom_class'	=>	'',
			'link'			=>	'',
			'background'	=>	'#c30005',
		),$atts));	
		
		$types_arr = array(
			'largest' => 'btn-largest'
			,'large' => 'btn-large'
			,'medium' => 'btn-medium'
			,'small' => 'btn-small'
			,'mini' => 'btn-mini'
		);
		
		$size = (!empty($size)) ? "btn-{$size}" : '';
		$type = (!empty($type)) ? "btn-{$type}" : '';
		$color = (!empty($color)) ? "{$color}" : '#ffffff';
		$background = (!empty($background)) ? "{$background}" : '#c30005';
		$opacity = (!empty($opacity)) ? "btn-{$opacity}" : '';
		//$link = ( strlen($link) > 0 ) ? $link : 'javascript:void(0)';
		$custom_class = (!empty($custom_class)) ? " {$custom_class}" : '';
		if( strlen($link) > 0 ){
			return "<a style='color:{$color};background-color:{$background}' href='$link' class='btn {$custom_class} {$size}'>".do_shortcode($content)."</a>";
		}
		return "<button style='color:{$color};background-color:{$background}' class='btn {$custom_class} {$size}'>".do_shortcode($content)."</button>";	
	}
}
add_shortcode('button','button');


if(!function_exists ('button_group')){
	function button_group($atts,$content){
		extract(shortcode_atts(array(
			'vertical' => 0
		),$atts));
		$_vertical = '';
		if( $vertical == 1 )
			$_vertical = " btn-group-vertical";
			
		return "<div class='btn-toolbar'><div class='btn-group{$_vertical}'>".do_shortcode($content)."</div></div>";
	}
}
add_shortcode('button_group','button_group');
?>