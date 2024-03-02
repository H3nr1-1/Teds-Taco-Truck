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
           
                <article> 
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 box2">
                            <h2>Create a Customer New Account</h2>
                            <form action="process-account.php" method="POST">
                                <input id="create" type="text" name="cusername" required placeholder="Username"><br><br>
                                <input id="create" type="password" name="cpassword" required placeholder="Password"><br><br>
                                <input id="create" type="text" name="fname" required placeholder="First Name"><br><br>
                                <input id="create" type="text" name="lname" required placeholder="Last Name"><br><br>
                                <input id="create" type="text" name="phone_number" required placeholder="Phone Number"><br><br>
                                <input id="create" type="text" name="email" required placeholder="Email Address"><br><br>
                                <input id="create" type="text" name="credit_card_type" required placeholder="Credit Card Type"><br><br>
                                <input id="create" type="text" name="card_number" required placeholder="Credit Card Number"><br><br>
                                <input id="create" type="text" name="shipping" required placeholder="Billing Address"><br><br>
                                <input type="submit" value="Create My Account">
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </article>  
            
            
            <?php include("footer.html");?>

		</div>		
	</body>
</html>







                            


