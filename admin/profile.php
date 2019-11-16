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


    <title>You Profile</title>
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
Your Profile
</div>
  <form action="" method="post" class="form-login">

        <div class="form-label-group">
        <label for="firstname">First Name</label>
            <input type="email" name="email" id="inputEmail" class="form-control"  required="required" autofocus />
            
        </div>

        <div class="form-label-group">
        <label for="lastname">Last Name</label>
            <input type="password" class="form-control" id="lastName"  required="required" />
            
        </div>

        <div class="form-label-group">
        <label for="inputPassword">Email</label>
            <input type="password" class="form-control" id="inputPassword"  required="required" />
            
        </div>

        <div class="form-label-group">
        <label for="phone">Phone</label>
            <input type="password" class="form-control" id="inputPassword" required="required" />
            
        </div>

        <div class="form-label-group">
        <label for="phone">Location</label>
            <input type="password" class="form-control" id="inputPassword"  required="required" />
            
        </div>

        <div class="form-label-group">
        <label for="phone">Qualification</label>
            <input type="password" class="form-control" id="inputPassword" required="required" />
            
        </div>
        <button id="loginButton" class="btn btn-lg btn-primary btn-block" type="submit">Update</button>

    </form>

    <div class="form-div-footer">
    <p>you can also change your password from <a href="changePassword.php">here</a> </p>
    </div>

</div>





</body>
</html>