<?php include "db_connection.php"; ?>
	
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
    if(isset($_POST['update'])){
        if ($_POST['update'] && $_POST['battingscore_id']) {
        if ($_POST['update'] == 'Update') {
            $battingscore_id = $_POST['battingscore_id'];
            $sql = mysql_query("SELECT *
                    FROM battingscore 
                    WHERE id = '$battingscore_id' ");
            //return var_dump($sql);
            if(mysql_num_rows($sql) == 1){

                $battingscoreInfo = mysql_fetch_array($sql);
                ?>

                <a href="view_battingScore_table.php"><h3>view table battingscore</h3></a>

<form method="post" action="edit_battingScore_table.php">
	
	<h4>did the player bat ? : </h4>
		<select id="if batted" name="if_batted"> 

				<option value="yes"><?php echo "yes"; ?></option>
				<option value="no"><?php echo "no"; ?></option>

		  </select>
	<input type="number" name="runs" placeholder="runs" value="<?php echo $battingscoreInfo['runs'];?>">
	<input type="number" name="balls_faced" placeholder="balls faced" value="<?php echo $battingscoreInfo['balls_faced'];?>">
	
	<h4>did the player get out ? : </h4>
		<select id="if out" name="if_out"> 

				<option value="yes"><?php echo "yes"; ?></option>
				<option value="no"><?php echo "no"; ?></option>

		  </select>
	<h4>select wicket taker's name : </h4>
		<select id="wicket by" name="wicket_by"> 
		<?php
			$sql = "SELECT * FROM player";
			$result = mysql_query($sql);
			while($row = mysql_fetch_assoc($result)) { ?>
				<option value="<?php echo $row['player_name'];?>"><?php echo $row['player_name']; ?></option>
				<?php
			}
			?>
		  </select>
	<input type="text" name="wicket_type" placeholder="wicket type" value="<?php echo $battingscoreInfo['wicket_type'];?>">
	
    <input type="hidden" name="battingscore_id" value="<?php echo $battingscoreInfo['id']?>"/>
    <input type="submit" name="submit" value="Update"/>
</form>



                <?php

            }
        }
    }   
  }

}
if(!empty($_POST)){
if(isset($_POST['submit'])){
	$battingscore_id=$_POST['battingscore_id'];;
	$if_batted=$_POST['if_batted'];
	$runs = $_POST['runs'];
	$balls_faced = $_POST['balls_faced'];
	$if_out=$_POST['if_out'];
	
	//find out wicket by id from wicket by name
	$wicket_by = $_POST['wicket_by'];
	$wicket_by_id_query=mysql_query("SELECT id FROM player WHERE player_name='$wicket_by'");
	$wicket_by_id_row=mysql_fetch_assoc($wicket_by_id_query);
	$wicket_by_id=$wicket_by_id_row['id'];
	
	
	$wicket_type = mysql_real_escape_string($_POST['wicket_type']);		

     
    $check = mysql_query("SELECT * FROM battingscore WHERE id = '".$battingscore_id."'");
      
    if(mysql_num_rows($check) == 1)
     {
        //return var_dump($_POST);
        $sql = "UPDATE battingscore SET if_batted='$if_batted',runs='$runs',balls_faced='$balls_faced',
		if_out='$if_out',wicket_by='$wicket_by_id',wicket_type='$wicket_type' WHERE `id`='$battingscore_id'";

        $registerquery = mysql_query($sql) or die(mysql_error());
    
        if($registerquery)
        {
            header("Location: view_battingScore_table.php");
            exit();
        }
        else
        {
            header("Location: view_battingScore_table.php");
            exit();   
        }       
     }
 
}

}
?>
</body>
<footer>

	<script type="text/javascript">

	</script>
</footer>
</html>