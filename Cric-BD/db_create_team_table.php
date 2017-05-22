<?php


include "db_connection.php";
try {

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE team (
        id INT(25) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY, 
        team_name VARCHAR(100) NOT NULL UNIQUE
    )";

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table team created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;

?>
