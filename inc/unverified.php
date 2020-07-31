<?php if(!isset($_USER)) die("Location: /login"); ?><!DOCTYPE html>
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
                        <h1>Unverified</h1>
                        <p class="lead">Please verify your email before continuing.</p>
						<br>
						<p>Didn't receive the email?</p>
						<form action="/resend" method="POST">
							<input type="hidden" name="<?=$_SESSION["CSRF"]?>">
							<button class="btn btn-primary">Resend</button>
						</form>
                    </div>
                </div>
            </div>
            <hr>
<?php include "inc/footer.php"; ?>
    </body>
</html>