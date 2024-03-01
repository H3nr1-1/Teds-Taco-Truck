
<!DOCTYPE html>
<html lang="en">
    
<?php

    $message = ""; 
    
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $cusername = $_POST["cusername"];
    $cpassword = $_POST["cpassword"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phone_number = $_POST["phone_number"];
    $email = $_POST["email"];
    $credit_card_type = $_POST["credit_card_type"];
    $card_number = $_POST["card_number"];
    $shipping = $_POST["shipping"];
    $success = true;
    

    if($success){
    require_once("connect-db.php");

    $sql = "insert into customer (cusername, cpassword, fname, lname, phone_number, email, credit_card_type, card_number, shipping) values (:cusername, :cpassword, :fname, :lname, :phone_number, :email, :credit_card_type, :card_number, :shipping)";
        
    $statement = $db->prepare($sql);
     
    $statement->bindValue(":cusername", $cusername);    
    $statement->bindValue(":cpassword", $cpassword);    
    $statement->bindValue(":fname", $fname);
    $statement->bindValue(":lname", $lname);
    $statement->bindValue(":email", $email);
    $statement->bindValue(":phone_number", $phone_number);
    $statement->bindValue(":credit_card_type", $credit_card_type);
    $statement->bindValue(":card_number", $card_number);
    $statement->bindValue(":shipping", $shipping);
        
    }
    
if($statement->execute()) {
    $statement->closeCursor();
    $message = "<h4>The new account has been created.</h4>";
    }
}

?>
    
<script>
    setTimeout(function(){
    window.location.replace("login.php");
    }, 3000);            
</script>

    <head>	
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="stylesheet.css" type="text/css">
		<title>Ted's Tasty Taco Truck</title>
	</head>
	<body>
        
		<div class="container">
           
            <?php include("header.html");?>

            
            <?php include("nav.html");?>
            
            
                <article>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <h2>Account Successfully Created</h2>
                            <h4>You will be redirected in 3 seconds.</h4>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </article>

            
            <?php include("footer.html");?>

		</div>		
	</body>
</html>