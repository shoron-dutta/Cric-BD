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
	<th>player name</th>
	<?php


	//echo '<th>best bowling</th>';
	echo '<th>total wickets</th>';
	echo '<th>strike rate</th>';
	echo '<th>average</th>';
	echo '<th>economy</th>';
	
	?>
	</tr>
</thead>
<tbody>

<?php
		
		
    $sql2 = "SELECT * FROM player  WHERE best_bowling IS NOT NULL 
	ORDER BY CAST(SUBSTRING_INDEX(best_bowling,'/',1) AS DECIMAL(10,2)) desc,
	CAST(SUBSTRING_INDEX(best_bowling,'/',-1) AS DECIMAL(10,2))";
	 	
		$result2 = mysql_query($sql2);
		while($row = mysql_fetch_assoc($result2)) {	
                    
            echo '<tr>';
			
            echo '<td>'.$row["player_name"].'</td>';
			//echo '<td>'.$row["best_bowling"].'</td>';
			echo '<td>'.$row["total_wickets"].'</td>';
			echo '<td>'.$row["bowling_strike_rate"].'</td>';
			echo '<td>'.$row["bowling_avg"].'</td>';
			echo '<td>'.$row["bowling_economy"].'</td>';
				
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