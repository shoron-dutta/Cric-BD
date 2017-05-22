<?php 
include "db_connection.php"; 
include 'upcoming_matches.php';
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
			
			$check_query=mysql_query("SELECT * FROM watchlist WHERE user_id='".$uid."' AND match_id='".$mid."'");
			if(mysql_num_rows($check_query)==0){
            $sql = mysql_query("insert into watchlist(user_id,match_id) values('".$uid."','".$mid."')");
                if($sql){
				?>
				  <script>alert('match added successfully!');</script>
                    <?php
					 //header("Location: upcoming_matches.php");
                }else
                {
				?>
				<script>alert('match addition failed.');</script>
				  <?php  
					 //header("Location: upcoming_matches.php");
                    
                }
				}
				else{
				?>
				<script>alert('This match is already in your watchlist !! same match ar koybar watch korben -_- ??!!.');</script>
				  <?php 
				}
				


            }
      	}
    }	
    
}
		
			else {
				//echo '<a href="sign_in_new.php">Log In</a>';
				 //header("Location: checking_login.php"); ?>
				 <script>alert('You are not logged in! , Please Log in ...');</script>
				 <?php
				}
?>