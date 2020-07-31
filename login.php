<?php include "inc/include.php";
$captcha = true;
$username = "";
$password = "";

if(isset($_USER)) die(header("Location: /dash"));

if(isset($_POST[$_SESSION["CSRF"]])) {
    $success = $db->authUser($_POST["username"], $_POST["password"]);

    $username = $_POST["username"];
    $password = $_POST["password"];

    if($success[0] === true) {
        $_SESSION["u"] = json_decode(json_encode($success[1]), true);
        die(header("Location: /dash"));
    } else {
        switch($success[1][0]) {
            case "u":
                $uerror = substr($success[1], 1);
                break;
            case "p":
                $perror = substr($success[1], 1);
                break;
            default:
                $err = $success[1];
                break;
        }
    }
}
?><!DOCTYPE html>
<html lang="en">
    <head>
<?php include "inc/head.php"; ?>
        <title>PrivNote - Log In</title>
    </head>
    <body>
<?php include "inc/header.php"; ?>
        <div class="container">
            <div class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post">
                            <div class="row"> 
                                <div class="col-md-4 col-sm-6">
                                    <span>Username / Email</span>
                                    <input class="form-control<?=(isset($uerror)) ? " is-invalid" : "" ?>" type="text" name="username" value="<?=$username?>">
<?php if(isset($uerror)) { ?>
                                    <div class="invalid-feedback"><?=$uerror?></div>
<?php } ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <span>Password</span>
                                    <input class="form-control<?=(isset($perror)) ? " is-invalid" : "" ?>" type="password" name="password" value="<?=$password?>">
<?php if(isset($perror)) { ?>
                                    <div class="invalid-feedback"><?=$perror?></div>
<?php } ?>
                                </div>
                            </div>
                            <br>
                            <input type="hidden" name="<?=$_SESSION["CSRF"]?>">
                            <button type="submit" class="btn btn-primary">Log In</button>
                            <br>
<?php if(isset($succ) && !empty($succ)) { ?>
                            <p class="text-success"><?=$succ?></p>
<?php } else if(isset($err) && !empty($err)) { ?>
                            <p class="text-danger"><?=$err?></p>
<?php } ?>
                            <p>Not a member? <a href="/signup">Register</a></p>
                        </form>
                    </div>
                </div>
            </div>
<?php include "inc/footer.php"; ?>
    </body>
</html>