<?php include "db_connection.php"; 
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
    	if ($_POST['delete'] && $_POST['bowlingscore_id']) {
            $bowlingscore_id = $_POST['bowlingscore_id'];
            $sql = mysql_query("SELECT *
                    FROM bowltingscore 
                    WHERE id = '$bowlingscore_id' ");
            if(mysql_num_rows($sql) >= 1){

                $query = mysql_query("DELETE FROM bowlingscore WHERE id=".$bowlingscore_id." LIMIT 1");

                if($query){
                    echo 'bowler record deleted successfully.';
                }else
                {
                    echo 'bowler record deletion failed.';
                }


            }
      	}
    }	
    
}

?>
<a href="data_entry_bowlingscore_table.php"><button>Add new bowler record</button></a>
<h1>Table Bowling score for admin</h1>
<table border="1">
<thead>
	<tr>
	<!--<th>i</th>-->
	<th>id</th>
	<th>match id</th>
	<th>match name</th>
	
	<th>team id</th>
	<th>team name</th>
	<th>bowler id</th>
	<th>bowler name</th>
	<th>wickets taken</th>
	<th>runs given</th>
	<th>overs bowled</th>
	<th>current_bowling</th>
	
	<th></th>
	
	
	</tr>
</thead>
<tbody>
	<?php
            $sql = "SELECT *
                    FROM bowlingscore";

            $result = mysql_query($sql);

            //if (mysql_num_rows($result) > 0) {
                // output data of each row
                $i=1;
                
                while($row = mysql_fetch_assoc($result)) {
					//get match name
					
					$match_name_query=mysql_query("SELECT * FROM matchlist WHERE id='".$row['match_id']."'");
					$match_name_row=mysql_fetch_assoc($match_name_query);
					$match_name=$match_name_row['match_name'];
					//get team name
					
					$team_name_query=mysql_query("SELECT * FROM team WHERE id='".$row['team_id']."'");
					$team_name_row=mysql_fetch_assoc($team_name_query);
					$team_name=$team_name_row['team_name'];
					//get player name
					$bowler_name_query=mysql_query("SELECT * FROM player WHERE id='".$row['bowler_id']."'");
					$bowler_name_row=mysql_fetch_assoc($bowler_name_query);
					$bowler_name=$bowler_name_row['player_name'];
				
                    echo '<tr>';
                   // echo '<td>'.$i.'</td>';
                    echo '<td>'.$row["id"].'</td>';
                    echo '<td>'.$row["match_id"].'</td>';
					echo '<td>'.$match_name.'</td>';
					
					echo '<td>'.$row["team_id"].'</td>';
					echo '<td>'.$team_name.'</td>';
					
					echo '<td>'.$row["bowler_id"].'</td>';
					echo '<td>'.$bowler_name.'</td>';
					
					echo '<td>'.$row["wickets_taken"].'</td>';
					echo '<td>'.$row["runs_given"].'</td>';
					echo '<td>'.$row["overs_bowled"].'</td>';
					echo '<td>'.$row["current_bowling"].'</td>';
			

                    echo '<form method="post" action="view_bowlingScore_table.php">';
                    echo '<input type="hidden" name="bowlingscore_id" value="'.$row['id'].'"/>';
                    echo '<td>
                          <input type="submit" name="delete" value="Delete"/>
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