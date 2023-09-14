<?php
session_start();
if($_SERVER['REQUEST_METHOD'] === "POST") {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    if($user == 'jang' && $pass == '1309') {
        $_SESSION['login_success'] = true;
        header("Location: index.php");
    } else {
        $_SESSION['login_success'] = false;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <?php if(isset($_SESSION['login_success']) && !$_SESSION['login_success']): ?>
                <h1 class="text-danger">Dang nhap khong thanh cong</h1>
            <?php endif ?>
            <label for="">User:</label>
            <input type="text" class="form-control" name="user" id=""> <br>
            <label for="">Pass:</label>
            <input type="password" class="form-control" name="pass" id=""> <br>
            <input type="submit" class="btn btn-primary" value="Login">
        </form>
    </div>
</body>

</html>