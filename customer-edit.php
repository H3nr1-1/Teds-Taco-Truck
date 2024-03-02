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
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $customer_id = $_POST["customer_id"];

    require_once("connect-db.php");
    
    $sql = "select * from customer where customer_id = :customer_id";
    
    $statement = $db->prepare($sql);
    
    $statement->bindValue(":customer_id", $customer_id);
    }
    
    if($statement->execute()){
        $customer = $statement->fetchAll();
        $statement->closeCursor();
        $message = "<h3>Customer infromation successfully retrieved.</h3>";
    }else{
        $message = "<h3>Error retrieving customer information.</h3>";
    }
    
?>
        
    
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
            
            <article>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 box3">

                            <?php
                                foreach($customer as $c) {
                            ?>

                            <h2>Update Customer Information</h2>
                        
                            <form action="customer-edit-process.php" method="POST">
                                <input id="create" type="hidden" name="customer_id" value="<?php echo $c["customer_id"];?>">
                                <label>First Name:</label><br>
                                <input id="create" type="text" name="fname" required value="<?php echo $c["fname"];?>"><br>
                                <label>Last Name:</label><br>
                                <input id="create" type="text" name="lname" required value="<?php echo $c["lname"];?>"><br>
                                <label>Phone Number:</label><br>
                                <input id="create" type="text" name="phone_number" required value="<?php echo $c["phone_number"];?>"><br>
                                <label>Email:</label><br>
                                <input id="create" type="text" name="email" required value="<?php echo $c["email"];?>"><br>
                                <label>Credit Card Type:</label><br>
                                <input id="create" type="text" name="credit_card_type" required value="<?php echo $c["credit_card_type"];?>"><br>
                                <label>Payment:</label><br>
                                <input id="create" type="text" name="card_number" required value="<?php echo $c["card_number"];?>"><br>
                                <label>Billing Address:</label><br>
                                <input id="create" type="text" name="shipping" required value="<?php echo $c["shipping"];?>"><br><br>
                                
                                <input type="submit" value="Update">
                            </form>

                            <?php } ?>                          
                        
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </article> 
            


            <?php include("footer.html");?>

		</div>		
	</body>
</html>