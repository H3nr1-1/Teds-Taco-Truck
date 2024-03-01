<?php
session_start();
if($_SESSION["customer-login"] != "true"){
    header('Location: login.php');
}
?>

<?php

    if($_SERVER["REQUEST_METHOD"]=="GET") {
        $customer_order_id = $_GET["customer_order_id"];
    }

    require_once("connect-db.php");        
        
        $sql = "DELETE FROM customer_order WHERE customer_order_id = :customer_order_id";         
        $statement = $db->prepare($sql);
        $statement->bindValue(":customer_order_id", $customer_order_id);
    

    
    if($statement->execute()){
        $statement->closeCursor();     
        header('Location: cart.php');

    }
?>
 
