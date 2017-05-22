<?php include "db_connection.php";include "data_entry.php"; ?>
	
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
    	if ($_POST['delete'] && $_POST['tid']) {
            $tid = $_POST['tid'];
            $sql = mysql_query("SELECT *
                    FROM team 
                    WHERE id = '$tid' ");
            if(mysql_num_rows($sql) >= 1){

                $query = mysql_query("DELETE FROM team WHERE id=".$tid." LIMIT 1");

                if($query){
                    echo 'team deleted successfully.';
                }else
                {
                    echo 'team deletion failed.';
                }


            }
      	}
    }	
    
}

?>
<a href="data_entry_team_table.php"><button>Add new team</button></a>
<table border="1">
<thead>
	<tr>
	<th>team id</th>
	<th>team name</th>
	<th></th>
	</tr>
</thead>
<tbody>
	<?php
            $sql = "SELECT *
                    FROM team ORDER BY id";

            $result = mysql_query($sql);

            //if (mysql_num_rows($result) > 0) {
                // output data of each row
                $i=1;
                
                while($row = mysql_fetch_assoc($result)) {
                    
                    echo '<tr>';
                    echo '<td>'.$row["id"].'</td>';
                    echo '<td>'.$row["team_name"].'</td>';


                    echo '<form method="post" action="view_team_table.php">';
                    echo '<input type="hidden" name="tid" value="'.$row['id'].'"/>';
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