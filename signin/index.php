<?php

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="signin.css" />
    <link href="../fontawesome-free-5.10.1-web/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/custom/master.css" />
    <style media="screen">
    .error {
      color: #f90146;
    }
    </style>
</head>
<body class="text-center">
    <div class="container-fluid py-5 my-5">
      <div class="row">
        <div class="col">

        <div id="new_user_success" class="alert alert-success richmorgan-blue text-white alert-dismissible fade in show d-none" role="alert">
          <span id="new_user"></span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal fade text-left" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Sign up a User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form autocomplete="off" id="user_registration_form" action="../register.php" method="post">
                  <div class="form-group">
                    <label for="firstname">First Name</label>
                    <input name="firstname" type="text" class="form-control" id="firstname" placeholder="Eg. Atsu">
                  </div>
                  <div class="form-group">
                    <label for="lastname">Last Name</label>
                    <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Eg. Nyavowoyi">
                  </div>
                  <div class="form-group">
                    <label for="username">User Name</label>
                    <input name="username" type="text" class="form-control" id="username" placeholder="Eg. Atsu Ernest">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input autocomplete="your email" name="email" type="email" class="form-control" id="email" placeholder="tudentportala@somewhere.com" />
                  </div>

                <div class="form-group">
                    <label for="phone">Phone </label>
                    <input autocomplete="tel" type="phone" name="phone" id="phone" class="form-control" placeholder="e.g +233264660194" />
                </div>

                <div class="form-group">
                    <label for="phone">Location </label>
                    <input autocomplete="" type="location" name="location" id="location" class="form-control" placeholder="" />
                </div>

                  <div class="form-group">
                    <label for="password">Password</label>
                    <input autocomplete="new password" name="password" id="password" class="form-control" type="password" name="password" value="" />
                  </div>

                  <div class="form-group">
                    <label for="conf_password">Re-type Password</label>
                    <input autocomplete="confirm password" name="conf_password" id="conf_password" class="form-control" type="password" name="password" value="" />
                  </div>

                  <div class="fa-2x text-center">
                    <i id="spinner" class="fas fa-spinner fa-pulse d-none"></i>
                  </div>

                  <div class="fa-2x text-center">
                    <i id="errorIcon" class="fa fa-exclamation-triangle d-none" aria-hidden="true"></i>
                    <p id="errorInfo"></p>
                  </div>

                  <div class="modal-footer d-flex justify-content-center">
                    <input id="signUpBtn" type="submit" name="signUpBtn" class="btn btn-primary btn-lg" value="Sign Up!" />
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>

    <form class="form-signin">
      <img class="mb-4" src="../img/counselMeLogo.png" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
      <p class="no-account h5 mb-3 font-weight-light m-0 p-0"><br />Not having an account, please <br />
      <a href="" class="text-warning" data-toggle="modal" data-target="#modalRegisterForm">sign up</a>
      <br /><br />
      </p>
      <label for="inputEmail" class="sr-only">Email address</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
      <div class="checkbox mb-3 text-left">
        <label>
          <input type="checkbox" name="rememberMe" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
      <p class="mt-5 mb-3 text-muted">&copy; <span class="font-weight-bold text-dark"><?php echo date('Y');?></span> by <span class="font-weight-bold text-dark">CounselMe Services</span></p>
    </form>
    
    <script src="../jquery/jquery-3.4.1.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../jquery/jquery.validate.min.js"></script>
    <script src="../js/custom/add_user.js"></script>
    
  </body>
</html>