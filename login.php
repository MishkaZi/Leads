<?php
session_start();

// Hardcoded credentials (change these for production)
$username = 'admin';
$password = '1234';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === $username && $_POST['password'] === $password) {
        $_SESSION['logged_in'] = true;
        header('Location: backoffice.php');
        exit;
    } else {
        $error = 'Incorrect username or password!';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/assets/css/style.css">
</head>
<body>
<nav class="navbar navbar-dark bg-dark mb-4">
        <span class="navbar-brand mb-0 h1">Admin Login</span>
        <a href="index.html" class="btn btn-secondary">Go Back</a>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="login.php" method="post" class="card card-body">
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <input type="submit" value="Login" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
