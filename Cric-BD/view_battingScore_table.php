<?php include "db_connection.php"; 
include "data_entry.php";?>
	
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
    	if ($_POST['delete'] && $_POST['battingscore_id']) {
            $battingscore_id = $_POST['battingscore_id'];
            $sql = mysql_query("SELECT *
                    FROM battingscore 
                    WHERE id = '$battingscore_id' ");
            if(mysql_num_rows($sql) >= 1){

                $query = mysql_query("DELETE FROM battingscore WHERE id=".$battingscore_id." LIMIT 1");

                if($query){
                    echo 'batsman record deleted successfully.';
                }else
                {
                    echo 'batsman record deletion failed.';
                }


            }
      	}
    }	
    
}

?>
<a href="data_entry_battingScore_table.php"><button>Add new batsman record</button></a>
<table border="1">
<thead>
	<tr>

	<th>id</th>
	<th>match id</th>
	<th>match name</th>
	<th>team id</th>
	<th>team name</th>
	<th>batsman id</th>
	<th>batsman name</th>
	
	<th>if batted</th>
	<th>runs</th>
	<th>balls faced</th>
	
	<th>if batted</th>
	<th>wicket by</th>
	<th>wicket type</th>
	<th></th>

	
	
	</tr>
</thead>
<tbody>
	<?php
            $sql = "SELECT *
                    FROM battingscore";

            $result = mysql_query($sql);

            //if (mysql_num_rows($result) > 0) {
                // output data of each row
                $i=1;
                
                while($row = mysql_fetch_assoc($result)) {
				
					$match_name_query=mysql_query("SELECT * FROM matchlist WHERE id='".$row['match_id']."'");
					$match_name_row=mysql_fetch_assoc($match_name_query);
					$match_name=$match_name_row['match_name'];
					
					$team_name_query=mysql_query("SELECT * FROM team WHERE id='".$row['team_id']."'");
					$team_name_row=mysql_fetch_assoc($team_name_query);
					$team_name=$team_name_row['team_name'];
					
					$batsman_name_query=mysql_query("SELECT * FROM player WHERE id='".$row['batsman_id']."'");
					$batsman_name_row=mysql_fetch_assoc($batsman_name_query);
					$batsman_name=$batsman_name_row['player_name'];
					
					
					$wicket_by_name=mysql_fetch_assoc(mysql_query("SELECT * FROM player WHERE id='".$row["wicket_by"]."'"))['player_name'];
                    echo '<tr>';
                   // echo '<td>'.$i.'</td>';
                    echo '<td>'.$row["id"].'</td>';
                    echo '<td>'.$row["match_id"].'</td>';
                    echo '<td>'.$match_name.'</td>';
					echo '<td>'.$row["team_id"].'</td>';
                    echo '<td>'.$team_name.'</td>';
					echo '<td>'.$row["batsman_id"].'</td>';
					echo '<td>'.$batsman_name.'</td>';
					
					echo '<td>'.$row["if_batted"].'</td>';
					
					echo '<td>'.$row["runs"].'</td>';
					echo '<td>'.$row["balls_faced"].'</td>';
					echo '<td>'.$row["if_out"].'</td>';
					echo '<td>'.$row["wicket_by"].$wicket_by_name.'</td>';
					echo '<td>'.$row["wicket_type"].'</td>';
			

                    echo '<form method="post" action="view_battingScore_table.php">';
                    echo '<input type="hidden" name="battingscore_id" value="'.$row['id'].'"/>';
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