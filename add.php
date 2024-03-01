<?php
session_start();
if($_SESSION["admin-login"] != "true"){
    header('Location: login.php');
}
?>


<?php
    
    $message = "";
    
  if($_SERVER["REQUEST_METHOD"]=="GET"){
      require_once("connect-db.php");
        $menu_item = $_GET["menu_item"];
        $price = $_GET["price"];
        $info = $_GET["info"];
        $image = $_GET["image"];
        
        $sql = "INSERT INTO menu (menu_item, price, info, image) VALUES (:menu_item, :price, :info, :image)";
      
        $statement = $db->prepare($sql);
        $statement->bindValue(":menu_item", $menu_item);
        $statement->bindValue(":price", $price);
        $statement->bindValue(":info", $info);
        $statement->bindValue(":image", $image);

     }
        if($statement->execute()){
            $statement->closeCursor();
            $message = "<h4>The item has been added to the menu.</h4>";
        }else{
            $message = "<h4>Error adding item to the menu.</h4>";
        }

?>
    
<script>
    window.location.replace("owner.php");
</script>