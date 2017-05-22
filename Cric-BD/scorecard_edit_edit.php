<?php include "db_connection.php"; ?>
<?php include "sidebar.php"; ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Scorecard</title>
		<style type="text/css">
		</style>
		<link href="watchlist.css" rel="stylesheet" />
	</head>
<body>
<div id="wrapper">
	<?php
	
	function print_batting($t,$m){
	
            $sql = "SELECT p.player_name,basc.batsman_id,basc.wicket_type,basc.wicket_by,basc.runs,basc.balls_faced
                    FROM player p JOIN battingscore basc WHERE p.id=basc.batsman_id AND p.team_id=".$t." AND match_id=".$m." order by basc.wicket_type desc";
            $result = mysql_query($sql);
			if($result==false){
				echo "error";
			}
			else{
                $i=1;
                while($row = mysql_fetch_assoc($result)) {
						//finding out if he batted or not
					$wicket_type_query=mysql_query("SELECT wicket_type FROM battingscore WHERE batsman_id=".$row['batsman_id']."");
					$w_row = mysql_fetch_assoc($wicket_type_query);
					$played_or_not=$w_row['wicket_type'];
					
					$wicket_taker_name_query=mysql_query("SELECT player_name FROM player WHERE id=".$row["wicket_by"]."");
					if($wicket_taker_name_query==false){
						echo '<tr>';
						echo '<td>'.$row["player_name"].'</td>';
						echo '<td>'.$row["wicket_type"].'</td>';
						echo '<td>'.$row["wicket_by"].'</td>';
						//
						if($row['wicket_type']==null)
						{
							echo '<td>'.'</td>';
						}
						else{
							echo '<td>'.$row["runs"].' ('.$row["balls_faced"].')'.'</td>';
						}
						echo '</tr>';
					}
					else{
						$wicket_taker_row = mysql_fetch_assoc($wicket_taker_name_query);
						$wicket_taker=$wicket_taker_row['player_name'];
						echo '<tr>';                    
						echo '<td>'.$row["player_name"].'</td>';
						echo '<td>'.$row["wicket_type"].'</td>';
						echo '<td>'.$wicket_taker.'</td>';
						echo '<td>'.$row["runs"].' ('.$row["balls_faced"].')'.'</td>';
						echo '</tr>';
						$i++;
					}
				}
				$which_team_query=mysql_query("SELECT team1_id FROM matchlist WHERE id='".$m."'");
				$which_team_row=mysql_fetch_assoc($which_team_query);
				if($which_team_row['team1_id']==$t){
					//that means, now we are printing team 1 score
					$extra_query=mysql_query("SELECT team1_extra FROM matchlist WHERE id='".$m."'");
					$extra_row=mysql_fetch_assoc($extra_query);
					echo'<td>'."EXTRA".'</td>';
					echo '<td>'.'</td>';
					echo '<td>'.'</td>';
					echo '<td>'.$extra_row['team1_extra'].'</td>';
				}
				else{
					//that means, now we are printing team 2 score
					$extra_query=mysql_query("SELECT team2_extra FROM matchlist WHERE id='".$m."'");
					$extra_row=mysql_fetch_assoc($extra_query);
					echo'<td>'."EXTRA".'</td>';
					echo '<td>'.'</td>';
					echo '<td>'.'</td>';
					echo '<td>'.$extra_row['team2_extra'].'</td>';
				}
						
			}  
	}//end of print function for batting
	
		//print bowling function
		function print_bowling($t,$m){
	
            $sql = "SELECT * from bowlingscore WHERE match_id=".$m." AND team_id=".$t."";
            $result = mysql_query($sql);
			if($result==false){
				echo "error";
			}
			else{
                $i=1;
                while($row = mysql_fetch_assoc($result)) {
					//finding out the bowler name if he batted or not
					$bowler_name_query=mysql_query("SELECT player_name FROM player WHERE id=".$row['bowler_id']."");
					$b_row = mysql_fetch_assoc($bowler_name_query);
					$bowler_name=$b_row['player_name'];
						echo '<tr>';
						
						echo '<td>'.$bowler_name.'</td>';
						echo '<td>'.$row["wickets_taken"].'</td>';
						echo '<td>'.$row["runs_given"].'</td>';
						echo '<td>'.$row["overs_bowled"].'</td>';
						
						echo '</tr>';
				}
			}
		}//end of function for print bowling
	
	if(!empty($_POST)){
    if(isset($_POST['details'])){
    	if ($_POST['details'] && $_POST['mid']) {
            $mid = $_POST['mid'];
			
			$t1_query=mysql_query("SELECT team1_id FROM matchlist WHERE id=".$mid."");
			$t1_row = mysql_fetch_assoc($t1_query);
			$t1=$t1_row['team1_id'];//finding out team1 for the match with match id mid
			
			$t2_query=mysql_query("SELECT team2_id FROM matchlist WHERE id=".$mid."");
			$t2_row = mysql_fetch_assoc($t2_query);
			$t2=$t2_row['team2_id'];//finding out team2 for the match with match id mid
			
			$team1_name_query=mysql_query("SELECT team_name FROM team WHERE id=".$t1."");
			$name1_row=mysql_fetch_assoc($team1_name_query);
			$name1=$name1_row['team_name'];
			
			$team2_name_query=mysql_query("SELECT team_name FROM team WHERE id=".$t2."");
			$name2_row=mysql_fetch_assoc($team2_name_query);
			$name2=$name2_row['team_name'];
			
			
			$team1_score_query=mysql_query("SELECT team1_score FROM matchlist WHERE id=".$mid."");
			$score1_row=mysql_fetch_assoc($team1_score_query);
			$score1=$score1_row['team1_score'];
			
			$team2_score_query=mysql_query("SELECT team2_score FROM matchlist WHERE id=".$mid."");
			$score2_row=mysql_fetch_assoc($team2_score_query);
			$score2=$score2_row['team2_score'];
			}else 
			{
				echo "3rd loop e dhuke nai";
			}
		}else
		{
			echo "2nd loop e dhuke ni";
		}
	}else
	{	
		echo "1st loop e dhuke ni";
	}	
