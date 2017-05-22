<?php

include "db_connection.php";


try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE battingScore (
        id INT(25) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
		
		match_id INT(25)unsigned NOT NULL,
        team_id INT(25) unsigned NOT NULL,
        batsman_id INT(25) unsigned ,
		if_batted varchar(50),
		
		runs INT(25) unsigned,
		balls_faced  INT(25) unsigned,
		
		if_out varchar(50),
		wicket_by INT(25) unsigned DEFAULT NULL,
		wicket_type VARCHAR(50) DEFAULT NULL
    )";
	
	// use exec() because no results are returned
    
	$conn->exec($sql);
    
	echo "Table battingScore created successfully<br>";

	$sql="ALTER TABLE battingScore
		
		ADD CONSTRAINT FK_match_id_map2
		FOREIGN KEY (match_id) REFERENCES matchlist(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
		
		ADD CONSTRAINT FK_team_id_map2
		FOREIGN KEY (team_id) REFERENCES team(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
		
		ADD CONSTRAINT FK_batsman_map
		FOREIGN KEY (batsman_id) REFERENCES player(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
		
		ADD CONSTRAINT FK_wicket_by_map
		FOREIGN KEY (wicket_by) REFERENCES player(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE";
	
	$conn->exec($sql);
    
	echo "Table battingScore altered successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
