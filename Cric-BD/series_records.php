<?php include "db_connection.php"; 
include "sidebar.php";

?>

<!DOCTYPE html>
<html>
<head>
	<title>match summary</title>

	<style type="text/css">


	</style>

	<link href="watchlist.css" rel="stylesheet" />

</head>
<body align="right">
<div id = "wrapper" >
<table border="1">
<thead>
	<tr>
	<th>tournament name</th>
	<th>match</th>
	<th>date</th>
	<th>match result</th>

	<th></th>
	
	
	</tr>
</thead>
<tbody>
	<?php
	//$date_of_today=date("Y-m-d");						
	$date_of_today=date("Y-m-d", strtotime("-1 days")) ;
					
            $sql = "SELECT *
                    FROM matchlist WHERE date_of_match<='".$date_of_today."'";

            $res = mysql_query($sql);

            //if (mysql_num_rows($result) > 0) {
                // output data of each row
                $i=1;
                
                while($row = mysql_fetch_assoc($res)) {
				
				
					
					$t1_query=mysql_query("SELECT team_name FROM team WHERE id=".$row['team1_id']."");
					$t2_query=mysql_query("SELECT team_name FROM team WHERE id=".$row['team2_id']."");
					$t1_row = mysql_fetch_assoc($t1_query);
					$t1=$t1_row['team_name'];
					$t2_row = mysql_fetch_assoc($t2_query);
					$t2=$t2_row['team_name'];
					
                    echo '<tr>';
					
                    echo '<td>'.$row["tournament_name"].'</td>';
					echo '<td>'.$row["match_name"].'</td>';
					echo '<td>'.$row["date_of_match"].'</td>';
					echo '<td>'.$row["result"].'</td>';


                    echo '<form method="post" action="scorecard_edit_edit.php">';
                    echo '<input type="hidden" name="mid" value="'.$row['id'].'"/>';
                    echo '<td>
                          <input type="submit" name="details" value="Details"/>
                          </td>';
                    echo '</form>';


                    $i++;
				}
                
                
            /*} 
			else {
                echo "0 results";
            }*/
        ?>
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