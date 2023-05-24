<?php

require_once 'config.php'; 
require_once 'prep_pass.php';
// расчленить кусочки кода как минимум на геттеры и сеттеры свойств, запихнуть в метод(метод с методами)
class User
{
    private $email;
    private $hash_pass;

    

    public function loginUser($conn)
    {
        session_start();

        
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

    public function regUser($conn)
    {
        define('MAX_EMAIL_LENGTH', 20);
        define('MAX_PASSWORD_LENGTH', 16);

        if (empty($_POST['email']) || empty($_POST['password'])) {
            echo "Введите имейл или пароль";
            return;
        }
    
        $this->email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = prep_pass($_POST['password']);
      
        
      
        
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            echo "Введите корректный email адрес";
            return;
        }
      
        
        if (strlen($this->email) > MAX_EMAIL_LENGTH || strlen($password) > MAX_PASSWORD_LENGTH) {
            echo "Введенный email слишком длинный";
            return;
        }
      
        
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
      
        
        $count = "SELECT COUNT(*) FROM users WHERE email = ?"; //заменить на num_row
        $stmt = $conn->prepare($count);
        $stmt->bind_param("s", $this->email);
        
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
      
       
        $this->hash_pass = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users(email, password) VALUES(?,?)");
        $stmt->bind_param("ss", $this->email, $this->hash_pass);
        
        if (!$stmt->execute()) {
           echo "Ошибка регистрации: " . $stmt->error; 
           return; 
          }
           echo "Регистрация прошла успешно";
           header('Location: ../view/login_view.php');
    }

    public function getEmail($email)
    {
        return $this->email;
    }

    public function setEmail($email)
    {

    }

}


?>