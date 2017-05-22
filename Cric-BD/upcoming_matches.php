<?php include "db_connection.php"; ?>
<?php 
//session_start();

include "sidebar.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Upcoming Matches</title>

	<style type="text/css">

	</style>

	<link href="watchlist.css" rel="stylesheet" />

</head>
<body>

<div id ="wrapper">

<table border="1">
<thead>
	<tr>
	<th>match</th>

	<th>tournament name</th>
	<th>date</th>

	<th></th>
	
	
	</tr>
</thead>
<tbody>
	<?php
			$date_of_today=date("Y-m-d");
			//$date_of_today=date("Y-m-d", strtotime("-1 days")) ;
            $sql = "SELECT id,team1_id,team2_id,tournament_name,date_of_match
                    FROM matchlist WHERE date_of_match>='".$date_of_today."' order by date_of_match";
			//$sql2 = "select id from users where id=".$_SESSION['user']."";
			//$result2 = mysql_query($sql2);
            $result = mysql_query($sql);
			if($result==false){
				echo "error !!<br>";
			}
			else{
            //if (mysql_num_rows($result) > 0) {
                // output data of each row
                $i=1;
                
                while($row = mysql_fetch_assoc($result)) {
				
                    $t1_query=mysql_query("SELECT team_name FROM team WHERE id=".$row['team1_id']."");
					$t1_row = mysql_fetch_assoc($t1_query);
					$t1=$t1_row['team_name'];
					
					
					$t2_query=mysql_query("SELECT team_name FROM team WHERE id=".$row['team2_id']."");
					$t2_row = mysql_fetch_assoc($t2_query);
					$t2=$t2_row['team_name'];
                    
					echo '<tr>';
					echo '<td>'.$t1. ' vs ' .$t2.'</td>';
                    echo '<td>'.$row["tournament_name"].'</td>';
					echo '<td>'.$row["date_of_match"].'</td>';
					
					//$row2 = mysql_fetch_assoc($result2);
					
					echo '<form method="post" action="add_to_watchlist.php">';
                    echo '<input type="hidden" name="mid" value="'.$row['id'].'"/>';
                    //echo '<input type="hidden" name="uid" value="'.$row2['id'].'"/>';
                    
                    echo '<td>
                          <input type="submit" name="add_to_watchlist" value="Add to my watchlist"/>
                          </td>';
                    echo '</form>';
                
                    echo '</tr>';

                    $i++;

                }
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