?>

	<h2>   Batting Score : <?php echo $name1; ?></h2>
	<!--table for 1st team's score of batting-->
	<table border="1">
		<thead>
			<tr>
				<th>Player name</th>
				<th>wicket type</th>
				<th>Wicket by</th>
				<th>runs(balls)</th>

			</tr>
		</thead>
		<tbody>
			<?php print_batting($t1,$mid);?>
		</tbody>
		
	</table>
	
	<h2>   Bowling Score : <?php echo $name2; ?></h2>
	<!--table for 2nd team's score of bowling-->
	<table border="1">
		<thead>
			<tr>
				<th>bowler name</th>
				<th>wickets taken</th>
				<th>runs</th>
				<th>overs</th>
			</tr>
		</thead>
		<tbody>
			<?php print_bowling($t2,$mid); ?>
		</tbody>
	</table>
		<h2>   Batting Score : <?php echo $name2; ?></h2>
	<!--table for 2nd team's score of batting-->
	<table border="1">
		<thead>
			<tr>
				
				<th>Player name</th>
				<th>wicket type</th>
				<th>Wicket by</th>
				<th>runs(balls)</th>
			</tr>
		</thead>
		<tbody>
			<?php print_batting($t2,$mid); ?>
		</tbody>
		
	</table>
	
	<h2>   Bowling Score : <?php echo $name1; ?></h2>
	<!--table for 1st team's score of bowling-->
	<table border="1">
		<thead>
			<tr>
				<th>bowler name</th>
				<th>wickets taken</th>
				<th>runs</th>
				<th>overs</th>

			</tr>
		</thead>
		<tbody>
			<?php print_bowling($t1,$mid);?>
		</tbody>
		
	</table>
	
	
</div>
</body>
<footer>
	<script src="assets/js/jquery-1.10.2.js"></script>
	<script type="text/javascript">

	</script>
</footer>
</html>