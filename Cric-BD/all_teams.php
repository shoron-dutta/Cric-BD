<?php include "db_connection.php"; 
include "sidebar.php";

?>

<!DOCTYPE html>
<html>
<head>
	<title>all teams</title>
	<style type="text/css">
	</style>
	<link href="all_teams.css" rel="stylesheet" />

</head>

<body>

<table border="1">
<thead>
	<tr>
		<th>team name</th>	
	</tr>
</thead>
<tbody>
	<?php
        $sql = "SELECT * FROM team";
		$res = mysql_query($sql);
		while($row = mysql_fetch_assoc($res)) {
			echo '<tr>';
            echo '<td>'.$row["team_name"].'</td>';
			echo '</tr>';
		}
                
?>
</tbody>
	
</table>

</body>
<footer>
	<script src="assets/js/jquery-1.10.2.js"></script>
	<script type="text/javascript">

	</script>
</footer>
</html>