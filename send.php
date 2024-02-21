<?php
require_once 'src/Mandrill.php'; //Not required with Composer
?>
<?

	include ("spina/lib/frontend/funciones_n.php");
	$para = get_param("contact_email");
	
	
	// Clean up the input values
	foreach($_POST as $key => $value) {
		if(ini_get('magic_quotes_gpc'))
			$_POST[$key] = stripslashes($_POST[$key]);
		
		$_POST[$key] = htmlspecialchars(strip_tags($_POST[$key]));
	}
	
	// Assign the input values to variables for easy reference
	echo $name = $_POST["nombre"];
	echo "--";
	echo $email = $_POST["email"];
	echo $subject = $_POST["asunto"];
	echo $mensaje = $_POST["msj"];
	echo $mailto = $_POST["email"]; //Mail de administración
	echo $mailto2 = $para; //Mail de cliente
?>

<?php
try {
	
    $mandrill = new Mandrill('TVO5G6v7ZG2qtL7XLM_H9A');
	
	$template_name = 'cinescuela-contact-form';
    $template_content = array(
        array(
            'name' => 'Cinescuela',
            'content' => 'example content'
        )
    );
	
    $message = array(
        'html' => '<p>Example HTML content</p>',
        'text' => 'Example text content',
        'subject' => 'Hemos recibido tu mensaje',
        'from_email' => 'no-reply@cinescuela.org',
        'from_name' => 'Cinescuela',
        'to' => array(
            array(
                'email' => $mailto,
                'name' => $name,
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => 'no-reply@cinescuela.org'),
        'important' => false,
        'track_opens' => null,
        'track_clicks' => null,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'merge_language' => 'mailchimp',
		 'global_merge_vars' => array(
            array(
                'name' => 'fname',
                 'content' => $name
            )
        ),
        'merge_vars' => array(
            array(
                'rcpt' => $mailto2,
                'vars' => array(
                    array(
                        'name' => 'fname',
                        'content' => $name
                    )
                )
            )
        )
    );
	/*Notificacion a Cinescuela*/
	
	$template_name2 = 'cinescuela-info';
    $template_content2 = array(
        array(
            'name' => 'Cinescuela ',
            'content' => 'example content'
        )
    );
	
    $message2 = array(
        'html' => '<p>Example HTML content</p>',
        'text' => 'Example text content',
        'subject' => 'Nuevo mensaje de contacto',
        'from_email' => 'no-reply@cinescuela.org',
        'from_name' => 'Cinescuela',
        'to' => array(
            array(
                'email' => $mailto2,
                'name' => 'Cinescuela Admin',
                'type' => 'to'
            )
        ),
        'headers' => array('Reply-To' => 'no-reply@cinescuela.org'),
        'important' => false,
        'track_opens' => null,
        'track_clicks' => null,
        'auto_text' => null,
        'auto_html' => null,
        'inline_css' => null,
        'url_strip_qs' => null,
        'preserve_recipients' => null,
        'view_content_link' => null,
        'tracking_domain' => null,
        'signing_domain' => null,
        'return_path_domain' => null,
        'merge' => true,
        'merge_language' => 'mailchimp',
		 'global_merge_vars' => array(
            array(
                'name' => 'fname',
                 'content' => $name
            ),
			array(
                'name' => 'email',
                 'content' => $email
            ),
			array(
                'name' => 'subj',
                 'content' => $subject
            ),
			array(
                'name' => 'message',
                 'content' => $mensaje
            )
        ),
        'merge_vars' => array(
            array(
                'rcpt' => $email,
                'vars' => array(
                    array(
                        'name' => 'fname',
                        'content' => $name
                    )
                )
            )
        )
    );
	
	
	
    $async = false;
    $ip_pool = 'Main Pool';
    $send_at = date();
   // $result = $mandrill->messages->send($message, $async, $ip_pool, $send_at);
    $result = $mandrill->messages->sendTemplate($template_name, $template_content, $message, $async, $ip_pool, $send_at);
	
	$mandrill2 = new Mandrill('TVO5G6v7ZG2qtL7XLM_H9A');
	$result = $mandrill2->messages->sendTemplate($template_name2, $template_content2, $message2, $async, $ip_pool, $send_at);
   // print_r($result);
   echo "Gracias por contactarnos. Pronto estaremos en contacto.";
    /*
    Array
    (
        [0] => Array
            (
                [email] => recipient.email@example.com
                [status] => sent
                [reject_reason] => hard-bounce
                [_id] => abc123abc123abc123abc123abc123
            )
    
    )
    */
} catch(Mandrill_Error $e) {
    // Mandrill errors are thrown as exceptions
    echo 'Error de envío: ' . get_class($e) . ' - ' . $e->getMessage();
    // A mandrill error occurred: Mandrill_Unknown_Subaccount - No subaccount exists with the id 'customer-123'
    throw $e;
}

echo 1;
?>