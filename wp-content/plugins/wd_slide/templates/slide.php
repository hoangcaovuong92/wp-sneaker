<?php

if(!function_exists ('slide_function')){
	function slide_function($atts){
		extract(shortcode_atts(array(
			'id'    		 => -1

		),$atts));
		if ( !post_type_exists( 'slide' ) ) {
			return;
		}
		return show_fredsel_slider($id);
	}
}
add_shortcode('slider','slide_function');
	
if(!function_exists ('show_fredsel_slider')){
	function show_fredsel_slider($post_id){
		if( (int)$post_id > 0 ){
			$slider_datas = get_post_meta($post_id,THEME_SLUG.'_portfolio_slider',true);
			$slider_datas = unserialize($slider_datas);

			
			$slider_configs = get_post_meta($post_id,THEME_SLUG.'_portfolio_slider_config',true);
			$slider_configs = wd_array_atts(array(
															"portfolio_slider_config_autoslide" => 1
															,"portfolio_slider_config_size" => 'slider'
														),unserialize($slider_configs));	

			
			$_custom_size = $slider_configs['portfolio_slider_config_size'];

							
			if( is_array($slider_datas) && count($slider_datas) > 0 ){
				$_random_id = "fredsel_" . $post_id . "_" . rand();
				
				ob_start();
				
				?>
				<div class="featured_product_slider_wrapper shortcode_slider" id="<?php echo $_random_id;?>">
					<div class="fredsel_slider_wrapper_inner loading">
						<ul>
							<?php
								foreach( $slider_datas as $_slider ){
							?>	
								<li>
									<a href="<?php echo $_slider['url'];?>" title="<?php echo $_slider['slide_title'];?>">
										<?php echo wp_get_attachment_image( $_slider['thumb_id'], $_custom_size , false, array('title' => $_slider['title'], 'alt' => $_slider['title']) ); ?>
									</a>
								</li>
							<?php
								}
							?>						
						</ul>
						<div class="slider_control">
							<a id="<?php echo $_random_id;?>_prev" class="prev" href="#">&lt;</a>
							<a id="<?php echo $_random_id;?>_next" class="next" href="#">&gt;</a>
						</div>
					</div>
				</div>
				<script type='text/javascript'>
				//<![CDATA[
					jQuery(document).ready(function() {
						// Using custom configuration
						
						jQuery('#<?php echo $_random_id?> > .fredsel_slider_wrapper_inner').imagesLoaded(function(){
						var $_this = jQuery('#<?php echo $_random_id?> > .fredsel_slider_wrapper_inner');
						
						var responsive_refresh_rate = <?php echo (wp_is_mobile())?400:200; ?>;
						var slide_speed = <?php echo (wp_is_mobile())?200:800; ?>;
						if( navigator.platform === 'iPod' ){
							slide_speed = 0;
							responsive_refresh_rate = 1000;
						}
						var owl = $_this.find('ul').owlCarousel({
								items : 8
								,itemsCustom : [[0, 2], [480, 3], [750, 5], [950, 6], [1200, 7], [1600, 8]]
								,slideSpeed : slide_speed
								,navigation : false
								,pagination: false
								,paginationNumbers: true
								,scrollPerPage: false
								,rewindNav: true
								,autoPlay: true
								,stopOnHover: true
								,navigationText: ['']
								,responsiveBaseWidth: $_this
								,responsiveRefreshRate: responsive_refresh_rate
								,afterInit: function(){
									$_this.addClass('loaded').removeClass('loading');
									if( typeof wd_update_next_prev_slider_button == 'function')
										wd_update_next_prev_slider_button($_this);
								}
								,afterUpdate: function(){
									if( typeof wd_update_next_prev_slider_button == 'function')
										wd_update_next_prev_slider_button($_this);
								}
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
					});
					//]]>
				</script>
				<?php	
				return ob_get_clean();
			}
		}		
	}
}

?>