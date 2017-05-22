<?php include "db_connection.php"; 
include "get_match_name.php";
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

if(!empty($_POST['team1_name']) && !empty($_POST['team2_name']) && 
!empty($_POST['tournament_name'])&& !empty($_POST['date_of_match'])){

	if($_POST['team1_name']!=$_POST['team2_name']){
	
		$team1_id = get_team_id($_POST['team1_name']);
		$team2_id = get_team_id($_POST['team2_name']);
		$tournament_name = mysql_real_escape_string($_POST['tournament_name']);
		$date_of_match = $_POST['date_of_match'];
		$match_name = get_match_name_from_teams($team1_id,$team2_id);
		
		
		//if match is played, these details will be available
		if( !empty($_POST['venue']) && !empty($_POST['toss_result'])&&
		!empty($_POST['team1_score'])&& !empty($_POST['team2_score'])&& !empty($_POST['team1_extra'])&&
		!empty($_POST['team2_extra'])&& !empty($_POST['result'])&& !empty($_POST['player_of_the_match_name']))
		{
			
		
		//get values from _POST
		
			$venue=mysql_real_escape_string($_POST['venue']);
			$toss_result=mysql_real_escape_string($_POST['toss_result']);
			$team1_score = mysql_real_escape_string($_POST['team1_score']);
			$team2_score = mysql_real_escape_string($_POST['team2_score']);
			$team1_extra = $_POST['team1_extra'];
			$team2_extra = $_POST['team2_extra'];
			$result = mysql_real_escape_string($_POST['result']);
			$id_player_of_the_match=get_player_id($_POST['player_of_the_match_name']);
		
			//check if player of the match is not from either team
			$team_id_of_player_of_the_match=mysql_fetch_assoc(mysql_query("SELECT team_id FROM player
					WHERE id='".$id_player_of_the_match."'"))['team_id'];
			/*if($team_id_of_player_of_the_match!=$team1_id || $team_id_of_player_of_the_match!=$team2_id){
				?><script>alert('player of the match cannot be from another team !');</script><?php
			}*/
			
			//else{
				$registerquery = mysql_query("INSERT INTO matchlist (team1_id,team2_id,tournament_name,
					date_of_match,match_name,venue,toss_result,team1_score,team2_score,team1_extra,
					team2_extra,result,id_player_of_the_match)VALUES('".$team1_id."','".$team2_id."',
					'".$tournament_name."','".$date_of_match."','".$match_name."','".$venue."',
					'".$toss_result."','".$team1_score."','".$team2_score."','".$team1_extra."',
					'".$team2_extra."','".$result."','".$id_player_of_the_match."')");
					
					
				if (!$registerquery) {
					die('Invalid query: ' . mysql_error());
				}
				else if($registerquery)
				{
					echo 'match was successfully added.';
				}
			
			//}		
		}

		else{
			$registerquery = mysql_query("INSERT INTO matchlist (team1_id,team2_id,tournament_name,
			date_of_match,match_name) VALUES('".$team1_id."','".$team2_id."','".$tournament_name."',
			'".$date_of_match."','".$match_name."')");
		
			if (!$registerquery) {
				die('Invalid query: ' . mysql_error());
			}
			else if($registerquery){
				echo 'match was successfully added.';
			}
		}
	}
	else{
		?>
			<script>alert('cannot have match against self !');</script>
        <?php
	}
}
}
?>

<a href="view_matchlist_table.php"><h3>view table matchlist</h3></a>

<form method="post" action="data_entry_matchlist_table.php">
	<h4>select team 1 name : </h4>
	<select id="team1 name" name="team1_name"> 
		<?php
			$sql = "SELECT * FROM team";
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)) { ?>
				<option value="<?php echo $row['team_name'];?>"><?php echo $row['team_name']; ?></option>
				<?php
			}
			?>
		  </select>
		  <h4>select team 2 name : </h4>
	<select id="team2 name" name="team2_name"> 
		<?php
			$sql = "SELECT * FROM team";
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)) { ?>
				<option value="<?php echo $row['team_name'];?>"><?php echo $row['team_name']; ?></option>
				<?php
			}
			?>
		  </select>
		 <h5></h5>
	<input type="text" name="tournament_name" placeholder="tournament name" required>
	<input type="date" name="date_of_match" placeholder="date of the match" required>
	
	<input type="text" name="venue" placeholder="venue"><!--maybe null,but not default null-->
	<!--all these are default null, cz upcoming matches don't have these values-->
	<input type="text" name="toss_result" placeholder="toss ??">
	<input type="text" name="team1_score" placeholder="score of team 1">
	<input type="text" name="team2_score" placeholder="score of team 2">
	<input type="number" name="team1_extra" placeholder="extra runs of team 1">
	<input type="number" name="team2_extra" placeholder="extra runs of team 2">
	<input type="text" name="result" placeholder="result ?">
		  <h4>select player of the match name : </h4>
	<select id="player of the match" name="player_of_the_match_name"> 
		<?php
			$sql = "SELECT * FROM player";
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)) { ?>
				<option value="<?php echo $row['player_name'];?>"><?php echo $row['player_name']; ?></option>
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