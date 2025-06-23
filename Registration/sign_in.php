<?php ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - STII </title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="shortcut icon" href="assets/images/s.png" >
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="auth" style="background-image: url('assets/images/stii.jpg'); background-size: cover; background-position: center;">
        
        <div class="col-lg-12">
            <div class="container" >
                        <div class="row">
                            <div class="col-md-5 col-sm-5 mx-auto">
                                <div class="card pt-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center mb-5">
                                                    <img src="assets/images/s.png" height="120" class='mb-4'>
                                                    <h3>Sign In As Registrar</h3>
                                                    <p>Please sign in to continue to STII Registration.</p>
                                                </div>
                                                <form action="sign_in_functions.php" method="post">
                                                    <div class="form-group position-relative has-icon-left">
                                                        <label for="username">Username</label>
                                                        <div class="position-relative">
                                                            <input type="text" class="form-control" id="username" name="username" required>
                                                            <div class="form-control-icon">
                                                                <i data-feather="user"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group position-relative has-icon-left">
                                                        <div class="clearfix">
                                                            <label for="password">Password</label>
                                                        </div>
                                                        <div class="position-relative">
                                                            <input type="password" class="form-control" id="password" name="password" required>
                                                            <div class="form-control-icon">
                                                                <i data-feather="lock"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <center>
                                                        <button class="btn btn-primary" type="submit">Sign In</button>
                                                    </center>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>

    </div>
    <script src="assets/js/feather-icons/feather.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script src="assets/js/main.js"></script>
</body>

</html>
