<?php include "db_connection.php";
include "data_entry.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	</style>
	<link href="data_entry.css" rel="stylesheet" />
</head>
<body>

<?php
if(!empty($_POST)){
if(!empty($_POST['player_name']) && !empty($_POST['team_name']) && !empty($_POST['category'])){

	    $player_name = mysql_real_escape_string($_POST['player_name']);
		$team_name = mysql_real_escape_string($_POST['team_name']);
		$team_id_query = mysql_query("SELECT id FROM team WHERE team_name = '".$team_name."'");
		$team_id_row = mysql_fetch_assoc($team_id_query);
		$team_id = $team_id_row['id'];
		$category = mysql_real_escape_string($_POST['category']);
		
        //return var_dump($_POST);
		$registerquery = mysql_query("INSERT INTO player (player_name,team_id,category,matches_played,total_wickets,total_balls,
		total_runs_given,bowling_strike_rate,bowling_avg,bowling_economy,best_batting,
		innings_played,not_outs,total_runs,batting_strike_rate,sr_sum,batting_avg,hundreds,fifties,zeroes) 
		VALUES('".$player_name."','".$team_id."','".$category."',0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0)");
		if (!$registerquery) {
			die('Invalid query: ' . mysql_error());
		}
        else if($registerquery)
        {
            echo 'player '.$player_name.' was successfully added.';
        }
        else
        {
            echo 'Sorry, player addition failed.';   
        }
	 
	 }
}
/*
elseif(empty($_POST['tn'])){
    echo 'Registration failed, please fill all the fields.'; 
}*/
?>

<a href="view_player_table.php"><h3>view table player</h3></a>

<form method="post" action="data_entry_player_table.php">

	<input type="text" name="player_name" placeholder="player name" required>
	<input type="text" name="category" placeholder="category" required>
	<!--input type="dropdown" list="All_teams" name="team_name" placeholder="select team name"-->
		  <select id="All_teams" name="team_name">
		  <?php
		  $sql = "SELECT *
                    FROM team";

		  $result = mysql_query($sql);
		  while($row = mysql_fetch_assoc($result)) { 
		  //echo "<option value="$row[city]"/>"; // Format for adding options ?>
        <option value="<?php echo $row['team_name']; ?>"><?php echo $row['team_name']; ?></option>
			<?php
			}
			?>
		  </select>
	   
	
	
	<input type="submit" name="register" value="Register"/>
</form>

</body>
<footer>

	<script type="text/javascript">

	</script>
</footer>
</html>