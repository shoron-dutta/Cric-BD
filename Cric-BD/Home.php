<?php

include_once 'db_connection.php';
include 'sidebar.php';
include "send_notification.php";

if(!isset($_SESSION['user']))
{

	header("Location: sign_in_new.php");
}
$res=mysql_query("SELECT * FROM users WHERE id=".$_SESSION['user']."");
$userRow=mysql_fetch_array($res);


if(!empty($_POST)){

    if(isset($_POST['delete'])){
	
    	if ($_POST['delete'] && $_POST['n_id']) {
		
            $n_id = $_POST['n_id'];
            
                $query = mysql_query("DELETE FROM notification WHERE id=".$n_id." LIMIT 1");
				if($query){
				?>
				<script>alert('Your notification deleted successfully.now remove the match from your watchlist as well,otherwise we will keep sending notifications :P');</script>
				<?php
				}
            
      	}
    }	
    
}
?>
<!DOCTYPE html>
<html >
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<title> user profile </title>
<link rel="stylesheet" href="Home.css" type="text/css" />
</head>
<body>
<div id="wrapper">
	<h2>Welcome to your profile <?php echo $userRow['username']; ?> :)</h2>
	<ol>
		<h2>Your messages</h2>						
		<?php 
		$message_query=mysql_query("SELECT * FROM notification WHERE user_id='".$userRow['id']."'");
		
			while($row3 = mysql_fetch_assoc($message_query)){
				echo '<li>'.$row3['message'];
				
				echo '<form method="post" action="Home.php">';
                    echo '<input type="hidden" name="n_id" value="'.$row3['id'].'"/>';
                    echo '<td>
                          <input type="submit" name="delete" value="Delete"/>
                          </td>';
                    echo '</form>';
				echo '</li>';
			}
		
		?>
	</ol>
	</div>
</body>
</html>