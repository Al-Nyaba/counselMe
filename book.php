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




  </head>
  <body>

   <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
 <a href="index.html"><h3>Counselling center</h3></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav">

      <li class="nav-item active"><a class="nav-link" href="index.html">Home </a> </li>
      <li class="nav-item"><a class="nav-link" href="book.html">Book a Counsellor</a></li>
      <li class="nav-item"><a class="nav-link" href="#">About Us</a> </li>
      <li class="nav-item"><a class="nav-link" href="#">Contact Us</a> </li>
            
    
  </div>
  </div>
</nav>

<!-- contact form for booking a counsellor -->
<div class="container">
  <form id="form-div">
    <div class="form-group">
      <div class="row">
        <div class="col">
          <label>name</label>
          <input class="form-control" name="name">
        </div>

      </div>

      <div class="row">
        <div class="col">
          <label>Address</label>
          <input class="form-control" name="address"></div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <label>Age</label>
          <input class="form-control" name="age">
        </div>
        
      </div>

      <div class="row">
        <div class="col">
          <label>Gender</label>
          <select class="form-control" name="gender">
            <option value=""></option>
            <option value="male" >Male</option>
            <option value="female" >Female</option>
          </select>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <label>Counselling Type</label>
          <select class="form-control" name="type" id="counsel" onchange="changeCounsel()">
            <option value=""></option>
            <option value="drug" >Drug Addiction</option>
            <option value="family" >Family Problems</option>
            <option value="personal">Personal Life Problems</option>
            <option value="depression">Depression</option>
            <option value="marriage">Marriage Counselling</option>
            <option value="prostitution">Prostitution</option>
            <option value="other">Other</option>
          </select>
        </div>
      </div>

      <div class="row" id="other"  style="display:none">
        <div class="col">
          <label>Specify other type of Counselling</label>
          <input class="form-control" name="other"></input>
        </div>
      </div>

      

      <div class="row">
        <div class="col-md-4"> 
        <input class="form-control btn btn-primary" type="submit" value="submit" >
        </div>
        </div>
      </div>

      
    </div>
  </form>
</div>

<!-- contact form for booking a counsellor -->



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



<!-- What you can learn section -->

    <!-- Optional JavaScript
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="css/javas.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>

  </body>
</html>