<?php include "inc/include.php";
$links = false;

$code = http_response_code();
$codes = array(
    403 => array(
        "title" => "Access denied.",
        "message" => "You don't have permission to access the requested object.",
    ),
    404 => array(
        "title" => "Not found.",
        "message" => "The requested URL was not found on this server.",
    ),
    500 => array(
        "title" => "Server error.",
        "message" => "The server has encountered an error.<br>Please contact the owner at <a href=\"mailto:lilsizzurp@pm.me\">lilsizzurp@pm.me</a>",
    ),
);
$error = $codes[$code];
?><!DOCTYPE html>
<html lang="en">
    <head>
<?php include "inc/head.php"; ?>
        <title><?=$error["title"]?></title>
    </head>
    <body>
<?php include "inc/header.php"; ?>
        <div class="container">
            <div class="page-header" id="banner">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-sm-6">
                        <h1>PrivNote - <?=$error["title"]?></h1>
                        <p class="lead"><?=$error["message"]?></p>
                    </div>
                </div>
            </div>
<?php include "inc/footer.php"; ?>
    </body>
</html>