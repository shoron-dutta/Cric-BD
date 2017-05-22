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
    	if ($_POST['delete'] && $_POST['vid']) {
            $vid = $_POST['vid'];
            $sql = mysql_query("SELECT *
                    FROM videos 
                    WHERE id = '$vid' ");
            if(mysql_num_rows($sql) >= 1){

                $query = mysql_query("DELETE FROM videos WHERE id=".$vid." LIMIT 1");

                if($query){
                    echo 'video deleted successfully.';
                }else
                {
                    echo 'video deletion failed.';
                }


            }
      	}
    }	
    
}

?>
<a href="data_entry_videos_table.php"><button>Add new videos</button></a>
<table border="1">
<thead>
	<tr>

	<th>video name</th>
	<th>video link</th>

	<th></th>

	
	
	</tr>
</thead>
<tbody>
	<?php
            $sql = "SELECT *
                    FROM videos";

            $result = mysql_query($sql);

            //if (mysql_num_rows($result) > 0) {
                // output data of each row
                $i=1;
                
                while($row = mysql_fetch_assoc($result)) {
                    
                    echo '<tr>';
                    
					echo '<td>'.$row["video_name"].'</td>';
					echo '<td>'.$row["video_link"].'</td>';

                    echo '<form method="post" action="view_videos_table.php">';
                    echo '<input type="hidden" name="vid" value="'.$row['id'].'"/>';
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