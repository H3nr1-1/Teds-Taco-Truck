<?php
session_start();
if($_SESSION["customer-login"] != "true"){
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<?php
    
    $message = "";
    
  if($_SERVER["REQUEST_METHOD"]=="GET"){
      require_once("connect-db.php");
        $customer_id = $_GET["customer_id"];
        $menu_id = $_GET["menu_id"];
        
        $sql = "INSERT INTO customer_order (customer_id, menu_id) VALUES (:customer_id, :menu_id)";
      
        $statement = $db->prepare($sql);
        $statement->bindValue(":customer_id", $customer_id);
        $statement->bindValue(":menu_id", $menu_id);

     }
        if($statement->execute()){
            $statement->closeCursor();
            $message = "<h4>The item has been added to cart.</h4>";
        }else{
            $message = "<h4>Error adding to cart.</h4>";
        }

?>
    
<script>
    window.location.replace("menu.php");
</script>