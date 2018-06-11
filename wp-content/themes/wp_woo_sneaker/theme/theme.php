<?php 
$_template_path = get_template_directory();
require_once $_template_path."/framework/abstract.php";
class Theme extends EWAbstractTheme
{
	public function __construct($options){
		$this->options = $options;
		parent::__construct($options);
		$this->constant($options);
	}
	
	public function init(){
		parent::init();
		//$this->loadOtherJSCSS($this->options);
		add_action('wp_enqueue_scripts',array($this,'loadOtherJSCSS'));
		$this->loadImageSize();
	}
	
	protected function initArrIncludes(){
		parent::initArrIncludes();
		$this->arrIncludes = array_merge($this->arrIncludes,array('class-tgm-plugin-activation'));
	}

	//overwrite widget	
	protected function initArrWidgets(){
		$this->arrWidgets = array('flickr','hot_product','best_selling_product','sale_product','recent_post_slider','customrecent','ew_video','emads','custompages','twitterupdate','ew_multitab','Recent_Comments_custom','ew_social','productaz','ew_subscriptions');
	}
	
	protected function constant($options){
		parent::constant($options);
		define('THEME_EXTENDS', THEME_DIR.'/theme');
		define('THEME_EXTENDS_FUNCTIONS', THEME_EXTENDS.'/functions');
		define('THEME_EXTENDS_SHORTCODES', THEME_EXTENDS.'/shortcodes');
		define('THEME_EXTENDS_INCLUDES', THEME_EXTENDS.'/includes');
		define('THEME_EXTENDS_WIDGETS', THEME_EXTENDS.'/widgets');
		define('THEME_EXTENDS_ADMIN', THEME_EXTENDS.'/admin');
		define('THEME_EXTENDS_ADMIN_TPL', THEME_EXTENDS_ADMIN.'/template');
		define('THEME_EXTENDS_ADMIN_URI', THEME_URI . '/theme/admin');
		define('THEME_EXTENDS_ADMIN_JS', THEME_EXTENDS_ADMIN_URI . '/js');
		define('THEME_EXTENDS_ADMIN_CSS', THEME_EXTENDS_ADMIN_URI . '/css');
	}
	
	protected function loadImageSize(){
		if ( function_exists( 'add_image_size' ) ) {
		   // Add image size for main slideshow
		   
			add_image_size('blog_thumb',430,205,true); /* image for blog thumbnail */		   
			add_image_size('prod_medium_thumb',400,400,true); /* image for custom product shortcode */
			add_image_size('prod_tini_thumb',100,100,true); /* image for slideshow */
			add_image_size('slider',160,70,true); /* image for slideshow */
			add_image_size('related_thumb',213,213,true); /* image for slideshow */
			add_image_size('blog_shortcode',850,405,true); /* image for slideshow */
			add_image_size('blog_shortcode_slider',850,405,true); /* image for slideshow */
			add_image_size('woo_shortcode',94,94,true); /* image for testimonial */
			add_image_size('woo_feature',380,380,true); /* image for feature */
			
			
			global $smof_data;
			$custom_size_count = 3;
			for( $_i = 1 ; $_i <= $custom_size_count ; $_i++ ){
				add_image_size('custom_size_'.$_i,absint($smof_data['wd_size'.$_i.'_width']),absint($smof_data['wd_size'.$_i.'_height']),true);
			}
			add_image_size('wd_menu_thumb',$smof_data['wd_menu_thumb_width'],$smof_data['wd_menu_thumb_height'],true);
		}
	}
	
	public function loadOtherJSCSS(){
		/// Load Custom JS for theme
		if(!is_admin()){			
			wp_register_script( 'woosneaker', THEME_JS.'/woosneaker.js',false,false,true);
			wp_enqueue_script('woosneaker');
		}
	}
}
?>