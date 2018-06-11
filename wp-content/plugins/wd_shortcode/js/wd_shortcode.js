
if( typeof wd_update_next_prev_slider_button !== 'function'){
	function wd_update_next_prev_slider_button($_this){
		if( $_this.find(".owl-item:first").length <= 0)
			return;
		var wrapper_width = $_this.width();
		var item_width = $_this.find(".owl-item").width();
		item_width += parseInt($_this.find(".owl-item").css("padding-left").replace("px",""));
		item_width += parseInt($_this.find(".owl-item").css("padding-right").replace("px",""));
		var num_showed_item = parseInt(Math.round(wrapper_width/item_width));
		var total_item = $_this.find(".owl-item").length;
		if( num_showed_item >= total_item ){
			$_this.find('.next').addClass("hidden");
			$_this.find('.prev').addClass("hidden");
		}
		else{
			$_this.find('.next').removeClass("hidden");
			$_this.find('.prev').removeClass("hidden");
		}
	}
}

jQuery.fn.wd_product_shortcode_load_more = function(atts){
	if( _sc_ajax_uri.length == 0 )
		return;
	var ajax_url = _sc_ajax_uri;
	var _this = jQuery(this);
	_this.find('.btn_load_more').addClass('loading');
	jQuery.ajax({
		 type : "post",
		 dataType : "html",
		 url : ajax_url,
		 data : {action: "wd_product_shortcode_load_more",atts:atts},
		 error: function(xhr,err){
			
		 },
		 success: function(response) {
			_this.find('.featured_product_wrapper_inner ul.products').append(response);
			_this.find('.featured_product_wrapper_inner ul.products li').addClass('product');
			_this.find('.btn_load_more').attr('data-paged',++atts.paged);
			var is_end_page = _this.find('span.wd_flag_end_page').length > 0?true:false;
			if(is_end_page){
				_this.find('.btn_load_more').remove();
				_this.find('span.wd_flag_end_page').remove();
			}
			else{
				_this.find('.btn_load_more').removeClass('loading');
			}
			if( typeof qs == "function"){
				qs({
					itemClass		: '.products li.product.type-product.status-publish  .product_thumbnail_wrapper' 
					,inputClass		: 'input.hidden_product_id' 
				});
			}
			if( typeof wd_bind_added_to_cart == 'function' )
				wd_bind_added_to_cart();
			var columns = (atts.columns.length > 0)?atts.columns:4;
			_this.wd_product_shortcode_update_first_last_class(columns);
		 }
	  }); 
}
	
jQuery.fn.wd_product_shortcode_update_first_last_class = function(columns){
	/* This is wrapper id (Random id) */
	var count = 0;
	var class_name = "";
	jQuery(this).find("ul.products li").removeClass("first last");
	jQuery(this).find("ul.products li").each(function(index,element){
		count++;
		if (count==1){
			class_name = "first";
		}
		else{
			if(count==columns){
				class_name = "last";
				count = 0;
			}
			else{
				class_name = "";
			}
		}
		jQuery(element).addClass(class_name);
		
	});
}
