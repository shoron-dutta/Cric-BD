<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test2";

try {
/*
session_start();
$_SESSION['alert_type'] = null;
$_SESSION['alert_body'] = null;
  */
mysql_connect($servername, $username, $password) or die("MySQL Error: " . mysql_error());
$db = mysql_select_db($dbname) or die("MySQL Error: " . mysql_error());
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>