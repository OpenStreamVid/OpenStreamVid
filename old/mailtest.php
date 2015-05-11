<?php 
		$subject = 'Validation of Open StreamVid account';
		
		$message = 'Hi Laranou,\n\n
					You have just created an account for the website Open StreamVid. Click <a href="http://www.google.fr">here</a> to be redirected and finalise your registration.\n\n
					See you soon on Open StreamVid ! ';

		$headers = 'From: noreply@openstreamvid.com' . "\r\n" .
				   'Reply-To: noeply@openstreamvid.com' . "\r\n" .
				   'X-Mailer: PHP/' . phpversion();


		if(mail('dyranmaric@hotmail.fr', $subject, $message, $headers)){
			echo'send';
		}
		else{
			echo'oupsi';
		}
?>	