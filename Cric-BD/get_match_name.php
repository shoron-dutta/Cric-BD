<?php
include "db_connection.php";
function get_match_name($match_id){

	$team_id_sql=mysql_query("SELECT * FROM matchlist where id='".$match_id."'");
	$team_id_row=mysql_fetch_assoc($team_id_sql);
	$team1_id=$team_id_row['team1_id'];
	$team2_id=$team_id_row['team2_id'];
	 
	 //get the names
	$team1_name_sql=mysql_query("SELECT * FROM team where id='".$team1_id."'");
	$team2_name_sql=mysql_query("SELECT * FROM team where id='".$team2_id."'");
	$team1_row=mysql_fetch_assoc($team1_name_sql);
	$team2_row=mysql_fetch_assoc($team2_name_sql);
	$team1_name=$team1_row['team_name'];
	$team2_name=$team2_row['team_name'];
	 
	$match_name=$team1_name." vs ".$team2_name;
	 
	//echo $match_name;
	return $match_name;

}
function get_match_name_from_teams($team1_id,$team2_id){
 
	 //get the names
	$team1_name_sql=mysql_query("SELECT * FROM team where id='".$team1_id."'");
	$team2_name_sql=mysql_query("SELECT * FROM team where id='".$team2_id."'");
	$team1_row=mysql_fetch_assoc($team1_name_sql);
	$team2_row=mysql_fetch_assoc($team2_name_sql);
	$team1_name=$team1_row['team_name'];
	$team2_name=$team2_row['team_name'];
	 
	$match_name=$team1_name." vs ".$team2_name;
	 
	//echo $match_name;
	return $match_name;

}
?>