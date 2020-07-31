<?php include "inc/include.php";

if(!isset($_USER)) die(header("Location: /dash"));

if(isset($_POST[$_SESSION["CSRF"]]) && !$_USER["verified"]) {
    $to = $_USER["email"];
    $subject = 'PrivNote | Verification';
    $code = $_USER["emailcode"];

    $site = sprintf("%s://%s/",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['SERVER_NAME']);

    $message = sprintf(file_get_contents("inc/mail.html"), $_USER["username"], $site, $code);

    $headers = array();
    $headers[] = "From: PrivNote <noreply@privnote.tech>";
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-Type: text/html; charset=ISO-8859-1";

    mail($to, $subject, $message, join("\r\n", $headers), "-fnoreply@privnote.tech");
} else die(header("Location: /dash"));
?>