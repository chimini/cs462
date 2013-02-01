<?php
phpinfo();
$code = $_GET['code'];
$client_id = "OHX2FUWCTNUFL1ZRJKYEQVWCT4U0QM04NHUL5RAR2ZWZCNHM";
$client_secret = "XMJXLPQDTRYNOQF4L0435ESTHAJBJ4HBQDAQQXBGK5IBYPRV";
$redirect_uri = "http://ec2-23-22-249-51.compute-1.amazonaws.com/lab1/protected/views/site/login-callback.php";
$url = "https://foursquare.com/oauth2/access_token?client_id=$client_id&client_secret=$client_secret&grant_type=authorization_code&redirect_uri=$redirect_uri&code=$code";
echo $url."\n";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_URL, $url);
  $result = curl_exec($ch);
  curl_close($ch);

  $values = json_decode($result, true);
  $token = $values['access_token'];
echo $token . "\n";
?>
