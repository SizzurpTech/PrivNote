        <div class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
            <div class="container">
                <a href="../" class="navbar-brand">Privnote</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav mr-auto">
<?php if(!isset($links) || $links) { ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://github.com/PrivNote/">GitHub</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
<?php if(!isset($_USER)) { ?>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> Guest</a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="signup" class="dropdown-item"><i class="fa fa-user-plus"></i> Sign Up</a>
                                <a href="login" class="dropdown-item"><i class="fa fa-sign-in"></i> Log In</a>
                            </div>
                        </li>
<?php } else { ?>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$_USER["username"]?></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="dash" class="dropdown-item"><i class="fa fa-home"></i> Dashboard</a>
                                <a href="new" class="dropdown-item"><i class="fa fa-edit"></i> New Note</a>
                                <div class="dropdown-divider"></div>
                                <a href="logout" class="dropdown-item"><i class="fa fa-sign-out"></i> Log Out</a>
                            </div>
                        </li>
<?php } ?>
<?php } else { ?> 
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
<?php } ?>
                    </ul>
                </div>
            </div>
        </div>
