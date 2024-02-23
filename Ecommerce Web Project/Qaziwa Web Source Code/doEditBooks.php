<?php
session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_id'] == 2) {
        include "dbFunctions2.php";

        $theID = $_GET['title_id'];

        try {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
            $stmt = $conn->prepare("SELECT * FROM books WHERE title_id= :titleID");
            $stmt->bindParam("titleID", $theID);

            $stmt->execute();
        } catch (Exception $ex) {

            echo "Error: " . $ex->getMessage();
        }
        $conn = null;

        //$query = "SELECT * FROM books WHERE title_id=$theID";
        //$result = mysqli_query($link, $query) or die(mysqli_error($link));
        $row = $stmt->fetch();

        if (!empty($row)) {
            $id = $row['title_id'];
            $title = $row['title'];
            $author = $row['author'];
            $summary = $row['summary'];
            $rating = $row['rating'];
            $price = $row['price'];
            $quantity = $row['quantity'];
        }
        ?>

        <html>
            <head>
                <meta charset="UTF-8">
                <link href="include/CSS.css" rel="stylesheet" type="text/css"/>
                <title>QaZiWa Bookshop</title>
            </head>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <style>
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
                .BackToLogin{
                    text-align: center;
                    color: black;
                }
                .BackToLogin{
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
                .BackToLogin:hover{
                    background: #016ABC;

                    color: #fff;

                    border: 1px solid #eee;

                    border-radius: 20px;

                    box-shadow: 5px 5px 5px #eee;

                    text-shadow:none;
                }
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
                if (!empty($id)) {
                    ?>
                    <h1>QaWaZi Bookshop - Edit Books</h1>
                    <div class="topnav">
                        <a class="active" href="EditBooks.php">Back</a>
                        <p><b>You are login as Admin - This is a Edit page</b></p>
                    </div>

                    <form action="doEditBooks2.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $id ?>"/>
                        <label for="titleID">Title:</label>
                        <input id="titleID" type="text" name="title" required/>
                        <br/><br/>

                        <label for="authorID">Author: </label>
                        <input id="authorID" type="text" name="author" required/>
                        <br/><br/>


                        <label for="summaryID">Summary: </label>
                        <textarea cols="40" rows="10" name="summary" maxlength="8000"><?php echo $summary ?></textarea>
                        <br/><br/>

                        <label for="ratingID">Rating: </label>
                        <input id="ratingID" type="number" name="rating" min="1" max="5" required/>

                        <label for="priceID">Price: </label>
                        <div><label>Amount $
                                <input id="priceID" type="number" placeholder="0.00" required name="price" min="0" value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" onblur="
                                        this.parentNode.parentNode.style.backgroundColor = /^\d+(?:\.\d{1,2})?$/.test(this.value) ? 'inherit' : 'red'
                                       "></label></div>

                        <label for="quantityID">Quantity: </label>
                        <input id="quantityID" type="number" name="quantity" min="1" max="50" required <?php echo $quantity; ?>/>


                        <input type="submit" value="Update"/>
                    </form>
                    <script>
                        document.getElementById('titleID').value = '<?php echo $title; ?>';
                        document.getElementById('authorID').value = '<?php echo $author; ?>';
                        document.getElementById('ratingID').value = '<?php echo $rating; ?>';
                        document.getElementById('priceID').value = '<?php echo $price; ?>';
                        document.getElementById('quantityID').value = '<?php echo $quantity; ?>';
                    </script>
                <?php } ?>
            </body>
            <?php include("include/footer.php"); ?>
        </html>
        <?php
    }
}?>