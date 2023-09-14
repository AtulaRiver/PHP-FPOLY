<?php
    require_once 'connect.php';
    require_once 'check.php';
    try {
        $sql = "select * from roles";
        $roles = $conn -> query($sql) -> fetchAll();
    } catch(PDOException $e) {  
        die($e -> getMessage());
    }

    if($_SERVER['REQUEST_METHOD'] === "POST") {
        $user_email = $_POST['user_email'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $role_id = $_POST['role_id'];

        try {
            $sql = 'insert into users(user_email,
            user_firstname,
            user_lastname,
            role_id) values 
            (:user_email,
            :user_firstname,
            :user_lastname,
            :role_id);';
            $stmt = $conn -> prepare($sql);
            $stmt -> bindParam(':user_email', $user_email);
            $stmt -> bindParam(':user_firstname', $user_firstname);
            $stmt -> bindParam(':user_lastname', $user_lastname);
            $stmt -> bindParam(':role_id', $role_id);

            $stmt -> execute();
            header("Location: index.php");
        } catch(PDOException $e) {  
            die($e -> getMessage());
        }
    }

    require_once 'close.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách</title>  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <label for="">Email:</label>
            <input type="email" class="form-control" name="user_email" id=""> <br>
            <label for="">First Name:</label>
            <input type="text" class="form-control" name="user_firstname" id=""> <br>
            <label for="">Last Name:</label>
            <input type="text" class="form-control" name="user_lastname" id=""> <br>
            <label for="">Role Name:</label>
            <select class="form-control" name="role_id" id="">
                <?php foreach($roles as $role): ?>
                    <option value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>
                <?php endforeach ?>    
            </select> <br>
            <input class="btn btn-primary" type="submit" value="Save">
        </form>
    </div>
</body>
</html>