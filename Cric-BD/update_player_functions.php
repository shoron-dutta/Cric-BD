<?php
	/*
	these functions are in this file
	
	update_bowling_strikeRate_avg_economy($player_id)
	update_batting_strikeRate_avg($player_id)
	update_total_wickets_total_balls_total_runs_given($wickets_taken,$total_balls,$runs_given,$player_id)
	get_match_id($match_name)
	get_team_id($team_name)
	get_player_id($player_name)
	update_matches_played($batsman_id)
	update_innings_played($batsman_id)
	update_total_runs($batsman_id,$runs)
	update_not_outs($batsman_id)
	update_sr_sum($batsman_id,$sr)
	update_century_fifty_zero($batsman_id,$runs)
	update_best_batting($batsman_id,$runs)
	function update_best_bowling($bowler_id,$wickets_taken,$runs_given)
	
	*/
	function update_batting_strikeRate_avg($player_id){
	
		$batsman_row=mysql_fetch_assoc(mysql_query("SELECT * FROM player WHERE id='".$player_id."'"));
		
		if($batsman_row['innings_played']!=0){
		
			$batting_sr=round(($batsman_row['sr_sum']/$batsman_row['innings_played']),3);
			$update_query=mysql_query("UPDATE player SET batting_strike_rate='".$batting_sr."' 
				WHERE id='".$player_id."'");
		}
		
		$outNo=$batsman_row['innings_played']-$batsman_row['not_outs'];
		if($outNo!=0){
		
			$batting_avg=round(($batsman_row['total_runs']/$outNo),3);
			$update_query=mysql_query("UPDATE player SET batting_avg='".$batting_avg."' 
				WHERE id='".$player_id."'");
		}
		
	}
	
	function update_bowling_strikeRate_avg_economy($player_id){
		$bowler_row=mysql_fetch_assoc(mysql_query("SELECT * FROM player WHERE id='".$player_id."'"));
		
		if($bowler_row['total_wickets']!=0){
			$avg=round(($bowler_row['total_runs_given']/$bowler_row['total_wickets']),3);
			$sr=round(($bowler_row['total_balls']/$bowler_row['total_wickets']),3);
			
			$update_query=mysql_query("UPDATE player SET bowling_avg='".$avg."' ,
				bowling_strike_rate='".$sr."' WHERE id='".$player_id."'");
		}
		
		if($bowler_row['total_balls']!=0){
			$eco=round(($bowler_row['total_runs_given']/$bowler_row['total_balls']),3);
			
			$update_query=mysql_query("UPDATE player SET bowling_economy='".$eco."' 
				WHERE id='".$player_id."'");
		
		}
	}
	
	
	function update_total_wickets_total_balls_total_runs_given($wickets_taken,$total_balls,$runs_given,$player_id){
		$update_query=mysql_query("UPDATE player SET total_wickets=total_wickets+'".$wickets_taken."',
			total_balls=total_balls+'".$total_balls."' ,total_runs_given=total_runs_given+'".$runs_given."' 
			WHERE id='".$player_id."'");
	}
	function get_match_id($match_name){
		$match_id_query=mysql_query("SELECT * FROM matchlist 
			WHERE match_name='".$match_name."'");
		$match_id_row=mysql_fetch_assoc($match_id_query);
		$match_id=$match_id_row['id'];
		
		return $match_id;
	}

	function get_team_id($team_name){
		$team_id_query=mysql_query("SELECT * FROM team 
			WHERE team_name='".$team_name."'");
		$team_id_row=mysql_fetch_assoc($team_id_query);
		$team_id=$team_id_row['id'];
		return $team_id;
	}
	function get_player_id($player_name){		
		$player_id_query=mysql_query("SELECT * FROM player 
			WHERE player_name='".$player_name."'");
		$player_id_row=mysql_fetch_assoc($player_id_query);
		$player_id=$player_id_row['id'];
		return $player_id;
	}
	function update_matches_played($player_id){
	
		$matches_played_query=mysql_query("UPDATE player
		SET matches_played=matches_played+1
		WHERE id='".$player_id."'");
	}
	function update_innings_played($player_id){
	
		$innings_played_query=mysql_query("UPDATE player
		SET innings_played=innings_played+1
		WHERE id='".$player_id."'");
	}
	function update_total_runs($player_id,$runs){
	
		$total_runs_query=mysql_query("UPDATE player
		SET total_runs=total_runs+'".$runs."'
		WHERE id='".$player_id."'");
	}	
	function update_sr_sum($player_id,$sr){
		$sr2=round($sr,3);
		$sr_sums_query=mysql_query("UPDATE player
		SET sr_sum=sr_sum+'".$sr2."'
		WHERE id='".$player_id."'");
	}
	
	function update_best_batting($player_id,$runs){
		$player_query=mysql_query("SELECT * FROM player 
			WHERE id='".$player_id."'");
		$player_row=mysql_fetch_assoc($player_query);
		
		if($runs>$player_row['best_batting']){
			$best_batting_query=mysql_query("UPDATE player 
					SET best_batting='".$runs."' 
					WHERE id='".$player_id."'");
		}
	}
	function update_century_fifty_zero($player_id,$runs){
		$player_query=mysql_query("SELECT * FROM player 
			WHERE id='".$player_id."'");
		$player_row=mysql_fetch_assoc($player_query);
		
		
		if($runs>=100){
			
			$century_query=mysql_query("UPDATE player 
				SET hundreds=hundreds+1 
				WHERE id='".$player_id."'");
					
		}
		elseif($runs>=50){
					
			$fifties_played_query=mysql_query("UPDATE player SET fifties=fifties+1 
				WHERE id='".$player_id."'");
			
		}
		elseif($runs== 0){
				
			$zeroes_query=mysql_query("UPDATE player 
				SET zeroes=zeroes+1 
				WHERE id='".$player_id."'");
		}
		
	}
	function update_not_outs($player_id){
		$not_outs_query=mysql_query("UPDATE player SET not_outs=not_outs+1 
				WHERE id='".$player_id."'");
	}
	
	function update_best_bowling($bowler_id,$wickets_taken,$runs_given){
		
		$current_bowling=$wickets_taken."/".$runs_given;
		
		$best_bowling=mysql_fetch_assoc(mysql_query("SELECT * FROM player
			WHERE id='".$bowler_id."'"))['best_bowling'];
		$sql="UPDATE player SET best_bowling='".$current_bowling."' WHERE id='".$bowler_id."'";
		
		if($best_bowling==null){
			$best_bowling_update=mysql_query($sql);
			
			if($best_bowling_update){
				echo "1 update of null best bowling successful<br>";
			}
			else{
				echo "1 update of null best bowling failed";
			}
		}
	
		else{
			$position_of_slash=strpos($best_bowling, "/");
			$len=strlen($best_bowling);
			
			$best_wickets_str=substr($best_bowling,$position_of_slash+1,$len-1);
			echo "best_wickets_str : ".$best_wickets_str."<br>";
			$wickets_in_best_bowling=(int)($best_wickets_str);//wickets taken in his best bowling
			
			$best_runs_given_str=substr($best_bowling,0,$position_of_slash);
			echo "best_runs_str : ".$best_runs_given_str."<br>";//runs given in his best bowling
			$runs_in_best_bowling=(int)($best_runs_given_str);
			
			if($wickets_taken>$wickets_in_best_bowling){//ei match e beshi wicket nise, than his best ever
				
				$best_bowling_update_query=mysql_query($sql);
				if($best_bowling_update_query){
					echo "2 update of best bowling successful";
				}
				else{
					echo "2 update of best bowling failed";
				}
			}
			elseif($wickets_taken==$wickets_in_best_bowling){
				
				if($runs_given<$runs_in_best_bowling){//wicket same nise, bt run kom dise , tai update hobe
					$best_bowling_update=mysql_query($sql);
			
					if($best_bowling_update){
						echo "3 update of null best bowling successful<br>";
					}
					else{
						echo "3 update of null best bowling failed";
					}
				}
			}
	
		
		}
	}
	
?>