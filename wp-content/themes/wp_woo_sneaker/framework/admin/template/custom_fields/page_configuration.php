<?php 
	global $post;
	$revolution_exists = ( class_exists('RevSlider') && class_exists('UniteFunctionsRev') );
	$layerslider_exists = (class_exists('LayerSlider') && class_exists('LS_Sliders'));
	$datas = unserialize(get_post_meta($post->ID,THEME_SLUG.'page_configuration',true));
	$datas = wd_array_atts(array(
										"page_layout" 			=> '0'
										,"main_content_layout"	=> 'box'
										,"header_layout"		=> 'box'
										,"footer_layout"		=> 'box'
										,"main_slider_layout"	=> 'box'
										,"banner_layout"		=> 'box'
										,"page_column"			=> '0-1-0'
										,"left_sidebar" 		=> 'primary-widget-area-left'
										,"right_sidebar" 		=> 'primary-widget-area-right'
										,"page_slider" 			=> 'none'
										,"page_revolution" 		=> ''
										,"page_layerslider"		=> ''
										,"product_tag" 			=> ''
										,"portfolio_columns" 	=> 1
										,"portfolio_filter"		=> 1
										,"hide_new_product" 	=> 1										
										,"hide_breadcrumb" 		=> 0		
										,"hide_title" 			=> 0											
										,"hide_banner" 			=> 0											
										,"product_slider_columns"=> 4
										,"product_slider_title" => ''
								),$datas);								
