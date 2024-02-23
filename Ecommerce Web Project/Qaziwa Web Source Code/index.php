<!DOCTYPE html>

<?php
session_start();
$msg = "";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if (isset($_SESSION['user_id']) || isset($_SESSION['IS_LOGIN'])) {
            if ($_SESSION['user_id'] == 2) {
                header('Location: AdminList.php');
            } elseif (isset($_SESSION['user_id']) && isset($_SESSION['IS_LOGIN'])) {
                header('Location: UserList.php');
            } elseif (isset($_SESSION['user_id']) && !isset($_SESSION['IS_LOGIN'])) {
                header('Location: Verification.php');
            } else {
                header('Location: Login.php');
            }
        }
        else {
                header('Location: Login.php');
            }
        ?>

    </body>

</html>