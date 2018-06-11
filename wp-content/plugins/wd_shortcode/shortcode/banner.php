<?php

	if(!function_exists('banner_shortcode_function')){
		function banner_shortcode_function($atts,$content){
			extract(shortcode_atts(array(
				'link_url'						=> "#" 
				,'bg_image' 					=> ""
				,'bg_color'						=> "none"
				,'title_big'					=> "Big title goes here"
				,'title_small'					=> "Big title goes here"
				,'sub_title'					=> "Subtitle goes here" 
				,'opacity_sub'					=> "0.7"
				,'title_color'					=> "#fff" 
				,'position_title'				=> "right"
				,'top_padding'					=> "102px" 
				,'bottom_padding'				=> "105px" 
				,'border_color_inset'			=> ""
				,'background_img_inset'			=> ""
				,'label'						=> "yes"
				,'label_bg'						=> "#fff" 
				,'label_text_big' 				=> "Big label"
				,'label_text_small' 			=> "Small label"
				
			),$atts));
			ob_start();
			?>
			
			<div class="shortcode_wd_banner" onclick="location.href='<?php echo $link_url;?>'" style="background-color:<?php echo $bg_color;?>;">
				<div class="shortcode_wd_banner_inner <?php echo $position_title; ?> <?php echo 'label_'.$label ?>" style="padding-top:<?php echo $top_padding;?> ;padding-bottom: <?php echo $bottom_padding;?>">
				
					<h4 class="heading-title banner-title small" style="color:<?php echo $title_color;?>"><?php echo do_shortcode($title_small);?></h3>
						
					<h3 class="heading-title banner-title big" style="color:<?php echo $title_color;?>"><?php echo do_shortcode($title_big);?></h3>
					
					<h4 class="heading-title banner-sub-title" style="color:<?php echo $title_color;?>;opacity:<?php echo $opacity_sub; ?>;filter:alpha(opacity=<?php echo 100*$opacity_sub; ?>)"><?php echo do_shortcode($sub_title);?></h4>
					
					<?php if( absint($label) == 1 || strcmp($label,'yes') == 0 || strcmp($label,'Yes') == 0 ):?>
						<div class="shortcode_banner_simple_bullet" style="background-color:<?php echo $label_bg;?>" ><span class="lb_big"><?php echo $label_text_big;?></span><span class="lb_small"><?php echo $label_text_small;?></span></div>
					<?php endif;?>
				</div>			

				<div class="item">
					<img alt="<?php echo do_shortcode($sub_title);?>" title="<?php echo do_shortcode($sub_title);?>" class="img" src="<?php echo $bg_image;?>" />
					<?php if(strcmp($border_color_inset,'') == 0 || strcmp($border_color_inset,'') == 0 ):?>
						<div style="background:url('<?php echo $background_img_inset ?>')center repeat" class="border-shadow"></div>
					<?php else:?>
						<div style="border:2px solid <?php echo $border_color_inset ;?>;background:url('<?php echo $background_img_inset ?>')center repeat" class="border-shadow"></div>
					<?php endif;?>
				</div>
				
			</div>
					
			<?php
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
	add_shortcode('banner','banner_shortcode_function');
?>