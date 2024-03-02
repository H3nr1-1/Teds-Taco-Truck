<?php
session_start();
if($_SESSION["customer-login"] != "true"){
    header('Location: login.php');
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        require_once("connect-db.php");

        $customer_id = $_POST["customer_id"];
        $menu_ids = $_POST["menu_id"]; // Assuming menu_id is an array

        // Insert order details into the customer_order table
        $order_sql = "INSERT INTO customer_order (customer_id) VALUES (:customer_id)";
        $order_statement = $db->prepare($order_sql);
        $order_statement->bindValue(":customer_id", $customer_id);
        $order_statement->execute();

        // Get the last inserted customer_order_id
        $customer_order_id = $db->lastInsertId();

        // Insert menu items into the submit_order table
        $submit_order_sql = "INSERT INTO submit_order (customer_order_id, menu_id) VALUES (:customer_order_id, :menu_id)";
        $submit_order_statement = $db->prepare($submit_order_sql);

        // Loop through each menu_id and insert into submit_order table
        foreach ($menu_ids as $menu_id) {
            $submit_order_statement->bindValue(":customer_order_id", $customer_order_id);
            $submit_order_statement->bindValue(":menu_id", $menu_id);
            $submit_order_statement->execute();
        }

        // Close statement connections
        $order_statement->closeCursor();
        $submit_order_statement->closeCursor();

        $message = "<h4>The order is successful.</h4>";
    } catch (Exception $e) {
        $message = "<h4>Error submitting order: " . $e->getMessage() . "</h4>";
    }
}
?>

<script>
        window.location.replace("thankyou.php");
</script>





<!-- $message = "";
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require_once("connect-db.php");
          $customer_order_id = $_POST["customer_order_id"];
          $customer_id = $_POST["customer_id"];
          $menu_ids = $_POST["menu_ids"];
       
        
          $sql = "INSERT INTO customer_order (customer_order_id, customer_id) VALUES (:customer_order_id, :customer_id)";
        
          $statement = $db->prepare($sql);
          $statement->bindValue(":customer_order_id", $customer_order_id);
          $statement->bindValue(":customer_id", $customer_id);
  
          $sql2 = "INSERT INTO submit_order (customer_order_id, menu_id) VALUES (:customer_order_id, :menu_id)";
  
          $statement = $db->prepare($sql2);
          foreach ($menu_ids as $menu_id) {
              $submit_order_statement->bindValue(":customer_order_id", $customer_order_id);
              $submit_order_statement->bindValue(":menu_id", $menu_id);
              $submit_order_statement->execute();
          }
  
       }
          if($statement->execute()){
              $statement->closeCursor();
              $message = "<h4>The order is successful.</h4>";
          }else{
              $message = "<h4>Error submitting order.</h4>";
          }
   -->