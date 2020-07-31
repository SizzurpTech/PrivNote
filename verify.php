<?php include "inc/include.php";
if(!isset($_GET["hash"])) die(header("Location: /"));
$r = $db->verifyUser($_GET["hash"]);
$msg = array(
    "Invalid hash.",
    "Already verified.",
    "Verified successfully!"
);
?><!DOCTYPE html>
<html lang="en">
    <head>
<?php include "inc/head.php"; ?>
        <title>PrivNote - Verify Email</title>
    </head>
    <body>
<?php include "inc/header.php"; ?>
        <div class="container">
            <div class="page-header" id="banner">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-sm-6">
                        <h1>PrivNote - Verify Email</h1>
                        <p class="lead"><?=$msg[$r]?></p>
						<button onclick="location.href='/dash'">Dashboard</button>
                    </div>
                </div>
            </div>
<?php include "inc/footer.php"; ?>
    </body>
</html>