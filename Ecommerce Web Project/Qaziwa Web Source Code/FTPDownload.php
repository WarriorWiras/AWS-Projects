<?php

include("dbFunctions2.php");
$ftp_host = "10.0.2.231";
$ftp_username = "Qaziwa";
$ftp_password = "Password";

// open an FTP connection
$conn_id = ftp_connect($ftp_host) or die("Couldn't connect to $ftp_host");

// login to FTP server
$ftp_login = ftp_login($conn_id, $ftp_username, $ftp_password);

try {
    $conn99 = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $conn99->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt99 = $conn99->prepare("SELECT * FROM books");

    $stmt99->execute();
} catch (Exception $ex) {
    echo "Error: " . $ex->getMessage();
}
$conn99 = null;

//$query2 = "SELECT * FROM books";
// To secure, use mysqli_escape_string or prepared statements
//$result2 = mysqli_query($link, $query2) or die(mysqli_error($link));

while ($row99 = $stmt99->fetch()) {
    $arrProducts99[] = $row99;
}
for ($i = 0; $i < count($arrProducts99); $i++) {
    // $title = $arrProducts[$i]['title'];
    // $author = $arrProducts[$i]['author'];
    //$summary = $arrProducts[$i]['summary'];
    // $rating = $arrProducts[$i]['rating'];
    // $price = $arrProducts[$i]['price'];
    //   $quantity = $arrProducts[$i]['quantity'];
    $pictures99 = $arrProducts99[$i]['picture_front'];
    $localFilePath = "/var/www/html/Pictures/$pictures99";
    $remoteFilePath = "files/$pictures99";

// try to upload file
    if (ftp_get($conn_id, $localFilePath, $remoteFilePath, FTP_BINARY)) {
        echo "File transfer successful - $localFilePath";
    } else {
        echo "There was an error while uploading $localFilePath";
    }
}
ftp_close($conn_id);
?>