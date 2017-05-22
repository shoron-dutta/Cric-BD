<?php include "db_connection.php";
include "data_entry.php"; ?>

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
if(!empty($_POST['video_name']) && !empty($_POST['video_link']) ){


	    $video_name = mysql_real_escape_string($_POST['video_name']);
		$video_link = mysql_real_escape_string($_POST['video_link']);

        $registerquery = mysql_query("INSERT INTO videos (video_name,video_link) VALUES('".$video_name."','".$video_link."')");
		if (!$registerquery) {
			die('Invalid query: ' . mysql_error());
		}
        else if($registerquery)
        {
            echo 'video '.$video_name.' was successfully added.';
        }
        else
        {
            echo 'Sorry, videos addition failed.';   
        }
	 
	 
}
}?>

<a href="view_videos_table.php"><h3>view table videos</h3></a>

<form method="post" action="data_entry_videos_table.php">
	<input type="text" name="video_name" placeholder="video name" required>
	<input type="text" name="video_link" placeholder="video link" required>
	<input type="submit" name="register" value="Register"/>
</form>

</body>
<footer>

	<script type="text/javascript">

	</script>
</footer>
</html>