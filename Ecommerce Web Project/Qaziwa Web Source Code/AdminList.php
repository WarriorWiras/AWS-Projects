<!DOCTYPE html>
<?php
$activePage = "AdminList";
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="include/CSS.css" rel="stylesheet" type="text/css"/>
        <title>QaZiWa Bookshop</title>
    </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        td{
            border-top: 3px solid black;

        }
        .checked {
            color: orange;
        }
    </style>
    <header>
        <?php // include("include/navigation.php");?>
    </header>
    <body>


        <?php
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['user_id'] == 2) {
                ?>
                <div class="maincontent">
                    <h1>Welcome to QaZiWa Bookshop - Admin Login</h1>
                    </br></br>
                </div>
                <?php
                include ("FTPDownload.php");
                include("dbFunctions2.php");


                try {
                    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $conn->prepare("SELECT * FROM books");

                    $stmt->execute();
                } catch (Exception $ex) {
                    echo "Error: " . $ex->getMessage();
                }
                $conn = null;

                //$query2 = "SELECT * FROM books";
                // To secure, use mysqli_escape_string or prepared statements
                //$result2 = mysqli_query($link, $query2) or die(mysqli_error($link));

                while ($row2 = $stmt->fetch()) {
                    $arrProducts[] = $row2;
                }



                //mysqli_close($link);
                ?>
                <div class="topnav">
                    <a class="active" href="logoff.php">Logoff</a>
                    <a href="DeleteBooks.php">Delete Books</a>
                    <a class="active" href="AddBooks.php">Add Books</a>
                    <a href ="EditBooks.php">Edit Books</a>
                    <div class="login-container">
                        <p><b>You are login as Admin</b></p>
                    </div>
                </div>
                <table class='productTable'>
                    <?php
                    for ($i = 0; $i < count($arrProducts); $i++) {
                        $title = $arrProducts[$i]['title'];
                        $author = $arrProducts[$i]['author'];
                        $summary = $arrProducts[$i]['summary'];
                        $rating = $arrProducts[$i]['rating'];
                        $price = $arrProducts[$i]['price'];
                        $quantity = $arrProducts[$i]['quantity'];
                        $pictures = $arrProducts[$i]['picture_front'];
                        ?>
                        <tr>
                            <td><img src = "Pictures/<?php echo $pictures; ?>" width="200" /></td>
                            <td><b>Title: </b> <?php echo $title; ?> <br><br><b>Summary: </b>
                                <?php echo $summary; ?> <br><br> <?php
                                $hello = $rating;
                                for ($r = 1; $r <= 5; $r++) {
                                    if ($hello <= 5) {
                                        ?>
                                        <span class="fa fa-star checked"></span>
                                    <?php } else {
                                        ?>
                                        <span class="fa fa-star"></span>
                                        <?php
                                    }
                                    if ($hello > 1) {
                                        $hello = $hello - 1;
                                    } else {
                                        $hello = 10;
                                    }
                                    ?>

                                <?php } ?> Rating:<?php echo $rating; ?>/5 <br><br>
                                <b>Author: </b><?php echo $author; ?> <br><br> <b>Price: </b>$<?php echo $price; ?> <br><br>
                                <b>Quantity:</b><?php echo $quantity; ?> books left <br><br>

                            </td>

                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
            }
        }
        ?>
    </body>
    <?php include("include/footer.php"); ?>
</html>