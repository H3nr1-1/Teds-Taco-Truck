<?php
session_start();
if ($_SESSION["customer-login"] != "true") {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">


<?php
require_once("connect-db.php");

$sql = "SELECT * FROM customer_order inner join menu on menu.menu_id = customer_order.menu_id where customer_order.customer_id = :customer_id";

$statement = $db->prepare($sql);
$statement->bindValue(":customer_id", $_SESSION["customer_id"]);


if ($statement->execute()) {
    $menu = $statement->fetchAll();
    $statement->closeCursor();
} else {
    $message = "<h3>Error retrieving cart.</h3>";
}

?>


<?php

$message = "";
require_once("connect-db.php");

$sql = "SELECT * FROM customer WHERE customer_id = :customer_id";

$statement = $db->prepare($sql);
$statement->bindValue(":customer_id", $_SESSION["customer_id"]);


if ($statement->execute()) {
    $customer = $statement->fetchAll();
    $statement->closeCursor();
    $message = "<h3>Menu was successfully retrieved.</h3>";
} else {
    $message = "<h3>Error retrieving menu.</h3>";
}

?>

<!--adding total price for items in cart.-->
<?php
foreach ($menu as $m) {
    $price = $m["price"];
    $tax = 1.05;

    $total += number_format($price * $tax, 2);

}
?>



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="stylesheet.css" type="text/css">
    <link rel="icon" href="taco_truck.jpg" type="image/x-icon">
    <title>Ted's Taco Truck</title>
</head>

<body>

    <div class="container">

        <?php include("header.html"); ?>


        <?php include("nav.html"); ?>

        <section>
            <div class="row">
                <div class="col-md-12">
                    <h3 class="right">Items in your cart.</h3>
                </div>
            </div>
        </section>

        <article>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-5">
                    <table class="table table-striped order">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Menu Item</th>
                                <th scope="col">Price</th>
                            </tr>

                            <?php
                            foreach ($menu as $m) {
                                ?>

                                <tr>
                                    <td><img class="food" src="<?php echo $m["image"]; ?>"></td>
                                    <td>
                                        <?php echo $m["menu_item"]; ?>
                                    </td>
                                    <td>
                                        <?php echo "$";
                                        echo $m["price"]; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        <form action="remove.php" method="GET">
                                            <input type="hidden" name="customer_order_id"
                                                value="<?php echo $m["customer_order_id"]; ?>">
                                            <button type="submit" class="btn btn-danger">Remove From Cart</button>
                                        </form>
                                    </td>

                                    <?php
                                    }
                                ?>

                        </thead>
                    </table>
                </div>
                <div class="col-md-4"></div>
            </div>
        </article>

        <article>
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-5 box4" id="bill">
                    <h3>Billing Information</h3>
                    <?php
                    foreach ($customer as $c) {
                        ?>
                        <ul>
                            <li>First Name:
                                <?php echo $c["fname"]; ?>
                            </li>
                            <li>Last Name:
                                <?php echo $c["lname"]; ?>
                            </li>
                            <li>Billing Address:
                                <?php echo $c["shipping"]; ?>
                            </li>
                            <li>Credit Card Type:
                                <?php echo $c["credit_card_type"]; ?>
                            </li>
                            <li>Card Number:
                                <?php echo $c["card_number"]; ?>
                            </li>

                            <form action="customer-edit.php" method="POST">
                                <input type="hidden" name="customer_id"
                                    value="<?php echo $_SESSION["customer_id"]; ?>"><br><br>
                                <button type="submit">Update Billing Information</button>
                            </form>
                        </ul>

                        <?php
                    }
                    ?>
                </div>
                <div class=col-md-1></div>
                <div class="col-md-5" id="bill">
                    <div>
                        <?php
                        foreach ($menu as $m) {
                            $price = $m["price"];
                            ?>

                            <h3>$
                                <?php echo $price; ?>
                            </h3>

                            <?php
                        }
                        ?>
                    </div>
                    <h3 class="under">$
                        <?php echo $total; ?>--Total Cost
                    </h3>
                </div>
            </div>
        </article>

        <article>
            <div class="row">
                <div class="col-md-5"></div>
                <div class="col-md-3">
                    <h3>Check Out</h3>

                    <form action="checkout.php" method="POST"> <!-- Use POST method -->
                        <?php
                        foreach ($menu as $m) {
                        ?>
                            
                            <input type="hidden" name="menu_ids[]" value="<?php echo $m["customer_order_id"]; ?>">
                        <?php
                        }
                        ?>

                            <input type="hidden" name="customer_id" value="<?php echo $_SESSION["customer_id"]; ?>">
                            <button onclick="return confirm('Are you sure you want to place this order?')" type="submit" class="btn btn-primary" name="submit_order">Submit Order</button>
                    </form>

                </div>
                <div class="col-md-5"></div>
            </div>
        </article>

        <aside>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <h5>Click here to <a href="menu.php">return to Menu</a></h5>
                </div>
                <div class="col-md-6"></div>
            </div>
        </aside>

        <?php include("footer.html"); ?>

    </div>
</body>

</html>