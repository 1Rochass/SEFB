<?php 

function sendEmail() {
	// POST
	$recipientEmail = $_POST['recipientEmail'];
	$productTitle = $_POST['productTitle'];
	$productPrice = $_POST['productPrice'];
	$productContent = $_POST['productContent'];
	$productImages = $_POST['productImages'];



	// Prepare for sending email
	$to = $recipientEmail;  // EMAIL получателя
    $subject = $productTitle; // Тема письма
    // Тело письма 
    // $message = "<b>" . $productPrice  . " </b>::: " . $productContent . "<img src='cid:my-cool-picture-uid' width='250' height='250' alt='' style='display:block' />"; 
    $message = '
Hello John,
checkout my new cool picture.
<img src="' . $productImages[0] . '" width="300" height="400">

Thanks, hope you like it ;)';
    $headers[] = 'Content-type: text/html; charset=utf-8';
    // $headers[] = "From: Stanki-met.ru <mega-admin@stanki-met.ru>";
    // Тут можно прикреплять файлы
    $attachments;
    
    // Sen email
    if (wp_mail($to, $subject, $message, $headers)) {
    	echo "\n Mail send";

    	// Else showing zero after content
		wp_die();
    	
    }
    else {
    	echo "Something wrong with wp_email()";
    	
    	// Else showing zero after content
		wp_die();
    }
}