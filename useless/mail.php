<?php

$to = "dorian.voets@enseirb-matmeca.fr"; //connect with pdo to retrieve user email
$subject = "Your Password";
$message = "Hello, you forgot your password, here is a temporary password, use it to login. \r\n".
			" You will need to change your password again.";
$headers = "From: beteirb@enseirb-matmeca.fr" . "\r\n" .
			"X-Mailer: PHP/" . phpversion();

mail($to, $subject, $message, $headers);

?>