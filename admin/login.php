<?php
session_start();

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submitLogin']))
    {
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        if(mb_strlen($username) <= 0) 
            $errors[] = "username";
        if(mb_strlen($password) <= 0)
            $errors[] = "password";

        if(! isset($errors))
        {
            // if there were no errors, try including the database connection file and query the database for appropriate matches
            include("../includes/pdo.php");
            $query = "SELECT * FROM `administrators` WHERE `username` = :username";
            $stmt = $pdo->prepare($query);
            
            $stmt->execute(array(
                ':username'     => $username
            ));
            $count = $stmt->rowCount();
            if($count == 1)
            {
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                if(password_verify($password, $res['password']))
                {
                    $_SESSION['user_type'] = "admin";
                    $_SESSION['admin_id'] = $res['adminID'];
                    $_SESSION['admin_username'] = $res['username'];
                    header('Location: ./');
                    return;
                }
            } else {
                $_SESSION['serverMsg'] = "<label>Incorrect Username/password. Please try again later.</label>";
                header('Location: ./login.php');
                return;
            }

        }
        else
        {
            $_SESSION['errors'] = "<label>We encountered some problems in loggin you in. Please check your inputs and try again.</label>";
            header('Location: ./login.php');
            return;
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 md-order-2">
                <form action="" method="post">
                    
                    <?php if(isset($_SESSION['serverMsg'])) : ?>
                        <div class="error">
                            <?php echo $_SESSION['serverMsg'];
                            unset($_SESSION['serverMsg']);
                            ?>
                        </div>    
                    <?php endif; ?>
                    <label for="username">Username: </label>
                    <input type="text" name="username" id="username" />

                    <label for="password">Password: </label>
                    <input type="password" name="password" id="password" />

                    <input type="submit" name="submitLogin" value="Login" />
                </form>
            </div>
            <?php if(isset($_SESSION['errors'])) : ?>
                <div class="col-md-4 md-order-2 errorsList">
                    <p>We've encountered some problems in loggin you in. Please check your inputs and try again later.</p>
                <?php unset($_SESSION['errors']); endif; ?>
        </div>
    </div>
</body>
</html>