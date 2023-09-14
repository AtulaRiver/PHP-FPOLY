<?php 
    session_start();

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        if ($user == 'PH31707' && $pass == 'PH31707') {
            $_SESSION['login_success'] = true;
            $_SESSION['username'] = $user;
            header('Location: index.php');
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
    <title>Log</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <?php if(isset($_SESSION['login_success'] ) && !$_SESSION['login_success'] ): ?>
                <h4 class='text-danger'>Đăng Nhập Không Thành Công!</h4>
            <?php endif ?> 
            <label for="">User:</label>
            <input class="form-control" type="text" name="user" id=""> <br>
            <label for="">Pass:</label>
            <input class="form-control" type="password" name="pass" id=""> <br>
            <input class="btn btn-primary" type="submit" value="Login">
        </form>
    </div>
</body>
</html>