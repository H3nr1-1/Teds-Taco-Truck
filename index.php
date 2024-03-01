
<!DOCTYPE html>
<html lang="en">

<?php 

    $message = "";
    require_once("connect-db.php");
    
    $sql = "select * from menu";
    
    $statement = $db->prepare($sql);
    
    if($statement->execute()){
        $menu = $statement->fetchAll();
        $statement->closeCursor();
        $message = "<h3>Menu was successfully retrieved.</h3>";
    }else{
        $message = "<h3>Error retrieving menu.</h3>";
    }
?>    

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
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h1 class="under" id="pad">Welcome to Ted's Tasty Taco Truck</h1>
                        <h5 id="pad">We are currently located at <strong>3535 S Las Vegas Blvd, Las Vegas, NV 89109</strong>.  Right outside of the Linq Hotel on the strip!!!  Check back often to see where we are located each week!</h5>
                        <h1 class="right">Our Menu</h1>
                        
                        <table class="table table-striped order">
                          <thead>
                            <tr>
                              <th scope="col"></th>
                              <th scope="col">Menu Item</th>
                              <th scope="col">Price</th>
                              <th scope="col">Description</th>
                            </tr>
                            
                            <?php                                              
                                foreach($menu as $m){
                            ?>
                            
                            <tr>
                                <td><img class="food" src="<?php echo $m["image"];?>"></td>
                                <td><?php echo $m["menu_item"];?></td>
                                <td><?php echo "$"; echo $m["price"];?></td>
                                <td><?php echo $m["info"];?></td>
                                
                            <?php
                                }
                              ?>                    
                                                
                          </thead>
                        </table>
                    </div>
                    <div class="col-md-2"></div>
                </div>            
            </article>

            <?php include("footer.html");?>

		</div>		
	</body>
</html>




