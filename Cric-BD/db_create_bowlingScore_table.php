<?php

include "db_connection.php";

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE bowlingScore (
        id INT(25) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
		match_id INT(25) unsigned NOT NULL ,
        team_id INT(25) unsigned NOT NULL ,
		bowler_id INT(25) unsigned  ,
		wickets_taken INT(25) unsigned NOT NULL,
		runs_given INT(25) unsigned NOT NULL,
		overs_bowled NUMERIC(3,1) NOT NULL,
		current_bowling varchar(50)
		

    )";

//
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table bowlingScore created successfully";
	
	$sql="ALTER TABLE bowlingScore
		
		ADD CONSTRAINT FK_match_id_map
		FOREIGN KEY (match_id) REFERENCES matchlist(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
		
		ADD CONSTRAINT FK_team_id_map
		FOREIGN KEY (team_id) REFERENCES team(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE,
		
		ADD CONSTRAINT FK_bowler_map
		FOREIGN KEY (bowler_id) REFERENCES player(id)
		ON UPDATE CASCADE
		ON DELETE CASCADE";
		$conn->exec($sql);
    echo "Table bowlingScore altered successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
