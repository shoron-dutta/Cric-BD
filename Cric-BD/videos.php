
<?php include "db_connection.php"; ?>
<?php include "sidebar.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">


	</style>

	<link href="watchlist.css" rel="stylesheet" />

</head>
<body>
<div id="wrapper">
<?php 
if(!empty($_POST)){
    if(isset($_POST['watch'])){
    	if ($_POST['watch'] && $_POST['video_link']) {
            $video_link = $_POST['video_link'];
      	}
    }	
    
}

?>
<table>
	<thead>
		<th>events</th>
		<th>watch it now !!</th>
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
                   // echo '<td>'.$i.'</td>';
                    echo '<td>'.$row["video_name"].'</td>';

                    echo '<form method="post" action="videos.php">';
                    echo '<input type="hidden" name="video_link" value="'.$row['video_link'].'"/>';
                    echo '<td>
                          <input type="submit" name="watch" value="watch now !!"/>
                          </td>';
                    echo '</form>';
                    echo '</tr>';

                    $i++;

                }
                
        ?>
	
	
	
	</tbody>
</table>
<center>
	<iframe width="700" height="500" src="<?php echo $video_link ?>  " allowfullscreen></iframe>
</center>

		</div>
</body>
<footer>
	<script src="assets/js/jquery-1.10.2.js"></script>
	<script type="text/javascript">

	</script>
</footer>
</html>