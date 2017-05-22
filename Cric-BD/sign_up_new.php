<?php
session_start();
if(isset($_SESSION['user'])!="")
{
 header("Location: Home.php");
}
include_once 'db_connection.php';

if(isset($_POST['btn-signup']))
{
 $uname = mysql_real_escape_string($_POST['uname']);
 $email = mysql_real_escape_string($_POST['email']);
 $upass = md5(mysql_real_escape_string($_POST['pass']));
 
 
 //if(mysql_query("INSERT INTO user(email,password) VALUES('$email','$upass')"))
 /*if(filter_var($email, FILTER_VALIDATE_EMAIL)){ 
   // echo $email.'<br>'; 
    var_dump(filter_var($email, FILTER_VALIDATE_EMAIL)); 
}else{ 
    var_dump(filter_var($email, FILTER_VALIDATE_EMAIL));    
} */
 
 if(mysql_query("INSERT INTO users(username,email,password) VALUES('$uname','$email','$upass')"))
 {
  ?>
        <script>alert('successfully registered ');</script>
        <?php
 }
 else
 {
  ?>
        <script>alert('error while registering you...');</script>
        <?php
 }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sign up</title>
<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="uname" placeholder="User Name" required /></td>
</tr>
<tr>
<td><input type="email" name="email" placeholder="Your Email" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-signup">Sign Me Up</button></td>
</tr>
<tr>
<td><a href="sign_in_new.php">Sign In Here</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>