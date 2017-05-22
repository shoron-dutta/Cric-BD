<?php include "db_connection.php"; 
	include "calculate_sr_avg.php";
	include "data_entry.php";
?>
	
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">


	</style>

	<link href="watchlist.css" rel="stylesheet" />

</head>
<body>

<?php 
if(!empty($_POST)){
    if(isset($_POST['delete'])){
    	if ($_POST['delete'] && $_POST['pid']) {
            $pid = $_POST['pid'];
            $sql = mysql_query("SELECT *
                    FROM player 
                    WHERE id = '$pid' ");
            if(mysql_num_rows($sql) >= 1){

                $query = mysql_query("DELETE FROM player WHERE id=".$pid." LIMIT 1");

                if($query){
                    echo 'player deleted successfully.';
                }else
                {
                    echo 'player deletion failed.';
                }


            }
      	}
    }	
    
}

?>
<a href="data_entry_player_table.php"><button>Add new player</button></a>
<table border="1">
<thead>
	<tr>
	<th>player id</th>
	<th>player name</th>
	<th>team id</th>
	<th>team name</th>
	<th>category</th>
	<th>matches played</th>
	
	<th>best bowling</th>
	<th>total wickets</th>
	<th>total balls</th>
	<th>total runs given</th>
	<th>bowling strike rate</th>
	<th>bowling avg</th>
	<th>bowling economy</th>
	
	<th>best batting</th>
	<th>innings played</th>
	<th>not outs</th>
	<th>total runs</th>
	<th>batting strike rate</th>
	<th>sr sum</th>
	<th>batting avg</th>
	<th>hundreds</th>
	<th>fifties</th>
	<th>zeroes</th>
	
	
	
	
	<th></th>
	<th></th>
	
	
	</tr>
</thead>
<tbody>
	<?php
            $sql = "SELECT *
                    FROM player";

            $result = mysql_query($sql);

            //if (mysql_num_rows($result) > 0) {
                // output data of each row
                $i=1;
                
                while($row = mysql_fetch_assoc($result)) {
                    
					$team_name=mysql_fetch_assoc(mysql_query("SELECT * FROM team where id='".$row["team_id"]."'"))['team_name'];
					
                    echo '<tr>';
                    echo '<td>'.$row["id"].'</td>';
                    echo '<td>'.$row["player_name"].'</td>';
					echo '<td>'.$row["team_id"].'</td>';
					echo '<td>'.$team_name.'</td>';
					
					echo '<td>'.$row["category"].'</td>';
					echo '<td>'.$row["matches_played"].'</td>';
					
					
					echo '<td>'.$row["best_bowling"].'</td>';
					echo '<td>'.$row["total_wickets"].'</td>';
					echo '<td>'.$row["total_balls"].'</td>';
					echo '<td>'.$row["total_runs_given"].'</td>';
					echo '<td>'.$row["bowling_strike_rate"].'</td>';
					echo '<td>'.$row["bowling_avg"].'</td>';
					echo '<td>'.$row["bowling_economy"].'</td>';
					
					
					echo '<td>'.$row["best_batting"].'</td>';
					echo '<td>'.$row["innings_played"].'</td>';
					echo '<td>'.$row["not_outs"].'</td>';
					echo '<td>'.$row["total_runs"].'</td>';
					echo '<td>'.$row["batting_strike_rate"].'</td>';
					echo '<td>'.$row["sr_sum"].'</td>';
					echo '<td>'.$row["batting_avg"].'</td>';
					echo '<td>'.$row["hundreds"].'</td>';
					echo '<td>'.$row["fifties"].'</td>';
					echo '<td>'.$row["zeroes"].'</td>';
					

                    echo '<form method="post" action="view_player_table.php">';
                    echo '<input type="hidden" name="pid" value="'.$row['id'].'"/>';
                    echo '<td>
                          <input type="submit" name="delete" value="Delete"/>
                          </td>';
                    echo '</form>';
					echo '<form method="post" action="edit_player_table.php">';
                    echo '<input type="hidden" name="pid" value="'.$row['id'].'"/>';
                    echo '<td>
                          <input type="submit" name="update" value="Update"/>
                          </td>';
                    echo '</form>';
                    echo '</tr>';

                    $i++;

                }
                
            /*} 
			else {
                echo "0 results";
            }*/
        ?>
</tbody>
	
</table>

</body>
<footer>
	<script src="assets/js/jquery-1.10.2.js"></script>
	<script type="text/javascript">

	</script>
</footer>
</html>