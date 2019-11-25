<?php
session_start();
if(! isset($_SESSION['userInfo'])) {
    header('Location: ../');
    return;
}

require("../includes/pdo.php");



$cat_query = "SELECT * FROM `counsellingcat`";
$payM_query = "SELECT * FROM `paymentmethods`";

try {
  $stmt = $pdo->prepare($cat_query);
  $stmt->execute();
  $categoriesList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $ex) {
  $_SESSION['serverError']['categories'] = "Unable to get the list of categories. Please try again later.";
  return false;
}

try {
  $stmt = $pdo->prepare($payM_query);
  $stmt->execute();
  $paymentmethods = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $ex) {
  $_SESSION['serverError']['paymentmethods'] = "Unable to get the list of payment methods. Please try again in a few moments.";
  return false;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> -->
     <link href="../font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">    
     <link href="../css/fonts/OpenSans.css" rel="stylesheet" type="text/css">    

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css" >

    <title>Experts</title>
</head>
<body style="font-family: Open Sans">
    <div class="container mt-5 pt-5">
      <?php if(isset($_SESSION['serverError'])) : ?>
        <h1 class="h4">Some errors encountered:</h1>
        <ul class="bg-danger text-white" style="font-family: Open Sans; font-size: 125%;">
          <?php foreach ($_SESSION['serverError'] as $key => $value) : ?>
            <li class="pt-2">
              <?php echo $value; ?>
            </li>
          <?php unset($_SESSION['serverError']); endforeach; ?>
        </ul>
      <?php endif; ?>

      <?php if(isset($_SESSION['cardError'])) : ?>
        <h1 class="h4">Some errors encountered:</h1>
        <ul class="bg-danger text-white" style="font-family: Open Sans; font-size: 125%;">
          <?php foreach ($_SESSION['cardError'] as $key => $value) : ?>
            <li class="pt-2">
              <?php echo $value; ?>
            </li>
          <?php unset($_SESSION['cardError']); endforeach; ?>
        </ul>
      <?php endif; ?>

      <?php 
        $check_application_existence = "SELECT * FROM `expertRequest` WHERE `userID` = :uid";
        try {
          $stmt = $pdo->prepare($check_application_existence);
          $stmt->execute(array(
            ':uid'  => $_SESSION['user_id']
          ));
          $expertApplicationInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
          if($stmt->rowCount() >= 1) {
            $_SESSION['error']['alreadyApplied'] = "You have previously applied for this service. Please try again after a few hours. If you think this is an error, kindly ignore the message.";
            // header('Location: ./');
            // exit();
            // return;
          }
        } catch(PDOException $e) {
          $_SESSION['serverError']['unknownError'] = "We encountered a problem whiles looking for your subscription. Please try again later or " . '<a href="mailto:nyavowoyiernest@gmail.com">contact Administrator via email<a>';          // header('Location: ./');
          // return;
        }

        ?>


        <?php //if(isset($_SESSION['error']['alreadyApplied'])) : ?>
          <h2 class="h4 bg-danger pt-3 pb-3 font-weight-bold" style="font-size: 100%; margin: 0 auto; width: 100%;"><?php echo $_SESSION['error']['alreadyApplied'];?></h2>
          <div class="container">
            <div class="row navbar-brand">
              <div class="col-sm col-md-9">
                <p>Useful Links</p>
                <a href="../" class="nav-tab">Home</a>
              </div>
              <div class="col-sm col-md-3">
                <a href="../book.php" class="nav-tab">Book a Counsellor</a>
              </div>
            </div>
          </div>
        <?php //unset($_SESSION['error']['alreadyApplied']); endif; ?>

      <?php if(! isset($_SESSION['error']['alreadyApplied'])) : ?>
        <div>
        <h4 class="text-muted">Are you a professional counsellor, JOIN us now! <small class=""></small></h4>
        <hr class="bg-secondary mt-5">
        <form action="register.php" method="post" id="paymentMethodForm">
          <!-- <div class="col-md-4"> -->
            <div class="row">
                <div class="col-md mb-1">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                      <?php if(! isset($_SESSION['serverError']['categories'])) : ?>
                        <p class="text-muted">Which category of counselling have you specialized in?</p>
                        <div class="bg-primary"></div>
                      <?php unset($_SESSION['serverError']['categories']); endif; ?>
                    </h4>
                  <?php if(isset($_SESSION['error']['expertCatID'])) : ?>
                    <div class="row">
                      <div class="col-sm">
                        <h4 class="p bg-danger text-white">Invalid category chosen</h4>
                      </div>
                    </div>
                  <?php unset($_SESSION['error']['expertCatID']); endif; ?>
                </div>
              </div>
            <div class="row mb-3">
              <div class="col-sm">
                <select class="form-control" name="expertCatID" class="form-control" id="expertCatID" required="required">
                  <option selected disabled>Please Choose a category</option>
                    <?php foreach ($categoriesList as $cl) : ?>
                      <option value="<?php echo $cl['counsellingCatID'];?>"><?php echo $cl['name']; ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
          </div>
        
        <h4 class="mb-3">Payment</h4>
        <kbd class="font-weight-bold bg-success text-white h3" style="font-family: sans-serif; font-size: 80%;">
          Flat fee of GHS20 would be deducted from your account after you have been registered as an expert.
        </kbd>
        <div class="d-block my-3" id="paymentMethodDiv">
          <h4 class="h2">Choose only one payment method</h4>
          <?php foreach ($paymentmethods as $pm) : ?>
            <div class="custom-control custom-radio">
              <input id="<?php echo $pm['name'];?>" type="radio" name="paymentMethod" class="custom-control-input" required value="<?php echo $pm['ID'];?>" />
              <label class="custom-control-label" for="<?php echo $pm['name'];?>"><?php echo $pm['provider'];?></label>
            </div>  
          <?php endforeach; ?>
        </div>
          
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="cc-name">Phone Number</label>
            <input type="tel" name="momo_number" class="form-control" id="momo_number" placeholder="233552745724">
            <small class="text-muted">Phone Number in international format without +</small>
          </div>
        </div>
        <h4 class="font-weight-bold mt-3">NB: Don't use this form if you chose MTN GH MoMo as your payment option!</h4>
        <hr class="bg-primary mb-3" />

        <div id="cardInfo">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="cc-name">Name on card</label>
              <input name="cc-name" type="text" class="form-control" id="cc-name" placeholder="" required>
              <small class="text-muted">Full name as displayed on card</small>
              <div class="invalid-feedback">
                Name on card is required
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="cc-number">Credit card number</label>
              <input name="cc-number" type="text" class="form-control" id="cc-number" placeholder="" required>
              <div class="invalid-feedback">
                Credit card number is required
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="cc-expiration">Expiration</label>
              <input name="cc-expiration" type="text" class="form-control" id="cc-expiration" placeholder="" required>
              <div class="invalid-feedback">
                Expiration date required
              </div>
            </div>
            <div class="col-md-3 mb-3">
              <label for="cc-cvv">CVV</label>
              <input name="cc-cvv" type="text" class="form-control" id="cc-cvv" placeholder="" required>
              <div class="invalid-feedback">
                Security code required
              </div>
            </div>
          </div>
        </div>
        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
      </form>
    </div>

    <?php endif; ?>

    <script src="../jquery/jquery-3.4.1.js"></script>
  <script src="../js/popper.min.js"></script>
  <script src="../js/bootstrap.js"></script>
  <script src="../jquery/jquery.validate.min.js"></script>
  <script src="register.js"></script>
</body>
</html>