<?php
session_start();
if($_SESSION["customer-login"] != "true"){
}
?>

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
        <link rel="icon" href="taco_truck.jpg" type="image/x-icon">
		<title>Ted's Taco Truck</title>
	</head>
	<body>
        
		<div class="container">
           
            <?php include("header.html");?>
            
            <?php include("nav.html");?>            
            
            <article>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h2 class="center">Click <strong>Add to Cart</strong> to add an item to your cart for checkout.</h2>
                        <h4 id="under">Please make an account before making an order.</h4><br><br>
                        
                        <table class="table-responsive table-striped order">
                            <thead>
                                <tr>
                                <th class="text-center" scope="col"></th>
                                <th class="text-center" scope="col">Menu Item</th>
                                <th class="text-center" scope="col">Price</th>
                                </tr>
                            </thead>
                            <?php                                              
                                foreach($menu as $m){
                            ?>
                            
                            <tr id="order_description">
                                <td class="text-center"><img class="food" src="<?php echo $m["image"];?>"></td>
                                <td class="text-center"><?php echo $m["menu_item"];?></td>
                                <td class="text-center"><?php echo "$"; echo $m["price"];?></td>
                            </tr>
                            <tr id="order_description">
                                <td class="text-center" colspan="8"><?php echo $m["info"];?></td>
                            </tr>
                            <tr>  
                                <td class="text-center"><form action="add-cart.php" method="GET">                                 
                                <input type="hidden" name="menu_id" value="<?php echo $m["menu_id"];?>">
                                <input type="hidden" name="customer_id" value="<?php echo $_SESSION["customer_id"];?>">
                                    
                                <button type="submit" class="btn btn-danger">Add to Cart</button>
                                </form></td>
                                
                            <?php 
                                }
                              ?>                    
                                                
                        </table>
                    </div>
                    <div class="col-md-2"></div>
                </div>            
            </article>

            <?php include("footer.html");?>

		</div>		
	</body>
</html>
