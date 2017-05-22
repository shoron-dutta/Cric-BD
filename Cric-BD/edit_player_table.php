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
        if ($_POST['update'] && $_POST['pid']) {
        if ($_POST['update'] == 'Update') {
            $pid = $_POST['pid'];
            $sql = mysql_query("SELECT *
                    FROM player 
                    WHERE id = '$pid' ");
            //return var_dump($sql);
            if(mysql_num_rows($sql) == 1){

                $playerInfo = mysql_fetch_array($sql);
                ?>

                <a href="view_player_table.php"><h3>view</h3></a>

<form method="post" action="edit_player_table.php">
    <input type="text" name="player_name" placeholder="player name" value="<?php echo $playerInfo['player_name'];?>">
    <input type="text" name="category" placeholder="category" value="<?php echo $playerInfo['category']?>">

    <input type="hidden" name="pid" value="<?php echo $playerInfo['id']?>"/>
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
	
    $player_name = mysql_real_escape_string($_POST['player_name']);
    $category = mysql_real_escape_string($_POST['category']);
    $pid = $_POST['pid'];
     
    $check = mysql_query("SELECT * FROM player WHERE id = '".$pid."'");
      
    if(mysql_num_rows($check) == 1)
     {
        //return var_dump($_POST);
        $sql = "UPDATE player
        SET player_name='$player_name',category='$category' WHERE `id`='$pid'";

        $registerquery = mysql_query($sql) or die(mysql_error());
    
        if($registerquery)
        {
            header("Location: view_player_table.php");
            exit();
        }
        else
        {
            header("Location: view_player_table.php");
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