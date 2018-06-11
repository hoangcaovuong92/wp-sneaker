<?php
function font_string_to_font_obj( $font_name = "" ,$font_style_str = "" ,$font_size = "" ){
    if( strlen( $font_style_str ) > 0 ){
        $font_weight = strcmp( $font_style_str,'regular' ) == 0 ? '400' : $font_style_str;
        $font_weight = strcmp( $font_style_str,'italic' ) == 0 ? '400italic' : $font_style_str;
        $font_style = strpos($font_weight, 'italic') == false ? 'normal' : 'italic';
        $font_weight = str_replace( "italic", "", $font_weight );
        return $ret = array(
            "font_name" => $font_name
        ,"font_weight" => $font_weight
        ,"font_style" => $font_style
        ,"font_size" => $font_size
        );
    }
    return $ret = array(
        "font_name" => $font_name
    ,"font_weight" => ""
    ,"font_style" => ""
    ,"font_size" => $font_size
    );
}



$wd_custom_style_config = get_option(THEME_SLUG.'custom_style_config','');
$wd_custom_style_config = unserialize($wd_custom_style_config);
if( !is_array($wd_custom_style_config) ){
    $wd_custom_style_config = array();
}
$wd_custom_style_config = wd_array_atts_str($default_custom_style_config,$wd_custom_style_config);


add_action('wp_ajax_nopriv_wd_ajax_save_style', 'ajax_save_style');
add_action('wp_ajax_wd_ajax_save_style', 'ajax_save_style');

function ajax_save_style(){
    if(	! is_user_logged_in() ){
        die('You do not have sufficient permissions to do this action.');
    }else{
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to do this action.','wpdance' ) );
        }else{
            //TODO : check nonce & do font save
            if ( empty($_POST) || !wp_verify_nonce($_POST['ajax_preview'],'ajax_save_style') ){
                wp_die( __( 'Something goes wrong!Please login again','wpdance' ) );
            }else{
                // process form data
                $_default_font_arr = array("Arial","Advent Pro","Open Sans","Verdana","Trebuchet","Georgia","Times New Roman","Tahoma","Palatino","Helvetica");
                global $smof_data;
                $style_datas = $smof_data;
                if( isset($_POST['font_body']) && strlen(trim($_POST['font_body'])) > 0 ){
                    if( in_array( trim($_POST['font_body']) , $_default_font_arr)  ){
                        $style_datas['wd_body_font_googlefont_enable'] = 1;
                        $style_datas['wd_body_font_family'] = wp_kses_data($_POST['font_body']) ;
                    }else{
                        $style_datas['wd_body_font_googlefont_enable'] = 0;
                        $style_datas['wd_body_font_googlefont'] = wp_kses_data($_POST['font_body']) ;
                    }
                }

                if( isset($_POST['font_body_second']) && strlen(trim($_POST['font_body_second'])) > 0 ){
                    if( in_array( trim($_POST['font_body_second']) , $_default_font_arr)  ){
                        $style_datas['wd_body_second_font_googlefont_enable'] = 1;
                        $style_datas['wd_body_second_font_family'] = wp_kses_data($_POST['font_body_second']) ;
                    }else{
                        $style_datas['wd_body_second_font_googlefont_enable'] = 0;
                        $style_datas['wd_body_second_font_googlefont'] = wp_kses_data($_POST['font_body_second']) ;
                    }
                }

                if( isset($_POST['font_menu']) && strlen(trim($_POST['font_menu'])) > 0 ){
                    if( in_array( trim($_POST['font_menu']) , $_default_font_arr)  ){
                        $style_datas['wd_menu_font_googlefont_enable'] = 1;
                        $style_datas['wd_menu_fontfamily'] = wp_kses_data($_POST['font_menu']) ;
                    }else{
                        $style_datas['wd_menu_font_googlefont_enable'] = 0;
                        $style_datas['wd_menu_font_googlefont'] = wp_kses_data($_POST['font_menu']) ;
                    }
                }

                if( isset($_POST['font_sub_menu']) && strlen(trim($_POST['font_sub_menu'])) > 0 ){
                    if( in_array( trim($_POST['font_sub_menu']) , $_default_font_arr)  ){
                        $style_datas['wd_sub_menu_font_googlefont_enable'] = 1;
                        $style_datas['wd_sub_menu_fontfamily'] = wp_kses_data($_POST['font_sub_menu']) ;
                    }else{
                        $style_datas['wd_sub_menu_font_googlefont_enable'] = 0;
                        $style_datas['wd_sub_menu_font_googlefont'] = wp_kses_data($_POST['font_sub_menu']) ;
                    }
                }

                if( isset($_POST['font_heading']) && strlen(trim($_POST['font_heading'])) > 0 ){
                    if( in_array( trim($_POST['font_heading']) , $_default_font_arr)  ){
                        $style_datas['wd_heading_font_googlefont_enable'] = 1;
                        $style_datas['wd_heading_fontfamily'] = wp_kses_data($_POST['font_heading']) ;
                    }else{
                        $style_datas['wd_heading_font_googlefont_enable'] = 0;
                        $style_datas['wd_heading_font_googlefont'] = wp_kses_data($_POST['font_heading']) ;
                    }
                }

                if( isset($_POST['font_price']) && strlen(trim($_POST['font_price'])) > 0 ){
                    if( in_array( trim($_POST['font_price']) , $_default_font_arr)  ){
                        $style_datas['wd_price_font_googlefont_enable'] = 1;
                        $style_datas['wd_price_fontfamily'] = wp_kses_data($_POST['font_price']) ;
                    }else{
                        $style_datas['wd_price_font_googlefont_enable'] = 0;
                        $style_datas['wd_price_font_googlefont'] = wp_kses_data($_POST['font_price']) ;
                    }
                }

                $style_datas['wd_layout_styles'] 	= strlen( $_POST['page_layout'] ) > 0 	? wp_kses_data($_POST['page_layout']) 	: $style_datas['wd_layout_styles'];

                foreach( $_POST as $_key => $_value ){
					if( array_key_exists( $_key ,$style_datas) ){
						$style_datas[$_key] = strlen( $_POST[$_key] ) > 0 	? wp_kses_data($_POST[$_key]) 	: $style_datas[$_key];
					}
                }
                of_save_options( $style_datas );
                wp_die( "1" );
            }
        }

    }

}

