<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login to your account</title>
</head>
<body>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" />
    <!-- Font Awesome -->
    <link href="font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/custom/login.css" />
</body>
    <form action="" method="post" class="form-login">
        <div class="text-center mb-4">
            <p>Please login to your account to continue.</p>
        </div>

        <div class="form-label-group">
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="your email" required="required" autofocus />
            <label for="inputEmail">Email address</label>
        </div>

        <div class="form-label-group">
            <input type="password" class="form-control" id="inputPassword" placeholder="Password" required="required" />
            <label for="inputPassword">Password</label>
        </div>

        <div class="checkbox-mb-3">
            <label class="form-check-label">
                <input type="checkbox" value="remember-me"> Remember me 
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
        <p class="mt-5 mb-3 text-muted text-center">Customer Support (Via Telegram)<br/><a href="https://t.me/EcommerceXProject/" class="btn btn-lg"><span class="fa fa-lg fa-telegram"></span></a></p>
    </form>
</html>