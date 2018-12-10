<?php

require("core/sendgrid-php/sendgrid-php.php");

$from = new SendGrid\Email(null, "inominate@gmail.com");
$subject = "Hello World from the SendGrid PHP Library!";
$to = new SendGrid\Email(null, "stef.dworschak@gmail.com");
$content = new SendGrid\Content("text/html", "
Hello, Email!
<br /><br />
<h1><a href='http://www.google.com'>To Google</a>
<br /><br />
Thanks
");
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = getenv('SENDGRID_API_KEY');
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
echo $response->statusCode();
echo $response->headers();
echo $response->body();


 ?>
