<?php

global $conn;

require_once 'connect-db.php';

$sql = "
    SELECT * FROM user
";

$result = $conn->query($sql);

echo "<table>
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
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>
