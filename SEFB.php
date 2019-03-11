<?php 
/*
Plugin Name: Send email for buyers. SEFB
Plugin URI: 
Description: Visualization of assistant invoice API
Version: 1.0.0
Author: me
Author URI: 
*/

// Add hook
add_action('admin_menu', 'myPluginAddPages');

// Add plugin to admin menu
function myPluginAddPages(){
	add_menu_page('SEFB Title', 'SEFB', 'manage_options', 'slugSEFB', 'SEFBMain');
	//add_submenu_page('slugMyPlugin', 'SubMenu Title', 'SubMenu', 'manage_options', 'slugSubMyPlugin', 'my-plugin/myPluginMain.php');
}

// Sub level menu function
function SEFBMain(){
	echo "
		<input type='button' name='' id='showAllProducts' value='showAllProducts'>";

	wp_register_script( 'my-plugin-script', plugins_url('/script.js', __FILE__) );
	wp_enqueue_script('my-plugin-script');
	
	echo "<div id='categories'></div>";
	echo "<div id='products'></div>";
}

add_action('wp_ajax_showCategories', 'showCategories', 99);
add_action('wp_ajax_showAllProducts', 'showAllProducts', 98);
add_action('wp_ajax_showProductsFromCategory', 'showProductsFromCategory', 97);
require 'WpDataBase.php';



// // Mail
	// $to = "rochass@rambler.ru";  //EMAIL получателя
 //    $subject = "У нас новый пост"; //Тема письма
 //    $message = "У нас новая статья на сайте."; //Тело письма с указанием ID записи
 //    $headers[] = "From: WP <yyyy@gmail.com>";

 //    if (wp_mail($to, $subject, $message)) {
 //    	echo "\n Mail send";
 //    }
 //    else {
 //    	echo "Something wrong with wp_email()";
 //    }
    