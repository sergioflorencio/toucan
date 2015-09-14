<?php

	function email($destinatario,$messagem,$subject){


	  // Check if the "from" input field is filled out
	// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <'.$destinatario.'>' . "\r\n";
		$headers .= 'Reply-To: captacao@osuc.org.br' . "\r\n";
		

		
		// send mail
		mail($destinatario,$subject,str_replace("\n.", "\n..", $messagem),$headers);


	}
	if(isset($_POST['email_email']) and isset($_POST['email_mensagem'])){
		email($_POST['email_email'],$_POST['email_mensagem'],$_POST['subject']);
	}
	if(isset($_GET['email_email']) and isset($_GET['email_mensagem'])){
		email($_GET['email_email'],$_GET['email_mensagem'],$_GET['subject']);
	}



?>