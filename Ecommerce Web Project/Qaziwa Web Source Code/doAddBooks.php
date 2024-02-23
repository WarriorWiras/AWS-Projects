<?php
session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_id'] == 2) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $summary = $_POST['summary'];
        $rating = $_POST['rating'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        //$ID = NULL;



        $title = htmlspecialchars($title);


        $summary = htmlspecialchars($summary);


        $author = htmlspecialchars($author);

        $rating = htmlspecialchars($rating);

        $price = htmlspecialchars($price);

        $quantity = htmlspecialchars($quantity);

        //$ID = htmlspecialchars($ID);

        include "dbFunctions2.php";

        $target_dir = "Pictures/";
        $fileName = basename($_FILES['picture_front']['name']);
        $target_file = $target_dir . basename($_FILES['picture_front']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $message = "";

        if (!empty($title) && !empty($author) && !empty($summary) && !empty($rating) && !empty($price
                ) && !empty($quantity)) {
            if ($_FILES['picture_front']['size'] < 500000 && $imageFileType == "jpg") {
                #In apache Instance put "!"
                if (move_uploaded_file($_FILES['picture_front']['tmp_name'], $target_file)) {
                    $message .= "The book image " . $fileName . " has been uploaded<br/><br/>";


                    try {
                        $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        $stmt = $conn->prepare("INSERT INTO books(title,author,summary,rating,price,quantity,picture_front)
                            VALUES(:title, :author, :summary, :rating, :price, :quantity, :fileName)");

                        //$stmt->bindParam(":ID", $ID);
                        $stmt->bindParam(":title", $title);
                        $stmt->bindParam(":author", $author);
                        $stmt->bindParam(":summary", $summary);
                        $stmt->bindParam(":rating", $rating);
                        $stmt->bindParam(":price", $price);
                        $stmt->bindParam(":quantity", $quantity);
                        $stmt->bindParam(":fileName", $fileName);

                        $stmt->execute();
                    } catch (Exception $ex) {
                        echo "Error: " . $ex->getMessage();
                    }
                    $conn = null;
                    //$sql = "INSERT INTO books(title_id,title,author,summary,rating,price,quantity,picture_front)
                    //VALUES('NULL','$title','$author','$summary','$rating','$price','$quantity','$fileName')";
                    //$resultInsert = mysqli_query($link, $sql) or die('Error querying database');
                    $ftp_host = "10.0.2.231";
                    $ftp_username = "Qaziwa";
                    $ftp_password = "Password";

// open an FTP connection
                    $conn_id = ftp_connect($ftp_host) or die("Couldn't connect to $ftp_host");

// login to FTP server
                    $ftp_login = ftp_login($conn_id, $ftp_username, $ftp_password);

// local & server file path
                    $localFilePath = "/var/www/html/Pictures/$fileName";
                    $remoteFilePath = "files/$fileName";

// try to upload file
                    if (ftp_put($conn_id, $remoteFilePath, $localFilePath, FTP_BINARY)) {
                        echo "File transfer successful - $localFilePath";
                    } else {
                        echo "There was an error while uploading $localFilePath";
                    }

// close the connection
                    ftp_close($conn_id);
                    if ($stmt) {
                        header("location: AdminList.php");
                        exit;
                    } else {
                        $message .= "Your profile was not updated. <br/><br/>";
                        $message .= "<a href='AddBooks.php'>Insert Page.</a>";
                    }
                }
            }
        }
        //mysqli_close($link);
        ?>
        <html>
            <head>
                <meta http-equiv = "Content-Type" content = "text/html; charset=utf-8" >
                <title>QaZiWa Bookstore</title>
            </head>
            <body>
                <h3>QaZiWa Bookstore - Add Books</h3>
                <?php
                echo $message;
                ?>
            </body>
            <?php include("include/footer.php"); ?>
        </html>
        <?php
    }
}
?>

