<?php
session_start();
if($_SESSION["admin-login"] != "true"){
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<?php
    
    $message="";


   if($_SERVER["REQUEST_METHOD"] == "GET") {
        $menu_id=$_GET["menu_id"];
       
    }    
    
    require_once("connect-db.php");

    $sql = "SELECT * FROM menu WHERE menu_id = :menu_id";
        
    $statement = $db->prepare($sql);
        
    $statement->bindValue(":menu_id", $menu_id);
    
    
    if($statement->execute()) {
        $menu = $statement->fetchAll();
        $statement->closeCursor();
        $message = "<h3>Menu successfully retreived.</h3>";
        
    } else {
        $message = "<h3>ERROR retreiving menu data.</h3>";
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
            
            <article>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-6 box">
                            <?php
                                foreach($menu as $m) {
                            ?>

                            <h2>Update Menu Item</h2>
                        
                            <form action="process-update.php" method="POST">
                                <input type="hidden" name="menu_id" value="<?php echo $m["menu_id"];?>">
                                <label>Menu Item:</label><br>
                                <input type="text" name="menu_item" value="<?php echo $m["menu_item"];?>"><br>
                                <label>Price:</label><br>
                                <input type="text" name="price" value="<?php echo $m["price"];?>"><br>
                                <label>Image:</label><br>
                                <input type="text" name="image" value="<?php echo $m["image"];?>"><br>
                                <label>Description:</label><br>
                                <input type="text" name="info" value="<?php echo $m["info"];?>"><br><br>                        
                                
                                <input type="submit" value="Update">

                            </form>

                            <?php } ?>  
                                            
                    </div>
                    <div class="col-md-4"></div>
                </div>            
            </article>

            <?php include("footer.html");?>

		</div>		
	</body>
</html>
