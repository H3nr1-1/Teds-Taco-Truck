<?php
session_start();
if($_SESSION["customer-login"] != "true"){
    header('Location: login.php');
}

?>
 

<?php
    
    $message = "";
    
  if($_SERVER["REQUEST_METHOD"]=="GET"){
      require_once("connect-db.php");
        $customer_order_id = $_GET["customer_order_id"];
        $customer_id = $_GET["customer_id"];
     
      
        $sql = "INSERT INTO submit_order (customer_order_id, customer_id) VALUES (:customer_order_id, :customer_id)";
      
        $statement = $db->prepare($sql);
        $statement->bindValue(":customer_order_id", $customer_order_id);
        $statement->bindValue(":customer_id", $customer_id);

     }
        if($statement->execute()){
            $statement->closeCursor();
            $message = "<h4>The order is successful.</h4>";
        }else{
            $message = "<h4>Error submitting order.</h4>";
        }

?>
    
<script>
    window.location.replace("thankyou.php");
</script>