<?php
session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_id'] == 2) {
        include "dbFunctions2.php";

        $title_id = $_POST['title_id'];
        $title_id = htmlspecialchars($title_id);

        try {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
            $stmt = $conn->prepare("DELETE FROM books WHERE title_id = :titleID");
            $stmt->bindParam(":titleID", $title_id);

            $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        $conn = null;
        //$queryDelete = "DELETE FROM books WHERE title_id = '$title_id'";
        //$status = mysqli_query($link, $queryDelete) or die(mysqli_errno($link));


        if ($stmt) {
            header("location: AdminList.php");
            exit;
        } else {
            $message = "Item cannot be deleted, Please try again <br><br>";
            $message .= "Do Click <a href='DeleteBooks.php'>HERE</a> to go back to deletion page";
        }
        //mysqli_close($link);
    }
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