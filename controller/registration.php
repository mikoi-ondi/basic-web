<?php

require_once 'config.php'; 
require_once 'prep_pass.php';

define('MAX_EMAIL_LENGTH', 20);
define('MAX_PASSWORD_LENGTH', 16);

function registerUser($conn) {

    // Check if input is missing
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "Введите имейл или пароль";
        return;
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = prep_pass($_POST['password']);
  
    
  
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Введите корректный email адрес";
        return;
    }
  
    // Limit input length to avoid database errors
    if (strlen($email) > MAX_EMAIL_LENGTH || strlen($password) > MAX_PASSWORD_LENGTH) {
        echo "Введенный email слишком длинный";
        return;
    }
  
    // Enforce password complexity requirements
    $password_requirements = array(
        'uppercase' => preg_match('/[A-Z]/', $password),
        'lowercase' => preg_match('/[a-z]/', $password),
        'number' => preg_match('/[0-9]/', $password),
        'length' => strlen($password) >= 8
    );
  
    if (in_array(false, $password_requirements, true)) {
        echo "Пароль должен состоять не менее чем из 8 символов и содержать как минимум одну заглавную букву, одну строчную букву и одну цифру.";
        return;
    }
  
    // Check if user already exists
    $count = "SELECT COUNT(*) FROM users WHERE email = ?";
    $stmt = $conn->prepare($count);
    $stmt->bind_param("s", $email);
    
    if (!$stmt->execute()) {
        echo "Ошибка валидации email: " . $stmt->error;
        return;
    }
    
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    
    if ($count > 0) {
        echo "Аккаунт с таки email уже существует";
        return;
    }
  
    // Insert user into database
    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users(email, password) VALUES(?,?)");
    $stmt->bind_param("ss", $email, $hash_pass);
    
    if (!$stmt->execute()) {
       echo "Ошибка регистрации: " . $stmt->error; 
       return; 
      }
       echo "Регистрация прошла успешно";
       header('Location: ../view/login_view.php');
      
    } 

registerUser($conn);      
?>

