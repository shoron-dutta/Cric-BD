<?php
session_start();

if(!isset($_SESSION['user']))
{
 header("Location: homepage.php");
}
else if(isset($_SESSION['user'])!="")
{
 header("Location: homepage.php");
}

if(isset($_GET['logout']))
{
//$_SESSION['loggedin']=false;
	$_SESSION=array();
	session_unset(); 
	session_destroy();
	//echo"u r logged out";
	$is_logged_in = false;
	header("Location: homepage.php");
	exit();
}
?>