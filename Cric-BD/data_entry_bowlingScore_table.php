<?php include "db_connection.php"; 
include "data_entry.php";
include "update_player_functions.php";
?>
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
		
		$match_id=get_match_id($_POST['match_name']);	  //function use 
		$team_id=get_team_id($_POST['team_name']);		  //function use 
		$bowler_id=get_player_id($_POST['bowler_name']);//function use 
		$wickets_taken=$_POST['wickets_taken'];
		$runs_given=$_POST['runs_given'];
		$overs_bowled=$_POST['overs_bowled'];
		
		$current_bowling=$wickets_taken."/".$runs_given;
		
		$overs=(int)($overs_bowled);//koto over
		$balls=$overs_bowled-$overs;//complete over chara emnite koto ball
		$total_balls=$overs*6+$balls*10;//total koto ball
		if(($balls*10)>5){
			?><script>alert('format not right for over, check again!');</script><?php
		}
		else{
			$registerquery = mysql_query("INSERT INTO bowlingscore 
				(match_id,team_id,bowler_id,wickets_taken,runs_given,overs_bowled,current_bowling) 
				VALUES('".$match_id."','".$team_id."','".$bowler_id."','".$wickets_taken."',
				'".$runs_given."','".$overs_bowled."','".$current_bowling."')");
				
			if (!$registerquery) {
				die('Invalid query: ' . mysql_error());
			}
			else if($registerquery)
			{
				echo 'bowler record successfully added.';
			}
		}
		
		update_total_wickets_total_balls_total_runs_given($wickets_taken,$total_balls,$runs_given,$bowler_id);
		update_best_bowling($bowler_id,$wickets_taken,$runs_given);
		update_bowling_strikeRate_avg_economy($bowler_id);
		
}
 

?>

<a href="view_bowlingScore_table.php"><h3>view table bowlingscore</h3></a>

<form method="post" action="data_entry_bowlingscore_table.php">
	<!--this is for match name-->
	<select id="matches" name="match_name" required>
		<?php
			$date_of_today=date("Y-m-d");						
			//$date_of_today=date("Y-m-d", strtotime("+1 days")) ;
					
            $sql = "SELECT *
                    FROM matchlist WHERE date_of_match<='".$date_of_today."'";


			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)) { ?>
				<option value="<?php echo $row['match_name'];?>"><?php echo $row['match_name']; ?></option>
				<?php
			}
			?>
		  </select>
		  <!--this is for team1 name-->
		  <h4>select team name : </h4>
	<select id="team name" name="team_name" required> 
		<?php
			$sql = "SELECT * FROM team";
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)) { ?>
				<option value="<?php echo $row['team_name'];?>"><?php echo $row['team_name']; ?></option>
				<?php
			}
			?>
		  </select>
		<h4>select bowler name : </h4>
		<select id="bowler name" name="bowler_name" required> 
		<?php
			$sql = "SELECT * FROM player";
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)) { ?>
				<option value="<?php echo $row['player_name'];?>"><?php echo $row['player_name']; ?></option>
				<?php
			}
			?>
		  </select>
	<input type="number" name="wickets_taken" placeholder="wickets taken" required>
	<input type="number" name="runs_given" placeholder="runs given" required>
	<input type="number" name="overs_bowled" step="0.1" placeholder="overs bowled" required>
	
	
	<input type="submit" name="register" value="Register"/>
</form>

</body>
<footer>

	<script type="text/javascript">

	</script>
</footer>
</html>