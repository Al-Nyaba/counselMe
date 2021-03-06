<?php 
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Counsel Me</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
   <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" >


    <!-- custom -->
    <link rel="stylesheet" href="css/style.css" >
    <!-- custom -->
    <link rel="stylesheet" href="css/custom/loginModal.css" />

  </head>
  <body>

  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">CounselMe::)</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a href="#" class="nav-link">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a href="book.php" class="nav-link">Book a counsellor</a>
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

  

  <!-- Signup Modal -->
  <div>

  </div>
  
    


<!-- image and text -->
<section class="img-txt">
    <div class="container">

      <div class="row">
        <div class="col-lg-12">
        <h1>Welcome to our counselling center</h1><br/>
        <h3>We give all sort of counselling services such as love counselling, marriages </h3>
      </div>
    </div>
    
  </div>
</section>
<!-- image and text -->

<!-- about and bootstrap logo section -->
<section class="about-margin">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
      <h1>About</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p>
        
      </div>
      <div class="col-md-4">
      <img src="./img/about.jpg" class="img-fluid">
        
      </div>
    </div>
  </div>
</section>
<!-- about and bootstrap logo section -->

<!-- What you can learn section -->

<section class="courses" >
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
       <h2 class="mudi">Our Services</h2>
      </div>
      <!-- HTML -->
      <div class="col-md-4">
        <h3 class="mudi">Marriage Counselling</h3>
        <img src="img/marriage.jpg" class="img-fluid">
        <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</P>
      </div>
      <!-- HTML -->

      <!-- CSSS -->
      <div class="col-md-4">
      <h3 class="mudi">Drug Addiction</h3>
      <img class="img-fluid" src="img/drugs.jpg"></img>
      <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</P>
        
      </div>
      <!-- CSSS -->


      <!-- CSSS -->
      <div class="col-md-4">
      <h3 class="mudi">Personal Life Problems</h3>
      <img class="img-fluid" src="img/personal.jpg"></img>
      <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</P>
        
      </div>
      <!-- CSSS -->

      <!-- BOOTSTRAP -->
      <div class="col-md-4">
      <h3 class="mudi">Prostitution</h3>
      <img src="img/pros.jpg" class="img-fluid">
      <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</P>
        
      </div>
      <!-- BOOTSTRAP -->


      <!-- BOOTSTRAP -->
      <div class="col-md-4">
      <h3 class="mudi">Depression Advices</h3>
      <img src="img/depres.jpg" class="img-fluid">
      <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</P>
        
      </div>
      <!-- BOOTSTRAP -->


      <!-- BOOTSTRAP -->
      <div class="col-md-4">
      <h3 class="mudi">Family Life Problems</h3>
      <img src="img/family.jpg" class="img-fluid">
      <P>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</P>
        
      </div>
      <!-- BOOTSTRAP -->
    </div>
  </div>
</section>


<!-- footer -->

<section>
  <div class="row">
    <div class="col-md-4">
    <h3>Bootstrap</h3>
    <p>Bootstrap is a css frame work that really makes webdesigning awesome. It is actually good to use boostrap becase it can also make your pages load faster</p>
    </div>
    <div class="col-md-4"> 
    <h3>Quick Links</h3>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">About Us</a></li>
      <li><a href="#">Contact Us</a></li>
    </ul>
    </div>
    <div class="col-md-4">
      <h3>Our Services</h3>
      <ul>
      <li>Personal life problems counselling</li>
      <li>Marriage Counselling</li>
      <li>Drug Addiction Counselling</li>
      <li>Family Life Problems</li>
      <li>Depression Advices</li>
    </ul>
    </div>
  </div>
</section>
<!-- footer -->



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="css/javas.js"></script>
    
  </body>
</html>