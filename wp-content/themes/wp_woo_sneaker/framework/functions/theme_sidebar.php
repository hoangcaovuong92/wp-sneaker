<?php
	global $default_sidebars;
	
	$default_sidebars = array(

						array(
							'name' => __( 'Primary Widget Area Left', 'wpdance' ),
							'id' => 'primary-widget-area-left',
							'description' => __( 'The primary left sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Primary Widget Area Right', 'wpdance' ),
							'id' => 'primary-widget-area-right',
							'description' => __( 'The primary right sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Category Widget Area Left', 'wpdance' ),
							'id' => 'category-widget-area-left',
							'description' => __( 'The Category left sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Category Widget Area Right', 'wpdance' ),
							'id' => 'category-widget-area-right',
							'description' => __( 'The Category right sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Special Category Widget Area', 'wpdance' ),
							'id' => 'special-category-widget-area',
							'description' => __( 'The Special Category sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Product Widget Area Left', 'wpdance' ),
							'id' => 'product-widget-area-left',
							'description' => __( 'The Product left sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)	
						,array(
							'name' => __( 'Product Widget Area Right', 'wpdance' ),
							'id' => 'product-widget-area-right',
							'description' => __( 'The Product right sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Body End Widget Area', 'wpdance' ),
							'id' => 'body-end-widget-area',
							'description' => __( 'The body end widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'First Footer Widget Area 1', 'wpdance' ),
							'id' => 'first-footer-widget-area-1',
							'description' => __( 'The first footer widget area 1', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)	
						,array(
							'name' => __( 'First Footer Widget Area 2', 'wpdance' ),
							'id' => 'first-footer-widget-area-2',
							'description' => __( 'The first footer widget area 2', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)						
						,array(
							'name' => __( 'Subscriptions Footer Widget Area', 'wpdance' ),
							'id' => 'subscriptions-footer-widget-area',
							'description' => __( 'The subscriptions footer widget area 1', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Blog Widget Area Left', 'wpdance' ),
							'id' => 'blog-widget-area-left',
							'description' => __( 'The Blog left sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)
						,array(
							'name' => __( 'Blog Widget Area Right', 'wpdance' ),
							'id' => 'blog-widget-area-right',
							'description' => __( 'The Blog right sidebar widget area', 'wpdance' ),
							'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
							'after_widget' => '</li>',
							'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">',
							'after_title' => '</h3></div>',
						)						
	);

function wpdance_widgets_init() {
	global $default_sidebars;
	
	$custom_sidebar_str = get_option(THEME_SLUG.'areas');
	if($custom_sidebar_str){
		$custom_sidebar_arr = json_decode($custom_sidebar_str);		
	}else{
		$custom_sidebar_arr = array();
	}	

		
	$_init_sidebar_array = array();	
	if( count($custom_sidebar_arr) > 0 ){
		
			foreach( $custom_sidebar_arr as $_area ){
				$_area_name = stripslashes(esc_html (ucwords( str_replace("-"," ",$_area) ) ));
				$_init_sidebar_array[] = array(
							'name' => sprintf( __( '%s Widget Area','wpdance' ), $_area_name ) //__( "{$_area_name} Widget Area", 'wpdance' )
							,'id' => strtolower( str_replace(" ","-",$_area) )
							,'description' => sprintf( __( '%s sidebar widget area','wpdance' ), $_area_name ) //__( "{$_area_name} sidebar widget area", 'wpdance' )
							,'before_widget' => '<li id="%1$s" class="widget-container %2$s">'
							,'after_widget' => '</li>'
							,'before_title' => '<div class="widget_title_wrapper"><a class="block-control" href="javascript:void(0)"></a><h3 class="widget-title heading-title">'
							,'after_title' => '</h3></div>'
				);	
				
			}	
	}	
	
	$default_sidebars = array_merge($default_sidebars,$_init_sidebar_array);
	
	foreach( $default_sidebars as $sidebar ){
		register_sidebar($sidebar);
	}	
}
/** Register sidebars by running wpdance_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'wpdance_widgets_init' );
?>