<?php

if(!function_exists ('show_prod_slider')){
	function show_prod_slider( $product_tag = 'all-product-tags', $title='', $slider_columns=6 ){
		$_short_code = '[featured_product_slider columns="'.$slider_columns.'" layout="big" per_page="12" title="'.$title.'" desc="" show_nav="1" show_icon_nav="1" show_image="1" show_title="1" show_sku="1" show_price="1" show_label="1" show_rating="1" product_tag="'.$product_tag.'"]';
		echo do_shortcode($_short_code);
	}
}	

?>