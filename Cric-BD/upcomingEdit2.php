<?php 
include "db_connection.php"; 
session_start();
GLOBAL $is_logged_in2;
//echo $is_logged_in;

if(!empty($_SESSION['loggedin']))
{
if(!empty($_POST)){
    if(isset($_POST['add_to_watchlist'])){
    	if ($_POST['mid'] ) {
		
				$sql2 = "select id from users where id=".$_SESSION['user']."";
			$result2 = mysql_query($sql2);
			$row2 = mysql_fetch_assoc($result2);
            $uid = $row2['id'];
            $mid= $_POST['mid'];
            $sql = mysql_query("insert into watchlist(user_id,match_id) values('".$uid."','".$mid."')");
                if($sql){
                    echo 'match added to ur watchlist successfully.';
                }else
                {
                    echo 'match addition failed.';
                }


            }
      	}
    }	
    
}
		
			else {echo '<a href="sign_in_new.php">Log In</a>';}
?>