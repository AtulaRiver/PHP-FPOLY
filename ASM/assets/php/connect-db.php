<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'test_asm';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("connect failed" . $conn->connect_error);
}
