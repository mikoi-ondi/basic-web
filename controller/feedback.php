<?php
require_once 'config.php';
require_once 'Feedback.php'; 

feedback($conn);


function feedback($conn){
    if(!empty($_POST['email']) and !empty($_POST['message'])){
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = $_POST['message'];
    $insurance = $_POST['insurance'];
    $opinion = $_POST['opinion'];
    $services = $_POST['services'][0];
    $user_id = 0;

    $stmt = $conn->prepare(
        "SELECT id FROM users WHERE email= ?");
    $stmt->bind_param("s", $email);
    
    if(!$stmt->execute()){
        echo "Ошибка подключения к базе данных";
        return;
    }
   
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if($result->num_rows !== 1){
        echo "Пожалуйста, укажите email, который вы использовали при регистрации";
        return;
    }
 
        
    $user_id = $row['id'];
    $stmt->close();
    
    
    $stmt = $conn->prepare(
        "INSERT INTO feedback(user_id, message, insurance, opinion, services) VALUES(?,?,?,?,?)");
    $stmt->bind_param("issis", $user_id, $message, $insurance, $opinion, $services);
    
    if(!$stmt->execute()){
        echo "Ошибка подключения к базе данных";
        return;
    } 
        echo "успех";
    } else {
        echo "Введите email и сообщение";
    }
    
}


?>




<!-- по имэйлу найти id, этот id записать в user_id. у одного id несколько записей в таблице feedback
если имэйл найдет, то: взять id и вставить в user_id. user_id установить такой же, как и найденный по имейлу -->
