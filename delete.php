<?php
session_start();
?>

<?php

    if($_SERVER["REQUEST_METHOD"]=="GET") {
        $menu_id=$_GET["menu_id"];
    }

    require_once("connect-db.php");        
        
        $sql = "DELETE FROM menu WHERE menu_id = :menu_id";         
        $statement = $db->prepare($sql);    
        $statement->bindValue(":menu_id", $menu_id);
    

    
    if($statement->execute()){
        $statement->closeCursor();     
        
    }
?>
 

<script>
    window.location.replace("owner.php");
</script>
