<?php 
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $cusername = $_POST["cusername"];
    $cpassword = $_POST["cpassword"];

    if($cusername == "admin" && $cpassword == "tacos") {
        $_SESSION["admin-login"] = "true";
    header('Location: owner.php');
    exit();
    }
}
?>

<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $cusername = $_POST["cusername"];
    $cpassword = $_POST["cpassword"];

    require_once("connect-db.php");
    
    $sql = "select * from customer where cusername = :cusername and cpassword = :cpassword";
    
    $statement = $db->prepare($sql);
    $statement->bindValue(":cusername", $cusername);
    $statement->bindValue(":cpassword", $cpassword);
    
    if($statement->execute()){
        $customer = $statement->fetchAll();
        $statement->closeCursor();
        
        if(count($customer)==1){
             $_SESSION["customer-login"] = "true";
            foreach($customer as $c){
                $_SESSION["customer_id"] = $c["customer_id"];
                header('Location: menu.php');
                exit();
            }
            ?>

    <?php
    }else{
        ?>
        <script>
            window.location.replace("login.php");
        </script>
<?php
    }
}
}

?>



