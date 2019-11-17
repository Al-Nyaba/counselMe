<?php
session_start();

if(! isset($_SESSION['user_type']) && $_SESSION['user_type'] !== 'Admin')
{
	header('Location: ./login.php');
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
   <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css" >
    <!-- custom -->
    <link rel="stylesheet" href="../css/style.css" >
	<title>Admin Console :: CounselMe</title>
</head>
<body style="font-family: Open Sans">
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">CounselMe::)</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a href="./" class="nav-link">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a href="expertRequests.php" class="nav-link">View Expert Requests</a>
        </li>
      </ul>

      <?php if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'admin') {?>
      <!-- profile dropdown toggle -->
      <ul class="nav navbar-nav ml-auto">
          <li class="dropdown">
            <a href="" class="btn btn-outline-warning dropdown-toggle" data-toggle="dropdown">
              <span class="label label-pill label-danger count">
                <?php echo $_SESSION['username']; ?>
              </span>
            </a>

            <ul class="dropdown-menu">
              <!-- <li><a href="./profile/" class="dropdown-item">Profile</a></li> -->
              <!-- <div class="dropdown-divider"></div> -->
              <li><a href="logout.php" class="dropdown-item">Logout</a></li>
            </ul>
          </li>
      </ul>
      <?php } ?>
    </div>
  </nav>

  <div class="container mt-5 pt-5">
	<h1>Welcome to my world</h1>
  </div>

	<script src="../jquery/jquery-3.4.1.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.js"></script>
</body>
</html>