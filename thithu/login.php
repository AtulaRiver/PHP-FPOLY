<?php
    session_start();
    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        if($user == 'admin' && $pass == '1234') {
            $_SESSION['login_success'] = true;
            headr
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <label for="">User:</label>
        <input type="text" class="form-control" name="user" id=""> <br>
        <label for="">Pass:</label>
        <input type="password" class="form-control" name="pass" id=""> <br>
    </form>
</body>
</html>