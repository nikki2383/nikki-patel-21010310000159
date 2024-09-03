<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if ($password != $confirm_password) {
        echo "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if (mysqli_query($conn, $query)) {
            $_SESSION['username'] = $username;
            header("Location: welcome.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 300px; margin: 0 auto; padding-top: 50px; }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%; padding: 10px; margin: 10px 0;
        }
        button { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Signup</h2>
        <form method="POST" action="signup.php">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Signup</button>
        </form>
    </div>
</body>
</html>