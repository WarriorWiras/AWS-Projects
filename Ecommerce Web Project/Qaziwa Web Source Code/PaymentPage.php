<!DOCTYPE html>
<?php
$activePage = "PaymentPage";
session_start();
?>

<?php
if ($_SESSION['user_id'] == $_SESSION['user_id2'] && isset($_SESSION['IS_LOGIN'])) {

    include("dbFunctions2.php");
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
    while ($row1 = $stmt->fetch()) {
        $arrCart[] = $row1;
    }

    //mysqli_close($link);
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="include/CSS.css" rel="stylesheet" type="text/css"/>
    <style>
        td{
            border-top: 3px solid black;

        }
        .checked {
            color: orange;
        }
        input[type=submit]{
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 677px;
            cursor: pointer;

        }
    </style>
    <div class="topnav">
        <a class="active" href="Cart.php">&#8592; Back</a>
        <p><b>View Cart - Press back</b></p>
        <div class="login-container">

        </div>
    </div>
    <div class="row">
        <div class="col-50">
            <div class="container">
                <form action="/action_page.php">

                    <title>Payment</title>
                    <link href="include/payment.css" rel="stylesheet" type="text/css"/>

                    <div class="row">
                        <div class="col-50">
                            <h3>Billing Address</h3>
                            <label for="fname"> Full Name</label>
                            <input type="text" id="fname" name="firstname" placeholder="Andy Lau">
                            <label for="email"> Email Address</label>
                            <input type="text" id="email" name="email" placeholder="john@example.com">
                            <label for="addr"> Residential Address</label>
                            <input type="text" id="addr" name="address" placeholder="542 Hougang Ave 8">

                            <div class="row">
                                <div class="col-25">
                                    <label for="state">Unit Number</label>
                                    <input type="text" id="state" name="state" placeholder="#12-345">
                                </div>
                                <div class="col-25">
                                    <label for="zip">Postal Code</label>
                                    <input type="text" id="zip" name="zip" maxlength="6" placeholder="521147" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-50">
                            <h3>Payment</h3> 
                            <label for="cname">Name on Card</label>
                            <input type="text" id="cname" name="cardname" placeholder="Andy Lau Yan Boon">
                            <label for="ccnum">Credit card number</label>
                            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required>

                            <div class="row">
                                <div class="col-25">
                                    <label for="expmonth">Expiry Month/Year</label>
                                    <input type="text" id="expmonth" name="expmthyr" maxlength="5" placeholder="MM/YY">
                                </div>
                                <div class="col-25">
                                    <label for="cvv">CVV</label>
                                    <input type="password" id="cvv" name="cvv" maxlength="3" placeholder="711" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <label>
                        <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
                    </label><br/>
                    <a href="SuccessfulPayment.php" class="btn1">Continue to checkout</a>
                </form>
            </div>
        </div>


        <div class="col-25">
            <div class="container">
                <h4>Total Books</h4>
                <h4>Cart
                    <span class="price" style="color:black">
                        <i class="fa fa-shopping-cart"></i>
                        <b><?php echo count($arrCart); ?></b>
                    </span>
                </h4>
                <?php
                if (!empty($arrCart)) {
                    $k = 0;
                    for ($j = 0; $j < count($arrCart); $j++) {
                        $cartid = $arrCart[$j]['cart_id'];
                        $userid = $arrCart[$j]['user_id'];
                        $titleid = $arrCart[$j]['title_id'];
                        $carttitle = $arrCart[$j]['cart_title'];
                        $cartprice = $arrCart[$j]['cart_price'];
                        ?>
                        <p><a href="#"><?php echo $carttitle; ?></a> <span class="price">$<?php echo $cartprice; ?></span></p>
                        <hr>
                        <?php $k = $k + $cartprice; ?>
                    <?php } ?>
                    <p>Total <span class="price" style="color:black"><b>$<?php echo $k; ?></b></span></p>
                </div>
            </div>
        </div>
        <?php
    }
}
?>