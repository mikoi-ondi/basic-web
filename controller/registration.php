<?php
include "config.php";

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "INSERT INTO 'users'('email', 'password') VALUES ('$email', '$password')";

    $result = $conn->query($sql);

    if ($result) {
        echo "Добавлен новый пользователь";
    } else {
        echo "Ошибка:" . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}

?>


