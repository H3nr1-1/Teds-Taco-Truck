<?php
session_start();
if($_SESSION["admin-login"] != "true"){
    header('Location: login.php');
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
    

    
<?php
    require_once("connect-db.php");
    
    $cartsql = "SELECT * FROM submit_order";
    
    $statement = $db->prepare($cartsql); 
    
    
    if($statement->execute()){
        $cart = $statement->fetchAll();
        $statement->closeCursor();
    }else{
        $message = "<h3>Error retrieving cart information.</h3>";
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
           
            <?php include("admin-header.html");?>

            
            <?php include("nav.html");?>            

            <section>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-4">
                        <h1 class="under">Hello Ted!!</h1>
                        <h5>Hope you're having a wonderful day!</h5>
                        <p>Here you can update, delete and add new menu items.</p>
                    </div>
                    <div class="col-md-5"></div>
                </div>
            </section> 
            
            <article>
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <table class="table-responsive table-striped order">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col"></th>
                                    <th class="text-center" scope="col">Menu Item</th>
                                    <th class="text-center" scope="col">Price</th>
                                </tr>
                                <tr>
                                    <th class="text-center" scope="col">Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($menu as $m) { ?>
                                    <!-- Row for details -->
                                    <tr>
                                        <td class="text-center"><img class="food" src="<?php echo $m["image"];?>"></td>
                                        <td class="text-center"><?php echo $m["menu_item"];?></td>
                                        <td class="text-center"><?php echo "$"; echo $m["price"];?></td>
                                    </tr>
                                    <tr>
                                        <td class="text-center" colspan="8"><?php echo $m["info"];?></td>
                                    </tr>
                                    <!-- Row for buttons -->
                                    <tr>
                                        <td class="text-center">
                                            <form action="update.php" method="GET">
                                                <input type="hidden" name="menu_id" value="<?php echo $m["menu_id"];?>">
                                                <button type="submit" class="btn btn-primary">Edit Menu Item</button>
                                            </form>
                                            <form action="delete.php" method="GET">
                                                <input type="hidden" name="menu_id" value="<?php echo $m["menu_id"];?>">
                                                <button onclick="return confirm('Are you sure you want to delete this menu item?')" type="submit" class="btn btn-danger">Delete Menu Item</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php } ?>   
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                </div>            
            </article>
            
            
            <article>
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6 box">
                    
                        <h2>Add a New Menu Item</h2>
                        <form action="add.php" method="GET">
                    
                        <label>New Menu Item: </label><br>
                        <input type="text" id="menu_item" name="menu_item" required><br>
                        <label>Price: </label><br>
                        <input type="text" id="price" name="price" required><br>
                        <label>Image Path: </label><br>
                        <input type="text" id="image" name="image" required><br>
                        <label>Description:</label><br>
                        <input id="text" id="info" name="info" required><br><br>
                        
                        <button>Submit</button>
                        
                        </form>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </article>
            
            <article>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h1>Orders Placed</h1>
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th scope="col">Customer ID</th>
                              <th scope="col">Menu Item(s)</th>
                            </tr>
                            
                            <?php                                              
                                foreach($cart as $c) {
                            ?>
                            
                            <tr>
                                <td><?php echo $c["customer_id"];?></td>
                                <td><?php echo $c["menu_item"];?></td>
                            </tr>
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