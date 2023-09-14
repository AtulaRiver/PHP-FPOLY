<?php
require_once 'connect.php';
try {
    $sql1 = "select * from roles";
    $roles = $conn->query($sql1)->fetchAll();

    $sql2 = 'select * from users where user_id = :user_id';
    $stmt = $conn->prepare($sql2);
    $stmt->bindParam(':user_id', $_GET['user_id']);
    $stmt->execute();
    $users = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die($e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $user_id = $_POST['user_id'];
    $user_email = $_POST['user_email'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $role_id = $_POST['role_id'];

    try {
        $sql = 'update users
            set 
            user_email = :user_email,
            user_firstname = :user_firstname,
            user_lastname = :user_lastname,
            role_id = :role_id
            where user_id = :user_id';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':user_email', $user_email);
        $stmt->bindParam(':user_firstname', $user_firstname);
        $stmt->bindParam(':user_lastname', $user_lastname);
        $stmt->bindParam(':role_id', $role_id);

        $stmt->execute();
        header("Location: index.php");
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

require_once 'close.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <form action="" method="post">
            <input type="hidden" name="user_id" value='<?= $users['user_id'] ?>'>
            <label for="">Email:</label>
            <input type="email" class="form-control" name="user_email" id="" value='<?= $users['user_email'] ?>'> <br>
            <label for="">First Name:</label>
            <input type="text" class="form-control" name="user_firstname" value='<?= $users['user_firstname'] ?>' id=""> <br>
            <label for="">Last Name:</label>
            <input type="text" class="form-control" name="user_lastname" value='<?= $users['user_lastname'] ?>' id=""> <br>
            <label for="">Role Name:</label>
            <select class="form-control" name="role_id" id="">
                <?php foreach ($roles as $role) : ?>
                    <option <?php if ($role['role_id'] == $users['role_id']) : ?> selected <?php endif ?> value="<?= $role['role_id'] ?>"><?= $role['role_name'] ?></option>
                <?php endforeach ?>
            </select> <br>
            <input class="btn btn-primary" type="submit" value="Save">
        </form>
    </div>
</body>

</html>