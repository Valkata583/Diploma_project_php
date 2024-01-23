<?php
session_start();
include "database.php";

if (isset($_POST["but"])) {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Error: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            // User authenticated
            $row = mysqli_fetch_assoc($result);
            $_SESSION["username"] = $row['username'];
            $_SESSION["email"] = $row['email'];
            echo "Login successful! Welcome, " . $_SESSION["username"];
        } else {
            echo "Invalid email or password. Please try again.";
        }
    } else {
        echo "Please enter both email and password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>LogIn</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="LogInCSS.css" rel="stylesheet" type="text/css"/>
</head>

<body>
    <h1>Влизане в профил</h1>
    <div id="LogIn">
        
        <form id="LogInForm" method="post">
            <label for="email">E-mail:</label>
            <input id="email" type="email" name="email" required>
            <label for="password">Парола:</label>
            <input id="password" type="password" name="password" required>
            
            <input id="but" type="submit" value="Влизане" name="but">
            <p>Нямаш профил? <a href="Register.php">Регистррай се</a></p>
        </form>
    </div>
</body>
</html>
