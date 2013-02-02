<?php
if (!array_key_exists('code', $_GET))
{
	header("Location: https://foursquare.com/oauth2/authenticate?client_id=OHX2FUWCTNUFL1ZRJKYEQVWCT4U0QM04NHUL5RAR2ZWZCNHM&response_type=code&redirect_uri=http://ec2-23-21-29-75.compute-1.amazonaws.com/app/index.php");
}
else
{
	$code = $_GET['code'];
	$client_id = "OHX2FUWCTNUFL1ZRJKYEQVWCT4U0QM04NHUL5RAR2ZWZCNHM";
	$client_secret = "XMJXLPQDTRYNOQF4L0435ESTHAJBJ4HBQDAQQXBGK5IBYPRV";
	$redirect_uri = "http://ec2-23-21-29-75.compute-1.amazonaws.com/app/index.php";
	$url = "https://foursquare.com/oauth2/access_token?client_id=$client_id&client_secret=$client_secret&grant_type=authorization_code&redirect_uri=$redirect_uri&code=$code";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	echo $result . "\n";
	curl_close($ch);

	$values = json_decode($result, true);
	$token = $values['access_token'];
	
	try 
	{
		$conn = new PDO('db/sqlite:usersDb_PDO.sqlite');
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare('SELECT * FROM users WHERE access_token = :token');
		$stmt->execute(array('access_token' => $token));
		$result = $stmt->fetchAll();
		if ( count($result) ) 
		{
			foreach($result as $row) 
			{
				print_r($row);
			}
		} 
		else 
		{
			echo "No rows returned.";
			# Prepare the query ONCE
			$stmt = $conn->prepare('INSERT INTO users VALUES(:access_token, "", 1)');
			$stmt->bindParam(':access_token', $token);
			$stmt->execute();
		}
	} 
	catch(PDOException $e) 
	{
		echo $e->getMessage();
	}
}	
?>
<html>                                                                          
    <body>                                                                  
		<h1>Flower & Foursquare Hub</h1>
		<form action="index.php" method="get">
			Name: <input type="text" name="user">
			<input type="submit" value="Login with FourSquare">
		</form>
    </body>                                                                 
</html>
  
