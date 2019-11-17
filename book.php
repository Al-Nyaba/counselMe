<?php 
session_start();

if(! isset($_SESSION['userInfo'])) {
  header('Location: ./signin/?backUrl=book.php');
  return;
} else {
  include("./includes/pdo.php");
  $cat_sql = "SELECT * FROM `counsellingcat`";
  $stmt = $pdo->query($cat_sql);
  if($catCount = $stmt->rowCount()) {
    $counsellingCats = $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}


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
    <link rel="stylesheet" href="book.css" >
    <!-- custom -->




  </head>
  <body>

  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="./">CounselMe::)</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a href="./" class="nav-link">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="disabled nav-link">Book a counsellor</a>
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


  <div class="container-fluid py-5 my-5">
    <div class="row">
      <div class="col">

        
        <!-- contact form for booking a counsellor -->
        <!-- Select Category and Brand -->
    <div class="form-row">
      
      <div class="form-group col-md-4">
        <label for="category-select">Category: </label>
        <select class="form-control" name="category_id" id="category-select">
      <option disabled selected>Please Select</option>
      <?php foreach ($counsellingCats as $key): ?>
        <option value="<?php echo $key['counsellingCatID'];?>"><?php echo $key['name']; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    
  <div class="form-group col-md-4" id="subcategory-container">
    <label for="subcategory-select">Subcategory: </label>
    <select class="form-control" name="subcategory_id" id="subcategory-select">
      </select>
    </div>
    
  </div>

  <div class="form-row">
    <div class="form-group col-md-4">
      <div class="form-check">
        <input type="checkbox" id="emergencyContact" value="yes" />
        <label for="emergencyContact" class="form-check-label">Contact this number in case of emergency</label>
      </div>

      <div class="col-md-8">
        <input autocomplete="tel" type="phone" name="emergencyPhone" id="phone" class="form-control" placeholder="e.g 233264660194" />
      </div>
  </div>
</div>

<div class="form-row">
    <div class="form-group col-md-4">
      <p>What date and time would you be available for counselling </p>
      <div class="col-md-8">
        <input type="date" name="emergencyPhone" id="phone" class="form-control" placeholder="e.g 233264660194" />
        <input type="time" name="" class="form-control" id="">
      </div>
      <div class="col-md pt-3">
        <label for="extraNum">Extra Number of people to be available for counselling</label>
        <input id="extraNum" type="number" class="form-control">
      </div>
  </div>
</div>


<div class="form-row">
  <div class="form-group col-md-4">
    <div class="form-check">
      <input type="checkbox" id="t_and_c" value="agree" />
      <label for="t_and_c" class="form-check-label">I agree to the <a href="#">terms and conditions</a></label>
    </div>
  </div>
</div>

<div class="form-row">
  <div class="form-group col-md-4">
    <input type="submit" class="form-control btn btn-block btn-primary" value="Submit" />
  </div>
</div>


<!-- contact form for booking a counsellor -->

<!-- footer -->

<section class="section mt-5">
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
  </div>
  </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="css/javas.js"></script>

</body>
</html>