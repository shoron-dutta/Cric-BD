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
        if ($_POST['update'] && $_POST['bowlingscore_id']) {
        if ($_POST['update'] == 'Update') {
            $bowlingscore_id = $_POST['bowlingscore_id'];
            $sql = mysql_query("SELECT *
                    FROM bowlingscore 
                    WHERE id = '$bowlingscore_id' ");
            //return var_dump($sql);
            if(mysql_num_rows($sql) == 1){

                $bowlingscoreInfo = mysql_fetch_array($sql);
                ?>

                <a href="view_bowlingScore_table.php"><h3>view table bowlingscore</h3></a>

<form method="post" action="edit_bowlingScore_table.php">

	<input type="number" name="wickets_taken" placeholder="wickets_taken" value="<?php echo $bowlingscoreInfo['wickets_taken'];?>">
	<input type="number" name="runs_given" placeholder="runs given" value="<?php echo $bowlingscoreInfo['runs_given'];?>">
	<input type="number" name="overs_bowled" step="0.1" placeholder="overs bowled" value="<?php echo $bowlingscoreInfo['overs_bowled'];?>">
	
    <input type="hidden" name="bowlingscore_id" value="<?php echo $bowlingscoreInfo['id']?>"/>
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
	$bowlingscore_id=$_POST['bowlingscore_id'];;

	$wickets_taken = $_POST['wickets_taken'];
	$runs_given = $_POST['runs_given'];
	$overs_bowled = $_POST['overs_bowled'];
	$overs_bowled2=round($overs_bowled,1);
    //echo $_POST['overs_bowled']. 'and'. $overs_bowled." and ". $overs_bowled2;
	 
    $check = mysql_query("SELECT * FROM bowlingscore WHERE id = '".$bowlingscore_id."'");
      
    if(mysql_num_rows($check) == 1)
     {
        //return var_dump($_POST);
        $sql = "UPDATE bowlingscore SET wickets_taken='$wickets_taken',runs_given='$runs_given',
		overs_bowled='$overs_bowled2' WHERE `id`='$bowlingscore_id'";

        $registerquery = mysql_query($sql) or die(mysql_error());
    
        if($registerquery)
        {
            header("Location: view_bowlingScore_table.php");
            exit();
        }
        else
        {
            header("Location: view_bowlingScore_table.php");
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