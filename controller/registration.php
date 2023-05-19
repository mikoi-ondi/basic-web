<?php

require_once 'config.php'; // defines the undefined vars
require_once 'prep_pass.php';

define('MAX_EMAIL_LENGTH', 20);
define('MAX_PASSWORD_LENGTH', 16);

function registerUser($conn) {

    // Check if input is missing
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "Email or password are missing";
        return;
    }

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = prep_pass($_POST['password']);
  
    
  
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Enter a valid email address";
        return;
    }
  
    // Limit input length to avoid database errors
    if (strlen($email) > MAX_EMAIL_LENGTH || strlen($password) > MAX_PASSWORD_LENGTH) {
        echo "Email or password are too long";
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
        echo "Password should be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number";
        return;
    }
  
    // Check if user already exists
    $count = "SELECT COUNT(*) FROM users WHERE email = ?";
    $stmt = $conn->prepare($count);
    $stmt->bind_param("s", $email);
    
    if (!$stmt->execute()) {
        echo "Unable to validate email: " . $stmt->error;
        return;
    }
    
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    
    if ($count > 0) {
        echo "An account with that email already exists";
        return;
    }
  
    // Insert user into database
    $hash_pass = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users(email, password) VALUES(?,?)");
    $stmt->bind_param("ss", $email, $hash_pass);
    
    if (!$stmt->execute()) {
       echo "Unable to create account: " . $stmt->error; 
       return; 
      }
       echo "Account created successfully";
       header('Location: ../view/login_view.php');
      
    } 

registerUser($conn);      
?>

