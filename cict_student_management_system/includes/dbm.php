<?php

$host = 'localhost';
$db = 'cict_student_management';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>