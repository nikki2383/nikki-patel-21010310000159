<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
        } else {
            echo "Invalid credentials!";
        }
    } else {
        echo "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 300px; margin: 0 auto; padding-top: 50px; }
        input[type="text"], input[type="password"] {
            width: 100%; padding: 10px; margin: 10px 0;
        }
        button { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>