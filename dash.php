<?php include "inc/include.php";
if(!isset($_USER)) die(header("Location: /login"));
if($_USER["verified"] == 0) {
    include "inc/unverified.php";
    die();
}
$notes = $db->getNotes($_USER["id"]); ?>
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
                        <h1>Dashboard</h1>
                        <p class="lead">You have <?=count($notes)?> notes!</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="section clearfix">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>My Notes</h2>
                        <div class="row">
<?php $i = 0; foreach($notes as $note) { $i++; ?>
                            <div style="display: flex; padding: 15px;">
                                <div class="card" style="width: 250px">
                                    <div class="card-body">
                                        <h4 class="card-title" style="height: 1.5rem; width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?=$note["name"]?></h4>
                                        <div class="card-text">
                                            <button class="btn btn-primary" onclick="window.open(location.origin + '/view?i=<?=$note["id"]?>')">View</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
<?php } ?>
                        </div>
						<button onclick="window.open('/new')" class="btn btn-primary">New note</button>
                    </div>
                </div>
            </div>
<?php include "inc/footer.php"; ?>
    </body>
</html>