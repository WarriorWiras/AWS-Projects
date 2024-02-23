<!DOCTYPE html>
<?php
$activePage = "UserList";
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
        .container {
            background-color: #000;
            padding: 5px;
            width: 200px;
            position: relative;
            left: 1300px;
            bottom: 57px;
        }

        .cart {
            background-image: url('WebDesign/C300_Cart.jpg');
            background-size: contain;
            background-repeat: no-repeat;
            background-color: darkgreen;
            width: 50px;
            height: 50px;
            border: 1px solid #fff;
            outline: 3px solid #8174f7;
            position: absolute ;
            right:8px;
            top:8px;
        }

        .badge {
            position: absolute;
            left: -15px;
            bottom: -15px;
            font-weight: 700;
            font-family: sans-serif;
            font-size: 20px;
            color: white;
            background-color: green;
            border: 2px solid #fff;
            padding: 3px;
            width: 20px;
            height: 30px;
            text-align: center;
        }

        .badge:empty {
            display: none;
        }

        .content {
            background-color: white;
            color: #000;
            padding:8px;
            text-align:center;
            margin-top:62px;
        }

        .red {
            color: red;
        }
    </style>
    <header>
        <?php // include("include/navigation.php");?>
    </header>
    <body>
        <?php
        $userID00 = $_SESSION['user_id'];
        
        include ("dbFunctions2.php");
        
        try{
            $conn00 = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            $conn00->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt00 = $conn00->prepare("SELECT user_id FROM users WHERE user_id= :userID");
                $stmt00->bindParam(":userID", $userID00);

                $stmt00->execute();
            
        } catch (Exception $ex00) {
            echo "Error: " . $ex00->getMessage();
        }
        $conn00 = null;
        
        while($row00 = $stmt00->fetch()){
            $userID000 = $row00['user_id'];
        }
        
        if ($userID000 > 0){
            $_SESSION['user_id2'] = $userID000;
        }
        
        if ($_SESSION['user_id'] == $_SESSION['user_id2'] && isset($_SESSION['IS_LOGIN'])) {
            include ("dbFunctions2.php");
            $userID = $_SESSION['user_id'];

            try {
                $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $conn->prepare("SELECT * FROM cart_books WHERE user_id= :userID");
                $stmt->bindParam(":userID", $userID);

                $stmt->execute();
            } catch (Exception $ex) {
                echo "Error: " . $ex->getMessage();
            }
            $conn = null;

            //$callingQuery = "SELECT * from cart_books WHERE user_id='$userID'";
            //$cartlabel = mysqli_query($link, $callingQuery) or die(mysqli_error($link));

            $arrCart[] = "";
            while ($row1 = $stmt->fetch()) {
                $arrCart[] = $row1;
            }



            $totalCart = -1;

            for ($z = 0; $z < count($arrCart); $z++) {
                $totalCart = $totalCart + 1;
            }





            //mysqli_close($link);
            ?>
            <div class="maincontent">
                <h1>Welcome to QaZiWa Bookshop - User Login</h1>
                <div class="container">
                    <div class='cart'>
                        <span class="badge"><?php echo $totalCart ?></span>
                    </div>
                    <div class="content">
                        <span class="red">Click <a href=Cart.php>here</a> to view Cart </span>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if ($_SESSION['user_id'] == $_SESSION['user_id2'] && isset($_SESSION['IS_LOGIN'])) { ?>
            <?php
            include ("FTPDownload.php");
            include("dbFunctions2.php");

            try {
                $conn2 = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
                $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt2 = $conn2->prepare("SELECT * FROM books");

                $stmt2->execute();
            } catch (Exception $ex) {
                echo "Error: " . $ex->getMessage();
            }
            $conn2 = null;

            //$query2 = "SELECT * FROM books";
            // To secure, use mysqli_escape_string or prepared statements
            //$result2 = mysqli_query($link, $query2) or die(mysqli_error($link));

            while ($row2 = $stmt2->fetch()) {
                $arrProducts[] = $row2;
            }



            //mysqli_close($link);
            ?>
            <?php
            $userID = $_SESSION['user_id'];
            include("dbFunctions2.php");

            try {
                $conn3 = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
                $conn3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt3 = $conn3->prepare("SELECT * FROM users WHERE user_id = :userID");
                $stmt3->bindParam(":userID", $userID);

                $stmt3->execute();
            } catch (Exception $ex) {
                echo "Error: " . $ex->getMessage();
            }
            $conn3 = null;

            //$query = "SELECT * FROM users WHERE user_id='$userID'";
            //$result = mysqli_query($link, $query) or die(mysqli_error($link));

            while ($row3 = $stmt3->fetch()) {
                $arrUser[] = $row3;
            }

            $first_name = "";
            $last_name = "";
            for ($j = 0; $j < count($arrUser); $j++) {
                $first_name = $arrUser[$j]['first_name'];
                $last_name = $arrUser[$j]['last_name'];
            }
            ?>

            <div class="topnav">
                <a class="active" href="logoff.php">Logoff</a>
                <div class="login-container">
                    <p><b>Welcome <u><?php
                                echo $first_name;
                                echo ' ';
                                echo $last_name;
                                ?></u> to QaZiWa Bookstore</b></p>
                </div>
            </div>
            <table class='productTable'>
                <?php
                for ($i = 0; $i < count($arrProducts); $i++) {
                    $id = $arrProducts[$i]['title_id'];
                    $title = $arrProducts[$i]['title'];
                    $author = $arrProducts[$i]['author'];
                    $summary = $arrProducts[$i]['summary'];
                    $rating = $arrProducts[$i]['rating'];
                    $price = $arrProducts[$i]['price'];
                    $quantity = $arrProducts[$i]['quantity'];
                    $pictures = $arrProducts[$i]['picture_front'];
                    if ($quantity > 0) {
                        ?>
                        <tr>
                            <td><img src = "Pictures/<?php echo $pictures; ?>" width="200"/></td>
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
                                <form action="doAddToCard.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $id ?>"/>
                                    <input type="submit" value="Add to Cart"/>
                                </form>

                            </td>

                        </tr>
                        <?php
                    }
                }
                ?>
            </table>
        <?php } ?>
    </body>
    <?php include("include/footer.php"); ?>
</html>