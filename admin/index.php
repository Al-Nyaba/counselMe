
<?php
session_start();


if(! isset($_SESSION['admin_id']))
{
  echo 'nothing set';
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
	<link href="../css/fonts/OpenSans.css" rel="stylesheet">
   <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css" >
    <!-- custom -->
    <link rel="stylesheet" href="../css/style.css" >
	<title>Admin Console :: CounselMe</title>
</head>
<body style="font-family: Open Sans">
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

       <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css" >


    <!-- custom -->
    <link rel="stylesheet" href="../css/style.css" >
    <!-- custom -->
    <link rel="stylesheet" href="css/custom/loginModal.css" />


    <title>Document</title>
</head>
<body>
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
                <?php echo $_SESSION['admin_username']; ?>
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

  <div class="container-fluid mt-5 pt-5">
    <div class="row">
      <div class="col-sm col-md-9 col-lg-6">
        <div class="table-responsive">
          <table id="expertRequestsTable" class="table table-responsive-sm table-lg-hover">
            <thead class="thead-purple">
              <tr>
                <th>Name</th>
                <th>Payment Method</th>
                <th>Specialization/Category</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

	<script src="../jquery/jquery-3.4.1.js"></script>
	<script src="../js/popper.min.js"></script>
	<script src="../js/bootstrap.js"></script>
  <script src="../js/jquery.dataTables.min.js"></script>
  <script src="../jquery/jquery.validate.min.js"></script>

          <a href="addCounseller.php" class="nav-link">Add Counseller <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a href="profile.php" class="nav-link">Profile</a>
        </li>
        <li class="nav-item">
          <a href="editCounseller.php" class="nav-link">Edit Counseller</a>
        </li>
       
      </ul>
    </div>

</body>
</html>