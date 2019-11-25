<?php
session_start();

if(! isset($_SESSION['userInfo']))
{
	header('Location: ../');
}

include("../includes/pdo.php");

$check_application_existence = "SELECT * FROM `expertRequest` WHERE `userID` = :uid";
try {
	$stmt = $pdo->prepare($check_application_existence);
	$expertApplicationInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
	if($stmt->rowCount() >= 1) {
		$_SESSION['error']['alreadyApplied'] = "You have previously applied for this service. Please try again after a few more days.";
		header('Location: ./');
		exit();
		return;
	}
} catch(PDOException $e) {
	$_SESSION['serverError']['unknownError'] = "We encountered a problem whiles looking for your subscription. Please try again later or " . '<a href="mailto:nyavowoyiernest@gmail.com">contact Administrator via email<a>';
	header('Location: ./');
	return;
}
/*
This script handles the registration of the users
*/
if(isset($_POST)) {
    // get payment details and other user Information and insert it into the expertRequest table
    $expertPrefCatID = isset($_POST['expertCatID']) ? $_POST['expertCatID'] : '';
    
    $paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : '';
    $momo_number = isset($_POST['momo_number']) ? $_POST['momo_number'] : '';

    $cc_name = isset($_POST['cc-name']) ? $_POST['cc-name'] : '';
    $cc_number = isset($_POST['cc-number']) ? $_POST['cc-number'] : '';
    $cc_expiration = isset($_POST['cc-expiration']) ? $_POST['cc-expiration'] : '';
    $cc_cvv = isset($_POST['cc-cvv']) ? $_POST['cc-cvv'] : '';

    if($cc_name = filter_var($cc_name, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES));
    	else $_SESSION['cardError']['cc_name'] = "Invalid Name on credit card";
    if($cc_number = filter_var($cc_number, FILTER_VALIDATE_INT));
    	else $_SESSION['cardError']['cc_number'] = "Invalid credit card number";
	if($cc_cvv = filter_var($cc_cvv, FILTER_VALIDATE_INT));
		else $_SESSION['cardError']['cc_cvv'] = "Invalid security code for credit card";

    if(! filter_var($expertPrefCatID, FILTER_VALIDATE_INT))
    {
    	$_SESSION['error']['expertCatID'] = "Incorrect Category ID";
    	header('Location: ./');
    	return;
    }

	if($paymentMethod == 4) {
		// for mtn momo
		if($momo_number = filter_var($momo_number, FILTER_SANITIZE_NUMBER_INT))
		{
			$momo_query = "INSERT INTO `expertRequest` (`userID`, `paymentMethodID`) VALUES(:uid, :pmID)";
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			try {
				$stmt = $pdo->prepare($momo_query);
				$res = $stmt->execute(array(
					':uid'	=> $_SESSION['user_id'],
					':pmID'	=> $paymentMethod
				));


				if($res !== false) {
					$_SESSION['serverError']['addingRequest'] = "Unable to process your request at this time. Our team have been notified of the problem. Please try again in a few moments. Thank you!";
					header('Location: ./');
					return;
				}
			} catch(PDOException $e) {
				if($e->getCode() == '23000') {
					$_SESSION['serverError']['alreadySubmitted'] = "We received your request but we are unable to work on it at the moment becuase we believe you have already submitted the request. Please try again after 12 hours or contact " . '<a href="mailto:nyavowoyiernest@gmail.com"></a>';	
					header('Location: ./');
					return;
				}
				$_SESSION['serverError']['addingRequest'] = "Unable to process your request at this time. Our team have been notified of the problem. Please try again in a few moments. Thank you!";
				header('Location: ./');
				return;
			}
		}
	}
	elseif($paymentMethod >= 1 && $paymentMethod <= 3)
	{
		if(isset($_SESSION['cardError'])) {
			header('Location: ./');
			return;
		}
		
		$cardDetails = "cardName: $cc_name, cardNumber: $cc_number, cardSecurityNumber: $cc_cvv";

		$cc_query = "INSERT INTO `expertrequest` (`userID`, `paymentMethodID`, `cardDetails`) VALUES (:uid, :pmID, :cardDetails);";
		try {
			$stmt = $pdo->prepare($cc_query);
			$res = $stmt->execute(array(
				':uid'	=> $_SESSION['user_id'],
				':pmID'	=> $paymentMethod,
				':cardDetails'	=> $cardDetails
			));

			if($res !== false) {
				$_SESSION['serverError']['addingRequest'] = "Unable to process your request at this time. Our team have been notified of the problem. Please try again in a few moments. Thank you!";
				header('Location: ./');
				return;
			}

			else {
				$_SESSION['success']['addingRequest'] = "Your request has been sent successfully. Please wait while we review your application. This may take us up to 12 hours. Thank you!";
				header('Location: ./');
				return;
			}

		} catch(PDOException $e) {
			if($e->getCode() == '23000') {
				$_SESSION['serverError']['alreadySubmitted'] = "We received your request but we are unable to work on it at the moment becuase we believe you have already submitted the request. Please try again after 12 hours or contact " . '<a href="mailto:nyavowoyiernest@gmail.com">Administrator via email</a>';
				header('Location: ./');
				return;
			}
			else {
				echo $e->getMessage();
			}
		}

	}
	else
	{
		$_SESSION['serverError']['insufficientInfo'] = "You didn't send the right information. Verify and rectify before re-submission";
		header('Location: ./');
		return;
	}
}



?>