?>
<div class="page_config_wrapper">
	<div class="page_config_wrapper_inner">
		<input type="hidden" value="1" name="_page_config">
		<?php wp_nonce_field( "_update_page_config", "nonce_page_config" ); ?>
		<ul class="page_config_list">
			<li class="first">
				<p>
					<label><?php _e('Layout Style','wpdance');?> : </label>
					<select name="page_layout" id="page_layout">
						<option value="0" <?php if( strcmp($datas['page_layout'],'0') == 0 ) echo "selected";?>>Default</option>
						<option value="wide" <?php if( strcmp($datas['page_layout'],'wide') == 0 ) echo "selected";?>>Wide</option>
						<option value="box" <?php if( strcmp($datas['page_layout'],'box') == 0 ) echo "selected";?>>Box</option>
					</select>
				</p> 
			</li>
			<?php 
				$main_content_show = 'style="display:none;"';
				$header_show = 'style="display:none;"';
				$footer_show = 'style="display:none;"';
				$main_slider_show = 'style="display:none;"';
				$banner_show = 'style="display:none;"';
				if( strcmp($datas['page_layout'],'wide') == 0 ) {
					$main_content_show = "";
					$header_show = "";	
					$footer_show = "";
					$main_slider_show = "";
					$banner_show ="";
				}
			?>
			<li class="sub_layout header_layout" <?php echo $header_show; ?>>
				<p>
					<label><?php _e('Header layout Style','wpdance');?> : </label>
					<select name="header_layout" id="header_layout">
						<option value="wide" <?php if( strcmp($datas['header_layout'],'wide') == 0 ) echo "selected";?>>Wide</option>
						<option value="box" <?php if( strcmp($datas['header_layout'],'box') == 0 ) echo "selected";?>>Box</option>
					</select>
				</p> 
			</li>
			<li class="sub_layout main_slider_layout" <?php echo $main_slider_show; ?>>
				<p>
					<label><?php _e('Main slide layout Style','wpdance');?> : </label>
					<select name="main_slider_layout" id="slider_layout">
						<option value="wide" <?php if( strcmp($datas['main_slider_layout'],'wide') == 0 ) echo "selected";?>>Wide</option>
						<option value="box" <?php if( strcmp($datas['main_slider_layout'],'box') == 0 ) echo "selected";?>>Box</option>
					</select>
				</p> 
			</li>
			<li class="sub_layout banner_layout" <?php echo $banner_show; ?>>
				<p>
					<label><?php _e('Banner layout Style','wpdance');?> : </label>
					<select name="banner_layout" id="slider_layout">
						<option value="wide" <?php if( strcmp($datas['banner_layout'],'wide') == 0 ) echo "selected";?>>Wide</option>
						<option value="box" <?php if( strcmp($datas['banner_layout'],'box') == 0 ) echo "selected";?>>Box</option>
					</select>
				</p> 
			</li>
			<li class="sub_layout main_content_layout" <?php echo $main_content_show; ?>>
				<p>
					<label><?php _e('Main content layout Style','wpdance');?> : </label>
					<select name="main_content_layout" id="main_content_layout">
						<option value="wide" <?php if( strcmp($datas['main_content_layout'],'wide') == 0 ) echo "selected";?>>Wide</option>
						<option value="box" <?php if( strcmp($datas['main_content_layout'],'box') == 0 ) echo "selected";?>>Box</option>
					</select>
				</p> 
			</li>
			
			<li class="sub_layout footer_layout" <?php echo $footer_show; ?>>
				<p>
					<label><?php _e('Footer layout Style','wpdance');?> : </label>
					<select name="footer_layout" id="footer_layout">
						<option value="wide" <?php if( strcmp($datas['footer_layout'],'wide') == 0 ) echo "selected";?>>Wide</option>
						<option value="box" <?php if( strcmp($datas['footer_layout'],'box') == 0 ) echo "selected";?>>Box</option>
					</select>
				</p> 
			</li>	
			<li>
				<p>
					<label><?php _e('Page Layout','wpdance');?> : </label>
					<select name="page_column" id="page_column">
						<option value="0-1-0" <?php if( strcmp($datas['page_column'],'0-1-0') == 0 ) echo "selected";?>>Fullwidth</option>
						<option value="1-1-0" <?php if( strcmp($datas['page_column'],'1-1-0') == 0 ) echo "selected";?>>Left Sidebar</option>
						<option value="0-1-1" <?php if( strcmp($datas['page_column'],'0-1-1') == 0 ) echo "selected";?>>Right Sidebar</option>
						<option value="1-1-1" <?php if( strcmp($datas['page_column'],'1-1-1') == 0 ) echo "selected";?>>Left & Right Sidebar</option>
					</select>
				</p> 
			</li>
			

			<li>
				<p>
					<label><?php _e('Left Sidebar','wpdance');?> : </label>
					<select name="left_sidebar" id="_left_sidebar">
						<?php
							global $default_sidebars;
							foreach( $default_sidebars as $key => $_sidebar ){
								$_selected_str = ( strcmp($datas["left_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
								echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
							}
						?>
					</select>
				</p> 
			</li>
			<li>
				<p>
					<label><?php _e('Right Sidebar','wpdance');?> : </label>
					<select name="right_sidebar" id="_right_sidebar">
						<?php
							global $default_sidebars;
							foreach( $default_sidebars as $key => $_sidebar ){
								$_selected_str = ( strcmp($datas["right_sidebar"],$_sidebar['id']) == 0 ) ? "selected='selected'"  : "";
								echo "<option value='{$_sidebar['id']}' {$_selected_str}>{$_sidebar['name']}</option>";
							}
						?>
					</select>
				</p> 
			</li>			
			
			<li>
				<p>
					<label><?php _e('Page Slider','wpdance');?> : </label>
					<select name="page_slider" id="page_slider">
						<option value="none" <?php if( strcmp($datas['page_slider'],'none') == 0 ) echo "selected";?>>No Slider</option>
						<option value="layerslider" <?php if( strcmp($datas['page_slider'],'layerslider') == 0 ) echo "selected";?>>Layer Slider</option>
						<option value="revolution" <?php if( strcmp($datas['page_slider'],'revolution') == 0 ) echo "selected";?>>Revolution Slider</option>
						<option value="product" <?php if( strcmp($datas['page_slider'],'product') == 0 ) echo "selected";?>>Product Slider</option>
					</select>
				</p> 			
			</li>
			<li>
				<p>
					<label><?php _e('Product Slider','wpdance');?> : </label>
					<?php
						$tags = get_terms( array('product_tag') );
						$html = '<select class="product_tag" name="product_tag">';
						$selectedStr = '';
						foreach ($tags as $index => $tag){
							$tagSlug = $tag->slug ;
							if( !isset($datas['product_tag']) )
								$datas['product_tag'] = 'all-product-tags';
							$selectedStr = strcmp(esc_html($datas['product_tag']),$tagSlug) == 0 ? "selected" : '';	
							if( $index == 0 ){
								$html .= "<option value='all-product-tags' {$selectedStr}>All Tags</option>";
							}
							
							$html .= "<option value='{$tagSlug}' {$selectedStr}>";
							$html .= "{$tag->name}</option>";
						}
						$html .= '</select>';
						echo $html; 
					?>		
					
				</p> 			
			</li>
			<li>
				<p>
					<label><?php _e('Product Slider Columns','wpdance');?> : </label>
					<select name="product_slider_columns" id="product_slider_columns">
						<option value="6" <?php if( strcmp($datas['product_slider_columns'],6) == 0 ) echo "selected";?>>6</option>
						<option value="5" <?php if( strcmp($datas['product_slider_columns'],5) == 0 ) echo "selected";?>>5</option>
						<option value="4" <?php if( strcmp($datas['product_slider_columns'],4) == 0 ) echo "selected";?>>4</option>
						<option value="3" <?php if( strcmp($datas['product_slider_columns'],3) == 0 ) echo "selected";?>>3</option>
					</select>
				</p> 			
			</li>
			<li>
				<p>
					<label><?php _e('Product Slider Title','wpdance');?> : </label>
					<input name="product_slider_title" id="product_slider_title_id" value="<?php echo $datas['product_slider_title']; ?>" />
				</p> 			
			</li>
			
			<?php if( $revolution_exists ):?>
			<li>
				<p>
					<label><?php _e('Revolution Slider','wpdance');?> : </label>
					
					<?php
						$slider = new RevSlider();
						$arrSliders = $slider->getArrSlidersShort();
						$sliderID = $datas['page_revolution'];
					?>
					
					<?php echo $select = UniteFunctionsRev::getHTMLSelect($arrSliders,$sliderID,'name="page_revolution" id="page_revolution_id"',true); ?>					
					
				</p> 			
			</li>
			<?php endif;?>
			
			<?php if( $layerslider_exists ): ?>
			<li>
				<p>
					<label><?php _e('Layer Slider','wpdance'); ?></label>
					<?php $list_layer_slider = LS_Sliders::find(); ?>
					<select id="page_layerslider" name="page_layerslider">
						<?php foreach($list_layer_slider as $key => $slider){ ?>
							<option value="<?php echo $slider['id']; ?>" <?php echo (strcmp($datas['page_layerslider'],$slider['id']) == 0)?'selected':''; ?> ><?php echo $slider['name']; ?></option>
						<?php } ?>
					</select>
				</p>
			</li>
			<?php endif; ?>
			
			<?php $c_template = get_post_meta( $post->ID, '_wp_page_template', true ); 
				$tp_selected = 'style="display:none;"';
				if($c_template == 'page-templates/portfolio-template.php'){
					$tp_selected = '';
				} else {
					$datas['portfolio_columns'] = 1;
				}
			?>
			<li class="last portfolio_columns" <?php echo $tp_selected; ?>>
				<p>
					<label><?php _e('Columns(For Portfolio Template)','wpdance');?> : </label>
					<select name="portfolio_columns" id="portfolio_columns">
						<option value="2" <?php if( absint($datas['portfolio_columns']) == 2 ) echo "selected";?>>2 Columns</option>
						<option value="3" <?php if( absint($datas['portfolio_columns']) == 3 ) echo "selected";?>>3 Columns</option>
						<option value="4" <?php if( absint($datas['portfolio_columns']) == 4 ) echo "selected";?>>4 Columns</option>
					</select>
				</p> 	
				<p>	
					<label><?php _e('Filterable(For Portfolio Template)','wpdance');?> : </label>
					<select name="portfolio_filter" id="portfolio_filter">
						<option value="1" <?php if( absint($datas['portfolio_filter']) == 1 ) echo "selected";?>>Yes</option>
						<option value="0" <?php if( absint($datas['portfolio_filter']) == 0 ) echo "selected";?>>No</option>
					</select>
				</p>			
			</li>
			<li class="last">
				<p>
					<label><?php _e('Hide New Product','wpdance');?> : </label>
					<select name="hide_new_product" id="_hide_new_product">
						<option value="1" <?php if( absint($datas['hide_new_product']) == 1 ) echo "selected";?>>Yes</option>
						<option value="0" <?php if( absint($datas['hide_new_product']) == 0 ) echo "selected";?>>No</option>
					</select>
				</p> 			
			</li>
			<li class="last">
				<p>
					<label><?php _e('Hide Breadcrumb','wpdance');?> : </label>
					<select name="hide_breadcrumb" id="_hide_breadcrumb">
						<option value="0" <?php if( absint($datas['hide_breadcrumb']) == 0 ) echo "selected";?>>No</option>
						<option value="1" <?php if( absint($datas['hide_breadcrumb']) == 1 ) echo "selected";?>>Yes</option>
					</select>
				</p> 			
			</li>
			<li class="last">
				<p>
					<label><?php _e('Hide Page Title','wpdance');?> : </label>
					<select name="hide_title" id="_hide_title">
						<option value="0" <?php if( absint($datas['hide_title']) == 0 ) echo "selected";?>>No</option>
						<option value="1" <?php if( absint($datas['hide_title']) == 1 ) echo "selected";?>>Yes</option>
					</select>
				</p> 			
			</li>
			<li class="last">
				<p>
					<label><?php _e('Hide Banner','wpdance');?> : </label>
					<select name="hide_banner" id="_hide_banner">
						<option value="0" <?php if( absint($datas['hide_banner']) == 0 ) echo "selected";?>>No</option>
						<option value="1" <?php if( absint($datas['hide_banner']) == 1 ) echo "selected";?>>Yes</option>
					</select>
				</p> 			
			</li>
		</ul>
	</div>
</div>
