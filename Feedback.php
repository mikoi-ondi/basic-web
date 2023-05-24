<?php

class Feedback
{
    
    public $insurance;
    public $opinion;
    public $sevices;
    private $user_id;


    public function feedback($conn)     
    {
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
         
                
            $this->user_id = $row['id'];
            $stmt->close();
            
            
            $stmt = $conn->prepare(
                "INSERT INTO feedback(user_id, message, insurance, opinion, services) VALUES(?,?,?,?,?)");
            $stmt->bind_param("issis", $this->user_id, $message, $insurance, $opinion, $services);
            
            if(!$stmt->execute()){
                echo "Ошибка подключения к базе данных";
                return;
            } 
                echo "успех";
            } else {
                echo "Введите email и сообщение";
            }
    }
}

?>