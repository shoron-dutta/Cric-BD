<?php
session_start();


include_once 'db_connection.php';
//include "send_notification.php";
//$_SESSION['loggedin']=false;
//if(isset($_SESSION['user'])!="")
if(!empty($_SESSION['user']))
{

 header("Location: Home.php");
 exit();
 
}

if(isset($_POST['btn-login']))
{
	 $email = mysql_real_escape_string($_POST['email']);
	 $upass = mysql_real_escape_string($_POST['pass']);
	 $res=mysql_query("SELECT * FROM users WHERE email='$email'");
	
	$row=mysql_fetch_array($res);
	if(mysql_num_rows($res)==0){
		?>
			<script>alert('You are not registered! , Please register ...');</script>
		<?php
	}
	else{
		
		 if($row['password']==md5($upass) && empty($_SESSION['loggedin']))
		 {
		  $_SESSION['user'] = $row['id'];
		  $_SESSION['loggedin']= 1;
		  header("Location: Home.php");
		  
		}
		else
		 {
		  ?>
				<script>alert('wrong details');</script>
				<?php
		 }
	
	}
}

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign in</title>
<link rel="stylesheet" href="fasion.css" type="text/css" />
</head>
<body>
<center>
<div id="login-form">
<form method="post" action= "sign_in_new.php">

<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="email" placeholder="Your Email" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-login">Sign In</button></td>
</tr>
<tr>
<td><a href="sign_up_new.php">Sign Up Here</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>