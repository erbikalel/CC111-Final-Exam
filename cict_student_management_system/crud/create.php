<?php
require_once "../includes/dbm.php";
require_once "../includes/auth_checker.php";

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['name'];
    $year = $_POST['year'];
    $status = $_POST['status'];
    $program = $_POST['program'];

    $stmt = $conn->prepare("INSERT INTO students (name, year, status, program) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $year, $status, $program);
    $stmt->execute();
    header("Location: read.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Add Student</h1> 
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" placeholder="Enter name..." required> <br>
        <label>Year:</label>
        <select name="year" required>
            <option>1st Year</option>
            <option>2nd Year</option>
            <option>3rd Year</option>
            <option>4th Year</option>
            <option>4th Year and Above</option>
        </select><br>
        <label>Status</label>
        <select name="status" required>
            <option>Regular</option>
            <option>Irregular</option>
        </select><br>
        <label>Program</label>
        <select name="program" required>
            <option>BS Information Technology</option>
            <option>BS Information Systems</option>
            <option>BS Animation & Multimedia Arts</option>
        </select><br>
        <button type="submit">Add Student</button>
    </form>
</body>
</html>