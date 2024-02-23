<?php
session_start();
session_regenerate_id();
$msg = "";

//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

function RemoveSpecialChar($str) {

    // Using str_replace() function
    // to replace the word
    $res = str_replace(array('\'', '"',
        ',', ';', '<', '>'), ' ', $str);

    // Returning the result
    return $res;
}

//check whether session variable 'user_id' is set
//in other words, check whether the user is already logged in
if (isset($_POST['Login'])) {
    
    if (isset($_SESSION['user_id']) && isset($_SESSION['IS_LOGIN'])) {
        $msg = "You are already logged in.";
        header('Location: index.php');
    } else { //user is not logged in
        //check whether form input 'username' contains value
        if (isset($_POST['username'], $_POST['password'])) {

            //retrieve form data
            $entered_username = $_POST['username'];


            $entered_password = $_POST['password'];
            $entered_password = stripslashes($entered_password);
            $entered_password = RemoveSpecialChar($entered_password);
            $entered_password = md5($entered_password);


//connect to database
            include ("dbFunctions2.php");


            try {
                $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
                $stmt = $conn->prepare("SELECT user_id, email, md5password FROM users WHERE email= :email AND md5password = :password");
                $stmt->bindParam(":email", $entered_username);
                $stmt->bindParam(":password", $entered_password);


                $stmt->execute();
            } catch (Exception $ex) {
                echo "Error: " . $ex->getMessage();
            }
            $conn = null;


            $password = "";
            while ($row = $stmt->fetch()) {
                $userID = $row['user_id'];
                $password = $row['md5password'];
                $email = $row['email'];
            }

            /*
              //match the username and password entered with database record
              $query = "SELECT user_id, email, md5password FROM users
              WHERE email='$entered_username' AND
              md5password = MD5('$entered_password')";

              $result = mysqli_query($link, $query) or die(mysqli_error($link));
             * 
             */

            //if record is found, store id and username into session
            if ($entered_password == $password) {
                if ($userID > 0) {

                    $_SESSION['user_id'] = $userID;
                    $_SESSION['email'] = $email;

                    if($_SESSION['user_id'] == 2){
                        header('Location: index.php');
                        exit;
                    }
                    /*
                    $con = mysqli_connect('localhost', 'root', '', 'qaziwa');

                    $res = mysqli_query($con, "SELECT * FROM users WHERE email='$entered_username'");

                    $count = mysqli_num_rows($res);
                    $veri = 0;
                    if ($count > 0) {
                        $otp = rand(11111, 99999);
                        mysqli_query($con, "UPDATE users SET otp='$otp' WHERE email='$entered_username'");
                        $html = "Your OTP verification code is " . $otp;
                        $_SESSION['EMAIL'] = $entered_username;
                        $veri = 1;
                    } else {
                        echo "not_exist";
                    }

                    function smtp_mailer($to, $subject, $msg) {
                        require 'PHPMailer/src/Exception.php';
                        require 'PHPMailer/src/PHPMailer.php';
                        require 'PHPMailer/src/SMTP.php';
                        $mail = new PHPMailer();
                        $mail->isSMTP();
                        $mail->Mailer = "smtp";
                        $mail->SMTPDebug = 1;
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;
                        $mail->Host = "smtp.gmail.com";
                        $mail->Username = "<Gamil>";
                        $mail->Password = "<Password>";
                        $mail->isHTML(true);
                        $mail->SetFrom("<Gmail>");
                        $mail->Subject = $subject;
                        $mail->Body = $msg;
                        $mail->AddAddress("$to");
                        if (!$mail->Send()) {
                            return 0;
                        } else {
                            return 1;
                        }
                    }
                    */

                    //smtp_mailer($entered_username, 'OTP Verification', $html);

                    header("location: Verification.php");
                    exit;
                }
            } else { //record not found
                $msg = "Sorry, you must enter a valid username 
                    and password to log in. Click <a href=Login.php>here</a> to go back to login page";
                //Create one page to header location
            }
            //mysqli_close($link);
        }
    }
} elseif (isset($_POST['Guest'])) {
    header('Location: GuestList.php');
    exit();
} elseif (isset($_POST['Sign-up'])) {
    header("Location Register.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>QaZiWa Bookstore</title>
    </head>
    <header>
        <?php // include("include/navigation.php");            ?>
    </header>
    <body>
        </br></br>
        <h3>Qaziwa - Login</h3>
        <?php
        echo $msg;
        ?>
    </body>
    <?php include("include/footer.php"); ?>
</html>




