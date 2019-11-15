<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login to your account</title>
</head>
<body>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <!-- Font Awesome -->
    <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/custom/login.css" />
</body>
    <form action="" method="post" class="form-login">
        <div class="text-center">
            <!-- <h1 class="h3 mb-3 font-weight-normal">Login</h1> -->
            <p>Please login to your account to continue.</p>
        </div>
        

        <div class="text-right pr-5">
            <p>Not having an account? <a href="./signup.php">Register Now</a> </p>
        </div>

        <div class="form-label-group">
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Enter First Name" required="required" autofocus />
            <label for="firstname">First Name</label>
        </div>

        <div class="form-label-group">
            <input type="password" class="form-control" id="inputPassword" placeholder="Enter Last Name" required="required" />
            <label for="lastname">Last Name</label>
        </div>

        <div class="form-label-group">
            <input type="password" class="form-control" id="inputPassword" placeholder="Enter Your Email" required="required" />
            <label for="inputPassword">Email</label>
        </div>

        <div class="form-label-group">
            <input type="password" class="form-control" id="inputPassword" placeholder="Enter Password" required="required" />
            <label for="password">Password</label>
        </div>

        <div class="form-label-group">
            <input type="password" class="form-control" id="inputPassword" placeholder="Enter Password Again" required="required" />
            <label for="inputPassword">Confirm Password</label>
        </div>

        <div class="form-label-group">
            <input type="password" class="form-control" id="inputPassword" placeholder="Enter Phone Number" required="required" />
            <label for="phone">Phone</label>
        </div>

        <div class="form-label-group">
            <input type="password" class="form-control" id="inputPassword" placeholder="Enter Your Location" required="required" />
            <label for="phone">Location</label>
        </div>
        <button id="loginButton" class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>

    </form>
    <div id="signup" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal header -->
                <div class="modal-header text-center">
                    <div class="modal-title">
                        <h4>Sign UP! It's free!</h4>
                    </div>
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <p>Welcome</p>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
</html>