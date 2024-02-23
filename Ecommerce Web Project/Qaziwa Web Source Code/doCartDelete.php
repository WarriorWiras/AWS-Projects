<?php
session_start();

if ($_SESSION['user_id'] == $_SESSION['user_id2']&& isset($_SESSION['IS_LOGIN'])) {
    include "dbFunctions2.php";

    $title_id = $_POST['titleID'];
    $title_id = htmlspecialchars($title_id);
    $cart_id = $_POST['cartID'];
    $cart_id = htmlspecialchars($cart_id);
    $user_id = $_SESSION['user_id'];
    $user_id = htmlspecialchars($user_id);
    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
        $stmt = $conn->prepare("DELETE FROM cart_books WHERE user_id= :userID AND title_id= :titleID AND cart_id= :cartID");
        $stmt->bindParam(":userID", $user_id);
        $stmt->bindParam(":titleID", $title_id);
        $stmt->bindParam(":cartID", $cart_id);

        $stmt->execute();
    } catch (Exception $ex) {
        echo "Error: " . $ex->getMessage();
    }
    $conn = null;



    //$queryDelete2 = "DELETE FROM cart_books WHERE user_id ='$user_id' AND title_id ='$title_id' AND cart_id='$cart_id'";

    //$status1 = mysqli_query($link, $queryDelete2) or die(mysqli_errno($link));

    if ($stmt) {

        header("location: Cart.php");

        exit;
    } else {
        $message = "Item cannot be deleted, Please try again <br><br>";
        $message .= "Do Click <a href='Cart.php'>HERE</a> to go back to your Cart page";
    }
    //mysqli_close($link);
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
        <title>QaZiWa Bookstore</title>
    </head>
    <body>
        <h3>QaZiWa Deletion Message</h3>
        <?php
        echo $message;
        ?>
    </body>
    <?php include("include/footer.php"); ?>
</html>