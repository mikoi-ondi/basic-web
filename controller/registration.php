<?php

require_once 'config.php'; // defines the undefined vars

define('MAX_EMAIL_LENGTH', 255);
define('MAX_PASSWORD_LENGTH', 255);

function sanitize_password($value) {
    $value = trim($value); // Remove any white spaces at the beginning and end of the input.
    $value = stripslashes($value); // Remove any backslashes in the input.
    $value = htmlspecialchars($value); // Convert special characters to HTML entities.
    return $value;
}

function registerUser($conn) {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = sanitize_password($_POST['password']);
  
    // Check if input is missing
    if (empty($email) || empty($password)) {
        echo "Email or password are missing";
        return;
    }
  
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

