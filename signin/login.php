<?php

session_start();
// username_email, password

// echo "requesting...";
include("../includes/pdo.php");
$b_url = isset($_GET['backUrl']) ? $_GET['backUrl'] : '';

$username_email = isset($_POST['username_email']) ? trim($_POST['username_email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';

if(! filter_var($username_email, FILTER_VALIDATE_EMAIL)) {
    $username = $username_email;
    $sql_username = "SELECT * FROM `users` WHERE `username` = :username";
    $stmt = $pdo->prepare($sql_username);
    $res = $stmt->execute(array(
        ':username' => $username
    ));

    $count = $stmt->rowCount();
    if($count > 0) {
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $row) 
        {
            if (password_verify($password, $row['password'])) 
            {
                echo "password is correct";
                // set session variables
                // redirect user to the homepage or the forward url
                
                    $_SESSION['userInfo'] = array(
                        $_SESSION['username'] = $row['username'],
                        $_SESSION['user_id'] = $row['userID'],
                        $_SESSION['email'] = $row['email']
                );
                
                var_dump($_SESSION);
                if($b_url != '') {
                    header('Location: ../' + $b_url);
                } else {
                    header('Location: ../');
                }
                
            } else {
                echo "password is not correct";
            }
        }
    } else {
        echo "incorrect username";
    }
    
} else {
    $email = $username_email;
    $sql_email = "SELECT * FROM `users` WHERE `email` = :email";
    $stmt = $pdo->prepare($sql_email);
    $res = $stmt->execute(array(
        ':email' => $email
    ));

    $count = $stmt->rowCount();
    if($count > 0) {
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($res as $row) {
            if (password_verify($password, $row['password'])) 
            {
                echo "password is correct";
                // set session variables
                // redirect user to the homepage or the forward url
                
                $_SESSION['userInfo'] = array(
                    $_SESSION['username'] = $row['username'],
                    $_SESSION['user_id'] = $row['userID'],
                    $_SESSION['email'] = $row['email']
                );

                var_dump($_SESSION);
                if($b_url != '') {
                    header('Location: ../' + $b_url);
                } else {
                    header('Location: ../');
                }
            } else {
                echo "password is incorrect";
            }
        }
    }
}



?>