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

        <article>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h2>Login:</h2>
                    <form action="process-login.php" method="POST">
                        <input type="text" name="cusername" required placeholder="Username"><br>
                        <input type="password" name="cpassword" required placeholder="Password"><br><br>
                        <input type="submit" value="Sign In">
                    </form><br><br>
                    
                    <p>To make a new account <a href="create-account.php">Click Here</a></p>
                    
                </div>
                <div class="col-md-3"></div>
            </div>
        </article>

            <?php include("footer.html");?>

		</div>		
	</body>
</html>