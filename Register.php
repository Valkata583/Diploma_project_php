<?php
session_start();
include "database.php";

if (isset($_POST["but"])) {
    if (!empty($_POST["email"]) && !empty($_POST["password"]) && !empty($_POST["usernameinput"]) && !empty($_POST["passwordrep"]) && $_POST["password"] == $_POST["passwordrep"]) {
        $username = $_POST["usernameinput"];
        $password = $_POST["password"];
        $email = $_POST["email"];

        $checkQuery = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $result = mysqli_query($conn, $checkQuery);

        if (!$result) {
            die("Error: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) > 0) {
            // Check which field (email or username) is causing the conflict
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['username'] === $username) {
                    echo "<span>Username already exists. Please choose a different one.</span>";
                }
                if ($row['email'] === $email) {
                    echo "<span>Email already exists. Please use a different one.</span>";
                }
            }
        } else {
            $insertQuery = "INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')";
            $result = mysqli_query($conn, $insertQuery);

            if (!$result) {
                die("Error: " . mysqli_error($conn));
            } else {
                $_SESSION["username"] = $username;
                $_SESSION["pass"] = $password;
                $_SESSION["email"] = $email;
                echo "<span>Registration successful!</span>";
                header("Location:LogIn.php");
            }
        }
    } else {
        echo "<span>Not fulfilled or passwords do not match.</span>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link href="RegisterCSS.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <h1>Регистрация</h1>
    <div id="LogIn">

        <form id="RegisterForm" method="post">
            <label for="usernameinput">Потребителско име:</label>
            <input id="usernameinput" type="text" name="usernameinput">
            <label for="email">E-mail:</label>
            <input id="email" type="email" name="email">
            <label for="password">Парола:</label>
            <input id="password" type="password" name="password">
            <label for="passwordrep">Повтори паролата:</label>
            <input id="passwordrep" type="password" name="passwordrep">

            <input id="but" type="submit" value="Регистрация" name="but">
        </form>
    </div>
</body>

</html>
