<?php 
/*
Plugin Name: Send email for buyers. SEFB
Plugin URI: 
Description: Visualization of assistant invoice API
Version: 1.0.0
Author: me
Author URI: 
*/

/**
* Add css 
*/
// function SEFB_add_my_stylesheet() {
// 	wp_register_style( 'SEFB_style', plugins_url('style.css', __FILE__));
// 	wp_enqueue_style( 'SEFB_style' );
// }
// add_action('wp_enqueue_scripts', 'SEFB_add_my_stylesheet');

function SEFB_register_head() {

    $url = plugins_url( 'style.css', __FILE__ );

    echo "<link rel='stylesheet' type='text/css' href='$url' />\n";
}
add_action('admin_head', 'SEFB_register_head');

/**
* Add hook
*/
add_action('admin_menu', 'SEFBAddPages');
// Add plugin to admin menu
function SEFBAddPages(){
	add_menu_page('SEFB Title', 'SEFB', 'manage_options', 'slugSEFB', 'SEFBMain');
	//add_submenu_page('slugMyPlugin', 'SubMenu Title', 'SubMenu', 'manage_options', 'slugSubMyPlugin', 'my-plugin/myPluginMain.php');
}

// Sub level menu function
function SEFBMain(){
	/*
	* Html
	*/
	// Modal box
	echo "<div id='modalBox'></div>";

	echo "<input type='button' name='' id='showAllProducts' value='showAllProducts'>";
	echo "<div id='categories'></div>";
	echo "<div id='products'></div>";
}

/*
* Add actions
*/
add_action('wp_ajax_showCategories', 'showCategories', 99);
add_action('wp_ajax_showAllProducts', 'showAllProducts', 98);
add_action('wp_ajax_showProductsFromCategory', 'showProductsFromCategory', 97);
add_action('wp_ajax_SEFBaction', 'SEFBaction', 96);
require 'WpDataBase.php';

/*
* Send email
*/
add_action('wp_ajax_sendEmail', 'sendEmail', 95);
require 'sendEmail.php';

/*
* Require js
*/
wp_register_script( 'my-plugin-script', plugins_url('/script.js', __FILE__) );
wp_enqueue_script('my-plugin-script');




    