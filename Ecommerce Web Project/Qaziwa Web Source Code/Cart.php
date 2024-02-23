<?php
$activePage = "Cart";
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="include/CSS.css" rel="stylesheet" type="text/css"/>
        <title>QaZiWa Bookshop</title>
    </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="include/CSS.css" rel="stylesheet" type="text/css"/>
    <style>
        *{
            box-sizing: border-box;
        }
        .row{
            margin-left:-5px;
            margin-right:-5px;
        }
        .column {
            float: left;
            width: 50%;
            padding: 5px;
        }


        /* Clearfix (clear floats) */
        .row::after {
            content: "";
            clear: both;
            display: table;
        }
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        td, th{
            border-top: 3px solid black;
            padding: 16px;

        }


        #shot{
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 677px;
            cursor: pointer;

        }
        #shot2 {
            width: 100%;
            background-color: #3366ff;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #shot2:hover {
            background-color: #668cff;
        }
        .center{
            position: absolute; 
            margin-left: 550px;
        }
    </style>
    <header>

    </header>
    <?php
    if ($_SESSION['user_id'] == $_SESSION['user_id2'] && isset($_SESSION['IS_LOGIN'])) {
        include ("dbFunctions2.php");
        $userID = $_SESSION['user_id'];


        try {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt = $conn->prepare("SELECT * FROM cart_books WHERE user_id= :userID");
            $stmt->bindParam(":userID", $userID);
            
            $stmt ->execute();
        } catch (Exception $ex) {
            echo "Error: " . $ex->getMessage();
        }
        $conn = null;

        //$callingQuery = "SELECT * from cart_books WHERE user_id='$userID'";

        //$cartlabel = mysqli_query($link, $callingQuery) or die(mysqli_error($link));
        while ($row1 = $stmt->fetch()) {
            $arrCart[] = $row1;
        }

        //mysqli_close($link);
        ?>
        <body>


            <div class="maincontent">
                <h1>QaZiWa Bookshop - View Cart</h1>
                </br></br>
            </div>
            <div class="topnav">
                <a class="active" href="UserList.php">&#8592; Back</a>
                <p><b>Missing something? Press back</b></p>
                <div class="login-container">

                </div>
            </div>
            <div class="row">
                <div class="column">
                    <table>


                        <?php if (!empty($arrCart)) { ?>
                            <tr>
                                <th>
                                    Book Image
                                </th>
                                <th>
                                    Book Title
                                </th>
                                <th>
                                    Book Price
                                </th>
                                <th>
                                    Deletion Button
                                </th>
                            </tr>

                            <?php
                            for ($j = 0; $j < count($arrCart); $j++) {
                                $cartid = $arrCart[$j]['cart_id'];
                                $userid = $arrCart[$j]['user_id'];
                                $titleid = $arrCart[$j]['title_id'];
                                $carttitle = $arrCart[$j]['cart_title'];
                                $cartprice = $arrCart[$j]['cart_price'];
                                $cartpicture = $arrCart[$j]['cart_picture'];
                                ?>


                                <tr>
                                    <td><img src="Pictures/<?php echo $cartpicture; ?>" width="200"/></td>
                                    <td style="text-align: center; width: 300px"><?php echo $carttitle; ?> </td>
                                    <td style="text-align: center; width: 300px">$<?php echo $cartprice; ?></td>
                                    <td><form method="post" action="doCartDelete.php">
                                            <input type="hidden" name="titleID" value="<?php echo $titleid; ?>" />
                                            <input type="hidden" name="cartID" value="<?php echo $cartid; ?>"/>
                                            <input id="shot2" type="submit" value="Delete"/>
                                        </form></td>





                                </tr>
                            <?php } ?>


                        </table>
                    </div>
                    <div class="column">
                        <table>
                            <tr>
                                <th>
                                    Qaziwa Recommendations
                                </th>
                            </tr>

                            <tr>
                                <td><script src="advertisement.js" type="text/javascript"></script></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <form action="PaymentPage.php" method="post">
                    <input style="text-align: center" id="shot" type="submit" value="Confirm Payment">
                </form>
            </body>
            <?php include("include/footer.php"); ?>
            <?php
        } else {
            ?>

            <div class="center">
                <h3>Your card list is empty, please go back to fill your cart</h3>
            </div>
            <?php
        }
    }
    ?>
</html>