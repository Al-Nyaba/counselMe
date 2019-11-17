<?php

/*
This script handles the registration of the users
*/
if(isset($_POST)) {
    // get payment details and other user Information and insert it into the expertRequest table
    $expertPrefCatID = isset($_POST['expertCatID']) ? $_POST['expertCatID'] : '';
    
    $paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : '';
    // var_dump($_POST);
} else {
    echo "something went wrong please try again later";
}
    

?>