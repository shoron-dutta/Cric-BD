<?php

include "db_connection.php";

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE watchlist (
        
		id INT(25) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
		user_id INT(25) unsigned NOT NULL,
		match_id INT(25) unsigned NOT NULL
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table watchlist created successfully";
    $sql= "ALTER TABLE watchlist

	ADD CONSTRAINT FK_user_map
	FOREIGN KEY (user_id) REFERENCES users(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	
	ADD CONSTRAINT FK_match_map_
	FOREIGN KEY (match_id) REFERENCES matchlist(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE";
	$conn->exec($sql);
    echo "Table watchlist altered successfully";
    
	
	}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
