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
    $phone = $request->phone;
    $address1 = $request->address1;
    $address2 = $request->address2;
    $city = $request->city;
    $state = $request->state;
    $zip = $request->zip;
    $country = $request->country;
    $portfolio = $request->portfolio;
    $resume = $request->resume;
    $caps = $request->caps;
    $tools = $request->tools;
    $interested = $request->interested;

    $to = 'cagan@grafx.co';

// Subject
    $subject = 'Job Application from grafx.co';

// Message
    $message = '
<html>
<head>
  <title>Job Application from grafx.co</title>
</head>
<body>
  <p>Job Application from grafx.co</p>
  <table cellpadding="5">
    <tr>
      <td><b>First name :</b> ' . $first_name . '</td>
    </tr>
    <tr>
      <td><b>Last name :</b> ' . $last_name . '</td>
    </tr>
    <tr>
      <td><b>Email :</b> ' . $email . '</td>
    </tr>
    <tr>
      <td><b>Phone :</b> ' . $phone . '</td>
    </tr>
    <tr>
      <td><b>Address1 :</b> ' . $address1 . '</td>
    </tr>
    <tr>
      <td><b>Address2  :</b> ' . $address2 . '</td>
    </tr>
    <tr>
      <td><b>City  :</b> ' . $city . '</td>
    </tr>
    <tr>
      <td><b>State  :</b> ' . $state . '</td>
    </tr>
    <tr>
      <td><b>Zip  :</b> ' . $zip . '</td>
    </tr>
    <tr>
      <td><b>Country :</b> ' . $country . '</td>
    </tr>
    <tr>
      <td><b>Portfolio :</b> ' . $portfolio . '</td>
    </tr>
    <tr>
      <td><b>Resume :</b> <a href="' . $resume . '">' . $resume . '</a></td>
    </tr>
    <tr>
      <td><b>Capabilities :</b> ' . $caps . '</td>
    </tr>
    <tr>
      <td><b>Tools :</b> ' . $tools . '</td>
    </tr>
    <tr>
      <td><b>Interested In :</b> ' . $interested . '</td>
    </tr>
    
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';


// Mail it
    mail($to, $subject, $message, implode("\r\n", $headers));
    die('success');

  } else die('error');
}
