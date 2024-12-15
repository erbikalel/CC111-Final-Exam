<?php
require_once "../includes/dbm.php";
require_once "../includes/auth_checker.php";

if(!isset($_GET['id'])){
    header("Location: read.php");
    exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM students WHERE id = $id");
if ($result->num_rows == 0){
    header("Location: read.php");
}
$student = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $name = $_POST['name'];
    $year = $_POST['year'];
    $status = $_POST['status'];
    $program = $_POST['program'];

    $stmt = $conn->prepare("UPDATE students SET name=?, year=?, status=?, program=?, id=?");
    $stmt->bind_param("ssssi", $name, $year, $status, $program, $id);
    $stmt->execute();
    header("Location: read.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Add Student</h1> 
    <form method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= $student['name']?>" placeholder="Enter name..." required> <br>
        <label>Year:</label>
        <select name="year" required>
            <option <?= $student['year'] == '1st Year' ? 'selected': '' ?>>1st Year</option>
            <option <?= $student['year'] == '2nd Year' ? 'selected': '' ?>>2nd Year</option>
            <option <?= $student['year'] == '3rd Year' ? 'selected': '' ?>>3rd Year</option>
            <option <?= $student['year'] == '4th Year' ? 'selected': '' ?>>4th Year</option>
            <option <?= $student['year'] == '5th Year and Above' ? 'selected': '' ?>>5th Year and Above</option>
        </select><br>
        <label>Status</label>
        <select name="status" required>
            <option <?= $student['status'] == 'Regular' ? 'selected': '' ?>>Regular</option>
            <option <?= $student['status'] == 'Irregular' ? 'selected': '' ?>>Irregular</option>
        </select><br>
        <label>Program</label>
        <select name="program" required>
            <option <?= $student['program'] == 'BS Information Technology' ? 'selected': '' ?>>BS Information Technology</option>
            <option <?= $student['program'] == 'BS Information Systems' ? 'selected': '' ?>>BS Information Systems</option>
            <option <?= $student['program'] == 'BS Animation & Multimedia Arts' ? 'selected': '' ?>>BS Animation & Multimedia Arts</option>
        </select><br>
        <button type="submit">Update</button>
        <a href="read.php">Cancel</a>
    </form>
</body>
</html>