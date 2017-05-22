<?php include "db_connection.php";
include "update_player_functions.php";
include "data_entry.php";
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
	
	if(!empty($_POST['match_name']) && !empty($_POST['team_name']) &&
	!empty($_POST['batsman_name']) &&  !empty($_POST['if_batted'])){
			
		$match_id=get_match_id($_POST['match_name']);
		$team_id=get_team_id($_POST['team_name']);
		$batsman_id=get_player_id($_POST['batsman_name']);
		$if_batted=mysql_real_escape_string($_POST['if_batted']);
		
		if($_POST['if_batted']=="yes"){
			if(!empty($_POST['runs']) && !empty($_POST['balls_faced']) && !empty($_POST['if_out'])){
			
				$runs=$_POST['runs'];
				$balls_faced=$_POST['balls_faced'];
				$if_out=mysql_real_escape_string($_POST['if_out']);
				
				
				$sr = ($_POST['runs'])/($_POST['balls_faced'])*100;
				
				if($_POST['if_out'] == "yes"){
					if(!empty($_POST['wicket_by']) && !empty($_POST['wicket_type'])){
					
						$wicket_by=get_player_id($_POST['wicket_by']);
						$wicket_type=mysql_real_escape_string($_POST['wicket_type']);
						
						$sql_insert_query1=mysql_query("INSERT into battingscore(match_id,team_id,
							batsman_id,if_batted,runs,balls_faced,if_out,wicket_by,wicket_type)
							VALUES('".$match_id."','".$team_id."','".$batsman_id."','".$if_batted."',
							'".$runs."','".$balls_faced."','".$if_out."','".$wicket_by."','".$wicket_type."')");
			
						update_matches_played($batsman_id);
						update_innings_played($batsman_id);
						update_total_runs($batsman_id,$runs);
						update_sr_sum($batsman_id,$sr);
						update_century_fifty_zero($batsman_id,$runs);
						update_best_batting($batsman_id,$runs);
						update_batting_strikeRate_avg($batsman_id);
					}
					else{
					?>
						<script>alert('player got out. enter wicket taker\'s name and wicket type.');</script>
					<?php
					}
				}
				elseif($_POST['if_out']=="no"){
					$sql_insert_query2=mysql_query("INSERT into 
					battingscore(match_id,team_id,batsman_id,if_batted,runs,balls_faced,if_out) 
					VALUES('".$match_id."','".$team_id."','".$batsman_id."','".$if_batted."',
					'".$runs."','".$balls_faced."','".$if_out."')");
					
					update_matches_played($batsman_id);
					update_innings_played($batsman_id);
					update_total_runs($batsman_id,$runs);
					update_not_outs($batsman_id);
					update_sr_sum($batsman_id,$sr);
					update_century_fifty_zero($batsman_id,$runs);
					update_best_batting($batsman_id,$runs);
					update_batting_strikeRate_avg($batsman_id);
							
				}
			}
			else{
				?><script>alert('player batted. enter data of runs, balls faced and if out.');</script><?php
			}
		}
		elseif($_POST['if_batted']=="no"){
			
			$sql_insert_query3=mysql_query("INSERT into 
			battingscore(match_id,team_id,batsman_id,if_batted) 
			VALUES('".$match_id."','".$team_id."','".$batsman_id."','".$if_batted."')");
			
			update_matches_played($batsman_id);
		}		
	}
}
?>

<a href="view_battingScore_table.php"><h2>view table battingscore</h2></a>

<form method="post" action="data_entry_battingscore_table.php">
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
	<select id="team1 name" name="team_name" required> 
		<?php
			$sql = "SELECT * FROM team";
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)) { ?>
				<option value="<?php echo $row['team_name'];?>"><?php echo $row['team_name']; ?></option>
				<?php
			}
			?>
		  </select>
		<h4>select batsman name : </h4>
		<select id="batsman name" name="batsman_name" required> 
		<?php
			$sql = "SELECT * FROM player";
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)) { ?>
				<option value="<?php echo $row['player_name'];?>"><?php echo $row['player_name']; ?></option>
				<?php
			}
			?>
		  </select>
	<h4>did the player bat ? : </h4>
		<select id="if batted" name="if_batted" required> 

				<option value="yes"><?php echo "yes"; ?></option>
				<option value="no"><?php echo "no"; ?></option>

		  </select>

	<!--maybe null,but not default null-->
	<input type="number" name="runs" placeholder="runs">
	<input type="number" name="balls_faced" placeholder="balls faced">
	<h4>did the player get out ? : </h4>
		<select id="if out" name="if_out"> 

				<option value="yes"><?php echo "yes"; ?></option>
				<option value="no"><?php echo "no"; ?></option>

		  </select>
	<h4>select wicket taker's name : </h4>
		<select id="wicket by" name="wicket_by"> 
		<?php
			$sql = "SELECT * FROM player";
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)) { ?>
				<option value="<?php echo $row['player_name'];?>"><?php echo $row['player_name']; ?></option>
				<?php
			}
			?>
		  </select>
	<input type="text" name="wicket_type" placeholder="wicket type">
	<input type="submit" name="register" value="Register"/>
</form>

</body>
<footer>

	<script type="text/javascript">

	</script>
</footer>
</html>