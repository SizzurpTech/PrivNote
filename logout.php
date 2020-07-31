<?php include "inc/include.php";
session_unset();
session_destroy();
die(header("Location: /login"));
?>