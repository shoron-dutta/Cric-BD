<?php 
include "db_connection.php";
include 'sidebar.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>    Cric - BD Homepage    </title>
    <link href="homepage.css" rel="stylesheet">

	<style>

</style>

</head>

<body>

    <div id="wrapper">
		
<center>
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
					<?php 
					
                        echo "<h1 align='center' > Cric - BD </h1>";
						echo "<img src='cric.jpg'/>";
						
						?>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->
</center>>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

</body>

</html>