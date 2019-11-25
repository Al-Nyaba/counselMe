<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Users</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link href="fontawesome-free-5.10.1-web/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/custom/master.css" />
    <style media="screen">
    .error {
      color: #f90146;
    }
    </style>
  </head>

  <body>
    <nav class="navbar fixed-top navbar-expand-lg bg-primary navbar-dark">
       <a class="navbar-brand" href="index.php">Home</a>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
       <ul class="nav navbar-nav">
           <li class="nav-item"><a href="./testimonials/" class="nav-link">Testimonials</a></li>
       </ul>

         </li>

       </ul>
     </div>
    </nav>

    <nav id="bottomNav" class="d-none navbar fixed-bottom navbar-expand-lg bg-dark navbar-dark">
       <span class="navbar-brand" data-target="">Home</span>
       <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bottomNavbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="bottomNavbarContent">
       <ul class="nav navbar-nav">

           <li class="nav-item"><a href="./testimonials/" class="order nav-link" data-target="./testimonials">Testimonials</a></li>
       </ul>

       <ul class="nav navbar-nav ml-auto">
         <div class="nav-item">
           <a href="" class="nav-link" data-toggle="modal" data-target="#modalRegisterForm"><i class="fa fa-user-plus text-info"></i></a>
         </div>
       </ul>
     </div>
    </nav>

    <div class="container-fluid py-5 my-5">
      <div class="row">
        <div class="col">

        <div id="new_user_success" class="alert alert-success richmorgan-blue text-white alert-dismissible fade in show d-none" role="alert">
          <span id="new_user"></span>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

          <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel"
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
                <form autocomplete="off" id="user_registration_form" action="register.php" method="post">
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

        <div class="">
          <a href="" class="btn btn-primary btn-rounded mb-4" data-toggle="modal" data-target="#modalRegisterForm">Register New User</a>
        </div>

        </div>
      </div>

  </div>

    <script src="jquery/jquery-3.4.1.js"></script>

    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="jquery/jquery.validate.min.js"></script>
    <script src="js/custom/add_user.js"></script>

  </body>
</html>
