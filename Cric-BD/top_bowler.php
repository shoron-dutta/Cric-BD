<?php include "db_connection.php"; ?>
<?php include "sidebar.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	</style>
	<link href="watchlist.css" rel="stylesheet" />
</head>
<body>

<div id ="wrapper">
<h1>Top bowlers</h1>
<table border="1">
<thead>
	<tr>
	<th>bowler name</th>
	<th>team name</th>
	<th>best</th>
	</tr>
</thead>
<tbody>
<?php
    $sql = "SELECT * FROM player  WHERE best_bowling IS NOT NULL 
	ORDER BY CAST(SUBSTRING_INDEX(best_bowling,'/',1) AS DECIMAL(10,2)) desc,
	CAST(SUBSTRING_INDEX(best_bowling,'/',-1) AS DECIMAL(10,2))";
	 
					//CAST(SUBSTRING_INDEX('best_bowling', '-', 1) AS DECIMAL(10,2))
					//CAST(best_batting AS DECIMAL(10,2))
					//SUBSTRING_INDEX('www.mysql.com', '.', 2)
					//ORDER BY article_rating DESC, article_time DESC

    $result = mysql_query($sql);
	if($result==false){
		echo "error";
	}
	else{
		$i=1;        
        while($row = mysql_fetch_assoc($result)) {
			//name of player
			$name_query=mysql_query("SELECT player_name FROM player WHERE id=".$row['id']."");
			$b_row = mysql_fetch_assoc($name_query);
			$p_name=$b_row['player_name'];
			//name of team
			$team_query=mysql_query("SELECT team_name FROM team WHERE id=".$row['team_id']."");
			$t_row = mysql_fetch_assoc($team_query);
			$t_name=$t_row['team_name'];
				
            echo '<tr>';
            echo '<td>'.$p_name.'</td>';
			echo '<td>'.$t_name.'</td>';
			echo '<td>'.$row["best_bowling"].'</td>';
			echo '</tr>';
			if($i==10){
				break;
			}
			$i++;
		}
	}
?>
</tbody>
</table>
</div>
</body>
<footer>
	<script src="assets/js/jquery-1.10.2.js"></script>
	<script type="text/javascript">
	</script>
</footer>
</html>