<?php

if(isset($_POST['firstname'])) {

    require("./includes/pdo.php");
    $firstname = isset($_POST['firstname']) ? trim($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? trim($_POST['lastname']) : '';
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $location = isset($_POST['location']) ? trim($_POST['location']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $conf_password = isset($_POST['conf_password']) ? $_POST['conf_password'] : '';

    if(mb_strlen($firstname) < 3) $errors[] = "First name should be at least 3 characters";
    if(mb_strlen($lastname) < 3) $errors[] = "Last name should be at least 3 characters";
    if(mb_strlen($username) < 6) $errors[] = "Username should be at least 6 characters";
    if(! filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email is not valid";
    // validate the phone number
    if(mb_strlen($password) < 8) $errors[] = "Password should be at least 8 characters long";
    if($password !== $conf_password) $errors[] = "Passwords do not match!";

    if(isset($errors))
    {
        echo json_encode(array('failure' => $errors));
        return false;
    }

    // hash the password

    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $pdo->beginTransaction();
    $user_sql = "INSERT INTO `users` (`firstName`, `lastName`, `username`, `email`, `password`, `phone`, `location`) VALUES (:firstname, :lastname, :username, :email, :pass, :phone, :loc); ";

    try {
        $stmt = $pdo->prepare($user_sql);
        $res = $stmt->execute(array(
            ':firstname'    => $firstname,
            ':lastname'     => $lastname,
            ':username'     => $username,
            ':email'        => $email,
            ':pass'         => $hash_pass,
            ':phone'        => $phone,
            ':loc'          => $location
        ));
        if($res !== false) { // commit if result is okay
            $pdo->commit();
            $success[] =  "You have been registered successfully. Use $username as your username when signing in";
            echo json_encode(array('success' => $success));
            return true;
        }
    } catch (PDOException $e) {
        $pdo->rollBack();
        // $errors[] = "A problem has prevented us from adding you at the moment. We apologize for the incovenice. Please try again in some few minutes.";
        $errors[] = $e->errorInfo();
        if($e->errorCode == '23000') {
            if(in_array('phone', $errors[0])) {
                echo json_encode(array('failure' => "Your phone number belongs to some other account. Please report to " . '<a href="mailto:nyavowoyiernest@gmail.com">administrator</a> if you want to register with the same number"))';
                // echo json_encode(array('failure' => var_dump($e)));
            }
        }
        echo json_encode(array('failure' => $errors));
        return false;
    }
}

?>