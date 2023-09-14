<?php
    if(isset($_SESSION['login_success']) || !$_SESSION['login_success']) {
        header("Location: login.php");
    }
?>