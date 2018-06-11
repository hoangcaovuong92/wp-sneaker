(function() {
	var _editor = null;
    tinymce.PluginManager.add('Wd_shortcodes', function( editor, url ) {
		_editor = editor;
		var menu = new Array();
		
		var shop_shortcode = new Array();
		wd_mce_addMenu(shop_shortcode,'[WD]Custom product','[custom_product style="1" id="" sku="" show_add_to_cart="1"  show_sku="0" show_rating="1" show_label="1"]');
		wd_mce_addMenu(shop_shortcode,'[WD]Custom products','[custom_products style="1" ids="" skus="" show_add_to_cart="1"  show_sku="0" show_rating="1" show_label="1" show_categories="0"]');
		wd_mce_addMenu(shop_shortcode,'[WD]Custom products category','[custom_products_category columns="2" per_page="4" title="" orderby="" order="" product_cat="" show_upsell="1" show_image="1" show_title="1" show_sku="0" show_price="1" show_label="1" show_rating="1" show_categories="0" show_add_to_cart="1"]' );
		wd_mce_addMenu(shop_shortcode,'[WD]Feature product','[featured_product columns="4" style="1" per_page="8" title="your title" desc="" product_cats="" show_image="1" show_title="1" show_sku="0" show_price="1" show_label="1" show_rating="1" show_categories="0" show_add_to_cart="1" show_load_more="0"]' );
		wd_mce_addMenu(shop_shortcode,'[WD]Feature product slider','[featured_product_slider columns="4" style="1" per_page="8" title="your title" desc="" product_cats="" show_nav="1" show_image="1" show_title="1" show_sku="0" show_price="1" show_label="1" show_rating="1" show_categories="0" show_add_to_cart="1"]' );
		wd_mce_addMenu(shop_shortcode,'[WD]Sale product','[sale_product columns="4" style="1" per_page="8" title="your title" desc="" product_cats="" show_image="1" show_title="1" show_sku="0" show_price="1" show_label="1" show_rating="1" show_categories="0" show_add_to_cart="1" show_load_more="0"]' );
		wd_mce_addMenu(shop_shortcode,'[WD]Sale product slider','[sale_product_slider columns="4" style="1" per_page="8" title="your title" desc="" product_cats="" show_nav="1" show_image="1" show_title="1" show_sku="0" show_price="1" show_label="1" show_rating="1" show_categories="0" show_add_to_cart="1"]' );
		wd_mce_addMenu(shop_shortcode,'[WD]Popular product','[popular_product columns="4" style="1" per_page="8" title="Enter your title" desc="" product_tag="" product_cats="" show_image="1" show_title="1" show_sku="0" show_price="1" show_label="1" show_rating="1" show_categories="0" show_add_to_cart="1" show_load_more="0"]' );
		wd_mce_addMenu(shop_shortcode,'[WD]Popular product slider','[popular_product_slider columns="4" style="1" per_page="8" title="Enter your title" desc="" product_tag="" product_cats="" show_nav="1" show_image="1" show_title="1" show_sku="0" show_price="1" show_label="1" show_rating="1" show_categories="0" show_add_to_cart="1"]' );
		wd_mce_addMenu(shop_shortcode,'[WD]Best selling product','[best_selling_product columns="4" style="1" per_page="8" title="Enter your title" desc="" product_cats="" show_image="1" show_title="1" show_sku="0" show_price="1" show_label="1" show_rating="1" show_categories="0" show_add_to_cart="1" show_load_more="0"]' );
		wd_mce_addMenu(shop_shortcode,'[WD]Best selling product slider','[best_selling_product_slider columns="4" style="1" per_page="8" title="Enter your title" desc="" product_cats="" show_nav="1" show_image="1" show_title="1" show_sku="0" show_price="1" show_label="1" show_rating="1" show_categories="0" show_add_to_cart="1"]' );
		wd_mce_addMenu(shop_shortcode,'[WD]Recent product','[recent_product columns="4" style="1" per_page="8" title="" desc="" product_tag="" product_cats="" show_image="1" show_title="1" show_sku="0" show_price="1" show_label="1" show_rating="1" show_categories="0" show_add_to_cart="1" show_load_more="0"]' );
		wd_mce_addMenu(shop_shortcode,'[WD]Recent product slider','[recent_product_slider columns="4" style="1" per_page="8" title="" desc="" product_tag="" product_cats="" show_nav="1" show_image="1" show_title="1" show_sku="0" show_price="1" show_label="1" show_rating="1" show_categories="0" show_add_to_cart="1"]' );
		wd_mce_addMenu(shop_shortcode,'[WD]Product Categories Slider','[product_categories_slider number="" parent="" ids="" hide_empty="0" columns="4" show_nav="1" show_item_title="1" title="" desc=""]' );
		wd_mce_addSubMenu(menu,'Shop Shortcode',shop_shortcode);
		
		var column = new Array();
		wd_mce_addMenu(column, '1/2',"[one_half]your_content[/one_half]" );
		wd_mce_addMenu(column, '1/3',"[one_third]your_content[/one_third]" );
		wd_mce_addMenu(column, '1/4',"[one_fourth]your_content[/one_fourth]" );
		wd_mce_addMenu(column, '1/5',"[one_fifth]your_content[/one_fifth]" );
		wd_mce_addMenu(column, '1/6',"[one_sixth]your_content[/one_sixth]" );
		wd_mce_addMenu(column, '2/3',"[two_third]your_content[/two_third]" );
		wd_mce_addMenu(column, '3/4',"[three_fourth]your_content[/three_fourth]" );
		wd_mce_addMenu(column, '2/5',"[two_fifth]your_content[/two_fifth]" );
		wd_mce_addMenu(column, '3/5',"[three_fifth]your_content[/three_fifth]" );
		wd_mce_addMenu(column, '4/5',"[four_fifth]your_content[/four_fifth]" );
		wd_mce_addMenu(column, '5/6',"[five_sixth]your_content[/five_sixth]" );
		wd_mce_addMenu(column, '1/2 last',"[one_half_last]your_content[/one_half_last]" );
		wd_mce_addMenu(column, '1/3 last',"[one_third_last]your_content[/one_third_last]" );
		wd_mce_addMenu(column, '1/4 last',"[one_fourth_last]your_content[/one_fourth_last]" );
		wd_mce_addMenu(column, '1/5 last',"[one_fifth_last]your_content[/one_fifth_last]" );
		wd_mce_addMenu(column, '1/6 last',"[one_sixth_last]your_content[/one_sixth_last]" );
		wd_mce_addMenu(column, '2/3 last',"[two_third_last]your_content[/two_third_last]" );
		wd_mce_addMenu(column, '3/4 last',"[three_fourth_last]your_content[/three_fourth_last]" );
		wd_mce_addMenu(column, '2/5 last',"[two_fifth_last]your_content[/two_fifth_last]" );
		wd_mce_addMenu(column, '3/5 last',"[three_fifth_last]your_content[/three_fifth_last]" );
		wd_mce_addMenu(column, '4/5 last',"[four_fifth_last]your_content[/four_fifth_last]" );
		wd_mce_addMenu(column, '5/6 last',"[five_sixth_last]your_content[/five_sixth_last]" );
		wd_mce_addSubMenu(menu,'Column',column);
		
		//heading
		wd_mce_addMenu(menu, 'heading','[heading size=""]your_content[/heading]');
		//icon
		wd_mce_addMenu(menu, 'icon','[icon icon="" color=""]');
		//recent post
		wd_mce_addMenu(menu, 'recent blogs','[recent_blogs style="small-title" category="" columns="1" number_posts="" title="yes" thumbnail="yes" meta="" excerpt="" excerpt_words="30"]');
		wd_mce_addMenu(menu, 'recent blogs slider','[recent_blogs_slider title="" category="" columns="1" number_posts="4" show_post_title="1" show_thumbnail="1" show_meta="0" show_view_more_button="1" show_excerpt="1" excerpt_words="30"]');
		//banner
		wd_mce_addMenu(menu, 'banner','[banner link_url="#" bg_image="" bg_color="#000000" title_small="Small title" title_big="Big title" sub_title="Sub title" opacity_sub = "0.3" title_color="#ffffff" position_title="right" top_padding="102px" bottom_padding="105px" border_color_inset="" label="no" label_text_big="Big label" label_text_small="Small label" label_bg="#c30005" ]' );
		//accordion
		wd_mce_addMenu(menu, 'accordion','[accordions][accordion_item title="title"]your_content[/accordion_item][/accordions]' );
		//alert
		wd_mce_addMenu(menu, 'alert','[alert style="" close="" ]your_content[/alert]' );
		//badges
		wd_mce_addMenu(menu, 'badges','[badge type="" ]your_content[/badge] ' );	
		//buttons
		wd_mce_addMenu(menu, 'buttons','[button size="default" link="#" background="#c30005" color="#ffffff"]button text[/button]' );
		//add_line
		wd_mce_addMenu(menu, 'add line','[add_line height_line="" color="" class=""]');
		//align
		wd_mce_addMenu(menu, 'align','[align  style=""][/align]' );	
		//checklist
		wd_mce_addMenu(menu, 'checklist','[checklist icon=""]your_content[/checklist]');
		//code
		wd_mce_addMenu(menu, 'code','[code]your_content[/code]');
		//dropcap
		wd_mce_addMenu(menu, 'dropcap','[dropcap color=""]your_text[/dropcap]');
		//label
		wd_mce_addMenu(menu, 'label','[label type=" "]your_text[/label]');
		//tabs
		wd_mce_addMenu(menu, 'tabs','[tabs][tab_item title=""]your_content[/tab_item][tab_item title=""]your_content[/tab_item][/tabs]');
		//progress bars
		wd_mce_addMenu(menu, 'progress bar','[progress animated_bars="" striped_bars=""][bar style="" percent_bars=""]Text[/bar][/progress]'); 
		//faq
		wd_mce_addMenu(menu, 'faq','[faq title=""]your_content[/faq]'); 
		//feature
		wd_mce_addMenu(menu, 'feature','[feature slug="" id="" title="yes" thumbnail="yes" excerpt="yes" content="yes"]'); 									
		//google map
		wd_mce_addMenu(menu, 'google_map','[google_map address="" title="" height="360" zoom="16" map_type="TERRAIN" map_color="" water_color="" road_color=""]your_content[/google_map]');
		//hidden phone
		wd_mce_addMenu(menu, 'hidden phone','[hidden_phone]your_content[/hidden_phone]');
		//hr
		wd_mce_addMenu(menu, 'hr','[hr style="" class=""]your_content[/hr]');
		//listing
		wd_mce_addMenu(menu, 'listing','[ew_listing custom_class="" style_class=""]your_content[/ew_listing]');
		//menu
		wd_mce_addMenu(menu, 'menu','[menu menu="" depth="1"]');
		//quote
		wd_mce_addMenu(menu, 'quote','[quote class=""]your_content[/quote]');
		//testimonial
		wd_mce_addMenu(menu, 'testimonial','[testimonial slug="" id=""]'); 
		//tooltip
		wd_mce_addMenu(menu, 'tooltip','[tooltip style="" tooltip_content=""]your_content[/tooltip]'); 
		
		
        editor.addButton( 'wd_shortcodes_button', {
            title: 'WD Shortcode'
            ,text: ''
            ,type: 'menubutton'
            ,icon: false
			,classes:'wd_shortcode_button'
            ,menu: menu
        });
		
    });
	function wd_mce_addMenu(d,e,a){d.push({text:e,value:a,onclick:function(event){event.stopPropagation();_editor.insertContent(a)}})}
	function wd_mce_addSubMenu(d,t,m){d.push({text:t,menu:m});}
})();