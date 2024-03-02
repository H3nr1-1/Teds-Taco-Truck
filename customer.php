<?php
session_start();
if($_SESSION["customer-login"] != "true"){
    header('Location: login.php');
}
 

    $message = "";
    require_once("connect-db.php");
    
    $sql = "SELECT * FROM customer where customer_id = :customer_id";
     
    $statement = $db->prepare($sql);
    $statement->bindValue(":customer_id", $_SESSION["customer_id"]);

     
    if($statement->execute()){
        $customer = $statement->fetchAll();
        $statement->closeCursor();
        $message = "<h3>Menu was successfully retrieved.</h3>";
    }else{
        $message = "<h3>Error retrieving menu.</h3>";
    }
    
?>


<!DOCTYPE html>
<html lang="en">
    <head>	
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="stylesheet.css" type="text/css">
        <link rel="icon" href="taco_truck.jpg" type="image/x-icon">
		<title>Ted's Taco Truck</title>
	</head>
	<body>
        
		<div class="container">
           
            <?php include("header.html");?>

            
            <?php include("nav.html");?>   
            
            <section>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-4">
                        <?php
                        foreach($customer as $c){
                        ?>
                        
                            <h2 class="under">Hello <?php echo $c["fname"];?> <?php echo $c["lname"];?>!</h2>

                        <?php
                        }
                        ?>
                    </div>
                    <div class="col-md-7"></div>
                </div>
            </section>
            
                <article>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6 box2">
                    
                            <h2>Customer Information</h2> 
                            <?php
                                foreach($customer as $c) {
                            ?>
                            
                            <ul>
                                <li>First Name: <?php echo $c["fname"];?></li>
                                <li>Last Name: <?php echo $c["lname"];?></li>
                                <li>Phone Number: <?php echo $c["phone_number"];?></li>
                                <li>Email: <?php echo $c["email"];?></li><br><br>
                                <h3>Payment Information</h3>
                                <li>Credit Card Type: <?php echo $c["credit_card_type"];?></li>
                                <li>Card Number: <?php echo $c["card_number"];?></li>
                                <li>Billing Address: <?php echo $c["shipping"];?></li>

                                <form action="customer-edit.php" method="POST">
                                    <input type="hidden" name="customer_id" value="<?php echo $_SESSION["customer_id"];?>"><br><br>
                                    <button type="submit">Update</button></form>
                            </ul>
                
                            <?php
                                }
                            ?>
                        </div>                         
                        <div class="col-md-4">
                            <img class="small" src="thankyou.png" alt="thank you post it note!"><!--Image by <a href="https://pixabay.com/users/maklay62-182851/?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=1428147">S K</a> from <a href="https://pixabay.com//?utm_source=link-attribution&amp;utm_medium=referral&amp;utm_campaign=image&amp;utm_content=1428147">Pixabay</a>-->     
                        </div>
                    </div>
                </article> 

            <?php include("footer.html");?>

		</div>		
	</body>
</html>