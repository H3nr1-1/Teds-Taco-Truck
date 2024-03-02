<?php
session_start();
if ($_SESSION["customer-login"] != "true") {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<?php

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST["customer_id"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $credit_card_type = $_POST["credit_card_type"];
    $card_number = $_POST["card_number"];
    $shipping = $_POST["shipping"];
    $success = true;


    if ($success) {
        require_once("connect-db.php");

        $sql = "UPDATE customer SET fname = :fname, lname = :lname, email = :email, phone_number = :phone_number, credit_card_type = :credit_card_type, card_number = :card_number, shipping = :shipping WHERE customer_id = :customer_id";

        $statement = $db->prepare($sql);

        $statement->bindValue(":fname", $fname);
        $statement->bindValue(":lname", $lname);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":phone_number", $phone_number);
        $statement->bindValue(":credit_card_type", $credit_card_type);
        $statement->bindValue(":card_number", $card_number);
        $statement->bindValue(":customer_id", $customer_id);
        $statement->bindValue(":shipping", $shipping);
    }

    if ($statement->execute()) {
        $statement->closeCursor();
        $message = "<h4>The account update has been submitted.</h4>";
    } else {
        $message = "<h4>Error submitting account update.</h4>";
    }

}
?>

<script>
    setTimeout(function () {
        window.location.replace("customer.php");
    }, 2000);            
</script>


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

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <h3>Customer information updated!</h3>
                <h5>You will be redirected in 2 seconds.</h5>
            </div>
            <div class="col-md-4"></div>
        </div>

        <?php include("footer.html"); ?>

    </div>
</body>

</html>