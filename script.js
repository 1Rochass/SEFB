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
		// Get id
		var idCategory = jQuery(this).attr('id');
		
		var data = {
			action: 'showProductsFromCategory',
			idCategory: idCategory,
		}

		jQuery.post(ajaxurl, data, function(response){
			jQuery('#products').html(response);
		});
	});

	// SEFB
	jQuery('#products').on("click", ".SEFB", function(){
		
		var productId = jQuery(this).attr('id');

		var data = {
			action: 'SEFBaction',
			productId: productId,
		}

		jQuery.post(ajaxurl, data, function(response){
			jQuery('#modalBox').html(response);
		});

		jQuery('#modalBox').show();

	});
	// Clode modal box
	jQuery('#modalBox').on("click", ".modalBox-close", function(){
		jQuery('#modalBox').html('');
		jQuery('#modalBox').css('display', 'none');
	});
	// Send email
	jQuery('#modalBox').on("click", ".modalBox-productSend", function(){
	// Recipient email
		var recipientEmail = jQuery('.modalBox-recipientEmail').val();
	// Product title
		var productTitle = jQuery('.modalBox-productTitle').text();
	// Product price
		var productPrice = jQuery('.modalBox-productPrice').text();
	// Product images
		// !!! Create array 
		var productImages = []; 
		// !!! index is a main proper part in this code
		jQuery('.modalBox-productImage img').each(function(index){
			productImages[index] = jQuery(this).attr('src'); 
		});
	// Product content
		var productContent = jQuery('.modalBox-productContent').text();
		
		var data = {
			action: 'sendEmail',
			recipientEmail: recipientEmail,
			productTitle: productTitle,
			productPrice: productPrice,
			productContent: productContent,
			productImages: productImages,
		}

		jQuery.post(ajaxurl, data, function(response){
			jQuery('#modalBox').html(response);
		});

	});

});