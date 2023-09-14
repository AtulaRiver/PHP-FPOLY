<?php

global $conn;

require_once 'connect-db.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fn = $_POST["fn"];
    $ln = $_POST["ln"];
    $age = $_POST["age"];
    if (!isset($fn)) {
        echo "Thieu name";
    } elseif (!isset($ln)) {
        echo "Thieu name";
    } elseif (!isset($age)) {
        echo "Thieu tuoi";
    } else {
        $sql = "
    Insert into user(FirstName, LastName, Age)
    values 
    ('$fn', '$ln', '$age')
";
    }
}

if ($conn->multi_query($sql) === TRUE) {
    
} else {
    echo "Error: " . $conn->error;
}


$sql = "
    SELECT * FROM user
";

$result = $conn->query($sql);

echo "<table class=>
          <tr>
               <th>ID</th>
               <th>Firstname</th>
               <th>Lastname</th>
               <th>Age</th>
          </tr>";

foreach ($result->fetch_all(MYSQLI_ASSOC) as $item) {
    echo "
          <tr>
               <td>{$item['Id']}</td>
               <td>{$item['FirstName']}</td>
               <td>{$item['LastName']}</td>
               <td>{$item['Age']}</td>
          </tr>
    ";
}

echo "</table>";
require_once 'close.php';

?>

<style>
    table {
        margin-top: 24px;
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>