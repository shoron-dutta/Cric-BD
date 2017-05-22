<?php include "db_connection.php"; 
include "data_entry.php";?>

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
if(!empty($_POST['tn']))
{
    $team_name = mysql_real_escape_string($_POST['tn']);

        //return var_dump($_POST);
        $registerquery = mysql_query("INSERT INTO team (team_name) VALUES('".$team_name."')");
		if (!$registerquery) {
			die('Invalid query: ' . mysql_error());
		}
        else if($registerquery)
        {
            echo 'team was successfully added.';
        }
        else
        {
            echo 'Sorry, team addition failed.';   
        }       
     }
 
}/*
elseif(empty($_POST['tn'])){
    echo 'Registration failed, please fill all the fields.'; 
}*/
?>

<a href="view_team_table.php"><h3>view table team</h3></a>

<form method="post" action="data_entry_team_table.php">
	<input type="text" name="tn" placeholder="team name" required>
	<input type="submit" name="register" value="Register"/>
</form>

</body>
<footer>

	<script type="text/javascript">

	</script>
</footer>
</html>