<?php

    //Using Heroku Sendmail Addon
    //https://devcenter.heroku.com/articles/sendgrid#php
    //https://github.com/sendgrid/sendgrid-php

    require("../sendgrid-php/sendgrid-php.php");

    function sendEmail($receiver, $subjectLine, $htmlBody) {
      $from = new SendGrid\Email(null, "inominate18@gmail.com");
      $subject = $subjectLine;
      $to = new SendGrid\Email(null, $receiver);
      $content = new SendGrid\Content("text/html",$htmlBody);
      $mail = new SendGrid\Mail($from, $subject, $to, $content);

      $apiKey = getenv('SENDGRID_API_KEY');
      $sg = new \SendGrid($apiKey);

      $response = $sg->client->mail()->send()->post($mail);
      return $response->statusCode();
    }

?>
