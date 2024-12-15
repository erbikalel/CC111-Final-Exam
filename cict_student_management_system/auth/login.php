<?php
session_start();
require_once '../includes/dbm.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $hashed = hash('sha256', $pass);

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $hashed);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1){
        $_SESSION['admin'] = $username;
        header("Location: ../crud/read.php");
    }
    else{
        $error = "You are not an admin. Try again!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <form method="POST">
        <h2>Login</h2>
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required>
        <?php if (isset($error)): ?>
        <p style="color: red;"><?=$error?></p>
        <?php endif; ?>

        <button type="submit">Login</button>
    </form>
</body>
</html>