<?php include "db_connection.php";
include "data_entry.php";
	include "get_match_name.php";
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
    	if ($_POST['delete'] && $_POST['mid']) {
            $mid = $_POST['mid'];
            $sql = mysql_query("SELECT *
                    FROM matchlist 
                    WHERE id = '$mid' ");
            if(mysql_num_rows($sql) >= 1){

                $query = mysql_query("DELETE FROM matchlist WHERE id=".$mid." LIMIT 1");

                if($query){
                    echo 'match deleted successfully.';
                }else
                {
                    echo 'match deletion failed.';
                }


            }
      	}
    }	
    
}

?>
<a href="data_entry_matchlist_table.php"><button>Add new matchlist</button></a>
<table border="1">
<thead>
	<tr>
	<th>i</th>
	<th>match id</th>
	<th>team 1 id</th>
	<th>team 2 id</th>
	<th>match name</th>
	<th>tournament name</th>
	<th>date</th>
	<th>venue</th>
	<th>toss</th>
	<th>team 1 score</th>
	<th>team 2 score</th>
	<th>team 1 extra</th>
	<th>team 2 extra</th>
	<th>Result</th>
	<th>Player of the match</th>
	<th></th>
	<th></th>
	
	
	</tr>
</thead>
<tbody>
	<?php
            $sql = "SELECT *
                    FROM matchlist";

            $result = mysql_query($sql);

            //if (mysql_num_rows($result) > 0) {
                // output data of each row
                $i=1;
                
                while($row = mysql_fetch_assoc($result)) {
					//find out player of the match's name
                    $player_of_the_match_name=mysql_fetch_assoc(mysql_query("SELECT player_name 
					FROM player WHERE id='".$row["id_player_of_the_match"]."'"))['player_name'];
					
                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td>'.$row["id"].'</td>';
                    echo '<td>'.$row["team1_id"].'</td>';
					echo '<td>'.$row["team2_id"].'</td>';
					echo '<td>'.$row['match_name'].'</td>';
					echo '<td>'.$row["tournament_name"].'</td>';
					echo '<td>'.$row["date_of_match"].'</td>';
					echo '<td>'.$row["venue"].'</td>';
					echo '<td>'.$row["toss_result"].'</td>';
					echo '<td>'.$row["team1_score"].'</td>';
					echo '<td>'.$row["team2_score"].'</td>';
					echo '<td>'.$row["team1_extra"].'</td>';
					echo '<td>'.$row["team2_extra"].'</td>';
					echo '<td>'.$row["result"].'</td>';
					echo '<td>'.$player_of_the_match_name.'</td>';

                    echo '<form method="post" action="view_matchlist_table.php">';
                    echo '<input type="hidden" name="mid" value="'.$row['id'].'"/>';
                    echo '<td>
                          <input type="submit" name="delete" value="Delete"/>
                          </td>';
                    echo '</form>';
					echo '<form method="post" action="edit_matchlist_table.php">';
                    echo '<input type="hidden" name="mid" value="'.$row['id'].'"/>';
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