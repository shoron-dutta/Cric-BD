<?php

include "db_connection.php";
try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE users (
		id INT( 25 ) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY ,
		username VARCHAR( 50 ) NOT NULL ,
		email VARCHAR( 50 ) NOT NULL ,
		password VARCHAR( 50 ) NOT NULL         

    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table users created successfully";
    $sql= "ALTER TABLE users

	ADD UNIQUE(email)";
	$conn->exec($sql);
    echo "Table users altered successfully";
    
	
	}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
