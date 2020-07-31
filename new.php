<?php include "inc/include.php";
if(!isset($_USER)) die(header("Location: /login"));
if($_USER["verified"] == 0) {
    include "inc/unverified.php";
    die();
}
$notes = $db->getNotes($_USER["id"]);
if(isset($_POST[$_SESSION["CSRF"]])) {
    $name = $_POST["name"];
    $content = $_POST["content"];
    $res = $db->addNote($_USER["id"], $name, $content);
    if($res === true) {
        $succ = "Successfully added note.";
    } else {
        $err = $res;
    }
}
?><!DOCTYPE html>
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
                        <h1>Add note</h1>
                        <p class="lead">You have <?=count($notes)?> notes!</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="section clearfix">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Add note</h2>
                        <form method="post">
                            <span>Name</span>
                            <input type="text" class="form-control" placeholder="Note #89367930" name="name">
                            <span>Content</span>
                            <textarea type="text" class="form-control" placeholder="Lorem ipsum dolor sit amet." name="content" rows="10" maxlength="16777215" style="resize: none;" onkeyup="this.onchange()" onkeydown="this.onchange()" onchange="$('#len').html(this.value.length)"></textarea>
                            <p class="text-muted" style="float: right;margin-top: -24px;margin-right: 4px;"><span id="len">0</span>/16777215</p>
                            <input type="hidden" name="<?=$_SESSION["CSRF"]?>">
                            <br>
<?php if(isset($succ) && !empty($succ)) { ?>
                            <p class="text-success"><?=$succ?></p>
<?php } else if(isset($err) && !empty($err)) { ?>
                            <p class="text-danger"><?=$err?></p>
<?php } ?>
                            <button class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <br>
<?php include "inc/footer.php"; ?>
    </body>
</html>