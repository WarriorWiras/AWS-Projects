<?php
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
        input, select, textarea {
            width: 100%; /* Full width */
            padding: 10px; /* Some padding */ 
            border: 1px solid lightgrey; /* Gray border */
            border-radius: 5px; /* Rounded borders */
            box-sizing: border-box; /* Make sure that padding and width stays in place */
            margin-bottom: 16px; /* Bottom margin */
        }

        input[type=submit] {
            background-color: white;
            color: black;
            width: 110px;
        }

        h1, h3 {
            text-align: center;
        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .EditBooks{
            text-align: center;
            color: black;
        }
        .EditBooks{
            background: #B9DFFF;

            color: #fff;

            border: 1px solid #eee;

            border-radius: 20px;

            box-shadow: 5px 5px 5px #eee;

            text-shadow:none;

            text-align: center;

            color: black;

            width: 200px;  
            margin:  0px auto;
        }
        .EditBooks:hover{
            background: #016ABC;

            color: #fff;

            border: 1px solid #eee;

            border-radius: 20px;

            box-shadow: 5px 5px 5px #eee;

            text-shadow:none;
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
                    <h1>QaZiWa Bookshop - Edit Books</h1>
                    </br></br>
                </div>
                <?php
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

                ////$query2 = "SELECT * from Books";
                // $result2 = mysqli_query($link, $query2) or die(mysqli_error($link));

                while ($row2 = $stmt->fetch()) {
                    $arrProducts[] = $row2;
                }



                // mysqli_close($link);
                ?>
                <div class="topnav">
                    <a class="active" href="AdminList.php">&#8592; Back</a>
                    <p><b>You are login as Admin - This is a Edit page</b></p>
                </div>
                <table class='productTable'>
                    <?php
                    for ($i = 0; $i < count($arrProducts); $i++) {
                        $title_id = $arrProducts[$i]['title_id'];
                        $title = $arrProducts[$i]['title'];
                        $author = $arrProducts[$i]['author'];
                        $summary = $arrProducts[$i]['summary'];
                        $rating = $arrProducts[$i]['rating'];
                        $price = $arrProducts[$i]['price'];
                        $quantity = $arrProducts[$i]['quantity'];
                        $pictures = $arrProducts[$i]['picture_front'];
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
                                <div class="EditBooks"><a style="text-decoration: none" href="doEditBooks.php?title_id=<?php echo $title_id; ?>">Click here to Edit</a></div>
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

