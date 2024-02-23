<!DOCTYPE html>
<?php
$activePage = "SuccessfulPayment";
session_start();
?>
<?php
if ($_SESSION['user_id'] == $_SESSION['user_id2'] && isset($_SESSION['IS_LOGIN'])) {


    $userID = $_SESSION['user_id'];
    include "dbFunctions2.php";

    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("DELETE FROM cart_books WHERE user_id= :userID");
        $stmt->bindParam(":userID", $userID);
        
        $stmt->execute();
    } catch (Exception $ex) {
        echo "Error: " . $ex->getMessage();
    }
    $conn = null;
    //$deletequery = "DELETE FROM cart_books WHERE user_id='$userID'";

    //$status = mysqli_query($link, $deletequery) or die(mysqli_errno($link));

    //mysqli_close($link);

    if ($stmt) {
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <title>Thank you!</title>
                <style>
                    img {
                        display: block;
                        margin-left: auto;
                        margin-right: auto;
                    }

                    h1 {
                        text-align: center;
                    }

                    a {
                        display: block;
                        text-align: center;
                    }
                </style>
            </head>
            <body>
                <img src="WebDesign/successpayment.png" width="100" height="100"
                     title="successpayment" alt="successful logo">

                <h1>Payment Successful</h1><br/><br/>
            <center>Thank you for shopping with us!</center><br/>
            <center>Your shipment will arrive around 3 weeks.</center><br/><br/>

            <a href="index.php">Back to Listing page</a>
        </body>
        <?php include("include/footer.php"); ?>
        </html>
        <?php
    } else {
        echo "Payment is not successful. Do click <a href='Cart.php'>HERE</a> to go back to Cart Page";
        include("include/footer.php");
    }
}
?>
