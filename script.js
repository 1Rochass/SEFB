jQuery( document ).ready(function(){ // есть разные варианты этой строчки, но такая мне нравится больше всего, т.к. всегда работает
	  
	// Show categories
	var data = {
			action: 'showCategories',
	};

	jQuery.post(ajaxurl, data, function(response){
		jQuery('#categories').html(response);
	});
	
	// Show products
  	jQuery('#showAllProducts').click(function(){ // при клике на элемент с id="misha_button" 
	 	//alert('Если это работает, уже неплохо'); // выводим сообщение

		// Show products
		var data = {
				action: 'showAllProducts',
		};

		jQuery.post(ajaxurl, data, function(response){
			jQuery('#products').html(response);
		});
	});

	// Show products from categories
	jQuery('#categories').on("click", ".category", function(){
		var idCategory = jQuery(this).attr('id');
		
		var data = {
			action: 'showProductsFromCategory',
			idCategory: idCategory,
		}

		jQuery.post(ajaxurl, data, function(response){
			jQuery('#products').html(response);
		});
	});
});