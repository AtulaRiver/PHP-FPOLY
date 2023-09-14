<?php
    session_start();

    if(!isset($_SESSION['login_success']) || !$_SESSION['login_success']) {
        header("Location: index.php");
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hehe</title>
</head>
<body>
    <h1>Hello World</h1>
    <a href="logout.php">Log out</a>
</body>
</html>