add_action('wp_ajax_nopriv_wd_ajax_load_custom_preview', 'wd_ajax_load_custom_preview');
add_action('wp_ajax_wd_ajax_load_custom_preview', 'wd_ajax_load_custom_preview');
function wd_ajax_load_custom_preview(){
	if( isset($_POST['custom_datas']) ){
		ob_start();
		$custom_datas = $_POST['custom_datas'];
		include get_template_directory() . '/framework/functions/custom_style.php';
		$dynamic_css = ob_get_contents();
		return $dynamic_css;
		die();
	}
	else{
		return '';
		die();
	}
}


function wd_preview_panel(){
    /***************Start font block****************/

    $api_key = get_option(THEME_SLUG.'googlefont_api_key','AIzaSyBVL7XGnZp8r-e0Xgr8pBo4kh6974i7bQA');
    $google_font_url = "https://www.googleapis.com/webfonts/v1/webfonts?key=".$api_key;

    global $smof_data;
    $style_datas = $smof_data;
    ?>

    <div id="wd-control-panel" class="default-font hidden-phone">
        <div id="control-panel-main">
            <a id="wd-control-close" href="#"></a>
            <div class="accordion" id="review_panel_accordion">
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#review_panel_accordion" href="#collapse_layout">
                            <h2 class="wd-preview-heading">Layout Style</h2>
                        </a>
                    </div>
                    <div id="collapse_layout" class="accordion-body collapse in">
                        <div class="accordion-inner">
                            <select name="page_layout" id="_page_layout" class="page_layout">
                                <option value="wide" <?php if( strcmp(esc_html($style_datas['wd_layout_styles']),'wide') == 0 ) echo 'selected="selected"';?>>Wide</option>
                                <option value="box" <?php if( strcmp(esc_html($style_datas['wd_layout_styles']),'box') == 0 ) echo 'selected="selected"';?>>Box</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#review_panel_accordion" href="#collapse_color">
                            <h2 class="wd-preview-heading">Custom Color</h2>
                        </a>
                    </div>
                    <div id="collapse_color" class="accordion-body collapse">
                        <div class="accordion-inner">
							<div class="input-append color colorpicker6 colorpicker_main_background" data-color="<?php echo esc_html($style_datas['wd_main_content_background']); ?>" data-color-format="hex">
                                <p class="custom-title">Main Background Color</p>
                                <input name="main_content_background_color" id="main_content_background_color" type="text" class="span2" value="<?php echo esc_html($style_datas['wd_main_content_background']); ?>" >
                                <span class="add-on"><i style="background-color: <?php echo esc_html($style_datas['wd_main_content_background']); ?>"></i></span>
                            </div>
						
                            <div class="input-append color colorpicker6 colorpicker_primary_color" data-color="<?php echo esc_html($style_datas['wd_theme_color_primary']); ?>" data-color-format="hex">
                                <p class="custom-title">Primary Color</p>
                                <input name="primary_color" id="primary_color" type="text" class="span2" value="<?php echo esc_html($style_datas['wd_theme_color_primary']); ?>" >
                                <span class="add-on"><i style="background-color: <?php echo esc_html($style_datas['wd_theme_color_primary']); ?>"></i></span>
                            </div>
                            <div class="input-append color colorpicker6 colorpicker_secondary_color" data-color="<?php echo esc_html($style_datas['wd_theme_color_secondary']); ?>" data-color-format="hex">
                                <p class="custom-title">Secondary Color</p>
                                <input name="secondary_color" id="secondary_color" type="text" class="span2" value="<?php echo esc_html($style_datas['wd_theme_color_secondary']); ?>" >
                                <span class="add-on"><i style="background-color: <?php echo esc_html($style_datas['wd_theme_color_secondary']); ?>"></i></span>
                            </div>
							
                            <div class="input-append color colorpicker_menu_background" data-color="<?php echo esc_html($style_datas['wd_menu_background']); ?>" data-color-format="hex">
                                <p class="custom-title">Menu Background Color</p>
                                <input name="border_color" id="border_color" type="text" class="span2" value="<?php echo esc_html($style_datas['wd_menu_background']); ?>" >
                                <span class="add-on"><i style="background-color: <?php echo esc_html($style_datas['wd_menu_background']); ?>"></i></span>
                            </div>
							<div class="input-append color colorpicker_product_name_color" data-color="<?php echo esc_html($style_datas['wd_product_name_color']); ?>" data-color-format="hex">
                                <p class="custom-title">Produce Name Text Color</p>
                                <input name="border_color_hover" id="border_color_hover" type="text" class="span2" value="<?php echo esc_html($style_datas['wd_product_name_color']); ?>" >
                                <span class="add-on"><i style="background-color: <?php echo esc_html($style_datas['wd_text_color']); ?>"></i></span>
                            </div>
                            <div class="input-append color colorpicker_primary_text_color" data-color="<?php echo esc_html($style_datas['wd_text_color']); ?>" data-color-format="hex">
                                <p class="custom-title">Primary Text Color</p>
                                <input name="primary_text_color" id="primary_text_color" type="text" class="span2" value="<?php echo esc_html($style_datas['wd_text_color']); ?>" >
                                <span class="add-on"><i style="background-color: <?php echo esc_html($style_datas['wd_text_color']); ?>"></i></span>
                            </div>

                        </div>
                    </div>
                </div>



                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#review_panel_accordion" href="#collapse_font">
                            <h2 class="wd-preview-heading">Custom Font</h2>
                        </a>
                    </div>
                    <div id="collapse_font" class="accordion-body collapse">
                        <div class="accordion-inner">
                            <h2 class="wd-preview-heading">Custom Font</h2>
                            <hr/>
                            <div class="custom-body">
                                <p class="custom-title">Body Font</p>
                                <label>
                                    <select name="body_font" id="list_body_font">
                                    </select>
                                </label>
                            </div>

                            <div class="custom-heading">
                                <p class="custom-title">Body Second Font</p>
                                <label>
                                    <select name="body_second_font" id="list_body_second_font">
                                    </select>
                                </label>
                            </div>

                        </div>
                    </div>
                </div>


                <?php global $_demo_mod ;$_demo_mod=1;?>
                <?php if( $_demo_mod ): ?>
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#review_panel_accordion" href="#collapse_textures">
                                <h2 class="wd-preview-heading">Textures</h2>
                            </a>
                        </div>
                        <div id="collapse_textures" class="accordion-body collapse">
                            <div class="accordion-inner">

                                <h2 class="wd-preview-heading">Custom Background (Support Box Layout Only)</h2>
                                <hr/>
                                <div class="wd-background-wrapper">
                                    <p class="custom-title">Background Image</p>
                                    <?php
                                    $_base_path = get_template_directory_uri() . '/images/partern/';
                                    echo "<ul class='wd-background-patten'>";
                                    for( $i = 0 ; $i <= 10 ; $i++ ){
                                        $temp_class = '';
                                        $_cur_path = $_base_path."{$i}.png";
                                        if($i==0)
                                            $temp_class = ' class="active"';
                                        echo "<li".$temp_class."><img id='patten_{$i}' class='wd-background-patten-image' src='{$_cur_path}' title='patten {$i}' alt='patten {$i}'></li>";
                                    }
                                    echo "</ul>";
                                    ?>

                                    <h2 class="wd-preview-heading">Backgrounds Color (Support Box Layout Only)</h2>
                                    <div class="input-append color colorpicker1 colorpicker_background_color" data-color="#f5f5f5" data-color-format="hex">
                                        <input name="background_color" id="background_color" type="text" class="span2" value="#f5f5f5" >
                                        <span class="add-on"><i style="background-color: #f5f5f5"></i></span>
                                    </div>

                                </div>
                                <div class="wd-preview-note"><strong>Note</strong>: Background Image and Background Color won't saved here</div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <p class="button-save"><button class="btn btn-primary" data-loading-text="Saving..." id="font-save-btn" type="button">Save</button></p>
            <p class="button-clear"><button class="btn btn-primary" data-loading-text="Clearing..." id="font-clear-btn" type="button">Clear</button></p>

            <div id="preview-save-result" class="alert" style="display:none;">

            </div>

            <?php //TODO ?>
            <?php wp_nonce_field('ajax_save_style','preview_nonce_field'); ?>
        </div>
    </div>
    <script type="text/javascript">
    //<![CDATA[
	var _wd_site_url = '<?php echo get_option('siteurl',''); ?>';
    function loadSelectedFont( font_name ){
		var _default_font_arr = new Array("Arial","Advent Pro","Open Sans","Verdana","Trebuchet","Georgia","Times New Roman","Tahoma","Palatino","Helvetica");
        if( typeof font_name != 'undefined' && font_name.length > 0 && jQuery.inArray(font_name,_default_font_arr) == -1 ){
            jQuery('head').append("<link id='" + font_name + "' href='http://fonts.googleapis.com/css?family="+font_name.replace(/ /g,'+')+"' rel='stylesheet' type='text/css' />");
        }
    }
	function update_font_preview_to_data(custom_datas){
		var _default_font_arr = new Array("Arial","Advent Pro","Open Sans","Verdana","Trebuchet","Georgia","Times New Roman","Tahoma","Palatino","Helvetica");
		// Body font
		if( jQuery.inArray(custom_datas['font_body'],_default_font_arr) ){
			custom_datas.wd_body_font_googlefont_enable = 1;
			custom_datas.wd_body_font_family = custom_datas['font_body'];
		}
		else{
			custom_datas.wd_body_font_googlefont_enable = 0;
			custom_datas.wd_body_font_googlefont = custom_datas['font_body'];
		}
		// Body second font
		if( jQuery.inArray(custom_datas['font_body_second'],_default_font_arr) ){
			custom_datas.wd_body_second_font_googlefont_enable = 1;
			custom_datas.wd_body_second_font_family = custom_datas['font_body_second'];
		}
		else{
			custom_datas.wd_body_second_font_googlefont_enable = 0;
			custom_datas.wd_body_second_font_googlefont = custom_datas['font_body_second'];
		}
		// Menu font
		if( jQuery.inArray(custom_datas['font_menu'],_default_font_arr) ){
			custom_datas.wd_menu_font_googlefont_enable = 1;
			custom_datas.wd_menu_fontfamily = custom_datas['font_menu'];
		}
		else{
			custom_datas.wd_menu_font_googlefont_enable = 0;
			custom_datas.wd_menu_font_googlefont = custom_datas['font_menu'];
		}
		// Sub Menu font
		if( jQuery.inArray(custom_datas['font_sub_menu'],_default_font_arr) ){
			custom_datas.wd_sub_menu_font_googlefont_enable = 1;
			custom_datas.wd_sub_menu_fontfamily = custom_datas['font_sub_menu'];
		}
		else{
			custom_datas.wd_sub_menu_font_googlefont_enable = 0;
			custom_datas.wd_sub_menu_font_googlefont = custom_datas['font_sub_menu'];
		}
		// Heading font
		if( jQuery.inArray(custom_datas['font_heading'],_default_font_arr) ){
			custom_datas.wd_heading_font_googlefont_enable = 1;
			custom_datas.wd_heading_fontfamily = custom_datas['font_heading'];
		}
		else{
			custom_datas.wd_heading_font_googlefont_enable = 0;
			custom_datas.wd_heading_font_googlefont = custom_datas['font_heading'];
		}
		// Price font
		if( jQuery.inArray(custom_datas['font_price'],_default_font_arr) ){
			custom_datas.wd_price_font_googlefont_enable = 1;
			custom_datas.wd_price_fontfamily = custom_datas['font_price'];
		}
		else{
			custom_datas.wd_price_font_googlefont_enable = 0;
			custom_datas.wd_price_font_googlefont = custom_datas['font_price'];
		}
		
		return custom_datas;
	}

    function set_cookie(custom_datas){
        var json_object = JSON.stringify(custom_datas);
        var custom = [];
        if(custom_datas.length < 2883){
            jQuery.cookie("custom_datas",  JSON.stringify(custom_datas), {path: _wd_site_url});
        } else {
            var number_cookie = parseInt(json_object.length / 2800) + 1;
            for(i = 0 ; i < number_cookie; i++){
                custom[i]= {};
            }
            var j = 0;
            var flag = 2800;
            jQuery.each(custom_datas, function(key, value) {
                custom[j][key] = value;
                if(JSON.stringify(custom[j]).length > flag){
                    delete custom[j].key;
                    flag = flag * 2;
                    j++;
                    custom[j][key] = value;
                }
                //console.log('key: ' + key + '\n' + 'value: ' + value);
            });
            for(i = 0; i<custom.length;i++){
                if(i==0){
                    temp = '';
                } else {
                    temp = '_'+i;
                }
                //console.log(custom[i]);
                jQuery.cookie("custom_datas"+temp,  JSON.stringify(custom[i]), {path: _wd_site_url});
            }
        }
    }
    function get_number_cookie(custom_datas){
        var json_object = JSON.stringify(custom_datas);
        var number_cookie = parseInt(json_object.length / 2800) + 1;
        return number_cookie;
    }
    function get_from_cookie(number_cookie){
        var result = '';
        for(i = 0; i< number_cookie;i++){
            if(i==0){
                tempple = '';
            } else {
                tempple = '_' + i;
            }
            var temp = jQuery.cookie("custom_datas"+tempple);
            temp = temp.replace("{", "");
            temp = temp.replace("}", "");
            result = result + ',' + temp;
        }
        result = result.substring(1);
        result = '{' + result + '}';
        return result;
    }
    function remove_data_cookie(custom_datas){
        var number_cookie = get_number_cookie(custom_datas);
        for(i = 0; i< number_cookie;i++){
            if(i==0){
                tempple = '';
            } else {
                tempple = '_' + i;
            }
            jQuery.removeCookie("custom_datas"+tempple, {path: _wd_site_url});
        }
    }
    function set_color( selector_id,color_value ){
        jQuery(selector_id).find('input.span2').val(color_value);
        setTimeout(function(){
            jQuery(selector_id).find('i').eq(0).css('background-color',color_value);
        },1000);
    }

    jQuery(document).ready(function() {
        jQuery.cookie.defaults = { path: '/', expires: 365 };
        <?php
            global $smof_data;
            $style_datas = $smof_data;
            foreach( $style_datas as $_key => $_value ){
                if(is_string($_value)){
                    //$style_datas[$_key] = strlen($_value) <= 0 ? "null" : $_value;
                }
            }
        ?>
        custom_datas = {
            /*******   Font   *******/
            "font_body" 		: "<?php echo $font_name = $style_datas['wd_body_font_googlefont_enable'] == 1 ? esc_attr( $style_datas['wd_body_font_family'] ) : esc_attr( $style_datas['wd_body_font_googlefont'] ) ?>"
            ,"font_body_second" : "<?php echo $font_name = $style_datas['wd_body_second_font_googlefont_enable'] == 1 ? esc_attr( $style_datas['wd_body_second_font_family'] ) : esc_attr( $style_datas['wd_body_second_font_googlefont'] ) ?>"
            ,"font_menu" 		: "<?php echo $font_name = $style_datas['wd_menu_font_googlefont_enable'] == 1 ? esc_attr( $style_datas['wd_menu_fontfamily'] ) : esc_attr( $style_datas['wd_menu_font_googlefont'] ) ?>"
            ,"font_sub_menu" 	: "<?php echo $font_name = $style_datas['wd_sub_menu_font_googlefont_enable'] == 1 ? esc_attr( $style_datas['wd_sub_menu_fontfamily'] ) : esc_attr( $style_datas['wd_sub_menu_font_googlefont'] ) ?>"
            ,"font_heading" 	: "<?php echo $font_name = $style_datas['wd_heading_font_googlefont_enable'] == 1 ? esc_attr( $style_datas['wd_heading_fontfamily'] ) : esc_attr( $style_datas['wd_heading_font_googlefont'] ) ?>"
            ,"font_price" 		: "<?php echo $font_name = $style_datas['wd_price_font_googlefont_enable'] == 1 ? esc_attr( $style_datas['wd_price_fontfamily']) : esc_attr( $style_datas['wd_price_font_googlefont'] ) ?>"

            /*******   Primary   *******/
			,"wd_main_content_background" 	: "<?php echo esc_html($style_datas['wd_main_content_background']); ?>"
            ,"wd_theme_color_primary" 		: "<?php echo esc_html($style_datas['wd_theme_color_primary']); ?>"
            ,"wd_theme_color_secondary" 	: "<?php echo esc_html($style_datas['wd_theme_color_secondary']); ?>"
            ,"wd_text_color" 				: "<?php echo esc_html($style_datas['wd_text_color']); ?>"
            ,"wd_link_color" 				: "<?php echo esc_html($style_datas['wd_link_color']); ?>"
            ,"wd_link_color_hover" 			: "<?php echo esc_html($style_datas['wd_link_color_hover']); ?>"
			
			,"wd_button_background" 		: "<?php echo esc_html($style_datas['wd_button_background']); ?>"
            ,"wd_button_background_hover" 	: "<?php echo esc_html($style_datas['wd_button_background_hover']); ?>"
            ,"wd_button_text" 				: "<?php echo esc_html($style_datas['wd_button_text']); ?>"
			,"wd_button_text_hover" 		: "<?php echo esc_html($style_datas['wd_button_text_hover']); ?>"
            ,"wd_heading_color" 			: "<?php echo esc_html($style_datas['wd_heading_color']); ?>"
			,"wd_header_top_background" 	: "<?php echo esc_html($style_datas['wd_header_top_background']); ?>"
            ,"wd_header_top_text_color" 	: "<?php echo esc_html($style_datas['wd_header_top_text_color']); ?>"
            ,"wd_header_top_text_hover" 	: "<?php echo esc_html($style_datas['wd_header_top_text_hover']); ?>"
			,"wd_menu_background" 			: "<?php echo esc_html($style_datas['wd_menu_background']); ?>"
            ,"wd_menu_text_color" 			: "<?php echo esc_html($style_datas['wd_menu_text_color']); ?>"
			
			,"wd_menu_text_color_hover" 	: "<?php echo esc_html($style_datas['wd_menu_text_color_hover']); ?>"
            ,"wd_sub_menu_background" 		: "<?php echo esc_html($style_datas['wd_sub_menu_background']); ?>"
            ,"wd_sub_menu_border" 			: "<?php echo esc_html($style_datas['wd_sub_menu_border']); ?>"
			,"wd_sub_menu_text_color" 		: "<?php echo esc_html($style_datas['wd_sub_menu_text_color']); ?>"
            ,"wd_sub_menu_text_color_hover" : "<?php echo esc_html($style_datas['wd_sub_menu_text_color_hover']); ?>"
			,"wd_phone_background" 			: "<?php echo esc_html($style_datas['wd_phone_background']); ?>"
            ,"wd_phone_text_color" 			: "<?php echo esc_html($style_datas['wd_phone_text_color']); ?>"
            ,"wd_phone_sub_text_color" 		: "<?php echo esc_html($style_datas['wd_phone_sub_text_color']); ?>"
			,"wd_testimonial_background" 	: "<?php echo esc_html($style_datas['wd_testimonial_background']); ?>"
            ,"wd_product_name_color" 		: "<?php echo esc_html($style_datas['wd_product_name_color']); ?>"
			
			,"wd_special_color" 					: "<?php echo esc_html($style_datas['wd_special_color']); ?>"
            ,"wd_border_color" 						: "<?php echo esc_html($style_datas['wd_border_color']); ?>"
            ,"wd_border_color_hover" 				: "<?php echo esc_html($style_datas['wd_border_color_hover']); ?>"
			,"wd_link_title_portfolio" 				: "<?php echo esc_html($style_datas['wd_link_title_portfolio']); ?>"
            ,"wd_link_title_portfolio_hover" 		: "<?php echo esc_html($style_datas['wd_link_title_portfolio_hover']); ?>"
			,"wd_background_button_portfolio" 		: "<?php echo esc_html($style_datas['wd_background_button_portfolio']); ?>"
            ,"wd_background_button_portfolio_hover" : "<?php echo esc_html($style_datas['wd_background_button_portfolio_hover']); ?>"
            ,"wd_border_portfolio_hover" 			: "<?php echo esc_html($style_datas['wd_border_portfolio_hover']); ?>"
			,"wd_button_cart_background" 			: "<?php echo esc_html($style_datas['wd_button_cart_background']); ?>"
            ,"wd_button_cart_background_hover" 		: "<?php echo esc_html($style_datas['wd_button_cart_background_hover']); ?>"
			
			,"wd_button_cart_text" 					: "<?php echo esc_html($style_datas['wd_button_cart_text']); ?>"
            ,"wd_button_cart_text_hover" 			: "<?php echo esc_html($style_datas['wd_button_cart_text_hover']); ?>"
			,"wd_text_price_color" 					: "<?php echo esc_html($style_datas['wd_text_price_color']); ?>"
            ,"wd_rating_color" 						: "<?php echo esc_html($style_datas['wd_rating_color']); ?>"
			,"wd_text_price_sale_color" 			: "<?php echo esc_html($style_datas['wd_text_price_sale_color']); ?>"
            ,"wd_footer_background" 				: "<?php echo esc_html($style_datas['wd_footer_background']); ?>"
			,"wd_footer_subscriptions_background" 	: "<?php echo esc_html($style_datas['wd_footer_subscriptions_background']); ?>"
            ,"wd_footer_end_background" 			: "<?php echo esc_html($style_datas['wd_footer_end_background']); ?>"
            ,"wd_footer_end_menu_text" 				: "<?php echo esc_html($style_datas['wd_footer_end_menu_text']); ?>"
			,"wd_footer_end_menu_text_hover" 		: "<?php echo esc_html($style_datas['wd_footer_end_menu_text_hover']); ?>"
			
			,"wd_footer_end_text" 			: "<?php echo esc_html($style_datas['wd_footer_end_text']); ?>"
            ,"wd_feature_sale" 				: "<?php echo esc_html($style_datas['wd_feature_sale']); ?>"
            ,"wd_feature_sale_text_color" 	: "<?php echo esc_html($style_datas['wd_feature_sale_text_color']); ?>"
			,"wd_feature_new" 				: "<?php echo esc_html($style_datas['wd_feature_new']); ?>"
            ,"wd_feature_new_text_color" 	: "<?php echo esc_html($style_datas['wd_feature_new_text_color']); ?>"
			,"wd_feature_hot" 				: "<?php echo esc_html($style_datas['wd_feature_hot']); ?>"
            ,"wd_feature_hot_text_color" 	: "<?php echo esc_html($style_datas['wd_feature_hot_text_color']); ?>"
            ,"wd_button_slider_background" 	: "<?php echo esc_html($style_datas['wd_button_slider_background']); ?>"
			,"wd_button_slider_icon" 		: "<?php echo esc_html($style_datas['wd_button_slider_icon']); ?>"
            ,"wd_social_border" 			: "<?php echo esc_html($style_datas['wd_social_border']); ?>"
			,"wd_social_text" 				: "<?php echo esc_html($style_datas['wd_social_text']); ?>"
				
			,"wd_quickshop_background" 			: "<?php echo esc_html($style_datas['wd_quickshop_background']); ?>"
            ,"wd_quickshop_text_color" 			: "<?php echo esc_html($style_datas['wd_quickshop_text_color']); ?>"
			,"wd_quickshop_background_hover" 	: "<?php echo esc_html($style_datas['wd_quickshop_background_hover']); ?>"
            ,"wd_quickshop_text_color_hover" 	: "<?php echo esc_html($style_datas['wd_quickshop_text_color_hover']); ?>"
			
			,"wd_sidebar_title_background" 		: "<?php echo esc_html($style_datas['wd_sidebar_title_background']); ?>"
			,"wd_sidebar_title_color" 			: "<?php echo esc_html($style_datas['wd_sidebar_title_color']); ?>"
        };
        orgin_custom_datas = new Array();
        for(key in custom_datas){
            orgin_custom_datas[key] = custom_datas[key];
        }
		
		/* Update custom preview */
		jQuery('body').bind('update_custom_preview',jQuery.debounce( 100, function(){
			jQuery('#wd-control-panel #review_panel_accordion #collapse_color').addClass('loading');
			jQuery('#wd-control-panel #review_panel_accordion #collapse_font').addClass('loading');
			custom_datas = update_font_preview_to_data(custom_datas);
			//Load custom style
			jQuery.ajax({
                type  :'POST'
                ,url   : '<?php echo admin_url('admin-ajax.php'); ?>'
                ,data  : {'action':'wd_ajax_load_custom_preview','custom_datas':custom_datas}
                ,success : function(html){
					jQuery('head #wd_custom_preview').remove();
					html = '<style type="text/css" id="wd_custom_preview">'+html+'</style>';
					jQuery('head').append(html);
					jQuery('#wd-control-panel #review_panel_accordion #collapse_color').removeClass('loading');
					jQuery('#wd-control-panel #review_panel_accordion #collapse_font').removeClass('loading');
                }
            }).fail(function(){
				current_btn.button('reset');
				jQuery('#wd-control-panel #review_panel_accordion #collapse_color').removeClass('loading');
				jQuery('#wd-control-panel #review_panel_accordion #collapse_font').removeClass('loading');
			});
			set_cookie(custom_datas);
			var _container_offet = jQuery('.header-middle-content').offset();

			setTimeout(function(){
				jQuery('.menu-item-level0.wd-mega-menu.fullwidth-menu,.menu-item-level0.wd-mega-menu.columns-6').each(function(index,value){
					var _cur_offset = jQuery(value).offset();
					var _margin_left = _cur_offset.left - _container_offet.left ;
					_margin_left = _margin_left - (jQuery('.header-middle-content').outerWidth() - jQuery('.header-middle-content').width() ) /2;
					jQuery(value).children('ul.sub-menu').css('width',jQuery('.header-middle-content').width()).css('left','-'+_margin_left+'px');
					
				});	
			},2000);
			
        }));


        if ( jQuery.cookie("page_layout") !== undefined){
            jQuery('#_page_layout').val(jQuery.cookie("page_layout"));
            jQuery('body').removeClass('wide box').addClass(jQuery.cookie("page_layout"));
        }
        if ( jQuery.cookie("bg_image") !== undefined ){
            jQuery('ul.wd-background-patten > li.active').removeClass('active');
            var _img_id = '#'+jQuery.cookie("bg_image");
            if( jQuery(_img_id).length > 0 ){
                jQuery('body').css( "background-image",'url("' + jQuery(_img_id).attr('src') + '")' );
                jQuery('body').css( "background-repeat","repeat" );
                jQuery(_img_id).parent().addClass('active');
            }
        }
        if ( jQuery.cookie("bg_color") !== undefined ){
            set_color( '.colorpicker_background_color',jQuery.cookie("bg_color") );
            jQuery('body').css('background-color',jQuery.cookie("bg_color"));
        }
        if ( jQuery.cookie("custom_datas") !== undefined ){
            var number_cookie = get_number_cookie(custom_datas);
            custom_datas = get_from_cookie(number_cookie);
            if( typeof custom_datas == 'string' ){
                custom_datas = jQuery.parseJSON(custom_datas);
				
				set_color('.colorpicker_main_background',custom_datas['wd_main_content_background']);
                set_color('.colorpicker_primary_color',custom_datas['wd_theme_color_primary']);
                set_color('.colorpicker_secondary_color',custom_datas['wd_theme_color_secondary']);
                set_color('.colorpicker_menu_background',custom_datas['wd_menu_background']);
                set_color('.colorpicker_product_name_color',custom_datas['wd_product_name_color']);
                set_color('.colorpicker_primary_text_color',custom_datas['wd_text_color']);


                loadSelectedFont(custom_datas['font_body']);
                loadSelectedFont(custom_datas['font_body_second']);

                jQuery('body').bind('font_load_success',function(){
                    setTimeout(function(){
                        jQuery('#list_body_font').val(custom_datas['font_body']);
                        jQuery('#list_body_second_font').val(custom_datas['font_body_second']);
                    },1000);
                });

                jQuery('body').trigger('update_custom_preview');
            }
        }





        jQuery('ul.wd-background-patten > li > img.wd-background-patten-image').click(function(event){
            jQuery('ul.wd-background-patten > li.active').removeClass('active');
            $_src_img = jQuery(this).attr('src');
            jQuery('body').css( "background-image",'url("' + $_src_img + '")' );
            jQuery('body').css( "background-repeat","repeat" );
            jQuery.cookie("bg_image", jQuery(this).attr('id'), {path: _wd_site_url});
            jQuery(this).parent().addClass('active');
            if(jQuery(this).attr('id') == 'patten_0'){
                jQuery('.wd-background-wrapper .color').children('.add-on.default-style').hide();
                jQuery('.wd-background-wrapper .color').children('#background_color').prop('disabled', true);
            } else {
                jQuery('.wd-background-wrapper .color').children('.add-on.default-style').show();
                jQuery('.wd-background-wrapper .color').children('#background_color').prop('disabled', false);
            }
            event.preventDefault();
        });
        jQuery('#_page_layout').change(function(event){
            //less goes here
            jQuery('body').removeClass('wide').removeClass('box').addClass(jQuery(this).val());
            jQuery.cookie("page_layout", jQuery(this).val(), {path: _wd_site_url});

            if( jQuery('.slideshow-wrapper').length > 0 ){
                if( jQuery(this).val() == 'wide' ){
                    jQuery('.slideshow-wrapper').removeClass('container').addClass('wide');
                    jQuery('.slideshow-sub-wrapper').removeClass('span24').addClass('wide-wrapper');
                }
                if( jQuery(this).val() == 'box' ){
                    jQuery('.slideshow-wrapper').removeClass('wide').addClass('container');
                    jQuery('.slideshow-sub-wrapper').removeClass('wide-wrapper').addClass('span24');
                    jQuery('body').css('background-color',jQuery('input#background_color').val());
                    jQuery.cookie("bg_color", jQuery('input#background_color').val(), {path: _wd_site_url});
                    //jQuery('body').css('background-color',jQuery.cookie("bg_color"));
                    //#f5f0f0

                }
                jQuery('body').trigger('resize');
            }
            else{
                if( jQuery(this).val() == 'box' ){
                    jQuery('body').css('background-color',jQuery('input#background_color').val());
                    jQuery.cookie("bg_color", jQuery('input#background_color').val(), {path: _wd_site_url});
                }
            }

        });


        jQuery('#wd-control-panel').find('p,span,a,button,div,input,textarea,button').addClass('default-style');


        /******************START FONT LOADER*******************/
        font_config = new Array();
        var body_option_html,selected_body_font,selected_body_weight,body_font_weight_obj,heading_font_weight_obj,menu_font_weight_obj;
        var body_font      			= 	"<?php echo $font_name = $style_datas['wd_body_font_googlefont_enable'] == 1 ? esc_attr( $style_datas['wd_body_font_family'] ) : esc_attr( $style_datas['wd_body_font_googlefont'] ) ?>";
        var body_second_font		=	"<?php echo $font_name = $style_datas['wd_body_second_font_googlefont_enable'] == 1 ? esc_attr( $style_datas['wd_body_second_font_family'] ) : esc_attr( $style_datas['wd_body_second_font_googlefont'] ) ?>";
        var heading_font			=	"<?php echo $font_name = $style_datas['wd_heading_font_googlefont_enable'] == 1 ? esc_attr( $style_datas['wd_heading_fontfamily'] ) : esc_attr( $style_datas['wd_heading_font_googlefont'] ) ?>";
        var menu_font				=	"<?php echo $font_name = $style_datas['wd_menu_font_googlefont_enable'] == 1 ? esc_attr( $style_datas['wd_menu_fontfamily'] ) : esc_attr( $style_datas['wd_menu_font_googlefont'] ) ?>";
        var sub_menu_font			=	"<?php echo $font_name = $style_datas['wd_sub_menu_font_googlefont_enable'] == 1 ? esc_attr( $style_datas['wd_sub_menu_fontfamily'] ) : esc_attr( $style_datas['wd_sub_menu_font_googlefont'] ) ?>";
        var price_font				=	"<?php echo $font_name = $style_datas['wd_price_font_googlefont_enable'] == 1 ? esc_attr( $style_datas['wd_price_fontfamily'] ) : esc_attr( $style_datas['wd_price_font_googlefont'] ) ?>";

        body_font = jQuery.trim( body_font );
        body_second_font = jQuery.trim( body_second_font );
        heading_font = jQuery.trim( heading_font );
        menu_font = jQuery.trim( menu_font );
        sub_menu_font = jQuery.trim( sub_menu_font );
        price_font = jQuery.trim( price_font );

        var _default_font_arr = new Array("Arial","Advent Pro","Open Sans","Verdana","Trebuchet","Georgia","Times","Tahoma","Palatino","Helvetica");
        var _default_font = 	'<option value="Arial">Arial</option>'
            + 	'<option value="Advent Pro">Advent Pro</option>'
            + 	'<option value="Open Sans">Open Sans</option>'
            + 	'<option value="Verdana">Verdana, Geneva</option>'
            +	'<option value="Trebuchet">Trebuchet</option>'
            +	'<option value="Georgia">Georgia</option>'
            +	'<option value="Times New Roman">Times New Roman</option>'
            +	'<option value="Tahoma">Tahoma, Geneva</option>'
            +	'<option value="Palatino">Palatino</option>'
            +	'<option value="Helvetica">Helvetica</option>';


        jQuery.ajax("<?php echo esc_url($google_font_url); ?>", {
            data : { sort: "alpha" }
            ,dataType: 'jsonp'
            ,success : function(data){

                if( typeof(data) == 'string' ){
                    data = JSON.parse(data);
                }
                option_html = "";
                //apend list font to select box,prepare data for font array object
                jQuery.each(data.items, function(i, obj) {
                    font_config[obj.family] = new Array(
                        new Array(obj.variants)
                        ,new Array(obj.subsets)
                    );
                    option_html = option_html + '<option value="'+obj.family+'" >' + obj.family + '</option>';
                });
                jQuery('#list_body_font').html(_default_font+option_html).val(body_font);
                jQuery('#list_body_second_font').html(_default_font+option_html).val(body_second_font);

                jQuery('body').trigger('font_load_success');
                //end first font weigh
            }


        });


        //select another font,reload font weight
        jQuery('#list_body_font').change(function(event){
            loadSelectedFont(jQuery(this).val());
            custom_datas['font_body'] = jQuery(this).val();
            custom_datas['font_sub_menu'] = jQuery(this).val();
            jQuery('body').trigger('update_custom_preview');
            //less goes here
        });

        jQuery('#list_body_second_font').change(function(event){
            loadSelectedFont(jQuery(this).val());
            custom_datas['font_body_second'] = jQuery(this).val();
            custom_datas['font_menu'] = jQuery(this).val();
            custom_datas['font_heading'] = jQuery(this).val();
            custom_datas['font_price'] = jQuery(this).val();
            jQuery('body').trigger('update_custom_preview');
            //less goes here
        });


        /******************END FONT LOADER*******************/

        /******************START COLOR PICKER*******************/
		 $theme_color_primary_picker = jQuery('.colorpicker_main_background').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			custom_datas['wd_main_content_background'] = ev.color.toHex();
			

            jQuery('body').trigger('update_custom_preview');
        });
		
        $theme_color_primary_picker = jQuery('.colorpicker_primary_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
            custom_datas['wd_theme_color_primary'] = ev.color.toHex();
            custom_datas['wd_link_color'] = ev.color.toHex();
            custom_datas['wd_button_background_hover'] = ev.color.toHex();
            custom_datas['wd_header_top_background'] = ev.color.toHex();
            custom_datas['wd_menu_text_color'] = ev.color.toHex();
			custom_datas['wd_phone_background'] = ev.color.toHex();
            custom_datas['wd_link_title_portfolio_hover'] = ev.color.toHex();
			custom_datas['wd_background_button_portfolio'] = ev.color.toHex();
			custom_datas['wd_border_portfolio_hover'] = ev.color.toHex();		
            custom_datas['wd_text_price_color'] = ev.color.toHex();
			custom_datas['wd_footer_end_background'] = ev.color.toHex();
			custom_datas['wd_sidebar_title_background'] = ev.color.toHex();
			custom_datas['wd_quickshop_background'] = ev.color.toHex(); 
			

            jQuery('body').trigger('update_custom_preview');
        });
        // color picker 2 - Theme color
        $theme_color_secondary_picker = jQuery('.colorpicker_secondary_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
            custom_datas['wd_theme_color_secondary'] = ev.color.toHex();
            custom_datas['wd_link_color_hover'] = ev.color.toHex();
			custom_datas['wd_button_background'] = ev.color.toHex();
			custom_datas['wd_menu_text_color_hover'] = ev.color.toHex();          
            custom_datas['wd_sub_menu_text_color_hover'] = ev.color.toHex();
			custom_datas['wd_background_button_portfolio_hover'] = ev.color.toHex();
            custom_datas['wd_button_cart_background_hover'] = ev.color.toHex();           
            custom_datas['wd_rating_color'] = ev.color.toHex();
            custom_datas['wd_text_price_sale_color'] = ev.color.toHex();
			custom_datas['wd_quickshop_background_hover'] = ev.color.toHex();
			
            jQuery('body').trigger('update_custom_preview');
        });
        // color picker 3 - Border color
        $theme_color_third_picker = jQuery('.colorpicker_menu_background').colorpicker({'format':'hex'}).on('changeColor', function(ev){
            custom_datas['wd_menu_background'] = ev.color.toHex();

            jQuery('body').trigger('update_custom_preview');
        });
		
		// color picker 3 - Border color hover
        $theme_color_third_picker = jQuery('.colorpicker_product_name_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
            custom_datas['wd_product_name_color'] = ev.color.toHex();

            jQuery('body').trigger('update_custom_preview');
        });

        // color picker4 - colorpicker_primary_text_color
        $text_picker = jQuery('.colorpicker_primary_text_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
			custom_datas['wd_text_color'] = ev.color.toHex();
			custom_datas['wd_sub_menu_text_color'] = ev.color.toHex();
			custom_datas['wd_link_title_portfolio'] = ev.color.toHex();
			custom_datas['wd_footer_end_menu_text_hover'] = ev.color.toHex();
			custom_datas['wd_social_border'] = ev.color.toHex();
			custom_datas['wd_social_text'] = ev.color.toHex();
		
            jQuery('body').trigger('update_custom_preview');
        });

        $background_bg_picker = jQuery('.colorpicker_background_color').colorpicker({'format':'hex'}).on('changeColor', function(ev){
            jQuery('body').css('background-color',ev.color.toHex());
            jQuery.cookie("bg_color", ev.color.toHex(), {path: _wd_site_url});
        });
        /******************END COLOR PICKER*******************/

        /******************START PANEL CONTROLLER*******************/

        // open and close custom panel
        var $et_control_panel = jQuery('#wd-control-panel'),
            $et_control_close = jQuery('#wd-control-close');

        $et_control_panel.animate( { left: -$et_control_panel.outerWidth() } );

        $et_control_close.click(function(){
            if ( jQuery(this).hasClass('control-open') ) {
                $et_control_panel.animate( { left: -jQuery("#wd-control-panel").outerWidth() } );
                jQuery(this).removeClass('control-open');
                jQuery.cookie('et_aggregate_control_panel_open', 0);
            } else {
                $et_control_panel.animate( { left: 0 } );
                jQuery(this).addClass('control-open');
                jQuery.cookie('et_aggregate_control_panel_open', 1);
            }
            return false;
        });
        if ( jQuery.cookie('et_aggregate_control_panel_open') == 1 ) {
            $et_control_panel.animate( { left: 0 } );
            $et_control_close.addClass('control-open');
        }else{
            $et_control_panel.animate( { left: -jQuery("#wd-control-panel").outerWidth() } );
            $et_control_close.removeClass('control-open');
        }
        /******************END PANEL CONTROLLER*******************/

        /******************START AJAX SAVE CONFIG*******************/
        jQuery('#font-clear-btn').click(function(event){
            remove_data_cookie(custom_datas);
            jQuery.removeCookie("page_layout", {path: _wd_site_url});
            jQuery.removeCookie("bg_image", {path: _wd_site_url});
            jQuery.removeCookie("bg_color", {path: _wd_site_url});
            jQuery('body').css( "background-image",'' );
            jQuery('body').css( "background-color","#f5f5f5" );

            jQuery('#_page_layout').val('<?php echo esc_html($style_datas['wd_layout_styles']);?>').trigger('change');
            jQuery('ul.wd-background-patten > li.active').removeClass('active');

            for(key in orgin_custom_datas){
                custom_datas[key] = orgin_custom_datas[key];
            }
            set_color('.colorpicker_background_color',"#f5f5f5");
			set_color('.colorpicker_main_background',custom_datas['wd_main_content_background']);
            set_color('.colorpicker_primary_color',custom_datas['wd_theme_color_primary']);
            set_color('.colorpicker_secondary_color',custom_datas['wd_theme_color_secondary']);
            set_color('.colorpicker_menu_background',custom_datas['wd_menu_background']);
            set_color('.colorpicker_product_name_color',custom_datas['wd_product_name_color']);
            set_color('.colorpicker_primary_text_color',custom_datas['wd_text_color']);
            setTimeout(function(){
                jQuery('#list_body_font').val(custom_datas['font_body']);
                jQuery('#list_body_second_font').val(custom_datas['font_body_second']);
            },1000);

           jQuery('body').trigger('update_custom_preview');
        });


        jQuery('#font-save-btn').click(function(event){

            var current_btn = jQuery(this);
            current_btn.button('loading');

            var ajax_data =  {
                //action
                action  				: 'wd_ajax_save_style'
                //verify nonce
                ,ajax_preview			: jQuery('#preview_nonce_field').val()
                ,page_layout 			: jQuery('#_page_layout').val()
            };
            ajax_data = jQuery.extend(ajax_data, custom_datas);

            jQuery.ajax({
                type  :'POST'
                ,url   : '<?php echo admin_url('admin-ajax.php'); ?>'
                ,data  : ajax_data
                ,success : function(data){
                    console.log(data);
                    if( parseInt(data) == 1 ){
                        jQuery('#preview-save-result').html('Success').attr('class','alert alert-success').show();//.wait(3000).hide();
                        setTimeout(
                            function(){
                                jQuery('#preview-save-result').hide();
                            },3000);
                    }else{
                        jQuery('#preview-save-result').html('Error!Sufficient permissions').attr('class','alert alert-error').show()//.wait(3000).hide();
                        setTimeout(
                            function(){
                                jQuery('#preview-save-result').hide();
                            },3000);
                    }
                    current_btn.button('reset');
                }
            }).fail(function(){
                    current_btn.button('reset');
                });
        });



        /******************END AJAX SAVE CONFIG*******************/

    });
    //]]>
    </script>
<?php

}
?>