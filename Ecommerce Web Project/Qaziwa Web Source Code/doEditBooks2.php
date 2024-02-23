<?php
session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_id'] == 2) {
        include "dbFunctions2.php";

        $id = $_POST['id'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $summary = $_POST['summary'];
        $rating = $_POST['rating'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $msg = "";
        
        $id = htmlspecialchars($id);
        
     
        $title = htmlspecialchars($title);

       
        $summary = htmlspecialchars($summary);

     
        $author = htmlspecialchars($author);

        $rating = htmlspecialchars($rating);
        
        $quantity = htmlspecialchars($quantity);
        try {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
            $stmt = $conn->prepare("UPDATE books SET title=:title, author=:author, summary=:summary, rating=:rating, price=:price, quantity=:quantity WHERE title_id=:id");
            $stmt->bindParam(":title", $title);
            $stmt->bindParam(":author", $author);
            $stmt->bindParam(":summary", $summary);
            $stmt->bindParam(":rating", $rating);
            $stmt->bindParam(":price", $price);
            $stmt->bindParam(":quantity", $quantity);
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        $conn = null;
        //$query = "UPDATE books SET title='$title', author='$author',summary='$summary',rating='$rating', price='$price', quantity='$quantity' WHERE title_id ='$id'";
        //$result = mysqli_query($link, $query) or die(mysqli_error($link));

        if ($stmt) {
            header("location: AdminList.php");
            exit;
        } else {
            echo "Record not updated";
        }
        mysqli_close($link);
        ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <title></title>
            </head>
            <body>
                <br/><br/>
                <a href="AdminList.php">Back to Travel Admin List</a>
            </body>
            <?php include("include/footer.php"); ?>
        </html>
        <?php
    }
}?>