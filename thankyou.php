<?php
session_start();
if($_SESSION["customer-login"] != "true"){
    header('Location: login.php');
}
?>

<script>
    setTimeout(function(){
    window.location.replace("customer.php");
    }, 2000);            
</script>

<!DOCTYPE html>
<html lang="en">
   
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
            
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h3>Thank you for your order!</h3>
                    <h5>You will be redirected in 2 seconds.</h5>
                </div>
                <div class="col-md-4"></div>
            </div>
            
            
            <?php include("footer.html");?>

		</div>		
	</body>
</html>