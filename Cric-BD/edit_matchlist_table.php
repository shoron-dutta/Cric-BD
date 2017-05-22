<?php include "db_connection.php"; ?>
	
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
    if(isset($_POST['update'])){
        if ($_POST['update'] && $_POST['mid']) {
        if ($_POST['update'] == 'Update') {
            $mid = $_POST['mid'];
            $sql = mysql_query("SELECT *
                    FROM matchlist 
                    WHERE id = '$mid' ");
            //return var_dump($sql);
            if(mysql_num_rows($sql) == 1){

                $matchInfo = mysql_fetch_array($sql);
				echo '<h3>update data for match :: '.$matchInfo['match_name'].'</h3>';
                ?>

                <a href="view_matchlist_table.php"><h3>view table matchlist</h3></a>
		
<form method="post" action="edit_matchlist_table.php">

	<input type="text" name="tournament_name" placeholder="tournament name" value="<?php echo $matchInfo['tournament_name'];?>">
	
	<input type="text" name="venue" placeholder="venue" value="<?php echo $matchInfo['venue'];?>"><!--maybe null,but not default null-->
	<!--all these are default null, cz upcoming matches don't have these values-->
	<input type="text" name="toss_result" placeholder="toss ??" value="<?php echo $matchInfo['toss_result'];?>">
	<input type="text" name="team1_score" placeholder="score of team 1" value="<?php echo $matchInfo['team1_score'];?>">
	<input type="text" name="team2_score" placeholder="score of team 2" value="<?php echo $matchInfo['team2_score'];?>">
	<input type="number" name="team1_extra" placeholder="extra runs of team 1" value="<?php echo $matchInfo['team1_extra'];?>">
	<input type="number" name="team2_extra" placeholder="extra runs of team 2" value="<?php echo $matchInfo['team2_extra'];?>">
	<input type="text" name="result" placeholder="result ?" value="<?php echo $matchInfo['result'];?>">
	
	<h4>select player of the match name : </h4>
		<select id="player of the match name" name="player_of_the_match_name" required> 
		<?php
			$sql = "SELECT * FROM player WHERE team_id='".$matchInfo['team1_id']."' OR team_id='".$matchInfo['team2_id']."'";
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)) { ?>
				<option value="<?php echo $row['player_name'];?>"><?php echo $row['player_name']; ?></option>
				<?php
			}
			?>
		  </select>
	
    <input type="hidden" name="mid" value="<?php echo $matchInfo['id']?>"/>

    <input type="submit" name="submit" value="Update"/>
</form>



                <?php

            }
        }
    }   
  }

}
if(!empty($_POST)){
if(isset($_POST['submit'])){

	$tournament_name = mysql_real_escape_string($_POST['tournament_name']);		
 
	$venue=mysql_real_escape_string($_POST['venue']);
	$toss_result=mysql_real_escape_string($_POST['toss_result']);		
	$team1_score = mysql_real_escape_string($_POST['team1_score']);
	$team2_score = mysql_real_escape_string($_POST['team2_score']);
	$team1_extra = $_POST['team1_extra'];
	$team2_extra = $_POST['team2_extra'];
	$result = mysql_real_escape_string($_POST['result']);
	$player_of_the_match_name = mysql_real_escape_string($_POST['player_of_the_match_name']);
	$player_of_the_match_query=mysql_query("SELECT * FROM player where player_name='".$player_of_the_match_name."'");
	$player_of_the_match_row=mysql_fetch_assoc($player_of_the_match_query);
	$id_player_of_the_match=$player_of_the_match_row['id'];
    $mid = $_POST['mid'];
     
    $check = mysql_query("SELECT * FROM matchlist WHERE id = '".$mid."'");
      
    if(mysql_num_rows($check) == 1)
     {
        //return var_dump($_POST);
        $sql = "UPDATE matchlist
        SET tournament_name='$tournament_name',venue='$venue',toss_result='$toss_result',team1_score='$team1_score',
		team2_score='$team2_score',team1_extra='$team1_extra',team2_extra='$team2_extra',result='$result',id_player_of_the_match='$id_player_of_the_match' WHERE `id`='$mid'";

        $registerquery = mysql_query($sql) or die(mysql_error());
    
        if($registerquery)
        {
            header("Location: view_matchlist_table.php");
            exit();
        }
        else
        {
            header("Location: view_matchlist_table.php");
            exit();   
        }       
     }
 
}

}
?>
</body>
<footer>

	<script type="text/javascript">

	</script>
</footer>
</html>