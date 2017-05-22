<?php include "db_connection.php";
include "sidebar.php"; ?>
<!DOCTYPE html>
<html>
<head>
<link href="ranking.css" rel="stylesheet" />
<link href="data-tables/DT_bootstrap.css" rel="stylesheet" />

</head>
<body>
<div id="wrapper">
<table id="example" class="display">
<thead>

	<tr>
	
	<?php
	echo '<th>player name</th>';
	echo '<th>matches played</th>';
	echo '<th>innings played</th>';
	echo '<th>total runs</th>';
	echo '<th>best</th>';
	echo '<th>strike rate</th>';
	echo '<th>average</th>';
	echo '<th>hundreds</th>';
	echo '<th>fifties</th>';
	echo '<th>zeroes</th>';
	
	?>
	</tr>
</thead>
<tbody>

<?php
		$sql2 = "SELECT * FROM player";
		$result2 = mysql_query($sql2);
		while($row = mysql_fetch_assoc($result2)) {	
                    
            echo '<tr>';
			echo '<td>'.$row["player_name"].'</td>';
			echo '<td>'.$row["matches_played"].'</td>';
			echo '<td>'.$row["innings_played"].'</td>';
			echo '<td>'.$row["total_runs"].'</td>';
			echo '<td>'.$row["best_batting"].'</td>';
			echo '<td>'.$row["batting_strike_rate"].'</td>';
			echo '<td>'.$row["batting_avg"].'</td>';
			
            
			echo '<td>'.$row["hundreds"].'</td>';
			echo '<td>'.$row["fifties"].'</td>';
			echo '<td>'.$row["zeroes"].'</td>';
				
			echo '</tr>';

        }
 ?>

</tbody>
	
</table>

<script src="data-tables/jquery-1.12.0.min.js"/></script>
<script src="data-tables/jquery.dataTables.js"/></script>
<script src="data-tables/DT_bootstrap.js"/></script>

<script type="text/javascript">	
	$(document).ready(function(){
		$('#example').dataTable({
			"bPaginate":false
		});
	});	
</script>
</div>
</body>
</html>