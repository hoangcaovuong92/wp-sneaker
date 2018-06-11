/**
 * WD QuickShop
 *
 * @license commercial software
 * @copyright (c) 2013 Codespot Software JSC - WPDance.com. (http://www.wpdance.com)
 */



(function($) {

	// disable QuickShop:
	//if(jQuery('body').innerWidth() <1000)
	//	EM_QUICKSHOP_DISABLED = true;

	jQuery.noConflict();
	qs = null;
	jQuery(function ($) {
			//insert quickshop popup
			 $('#em_quickshop_handler').prettyPhoto({
				deeplinking: false
				,opacity: 0.9
				,social_tools: false
				,default_width: 900
				
				,default_height:450
				,theme: 'pp_woocommerce'
				,changepicturecallback : function(){
					$("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").addClass('buttons_added').append('<input type="button" value="+" id="add1" class="plus" />').prepend('<input type="button" value="-" id="minus1" class="minus" />');
					$('.pp_inline').find('form.variations_form').wc_variation_form();
					$('.pp_inline').find('form.variations_form .variations select').change();
					jQuery('body').trigger('wc_fragments_loaded');	

					var $_this = jQuery('#wd_quickshop_wrapper');
					var owl = $_this.find('.qs-thumbnails').owlCarousel({
							items : 4
							,itemsCustom : false
							,itemsDesktop : [1199,4]
							,itemsDesktopSmall : [980,4]
							,itemsTablet: [768,4]
							,itemsTabletSmall: false
							,itemsMobile : [479,4]
							,slideSpeed : 800
							,navigation : false
							,pagination: false
							,paginationNumbers: true
							,mouseDrag: false
							,scrollPerPage: false
							,rewindNav: true
							,navigationText: ['']
						});
						$_this.on('click', '.next', function(e){
							e.preventDefault();
							owl.trigger('owl.next');
						});

						$_this.on('click', '.prev', function(e){
							e.preventDefault();
							owl.trigger('owl.prev');
						});

				}
			});
			
		function hide_element( jquery_obj ){
			var transition = (jQuery('html').hasClass('ie8') || jQuery('html').hasClass('ie9'))?0.3:0.1;
			TweenMax.to( jquery_obj , transition, {	css:{
													//visibility: 'invisible'
													opacity : 0
													,display : 'none'
												}			
											,ease:Power2.easeInOut
										}
						);
		}
		
		
		// quickshop init
		function _qsJnit() {
			var selectorObj = arguments[0];
			var listprod = $(selectorObj.itemClass);	// selector chon tat ca cac li chua san pham tren luoi
			var baseUrl = '';
			
			var qsHandlerImg = $('#em_quickshop_handler img');
			var qsHandler = $('#em_quickshop_handler');

			$.each(listprod, function (index, value) {
				var _ul_prods = $(value).parents("ul.products");
				var _div_prods = $(value).parents("div.products");
				var has_quickshop = true;
				if( typeof _ul_prods !== "undefined" ){
					has_quickshop = (_ul_prods.hasClass('no_quickshop') == false);
				}else{
					has_quickshop = (_div_prods.hasClass('no_quickshop') == false);
				}
				if( has_quickshop ){

					// show quickshop handle when hover product image
					$(value).live('mouseover', function () {
						var o = $(this).offset();
						var qs_btn = $('#em_quickshop_handler');
						var _ajax_uri = _qs_ajax_uri + "?ajax=true&action=load_product_content&product_id="+jQuery(value).siblings(selectorObj.inputClass).val();
						qsHandler.attr('href', _ajax_uri );
                        
						var transition = (jQuery('html').hasClass('ie8') || jQuery('html').hasClass('ie9'))?0.3:0.05;
						TweenMax.to( qsHandler , transition, {	css:{
																top: Math.round(o.top + ( $(this).height() - qs_btn.height() )/2) +'px'
																,left:  Math.round(o.left+( $(this).width() - qs_btn.width() )/2)  +'px'
																,opacity : 1
																,display : 'block'
															}			
															,ease:Linear.linear
													}
									);

					});
					$(value).live('mouseout', function (event) {
						var _to_element = event.relatedTarget || event.toElement;

						if( typeof _to_element !== "null" && typeof _to_element !== "undefined" ){
							if( $(_to_element).length > 0 ){
								var _cur_id = $(_to_element).attr('id');
								if( typeof _cur_id !== "undefined" ){
									//if( _cur_id != "em_quickshop_handler" && _cur_id != "qs_inner1" && _cur_id != "qs_inner2" ){
									if( _cur_id != "em_quickshop_handler" && _cur_id != "em_quickshop_handler_img" && _cur_id != "qs_inner1" && _cur_id != "qs_inner2" ){
										hide_element(qsHandler);
									}else{
										$(value).find('.product-main-link').trigger('mouseover');
									}
								}else{
									hide_element(qsHandler);
								}
							}else{
								hide_element(qsHandler);
							}
						}else{
							hide_element(qsHandler);


						}
					});
					
				}
			});

			//fix bug image disapper when hover
			qsHandler.live('mouseover', function () {
				$(this).show().css('opacity','1');
			}).live('click', function (event) {		
				hide_element(qsHandler);
				
				event.preventDefault();
			});
			$('#real_quickshop_handler').click(function(event){
				event.preventDefault();
			});

			$('.wd_quickshop.product').live('mouseover',function(){
				if( !$(this).hasClass('active') ){
					$(this).addClass('active');
					$('#qs-zoom,.wd-qs-cloud-zoom,.cloud-zoom, .cloud-zoom-gallery').CloudZoom({});	

				}
			});
			
		}

		if (typeof EM_QUICKSHOP_DISABLED == 'undefined' || !EM_QUICKSHOP_DISABLED)
		
			/*************** Disable QS in Main Menu *****************/
			jQuery('ul.menu').find('ul.products').addClass('no_quickshop');
			/*************** Disable QS in Main Menu *****************/		
		
			_qsJnit({
				itemClass		: '.products li.product.type-product.status-publish  .product_thumbnail_wrapper,.products div.product.type-product.status-publish  .product_thumbnail_wrapper' //selector for each items in catalog product list,use to insert quickshop image
				,inputClass		: 'input.hidden_product_id' //selector for each a tag in product items,give us href for one product
			});
			qs = _qsJnit;
	});
})(jQuery);

