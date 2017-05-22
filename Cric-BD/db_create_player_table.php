<?php
include "db_connection.php";
try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE player (
        id INT(25) unsigned  AUTO_INCREMENT PRIMARY KEY, 
        player_name VARCHAR(100) NOT NULL,
		team_id INT(25) unsigned NOT NULL,
		category VARCHAR(1000) NOT NULL,
		matches_played INT(25),
		
		best_bowling VARCHAR(25) DEFAULT NULL,
		total_wickets INT(25),
		total_balls INT(25),
		total_runs_given INT(25),
		bowling_strike_rate DOUBLE(10,3),
		bowling_avg DOUBLE(10,3),
		bowling_economy DOUBLE(10,3),

		best_batting INT(25) DEFAULT NULL,
		innings_played INT(25),
		not_outs INT(25),
		total_runs INT(25),
		batting_strike_rate DOUBLE(10,3),
		sr_sum DOUBLE(10,3),
		batting_avg DOUBLE(10,3),
		hundreds INT(25),
		fifties INT(25),
		zeroes INT(25)
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table player created successfully";
    $sql= "ALTER TABLE player

	ADD CONSTRAINT FK_player_team_map
	FOREIGN KEY (team_id) REFERENCES team(id)
	ON UPDATE CASCADE
	ON DELETE CASCADE";

	$conn->exec($sql);
    echo "Table player altered successfully";
    
	
	}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
