<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in - STII NSTP CLEANING ATTENDANCE</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    
    <link rel="shortcut icon" href="assets/images/s.png" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body >
    <div id="auth" style="background-image: url('assets/images/stii.jpg'); background-size: cover; background-position: center;">
        
                <div class="col-lg-12">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 mx-auto">
                                <div class="card pt-4">
                                    <div class="card-body">
                                        <div class="text-center mb-5">
                                            <img src="assets/images/s.png" height="200" >
                                            <h3>Sign In</h3>
                                            <p>Please sign in your account to continue.</p>
                                        </div>
                                        <form action="sign_in_functions.php" method="POST">
                                            <div class="form-group position-relative has-icon-left">
                                                <label for="student_id">Student ID</label>
                                                <div class="position-relative">
                                                    <input type="text" class="form-control" id="student_id" name="student_id" placeholder="Enter your Student ID" required>
                                                    <div class="form-control-icon">
                                                        <i data-feather="user"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <center>
                                                <div class="clearfix">
                                                    <button class="btn btn-outline-primary" type="submit">Sign In</button>
                                                </div>
                                            </center>
                                        </form>

                        <!-- <div class="divider">
                            <div class="divider-text">Don't have an account? 
                                <a href="register.php" >Sign Up here</a>
                            </div>
                        </div> -->
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
