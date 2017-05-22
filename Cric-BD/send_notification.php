
<?php include "db_connection.php"; ?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<link href="homepage.css" rel="stylesheet">

		<style></style>

	</head>

	<body>
		<div id="wrapper">
		<?php
		$sql="SELECT * FROM watchlist";
		$result=mysql_query($sql);
		if($result==false){
			echo "error";
		}
		else{

			while($row = mysql_fetch_assoc($result)){
				$user_id=$row['user_id'];
				$match_id=$row['match_id'];
				$sql2="SELECT * FROM matchlist WHERE id=".$match_id."";
				$result2=mysql_query($sql2);
					
				if($result2==false){
					echo "error in result 2<br>";
				}else{
				
					$row2=mysql_fetch_assoc($result2);
					$date_of_match=$row2['date_of_match'];
					$team1_id=$row2['team1_id'];
					$team2_id=$row2['team2_id'];
					
					$t1_query=mysql_query("SELECT team_name FROM team WHERE id=".$team1_id."");
					$t1_row = mysql_fetch_assoc($t1_query);
					$team1_name=$t1_row['team_name'];
					
						
					$t2_query=mysql_query("SELECT team_name FROM team WHERE id=".$team2_id."");
					$t2_row = mysql_fetch_assoc($t2_query);
					$team2_name=$t2_row['team_name'];
					
					//echo $date_of_match;
					$date_of_today=date("Y-m-d");						
					//$date_of_today=date("Y-m-d", strtotime("+1 days")) ;
					//echo $date_of_today;
					if($date_of_match==$date_of_today){
						$message='Hey today is '.$date_of_today.' .You wanted to see the '.$team1_name.' vs '.$team2_name.' match today , do not miss it !!<br>';
						//echo $message;
						/*mail sending
							$msg= "paisos?";
							$headers = "From: rudraneel00@gmail.com@gmail.com"."\r\n";
							//send the email
							$to = "shoron.dutta321@gmail.com";
							$subject = "My subject";
							$txt = "Hello world!";
							mail($to,$subject,$msg,$headers);
							//$mail_sent = mail($to, $subject,$msg,$headers);
							if(mail("shoron.dutta321@gmail.com","my sub","kita khbr")==false){
							
							echo 100000000000099999999999999999999999;}
						*/	
						$check_query=mysql_query("SELECT * FROM notification WHERE user_id='".$user_id."' AND message='".$message."'");
						if(mysql_num_rows($check_query)==0){
							$insert_query=mysql_query("INSERT INTO notification (user_id,message,match_id) 
							VALUES ('".$user_id."', '".$message."','".$match_id."')");
							if($insert_query==false){
								echo "ERROR in insertion query";
							}
								
						}
					}
						
					
			}	}
		}
		
	?>
		</div>
	</body>
</html>