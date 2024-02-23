<?php
session_start();

if (isset($_SESSION['user_id'])) {
    if ($_SESSION['user_id'] == 2) {
        ?>

        <html>
            <head>
                <meta charset="UTF-8">
                <link href="include/CSS.css" rel="stylesheet" type="text/css"/>
                <title>QaZiWa BookShop</title>
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
                .AddBooks{
                    text-align: center;
                    color: black;
                }
                .AddBooks{
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
                .AddBooks:hover{
                    background: #016ABC;

                    color: #fff;

                    border: 1px solid #eee;

                    border-radius: 20px;

                    box-shadow: 5px 5px 5px #eee;

                    text-shadow:none;
                }


            </style>
            <body>
                <h1>QaWaZi Bookshop - Add Books</h1>
                <div class="topnav">
                    <a class="active" href="AdminList.php">&#8592; Back</a>
                    <p><b>You are login as Admin - This is a Add book page</b></p>
                </div>
                <form action="doAddBooks.php" method="post" enctype="multipart/form-data">
                    <br/>
                    <label for="titleID">Title:</label>
                    <input id="titleID" type="text" name="title" required/>
                    <br/><br/>

                    <label for="authorID">Author: </label>
                    <input id="auhourtID" type="text" name="author" required/>
                    <br/><br/>


                    <label for="idSummary">Summary: </label>
                    <input id="idSummary" type="text" name="summary" maxlength="8000" required/>
                    <br/><br/>

                    <label for="ratingID">Rating: </label>
                    <input id="idRating" type="number" name="rating" min="1" max="5" required/>

                    <label for="priceID">Price: </label>
                    <div><label>Amount $
                            <input type="number" placeholder="0.00" required name="price" min="0" value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" onblur="
                                    this.parentNode.parentNode.style.backgroundColor = /^\d+(?:\.\d{1,2})?$/.test(this.value) ? 'inherit' : 'red'
                                   "></label></div>

                    <label for="quantityID">Quantity: </label>
                    <input id="idQuantity" type="number" name="quantity" min="1" max="50" required/>


                    <label>Book Image (Front-view): </label>
                    <input type="file" name="picture_front"/>
                    <p><b>Do take note, do rename your file before submit. Thank you</b></p>
                    <p><b>**Note** only JPG image file is allowed</b></p>

                    <br/><br/>

                    <input type ="submit" value ="Add Books">


                </form>
            </body>
            <?php include("include/footer.php"); ?>
        </html>
        <?php
    }
}?>