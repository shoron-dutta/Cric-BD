<?php

include "db_connection.php";

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE notification (
        
		id INT(25) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user_id INT(25) unsigned NOT NULL ,
		match_id INT(25) unsigned NOT NULL ,
		message VARCHAR(1000)
		

    )";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table notification created successfully<br>";

	$sql= "ALTER TABLE notification

	ADD CONSTRAINT FK_users_map22
	FOREIGN KEY (user_id) REFERENCES users(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	
	ADD CONSTRAINT FK_match_map22
	FOREIGN KEY (match_id) REFERENCES matchlist(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE";
	
    $conn->exec($sql);

    echo "Table match altered successfully";
	
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
