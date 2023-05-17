<?php
include 'config.php';

if (isset($_POST['email']) and isset($_POST['password'])) {
    global $conn;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
    $result = mysqli_query($conn, $query);

    $user = mysqli_fetch_assoc($result);

    if (isset($user)) {
        header("Location: /feedback.html");
    } else {
        echo("Пользователь не найден");
    }

}
