<?php
session_start();

$code = $_SESSION['code'];
//echo $code;
	try
        {
                $conn = new PDO('sqlite:db/usersDb_PDO.sqlite');
//		echo "HI"; 
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//		echo "HERE";
                $stmt = $conn->exec("UPDATE users SET loggedin = 0 WHERE access_token =\"$code\"");
       
        }
        catch(PDOException $e)
        {
                echo $e->getMessage();
		die();
        }

session_unset();

?>
<p>You have successfully logged out.</p>
<p>Click <a href="index.php">here</a> to log back in.</p>
