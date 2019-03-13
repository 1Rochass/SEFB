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
	// Get all products from categry
	$result = $wpdb->get_results("
		SELECT * FROM wp_posts 
		join wp_term_relationships 
		on wp_posts.id = wp_term_relationships.object_id 
		WHERE wp_term_relationships.term_taxonomy_id = $idCategory
	");
	// Display response
	foreach ($result as $value) {

	// Get images
		$images = $wpdb->get_var("SELECT meta_value  FROM wp_postmeta WHERE post_id = $value->ID AND meta_key = '_product_image_gallery'");
		// If we have several product images (_product_image_gallery = 304,305)
		$images = explode(",", $images);
		foreach ($images as $image) {
			$imageSource = $wpdb->get_var("SELECT meta_value from wp_postmeta WHERE post_id = $image and meta_key = '_wc_attachment_source'");
			echo "<img src='$imageSource' class='product_image_gallery' width=100px height=100px>";
		}

	// Get price 
		$price = $wpdb->get_var("SELECT meta_value  FROM wp_postmeta WHERE post_id = $value->ID AND meta_key = '_price'");

		echo "<div class='price'>" . $price . "</div>";
		echo "<div class='post_title'>" . $value->post_title . "</div>";
		echo "<input type='button' id='" . $value->ID . "' class='SEFB' value='Add to email'>";
		echo "<br>";


	}
	// Else showing zero after content
	wp_die();

}
// SEFB
function SEFBaction() {
	// idProduct
	$productId = $_POST['productId'];
	
	// Need for WP
	global $wpdb;
// Get data from wp_posts
	$wp_posts = $wpdb->get_row("SELECT * FROM wp_posts WHERE ID = $productId");
	
// Get images from _product_image_gallery
	$images = $wpdb->get_var("SELECT meta_value  FROM wp_postmeta WHERE post_id = $productId AND meta_key = '_product_image_gallery'");
	// If we have several product images (_product_image_gallery = 304,305)
	$images = explode(",", $images);
	// Take first free elements from array
	$images = array_slice($images, 0, 3);
// productImages sources from _wc_attachment_source
	$productImages = [];
	foreach ($images as $image) {
		$productImages[] = $wpdb->get_var("SELECT meta_value from wp_postmeta WHERE post_id = $image and meta_key = '_wc_attachment_source'");
	}

// Get price 
	$productPrice = $wpdb->get_var("SELECT meta_value  FROM wp_postmeta WHERE post_id = $productId AND meta_key = '_price'");
	echo "<input type='button' class='modalBox-close' value='Закрыть окно'>";
	echo "
		<label for='modalBox-recipientEmail'>E-mail получатля</label>
		<input type='text' id='modalBox-recipientEmail' class='modalBox-recipientEmail'>
	";
	// Product title
	echo "<div class='modalBox-productTitle'>" . $wp_posts->post_title . "</div>";
	// Product price
	echo "<div class='modalBox-productPrice'>" . $productPrice . "</div>";
	// Product images
	foreach ($productImages as $image) {
		echo "<div class='modalBox-productImage'><img src='" . $image . "'></div>";
	}
	// Product content
	echo "<div class='modalBox-productContent'>" . $wp_posts->post_content . "</div>";
	echo "<input type='button' class='modalBox-productSend' value='Отправить e-mail'>";
// Else showing zero after content
	wp_die();
}