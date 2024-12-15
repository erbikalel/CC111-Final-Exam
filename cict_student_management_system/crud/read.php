<?php
require_once "../includes/dbm.php";
require_once "../includes/auth_checker.php";

$result = $conn->query("SELECT * FROM students");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CICT Student Management</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>CICT Student List</h1>
    <a href="create.php" class="btn add-student-btn">Add Student</a> <a href="../auth/logout.php" class="btn logout-btn">Logout</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Year</th>
            <th>Status</th>
            <th>Program</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['year'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['program'] ?></td>
            <td>
                <a class="edit" href="update.php?id=<?=$row['id']?>">Edit</a>
                <a class="delete" href="delete.php?id=<?=$row['id']?>" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>