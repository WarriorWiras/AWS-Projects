<!DOCTYPE html>
<?php
$activePage = "AdminList";
session_start();
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="include/CSS.css" rel="stylesheet" type="text/css"/>
        <title>QaZiWa Bookshop - Delete</title>
    </head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        td{
            border-top: 3px solid black;

        }
        .checked {
            color: orange;
        }
        .delete{
            text-align: center;
        }

        body {font-family: Arial, Helvetica, sans-serif;}
        * {box-sizing: border-box;}

        /* Button used to open the contact form - fixed at the bottom of the page */
        .open-button {
            background-color: #555;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            opacity: 0.8;
            position: fixed;
            bottom: 23px;
            right: 28px;
            width: 280px;
        }

        /* The popup form - hidden by default */
        .form-popup {
            display: none;
            position: fixed;
            bottom: 0;
            right: 15px;
            border: 3px solid #f1f1f1;
            z-index: 9;
        }

        /* Add styles to the form container */
        .form-container {
            max-width: 300px;
            padding: 10px;
            background-color: white;
        }

        /* Full-width input fields */
        .form-container input[type=text], .form-container input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            border: none;
            background: #f1f1f1;
        }

        /* When the inputs get focus, do something */
        .form-container input[type=text]:focus, .form-container input[type=password]:focus {
            background-color: #ddd;
            outline: none;
        }

        /* Set a style for the submit/login button */
        .form-container .btn {
            background-color: #04AA6D;
            color: white;
            padding: 16px 20px;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-bottom:10px;
            opacity: 0.8;
        }

        /* Add a red background color to the cancel button */
        .form-container .cancel {
            background-color: red;
        }

        /* Add some hover effects to buttons */
        .form-container .btn:hover, .open-button:hover {
            opacity: 1;
        }
    </style>
    <body>

        <?php
        if (isset($_SESSION['user_id'])) {
            if ($_SESSION['user_id'] == 2) {
                ?>
                <div class="maincontent">
                    <h1>QaZiWa Bookshop - Delete Books</h1>
                    </br></br>
                </div>
                <?php
                include "dbFunctions2.php";

                try {
                    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $conn->prepare("SELECT * FROM books");

                    $stmt->execute();
                } catch (Exception $ex) {
                    echo "Error: " . $ex->getMessage();
                }
                $conn = null;

                //$query2 = "SELECT * from Books";
                //$result2 = mysqli_query($link, $query2) or die(mysqli_error($link));

                while ($row2 = $stmt->fetch()) {
                    $arrProducts[] = $row2;
                }



                //mysqli_close($link);
                ?>
                <div class="topnav">
                    <a class="active" href="AdminList.php">&#8592; Back</a>
                    <p><b>You are login as Admin - This is a deletion page</b></p>
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

                            </td>

                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <button class="open-button" onclick="openForm()">Click Here to Delete</button>
                <div class="form-popup" id="myForm">
                    <h1>Confirm Deletion?</h1>
                    <form method="post" action="doDelete.php" class="form-container">
                        <select id="title_id" name="title_id">
                            <?php for ($r = 0; $r < count($arrProducts); $r++) { ?>
                                <option value="<?php echo $arrProducts[$r]['title_id']; ?>">
                                    <?php echo $arrProducts[$r]['title']; ?>

                                </option>
                            <?php } ?>
                        </select>
                        <br><br>
                        <button type="submit" class="btn">Yes</button>
                        <button type="button" class="btn cancel" onclick="closeForm()">No</button>
                    </form>
                </div>
                <script>
                    function openForm() {
                        document.getElementById("myForm").style.display = "block";
                    }

                    function closeForm() {
                        document.getElementById("myForm").style.display = "none";
                    }
                </script>
                <?php
            }
        }
        ?>
    </body>
    <?php include("include/footer.php"); ?>
</html>
