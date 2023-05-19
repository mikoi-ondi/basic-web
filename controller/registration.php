<?php
include "config.php";
global $conn;
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
     $stmt = $conn->prepare($sql = "INSERT INTO users SET email='$email', password='$password'");
     $stmt->bind_param("ss", $email, password_hash($password, PASSWORD_DEFAULT));
     $stmt->execute();
     $stmt->close();

     header("Location: /view/login_view.php");
     exit();
    } else {
        echo "Введите корректный email";
    }
    
    
 }

 $conn->close();