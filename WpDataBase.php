<?php 

// Show categories
function showCategories() {
	// Need for WP 
	global $wpdb; 

	$newtable = $wpdb->get_results("
	SELECT * FROM wp_terms
	join wp_termmeta
	on wp_terms.term_id = wp_termmeta.term_id
		WHERE wp_termmeta.meta_value > 0
	 ");
	// Display response
	foreach ($newtable as $key => $value) {
		echo "<input type='button' value='" . $value->name . "' id='" . $value->term_id . "' class='category'>";
	}
	// Else showing zero after content
	wp_die();
}	
// Show all products
function showAllProducts() {
	// Need for WP
	global $wpdb; 
	// Make request
	$result = $wpdb->get_results("
		SELECT * FROM wp_posts WHERE post_type = 'product' AND post_status = 'publish' 
		");
	// Display response
	echo "Count of products: 	" . count($result) . "<br>";
	
	foreach ($result as $value) {
		echo $value->post_title . "<br>";
	}
	// Else showing zero after content
	wp_die();
}
// Show products from catwgory
function showProductsFromCategory() {
	// Category id for wp_term_relationships table
	$idCategory = $_POST['idCategory'];
	// Need for WP
	global $wpdb;
	// Join
	$result = $wpdb->get_results("
		SELECT * FROM wp_posts 
		join wp_term_relationships 
		on wp_posts.id = wp_term_relationships.object_id 
		WHERE wp_term_relationships.term_taxonomy_id = $idCategory
	");
	// Display response
	foreach ($result as $value) {
		echo $value->post_title . "<br>";
	}
	// Else showing zero after content
	wp_die();
}