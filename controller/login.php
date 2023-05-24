<?php

require_once 'config.php'; 
require_once 'prep_pass.php';

session_start();
loginUser($conn);

function loginUser($conn) {
    
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "Введите имейл или пароль";               
        return;
    }
  
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = prep_pass($_POST['password']);
  
    
    $stmt = $conn->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    
    if (!$stmt->execute()) {
        echo "Ошибка подключения к базе данных" . $stmt->error;
        return;
    }
    
    $result = $stmt->get_result();
  
    if ($result->num_rows !== 1) {
        echo "Введены неверные данные";
        return;
    }
  
    $row = $result->fetch_assoc();
    $hash_pass = $row['password'];
  
    if (!password_verify($password, $hash_pass)) {
        echo "Введены неверные данные";
        
        return;
    }
    
    echo "Авторизация прошла успешно";
    $_SESSION['auth'] = true;
    header("Location: ../view/feedback_view.php");
    exit();
}

