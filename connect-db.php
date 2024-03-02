<?php 
$servername = "mysql:host=localhost;dbname=teds-taco";
$username = "root";
$password = "root";

try {
    $db = new PDO($servername, $username, $password);
//    echo "connected successfully";
    }

catch(PDOException $e)
    {
//    echo "Connection Failed: " . $e->getMessage();
    }

?>