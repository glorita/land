<?php
$email = $_POST['email'];
$name = $_POST['name'];
$message = $_POST['message'];
$_captcha = $_POST['g-recaptcha-response'];

$name = strtoupper($name);

$to      = 'crivero@navefoods.com';
$title    = 'Contact Form send by '.$name;
$headers = 'From: crivero@navefoods.com' . "\r\n" .
    'Reply-To: crivero@navefoods.com' . "\r\n" .
    'Content-type: text/html; charset=iso-8859-1' . "\r\n".
    'X-Mailer: PHP/' . phpversion();

$final_message = '
<html>
<head>
  <title>Contact form send by: '.$name.'</title>
</head>
<body>
  <h1>'.$name.' wants to hear about us!</h1>
  <strong>Name:</strong>
  <p>'.$name.'</p>
  <strong>Email:</strong>
  <p>'.$email.'</p>
  <strong>Message:</strong>
  <p>'.$message.'</p>
  <p>'.$_captcha.'</p>
</body>
</html>
';

//usuario sigue hacia la pagina mientras sigue el proceso de envio de mail
header('Location: ../index.html');

//validar el token del captcha con la api de google
$data = array(
    'secret' => '6Le1-18UAAAAAOwicrlctAGvWw2aVyootLgFvZ-L',
    'response' => $_captcha
);
$ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
$postString = http_build_query($data, '', '&');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json = json_decode(curl_exec($ch));
curl_close($ch);

//si el token es correcto se envía el mail
if($json->success == true)
    mail($to, $title, $final_message, $headers);

?>