<?php

function RemoveSpecialChar($str) {

    // Using str_replace() function
    // to replace the word
    $res = str_replace(array('\'', '"',
        ',', ';', '<', '>'), ' ', $str);

    // Returning the result
    return $res;
}

include "dbFunctions2.php";

$fname = $_POST['fname'];
$fname = stripslashes($fname);
$fname = RemoveSpecialChar($fname);


$lname = $_POST['lname'];
$lname = stripslashes($lname);
$lname = RemoveSpecialChar($lname);


$emailaddr = $_POST['emailaddr'];
$emailaddr = stripslashes($emailaddr);
$emailaddr = RemoveSpecialChar($emailaddr);

$pw = $_POST['psw'];
$pw = stripslashes($pw);
$pw = RemoveSpecialChar($pw);
$pw = md5($pw);



$msg = "";

try {
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO users(first_name, last_name, email, md5password) VALUES(:fname, :lname, :emailaddr, :pw)");
    $stmt->bindParam(":fname", $fname);
    $stmt->bindParam(":lname", $lname);
    $stmt->bindParam(":emailaddr", $emailaddr);
    $stmt->bindParam(":pw", $pw);

    $stmt->execute();
} catch (Exception $ex) {
    echo "Error: " . $ex->getMessage();
}
$conn = null;


//$queryInsert = "INSERT INTO users (first_name, last_name, email, md5password) VALUES('$fname', '$lname', '$emailaddr', MD5('$pw'))";
//$result = mysqli_query($link, $queryInsert);


if ($stmt) {
    $msg = "<p>Your account was created successfully.
        You can return to <a href='Login.php'>Homepage</a>.</p>";
} else {
    $msg = "<p>Your account creation was unsucessful.
            Please try again. Click <a href=Login.php>Here</a> to go back to Login page</p>";
}
// mysqli_close($link);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>QaZiWa Bookstore Registration</title>
    <h2>Account Registration</h2>
</head>
<body>
    <h3>QaZiWa - Register</h3>
    <?php
    echo $msg;
    ?>
</body>
</html>
