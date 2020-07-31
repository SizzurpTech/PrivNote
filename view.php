<?php include "inc/include.php";
if(!isset($_USER)) die(header("Location: /login"));
if($_USER["verified"] == 0) {
    include "inc/unverified.php";
    die();
}
$notes = $db->getNotes($_USER["id"]);
if(!isset($_GET["i"])) die(header("Location: /dash"));
$note = $db->getNote($_USER["id"], intval($_GET["i"]));
if($note == null) die(header("Location: /dash"));
?>
<!DOCTYPE html>
<html lang="en">
    <head>
<?php include "inc/head.php"; ?>
        <title>PrivNote</title>
    </head>
    <body>
<?php include "inc/header.php"; ?>
        <div class="container">
            <div class="page-header" id="banner">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-sm-6">
                        <h1>View note</h1>
                        <p class="lead">You have <?=count($notes)?> notes!</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="section clearfix">
                <div class="row">
                    <div class="col-lg-12">
<?php if($note == null) { ?>
                        <h2>Invalid note.</h2>
                        <p>This note has either been deleted, isn't owned by you or doesn't exist.</p>
<?php } else { ?>
                        <h2><?=$note["name"]?></h2>
                        <textarea type="text" class="form-control" name="content" rows="10" style="resize: none;" readonly><?=$note["content"]?></textarea>
                        
<?php } ?>
                    </div>
                </div>
            </div>
            <hr>
            <br>
<?php include "inc/footer.php"; ?>
    </body>
</html>