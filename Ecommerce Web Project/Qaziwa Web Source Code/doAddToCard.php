<?php

session_start();

if ($_SESSION['user_id'] == $_SESSION['user_id2'] && isset($_SESSION['IS_LOGIN'])) {
    $bookID = $_POST['id'];
    $bookID = htmlspecialchars($bookID);
    $userID = $_SESSION['user_id'];

    include "dbFunctions2.php";


    try {
        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
// set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
        $stmt = $conn->prepare("SELECT * FROM books WHERE title_id= :bookID");
        $stmt->bindParam(":bookID", $bookID);

        $stmt->execute();
    } catch (Exception $ex) {
        echo "Error: " . $ex->getMessage();
    }
    $conn = null;



//$query1 = "SELECT * FROM books WHERE title_id='$bookID'";
// To secure, use mysqli_escape_string or prepared statements
//$result1 = mysqli_query($link, $query1) or die(mysqli_error($link));

    while ($row1 = $stmt->fetch()) {
        $arrProducts[] = $row1;
    }
    for ($i = 0; $i < count($arrProducts); $i++) {
        $id = $arrProducts[$i]['title_id'];
        $title = $arrProducts[$i]['title'];
        $author = $arrProducts[$i]['author'];
        $summary = $arrProducts[$i]['summary'];
        $rating = $arrProducts[$i]['rating'];
        $price = $arrProducts[$i]['price'];
        $quantity = $arrProducts[$i]['quantity'];
        $pictures = $arrProducts[$i]['picture_front'];
    }
//mysqli_close($link);
    ?>

    <?php

    include "dbFunctions2.php";

    try {
        $conn2 = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
// set the PDO error mode to exception
        $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
        $stmt2 = $conn2->prepare("INSERT INTO cart_books(user_id,title_id,cart_title,cart_price,cart_picture)
                VALUES (:userID, :bookID, :title, :price, :pictures)");

        $stmt2->bindParam(":userID", $userID);
        $stmt2->bindParam(":bookID", $bookID);
        $stmt2->bindParam(":title", $title);
        $stmt2->bindParam(":price", $price);
        $stmt2->bindParam(":pictures", $pictures);

        $stmt2->execute();
    } catch (Exception $ex) {
        echo "Error: " . $ex->getMessage();
    }
    $conn2 = null;
//$query2 = "INSERT INTO cart_books(user_id,title_id,cart_title,cart_price,cart_picture)
//VALUES ('$userID','$bookID','$title','$price','$pictures')";
//$resultInsert = mysqli_query($link, $query2) or die('Error querying database');
// user_id, cart_title, cart_price, cart_picture,

    if ($stmt2) {
        $quantity = $quantity - 1;
// header("location: UserList.php");
    }
//mysqli_close($link);
    ?>
    <?php

    include "dbFunctions2.php";


    try {
        $conn3 = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
// set the PDO error mode to exception
        $conn3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
        $stmt3 = $conn3->prepare("UPDATE books SET quantity= :quantity WHERE title_id= :id");
        $stmt3->bindParam(":quantity", $quantity);
        $stmt3->bindParam(":id", $id);

        $stmt3->execute();
    } catch (Exception $ex) {
        echo "Error: " . $ex->getMessage();
    }
    $conn3 = null;


    //$update = "UPDATE books SET quantity = '$quantity' WHERE title_id = '$id'";
    //$resultupdate = mysqli_query($link, $update) or die('Error querying database');

    if (($stmt2) && ($stmt3)) {
        header("location: UserList.php");
        exit;
    }
    //mysqli_close($link);
}
?>
