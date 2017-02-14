<?php
  ini_set("include_path", '/home/nathande/php:' . ini_get("include_path") );
  require_once "Mail.php";

  // Check for empty fields
  if(empty($_POST['name'])  		||
     empty($_POST['email']) 		||
     empty($_POST['phone']) 		||
     empty($_POST['message'])	||
     !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
     {
  	echo "No arguments Provided!";
  	return false;
  }

  $name = $_POST['name'];
  $email_address = $_POST['email'];
  $phone = $_POST['phone'];
  $message = $_POST['message'];

  $from = "Nathan Deamer <nd@nathandeamer.com>";
  $to = "Nathan Deamer <nd@nathandeamer.com>";
  $subject = "Website Contact Form: $name";
  $body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";

  $host = "lu-shared01.cpanelplatform.com";
  $username = "noreply@nathandeamer.com";
  $password = "XXXXXXX";
  $headers = array ('From' => $from,'To' => $to,'Subject' => $subject);
  $smtp = Mail::factory('smtp', array ('host' => $host, 'auth' => true,'username' => $username,'password' => $password));

  $mail = $smtp->send($to, $headers, $body);
  if (PEAR::isError($mail)) {
    echo $mail->getMessage();
    return false;
  } else {
    return true;
  }
?>
