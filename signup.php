<?php include "inc/include.php";
$captcha = true;
$username = "";
$email = "";
$password_1 = "";
$password_2 = "";

if(isset($_USER)) die(header("Location: /dash"));

if(isset($_POST[$_SESSION["CSRF"]])) {
    if($_POST["password_1"] != $_POST["password_2"])
        $perror = "Passwords do not match.";
    
    $success = $db->addUser($_POST["username"], $_POST["email"], $_POST["password_1"]);

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password_1 = $_POST["password_1"];
    $password_2 = $_POST["password_2"];

    if($success === true) {
        $succ = "Registered successfully!";
        $to = $email;
        $subject = 'PrivNote | Verification';
        $code = $db->getUserN($_POST["username"])[0]["emailcode"];

        $site = sprintf("%s://%s/",isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',$_SERVER['SERVER_NAME']);

        $message = sprintf(file_get_contents("inc/mail.html"), $username, $site, $code);

        $headers = array();
		$headers[] = "From: PrivNote <noreply@privnote.tech>";
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-Type: text/html; charset=ISO-8859-1";
        
        mail($to, $subject, $message, join("\r\n", $headers), "-fnoreply@privnote.tech");
    } else {
        switch($success[0]) {
            case "u":
                $uerror = substr($success, 1);
                break;
            case "e":
                $eerror = substr($success, 1);
                break;
            case "p":
                $perror = substr($success, 1);
                break;
            default:
                $err = $success;
                break;
        }
    }
}
?><!DOCTYPE html>
<html lang="en">
    <head>
<?php include "inc/head.php"; ?>
        <title>PrivNote - Sign Up</title>
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
                                    <span>Username</span>
                                    <input class="form-control<?=(isset($uerror)) ? " is-invalid" : "" ?>" type="text" name="username" value="<?=$username?>">
<?php if(isset($uerror)) { ?>
                                    <div class="invalid-feedback"><?=$uerror?></div>
<?php } ?>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <span>Email</span>
                                    <input class="form-control<?=(isset($eerror)) ? " is-invalid" : "" ?>" type="email" name="email" value="<?=$email?>">
<?php if(isset($eerror)) { ?>
                                    <div class="invalid-feedback"><?=$eerror?></div>
<?php } ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <span>Password</span>
                                    <input class="form-control<?=(isset($perror)) ? " is-invalid" : "" ?>" type="password" name="password_1" value="<?=$password_1?>">
<?php if(isset($perror)) { ?>
                                    <div class="invalid-feedback"><?=$perror?></div>
<?php } ?>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <span>Confirm Password</span>
                                    <input class="form-control<?=(isset($perror)) ? " is-invalid" : "" ?>" type="password" name="password_2" value="<?=$password_2?>">
<?php if(isset($perror)) { ?>
                                    <div class="invalid-feedback"><?=$perror?></div>
<?php } ?>
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Register</button>
                            <input type="hidden" name="<?=$_SESSION["CSRF"]?>">
                            <br>
<?php if(isset($succ) && !empty($succ)) { ?>
                            <p class="text-success"><?=$succ?></p>
<?php } else if(isset($err) && !empty($err)) { ?>
                            <p class="text-danger"><?=$err?></p>
<?php } ?>
                            <p>Already a member? <a href="/login">Sign in</a></p>
                        </form>
                    </div>
                </div>
            </div>
<?php include "inc/footer.php"; ?>
    </body>
</html>