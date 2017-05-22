<?php

include "db_connection.php";

try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE matchlist (
        
		id INT(25) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
		team1_id INT(25) unsigned NOT NULL ,
		team2_id INT(25) unsigned NOT NULL ,
		tournament_name VARCHAR(100) NOT NULL,
		date_of_match DATE NOT NULL,
		match_name varchar(50),
		
		venue VARCHAR(25),
		
		toss_result VARCHAR(50) DEFAULT NULL ,
		team1_score VARCHAR(50) DEFAULT NULL,
		team2_score VARCHAR(50) DEFAULT NULL,
		team1_extra INT(25) unsigned DEFAULT NULL,
		team2_extra INT(25) unsigned DEFAULT NULL,
		result VARCHAR(50) DEFAULT NULL,
		id_player_of_the_match INT(25) unsigned
		

    )";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table matchlist created successfully<br>";

	$sql= "ALTER TABLE matchlist

	ADD CONSTRAINT FK_match_team_map1
	FOREIGN KEY (team1_id) REFERENCES team(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE,

	ADD CONSTRAINT FK_match_team_map2
	FOREIGN KEY (team2_id) REFERENCES team(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE,
	
	ADD CONSTRAINT FK_player_of_the_match_map
	FOREIGN KEY (id_player_of_the_match) REFERENCES player(id)
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
