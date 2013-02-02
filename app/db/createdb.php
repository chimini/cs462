<?php
  try
  {
    //open the database
    $db = new PDO('sqlite:usersDb_PDO.sqlite');

    //create the database
    $db->exec("CREATE TABLE users (access_token TEXT PRIMARY KEY, name TEXT, loggedin BOOLEAN)");    

  }
  catch(PDOException $e)
  {
    print 'Exception : '.$e->getMessage();
  }
?>
