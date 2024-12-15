<?php
require_once "../includes/dbm.php";
require_once "../includes/auth_checker.php";

if(!isset($_GET['id'])){
    header("Location: read.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM students WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
header("Location: read.php");
exit;
?>