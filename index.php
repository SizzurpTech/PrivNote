<?php include "inc/include.php"; ?>
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
                        <h1>PrivNote - Private Note Storage</h1>
                        <p class="lead">Best note storage with strong <b>military-grade</b> encryption!</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="section clearfix">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Try it live</h2>
                        <form onsubmit="$('#code').load('crypto?q='+encodeURIComponent($('#note').val().substr(0, 15))); return false;">
                            <input type="text" class="form-control" maxlength="15" placeholder="Note" id="note" style="width: calc(100% - 105px);float: left;">
                            <button class="btn btn-primary" style="float: right;">Submit</button>
                        </form>
                        <br>
                        <br>
                        <pre class="line-numbers" id="code"><?php $_GET["q"] = "Note"; include "crypto.php"; ?></pre>
                    </div>
                </div>
            </div>
            <hr>
            <div class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Features</h2>
                        <div class="row"> 
                            <div class="col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><i class="fa fa-bolt"></i> Fast.</h4>
                                        <p class="card-text">Since our servers are running on cutting-edge hardware encryption is not only secure but lightning fast.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><i class="fa fa-lock"></i> Secure.</h4>
                                        <p class="card-text">PrivNote uses <b>military-grade</b> encryption (AES-256-CBC) to keep your data safe and secure.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><i class="fa fa-clock"></i> Reliable.</h4>
                                        <p class="card-text">We offer a <b>99.99%</b> uptime guarantee to make sure you can access your data whenever and wherever you want.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row"> 
                            <div class="col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><i class="fab fa-github"></i> Open Source.</h4>
                                        <p class="card-text">Since our service is open-source you can trust us when we say there are no backdoors that lets anyone but you access your data.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><i class="fa fa-edit"></i> Simple.</h4>
                                        <p class="card-text">Creating secure notes has never been easier. Just click your name in the top-right and click "New Note" and you're good to go!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><i class="fa fa-laptop"></i> Private.</h4>
                                        <p class="card-text">PrivNote does not have ANY analytics or ads to provide the best and smoothest user experience. All files are hosted locally.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <hr>
            <div class="section">
                <div class="row">
                    <div class="col-lg-12">
                        <h2>Testimonials</h2>
                        <div class="row"> 
                            <div class="col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <img src="img/face1.png" class="face">
                                            <span><i><q>Really nice and simple to use.</q></i><br> - Kyle Porter</span><br>
                                            <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <img src="img/face2.png" class="face">
                                            <span><i><q>Nice job, I like it a lot.</q></i><br> - Chloe Castillo</span><br>
                                            <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-muted"></i><i class="fa fa-star text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <img src="img/face3.png" class="face">
                                            <span><i><q>Simple and secure. Great job!</q></i><br> - Charles Morris</span><br>
                                            <i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-muted"></i><i class="fa fa-star text-muted"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
<?php include "inc/footer.php"; ?>
    </body>
</html>