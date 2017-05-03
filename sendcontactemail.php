<?
//require('recaptcha/autoload.php');
//require_once "recaptchalib.php";
require_once __DIR__ . '/vendor/autoload.php';


$secret = '6LcuFA8UAAAAAFjPpkzoRy2j7Aez2YnYcs8wykxB';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$recaptcha_response = $request->g_recaptcha_response;


if ($recaptcha_response) {
  $recaptcha = new \ReCaptcha\ReCaptcha($secret);
  $resp = $recaptcha->verify($recaptcha_response, $_SERVER['REMOTE_ADDR']);
  if ($resp->isSuccess()) {
    $first_name = $request->first_name;
    $last_name = $request->last_name;
    $email = $request->email;
    $msg = $request->msg;

    $to = 'info@grafx.co';

// Subject
    $subject = 'Contact form from grafx.co';

// Message
    $message = '
<html>
<body>
  <table rules="all" style="border-color: #666;" cellpadding="10">
    <tr style="background: #eee;">
      <td><b>First name :</b></td>' . strip_tags($first_name) . '</td>
    </tr>
    <tr>
      <td><b>Last name :</b></td>' . strip_tags($last_name) . '</td>
    </tr>
    <tr>
      <td><b>Email :</b></td>' . strip_tags($email) . '</td>
    </tr>
    <tr>
      <td><b>Message :</b></td>' . htmlentities($msg) . '</td>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=UTF-8';
    $headers[] = 'From: info@grafx.co<info@grafx.co>';


// Mail it
    mail($to, $subject, $message, implode("\r\n", $headers));
    die('success');

  } else die('error');
}
