<?php
if(isset($_POST['email']) && !empty($_POST['email'])){

		$name = $_POST["name"];
		$email = $_POST["email"];
		$subject = $_POST["subject"];
		$message = $_POST["message"];


		//date_default_timezone_set('Asia/Kolkata');
		$timestamp_capture = time();
		//$reg_time = date('d-m-Y h:i:s a', time());
		//$reg_ip = $_SERVER['REMOTE_ADDR'];
		//$reg_ip_proxy = $_SERVER['HTTP_X_FORWARDED_FOR'];

		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
	    	$siteurl = "https://".$_SERVER['SERVER_NAME'];
	    }else{
	    	$siteurl = "http://".$_SERVER['SERVER_NAME'];
	    }

	
		$to = "englishproarg@gmail.com";
		$mail_subject = "Mensaje enviado desde el formulario de contacto por $name | ID del mensaje ".$timestamp_capture;
		$mail_message = "
		<br>
		<p>Detalles:</p>
		<br>
		<p><strong>Nombre:</strong> $name</p> 
		<p><strong>Correo electrónico:</strong> $email</p> 
		<p><strong>Asunto:</strong> $subject</p> 
		<p><strong>Mensaje:</strong></p> 
		<p>
		$message
		</p>
		<br><br><br>...<br>
		Este mensaje fue enviado desde $siteurl utilizando un formulario de contacto.
		";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// More headers
		$headers .= 'From: '.$name.' <noreply@'.$_SERVER['SERVER_NAME'].'>' . "\r\n" . 'Responder a: '.$email."\r\n";
		$sendmail = mail($to,$mail_subject,$mail_message,$headers);
		//$sendmail = 'ok';
		if($sendmail){
			$response['status'] = 'ok';
			$response['msg'] = 'Mensaje enviado con éxito.';
			echo json_encode($response);
		}else{
			$response['status'] = 'error';
			$response['msg'] = 'Algo salió mal (Error 1). ¡Por favor envíanos un email!';
			echo json_encode($response);
		}
			

}else{
	$response['status'] = 'error';
	$response['msg'] = 'Algo salió mal (Error 1). ¡Por favor envíanos un email!';
	echo json_encode($response);
}
?>