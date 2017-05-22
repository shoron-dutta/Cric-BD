<?php include "db_connection.php";
include "sidebar.php";
 ?>
	
<!DOCTYPE html>
<html>
<head>
	<title>watchlist</title>

	<style type="text/css">


	</style>

	<link href="watchlist.css" rel="stylesheet" />

</head>


<?php

	
	if (!empty($_SESSION['loggedin']))
	{
		echo '<body>';
		echo '<div id="wrapper">';
		echo '<table border="1">';
		echo '<thead>';
		echo	'<tr>';

		echo	'<th>match name</th>';
		echo	'<th>match date</th>';
		echo	'<th></th>';
					
					
		echo	'</tr>';
		echo '</thead>';
		echo '<tbody>';


					 
		//echo '<a href="Logout.php?logout">Log out</a>';
		$sql = "select * from watchlist where user_id = ".$_SESSION['user']."";
		$res = mysql_query($sql);
		while($row = mysql_fetch_assoc($res)) {
					$match_name_query="SELECT team1_id,team2_id,date_of_match FROM matchlist WHERE id=".$row['match_id']."";
					$res2=mysql_query($match_name_query);
					if($res2==false){echo "error 2<br>";}else{
					$row2=mysql_fetch_assoc($res2);
					if($row2==false){echo "error!!<br>";}else{
					$t1_query=mysql_query("SELECT team_name FROM team WHERE id=".$row2['team1_id']."");
					$t1_row = mysql_fetch_assoc($t1_query);
					$t1=$t1_row['team_name'];
					
					
					$t2_query=mysql_query("SELECT team_name FROM team WHERE id=".$row2['team2_id']."");
					$t2_row = mysql_fetch_assoc($t2_query);
					$t2=$t2_row['team_name'];
                    
					echo '<tr>';
					echo '<td>'.$t1. ' vs ' .$t2.'</td>';
					echo '<td>'.$row2["date_of_match"].'</td>';
					
					echo '<form method="post" action="watchlist.php">';
                    echo '<input type="hidden" name="mid" value="'.$row['match_id'].'"/>';
                    echo '<td> <input type="submit" name="remove_from_watchlist" value="Remove from my watchlist"/></td>';
                    echo '</form>';
					echo '</tr>';
					}
					}
		}
	 
if(!empty($_POST)){
	
    if(!empty($_POST['remove_from_watchlist'] && $_POST['mid'])){
		
    	if ($_POST['mid'] ) {
		//delete from watchlist, and also from notification table
		$mid= $_POST['mid'];
			$sql2 = "delete from watchlist WHERE match_id =".$mid."";
			$remove_from_notification=mysql_query("delete from notification WHERE match_id =".$mid."");
			$result2 = mysql_query($sql2);
			    if($result2){
				?>
				<script>alert('match removed from watchlist successfully.');</script>
				<?php
                    //echo 'match removed from watchlist successfully.';
					header("Location: watchlist.php");
					exit();
                }else
                {
                    echo 'match removal failed.';
                }


            }
      	}
    }
	 }
	 else{ include 'watchlist_if_not_loggedin.php';
	 
	 ?>
	    
		<script>alert('You are not logged in! ,  Please Log in ...');</script>
		<?php
		//include 'checking_login.php';
		//echo '<a href="sign_in_new.php">please,Log In</a>';
	}
?>
</tbody>
</div>
</body>
</html>