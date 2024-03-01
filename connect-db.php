<?php 
$servername = "mysql:host=localhost;dbname=ted-taco";
$username = "root";
$password = "root";

try {
    $db = new PDO($servername, $username, $password);
//    echo "connected successfully";
    }

catch(PDQException $e)
    {
//    echo "Connection Failed: " . $e->getMessage();
    }

?>