<?php

$to = "dorian.voets@enseirb-matmeca.fr"; //connect with pdo to retrieve user email
$subject = "Beteirb Password";
$message = "Salut ceci est un test \r\n".
			"hahahahhahaha";
$headers = "From: beteirb@enseirb-matmeca.fr" .
			"\r\n" .
			"X-Mailer: PHP/" . phpversion();

mail($to, $subject, $message, $headers);

?>
