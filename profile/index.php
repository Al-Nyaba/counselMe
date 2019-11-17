<?php
session_start();
if(! isset($_SESSION['userInfo']))
{
    // redirect user to the login/signup page
    // $_SESSION['backURL'] = $_SERVER['SCRIPT_NAME'];
    header('Location: ../signin/');
    return;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
       <link href="../font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css" >

    <!-- custom -->
    <!-- <link rel="stylesheet" href="css/style.css" > -->
    <title>Profile - <?php echo $_SESSION['username']; ?></title>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="../">CounselMe::)</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a href="#" class="nav-link">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a href="../book.php" class="nav-link">Book a counsellor</a>
        </li>
        <?php if (! isset($_SESSION['userInfo'])) { ?>
          <li class="nav-item">
            <a href="./signin" class="nav-link" >Login/Sign up</a>
          </li>
        <?php } ?>
        <li class="nav-item">
          <a href="#" class="nav-link">About</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Contact Us</a>
        </li>
      </ul>

      <?php if (isset($_SESSION['userInfo'])) {?>
      <!-- profile dropdown toggle -->
      <ul class="nav navbar-nav ml-auto">
          <li class="dropdown">
            <a href="" class="btn btn-outline-warning dropdown-toggle" data-toggle="dropdown">
              <span class="label label-pill label-danger count">
                <?php echo $_SESSION['username']; ?>
              </span>
            </a>

            <ul class="dropdown-menu">
              <li><a href="./profile/" class="dropdown-item">Profile</a></li>
              <div class="dropdown-divider"></div>
              <li><a href="logout.php" class="dropdown-item">Logout</a></li>
            </ul>
          </li>
      </ul>
      <?php } ?>

    </div>
  </nav>
  
  <div class="container mt-5 pt-5">
  <div class="row">
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">My Profile</h4>
      <form class="needs-validation" novalidate>
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">First name</label>
            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="lastName">Last name</label>
            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid last name is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="username">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text">@</span>
            </div>
            <input type="text" class="form-control" id="username" placeholder="Username" required>
          </div>
        </div>

        <div class="mb-3">
          <label for="email">Email <span class="text-muted">(Optional)</span></label>
          <input type="email" class="form-control" id="email" placeholder="you@example.com">
        </div>

        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>

        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" id="country" required>
              <option value="">Choose...</option>
              <option>United States</option>
            </select>
            <div class="invalid-feedback">
              Please select a valid country.
            </div>
          </div>
          
        </div>
        <hr class="mb-4">
        
        <h4 class="mb-3">My Reviews</h4>

        <div class="row">
          <div class="col-md-3 mb-3">
            
          </div>
        </div>
        <hr class="mb-4">
        <button class="mb-4 btn btn-primary btn-lg btn-block" type="submit">Save</button>
      </form>
    </div>
  </div>
  </div>

  
  <script src="../jquery/jquery-3.4.1.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.js"></script>
</body>
</html>
