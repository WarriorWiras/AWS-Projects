<?php

declare(strict_types = 1);
require 'vendor/autoload.php';
require 'Authenticator.php';
$Authenticator = new Authenticator();
//$secret = 'XVQ2UIGO75XRUKJO';
session_start();

if (isset($_SESSION['user_id'])) {
    if (!isset($_SESSION['IS_LOGIN'])) {
        if (isset($_POST['otp'])) {
            $code = $_POST['otp'];
            $otp = rand(11111, 99999);
            //$g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
            $g = $Authenticator->verifyCode($_SESSION['auth_secret'], $code, 2); //2 = 2*30 sec clock tolerance
            $var = 0;
// echo $g->getCode($secret);
            if ($g) {
                $_SESSION['IS_LOGIN'] = $otp;
                $var = 1;
            } else {
                echo "You have key in the wrong OTP number, do click <a href=Verification.php>here</a>to reenter OTP again";
            }
            if ($var == 1) {
                header('Location: index.php');
                exit;
            }
        } else {
            header("Location: Verification.php");
        }
    }
} else {
    header("Location: Login.php");
}
if (isset($_SESSION['IS_LOGIN']) && $_SESSION['user_id']) {
    header('Location: index.php');
}
?>