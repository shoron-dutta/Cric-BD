
<?php include 'db_connection.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>
    <link href="homepage.css" rel="stylesheet">

	<style>

</style>

</head>

<body>
<div id="sidebar-wrapper">
            <ul class="sidebar-nav">
               
                <li>
                    <a href="series_records.php">Match Records</a>
                </li>
                <li>
                    <a href="upcoming_matches.php">Upcoming Matches</a>
                </li>
                <li>
                    <a href="watchlist.php">Watchlist</a>
                </li>
				<li>
                    <a href="all_teams.php">Teams</a>
                </li>
				<li>
                    <a href="videos.php">Videos</a>
                </li>
				
				<li>
                    <a href="ranking_batsman.php">Batsman Stat</a>
                </li>
				<li>
                    <a href="ranking_bowler.php">Bowler Stat</a>
                </li>
				<li>
                    <a href="top_bowler.php">Top bowler</a>
                </li>
				<li>
                    <a href="homepage.php">Back to home</a>
                </li>
				
			    <?php 
				
				if(!empty($_SESSION['loggedin'])){
				if($_SESSION['user']!=1){
					echo '<li>';
					echo '<a href="Home.php">My Profile</a>';
					echo '</li>';
					
					echo '<li>';
					echo '<a href="Logout.php?logout">Log out</a>';
					echo '</li>';
					}
				elseif($_SESSION['user']==1){
				
					echo '<li>';
					echo '<a href="Home.php">My Profile</a>';
					echo '</li>';
					
					echo '<li>';
					echo '<a href="Logout.php?logout">Log out</a>';
					echo '</li>';
					
					echo '<li>';
					echo '<a href="data_entry.php">Data Entry</a>';
					echo '</li>';
				
				
				}
				
				}
				else{
					echo '<li>';
					echo  '<a href="sign_up_new.php">Sign Up</a>';
					echo '</li>';
					echo '<li>';
					echo '<a href="sign_in_new.php">Log In</a>';
					echo '</li>';
				}
				
				
				?>
				
				
               
            </ul>
        </div>
		<div id="wrapper">
		</div>
</body>
</html>