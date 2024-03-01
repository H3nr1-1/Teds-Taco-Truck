<?php
session_start();
if($_SESSION["admin-login"] != "true"){
    header('Location: login.php');
}

?>

<?php

    $message = "";

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $menu_item = $_POST["menu_item"];
    $price = $_POST["price"];
    $image = $_POST["image"];
    $info = $_POST["info"];
    $menu_id = $_POST["menu_id"];
    $success = true;
    

if($success){
    require_once("connect-db.php");
        
    $sql = "UPDATE menu SET menu_item = :menu_item, price = :price, image = :image, info = :info WHERE menu_id = :menu_id";
        
    $statement = $db->prepare($sql);
    
    $statement->bindValue(":menu_item", $menu_item);
    $statement->bindValue(":price", $price);
    $statement->bindValue(":image", $image);
    $statement->bindValue(":info", $info);
    $statement->bindValue(":menu_id", $menu_id);
    }
    
if($statement->execute()) {
    $statement->closeCursor();
    $message = "<h4>The menu update has been submitted.</h4>";
    }else{
    $message = "<h4>Error submitting menu update.</h4>";
    }
    
}

?>
    
<script>
    window.location.replace("owner.php");
</script>
        
    

