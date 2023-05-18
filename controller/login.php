<?php
include 'config.php';

session_start();
if (isset($_POST['email']) and isset($_POST['password'])) {
    //global $conn;
    $email = $_POST['email'];
    $password= md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE email='$email' and password='$password'";
    $result = mysqli_query($conn, $sql);

    $user = mysqli_fetch_assoc($result);

    if (isset($user)) {
        $_SESSION['auth'] = true;   
        header("Location: /view/feedback_view.php");
    } else {
        echo("Пользователь не найден");
    }

}
// $_SESSION['email'] 
//  = $_SESSION['password'] 