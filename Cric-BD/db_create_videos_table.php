<?php
include "db_connection.php";

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE videos (
        
		id INT(25) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
		video_name VARCHAR(100) ,
		video_link VARCHAR(100)
		

    )";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table videos created successfully<br>";

	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
