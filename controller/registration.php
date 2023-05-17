<?php
include "config.php";

if(isset($_POST['email']) and isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
     $sql = "INSERT INTO users SET email='$email', password='$password'";
     $result = mysqli_query($conn, $sql);
     header("Location: /view/login.html");

    } else {
        echo("Введите корректный email");
    };
    

 };  
    //$conn->close();
    

?>


