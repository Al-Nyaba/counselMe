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


    <title>Password Reset</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">CounselMe::)</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
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
  </nav>

<div class="form-div">
<div class="form-div-header text-center">
Password Reset
</div>
  <form action="" method="post" class="form-login">

        
        <div class="form-label-group">
        <label for="phone">Old Password</label>
            <input type="password" class="form-control" id="inputPassword"  required="required" />
            
        </div>

        <div class="form-label-group">
        <label for="phone">New Password</label>
            <input type="password" class="form-control" id="inputPassword" required="required" />
            
        </div>
        <div class="form-label-group">
        <label for="phone">Confirm New Password</label>
            <input type="password" class="form-control" id="inputPassword" required="required" />
            
        </div>
        <button id="loginButton" class="btn btn-lg btn-primary btn-block" type="submit">Update</button>

    </form>

</div>





</body>
</html>