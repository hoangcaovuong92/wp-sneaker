<?php
/**
 * @package WordPress
 * @subpackage WooSneaker
 * @since WD_Responsive
 **/
 //error_reporting("-1");
$_template_path = get_template_directory();
require_once $_template_path."/theme/theme.php";
$theme = new Theme(array(
	'theme_name'	=>	"WooSneaker",
	'theme_slug'	=>	'woosneaker'
));
$theme->init();

/**
 * Slightly Modified Options Framework
 */
require_once ('admin/index.php');

?>